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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50">
            <!-- Logo -->
            <div class="mb-6" x-data="{}" x-show="true" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <a href="/" class="flex items-center gap-2 hover:scale-105 transition duration-300">
                    <svg class="h-12 w-auto text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-3xl font-bold text-emerald-700">Turismo Cartago</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-100"
                 x-data="{}" x-show="true" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <?php echo e($slot); ?>

            </div>

            <div class="mt-6 text-center text-sm text-gray-500">
                <a href="<?php echo e(url('/')); ?>" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-800 font-medium transition group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver al inicio
                </a>
            </div>

            <!-- Footer info -->
            <div class="mt-8 text-center text-xs text-gray-400">
                <p>© <?php echo e(date('Y')); ?> Turismo Cartago. Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/layouts/guest.blade.php ENDPATH**/ ?>