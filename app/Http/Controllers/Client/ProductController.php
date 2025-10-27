<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::with('images')->where('on_offer', false)->get();
        $offers = Product::with('images')->where('on_offer', true)->get();

        return view('welcome', compact('products', 'offers'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('show', compact('product'));
    }
}