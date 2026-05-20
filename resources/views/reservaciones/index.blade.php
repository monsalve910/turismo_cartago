<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis Reservas
            </h2>
            <a href="{{ route('tours.index') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition font-semibold text-sm">
                Explorar Tours
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
                <div class="flex items-center justify-between">
                    <p>{{ session('success') }}</p>
                    <button @click="show = false" class="text-green-600 hover:text-green-800">&times;</button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-4xl mx-auto mb-6 bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded-r-lg">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-4xl mx-auto mb-6 bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded-r-lg">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($reservas && $reservas->count() > 0)
            <div class="max-w-4xl mx-auto space-y-4">
                @foreach($reservas as $reserva)
                    @php
                        $tourDate = \Carbon\Carbon::parse($reserva->tour->fecha);
                        $daysUntilTour = now()->startOfDay()->diffInDays($tourDate, false);
                        $puedeCancelar = in_array($reserva->status, ['pendiente', 'aprobada']) && $daysUntilTour >= 2;
                    @endphp
                    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                        <div class="flex items-start gap-4">
                            @if($reserva->tour->imagen)
                                <img src="{{ asset('storage/' . $reserva->tour->imagen) }}" alt="{{ $reserva->tour->nombre }}" class="w-24 h-24 object-cover rounded-xl">
                            @else
                                <div class="w-24 h-24 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($reserva->tour->nombre, 0, 2)) }}
                                </div>
                            @endif

                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $reserva->tour->nombre }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $reserva->fecha_reservacion ? $reserva->fecha_reservacion->format('d/m/Y') : 'Fecha no disponible' }}
                                        </p>
                                    </div>
                                    @php
                                      $statusClasses = match($reserva->status) {
                                      'pendiente' => 'bg-yellow-100 text-yellow-700',
                                        'aprobada' => 'bg-green-100 text-green-700',
                                        'iniciada' => 'bg-cyan-100 text-cyan-700',
                                        'finalizada' => 'bg-blue-100 text-blue-700',
                                        default => 'bg-red-100 text-red-700',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                    {{ ucfirst($reserva->status) }}
                                </span>
                                </div>
                                <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
                                    <span>{{ $reserva->cantidad_personas }} persona(s)</span>
                                    <span>COP ${{ number_format($reserva->tour->precio, 0, ',', '.') }}</span>
                                </div>
                                @if($puedeCancelar)
                                    <div class="mt-3 flex items-center gap-3">
                                        <form action="{{ route('reservaciones.cancelar', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reservación?')">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium border border-red-300 px-3 py-1.5 rounded-lg hover:bg-red-50 transition">
                                                Cancelar Reservación
                                            </button>
                                        </form>
                                        <span class="text-xs text-gray-400">Puedes cancelar hasta {{ $tourDate->subDays(2)->format('d/m/Y') }}</span>
                                    </div>
                                @elseif($reserva->status === 'aprobada' && $daysUntilTour < 2 && $daysUntilTour >= 0)
                                    <p class="mt-2 text-xs text-red-500">Ya no puedes cancelar esta reservación (menos de 2 días de anticipación).</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                @if(method_exists($reservas, 'links'))
                    <div class="mt-8">
                        {{ $reservas->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">No tienes reservaciones</h3>
                    <p class="text-gray-500 mb-6">Explora los tours disponibles y haz tu primera reservación.</p>
                    <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        Explorar Tours
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
