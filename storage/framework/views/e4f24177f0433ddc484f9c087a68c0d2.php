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
        <div class="flex items-center gap-4">
            <a href="<?php echo e(route('admin.rutas.index')); ?>" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight"><?php echo e($ruta->nombre); ?></h2>
                <p class="text-sm text-gray-500">Detalles de la ruta turística</p>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800"><?php echo e($ruta->nombre); ?></h3>
                                <p class="text-gray-600 mt-2"><?php echo e($ruta->descripcion); ?></p>
                            </div>
                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <?php echo e($ruta->lugares ? $ruta->lugares->count() : 0); ?> lugares
                            </span>
                        </div>

                        <?php if($ruta->lugares && $ruta->lugares->count() > 0): ?>
                            <div class="border-t pt-6">
                                <h4 class="text-lg font-bold text-gray-800 mb-4">Lugares en esta ruta</h4>
                                <div class="space-y-3">
                                    <?php $__currentLoopData = $ruta->lugares->sortBy('orden'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                                                <?php echo e($lugar->orden); ?>

                                            </div>
                                            <?php if($lugar->imagen): ?>
                                                <img src="<?php echo e(asset('storage/' . $lugar->imagen)); ?>" alt="<?php echo e($lugar->nombre); ?>" class="w-12 h-12 object-cover rounded-lg">
                                            <?php endif; ?>
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-800"><?php echo e($lugar->nombre); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo e(Str::limit($lugar->descripcion, 60)); ?></p>
                                            </div>
                                            <a href="<?php echo e(route('admin.lugares.edit', $lugar->id)); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium opacity-0 group-hover:opacity-100 transition">
                                                Editar
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Acciones</h4>
                        <div class="space-y-3">
                            <a href="<?php echo e(route('admin.rutas.edit', $ruta->id)); ?>" class="block w-full text-center bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition font-medium">
                                Editar Ruta
                            </a>
                            <a href="<?php echo e(route('admin.rutas.index')); ?>" class="block w-full text-center bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition font-medium">
                                Volver al Listado
                            </a>
                        </div>
                    </div>

                    <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                        <h4 class="text-lg font-bold text-blue-800 mb-2">Información</h4>
                        <p class="text-sm text-blue-700 mb-4">Ruta creada el <?php echo e($ruta->created_at ? $ruta->created_at->format('d/m/Y') : 'N/A'); ?></p>
                        <p class="text-sm text-blue-600">Desde aquí puedes gestionar los lugares que componen esta ruta turística.</p>
                    </div>
                </div>
            </div>
        </div>
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
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/admin/rutas/show.blade.php ENDPATH**/ ?>