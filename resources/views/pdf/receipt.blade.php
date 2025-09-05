<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo de compra</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .box { border:1px solid #ddd; padding:16px; border-radius:8px; }
        .row { margin:8px 0; }
        .label { width:180px; display:inline-block; font-weight:bold; }
    </style>
</head>
<body>
    <h2>Recibo de compra</h2>
    <div class="box">
        <div class="row"><span class="label">Cliente:</span> {{ $user->name }}</div>
        <div class="row"><span class="label">Producto:</span> {{ $product->name }}</div>
        <div class="row"><span class="label">Precio:</span> ${{ number_format($product->price, 2) }}</div>
        <div class="row"><span class="label">Fecha:</span> {{ $purchase->purchased_at->format('Y-m-d H:i:s') }}</div>
        <div class="row"><span class="label">ID de compra:</span> {{ $purchase->id }}</div>
    </div>
</body>
</html>
