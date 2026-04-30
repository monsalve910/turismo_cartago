<nav x-data="{ open: false }" class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <svg class="h-8 w-auto text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-xl font-bold text-emerald-700">Turismo Cartago</span>
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                    @if(auth()->user()->role === 'admin')
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('admin.tours.index')" :active="request()->routeIs('admin.tours.*')">
                        Tours
                    </x-nav-link>

                    <x-nav-link :href="route('admin.rutas.index')" :active="request()->routeIs('admin.rutas.*')">
                        Rutas
                    </x-nav-link>

                    <x-nav-link :href="route('admin.lugares.index')" :active="request()->routeIs('admin.lugares.*')">
                        Lugares
                    </x-nav-link>
                    <x-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.*')">
                        Categorías
                    </x-nav-link>

                    <x-nav-link :href="route('admin.administradores.index')" :active="request()->routeIs('admin.administradores.*')">
                        Administradores
                    </x-nav-link>

                    <x-nav-link :href="route('admin.reportes.index')" :active="request()->routeIs('admin.reportes.*')">
                        Reportes
                    </x-nav-link>
                    @else
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        Inicio
                    </x-nav-link>
                    <x-nav-link :href="route('tours.index')" :active="request()->routeIs('tours.*')">
                        Tours
                    </x-nav-link>
                    <x-nav-link :href="route('reservaciones.index')" :active="request()->routeIs('reservaciones.*')">
                        Mis Reservas
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        Perfil
                    </x-nav-link>
                    @endif
                    @else
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        Inicio
                    </x-nav-link>
                    <x-nav-link :href="route('tours.index')" :active="request()->routeIs('tours.*')">
                        Tours
                    </x-nav-link>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                @if(auth()->user()->role === 'admin')
                <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full mr-4">
                    Administrador
                </span>
                @endif
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Perfil
                            </div>
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <div class="flex items-center gap-2 text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Cerrar Sesión
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-emerald-600 font-medium transition">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition font-medium">
                        Registrarse
                    </a>
                </div>
                @endauth
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            @if(auth()->user()->role === 'admin')
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.tours.index')" :active="request()->routeIs('admin.tours.*')">
                Tours
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.rutas.index')" :active="request()->routeIs('admin.rutas.*')">
                Rutas
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.lugares.index')" :active="request()->routeIs('admin.lugares.*')">
                Lugares
            </x-responsive-nav-link>
            <x-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.*')">
                Categorías
            </x-nav-link>

            <x-responsive-nav-link :href="route('admin.administradores.index')" :active="request()->routeIs('admin.administradores.*')">
                Administradores
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.reportes.index')" :active="request()->routeIs('admin.reportes.*')">
                Reportes
            </x-responsive-nav-link>
            @else
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                Inicio
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tours.index')" :active="request()->routeIs('tours.*')">
                Tours
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reservaciones.index')" :active="request()->routeIs('reservaciones.*')">
                Mis Reservas
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                Perfil
            </x-responsive-nav-link>
            @endif
            @else
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                Inicio
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tours.index')" :active="request()->routeIs('tours.*')">
                Tours
            </x-responsive-nav-link>
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="text-red-600">Cerrar Sesión</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="space-y-2 px-4">
                <a href="{{ route('login') }}" class="block text-center w-full bg-white border border-emerald-600 text-emerald-600 px-4 py-2 rounded-lg hover:bg-emerald-50 transition font-medium">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="block text-center w-full bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition font-medium">
                    Registrarse
                </a>
            </div>
        </div>
        @endauth
    </div>
</nav>