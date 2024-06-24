<?php

namespace App\Http\Controllers;
use App\Http\Models\Product;
use Illuminate\Http\Request;
use Parsedown;

class ProductController extends Controller
{
    public function getProduct($id, $slug){
        $product = Product::findOrFail($id);
        $data = ['product' => $product];
        return view('product.product_single', $data);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Convertir Markdown a HTML usando Parsedown
        $parsedown = new Parsedown();
        $product->content = $parsedown->text($product->content);

        return view('product.product_single', compact('product'));
    }
}
