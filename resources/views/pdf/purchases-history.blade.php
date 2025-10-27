<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Compras</title>
<style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; font-weight: bold; }
    h1 { text-align: center; }
</style>
</head>
<body>
    <h1>Historial de Compras</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Comprador</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchases as $purchase)
            <tr>
                <td>{{ $purchase->product->name }}</td>
                <td>{{ $purchase->buyer->name }}</td>
                <td>{{ $purchase->seller->name ?? 'Sin asignar' }}</td>
                <td>{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ ucfirst($purchase->status ?? 'pendiente') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No hay compras registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>