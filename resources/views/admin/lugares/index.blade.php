<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de Lugares
            </h2>
            <a href="{{ route('admin.lugares.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition font-semibold text-sm">
                + Crear Lugar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        @if($lugares && $lugares->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">Nombre</th>
                                <th class="p-4 font-semibold text-gray-700">Descripción</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($lugares as $lugar)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-semibold text-gray-800">{{ $lugar->nombre }}</td>
                                    <td class="p-4 text-gray-600 text-sm">{{ Str::limit($lugar->descripcion, 60) }}</td>
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.lugares.edit', $lugar->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Editar</a>
                                            <x-confirm message="¿Eliminar este lugar?">
                                            <form action="{{ route('admin.lugares.destroy', $lugar->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Eliminar</button>
                                            </form>
                                            </x-confirm>
                                        </div>
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
