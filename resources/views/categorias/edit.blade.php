<x-app-layout>
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Editar Categoría: {{ $categoria->name }}</h2>

        <form action="{{ route('categorias.update', $categoria) }}" method="POST" 
              class="bg-white p-6 rounded-xl shadow border border-gray-100">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-700 font-medium">Nombre de la Categoría</label>
                <input type="text" name="name" value="{{ $categoria->name }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
            </div>

            <div class="flex items-center gap-3 border-t pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold shadow">
                    Actualizar Categoría
                </button>
                <a href="{{ route('categorias.index') }}"
                    class="inline-flex items-center px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                     Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>