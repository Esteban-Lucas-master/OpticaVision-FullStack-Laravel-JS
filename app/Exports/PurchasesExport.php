<?php

namespace App\Exports;

use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchasesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Purchase::with(['user', 'product', 'product.seller'])->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Compra',
            'Producto',
            'Comprador',
            'Email Comprador',
            'Vendedor',
            'Fecha de Compra',
            'Estado',
        ];
    }

    /**
     * @param mixed $purchase
     *
     * @return array
     */
    public function map($purchase): array
    {
        return [
            $purchase->id,
            $purchase->product->name,
            $purchase->user->name,
            $purchase->user->email,
            $purchase->product->seller->name ?? 'N/A',
            $purchase->created_at->format('d/m/Y H:i'),
            ucfirst($purchase->status),
        ];
    }
}

