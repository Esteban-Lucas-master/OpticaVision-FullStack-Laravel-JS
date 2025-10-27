<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        // Get all purchases with related data for admin dashboard
        $purchases = Purchase::with(['buyer', 'product', 'product.seller'])
            ->latest('purchased_at')
            ->get();

        return view('admin.dashboard', compact('purchases'));
    }
}