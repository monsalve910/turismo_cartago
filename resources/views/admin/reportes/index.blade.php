<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Reportes de Tours</h2>
                <p class="text-gray-500 mt-1">Analiza y filtra la información de tours</p>
            </div>
            <a href="{{ route('admin.reportes.pdf') }}" class="bg-red-600 text-white px-5 py-2.5 rounded-lg hover:bg-red-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exportar PDF
            </a>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Filtros</h3>
            <form method="GET" action="{{ route('admin.reportes.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Categoría</label>
                    <select name="categoria_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5 bg-white">
                        <option value="">Todas</option>
                        @foreach($categorias as $c)
                            <option value="{{ $c->id }}" {{ request('categoria_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Precio Mínimo</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400">$</span>
                        </div>
                        <input type="number" name="precio_min" value="{{ request('precio_min') }}"
                               class="pl-8 w-full border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                               placeholder="0">
                    </div>
                </div>

                <div class="md:col-span-4 flex gap-3 mt-2">
                    <button type="submit" class="bg-emerald-600 text-white px-6 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.reportes.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition font-semibold">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="p-4 font-semibold text-gray-700">Nombre</th>
                            <th class="p-4 font-semibold text-gray-700">Categoría</th>
                            <th class="p-4 font-semibold text-gray-700">Precio</th>
                            <th class="p-4 font-semibold text-gray-700">Fecha</th>
                            <th class="p-4 font-semibold text-gray-700">Capacidad</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tours as $t)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-gray-800">{{ $t->nombre }}</td>
                                <td class="p-4">
                                    @if($t->categoria)
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                            {{ $t->categoria->name }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 font-medium text-emerald-600">${{ number_format($t->precio, 0, ',', '.') }}</td>
                                <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($t->fecha)->format('d/m/Y') }}</td>
                                <td class="p-4 text-gray-600">{{ $t->capacidad }} personas</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-gray-500">No hay resultados con los filtros aplicados.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
