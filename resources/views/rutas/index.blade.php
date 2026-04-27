<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <x-app-layout>
        <div class="max-w-6xl mx-auto mt-10 px-4">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Rutas Turísticas</h1>

            <a href="{{ route('rutas.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Crear Ruta
            </a>

            <div class="grid md:grid-cols-3 gap-6 mt-6">
                @foreach($rutas as $ruta)
                <div class="bg-white shadow-lg rounded-xl p-5 hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $ruta->nombre }}</h2>
                    <p class="text-gray-600 mt-2">{{ $ruta->descripcion }}</p>

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('rutas.show', $ruta->id) }}"
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            Ver
                        </a>

                        <a href="{{ route('rutas.edit', $ruta->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Editar
                        </a>

                        <form action="{{ route('rutas.destroy', $ruta->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
</body>

</html>