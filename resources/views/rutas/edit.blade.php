<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 space-y-6">

        <!-- EDITAR RUTA -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-4">Editar Ruta</h2>

            <form action="{{ route('rutas.update', $ruta->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" name="nombre" value="{{ $ruta->nombre }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <div>
                    <label class="block text-gray-700">Descripción</label>
                    <textarea name="descripcion"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">{{ $ruta->descripcion }}</textarea>
                </div>

                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Actualizar Ruta
                </button>
            </form>
        </div>

        <!-- LISTA DE LUGARES -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-xl font-semibold mb-4">Lugares</h3>

            <div class="space-y-2">
                @foreach($ruta->lugares as $lugar)
                <div class="bg-gray-100 p-3 rounded flex items-center justify-between">

                    <div class="flex items-center gap-4">
                        @if($lugar->imagen)
                        <img src="{{ asset('storage/' . $lugar->imagen) }}"
                            class="w-16 h-16 object-cover rounded-lg">
                        @endif

                        <span>
                            <strong>{{ $lugar->orden }}</strong> - {{ $lugar->nombre }}
                        </span>
                    </div>

                    <!-- BOTÓN ELIMINAR -->
                    <form action="{{ route('lugares.destroy', $lugar->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('¿Eliminar este lugar?')"
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                            Eliminar
                        </button>
                    </form>

                </div>
                @endforeach
            </div>
        </div>

        <!-- AGREGAR LUGAR -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h4 class="text-lg font-semibold mb-3">Agregar Lugar</h4>

            <form action="{{ route('rutas.lugares', $ruta->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf

                <input type="text" name="nombre" placeholder="Nombre"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">

                <input type="text" name="descripcion" placeholder="Descripción"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">

                <input type="number" name="orden" placeholder="Orden" min="1"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
                <input type="file" name="imagen"
                    class="w-full border rounded-lg p-2 bg-gray-50">

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Agregar Lugar
                </button>
            </form>
        </div>

        <!-- BOTÓN VOLVER -->
        <div>
            <a href="{{ route('rutas.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                Volver
            </a>
        </div>

    </div>
</x-app-layout>