<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator , Auth, Config, Str;
use App\Http\Models\Slider;

class SliderController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');

    }
    public function getHome(){
        $sliders = Slider::orderBy('orden','Asc')->get();
        $data = ['sliders' => $sliders ];
        return view('admin.slider.home', $data);
    }

    public function postSliderAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'content' => 'required',
            'orden' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre del banner es requerido',
            'img.required' => 'La imagen del banner es requerida'  ,
            'content.required' => 'El contenido del banner es requerido',
            'orden.required' => 'Es necesario definir el orden de aparicion',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert','danger');
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename = rand(1, 99999) . '-' . $name . '.' . $fileExt;

            $slider = new Slider;
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = $request->input('name');
            $slider->file_path = $path;
            $slider->file_name = $filename;
            $slider->content = $request->input('content');
            $slider->orden = $request->input('orden');
            if($slider->save()):
                if ($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');

                endif;
                    return back()->withErrors($validator)->with('message','Carrusel Guardada con exito')->with('typealert','success');
            endif;
        endif;
}

    public function getSliderEdit($id){
        $slider = Slider::findOrFail($id);
        $data = ['slider' => $slider];
        return view('admin.slider.edit', $data);

    }

    public function postSliderEdit(Request $request ,$id){
        $rules = [
            'name' => 'required',
            'content' => 'required',
            'orden' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre del banner es requerido',
            'content.required' => 'El contenido del banner es requerido',
            'orden.required' => 'Es necesario definir el orden de aparicion',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert','danger');
        else:
            $slider = Slider::find($id);
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = $request->input('name');
            $slider->content = $request->input('content');
            $slider->orden = $request->input('orden');
            if($slider->save()):
                    return back()->withErrors($validator)->with('message','Carrusel Guardada con exito')->with('typealert','success');
            endif;
        endif;
    }

    public function getSliderDelete($id){
        $slider = Slider::findOrFail($id);
        if($slider->delete()):
            return back()->with('message', 'Elemento elminado con exito')->with('typealert','success');
        endif;
    }
}
