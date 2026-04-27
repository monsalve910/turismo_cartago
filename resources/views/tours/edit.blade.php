<x-app-layout>
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Editar Tour: {{ $tour->nombre }}</h2>

        <form action="{{ route('tours.update', $tour) }}" method="POST" 
              class="bg-white p-6 rounded-xl shadow border border-gray-100">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nombre del Tour</label>
                <input type="text" name="nombre" value="{{ $tour->nombre }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Descripción</label>
                <textarea name="descripcion" rows="3" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">{{ $tour->descripcion }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" value="{{ $tour->precio }}" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Capacidad</label>
                    <input type="number" name="capacidad" value="{{ $tour->capacidad }}" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium">Fecha</label>
                    <input type="date" name="fecha" value="{{ $tour->fecha }}" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Categoría</label>
                    <select name="categoria_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 mt-1">
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ $tour->categoria_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-3 border-t pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold shadow">
                    Actualizar Tour
                </button>
                <a href="{{ route('tours.index') }}"
                    class="inline-flex items-center px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                     Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>