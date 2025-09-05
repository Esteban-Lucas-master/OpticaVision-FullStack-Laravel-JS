<?php

namespace App\Http\Controllers;

use App\Exports\PurchasesExport;
use App\Models\Product;
use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    // Registrar compra y generar PDF
    public function store(Product $product, Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        $user = Auth::user();

        // Guardar la compra con estado pendiente
        $purchase = Purchase::create([
            'buyer_id'     => $user->id,
            'product_id'   => $product->id,
            'seller_id'    => $product->seller_id,
            'status'       => 'pendiente',
            'purchased_at' => now(),
        ]);

        // Generar el PDF del recibo
        $pdf = Pdf::loadView('pdf.receipt', [
            'user'     => $user,
            'product'  => $product,
            'purchase' => $purchase,
        ]);

        $pdfPath = 'receipts/receipt_' . $purchase->id . '.pdf';

        // Guardar el PDF en storage/app/public/receipts
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Responder con la URL pública del PDF
        return response()->json([
            'success' => true,
            'pdf_url' => asset('storage/' . $pdfPath),
            'message' => 'Compra registrada, pendiente de aprobación del vendedor.'
        ]);
    }

    // Listado para el administrador o vendedor
    public function index()
    {
        // Trae todas las compras con comprador y producto relacionados
        $purchases = Purchase::with(['buyer', 'product'])
            ->orderBy('purchased_at', 'desc')
            ->get();

        return view('admin.products.historial', compact('purchases'));
    }

    // Actualizar estado de la compra (aceptar o rechazar)
    public function update(Request $request, Purchase $purchase)
    {
        $data = $request->json()->all();

        if (!isset($data['status']) || !in_array($data['status'], ['aceptada', 'rechazada'])) {
            return response()->json(['success' => false, 'message' => 'Estado inválido']);
        }

        if (Auth::id() !== $purchase->product->seller_id) {
            return response()->json(['success' => false, 'message' => 'No autorizado'], 403);
        }

        $purchase->status = $data['status'];
        $purchase->save();

        return response()->json(['success' => true]);
    }

    // Historial de compras pendientes para el vendedor
    public function sellerHistory()
    {
        $user = Auth::user(); // vendedor

        $purchases = Purchase::with(['buyer', 'product'])
            ->whereHas('product', function ($q) use ($user) {
                $q->where('seller_id', $user->id);
            })
            ->where('status', 'pendiente')
            ->orderBy('purchased_at', 'desc')
            ->get();

        return view('seller.historial', compact('purchases'));
    }

    public function adminPurchasesHistory()
    {
        // Traemos todas las compras con comprador, producto y vendedor
        $purchases = Purchase::with(['buyer', 'product', 'product.seller'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.purchases.history', compact('purchases'));
    }

    public function userNotifications()
    {
        $user = auth()->user();

        $purchases = Purchase::where('buyer_id', $user->id)
            ->latest('updated_at')
            ->take(5)
            ->with('product')
            ->get();

        $data = $purchases->map(function ($purchase) {
            return [
                'product_name' => $purchase->product->name,
                'status'       => $purchase->status,
                'purchased_at' => $purchase->updated_at->toDateTimeString(),
            ];
        });

        return response()->json($data);
    }

    public function userNotificationStatus(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['count' => 0]);
        }

        $user = auth()->user();
        $lastChecked = $request->input('since');

        $query = Purchase::where('buyer_id', $user->id)
            ->where('status', '!=', 'pendiente');

        if ($lastChecked) {
            try {
                $query->where('updated_at', '>', new \DateTime($lastChecked));
            } catch (\Exception $e) {
                return response()->json(['count' => 0]);
            }
        }

        $count = $query->count();

        return response()->json(['count' => $count]);
    }

    public function downloadPdfHistory()
    {
        $purchases = Purchase::with(['buyer', 'product', 'product.seller'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.purchases-history', compact('purchases'));

        return $pdf->download('historial-de-compras.pdf');
    }

    public function downloadExcelHistory()
    {
        return Excel::download(new PurchasesExport, 'historial-de-compras.xlsx');
    }

    public function clearHistory()
    {
        Purchase::truncate();

        return redirect()->route('admin.purchases.history')->with('success', 'Historial de compras eliminado correctamente.');
    }
}
