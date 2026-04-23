<x-app-layout>
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">Crear Nuevo Tour</h2>

        <form action="{{ route('tours.store') }}" method="POST"
            class="bg-white p-6 rounded-xl shadow">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nombre del Tour</label>
                <input type="text" name="nombre" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Descripción</label>
                <textarea name="descripcion" required rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 mt-1"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 mt-1">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Capacidad (Cupos)</label>
                    <input type="number" name="capacidad" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 mt-1">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium">Fecha</label>
                    <input type="date" name="fecha" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 mt-1">
                </div>
                <div>
                    <div class="mb-4">
    <label class="block text-gray-700 font-medium">Categoría</label>
    <select name="categoria_id" required
        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 mt-1">
        <option value="">Seleccione una categoría...</option>
        
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
        @endforeach
        
    </select>
</div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                    Guardar Tour
                </button>
                <a href="{{ route('tours.index') }}"
                    class="inline-flex items-center px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                     Volver
                </a>
            </div>

        </form>
    </div>
</x-app-layout>