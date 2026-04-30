<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.rutas.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $ruta->nombre }}</h2>
                <p class="text-sm text-gray-500">Detalles de la ruta turística</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $ruta->nombre }}</h3>
                                <p class="text-gray-600 mt-2">{{ $ruta->descripcion }}</p>
                            </div>
                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $ruta->lugares ? $ruta->lugares->count() : 0 }} lugares
                            </span>
                        </div>

                        @if($ruta->lugares && $ruta->lugares->count() > 0)
                            <div class="border-t pt-6">
                                <h4 class="text-lg font-bold text-gray-800 mb-4">Lugares en esta ruta</h4>
                                <div class="space-y-3">
                                    @foreach($ruta->lugares->sortBy('orden') as $lugar)
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                                                {{ $lugar->orden }}
                                            </div>
                                            @if($lugar->imagen)
                                                <img src="{{ asset('storage/' . $lugar->imagen) }}" alt="{{ $lugar->nombre }}" class="w-12 h-12 object-cover rounded-lg">
                                            @endif
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-800">{{ $lugar->nombre }}</p>
                                                <p class="text-xs text-gray-500">{{ Str::limit($lugar->descripcion, 60) }}</p>
                                            </div>
                                            <a href="{{ route('admin.lugares.edit', $lugar->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium opacity-0 group-hover:opacity-100 transition">
                                                Editar
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Acciones</h4>
                        <div class="space-y-3">
                            <a href="{{ route('admin.rutas.edit', $ruta->id) }}" class="block w-full text-center bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
                                Editar Ruta
                            </a>
                            <a href="{{ route('admin.rutas.index') }}" class="block w-full text-center bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                                Volver al Listado
                            </a>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                        <h4 class="text-lg font-bold text-blue-800 mb-2">Información</h4>
                        <p class="text-sm text-blue-700 mb-4">Ruta creada el {{ $ruta->created_at ? $ruta->created_at->format('d/m/Y') : 'N/A' }}</p>
                        <p class="text-sm text-blue-600">Desde aquí puedes gestionar los lugares que componen esta ruta turística.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
