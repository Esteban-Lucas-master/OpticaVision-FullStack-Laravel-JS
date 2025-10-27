<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <nav class="bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <h1 class="text-xl font-bold text-white">Dashboard</h1>
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
                       class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-blue-400 transition-colors duration-200">
                       <i class="fas fa-users mr-1"></i> Historial de Compras
                    </a>
                </div>
            </div>
        </div>
    </nav>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            @isset($usuarios)
                <!-- Gestión de usuarios -->
                <h2 class="text-2xl font-semibold mb-6 text-white">Gestión de Usuarios</h2>
                <table class="min-w-full divide-y divide-gray-600 table-auto text-white">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Rol</th>
                            <th class="px-4 py-2 text-left">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @foreach($usuarios as $u)
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $u->name }}</td>
                            <td class="px-4 py-2">{{ $u->email }}</td>
                            <td class="px-4 py-2">{{ $u->rol }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('admin.cambiarRol', $u->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="rol" class="bg-gray-700 text-white border border-gray-600 px-2 py-1 rounded">
                                        <option value="cliente" {{ $u->rol=='cliente' ? 'selected' : '' }}>Cliente</option>
                                        <option value="vendedor" {{ $u->rol=='vendedor' ? 'selected' : '' }}>Vendedor</option>
                                        <option value="admin" {{ $u->rol=='admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="submit" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endisset
        </div>
    </div>
</x-app-layout>
