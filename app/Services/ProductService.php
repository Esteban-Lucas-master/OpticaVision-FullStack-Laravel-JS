<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductService
{
    /**
     * Create a new product with images
     *
     * @param array $data
     * @return Product
     */
    public function createProduct(array $data)
    {
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'on_offer' => $data['on_offer'] ?? false,
            'seller_id' => Auth::id(),
        ]);

        // Save images if provided
        if (isset($data['images']) && is_array($data['images'])) {
            $this->saveProductImages($product, $data['images']);
        }

        // Log product creation in history
        $this->logProductHistory($product, 'created', 'Producto creado');

        return $product;
    }

    /**
     * Update an existing product
     *
     * @param Product $product
     * @param array $data
     * @return Product
     */
    public function updateProduct(Product $product, array $data)
    {
        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'on_offer' => $data['on_offer'] ?? false,
        ]);

        // Log product update in history
        $this->logProductHistory($product, 'updated', 'Producto actualizado');

        return $product;
    }

    /**
     * Delete a product
     *
     * @param Product $product
     * @return bool
     */
    public function deleteProduct(Product $product)
    {
        // Log product deletion in history
        $this->logProductHistory($product, 'deleted', 'Producto eliminado');

        return $product->delete();
    }

    /**
     * Save product images
     *
     * @param Product $product
     * @param array $images
     * @return void
     */
    protected function saveProductImages(Product $product, array $images)
    {
        $count = 0;
        foreach ($images as $image) {
            if ($count >= 4) break;
            
            $path = $image->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $path
            ]);
            $count++;
        }
    }

    /**
     * Log product history
     *
     * @param Product $product
     * @param string $action
     * @param string $details
     * @return ProductHistory
     */
    protected function logProductHistory(Product $product, string $action, string $details)
    {
        return ProductHistory::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'accion' => $action,
            'detalle' => $details,
        ]);
    }

    /**
     * Get products for a specific seller
     *
     * @param int $sellerId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSellerProducts(int $sellerId, int $perPage = 10)
    {
        return Product::with('images')
            ->where('seller_id', $sellerId)
            ->paginate($perPage);
    }

    /**
     * Get product history for a specific seller
     *
     * @param int $sellerId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSellerProductHistory(int $sellerId, int $perPage = 10)
    {
        return ProductHistory::with('product')
            ->whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->latest()
            ->paginate($perPage);
    }
}