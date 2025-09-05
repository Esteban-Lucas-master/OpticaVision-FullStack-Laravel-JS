<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


    <!-- NAV del dashboard del vendedor -->
    <nav class="bg-white dark:bg-gray-800 shadow-md mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Vendedor</h1>
                <div class="flex items-center space-x-4">
                    <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center transition-colors">
                    <i class="fas fa-eye mr-2"></i> Vista Pública
                </a>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-b-2 border-transparent hover:border-blue-600 transition">
                        <i class="fas fa-plus-circle mr-1"></i> Crear Producto
                    </a>
                    <a href="{{ route('seller.purchases') }}" 
                       class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-b-2 border-transparent hover:border-blue-600 transition">
                        <i class="fas fa-history mr-1"></i> Historial de Compras
                    </a>
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 border-b-2 border-transparent hover:border-blue-600 transition">
                        <i class="fas fa-cogs mr-1"></i> Gestionar Productos
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 text-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-700 table-auto">
    <thead class="bg-gray-700">
        <tr>
            <th class="px-4 py-2 rounded-l-lg">Producto</th>
            <th class="px-4 py-2">Comprador</th>
            <th class="px-4 py-2">Fecha</th>
            <th class="px-4 py-2">Estado</th>
            <th class="px-4 py-2 rounded-r-lg">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($purchases as $purchase)
        <tr class="border-b border-gray-600" data-purchase-id="{{ $purchase->id }}">
            <td class="px-4 py-2">{{ $purchase->product->name }}</td>
            <td class="px-4 py-2">{{ $purchase->buyer->name }}</td>
            <td class="px-4 py-2">{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
            <td class="px-4 py-2 purchase-status">
                {{ $purchase->status ?? 'pendiente' }}
            </td>
            <td class="px-4 py-2 purchase-actions">
                @if($purchase->status === 'pendiente' || is_null($purchase->status))
                <form action="{{ route('purchase.update', $purchase->id) }}" method="POST" class="update-status-form flex gap-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="aceptada" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Aceptar</button>
                    <button type="submit" name="status" value="rechazada" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Rechazar</button>
                </form>
                @else
                    <span class="font-semibold">
                        {{ ucfirst($purchase->status) }}
                    </span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="px-4 py-2 text-center text-gray-300">
                No hay compras pendientes
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>
  <script>
document.querySelectorAll('.update-status-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const status = e.submitter.value;
        const purchaseId = this.closest('tr').getAttribute('data-purchase-id');

        fetch(this.getAttribute('action'), {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                // Actualiza el estado y quita los botones
                const row = document.querySelector(`tr[data-purchase-id="${purchaseId}"]`);
                row.querySelector('.purchase-status').textContent = status.charAt(0).toUpperCase() + status.slice(1);
                row.querySelector('.purchase-actions').innerHTML = `<span class="font-semibold">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
                Swal.fire('Éxito', 'Estado actualizado', 'success');
            } else {
                Swal.fire('Error', data.message || 'Ocurrió un error', 'error');
            }
        })
        .catch(err => Swal.fire('Error', err.message, 'error'));
    });
});
</script>


</x-app-layout>
