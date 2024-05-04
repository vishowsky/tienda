<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail, Str;
use App\User;
use App\Mail\UserSendRecover;
use App\Mail\UserSendNewPassword;
use Malahierba\ChileRut\ChileRut;
use Malahierba\ChileRut\Rules\ValidChileanRut;


class ConnectController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest")->except(['getLogout']);
    }
    //Funcion para cargar el login en la ruta /login
    public function getLogin()
    {
        // /resources/views/connect
        return view('connect.login');
    }

    //Funcion para iniciar sesion con metodo post
    public function postLogin(Request $request)
    {
        // /resources/views/connect
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $messages = [
            'email.required' => 'Email es requerido',
            'email.email' => 'Formato de correo incorrecto',
            'password.required' => 'Contraseña requerida',
            //'password.min' => 'Contraseña debe de tener un minimo de 8 caracteres',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)):
                if (Auth::user()->status == "100"):
                    return redirect('/logout');
                else:
                    return redirect('/');
                endif;
            else:
                return back()->withErrors($validator)->with('message', 'Correo o contraseña incorrecta')->with('typealert', 'danger');
            endif;
        endif;

    }



    //Funcion para cargar el registro en la ruta /register
    public function getRegister()
    {
        // /resources/views/connect
        return view('connect.register');
    }

    public function postRegister(Request $request)
    {
        // /resources/views/connect
        //reglas de validacion
        $rules = [
            'name' => 'required',
            'rut' => ['required', new ValidChileanRut(new ChileRut), 'unique:users,rut'],
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password'
        ];

        $messages = [
            'name.required' => 'Nombre es requerido',
            'rut.required' => 'Rut requerido',
            'rut.unique' => 'Rut ya registrado',
            'rut.valid_chilean_rut' => 'Rut no valido',
            'lastname.required' => 'Apellido requerido',
            'email.required' => 'Correo es requerido',
            'email.email' => 'Formato de correo incorrecto',
            'email.unique' => 'Correo electronico ya existente, favor usar otro',
            'password.required' => 'Contraseña requerida',
            'password.min' => 'Contraseña debe de tener un minimo de 8 caracteres',
            'cpassword.required' => 'Confirmacion de contraseña es requerido',
            'cpassword.same' => 'Contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'se ha producido un error')->with('typealert', 'danger');
        else:
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->rut = e($request->input('rut'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));

            if ($user->save()):
                return redirect('/login')->with('message', 'Regristro exitoso')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getLogout()
    {
        $status = Auth::user()->status;
        Auth::logout();
        if ($status == "100"):
            return redirect('/login')->with('message', 'Su cuenta ha sido suspendida')->with('typealert', 'danger');
        else:
            return redirect('/');
        endif;
    }
    public function getRecover()
    {
        return view('connect.recover');
    }
    public function postRecover(Request $request)
    {
        $rules = [

            'email' => 'required|email',

        ];

        $messages = [

            'email.required' => 'Correo es requerido',
            'email.email' => 'Formato de correo incorrecto',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'se ha producido un error')->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->count();
            if ($user == "1"):
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = ['name' => $user->name, 'email' => $user->email, 'code' => $code];
                $u = User::find($user->id);
                $u->password_code = $code;
                if ($u->save()):
                    Mail::to($user->email)->send(new UserSendRecover($data));
                    return redirect('/reset?email=' . $user->email)->with('message', 'Se ha enviado el correo con el codigo
                para reestablecer su contraseña')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'Correo no registrado')->with('typealert', 'danger');
            endif;
        endif;
    }

    public function getReset(Request $request)
    {
        $data = ['email' => $request->get('email')];
        return view('connect.reset', $data);
    }

    public function postReset(Request $request)
    {
        $rules = [

            'email' => 'required|email',
            'code' => 'required',
        ];

        $messages = [

            'email.required' => 'Correo es requerido',
            'email.email' => 'Formato de correo incorrecto',
            'code.required' => 'El codigo de recuperacion es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'se ha producido un error')->with('typealert', 'danger');
        else:
            $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))
            ->count();
            if ($user == "1"):
                $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))
                ->first();
                $new_password = Str::random(12);
                $user->password = Hash::make($new_password);
                $user->password_code = null;
                if ($user->save()) :
                    $data = ['name' => $user->name, 'password'  => $new_password];
                    Mail::to($user->email)->send(new UserSendNewPassword($data));
                    return redirect('/login')->with('message', 'Se ha enviado su nueva contraseña')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'Correo electronico o codigo erroneo')->with('typealert', 'danger');
            endif;
        endif;
    }

}

