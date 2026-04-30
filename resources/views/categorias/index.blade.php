<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Categorías de Tours</h2>
            <p class="text-gray-500 mt-1">Explora tours organizados por categoría</p>
        </div>

        @if($categorias && $categorias->count() > 0)
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($categorias as $categoria)
                    <a href="{{ route('categorias.show', $categoria) }}" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition group">
                        <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $categoria->name }}</h3>
                        <p class="text-gray-500 text-sm">
                            {{ $categoria->tours ? $categoria->tours->count() : 0 }} tours disponibles
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <p class="text-gray-500 text-lg">No hay categorías disponibles.</p>
            </div>
        @endif
    </div>
</x-app-layout>
