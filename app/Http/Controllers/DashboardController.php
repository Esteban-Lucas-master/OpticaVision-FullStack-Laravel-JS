<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['user','product'])
                             ->latest('purchased_at')
                             ->get();

        return view('dashboard', compact('purchases'));
    }
}
