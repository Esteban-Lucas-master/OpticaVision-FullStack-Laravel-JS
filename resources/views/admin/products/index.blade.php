<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<style>
    th, td {

        color: white
    }
    th{
        border 2px solid white;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }
</style>
<body>
    <x-app-layout>

     <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-white" style="color: white">Vendedor</h1>
                </div>
                <div class="flex items-center space-x-4">
                     <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center transition-colors">
                    <i class="fas fa-eye mr-2"></i> Vista Pública
                </a>
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 border-b-2 border-transparent hover:border-blue-600">
                        <i class="fas fa-plus-circle mr-1"></i> Crear Producto
                    </a>
                    <a href="{{ route('seller.purchases') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 border-b-2 border-transparent hover:border-blue-600">
                        <i class="fas fa-history mr-1"></i> Historial de Compras
                    </a>
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 border-b-2 border-transparent hover:border-blue-600">
                        <i class="fas fa-cogs mr-1"></i> Gestionar Productos
                    </a>
                </div>
            </div>
        </div>
    </nav>

        <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Descripción</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Oferta</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="divide-y divide-gray-200 dark:divide-gray-700">
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->description }}</td>
                                <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-2">{{ $product->on_offer ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                           Editar
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product) }}" 
                                              method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">No hay productos aún</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
