<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.rutas.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Nueva Ruta</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Nueva Ruta Turística</h3>
                    <p class="text-gray-500 mt-1">Define una nueva ruta para los tours en Cartago</p>
                </div>

                <form action="{{ route('admin.rutas.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre de la Ruta</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                            </div>
                            <input type="text" name="nombre" id="nombre" required
                                   class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                   placeholder="Ej: Ruta del Café">
                        </div>
                        @error('nombre')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3" required
                                  class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                  placeholder="Describe la ruta turística..."></textarea>
                        @error('descripcion')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t pt-5" x-data="{
                        lugares: [],
                        selectLugarId: '',
                        selectOrden: '',
                        get lugaresDisponibles() {
                            return {{ json_encode($lugares->map(fn($l) => ['id' => $l->id, 'nombre' => $l->nombre])) }}
                        },
                        agregar() {
                            const lugar = this.lugaresDisponibles.find(l => l.id == this.selectLugarId);
                            if (!lugar || !this.selectOrden) return;
                            if (this.lugares.some(l => l.id == lugar.id)) return;
                            this.lugares.push({ ...lugar, orden: this.selectOrden });
                            this.selectLugarId = '';
                            this.selectOrden = '';
                        },
                        eliminar(index) {
                            this.lugares.splice(index, 1);
                        }
                    }">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Lugares de la Ruta</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                            <div class="sm:col-span-1">
                                <label for="lugar_select" class="block text-gray-700 text-sm font-medium mb-1">Lugar</label>
                                <select x-model="selectLugarId" id="lugar_select"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                                    <option value="">Seleccione...</option>
                                    <template x-for="lugar in lugaresDisponibles" :key="lugar.id">
                                        <option :value="lugar.id" x-text="lugar.nombre"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label for="lugar_orden" class="block text-gray-700 text-sm font-medium mb-1">Orden</label>
                                <input type="number" x-model="selectOrden" id="lugar_orden" min="1" placeholder="Orden"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            </div>
                            <div class="flex items-end">
                                <button type="button" @click="agregar()"
                                        class="w-full bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition font-semibold">
                                    Agregar
                                </button>
                            </div>
                        </div>

                        <template x-if="lugares.length === 0">
                            <div class="text-center py-6 bg-gray-50 rounded-xl">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <p class="text-gray-500 text-sm">No hay lugares agregados. Selecciona lugares arriba.</p>
                            </div>
                        </template>

                        <template x-if="lugares.length > 0">
                            <div class="space-y-2">
                                <template x-for="(lugar, index) in lugares" :key="index">
                                    <div class="bg-gray-50 p-3 rounded-xl flex items-center justify-between hover:bg-gray-100 transition group">
                                        <div class="flex items-center gap-3">
                                            <span class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-lg flex items-center justify-center text-white font-bold text-sm" x-text="lugar.orden"></span>
                                            <div>
                                                <p class="font-medium text-gray-800" x-text="lugar.nombre"></p>
                                                <p class="text-xs text-gray-500">Orden: <span x-text="lugar.orden"></span></p>
                                            </div>
                                        </div>
                                        <button type="button" @click="eliminar(index)" class="text-red-600 hover:text-red-800 text-sm font-medium opacity-0 group-hover:opacity-100 transition">
                                            Eliminar
                                        </button>
                                        <input type="hidden" :name="'lugares[' + index + '][lugar_id]'" :value="lugar.id">
                                        <input type="hidden" :name="'lugares[' + index + '][orden]'" :value="lugar.orden">
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t">
                        <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-xl hover:bg-emerald-700 transition font-semibold shadow-lg hover:shadow-xl">
                            Crear Ruta
                        </button>
                        <a href="{{ route('admin.rutas.index') }}" class="flex-1 text-center bg-gray-100 text-gray-700 py-2.5 px-6 rounded-xl hover:bg-gray-200 transition font-semibold">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
