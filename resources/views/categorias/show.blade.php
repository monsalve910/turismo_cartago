<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('categorias.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-800 font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Categorías
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-4 mb-4">
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
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tours disponibles</h2>

        @if($categoria->tours && $categoria->tours->count() > 0)
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($categoria->tours as $tour)
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
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $tour->nombre }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $tour->descripcion }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-emerald-600 font-bold text-lg">${{ number_format($tour->precio, 0, ',', '.') }}</span>
                                <a href="{{ route('tours.show', $tour) }}" class="text-emerald-600 hover:text-emerald-800 font-medium text-sm">Ver detalles →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 text-lg">No hay tours en esta categoría aún.</p>
                <a href="{{ route('tours.index') }}" class="inline-block mt-4 text-emerald-600 hover:text-emerald-800 font-medium">Ver todos los tours →</a>
            </div>
        @endif
    </div>
</x-app-layout>
