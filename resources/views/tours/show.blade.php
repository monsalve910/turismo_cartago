<x-app-layout>
    <div class="max-w-6xl mx-auto">

        @if(isset($tour))

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">

            <!-- IMAGEN -->
            <div class="w-full h-64 md:h-96 bg-gradient-to-br from-emerald-400 to-teal-500 relative">
                @if($tour->imagen)
                <img src="{{ asset('storage/' . $tour->imagen) }}"
                    class="w-full h-full object-cover">
                @endif

                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end">
                    <div class="p-8 text-white">
                        <h1 class="text-4xl font-bold mb-2">
                            {{ $tour->nombre }}
                        </h1>

                        @if($tour->categoria)
                        <span class="bg-white bg-opacity-20 px-4 py-1 rounded-full text-sm">
                            {{ $tour->categoria->name }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="p-8">

                <div class="grid md:grid-cols-3 gap-8">

                    <!-- IZQUIERDA -->
                    <div class="md:col-span-2">

                        <!-- DESCRIPCIÓN -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">
                            Descripción
                        </h2>

                        <p class="text-gray-600 mb-6">
                            {{ $tour->descripcion }}
                        </p>

                        <!-- ================= RUTAS ================= -->
                        @if($tour->rutas && $tour->rutas->count() > 0)

                        <div class="mt-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                Rutas del tour
                            </h3>

                            <div class="flex flex-wrap gap-2">
                                @foreach($tour->rutas as $ruta)
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $ruta->nombre }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        @endif

                        <!-- ================= LUGARES ================= -->
                        @if($tour->rutas && $tour->rutas->count() > 0)

                        <div class="mt-8">

                            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                                Lugares del recorrido
                            </h2>

                            @foreach($tour->rutas as $ruta)

                            <div class="mb-6">

                                <h3 class="text-lg font-semibold text-emerald-600 mb-3">
                                    {{ $ruta->nombre }}
                                </h3>

                                @if($ruta->lugares && $ruta->lugares->count() > 0)

                                <div class="space-y-4">

                                    @foreach($ruta->lugares->sortBy('orden') as $lugar)

                                    <div class="flex gap-4 bg-gray-50 p-4 rounded-xl">

                                        @if($lugar->imagen)
                                        <img src="{{ asset('storage/' . $lugar->imagen) }}"
                                            class="w-20 h-20 object-cover rounded-lg">
                                        @else
                                        <div class="w-20 h-20 bg-emerald-100 rounded-lg"></div>
                                        @endif

                                        <div>

                                            <h4 class="font-bold text-gray-800">
                                                {{ $lugar->nombre }}
                                            </h4>

                                            <p class="text-sm text-gray-600">
                                                {{ $lugar->descripcion }}
                                            </p>

                                            <span class="text-xs text-gray-400">
                                                Orden: {{ $lugar->orden }}
                                            </span>

                                        </div>

                                    </div>

                                    @endforeach

                                </div>

                                @else
                                <p class="text-sm text-gray-400">
                                    No hay lugares en esta ruta
                                </p>
                                @endif

                            </div>

                            @endforeach

                        </div>

                        @endif

                        <!-- ================= COMENTARIOS ================= -->
                        <div class="border-t pt-6 mt-8">

                            <h3 class="text-xl font-bold text-gray-800 mb-4">
                                Comentarios
                            </h3>

                            @auth
                            <form action="{{ route('comentarios.store') }}" method="POST"
                                class="mb-6 bg-gray-50 p-4 rounded-xl">

                                @csrf
                                <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                                <textarea name="comentario" rows="3" required
                                    class="w-full border-gray-300 rounded-lg p-3 mb-3"
                                    placeholder="Escribe tu comentario..."></textarea>

                                <div class="flex justify-between items-center">

                                    <div class="flex gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button"
                                            class="star-btn text-2xl text-gray-300 hover:text-yellow-400"
                                            data-rating="{{ $i }}">
                                            ★
                                            </button>
                                            @endfor

                                            <input type="hidden" name="calificacion" id="rating-value">
                                    </div>

                                    <button type="submit"
                                        class="bg-emerald-600 text-white px-6 py-2 rounded-lg">
                                        Enviar
                                    </button>
                                </div>
                            </form>

                            <script>
                                document.querySelectorAll('.star-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        let rating = this.dataset.rating;
                                        document.getElementById('rating-value').value = rating;

                                        document.querySelectorAll('.star-btn').forEach((star, i) => {
                                            star.classList.toggle('text-yellow-400', i < rating);
                                            star.classList.toggle('text-gray-300', i >= rating);
                                        });
                                    });
                                });
                            </script>
                            @else
                            <p class="text-gray-500 mb-6">
                                Inicia sesión para comentar
                            </p>
                            @endauth

                            @if($tour->comentarios && $tour->comentarios->count() > 0)

                            @foreach($tour->comentarios as $comentario)

                            <div class="bg-gray-50 p-4 rounded-xl mb-3">

                                <div class="flex justify-between">
                                    <p class="font-semibold">
                                        {{ $comentario->user->name ?? 'Anónimo' }}
                                    </p>

                                    <div class="text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            {!! $i <=$comentario->calificacion ? '★' : '<span class="text-gray-300">★</span>' !!}
                                            @endfor
                                    </div>
                                </div>

                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $comentario->comentario }}
                                </p>

                            </div>

                            @endforeach

                            @else
                            <p class="text-gray-500">
                                No hay comentarios aún.
                            </p>
                            @endif

                        </div>

                    </div>

                    <!-- SIDEBAR -->
                    <div>

                        <div class="bg-gray-50 rounded-xl p-6 sticky top-24">

                            <p class="text-gray-500 text-sm">Precio</p>
                            <p class="text-4xl font-bold text-emerald-600 mb-4">
                                ${{ number_format($tour->precio, 0, ',', '.') }}
                            </p>

                            <p class="text-sm text-gray-500">Fecha</p>
                            <p class="font-semibold mb-4">
                                {{ \Carbon\Carbon::parse($tour->fecha)->format('d/m/Y') }}
                            </p>

                            <p class="text-sm text-gray-500">Capacidad</p>
                            <p class="font-semibold mb-6">
                                {{ $tour->capacidad }} personas
                            </p>

                            @auth
                            <a href="{{ route('reservaciones.create') }}?tour_id={{ $tour->id }}"
                                class="block text-center bg-emerald-600 text-white py-3 rounded-lg">
                                Reservar
                            </a>
                            @else
                            <a href="{{ route('login') }}"
                                class="block text-center bg-gray-800 text-white py-3 rounded-lg">
                                Iniciar sesión
                            </a>
                            @endauth

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <a href="{{ route('tours.index') }}" class="text-emerald-600">
            ← Volver a tours
        </a>

        @else
        <p>Tour no encontrado</p>
        @endif

    </div>
</x-app-layout>