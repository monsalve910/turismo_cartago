<x-app-layout>
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-800 font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Reservar Tour</h2>
                <p class="text-gray-500 mt-1">Completa los datos para reservar tu tour</p>
            </div>

            @if(isset($tour))
                <div class="bg-emerald-50 rounded-xl p-4 mb-6 flex items-center gap-4">
                    @if($tour->imagen)
                        <img src="{{ asset('storage/' . $tour->imagen) }}" alt="{{ $tour->nombre }}" class="w-16 h-16 rounded-lg object-cover">
                    @endif
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $tour->nombre }}</h3>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($tour->fecha)->format('d/m/Y') }} · ${{ number_format($tour->precio, 0, ',', '.') }} · {{ $tour->capacidad }} cupos</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('reservaciones.store') }}" method="POST" class="space-y-5">
                @csrf

                @if(isset($tour))
                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                @else
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Seleccionar Tour</label>
                        <select name="tour_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            <option value="">Elige un tour...</option>
                            @foreach($tours as $t)
                                <option value="{{ $t->id }}">{{ $t->nombre }} - ${{ number_format($t->precio, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                        @error('tour_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Número de Personas</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <input type="number" name="numero_personas" min="1" max="{{ $tour->capacidad ?? 10 }}" required
                               class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                               placeholder="Cantidad de personas">
                    </div>
                    @error('numero_personas')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Fecha Preferida</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="date" name="fecha" required
                               class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                               min="{{ date('Y-m-d') }}">
                    </div>
                    @error('fecha')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Comentarios Adicionales (Opcional)</label>
                    <textarea name="comentarios" rows="3"
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                              placeholder="Algún requerimiento especial..."></textarea>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-blue-800">Tu reserva será revisada por un administrador y recibirás una confirmación pronto.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        Confirmar Reserva
                    </button>
                    <a href="{{ route('tours.index') }}" class="flex-1 text-center bg-gray-800 text-white py-2.5 px-6 rounded-lg hover:bg-gray-900 transition font-semibold">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
