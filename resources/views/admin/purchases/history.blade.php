
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <x-app-layout>
    <x-slot name="header">
        <nav class="bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                <h1 class="text-xl font-bold text-white">Dashboard de Administrador</h1>
                </div>
                <div class="flex space-x-4">
                <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center transition-colors">
                    <i class="fas fa-eye mr-2"></i> Vista Pública
                </a>
                    <a href="{{ route('admin.usuarios') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-blue-400 transition-colors duration-200 border-b-2 border-transparent hover:border-blue-500">
                   <i class="fas fa-users mr-1"></i> Gestionar Usuarios
                    </a>
                    <a href="{{ route('admin.purchases.history') }}" 
                   class="px-4 py-2 text-sm font-medium text-blue-400 transition-colors duration-200 border-b-2 border-blue-500">
                   <i class="fas fa-history mr-1"></i> Historial de Compras
                    </a>
                </div>
            </div>
        </div>
    </nav>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Alerta de éxito para cuando se limpia el historial --}}
        @if (session('success'))
            <div class="bg-green-600 text-white p-4 rounded-lg mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Cabecera con título y botones de acción --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-white">Historial de Compras</h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.purchases.download.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center transition-colors" style="height: 40px;">
                    <i class="fas fa-file-pdf mr-2"></i> Descargar PDF
                </a>
                <a href="{{ route('admin.purchases.download.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center transition-colors" style="height: 40px;">
                    <i class="fas fa-file-excel mr-2"></i> Descargar Excel
                </a>
                <form action="{{ route('admin.purchases.clear') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar todo el historial? Esta acción no se puede deshacer.');">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 flex items-center transition-colors">
                        <i class="fas fa-trash mr-2"></i> Limpiar Historial
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-600 table-auto text-white">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Producto</th>
                        <th class="px-4 py-2 text-left">Comprador</th>
                        <th class="px-4 py-2 text-left">Vendedor</th>
                        <th class="px-4 py-2 text-left">Fecha</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @forelse($purchases as $purchase)
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $purchase->product->name }}</td>
                        <td class="px-4 py-2">{{ $purchase->buyer->name }}</td>
                        <td class="px-4 py-2">{{ $purchase->seller->name ?? 'Sin asignar' }}</td>
                        <td class="px-4 py-2">{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2">{{ ucfirst($purchase->status ?? 'pendiente') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-400">
                            No hay compras registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
