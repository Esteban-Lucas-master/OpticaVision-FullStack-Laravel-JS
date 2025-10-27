<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getSellerProducts(auth()->id());
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'nullable|array|max:4',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp,webp,svg,tiff,heic,heif|max:5120',
            'on_offer' => 'nullable|boolean',
        ]);

        $this->productService->createProduct($data);

        return redirect()->back()->with('success', 'Producto creado correctamente');
    }

    public function edit(Product $product)
    {
        // Ensure the seller can only edit their own products
        if ($product->seller_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este producto');
        }

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Ensure the seller can only update their own products
        if ($product->seller_id !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar este producto');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'on_offer' => 'nullable|boolean',
        ]);

        $this->productService->updateProduct($product, $data);

        return redirect()->route('seller.products.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        // Ensure the seller can only delete their own products
        if ($product->seller_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este producto');
        }

        $this->productService->deleteProduct($product);
        return redirect()->route('seller.products.index')->with('success', 'Producto eliminado correctamente');
    }

    public function history()
    {
        $history = $this->productService->getSellerProductHistory(auth()->id());
        return view('admin.products.historial', compact('history'));
    }
}