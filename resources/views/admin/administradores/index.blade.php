<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Administradores
            </h2>
            <a href="{{ route('admin.administradores.create') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nuevo Administrador
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="p-4 font-semibold text-gray-700">Nombre</th>
                            <th class="p-4 font-semibold text-gray-700">Correo</th>
                            <th class="p-4 font-semibold text-gray-700">Fecha Creación</th>
                            <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($administradores as $admin)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $admin->name }}</p>
                                        @if($admin->id == auth()->id())
                                        <span class="text-xs text-gray-500">(Tú)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-gray-600">{{ $admin->email }}</td>
                            <td class="p-4 text-gray-500 text-sm">{{ optional($admin->created_at)->format('d/m/Y') }}</td>
                            <td class="p-4">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('admin.administradores.edit', $admin) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">
                                        Editar
                                    </a>
                                    @if($admin->id != auth()->id())
                                    <form action="{{ route('admin.administradores.destroy', $admin) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este administrador?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="text-gray-500">No hay administradores registrados.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>