<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use Validator, Str, Config;
class CategoriesController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');



    }
    public function getHome($module){
        $cats = Category::where('module',$module)->where('parent', '0')->orderBy('order','Asc')->get();
        $data = ['cats' => $cats, 'module' => $module ];

        return view('admin.categories.home',$data);
    }
    public function postCategorieAdd(request $request, $module){
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
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('icon')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
            $filename = rand(1, 99999) . '-' . $name . '.' . $fileExt;

            $c = new Category;
            $c ->name = e($request->input('name'));
            $c ->module = $module;
            $c ->parent = $request->input('parent');
            $c ->slug = Str::slug($request->input('name'));
            $c ->file_path = date('Y-m-d');
            $c -> icono = $filename;
            if($c->save()):
                if ($request->hasFile('icon')):
                    $fl = $request->icon->storeAs($path, $filename, 'uploads');

                endif;
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

            ];
        $messages = [
            'name.required' => 'Nombre obligatorio',


        ];

        $validator = Validator::make(request()->all(), $rules, $messages);

        if ($validator->fails()):
            return back()->withErrors($validator)->with('message','se ha producido un error')->with('typealert','danger');
        else:


            $c = Category::find($id);
            $c ->name = e($request->input('name'));
            //$c ->slug = Str::slug($request->input('name'));
            if($request->hasFile('icon')):
                $actual_icon = $c->icono;
                $actual_file_path = $c->file_path;
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('icon')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
                $filename = rand(1, 99999) . '-' . $name . '.' . $fileExt;
                $fl = $request->icon->storeAs($path, $filename, 'uploads');
                $c ->file_path = date('Y-m-d');
                $c -> icono = $filename;
                if(!is_null($c->$actual_icon)):
                    unlink($upload_path.'/'.$actual_file_path.'/'.$actual_icon);
                endif;
            endif;
            $c->order = $request->input('order');
            if($c->save()):
                return back()->withErrors($validator)->with('message','Categoria Guardada con exito')->with('typealert','success');
            endif;
        endif;



    }

    public function getSubCategories($id){
        $cat = Category::findOrFail($id);
        $data = ['category' => $cat];
        return view('admin.categories.subs_categories',$data);
    }
    public function getCategoryDelete($id){

        $c = Category::find($id);
        if ($c->delete()):
            return back()->with('message','Eliminado correctamente')->with('typealert','success');
        endif;
        }
}
