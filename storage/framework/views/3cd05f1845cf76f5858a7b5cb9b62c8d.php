<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Mis Reservas</h2>
                <p class="text-gray-500 mt-1">Gestiona tus reservaciones de tours</p>
            </div>
            <a href="<?php echo e(route('tours.index')); ?>" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Explorar Tours
            </a>
        </div>

        <?php if($reservas && $reservas->count() > 0): ?>
            <div class="grid gap-6">
                <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <?php if($reserva->tour && $reserva->tour->imagen): ?>
                                    <img src="<?php echo e(asset('storage/' . $reserva->tour->imagen)); ?>" alt="<?php echo e($reserva->tour->nombre); ?>" class="w-20 h-20 rounded-xl object-cover">
                                <?php else: ?>
                                    <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h3 class="font-bold text-gray-800 text-lg"><?php echo e($reserva->tour->nombre ?? 'Tour no disponible'); ?></h3>
                                    <div class="flex items-center gap-4 mt-1 text-sm text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <?php echo e(\Carbon\Carbon::parse($reserva->fecha ?? $reserva->created_at)->format('d/m/Y')); ?>

                                        </span>
                                        <?php if($reserva->tour): ?>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08-.402 2.599-1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                $<?php echo e(number_format($reserva->tour->precio, 0, ',', '.')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    <?php if($reserva->estado == 'pendiente'): ?> bg-yellow-100 text-yellow-700
                                    <?php elseif($reserva->estado == 'aprobada'): ?> bg-green-100 text-green-700
                                    <?php elseif($reserva->estado == 'cancelada'): ?> bg-red-100 text-red-700
                                    <?php elseif($reserva->estado == 'finalizada'): ?> bg-blue-100 text-blue-700
                                    <?php else: ?> bg-gray-100 text-gray-700
                                    <?php endif; ?>">
                                    <?php echo e(ucfirst($reserva->estado)); ?>

                                </span>

                                <?php if($reserva->estado == 'pendiente'): ?>
                                    <form action="<?php echo e(route('reservaciones.cancelar', $reserva->id)); ?>" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Cancelar
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if(method_exists($reservas, 'links')): ?>
                <div class="mt-8">
                    <?php echo e($reservas->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No tienes reservas aún</h3>
                <p class="text-gray-500 mb-6">Explora nuestros tours y reserva tu próxima aventura en Cartago</p>
                <a href="<?php echo e(route('tours.index')); ?>" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                    Ver Tours Disponibles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4-4m0 0l-4-4m4 4H3"/>
                    </svg>
                </a>
            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/reservaciones/index.blade.php ENDPATH**/ ?>