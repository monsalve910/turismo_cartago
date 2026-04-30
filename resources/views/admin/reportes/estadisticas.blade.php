<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.reportes.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estadísticas</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-emerald-500">
                <p class="text-gray-500 text-sm font-medium">Total Tours</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalTours ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                <p class="text-gray-500 text-sm font-medium">Total Reservas</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalReservas ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">
                <p class="text-gray-500 text-sm font-medium">Total Usuarios</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsuarios ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-amber-500">
                <p class="text-gray-500 text-sm font-medium">Reservas Pendientes</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendientes ?? 0 }}</p>
            </div>
        </div>

        @if(isset($reservasPorEstado) && $reservasPorEstado->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Reservas por Estado</h3>
                <div class="space-y-4">
                    @php $maxEstado = $reservasPorEstado->max('total') ?? 1; @endphp
                    @foreach($reservasPorEstado as $item)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ ucfirst($item->estado ?? 'Sin estado') }}</span>
                                <span class="text-sm font-medium text-gray-700">{{ $item->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="h-3 rounded-full transition-all
                                    @if($item->estado == 'pendiente') bg-yellow-500
                                    @elseif($item->estado == 'aprobada') bg-green-500
                                    @elseif($item->estado == 'cancelada') bg-red-500
                                    @elseif($item->estado == 'finalizada') bg-blue-500
                                    @else bg-gray-500
                                    @endif"
                                    style="width: {{ $item->total / $maxEstado * 100 }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(isset($reservasPorCategoria) && $reservasPorCategoria->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Reservas por Categoría</h3>
                <div class="space-y-4">
                    @php $maxCat = $reservasPorCategoria->max('total') ?? 1; @endphp
                    @foreach($reservasPorCategoria as $item)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $item->categoria ?? 'Sin categoría' }}</span>
                                <span class="text-sm font-medium text-gray-700">{{ $item->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-emerald-600 h-3 rounded-full" style="width: {{ $item->total / $maxCat * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
