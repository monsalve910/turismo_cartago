<x-app-layout>
    <div class="max-w-6xl mx-auto">

        {{-- MENSAJES --}}
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Mis Reservas</h2>
                <p class="text-gray-500 mt-1">Gestiona tus reservaciones de tours</p>
            </div>

            <a href="{{ route('tours.index') }}"
                class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold">
                Explorar Tours
            </a>
        </div>

        @if($reservas && $reservas->count() > 0)
        <div class="grid gap-6">
            @foreach($reservas as $reserva)

            @php
            $status = strtolower(trim($reserva->status));
            @endphp

            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                    {{-- INFO --}}
                    <div class="flex items-center gap-4">
                        @if($reserva->tour && $reserva->tour->imagen)
                        <img src="{{ asset('storage/' . $reserva->tour->imagen) }}"
                            class="w-20 h-20 rounded-xl object-cover">
                        @else
                        <div class="w-20 h-20 rounded-xl bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500 text-sm">Sin imagen</span>
                        </div>
                        @endif

                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">
                                {{ $reserva->tour->nombre ?? 'Tour no disponible' }}
                            </h3>

                            <div class="text-sm text-gray-500 mt-1">
                                📅 {{ \Carbon\Carbon::parse($reserva->fecha_reservacion)->format('d/m/Y') }}
                            </div>

                            @if($reserva->tour)
                            <div class="text-sm text-gray-500">
                                💰 ${{ number_format($reserva->tour->precio, 0, ',', '.') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- STATUS + ACCIONES --}}
                    <div class="flex items-center gap-4">

                        {{-- ESTADO --}}
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    @if($status == 'pendiente') bg-yellow-100 text-yellow-700
                                    @elseif($status == 'aprobado') bg-green-100 text-green-700
                                    @elseif($status == 'cancelado') bg-red-100 text-red-700
                                    @elseif($status == 'finalizado') bg-blue-100 text-blue-700
                                    @else bg-gray-100 text-gray-700
                                    @endif">

                            @if($status == 'pendiente') Pendiente
                            @elseif($status == 'aprobada') Aprobada
                            @elseif($status == 'cancelada') Cancelada
                            @elseif($status == 'finalizada') Finalizada
                            @endif

                        </span>

                        {{-- BOTÓN CANCELAR --}}
                        @if($status === 'pendiente')
                        <form action="{{ route('reservaciones.cancelar', $reserva->id) }}"
                            method="POST"
                            onsubmit="return confirm('¿Cancelar reserva?')">

                            @csrf
                            @method('POST') {{--  clave para tu controller --}}

                            <button type="submit"
                                class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Cancelar
                            </button>
                        </form>
                        @endif

                    </div>

                </div>
            </div>

            @endforeach
        </div>

        {{-- PAGINACIÓN --}}
        @if(method_exists($reservas, 'links'))
        <div class="mt-8">
            {{ $reservas->links() }}
        </div>
        @endif

        @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-2">No tienes reservas aún</h3>
            <p class="text-gray-500 mb-6">Explora nuestros tours y reserva tu próxima aventura</p>

            <a href="{{ route('tours.index') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                Ver Tours Disponibles
            </a>
        </div>
        @endif

    </div>
</x-app-layout>