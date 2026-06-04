<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Guías Turísticos
            </h2>
            <a href="{{ route('admin.guias.create') }}"
               class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Guía
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        @if($guias && $guias->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">Nombre</th>
                                <th class="p-4 font-semibold text-gray-700">Correo</th>
                                <th class="p-4 font-semibold text-gray-700">Especialidad</th>
                                <th class="p-4 font-semibold text-gray-700">Fecha Creación</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($guias as $guia)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">
                                                {{ strtoupper(substr($guia->name, 0, 1)) }}
                                            </div>
                                            <p class="font-semibold text-gray-800">{{ $guia->name }}</p>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-600">{{ $guia->email }}</td>
                                    <td class="p-4">
                                        @if($guia->categoria)
                                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                {{ $guia->categoria->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">Sin categoría</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-gray-500 text-sm">{{ optional($guia->created_at)->format('d/m/Y') }}</td>
                                    <td class="p-4">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('admin.guias.edit', $guia) }}"
                                               class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">
                                                Editar
                                            </a>
                                            <x-confirm message="¿Estás seguro de eliminar este guía?">
                                            <form action="{{ route('admin.guias.destroy', $guia) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">
                                                    Eliminar
                                                </button>
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
                <h3 class="text-xl font-bold text-gray-800 mb-2">No hay guías registrados</h3>
                <p class="text-gray-500 mb-6">Comienza creando tu primer guía turístico</p>
                <a href="{{ route('admin.guias.create') }}"
                   class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Primer Guía
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
