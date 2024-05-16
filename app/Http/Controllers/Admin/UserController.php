<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');

    }

    public function getUsers($status)
    {
        //obtener datos de los usuarios en la bd ordenados
        if ($status == 'all'):
            $users = User::orderBy('id', 'Desc')->paginate(25);
        else:
            $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(25);
        endif;
        //variable que almacena los usuarios en un arreglo
        $data = ['users' => $users];
        //retornar la vista y los usuarios
        return view('admin.users.home', $data);
    }
    public function getUserEdit($id)
    {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.edit', $data);
    }

    public function getUserBanned($id)
    {
        $u = User::findOrFail($id);
        if ($u->status == "100"):
            $u->status = "0";
            $msg = "Cuenta activa nuevamente";
        else:
            $u->status = "100";
            $msg = "Cuenta Suspendida";
        endif;

        if ($u->save()):
            return back()->with('message', $msg)->with('typealert', 'success');
        endif;

    }
    public function getUserPermissions($id)
    {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.permissions', $data);
    }
    public function postUserPermissions(Request $request, $id)
    {
        $u = User::findOrFail($id);
        $u->permissions = $request->except(['_token']);
        if ($u->save()):
            return back()->with('message', 'Permisos actualizados correctamente')->with('typealert', 'success');
        endif;
    }

    public function postUserEdit($id, Request $request)
    {
        $u = User::findOrFail($id);
        $u->role = $request->input('user_type');
        if ($request->input('user_type') == '1'):
            if (is_null($u->permissions)):
                $permissions = [
                    'dashboard' => true
                ];
                $permissions = json_encode($permissions);
                $u->permissions = $permissions;
            endif;
        else:
            $u->permissions = null;
        endif;
        if ($u->save()):
            if ($request->input('user_type') == '1'):
                return redirect('/admin/user/'.$u->id.'/permissions')->with('Se ha cambiado el tipo de usuario', '')->with('', 'success');
            else:
                return back()->with('Se ha cambiado el tipo de usuario', '')->with('', 'success');
            endif;
        endif;
    }
}
