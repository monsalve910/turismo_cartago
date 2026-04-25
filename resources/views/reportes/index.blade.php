<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10">

        <h2 class="text-2xl font-bold mb-6">Reportes de Tours</h2>

        {{-- Filtros --}}
        <form method="GET" action="{{ route('reportes.index') }}"
              class="bg-white p-6 rounded-xl shadow mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>
                <label class="block text-gray-700 font-medium">Categoría</label>
                <select name="categoria_id"
                    class="w-full border-gray-300 rounded-lg p-2 mt-1">
                    <option value="">Todas</option>
                    @foreach($categorias as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Fecha inicio</label>
                <input type="date" name="fecha_inicio"
                    class="w-full border-gray-300 rounded-lg p-2 mt-1">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Fecha fin</label>
                <input type="date" name="fecha_fin"
                    class="w-full border-gray-300 rounded-lg p-2 mt-1">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Precio mínimo</label>
                <input type="number" name="precio_min"
                    class="w-full border-gray-300 rounded-lg p-2 mt-1">
            </div>

            <div class="md:col-span-4 flex gap-3 mt-2">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Filtrar
                </button>

                <a href="{{ route('reportes.pdf') }}"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Exportar PDF
                </a>
            </div>
        </form>

        {{-- Tabla --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                        <th>Capacidad</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tours as $t)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">{{ $t->nombre }}</td>
                            <td>{{ $t->categoria->name }}</td>
                            <td>${{ $t->precio }}</td>
                            <td>{{ $t->fecha }}</td>
                            <td>{{ $t->capacidad }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                No hay resultados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>