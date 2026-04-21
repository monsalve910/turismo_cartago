<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">

        <div class="bg-white p-6 rounded-xl shadow mb-6">
            <h2 class="text-2xl font-bold">{{ $ruta->nombre }}</h2>
            <p class="text-gray-600 mt-2">{{ $ruta->descripcion }}</p>
        </div>

        <h3 class="text-xl font-semibold mb-3">Lugares</h3>

        @foreach($ruta->lugares as $lugar)
        <div class="bg-gray-100 p-3 rounded mb-2 flex items-center gap-4">

            @if($lugar->imagen)
            <img src="{{ asset('storage/' . $lugar->imagen) }}"
                class="w-16 h-16 object-cover rounded-lg">
            @endif

            <div>
                <strong>{{ $lugar->orden }}</strong> - {{ $lugar->nombre }}
            </div>

        </div>
        @endforeach

    </div>
    <div>
        <a href="{{ route('rutas.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
             Volver
        </a>
    </div>

</x-app-layout>