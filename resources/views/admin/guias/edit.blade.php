<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.guias.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Guía</h2>
                <p class="text-sm text-gray-500">Actualiza los datos del guía turístico</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.guias.update', $guia) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nombre Completo</label>
                    <input type="text" name="name" value="{{ old('name', $guia->name) }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                           placeholder="Nombre del guía">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                    <div class="w-full rounded-lg bg-gray-100 border border-gray-300 p-2.5 text-gray-500 cursor-not-allowed">
                        {{ $guia->email }}
                    </div>
                    <p class="text-xs text-gray-400 mt-1">El correo no se puede modificar.</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nueva Contraseña <span class="text-gray-400 font-normal">(dejar vacío para mantener)</span></label>
                    <input type="password" name="password"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                           placeholder="Mínimo 8 caracteres">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                           placeholder="Repite la contraseña">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Especialidad (Categoría)</label>
                    <select name="categoria_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                        <option value="">Sin categoría</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id', $guia->categoria_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 pt-4 border-t">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        Actualizar Guía
                    </button>
                    <a href="{{ route('admin.guias.index') }}" class="flex-1 text-center bg-gray-800 text-white py-2.5 px-6 rounded-lg hover:bg-gray-900 transition font-semibold">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
