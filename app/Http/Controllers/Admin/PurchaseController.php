<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Exports\PurchasesExport;
use App\Models\Purchase;
use App\Services\PurchaseService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseController extends BaseController
{
    protected $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        $purchases = $this->purchaseService->getAllPurchases();
        return view('admin.purchases.history', compact('purchases'));
    }

    public function downloadPdf()
    {
        $purchases = $this->purchaseService->getAllPurchases();
        $pdf = Pdf::loadView('pdf.purchases-history', compact('purchases'));
        return $pdf->download('historial-de-compras.pdf');
    }

    public function downloadExcel()
    {
        return Excel::download(new PurchasesExport, 'historial-de-compras.xlsx');
    }

    public function clearHistory()
    {
        Purchase::truncate();
        return redirect()->route('admin.purchases.index')->with('success', 'Historial de compras eliminado correctamente.');
    }
}