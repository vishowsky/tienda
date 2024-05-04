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
        $permissions = [
            'dashboard' => $request->input('dashboard'),
            'products' => $request->input('products'),
            'product_add' => $request->input('product_add'),
            'product_edit' => $request->input('product_edit'),
            'product_search' => $request->input('product_search'),
            'product_delete' => $request->input('product_delete'),
            'product_gallery_add' => $request->input('product_gallery_add'),
            'product_gallery_delete' => $request->input('product_gallery_delete'),
            'categories' => $request->input('categories'),
            'category_add' => $request->input('category_add'),
            'category_edit' => $request->input('category_edit'),
            'category_delete' => $request->input('category_delete'),
            'user_edit' => $request->input('user_edit'),
            'user_banned' => $request->input('user_banned'),
            'user_list' => $request->input('user_list'),
            'user_permissions' => $request->input('user_permissions'),
            'dashboard_small_stats' => $request->input('dashboard_small_stats'),
            'dashboard_sell_today' => $request->input('dashboard_sell_today'),




        ];
        $permissions = json_encode($permissions);
        $u->permissions = $permissions;
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
