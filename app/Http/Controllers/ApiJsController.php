<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config, Auth;
use App\Http\Models\Product;
use App\Http\Models\Favorite;
use App\Http\Models\Inventory;
use App\Http\Models\Category;

class ApiJsController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except(['getProductsSection']);
    }
    function getProductsSection($section, Request $request){
        $items_x_page = Config::get('tienda.products_page');
        switch ($section):
            case 'home':
                $products = Product::where('status' , 1)->inRandomOrder()->paginate($items_x_page);
                break;

            case 'store':
                $products = Product::where('status' , 1)->orderBy('id', 'Desc')->paginate($items_x_page);
                break;

            case 'store_category':
                $products = $this->getProductCategory($request->get('object_id'), $items_x_page);
                break;

            default:
                $products = Product::where('status' , 1)->inRandomOrder()->paginate($items_x_page);
               break;
            endswitch;

            return $products;
}

public function getProductCategory($id,$ipp){
    $category = Category::find($id);
    if($category->parent == "0"):
        $query = Product::where('status' , 1)->where('category_id',$id)->orderBy('id', 'Desc')->paginate($ipp);
    else:
        $query = Product::where('status' , 1)->where('subcategory_id',$id)->orderBy('id', 'Desc')->paginate($ipp);
    endif;
    return $query;
}

    function postFavoriteAdd($object, $module, Request $request){
        $query = Favorite::where('user_id', Auth::id())->where('module', $module)->where('object_id',$object)->count();
        if($query > 0):
            $data = ['status' => 'error' , 'msg' => 'este producto ya se encuentra en la lista de deseados'];
        else:
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->module = $module;
            $favorite->object_id = $object;
            if($favorite->save()):
                $data = ['status' => 'success' , 'msg' => 'se ha agregado a la lista de deseados'];
            endif;
        endif;

        return response()->json($data);

        //if(is_null($object))
        //return response()->json([$object, $module]);

    }
    public function postUserFavorites(Request $request){
        $query = Favorite::where('user_id', Auth::id())->where
        ('module', $request->input('moudle'))->
        whereIn('object_id',explode(",", $request->input('objects')))->pluck('object_id');
        return response()->json($query);
        if(count(collect($query))>0):
            $data = ['status' => 'success' , 'count' => count(collect($query)), 'objects' => $query];
        else:
            $data = ['status' => 'success' , 'count' => count(collect($query)), 'objects' => $query];
        endif;
        return response()->json($request->input($data));
    }
    public function postProductInventoryVariants($id){
        $query = Inventory::find($id);
        return response()->json($query->getVariants);
    }
}
