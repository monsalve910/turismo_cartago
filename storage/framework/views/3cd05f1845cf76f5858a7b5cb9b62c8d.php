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

        
        <?php if(session('success')): ?>
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Mis Reservas</h2>
                <p class="text-gray-500 mt-1">Gestiona tus reservaciones de tours</p>
            </div>

            <a href="<?php echo e(route('tours.index')); ?>"
                class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold">
                Explorar Tours
            </a>
        </div>

        <?php if($reservas && $reservas->count() > 0): ?>
        <div class="grid gap-6">
            <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
            $status = strtolower(trim($reserva->status));
            ?>

            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                    
                    <div class="flex items-center gap-4">
                        <?php if($reserva->tour && $reserva->tour->imagen): ?>
                        <img src="<?php echo e(asset('storage/' . $reserva->tour->imagen)); ?>"
                            class="w-20 h-20 rounded-xl object-cover">
                        <?php else: ?>
                        <div class="w-20 h-20 rounded-xl bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500 text-sm">Sin imagen</span>
                        </div>
                        <?php endif; ?>

                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">
                                <?php echo e($reserva->tour->nombre ?? 'Tour no disponible'); ?>

                            </h3>

                            <div class="text-sm text-gray-500 mt-1">
                                📅 <?php echo e(\Carbon\Carbon::parse($reserva->fecha_reservacion)->format('d/m/Y')); ?>

                            </div>

                            <?php if($reserva->tour): ?>
                            <div class="text-sm text-gray-500">
                                💰 $<?php echo e(number_format($reserva->tour->precio, 0, ',', '.')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="flex items-center gap-4">

                        
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    <?php if($status == 'pendiente'): ?> bg-yellow-100 text-yellow-700
                                    <?php elseif($status == 'aprobado'): ?> bg-green-100 text-green-700
                                    <?php elseif($status == 'cancelado'): ?> bg-red-100 text-red-700
                                    <?php elseif($status == 'finalizado'): ?> bg-blue-100 text-blue-700
                                    <?php else: ?> bg-gray-100 text-gray-700
                                    <?php endif; ?>">

                            <?php if($status == 'pendiente'): ?> Pendiente
                            <?php elseif($status == 'aprobada'): ?> Aprobada
                            <?php elseif($status == 'cancelada'): ?> Cancelada
                            <?php elseif($status == 'finalizada'): ?> Finalizada
                            <?php endif; ?>

                        </span>

                        
                        <?php if($status === 'pendiente'): ?>
                        <form action="<?php echo e(route('reservaciones.cancelar', $reserva->id)); ?>"
                            method="POST"
                            onsubmit="return confirm('¿Cancelar reserva?')">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('POST'); ?> 

                            <button type="submit"
                                class="text-red-600 hover:text-red-800 text-sm font-medium">
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
            <h3 class="text-xl font-bold text-gray-800 mb-2">No tienes reservas aún</h3>
            <p class="text-gray-500 mb-6">Explora nuestros tours y reserva tu próxima aventura</p>

            <a href="<?php echo e(route('tours.index')); ?>"
                class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                Ver Tours Disponibles
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
<?php endif; ?><?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/reservaciones/index.blade.php ENDPATH**/ ?>