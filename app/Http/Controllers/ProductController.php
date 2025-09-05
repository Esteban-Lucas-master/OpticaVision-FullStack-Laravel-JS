<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductHistory;

class ProductController extends Controller
{
    // ======================
    // Vista pública (welcome)
    // ======================
    public function index()
    {
        $products = Product::with('images')->where('on_offer', false)->get();
        $offers = Product::with('images')->where('on_offer', true)->get();

        return view('welcome', compact('products', 'offers'));
    }

    // ======================
    // Dashboard del vendedor
    // ======================
    public function dashboard()
    {
        // Puedes cargar info específica del vendedor si quieres
        return view('admin.dashboard'); // ❌ Antes estaba view('welcome')
    }

    // ======================
    // Listado de productos para admin/vendedor
    // ======================
    public function adminIndex()
{
    $products = Product::with('images')
        ->where('seller_id', auth()->id()) // ✅ Solo productos del vendedor actual
        ->paginate(10);

    return view('admin.products.index', compact('products'));
}

    // ======================
    // Historial de productos
    // ======================
    public function historial()
{
    $history = ProductHistory::with('product')->latest()->paginate(10);
    return view('admin.products.historial', compact('history'));
}


    // ======================
    // Mostrar un producto
    // ======================
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('show', compact('product'));
    }

    // ======================
    // Crear producto
    // ======================
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

        $product = Product::create([
    'name' => $request->name,
    'description' => $request->description,
    'price' => $request->price,
    'on_offer' => $request->has('on_offer'),
    'seller_id' => auth()->id(), // ✅ Asociar con el vendedor autenticado
]);


        // Guardar imágenes
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $count = 0;
            foreach ($files as $file) {
                if ($count >= 4) break;
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
                $count++;
            }
        }

        return redirect()->back()->with('success', 'Producto creado correctamente');
    }

    // ======================
    // Editar producto
    // ======================
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'on_offer' => 'nullable|boolean',
        ]);

        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'on_offer' => $request->input('on_offer'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente');
    }

    // ======================
    // Notificaciones (API)
    // ======================
    public function publicNotifications() {
    // Trae los últimos 5 productos
    $products = Product::latest()->take(5)->get(['id', 'name', 'created_at']);
    return response()->json($products);
}

}
