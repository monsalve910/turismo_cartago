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
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis Reservas
            </h2>
            <a href="<?php echo e(route('tours.index')); ?>" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition font-semibold text-sm">
                Explorar Tours
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
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
            <?php if($errors->any()): ?>
                <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'error','message' => 'Se encontraron los siguientes errores:','dismissible' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','message' => 'Se encontraron los siguientes errores:','dismissible' => true]); ?>
                    <ul class="list-disc pl-5 space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
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
            <?php endif; ?>
        </div>

        <?php if($reservas && $reservas->count() > 0): ?>
            <div class="max-w-4xl mx-auto space-y-4">
                <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $tourDate = \Carbon\Carbon::parse($reserva->tour->fecha);
                        $daysUntilTour = now()->startOfDay()->diffInDays($tourDate, false);
                        $puedeCancelar = in_array($reserva->status, ['pendiente', 'aprobada']) && $daysUntilTour >= 2;
                    ?>
                    <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                        <div class="flex items-start gap-4">
                            <?php if($reserva->tour->imagen): ?>
                                <img src="<?php echo e(asset('storage/' . $reserva->tour->imagen)); ?>" alt="<?php echo e($reserva->tour->nombre); ?>" class="w-24 h-24 object-cover rounded-xl">
                            <?php else: ?>
                                <div class="w-24 h-24 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center text-white font-bold">
                                    <?php echo e(strtoupper(substr($reserva->tour->nombre, 0, 2))); ?>

                                </div>
                            <?php endif; ?>

                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800"><?php echo e($reserva->tour->nombre); ?></h3>
                                        <p class="text-sm text-gray-500 mt-1">
                                            <?php echo e($reserva->fecha_reservacion ? $reserva->fecha_reservacion->format('d/m/Y') : 'Fecha no disponible'); ?>

                                        </p>
                                    </div>
                                    <?php
                                      $statusClasses = match($reserva->status) {
                                      'pendiente' => 'bg-yellow-100 text-yellow-700',
                                        'aprobada' => 'bg-green-100 text-green-700',
                                        'iniciada' => 'bg-cyan-100 text-cyan-700',
                                        'finalizada' => 'bg-blue-100 text-blue-700',
                                        default => 'bg-red-100 text-red-700',
                                    };
                                ?>

                                <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo e($statusClasses); ?>">
                                    <?php echo e(ucfirst($reserva->status)); ?>

                                </span>
                                </div>
                                <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
                                    <span><?php echo e($reserva->cantidad_personas); ?> persona(s)</span>
                                    <span>COP $<?php echo e(number_format($reserva->tour->precio, 0, ',', '.')); ?></span>
                                    <?php if($reserva->guia): ?>
                                        <span class="text-amber-600 font-medium">Guía: <?php echo e($reserva->guia->name); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if($puedeCancelar): ?>
                                    <div class="mt-3 flex items-center gap-3">
                                        <?php if (isset($component)) { $__componentOriginal5ef37b8f54f924a0e00edd9e11ef4c49 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5ef37b8f54f924a0e00edd9e11ef4c49 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm','data' => ['message' => '¿Cancelar esta reservación?']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['message' => '¿Cancelar esta reservación?']); ?>
                                        <form action="<?php echo e(route('reservaciones.cancelar', $reserva->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium border border-red-300 px-3 py-1.5 rounded-lg hover:bg-red-50 transition">
                                                Cancelar Reservación
                                            </button>
                                        </form>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5ef37b8f54f924a0e00edd9e11ef4c49)): ?>
<?php $attributes = $__attributesOriginal5ef37b8f54f924a0e00edd9e11ef4c49; ?>
<?php unset($__attributesOriginal5ef37b8f54f924a0e00edd9e11ef4c49); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5ef37b8f54f924a0e00edd9e11ef4c49)): ?>
<?php $component = $__componentOriginal5ef37b8f54f924a0e00edd9e11ef4c49; ?>
<?php unset($__componentOriginal5ef37b8f54f924a0e00edd9e11ef4c49); ?>
<?php endif; ?>
                                        <span class="text-xs text-gray-400">Puedes cancelar hasta <?php echo e($tourDate->subDays(2)->format('d/m/Y')); ?></span>
                                    </div>
                                <?php elseif($reserva->status === 'aprobada' && $daysUntilTour < 2 && $daysUntilTour >= 0): ?>
                                    <p class="mt-2 text-xs text-red-500">Ya no puedes cancelar esta reservación (menos de 2 días de anticipación).</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(method_exists($reservas, 'links')): ?>
                    <div class="mt-8">
                        <?php echo e($reservas->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">No tienes reservaciones</h3>
                    <p class="text-gray-500 mb-6">Explora los tours disponibles y haz tu primera reservación.</p>
                    <a href="<?php echo e(route('tours.index')); ?>" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        Explorar Tours
                    </a>
                </div>
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