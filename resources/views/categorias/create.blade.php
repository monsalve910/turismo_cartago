<x-app-layout>
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">Nueva Categoría de Turismo</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('categorias.store') }}" method="POST"
            class="bg-white p-6 rounded-xl shadow">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nombre de la Categoría</label>
                <input type="text" name="name" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 mt-1">
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                    Crear
                </button>
                
                <a href="{{ route('categorias.index') }}"
                    class="inline-flex items-center px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition font-semibold">
                     Volver
                </a>
            </div>
        </form>
    </div>
</x-app-layout>