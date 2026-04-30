<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rutas Turísticas
            </h2>
            <a href="{{ route('admin.rutas.create') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Crear Ruta
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        @if($rutas && $rutas->count() > 0)
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($rutas as $ruta)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition group">
                        <div class="bg-gradient-to-br from-blue-400 to-teal-500 h-32 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $ruta->nombre }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $ruta->descripcion }}</p>
                            <p class="text-xs text-gray-500 mb-4">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $ruta->lugares ? $ruta->lugares->count() : 0 }} lugares
                            </p>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.rutas.show', $ruta->id) }}" class="flex-1 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                                    Ver
                                </a>
                                <a href="{{ route('admin.rutas.edit', $ruta->id) }}" class="flex-1 text-center bg-amber-500 text-white py-2 rounded-lg hover:bg-amber-600 transition font-medium text-sm">
                                    Editar
                                </a>
                                <form action="{{ route('admin.rutas.destroy', $ruta->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta ruta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition font-medium text-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(method_exists($rutas, 'links'))
                <div class="mt-8">
                    {{ $rutas->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No hay rutas registradas</h3>
                <p class="text-gray-500 mb-6">Comienza creando tu primera ruta turística</p>
                <a href="{{ route('admin.rutas.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Primera Ruta
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
