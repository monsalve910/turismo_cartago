<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perfil de Usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
                <div class="max-w-xl">
                    <header class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Información del Perfil</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Actualiza la información de tu perfil y dirección de correo electrónico.
                        </p>
                    </header>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                                       class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            </div>
                            @if ($errors->updateProfileInformation->has('name'))
                                <p class="text-red-600 text-sm mt-1">{{ $errors->updateProfileInformation->first('name') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                                       class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            </div>
                            @if ($errors->updateProfileInformation->has('email'))
                                <p class="text-red-600 text-sm mt-1">{{ $errors->updateProfileInformation->first('email') }}</p>
                            @endif

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg">
                                    <p class="text-sm text-yellow-800">
                                        Tu dirección de correo no está verificada.
                                        <button form="send-verification" class="underline text-sm text-yellow-800 hover:text-yellow-900 font-medium">
                                            Haz clic aquí para reenviar el correo de verificación.
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t">
                            <button type="submit" class="bg-emerald-600 text-white py-2.5 px-6 rounded-lg hover:bg-emerald-700 transition font-semibold">
                                Guardar
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                                   class="text-sm text-gray-600">Perfil actualizado.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
                <div class="max-w-xl">
                    <header class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Actualizar Contraseña</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerla segura.
                        </p>
                    </header>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label for="update_password_current_password" class="block text-gray-700 font-semibold mb-2">Contraseña Actual</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="update_password_current_password" name="current_password" type="password"
                                       class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                       autocomplete="current-password">
                            </div>
                            @if ($errors->updatePassword->has('current_password'))
                                <p class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('current_password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="update_password_password" class="block text-gray-700 font-semibold mb-2">Nueva Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="update_password_password" name="password" type="password"
                                       class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                       autocomplete="new-password">
                            </div>
                            @if ($errors->updatePassword->has('password'))
                                <p class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="update_password_password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                                       class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                                       autocomplete="new-password">
                            </div>
                            @if ($errors->updatePassword->has('password_confirmation'))
                                <p class="text-red-600 text-sm mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t">
                            <button type="submit" class="bg-emerald-600 text-white py-2.5 px-6 rounded-lg hover:bg-emerald-700 transition font-semibold">
                                Guardar
                            </button>

                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                                   class="text-sm text-gray-600">Contraseña actualizada.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border-t-4 border-red-500">
                <div class="max-w-xl">
                    <header class="mb-6">
                        <h3 class="text-lg font-bold text-red-600">Eliminar Cuenta</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees retener.
                        </p>
                    </header>

                    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-5"
                          onsubmit="return confirm('¿ESTÁS SEGURO de eliminar tu cuenta? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('delete')

                        <div>
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" placeholder="Ingresa tu contraseña para confirmar"
                                       class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 p-2.5"
                                       autocomplete="current-password">
                            </div>
                            @if ($errors->userDeletion->has('password'))
                                <p class="text-red-600 text-sm mt-1">{{ $errors->userDeletion->first('password') }}</p>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="bg-red-600 text-white py-2.5 px-6 rounded-lg hover:bg-red-700 transition font-semibold">
                                Eliminar Cuenta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
