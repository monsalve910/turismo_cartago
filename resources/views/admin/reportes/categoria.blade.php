<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.reportes.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reporte por Categoría: {{ $categoria->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-emerald-500">
                <p class="text-gray-500 text-sm font-medium">Total Tours</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $tours->count() }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                <p class="text-gray-500 text-sm font-medium">Precio Promedio</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    ${{ $tours->count() > 0 ? number_format($tours->avg('precio'), 0, ',', '.') : '0' }}
                </p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">
                <p class="text-gray-500 text-sm font-medium">Capacidad Total</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $tours->sum('capacidad') }}</p>
            </div>
        </div>

        @if($tours->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Listado de Tours</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">Nombre</th>
                                <th class="p-4 font-semibold text-gray-700">Precio</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Capacidad</th>
                                <th class="p-4 font-semibold text-gray-700">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($tours as $tour)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-medium text-gray-800">{{ $tour->nombre }}</td>
                                    <td class="p-4 text-emerald-600 font-semibold">${{ number_format($tour->precio, 0, ',', '.') }}</td>
                                    <td class="p-4 text-center text-gray-600">{{ $tour->capacidad }}</td>
                                    <td class="p-4 text-gray-600">{{ $tour->fecha }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 font-semibold">
                            <tr>
                                <td class="p-4">Totales</td>
                                <td class="p-4 text-emerald-600">Prom: ${{ number_format($tours->avg('precio'), 0, ',', '.') }}</td>
                                <td class="p-4 text-center">{{ $tours->sum('capacidad') }}</td>
                                <td class="p-4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 text-lg">No hay tours en esta categoría.</p>
            </div>
        @endif
    </div>
</x-app-layout>
