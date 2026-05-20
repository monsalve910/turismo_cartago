<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel del Guía Turístico
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
            <h3 class="text-2xl font-bold mb-2">¡Bienvenido, {{ auth()->user()->name }}!</h3>
            <p class="text-amber-100">Gestiona tus tours asignados y registra el progreso de cada salida.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pendientes</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendientes }}</p>
                    </div>
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-cyan-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">En Curso</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $enCurso }}</p>
                    </div>
                    <div class="w-14 h-14 bg-cyan-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-emerald-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Finalizados</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $finalizados }}</p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        @if($reservaciones && $reservaciones->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">Cliente</th>
                                <th class="p-4 font-semibold text-gray-700">Tour</th>
                                <th class="p-4 font-semibold text-gray-700">Personas</th>
                                <th class="p-4 font-semibold text-gray-700">Fecha</th>
                                <th class="p-4 font-semibold text-gray-700">Hora</th>
                                <th class="p-4 font-semibold text-gray-700">Estado</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($reservaciones as $reserva)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($reserva->user->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800 text-sm">{{ $reserva->user->name ?? 'N/A' }}</p>
                                                <p class="text-xs text-gray-500">{{ $reserva->user->email ?? '' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <p class="font-medium text-gray-800 text-sm">{{ $reserva->tour->nombre ?? 'N/A' }}</p>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-sm text-gray-600">
                                            {{ $reserva->cantidad_personas }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $reserva->fecha_tour ? \Carbon\Carbon::parse($reserva->fecha_tour)->format('d/m/Y') : \Carbon\Carbon::parse($reserva->fecha_reservacion)->format('d/m/Y') }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $reserva->hora_tour ? \Carbon\Carbon::parse($reserva->hora_tour)->format('H:i') : '---' }}
                                    </td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if($reserva->status == 'pendiente') bg-yellow-100 text-yellow-700
                                            @elseif($reserva->status == 'aprobada') bg-green-100 text-green-700
                                            @elseif($reserva->status == 'iniciada') bg-cyan-100 text-cyan-700
                                            @elseif($reserva->status == 'finalizada') bg-emerald-100 text-emerald-700
                                            @elseif($reserva->status == 'cancelada') bg-red-100 text-red-700
                                            @else bg-gray-100 text-gray-700
                                            @endif">
                                            {{ ucfirst($reserva->status) }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex justify-center gap-2">
                                            @if($reserva->status == 'aprobada')
                                                <form action="{{ route('guia.reservaciones.iniciar', $reserva->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-cyan-600 text-white px-4 py-1.5 rounded-lg hover:bg-cyan-700 transition text-sm font-medium">
                                                        Iniciar Tour
                                                    </button>
                                                </form>
                                            @endif

                                            @if($reserva->status == 'iniciada')
                                                <form action="{{ route('guia.reservaciones.finalizar', $reserva->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-emerald-600 text-white px-4 py-1.5 rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                                                        Finalizar Tour
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(method_exists($reservaciones, 'links'))
                    <div class="p-4 border-t border-gray-200">
                        {{ $reservaciones->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No tienes tours pendientes</h3>
                <p class="text-gray-500">Cuando te asignen un tour, aparecerá aquí.</p>
            </div>
        @endif
    </div>
</x-app-layout>
