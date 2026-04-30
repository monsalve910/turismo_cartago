<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo $__env->yieldContent('title', config('app.name', 'Turismo Cartago')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased bg-gray-50" x-data="{ scrollToTop: false }" 
          @scroll.window="scrollToTop = (window.pageYOffset > 200) ? true : false">
        <div class="min-h-screen flex flex-col">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main class="flex-1 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Alerts -->
                    <?php if(session('success')): ?>
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                             class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-emerald-800 font-medium"><?php echo e(session('success')); ?></p>
                                </div>
                                <button @click="show = false" class="text-emerald-600 hover:text-emerald-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div x-data="{ show: true }" x-show="show"
                             class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-red-800 font-medium"><?php echo e(session('error')); ?></p>
                                </div>
                                <button @click="show = false" class="text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php echo e($slot); ?>

                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-gray-300 py-8 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-white font-bold text-lg mb-4">Turismo Cartago</h3>
                            <p class="text-sm">Descubre la belleza de Cartago, Valle del Cauca. Tours, rutas y experiencias únicas.</p>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-4">Enlaces</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="<?php echo e(url('/')); ?>" class="hover:text-white transition">Inicio</a></li>
                                <li><a href="<?php echo e(route('tours.index')); ?>" class="hover:text-white transition">Tours</a></li>
                                <?php if(auth()->guard()->check()): ?>
                                    <li><a href="<?php echo e(route('reservaciones.index')); ?>" class="hover:text-white transition">Mis Reservas</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-4">Contacto</h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    Cartago, Valle del Cauca
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    info@turismocartago.com
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm">
                        &copy; <?php echo e(date('Y')); ?> Turismo Cartago. Todos los derechos reservados.
                    </div>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
            </button>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/layouts/app.blade.php ENDPATH**/ ?>