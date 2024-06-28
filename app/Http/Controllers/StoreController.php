<?php

namespace App\Http\Controllers;
use App\Http\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function getStore(){
        $categories = Category::where('module', '0')->where('parent','0')->orderBy('order', 'Asc')->get();
        $data = ['categories' => $categories];
        return view('store', $data);
    }

    public function getCategory($id, $slug){
        $categoriy = Category::findOrFail($id);
        $categories = Category::where('module', '0')->where('parent', $id)->orderBy('order', 'Asc')->get();
        $data = ['categories' => $categories, 'category' => $categoriy];
        return view('category', $data);
    }
}
