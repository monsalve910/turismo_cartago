<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.guias.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Disponibilidad Semanal</h2>
                <p class="text-sm text-gray-500">Configura los días disponibles para <strong>{{ $guia->name }}</strong></p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.guias.updateDisponibilidad', $guia) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4 mb-8">
                    @foreach($dias as $key => $dia)
                        <label class="flex items-center justify-between p-4 rounded-xl border border-gray-200 hover:bg-gray-50 transition cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full
                                    @if(isset($disponibilidad[$key]) && $disponibilidad[$key]->activo) bg-emerald-100 @else bg-gray-100 @endif
                                    flex items-center justify-center">
                                    <svg class="w-5 h-5
                                        @if(isset($disponibilidad[$key]) && $disponibilidad[$key]->activo) text-emerald-600 @else text-gray-400 @endif"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-800 text-lg">{{ $dia }}</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="disponibilidad[{{ $key }}]" value="1" class="sr-only peer"
                                    {{ isset($disponibilidad[$key]) && $disponibilidad[$key]->activo ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </label>
                        </label>
                    @endforeach
                </div>

                <div class="flex items-center gap-4 pt-4 border-t">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        Guardar Disponibilidad
                    </button>
                    <a href="{{ route('admin.guias.index') }}" class="flex-1 text-center bg-gray-800 text-white py-2.5 px-6 rounded-lg hover:bg-gray-900 transition font-semibold">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
