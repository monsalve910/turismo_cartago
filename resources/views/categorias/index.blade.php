<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Categorías de Turismo</h2>
            <a href="{{ route('categorias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Nueva Categoría
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 border-b">ID</th>
                        <th class="p-4 border-b">Nombre</th>
                        <th class="p-4 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 border-b text-gray-500">#{{ $categoria->id }}</td>
                            <td class="p-4 border-b font-medium">{{ $categoria->name }}</td>
                            <td class="p-4 border-b text-center">
                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                        Editar
                                    </a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('¿Eliminar categoría? Esto podría afectar a los tours asociados.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>