<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorías de Turismo
            </h2>
            <a href="{{ route('admin.categorias.create') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Categoría
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        @if($categorias && $categorias->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">ID</th>
                                <th class="p-4 font-semibold text-gray-700">Nombre</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Tours Asociados</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($categorias as $categoria)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-gray-500">#{{ $categoria->id }}</td>
                                    <td class="p-4">
                                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $categoria->name }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center text-gray-600">
                                        {{ $categoria->tours ? $categoria->tours->count() : 0 }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('admin.categorias.edit', $categoria) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('¿Eliminar categoría? Esto podría afectar a los tours asociados.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">
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
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No hay categorías registradas</h3>
                <p class="text-gray-500 mb-6">Comienza creando tu primera categoría de turismo</p>
                <a href="{{ route('admin.categorias.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Primera Categoría
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
