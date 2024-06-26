<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use App\Http\Models\Product;
use App\Http\Models\Pgallery;
use App\Http\Models\Inventory;
use App\Http\Models\Variant;

use Parsedown;
use Validator, Str, Config, Image;

class ProductController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');

    }

    public function getHome($status)
    {
        switch($status){
            case '0':
                $products = Product::with(['cat','getSubcategory', 'getPrice'])->where('status','0')->orderBy('id', 'desc')->paginate(25);
                break;
            case '1':
                $products = Product::with(['cat','getSubcategory', 'getPrice'])->where('status','1')->orderBy('id', 'desc')->paginate(25);
                break;
            case 'all':
                $products = Product::with(['cat','getSubcategory', 'getPrice'])->orderBy('id', 'desc')->paginate(25);
                break;
            case 'trash':
                $products = Product::with(['cat','getSubcategory', 'getPrice'])->onlyTrashed()->orderBy('id', 'desc')->paginate(25);
                break;
        }
        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    //Funcion para agregar productos a la BD
    public function getProductAdd()
    {

        $cats = Category::where('module', '0')->where('parent','0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(request $request)
    {
        $rules = [
            'name' => 'required',
            'img' => 'required|image',
            'content' => 'required',
        ];

        $messages = [
            'name.required' => 'Nombre obligatorio',
            'img.required' => 'Seleccione una imagen destacada',
            'img.image' => 'Archivo no valido',
            'content.required' => 'Ingrese la descripcion del producto'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                ->withInput();
        else:
            $path = '/' . date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename = rand(1, 99999) . '-' . $name . '.' . $fileExt;
            $final_file = $upload_path . '/' . $path . '/' . $filename;

            $product = new Product;
            $product->status = '0';
            $product->sku =e($request->input('sku'));
            $product->name = e($request->input('name'));
            $product->sku = e($request->input('sku'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->subcategory_id = $request->input('subcategory');
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->indiscount = $request->input("indiscount");
            $product->discount = $request->input("discount");
            $product->content = $request->input("content");

            if ($product->save()):
                if ($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $filename);

                endif;
                return redirect('/admin/products/all')->with('message', 'Guardado con exito')->with('typealert', 'success');
            endif;

        endif;
    }
    public function getProductEdit($id)
    {
        $p = Product::findOrFail($id);
        $cats = Category::where('module', '0')->where('parent','0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'p'=> $p];
        return view('admin.products.edit', $data);

    }
    public function postProductEdit($id , Request $request){
        $rules = [
            'name' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'name.required' => 'Nombre obligatorio',
            'img.image' => 'Archivo no valido',
            'content.required' => 'Ingrese la descripcion del producto'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                ->withInput();
        else:

            $product =  Product::findOrFail($id);
            $ipp = $product->file_path;
            $ip = $product->image;
            $product->status = $request->input('status');
            $product->sku =e($request->input('sku'));
            $product->name = e($request->input('name'));
            //$product->sku = e($request->input('sku'));
            //$product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->subcategory_id = $request->input('subcategory');

            if ($request->hasFile('img')):
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
                $filename = rand(1, 99999) . '-' . $name . '.' . $fileExt;
                $final_file = $upload_path . '/' . $path . '/' . $filename;

                $product->file_path = date('Y-m-d');
                $product->image = $filename;
            endif;

            $product->indiscount = $request->input("indiscount");
            $product->discount = $request->input("discount");
            $product->content = $request->input("content");

            if ($product->save()):

                $this->getUpdateMinPrice($product->id);
                if ($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                //return back()->with('message', 'Actualizado con exito')->with('typealert', 'success');
                return redirect('/admin/product/'.$product->id.'/edit')->with('message', 'Actualizado con exito con exito')->with('typealert', 'success');
            endif;

        endif;
    }

    public function postProductGalleryAdd($id, Request $request){
        $rules = [
            'file_image' => 'required'
        ];

        $messages = [
            'file_image.required' => 'Imagen obligatoria'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                ->withInput();
        else:
            if ($request->hasFile('file_image')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));
                $filename = rand(1, 99999) . '-' . $name . '.' . $fileExt;
                $final_file = $upload_path . '/' . $path . '/' . $filename;
                $g = new Pgallery;
                $g->product_id = $id;
                $g->file_path = date('Y-m-d');
                $g->file_name = $filename;

                if ($g->save()):
                    if ($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function ($constraint) {
                            $constraint->upsize();
                        });
                        $img->save($upload_path . '/' . $path . '/t_' . $filename);
                    endif;
                return back()->with('message', 'Imagen guardada con exito con exito')->with('typealert', 'success');
            endif;
        endif;
    endif;
    }

    function getProductGalleryDelete($id,$gid){
        $g = Pgallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->product_id != $id){
            return back()->with('message', 'Imagen no se puede eliminar')->with('typealert', 'danger');
        }else{
            if($g->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                return back()->with('message', 'Imagen eliminada con exito')->with('typealert', 'success');
            endif;
        }
    }

   public function postProductSearch(Request $request){
    $rules = [
        'search' => 'required',

    ];

    $messages = [
        'search.required' => 'Ingrese un parametro de busqueda',
     ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()):
        return redirect('/admin/products/1')->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
            ->withInput();
    else:
        switch ($request->input('filter')):
        case '0':
            $products = Product::with(['cat'])->where('name', 'LIKE','%'.$request->input('search').'%')
            ->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
        break;
        case '1':
            $products = Product::with(['cat'])->where('sku' , $request->input('search'))->orderBy('id', 'desc')->get();
        break;
        endswitch;

        $data = ['products' => $products];
        return view('admin.products.search', $data);
        endif;


   }
   public function getProductDelete($id){
    $p = Product::findOrFail($id);

    if($p->delete()):
        return back()->with('message', 'Producto enviado a la papelera con exito')->with('typealert', 'success');
            endif;
   }
   public function getProductRestore($id){
    $p = Product::onlyTrashed()->where('id', $id)->first();

    if($p->restore()):
        return redirect('/admin/product/'.$p->id.'/edit')->with('message', 'Producto restaurado con exito')->with('typealert', 'success');
            endif;
   }
   public function show($id)
   {
       $product = Product::findOrFail($id);

       // Convertir Markdown a HTML usando Parsedown
       $parsedown = new Parsedown();
       $product->content = $parsedown->text($product->content);

       return view('product.product_single', compact('product'));
   }

   public function getProductInventory($id){
        $product = Product::findOrFail($id);
        $data = ['product' => $product];
        return view('admin.products.inventory', $data);
}
public function postProductInventory( Request $request ,$id){
    $rules = [
        'name' => 'required',
        'price' => 'required',
    ];

    $messages = [
        'name.required' => 'Nombre obligatorio',
        'price.required' => 'Precio obligatorio',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
            ->withInput();
    else:
        $inventory = new Inventory;
        $inventory->product_id = $id;
        $inventory->name = $request->input('name');
        $inventory->quantity = $request->input('quantity');
        $inventory->price = $request->input('price');
        $inventory->limited = $request->input('limited');
        $inventory->minimum = $request->input('minimum');

        if ($inventory->save()):
            $this->getUpdateMinPrice($inventory->product_id);
        return back()->with('message', 'Cambios guardados con exito')->with('typealert', 'success');
    endif;
    endif;

}
    public function getProductInventoryEdit($id){
        $inventory = Inventory::findOrFail($id);
        $data = ['inventory' => $inventory];
        return view('admin.products.inventory_edit', $data);
    }

    public function postProductInventoryEdit($id, Request $request){
        $rules = [
            'name' => 'required',
            'price' => 'required',
        ];

        $messages = [
            'name.required' => 'Nombre obligatorio',
            'price.required' => 'Precio obligatorio',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                ->withInput();
        else:
            $inventory = Inventory::find($id);
            $inventory->name = $request->input('name');
            $inventory->quantity = $request->input('quantity');
            $inventory->price = $request->input('price');
            $inventory->limited = $request->input('limited');
            $inventory->minimum = $request->input('minimum');

            if ($inventory->save()):
                $this->getUpdateMinPrice($inventory->product_id);
            return back()->with('message', 'Cambios guardados con exito')->with('typealert', 'success');
        endif;
        endif;
    }
    public function getProductInventoryDelete($id){
        $inventory = Inventory::findOrFail($id);
        if ($inventory->delete()):
            $this->getUpdateMinPrice($inventory->product_id);
            return back()->with('message','Inventario eliminado')->with('typealert','success');
            endif;

        }

        public function postProductInventoryVariantAdd($id, Request $request){
            $rules = [
                'name' => 'required',
            ];

            $messages = [
                'name.required' => 'Nombre obligatorio',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()):
                return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')
                    ->withInput();
            else:
                $inventory = Inventory::findOrFail($id);
                $variant = new Variant;
                $variant->product_id = $inventory->product_id;
                $variant->inventory_id = $id;
                $variant->name = e($request->input('name'));

                if ($variant->save()):
                return back()->with('message', 'Cambios guardados con exito')->with('typealert', 'success');
            endif;
            endif;
        }
        public function getProductInventoryVariantDelete($id){
            $variant = Variant::findOrFail($id);
            if ($variant->delete()):
                return back()->with('message','Variante eliminada')->with('typealert','success');
                endif;

            }
        public function getUpdateMinPrice($id){
            $product = Product::find($id);
            $price = $product->getPrice->min('price');
            $product->price = $price !== null ? $price : 0;
            $product->save();
        }

}


