<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.tours.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Tour</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <form action="{{ route('admin.tours.update', $tour) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- NOMBRE --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nombre del Tour</label>
                        <input type="text" name="nombre"
                               value="{{ old('nombre', $tour->nombre) }}"
                               class="w-full rounded-xl border-gray-300 p-2.5">
                    </div>

                    {{-- DESCRIPCION --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="w-full rounded-xl border-gray-300 p-2.5">{{ old('descripcion', $tour->descripcion) }}</textarea>
                    </div>

                    {{-- PRECIO / CAPACIDAD --}}
                    <div class="grid grid-cols-2 gap-4">
                        <input type="number" name="precio"
                               value="{{ old('precio', $tour->precio) }}"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <input type="number" name="capacidad"
                               value="{{ old('capacidad', $tour->capacidad) }}"
                               class="w-full rounded-xl border-gray-300 p-2.5">
                    </div>

                    {{-- FECHA / CATEGORIA --}}
                    <div class="grid grid-cols-2 gap-4">
                        <input type="date" name="fecha"
                               value="{{ old('fecha', $tour->fecha) }}"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <select name="categoria_id"
                                class="w-full rounded-xl border-gray-300 p-2.5">
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $tour->categoria_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 🔥 RUTA (NUEVO) --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Ruta</label>

                        <select name="ruta_id" required
                                class="w-full rounded-xl border-gray-300 p-2.5">

                            <option value="">Seleccione una ruta</option>

                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->id }}"
                                    {{ $tour->ruta_id == $ruta->id ? 'selected' : '' }}>
                                    {{ $ruta->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- IMAGEN --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Cambiar Imagen</label>
                        <input type="file" name="imagen"
                               class="w-full rounded-xl border-gray-300 p-2.5 bg-gray-50">
                    </div>

                    {{-- BOTONES --}}
                    <div class="flex gap-4 pt-4 border-t">
                        <button class="flex-1 bg-emerald-600 text-white py-2.5 rounded-xl">
                            Actualizar Tour
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