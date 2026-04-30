<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de Tours
            </h2>

            <a href="{{ route('admin.tours.create') }}"
               class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Tour
            </a>
        </div>
    </x-slot>

    <div class="py-8">

        @if($tours && $tours->count() > 0)

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">

                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4">Imagen</th>
                                <th class="p-4">Nombre</th>

                                {{-- 🔥 NUEVO: RUTA --}}
                                <th class="p-4">Ruta</th>

                                <th class="p-4">Categoría</th>
                                <th class="p-4">Precio</th>
                                <th class="p-4">Fecha</th>
                                <th class="p-4 text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach($tours as $tour)
                                <tr class="hover:bg-gray-50 transition">

                                    {{-- IMAGEN --}}
                                    <td class="p-4">
                                        @if($tour->imagen)
                                            <img src="{{ asset('storage/' . $tour->imagen) }}"
                                                 class="w-16 h-16 rounded-lg object-cover">
                                        @else
                                            <div class="w-16 h-16 rounded-lg bg-gray-200"></div>
                                        @endif
                                    </td>

                                    {{-- NOMBRE --}}
                                    <td class="p-4">
                                        <p class="font-semibold text-gray-800">{{ $tour->nombre }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ Str::limit($tour->descripcion, 50) }}
                                        </p>
                                    </td>

                                    {{-- 🔥 RUTA --}}
                                    <td class="p-4">
                                        @if($tour->ruta)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                {{ $tour->ruta->nombre }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">Sin ruta</span>
                                        @endif
                                    </td>

                                    {{-- CATEGORÍA --}}
                                    <td class="p-4">
                                        @if($tour->categoria)
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                                {{ $tour->categoria->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">Sin categoría</span>
                                        @endif
                                    </td>

                                    {{-- PRECIO --}}
                                    <td class="p-4 font-semibold text-emerald-600">
                                        ${{ number_format($tour->precio, 0, ',', '.') }}
                                    </td>

                                    {{-- FECHA --}}
                                    <td class="p-4 text-gray-600 text-sm">
                                        {{ \Carbon\Carbon::parse($tour->fecha)->format('d/m/Y') }}
                                    </td>

                                    {{-- ACCIONES --}}
                                    <td class="p-4">
                                        <div class="flex justify-center gap-3">

                                            <a href="{{ route('admin.tours.edit', $tour) }}"
                                               class="text-blue-600 hover:text-blue-800">
                                                Editar
                                            </a>

                                            <form action="{{ route('admin.tours.destroy', $tour) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Eliminar este tour?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-red-600 hover:text-red-800">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>

        @else

            <div class="bg-white p-12 text-center rounded-2xl shadow">
                <h3 class="text-xl font-bold">No hay tours registrados</h3>
            </div>

        @endif

    </div>
</x-app-layout>