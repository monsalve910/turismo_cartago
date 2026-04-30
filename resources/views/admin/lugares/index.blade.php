<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de Lugares
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <p class="text-gray-600">Los lugares se gestionan dentro de cada ruta turística.</p>
            <a href="{{ route('admin.rutas.index') }}" class="inline-flex items-center gap-2 mt-4 bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                Ir a Rutas para gestionar lugares
            </a>
        </div>

        @if($lugares && $lugares->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">Nombre</th>
                                <th class="p-4 font-semibold text-gray-700">Descripción</th>
                                <th class="p-4 font-semibold text-gray-700">Ruta</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Orden</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($lugares as $lugar)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-semibold text-gray-800">{{ $lugar->nombre }}</td>
                                    <td class="p-4 text-gray-600 text-sm">{{ Str::limit($lugar->descripcion, 60) }}</td>
                                    <td class="p-4">
                                        @if($lugar->ruta)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                {{ $lugar->ruta->nombre }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            #{{ $lugar->orden }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                <p class="text-gray-500 text-lg">No hay lugares registrados.</p>
            </div>
        @endif
    </div>
</x-app-layout>
