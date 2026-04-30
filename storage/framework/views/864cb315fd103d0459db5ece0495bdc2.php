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
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Tours Disponibles</h2>
                <p class="text-gray-500 mt-1">Explora y gestiona los tours en Cartago</p>
            </div>
            <?php if(auth()->check() && auth()->user()->is_admin): ?>
                <a href="<?php echo e(route('admin.tours.create')); ?>" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Nuevo Tour
                </a>
            <?php endif; ?>
        </div>

        <?php if($tours && $tours->count() > 0): ?>
            <!-- Cards Grid -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition group">
                        <?php if($tour->imagen): ?>
                            <img src="<?php echo e(asset('storage/' . $tour->imagen)); ?>" alt="<?php echo e($tour->nombre); ?>" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-800"><?php echo e($tour->nombre); ?></h3>
                                <?php if($tour->categoria): ?>
                                    <span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">
                                        <?php echo e($tour->categoria->name); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo e($tour->descripcion); ?></p>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-emerald-600 font-bold text-xl">
                                    $<?php echo e(number_format($tour->precio, 0, ',', '.')); ?>

                                </div>
                                <div class="text-gray-500 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <?php echo e(\Carbon\Carbon::parse($tour->fecha)->format('d/m/Y')); ?>

                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('tours.show', $tour)); ?>" class="flex-1 text-center bg-emerald-600 text-white py-2 rounded-lg hover:bg-emerald-700 transition font-medium text-sm">
                                    Ver Detalles
                                </a>
                            <?php if(auth()->check() && auth()->user()->is_admin): ?>
                                    <a href="<?php echo e(route('tours.edit', $tour)); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                                        Editar
                                    </a>
                                    <form action="<?php echo e(route('tours.destroy', $tour)); ?>" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este tour?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if(method_exists($tours, 'links')): ?>
                <div class="mt-8">
                    <?php echo e($tours->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No hay tours registrados</h3>
                <p class="text-gray-500 mb-6">Comienza creando tu primer tour turístico</p>
                <?php if(auth()->check() && auth()->user()->is_admin): ?>
                    <a href="<?php echo e(route('admin.tours.create')); ?>" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Crear Primer Tour
                    </a>
                <?php endif; ?>
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
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/tours/index.blade.php ENDPATH**/ ?>