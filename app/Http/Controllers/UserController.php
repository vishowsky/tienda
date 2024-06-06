<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Validator ,Image , Str , Config, Auth, Hash;
use App\User;

class UserController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
    }

    public function getAccountEdit(){
        return view('user.account_edit');
    }
    public function postAccountAvatar(Request $request){
            $rules = [
                'avatar' => 'required'
            ];

            $messages = [
                'avatar.required' => 'Seleccione una imagen'

            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()):
                return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                    ->withInput();
            else:
                if ($request->hasFile('avatar')):
                    $path = '/'.Auth::id();
                    $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                    $upload_path = Config::get('filesystems.disks.uploads_user.root');
                    $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));

                    $filename = rand(1, 99999).'_av_'.'-'.$name.'.'.$fileExt;
                    $final_file = $upload_path . '/' . $path . '/' . $filename;

                    $u = User::find(Auth::id());
                    $aa = $u->avatar;
                    $u->avatar = $filename;

                    if ($u->save()):
                        if ($request->hasFile('avatar')):
                            $fl = $request->avatar->storeAs($path, $filename, 'uploads_user');
                            $img = Image::make($final_file);
                            $img->fit(256, 256, function ($constraint) {
                                $constraint->upsize();
                            });
                            $img->save($upload_path . '/' . $path . '/av_' . $filename);
                        endif;
                        unlink($upload_path.'/'.$path.'/'.$aa);
                        unlink($upload_path.'/'.$path.'/av_'.$aa);
                    return back()->with('message', 'foto de perfil guardada con exito con exito')->with('typealert', 'success');
                endif;
            endif;
        endif;
        }

        public function postAccountPassword(Request $request){
            $rules = [
                'apassword' => 'required|min:8',
                'password' => 'required|min:8',
                'cpassword' => 'required|min:8|same:password'

            ];

            $messages = [
                'apassword.required' => 'Ingrese su contraseña',
                'apassword.min' => 'su contraseña debe de tener mas de 8 caracteres',
                'cpassword.required' => 'Ingrese la nueva contraseña',
                'cpassword.min' => 'su nueva contraseña debe de tener mas de 8 caracteres',
                'password.required' => 'repita la nueva contraseña',
                'password.min' => 'su contraseña debe de tener mas de 8 caracteres',
                'cpassword.same' => 'las contraseñas no coinciden'

            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()):
                return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                    ->withInput();
            else:
                $u = User::find(Auth::id());
                if(Hash::check($request->input('apassword'), $u->password)):
                    $u->password = Hash::make($request->input('password'));
                    if($u->save()):
                        return back()->with('message', 'Contraseña cambiada')->with('typealert', 'success')
                        ;
                    endif;
                else:
                    return back()->with('message', 'Contraseña actual erronea')->with('typealert', 'danger');
                endif;
            endif;
        }
        public function postAccountInfo(Request $request){
            $rules = [
                'name' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'birthday' => 'required',
            ];

            $messages = [
                'name.required' => 'Nombre Requerido',
                'lastname.required' => 'Apellido requerido',
                'phone.required' => 'Telefono requerido',
                'birthday.required' => 'Fecha de nacimiento requerido',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()):
                return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                    ->withInput();
            else:
                $u = User::find(Auth::id());
                $u->name = e($request->input('name'));
                $u->lastname = e($request->input('lastname'));
                $u->phone = e($request->input('phone'));
                $u->birthday = e($request->input('birthday'));
                $u->gender = e($request->input('gender'));
                if($u->save()):

                    return back()->with('message', 'informacion actualizada')->with('typealert', 'success');
                endif;
            endif;
        }
    }


