<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
            <h3 class="text-2xl font-bold mb-2">¡Bienvenido, {{ auth()->user()->name }}!</h3>
            <p class="text-emerald-100">Explora nuestros tours y vive experiencias únicas en Cartago, Valle del Cauca.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Mis Reservas</h3>
                <a href="{{ route('tours.index') }}" class="text-emerald-600 hover:text-emerald-800 font-medium text-sm">
                    Ver Tours Disponibles →
                </a>
            </div>

            @if(isset($misReservas) && $misReservas->count() > 0)
                <div class="grid gap-4">
                    @foreach($misReservas->take(5) as $reserva)
                        <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $reserva->tour->nombre ?? 'Tour no disponible' }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($reserva->fecha_reservacion)->format('d/m/Y') }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($reserva->estado == 'pendiente') bg-yellow-100 text-yellow-700
                                    @elseif($reserva->estado == 'aprobada') bg-green-100 text-green-700
                                    @elseif($reserva->estado == 'cancelada') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-700
                                    @endif">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($misReservas->count() > 5)
                    <div class="mt-4 text-center">
                        <a href="{{ route('reservaciones.misReservas', auth()->id()) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">
                            Ver todas mis reservas →
                        </a>
                    </div>
                @endif
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500">No tienes reservas aún.</p>
                    <a href="{{ route('tours.index') }}" class="inline-block mt-4 bg-emerald-600 text-white px-6 py-2 rounded-lg hover:bg-emerald-700 transition font-medium">
                        Explorar Tours
                    </a>
                </div>
            @endif
        </div>

        @if(isset($availableTours) && $availableTours->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Tours Disponibles</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach($availableTours->take(3) as $tour)
                        <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition">
                            @if($tour->imagen)
                                <img src="{{ asset('storage/' . $tour->imagen) }}" alt="{{ $tour->nombre }}" class="w-full h-32 object-cover">
                            @else
                                <div class="w-full h-32 bg-gradient-to-br from-emerald-400 to-teal-500"></div>
                            @endif
                            <div class="p-4">
                                <h4 class="font-bold text-gray-800 mb-2">{{ $tour->nombre }}</h4>
                                <div class="flex justify-between items-center">
                                    <span class="text-emerald-600 font-bold">${{ number_format($tour->precio, 0, ',', '.') }}</span>
                                    <a href="{{ route('tours.show', $tour->id) }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium">
                                        Ver detalles →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
