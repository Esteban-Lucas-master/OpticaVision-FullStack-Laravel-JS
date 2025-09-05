<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<style>
    select, textarea, input {
    background-color: #374151 !important; /* Forzar el fondo */
    color: white !important;
    border: 1px solid #4B5563 !important;
}

</style>

<body class="bg-gray-100 dark:bg-gray-900">
    <!-- Navbar común para todos los archivos -->


    <!-- Archivo: crear.html -->
    <x-app-layout>
        <nav class="bg-white dark:bg-gray-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Dashboard a la izquierda -->
            <div class="flex-shrink-0">
                <h1 class="text-xl font-bold text-gray-800 dark:text-white" style="color: white">Vendedor</h1>
            </div>

            <!-- Enlaces a la derecha -->
            <div class="flex space-x-6">
                
                    <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center transition-colors">
                    <i class="fas fa-eye mr-2"></i> Vista Pública
                </a>
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 border-b-2 border-transparent hover:border-blue-600">
                    <i class="fas fa-plus-circle mr-1"></i> Crear Producto
                </a>
                <a href="{{ route('seller.purchases') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 border-b-2 border-transparent hover:border-blue-600">
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



        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Formulario de productos --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h2 class="text-lg font-semibold mb-4" style="color: white">Agregar Producto</h2>
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" placeholder="Nombre" required class="mb-2 w-full p-2 border rounded"><br>
                    <textarea name="description" placeholder="Descripción" required class="mb-2 w-full p-2 border rounded"></textarea><br>
                    <input type="number" step="0.01" name="price" placeholder="Precio" required class="mb-2 w-full p-2 border rounded"><br>

                    <label style="color: white">Imágenes (máx. 4):</label>
                    <input style="color: white"
                        type="file" 
                        name="images[]" 
                        multiple 
                        accept="image/*" 
                        class="mb-4"
                        onchange="validateFiles(this)"
                    ><br>
                    <label style="color: white">
                        <input type="checkbox" name="on_offer" value="1"> Oferta
                    </label><br><br>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar Producto</button>
                </form>
            </div>
        </div>
        
        <script>
            function validateFiles(input) {
                if (input.files.length > 4) {
                    alert("Solo puedes subir un máximo de 4 imágenes.");
                    input.value = ""; // Limpia el campo
                }
            }
        </script>
    </x-app-layout>

    <!-- Archivo: historial.html -->
    

    <!-- Archivo: gestionar.html -->
</body>
</html>