<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestión de Reservas</h2>
                <p class="text-sm text-gray-500">Administra todas las reservas del sistema</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">

        <!-- Stats Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">

                <div class="flex gap-2 flex-wrap">
                    <a href="{{ route('admin.reservaciones.index') }}" class="px-4 py-2 rounded-lg font-medium transition
                        @if(!request('status')) bg-emerald-600 text-white @else text-gray-600 hover:bg-gray-100 @endif">
                        Todas
                    </a>

                    <a href="{{ route('admin.reservaciones.index', ['status' => 'pendiente']) }}" class="px-4 py-2 rounded-lg font-medium transition
                        @if(request('status') == 'pendiente') bg-yellow-500 text-white @else text-gray-600 hover:bg-gray-100 @endif">
                        Pendientes
                    </a>

                    <a href="{{ route('admin.reservaciones.index', ['status' => 'aprobada']) }}" class="px-4 py-2 rounded-lg font-medium transition
                        @if(request('status') == 'aprobada') bg-green-500 text-white @else text-gray-600 hover:bg-gray-100 @endif">
                        Aprobadas
                    </a>

                    <a href="{{ route('admin.reservaciones.index', ['status' => 'cancelada']) }}" class="px-4 py-2 rounded-lg font-medium transition
                        @if(request('status') == 'cancelada') bg-red-500 text-white @else text-gray-600 hover:bg-gray-100 @endif">
                        Canceladas
                    </a>
                </div>

                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pendientes: {{ $pendientes ?? 0 }}
                </span>

            </div>
        </div>

        @if($reservas && $reservas->count() > 0)

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="p-4 font-semibold text-gray-700">Cliente</th>
                            <th class="p-4 font-semibold text-gray-700">Tour</th>
                            <th class="p-4 font-semibold text-gray-700">Fecha</th>
                            <th class="p-4 font-semibold text-gray-700">Personas</th>
                            <th class="p-4 font-semibold text-gray-700">Estado</th>
                            <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach($reservas as $reserva)

                        @php
                        $status = strtolower(trim($reserva->status ?? ''));
                        @endphp

                        <tr class="hover:bg-gray-50 transition group">

                            <!-- CLIENTE -->
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr($reserva->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800 text-sm">{{ $reserva->user->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $reserva->user->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- TOUR -->
                            <td class="p-4">
                                <p class="font-medium text-gray-800 text-sm">{{ $reserva->tour->nombre ?? 'N/A' }}</p>
                                @if($reserva->tour)
                                <p class="text-xs text-gray-500">${{ number_format($reserva->tour->precio, 0, ',', '.') }}</p>
                                @endif
                            </td>

                            <!-- FECHA -->
                            <td class="p-4 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($reserva->fecha_reservacion ?? $reserva->created_at)->format('d/m/Y') }}
                            </td>

                            <!-- PERSONAS -->
                            <td class="p-4 text-sm text-gray-600">
                                <span class="bg-gray-100 px-2 py-1 rounded">
                                    {{ $reserva->cantidad_personas ?? 1 }} personas
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if($status == 'pendiente') bg-yellow-100 text-yellow-700
                                            @elseif($status == 'aprobada') bg-green-100 text-green-700
                                            @elseif($status == 'cancelada') bg-red-100 text-red-700
                                            @elseif($status == 'finalizada') bg-blue-100 text-blue-700
                                            @else bg-gray-100 text-gray-700
                                            @endif">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <!-- ACCIONES -->
                            <td class="p-4">
                                <div class="flex justify-center gap-3">

                                    @if($status == 'pendiente')

                                    <form action="{{ route('admin.reservaciones.aprobar', $reserva->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center gap-1">
                                            Aprobar
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.reservaciones.cancelar', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center gap-1">
                                            Cancelar
                                        </button>
                                    </form>

                                    @endif

                                    @if($status == 'aprobada')

                                    <form action="{{ route('admin.reservaciones.finalizar', $reserva->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                                            Finalizar
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

            @if(method_exists($reservas, 'links'))
            <div class="p-4 border-t border-gray-200">
                {{ $reservas->links() }}
            </div>
            @endif

        </div>

        @else

        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <p class="text-gray-500 text-lg">No hay reservas que coincidan con el filtro.</p>
        </div>

        @endif

    </div>
</x-app-layout>