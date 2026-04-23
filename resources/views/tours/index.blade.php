<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Listado de Tours</h2>
            <a href="{{ route('tours.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Crear Nuevo Tour
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 border-b">Nombre</th>
                        <th class="p-4 border-b">Categoría</th>
                        <th class="p-4 border-b">Precio</th>
                        <th class="p-4 border-b">Capacidad</th>
                        <th class="p-4 border-b">Fecha</th>
                        <th class="p-4 border-b text-center">Acciones</th> </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $tour)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 border-b">{{ $tour->nombre }}</td>
                            <td class="p-4 border-b">
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                    {{ $tour->categoria->name ?? 'Sin categoría' }}
                                </span>
                            </td>
                            <td class="p-4 border-b font-medium text-gray-700">
                                ${{ number_format($tour->precio, 0, ',', '.') }}
                            </td>
                            <td class="p-4 border-b text-gray-600">{{ $tour->capacidad }} personas</td>
                            <td class="p-4 border-b text-gray-600">{{ $tour->fecha }}</td>
                            
                            <td class="p-4 border-b">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('tours.edit', $tour) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-medium transition">
                                        Editar
                                    </a>

                                    <form action="{{ route('tours.destroy', $tour) }}" method="POST" 
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este tour?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($tours->isEmpty())
                <div class="p-10 text-center text-gray-500 italic">
                    No hay tours registrados actualmente.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>