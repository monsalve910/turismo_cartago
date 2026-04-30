<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.lugares.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Lugar</h2>
                <p class="text-sm text-gray-500">{{ $lugar->nombre }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Modificar Lugar</h3>
                    <p class="text-gray-500 mt-1">Modifica la información de {{ $lugar->nombre }}</p>
                </div>

                <form action="{{ route('admin.lugares.update', $lugar->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="ruta_id" class="block text-gray-700 font-semibold mb-2">Ruta</label>
                        <select name="ruta_id" id="ruta_id" required 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->id }}" {{ $lugar->ruta_id == $ruta->id ? 'selected' : '' }}>
                                    {{ $ruta->nombre }}
                                </option>
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
                            <input type="text" name="nombre" id="nombre" value="{{ $lugar->nombre }}" required
                                   class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                        </div>
                        @error('nombre')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                                  class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">{{ $lugar->descripcion }}</textarea>
                        @error('descripcion')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="orden" class="block text-gray-700 font-semibold mb-2">Orden</label>
                            <input type="number" name="orden" id="orden" min="1" value="{{ $lugar->orden }}" required
                                   class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            @error('orden')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="imagen" class="block text-gray-700 font-semibold mb-2">Cambiar Imagen</label>
                            <input type="file" name="imagen" id="imagen"
                                   class="block w-full rounded-xl border-gray-300 p-2.5 bg-gray-50 text-sm">
                            @error('imagen')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @if($lugar->imagen)
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Imagen Actual</label>
                            <img src="{{ asset('storage/' . $lugar->imagen) }}" alt="{{ $lugar->nombre }}" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif

                    <div class="flex items-center gap-4 pt-4 border-t">
                        <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-xl hover:bg-emerald-700 transition font-semibold shadow-lg hover:shadow-xl">
                            Actualizar Lugar
                        </button>
                        <a href="{{ route('admin.lugares.index') }}" class="flex-1 text-center bg-gray-100 text-gray-700 py-2.5 px-6 rounded-xl hover:bg-gray-200 transition font-semibold">
                            Cancelar
                        </a>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-red-200">
                    <h3 class="text-lg font-bold text-red-600 mb-3">Zona de Peligro</h3>
                    <p class="text-gray-600 text-sm mb-4">Esta acción eliminará permanentemente el lugar.</p>
                    <form action="{{ route('admin.lugares.destroy', $lugar->id) }}" method="POST" onsubmit="return confirm('¿ESTÁS SEGURO de eliminar este lugar?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-6 py-2.5 rounded-xl hover:bg-red-700 transition font-semibold">
                            Eliminar Lugar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
