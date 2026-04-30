<x-app-layout>
    @section('title', 'Turismo Cartago - Descubre el Valle del Cauca')

    @isset($tours)
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-emerald-600 via-teal-600 to-green-700 text-white py-24 px-4 overflow-hidden -mx-4 sm:-mx-6 lg:-mx-8 -mt-8">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 border-4 border-white rounded-full"></div>
                <div class="absolute bottom-10 right-10 w-48 h-48 border-4 border-white rounded-full"></div>
                <div class="absolute top-1/2 left-1/3 w-24 h-24 border-4 border-white rounded-full"></div>
            </div>
            <div class="max-w-7xl mx-auto relative z-10 text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Descubre Cartago</h1>
                <p class="text-xl md:text-2xl mb-8 text-emerald-100 max-w-3xl mx-auto">
                    Vive experiencias únicas en el corazón del Valle del Cauca. Tours, rutas y lugares mágicos te esperan.
                </p>
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('tours.index') }}" class="bg-white text-emerald-700 px-8 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition shadow-lg">
                        Ver Tours Disponibles
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-emerald-700 transition">
                            Únete Ahora
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Featured Tours Section -->
        <section class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Tours Destacados</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Explora nuestra selección de tours diseñados para descubrir la belleza de Cartago y sus alrededores.</p>
            </div>

            @if($tours->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($tours->take(6) as $tour)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition group">
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
                                <div class="flex justify-between items-center">
                                    <div class="text-emerald-600 font-bold text-lg">
                                        ${{ number_format($tour->precio, 0, ',', '.') }}
                                    </div>
                                    <div class="text-gray-500 text-sm">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($tour->fecha)->format('d/m/Y') }}
                                    </div>
                                </div>
                                <a href="{{ route('tours.show', $tour) }}" class="mt-4 block w-full text-center bg-emerald-600 text-white py-2 rounded-lg hover:bg-emerald-700 transition font-medium">
                                    Ver Detalles
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-2 bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-900 transition font-medium">
                        Ver Todos los Tours
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4-4m0 0l-4-4m4 4H3"/>
                        </svg>
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-500 text-lg">No hay tours disponibles en este momento.</p>
                </div>
            @endif
        </section>
    @endisset
</x-app-layout>
