<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PurchaseService
{
    /**
     * Create a new purchase
     *
     * @param Product $product
     * @return array
     */
    public function createPurchase(Product $product)
    {
        $user = Auth::user();

        // Create the purchase with pending status
        $purchase = Purchase::create([
            'buyer_id'     => $user->id,
            'product_id'   => $product->id,
            'seller_id'    => $product->seller_id,
            'status'       => 'pendiente',
            'purchased_at' => now(),
        ]);

        // Generate the receipt PDF
        $pdf = $this->generateReceiptPdf($user, $product, $purchase);

        // Save the PDF to storage
        $pdfPath = 'receipts/receipt_' . $purchase->id . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        return [
            'success' => true,
            'pdf_url' => asset('storage/' . $pdfPath),
            'message' => 'Compra registrada, pendiente de aprobación del vendedor.'
        ];
    }

    /**
     * Generate receipt PDF
     *
     * @param mixed $user
     * @param Product $product
     * @param Purchase $purchase
     * @return \Barryvdh\DomPDF\PDF
     */
    protected function generateReceiptPdf($user, Product $product, Purchase $purchase)
    {
        return Pdf::loadView('pdf.receipt', [
            'user'     => $user,
            'product'  => $product,
            'purchase' => $purchase,
        ]);
    }

    /**
     * Update purchase status
     *
     * @param Purchase $purchase
     * @param string $status
     * @return bool
     */
    public function updatePurchaseStatus(Purchase $purchase, string $status)
    {
        if (!in_array($status, ['aceptada', 'rechazada'])) {
            return false;
        }

        $purchase->status = $status;
        return $purchase->save();
    }

    /**
     * Get purchases for a specific seller
     *
     * @param int $sellerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSellerPurchases(int $sellerId)
    {
        return Purchase::with(['buyer', 'product'])
            ->whereHas('product', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->where('status', 'pendiente')
            ->orderBy('purchased_at', 'desc')
            ->get();
    }

    /**
     * Get all purchases for admin
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPurchases()
    {
        return Purchase::with(['buyer', 'product', 'product.seller'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get user notifications
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserNotifications(int $userId, int $limit = 5)
    {
        return Purchase::where('buyer_id', $userId)
            ->latest('updated_at')
            ->take($limit)
            ->with('product')
            ->get();
    }

    /**
     * Get user notification count
     *
     * @param int $userId
     * @param string|null $since
     * @return int
     */
    public function getUserNotificationCount(int $userId, string $since = null)
    {
        $query = Purchase::where('buyer_id', $userId)
            ->where('status', '!=', 'pendiente');

        if ($since) {
            try {
                $query->where('updated_at', '>', new \DateTime($since));
            } catch (\Exception $e) {
                // If date parsing fails, return 0
                return 0;
            }
        }

        return $query->count();
    }
}