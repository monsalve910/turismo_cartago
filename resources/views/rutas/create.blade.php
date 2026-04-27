<x-app-layout>
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">Crear Ruta</h2>

        <form action="{{ route('rutas.store') }}" method="POST"
            class="bg-white p-6 rounded-xl shadow">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre"
                    class="w-full border rounded-lg p-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Descripción</label>
                <textarea name="descripcion"
                    class="w-full border rounded-lg p-2 mt-1"></textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar
            </button>
            <a href="{{ route('rutas.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                 Volver
            </a>

        </form>
    </div>
</x-app-layout>