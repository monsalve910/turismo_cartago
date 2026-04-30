<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.lugares.index') }}" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $lugar->nombre }}</h2>
                <p class="text-sm text-gray-500">Detalles del lugar turístico</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                        @if($lugar->imagen)
                            <img src="{{ asset('storage/' . $lugar->imagen) }}" alt="{{ $lugar->nombre }}" class="w-full h-64 object-cover rounded-xl mb-6">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-teal-500 rounded-xl flex items-center justify-center mb-6">
                                <span class="text-white text-6xl font-bold opacity-50">{{ $lugar->orden }}</span>
                            </div>
                        @endif

                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $lugar->nombre }}</h3>
                                <p class="text-gray-500 mt-1">Orden: {{ $lugar->orden }}</p>
                            </div>
                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                Orden #{{ $lugar->orden }}
                            </span>
                        </div>

                        <div class="border-t pt-6">
                            <h4 class="text-lg font-bold text-gray-800 mb-3">Descripción</h4>
                            <p class="text-gray-600 leading-relaxed">{{ $lugar->descripcion }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Información</h4>
                        <div class="space-y-3">
                            @if($lugar->ruta)
                                <div>
                                    <p class="text-xs text-gray-500">Ruta</p>
                                    <p class="font-medium text-gray-800">{{ $lugar->ruta->nombre }}</p>
                                </div>
                            @endif
                            <div>
                                <p class="text-xs text-gray-500">Orden en la ruta</p>
                                <p class="font-medium text-gray-800">#{{ $lugar->orden }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Fecha de creación</p>
                                <p class="font-medium text-gray-800">{{ $lugar->created_at ? $lugar->created_at->format('d/m/Y') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Acciones</h4>
                        <div class="space-y-3">
                            <a href="{{ route('admin.lugares.edit', $lugar->id) }}" class="block w-full text-center bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
                                Editar Lugar
                            </a>
                            <a href="{{ route('admin.rutas.show', $lugar->ruta_id) }}" class="block w-full text-center bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                                Ver Ruta
                            </a>
                            <a href="{{ route('admin.lugares.index') }}" class="block w-full text-center bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                                Volver al Listado
                            </a>
                        </div>
                    </div>

                    <div class="bg-red-50 rounded-2xl p-6 border border-red-100">
                        <h4 class="text-lg font-bold text-red-800 mb-2">Zona de Peligro</h4>
                        <p class="text-sm text-red-600 mb-4">Esta acción eliminará permanentemente el lugar.</p>
                        <form action="{{ route('admin.lugares.destroy', $lugar->id) }}" method="POST" onsubmit="return confirm('¿ESTÁS SEGURO de eliminar este lugar?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white py-2.5 rounded-xl hover:bg-red-700 transition font-semibold">
                                Eliminar Lugar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
