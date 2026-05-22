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
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($tour->fecha)->format('d/m/Y') }} � ${{ number_format($tour->precio, 0, ',', '.') }} � {{ $tour->capacidad }} cupos</p>
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
                        <select name="tour_id" id="tour-select" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
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
                    <label class="block text-gray-700 font-semibold mb-2">Numero de Personas</label>
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
                   @if(isset($tour))
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Fecha del Tour
        </label>

        <div class="w-full rounded-lg bg-gray-100 p-3 text-gray-700">
            {{ \Carbon\Carbon::parse($tour->fecha)->format('d/m/Y') }}
        </div>
    </div>
@endif
                </div>

                @if(isset($tour) && $tour->horarios && $tour->horarios->count() > 0)
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Horario del Tour</label>
                    <select name="hora_tour" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                        <option value="">Seleccione un horario...</option>
                        @foreach($tour->horarios as $horario)
                            <option value="{{ $horario->hora }}">{{ \Carbon\Carbon::parse($horario->hora)->format("H:i") }}</option>
                        @endforeach
                    </select>
                    @error("hora_tour")
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Comentarios Adicionales (Opcional)</label>
                    <textarea name="comentarios" rows="3"
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                              placeholder="Algun requerimiento especial..."></textarea>
                </div>

                    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="text-sm text-green-800">Tu reservacion sera <strong>aprobada</strong></p>
                        </div>
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

    @if(!isset($tour))
    <script>
        document.getElementById("tour-select")?.addEventListener("change", function() {
            if (this.value) {
                window.location.href = "{{ route('reservaciones.create') }}?tour_id=" + this.value;
            }
        });
    </script>
    @endif
</x-app-layout>
