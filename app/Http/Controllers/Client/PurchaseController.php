<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Services\PurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends BaseController
{
    protected $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function store(Product $product, Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        $result = $this->purchaseService->createPurchase($product);
        return response()->json($result);
    }

    public function notifications()
    {
        $user = auth()->user();
        $purchases = $this->purchaseService->getUserNotifications($user->id);

        $data = $purchases->map(function ($purchase) {
            return [
                'product_name' => $purchase->product->name,
                'status'       => $purchase->status,
                'purchased_at' => $purchase->updated_at->toDateTimeString(),
            ];
        });

        return response()->json($data);
    }

    public function notificationStatus(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['count' => 0]);
        }

        $user = auth()->user();
        $lastChecked = $request->input('since');
        
        $count = $this->purchaseService->getUserNotificationCount($user->id, $lastChecked);

        return response()->json(['count' => $count]);
    }
}