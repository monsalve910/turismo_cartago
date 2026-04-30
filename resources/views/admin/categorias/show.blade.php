<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categorias.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $categoria->name }}</h2>
                <p class="text-sm text-gray-500">Detalles de la categoría</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-800">{{ $categoria->name }}</h1>
                                    <p class="text-gray-500 mt-1">{{ $categoria->tours ? $categoria->tours->count() : 0 }} tours en esta categoría</p>
                                </div>
                            </div>
                            <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">
                                #{{ $categoria->id }}
                            </span>
                        </div>

                        @if($categoria->tours && $categoria->tours->count() > 0)
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Tours asociados</h3>
                                <div class="space-y-3">
                                    @foreach($categoria->tours as $tour)
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                                            @if($tour->imagen)
                                                <img src="{{ asset('storage/' . $tour->imagen) }}" alt="{{ $tour->nombre }}" class="w-12 h-12 object-cover rounded-lg">
                                            @else
                                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-800">{{ $tour->nombre }}</p>
                                                <p class="text-sm text-gray-500">${{ number_format($tour->precio, 0, ',', '.') }}</p>
                                            </div>
                                            <a href="{{ route('admin.tours.edit', $tour) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium opacity-0 group-hover:opacity-100 transition">
                                                Editar
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Acciones</h4>
                        <div class="space-y-3">
                            <a href="{{ route('admin.categorias.edit', $categoria) }}" class="block w-full text-center bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
                                Editar Categoría
                            </a>
                            <a href="{{ route('admin.categorias.index') }}" class="block w-full text-center bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                                Volver al Listado
                            </a>
                        </div>
                    </div>

                    <div class="bg-amber-50 rounded-2xl p-6 border border-amber-100">
                        <h4 class="text-lg font-bold text-amber-800 mb-2">Información</h4>
                        <p class="text-sm text-amber-700 mb-4">Categoría creada el {{ $categoria->created_at ? $categoria->created_at->format('d/m/Y') : 'N/A' }}</p>
                        <p class="text-sm text-amber-600">Desde aquí puedes gestionar los tours que pertenecen a esta categoría.</p>
                    </div>

                    <div class="bg-red-50 rounded-2xl p-6 border border-red-100">
                        <h4 class="text-lg font-bold text-red-800 mb-2">Zona de Peligro</h4>
                        <p class="text-sm text-red-600 mb-4">Esta acción eliminará permanentemente la categoría.</p>
                        <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" onsubmit="return confirm('¿ESTÁS SEGURO de eliminar esta categoría? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white py-2.5 rounded-xl hover:bg-red-700 transition font-semibold">
                                Eliminar Categoría
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
