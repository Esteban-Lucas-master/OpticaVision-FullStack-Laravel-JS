{{-- resources/views/products/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header" style="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="color: white">
            Editar Producto
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6" style="background-color: #1F2937; color: white">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium">Nombre</label>
                        <input type="text" name="name" id="name"
                               value="{{ $product->name }}"
                               class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium">Precio</label>
                        <input type="number" name="price" id="price"
                               value="{{ $product->price }}"
                               step="0.01"
                               class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium">Descripción</label>
                        <textarea name="description" id="description"
                                  class="w-full border rounded p-2"
                                  rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-4">
    <label for="on_offer" class="block text-sm font-medium">¿Está en oferta?</label>
    <select name="on_offer" id="on_offer" class="w-full border rounded p-2">
        <option value="0" {{ $product->on_offer == 0 ? 'selected' : '' }}>No</option>
        <option value="1" {{ $product->on_offer == 1 ? 'selected' : '' }}>Sí</option>
    </select>
</div>


                    <div class="flex justify-end">
                        <button type="submit" style="background-color: rgb(19, 149, 71)"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    select, textarea, input {
    background-color: #374151 !important; /* Forzar el fondo */
    color: white !important;
    border: 1px solid #4B5563 !important;
}

</style>
