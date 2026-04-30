<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Tours Disponibles</h2>
                <p class="text-gray-500 mt-1">Explora y gestiona los tours en Cartago</p>
            </div>
            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('admin.tours.create') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Nuevo Tour
                </a>
            @endif
        </div>

        @if($tours && $tours->count() > 0)
            <!-- Cards Grid -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                @foreach($tours as $tour)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition group">
                        @if($tour->imagen)
                            <img src="{{ asset('storage/' . $tour->imagen) }}" alt="{{ $tour->nombre }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-800">{{ $tour->nombre }}</h3>
                                @if($tour->categoria)
                                    <span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $tour->categoria->name }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $tour->descripcion }}</p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-emerald-600 font-bold text-xl">
                                    ${{ number_format($tour->precio, 0, ',', '.') }}
                                </div>
                                <div class="text-gray-500 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($tour->fecha)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('tours.show', $tour) }}" class="flex-1 text-center bg-emerald-600 text-white py-2 rounded-lg hover:bg-emerald-700 transition font-medium text-sm">
                                    Ver Detalles
                                </a>
                            @if(auth()->check() && auth()->user()->is_admin)
                                    <a href="{{ route('tours.edit', $tour) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                                        Editar
                                    </a>
                                    <form action="{{ route('tours.destroy', $tour) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este tour?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(method_exists($tours, 'links'))
                <div class="mt-8">
                    {{ $tours->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No hay tours registrados</h3>
                <p class="text-gray-500 mb-6">Comienza creando tu primer tour turístico</p>
                @if(auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('admin.tours.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Crear Primer Tour
                    </a>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
