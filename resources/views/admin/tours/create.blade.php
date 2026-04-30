<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.tours.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Nuevo Tour</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    {{-- NOMBRE --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nombre del Tour</label>
                        <input type="text" name="nombre" required
                               class="w-full rounded-xl border-gray-300 p-2.5"
                               placeholder="Ej: Tour Valle del Cauca">
                    </div>

                    {{-- DESCRIPCION --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" rows="3" required
                                  class="w-full rounded-xl border-gray-300 p-2.5"></textarea>
                    </div>

                    {{-- PRECIO / CAPACIDAD --}}
                    <div class="grid grid-cols-2 gap-4">
                        <input type="number" name="precio" placeholder="Precio"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <input type="number" name="capacidad" placeholder="Capacidad"
                               class="w-full rounded-xl border-gray-300 p-2.5">
                    </div>

                    {{-- FECHA / CATEGORIA --}}
                    <div class="grid grid-cols-2 gap-4">
                        <input type="date" name="fecha"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <select name="categoria_id"
                                class="w-full rounded-xl border-gray-300 p-2.5">
                            <option value="">Categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- RUTA (CLAVE NUEVO) --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Ruta</label>
                        <select name="ruta_id" required
                                class="w-full rounded-xl border-gray-300 p-2.5">
                            <option value="">Seleccione una ruta</option>
                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- IMAGEN --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Imagen</label>
                        <input type="file" name="imagen"
                               class="w-full rounded-xl border-gray-300 p-2.5 bg-gray-50">
                    </div>

                    {{-- BOTONES --}}
                    <div class="flex gap-4 pt-4 border-t">
                        <button class="flex-1 bg-emerald-600 text-white py-2.5 rounded-xl">
                            Guardar Tour
                        </button>

                        <a href="{{ route('admin.tours.index') }}"
                           class="flex-1 text-center bg-gray-100 py-2.5 rounded-xl">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>