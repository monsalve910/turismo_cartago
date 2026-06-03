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
                <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'success','message' => session('success'),'autoDismiss' => 4000]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('success')),'autoDismiss' => 4000]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'error','message' => session('error')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('error'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

                <?php echo e($slot); ?>

            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-200 mt-10">
            <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8">

                
                <div>
                    <h2 class="text-xl font-bold text-white">Turismo Cartago</h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Descubre experiencias únicas en Cartago.
                    </p>
                </div>

                
                <div>
                    <h3 class="text-white font-semibold mb-3">Enlaces</h3>

                    <ul class="space-y-2 text-sm">

                        <?php if(auth()->guard()->guest()): ?>
                        <li><a href="<?php echo e(url('/')); ?>" class="hover:text-emerald-400">Inicio</a></li>
                        <li><a href="<?php echo e(route('tours.index')); ?>" class="hover:text-emerald-400">Tours</a></li>
                        <li><a href="<?php echo e(route('login')); ?>" class="hover:text-emerald-400">Iniciar sesión</a></li>
                        <?php endif; ?>

                        <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'turista'): ?>
                        <li><a href="<?php echo e(url('/')); ?>" class="hover:text-emerald-400">Inicio</a></li>
                        <li><a href="<?php echo e(route('tours.index')); ?>" class="hover:text-emerald-400">Tours</a></li>
                        <li><a href="<?php echo e(route('reservaciones.index')); ?>" class="hover:text-emerald-400">Mis Reservas</a></li>
                        <li><a href="<?php echo e(route('profile.edit')); ?>" class="hover:text-emerald-400">Perfil</a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->role === 'admin'): ?>
                        <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-emerald-400">Dashboard</a></li>
                        <li><a href="<?php echo e(route('admin.tours.index')); ?>" class="hover:text-emerald-400">Tours</a></li>
                        <li><a href="<?php echo e(route('admin.guias.index')); ?>" class="hover:text-emerald-400">Guías</a></li>
                        <li><a href="<?php echo e(route('admin.reservaciones.index')); ?>" class="hover:text-emerald-400">Reservas</a></li>
                        <li><a href="<?php echo e(route('admin.reportes.index')); ?>" class="hover:text-emerald-400">Reportes</a></li>
                        <?php elseif(auth()->user()->role === 'guia'): ?>
                        <li><a href="<?php echo e(route('guia.dashboard')); ?>" class="hover:text-emerald-400">Dashboard</a></li>
                        <?php endif; ?>
                        <?php endif; ?>

                    </ul>
                </div>

                
                <div>
                    <h3 class="text-white font-semibold mb-3">Contacto</h3>
                    <p class="text-sm text-gray-400">Cartago, Colombia</p>
                </div>

            </div>

            <div class="border-t border-gray-800 text-center py-4 text-sm text-gray-500">
                © <?php echo e(date('Y')); ?> Turismo Cartago. Todos los derechos reservados.
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

</html><?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/layouts/app.blade.php ENDPATH**/ ?>