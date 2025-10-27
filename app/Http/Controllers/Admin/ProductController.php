<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductHistory;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::with('images')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function history()
    {
        $history = ProductHistory::with(['product', 'user'])->latest()->paginate(10);
        return view('admin.products.history', compact('history'));
    }
}