<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('admin.dashboard');
    }
}