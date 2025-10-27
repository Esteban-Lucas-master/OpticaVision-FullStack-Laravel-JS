<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\BaseController;
use App\Models\Purchase;
use App\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchaseController extends BaseController
{
    protected $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        $purchases = $this->purchaseService->getSellerPurchases(auth()->id());
        return view('seller.historial', compact('purchases'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $data = $request->json()->all();

        if (!isset($data['status']) || !in_array($data['status'], ['aceptada', 'rechazada'])) {
            return response()->json(['success' => false, 'message' => 'Estado inválido']);
        }

        // Ensure the seller can only update their own purchases
        if (auth()->id() !== $purchase->product->seller_id) {
            return response()->json(['success' => false, 'message' => 'No autorizado'], 403);
        }

        $this->purchaseService->updatePurchaseStatus($purchase, $data['status']);

        return response()->json(['success' => true]);
    }
}