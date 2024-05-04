<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use Validator, Str;
class CategoriesController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');



    }
    public function getHome($module){
        $cats = Category::where('module',$module)->orderBy('name','Asc')->get();
        $data = ['cats' => $cats];

        return view('admin.categories.home',$data);
    }
    public function postCategorieAdd(request $request){
        $rules = [
            'name'=> 'required',
            'icon' => 'required',
            ];
        $messages = [
            'name.required' => 'Nombre obligatorio',
            'icon.required' => 'Icono obligatorio',

        ];

        $validator = Validator::make(request()->all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','se ha producido un error')->with('typealert','danger');
        else:
            $c = new Category;
            $c ->name = e($request->input('name'));
            $c ->module = $request->input('module');
            $c ->slug = Str::slug($request->input('name'));
            $c -> icono = e($request->input('icon'));
            if($c->save()):
                    return back()->withErrors($validator)->with('message','Categoria Guardada con exito')->with('typealert','success');
            endif;
        endif;


    }
    public function getCategoryEdit($id){
        $cat = Category::find($id);
        $data = ['cat'=> $cat];
        return view('admin.categories.edit',$data);
    }
    public function postCategoryEdit(request $request, $id){
        $rules = [
            'name'=> 'required',
            'icon' => 'required',
            ];
        $messages = [
            'name.required' => 'Nombre obligatorio',
            'icon.required' => 'Icono obligatorio',

        ];

        $validator = Validator::make(request()->all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','se ha producido un error')->with('typealert','danger');
        else:
            $c = Category::find($id);
            $c ->name = e($request->input('name'));
            $c ->module = $request->input('module');
            //$c ->slug = Str::slug($request->input('name'));
            $c -> icono = e($request->input('icon'));
            if($c->save()):
                    return back()->withErrors($validator)->with('message','Categoria Guardada con exito')->with('typealert','success');
            endif;
        endif;


    }
    public function getCategoryDelete($id){

        $c = Category::find($id);
        if ($c->delete()):
            return back()->with('message','Eliminado correctamente')->with('typealert','success');
        endif;
        }
}
