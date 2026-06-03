<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Turismo Cartago'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50" x-data="{ scrollToTop: false }"
    @scroll.window="scrollToTop = (window.pageYOffset > 200) ? true : false">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <x-alert type="success" :message="session('success')" :autoDismiss="4000" />
                <x-alert type="error" :message="session('error')" />

                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-200 mt-10">
            <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8">

                {{-- LOGO --}}
                <div>
                    <h2 class="text-xl font-bold text-white">Turismo Cartago</h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Descubre experiencias únicas en Cartago.
                    </p>
                </div>

                {{-- LINKS DINÁMICOS --}}
                <div>
                    <h3 class="text-white font-semibold mb-3">Enlaces</h3>

                    <ul class="space-y-2 text-sm">

                        @guest
                        <li><a href="{{ url('/') }}" class="hover:text-emerald-400">Inicio</a></li>
                        <li><a href="{{ route('tours.index') }}" class="hover:text-emerald-400">Tours</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-400">Iniciar sesión</a></li>
                        @endguest

                        @auth
                        @if(auth()->user()->role === 'turista')
                        <li><a href="{{ url('/') }}" class="hover:text-emerald-400">Inicio</a></li>
                        <li><a href="{{ route('tours.index') }}" class="hover:text-emerald-400">Tours</a></li>
                        <li><a href="{{ route('reservaciones.index') }}" class="hover:text-emerald-400">Mis Reservas</a></li>
                        <li><a href="{{ route('profile.edit') }}" class="hover:text-emerald-400">Perfil</a></li>
                        @endif

                        @if(auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-400">Dashboard</a></li>
                        <li><a href="{{ route('admin.tours.index') }}" class="hover:text-emerald-400">Tours</a></li>
                        <li><a href="{{ route('admin.guias.index') }}" class="hover:text-emerald-400">Guías</a></li>
                        <li><a href="{{ route('admin.reservaciones.index') }}" class="hover:text-emerald-400">Reservas</a></li>
                        <li><a href="{{ route('admin.reportes.index') }}" class="hover:text-emerald-400">Reportes</a></li>
                        @elseif(auth()->user()->role === 'guia')
                        <li><a href="{{ route('guia.dashboard') }}" class="hover:text-emerald-400">Dashboard</a></li>
                        @endif
                        @endauth

                    </ul>
                </div>

                {{-- CONTACTO --}}
                <div>
                    <h3 class="text-white font-semibold mb-3">Contacto</h3>
                    <p class="text-sm text-gray-400">Cartago, Colombia</p>
                </div>

            </div>

            <div class="border-t border-gray-800 text-center py-4 text-sm text-gray-500">
                © {{ date('Y') }} Turismo Cartago. Todos los derechos reservados.
            </div>
        </footer>

        <!-- Back to Top Button -->
        <button x-show="scrollToTop"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="fixed bottom-6 right-6 bg-emerald-600 hover:bg-emerald-700 text-white p-3 rounded-full shadow-lg z-50 transition"
            aria-label="Volver arriba">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
</body>

</html>