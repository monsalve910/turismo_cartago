<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.lugares.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Nuevo Lugar</h2>
                <p class="text-sm text-gray-500">Agrega un lugar turístico a una ruta</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Nuevo Lugar</h3>
                    <p class="text-gray-500 mt-1">Agrega un nuevo lugar turístico</p>
                </div>

                <form action="{{ route('admin.lugares.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label for="ruta_id" class="block text-gray-700 font-semibold mb-2">Ruta</label>
                        <select name="ruta_id" id="ruta_id" required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            <option value="">Seleccione una ruta...</option>
                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                            @endforeach
                        </select>
                        @error('ruta_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre del Lugar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="nombre" id="nombre" required
                                   class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                   placeholder="Ej: Parque del Café">
                        </div>
                        @error('nombre')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                                  class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                  placeholder="Describe el lugar turístico..."></textarea>
                        @error('descripcion')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="orden" class="block text-gray-700 font-semibold mb-2">Orden</label>
                            <input type="number" name="orden" id="orden" min="1" required
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                   placeholder="Orden">
                            @error('orden')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="imagen" class="block text-gray-700 font-semibold mb-2">Imagen</label>
                            <input type="file" name="imagen" id="imagen"
                                   class="block w-full rounded-xl border-gray-300 p-2.5 bg-gray-50 text-sm">
                            @error('imagen')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-blue-800">El orden determina la secuencia de este lugar dentro de la ruta.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t">
                        <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-xl hover:bg-emerald-700 transition font-semibold shadow-lg hover:shadow-xl">
                            Crear Lugar
                        </button>
                        <a href="{{ route('admin.lugares.index') }}" class="flex-1 text-center bg-gray-100 text-gray-700 py-2.5 px-6 rounded-xl hover:bg-gray-200 transition font-semibold">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
