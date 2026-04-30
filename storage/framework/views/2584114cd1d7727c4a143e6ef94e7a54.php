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
            <a href="<?php echo e(route('admin.tours.index')); ?>" class="text-emerald-600 hover:text-emerald-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Tour</h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <form action="<?php echo e(route('admin.tours.update', $tour)); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nombre del Tour</label>
                        <input type="text" name="nombre"
                               value="<?php echo e(old('nombre', $tour->nombre)); ?>"
                               class="w-full rounded-xl border-gray-300 p-2.5">
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="w-full rounded-xl border-gray-300 p-2.5"><?php echo e(old('descripcion', $tour->descripcion)); ?></textarea>
                    </div>

                    
                    <div class="grid grid-cols-2 gap-4">
                        <input type="number" name="precio"
                               value="<?php echo e(old('precio', $tour->precio)); ?>"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <input type="number" name="capacidad"
                               value="<?php echo e(old('capacidad', $tour->capacidad)); ?>"
                               class="w-full rounded-xl border-gray-300 p-2.5">
                    </div>

                    
                    <div class="grid grid-cols-2 gap-4">
                        <input type="date" name="fecha"
                               value="<?php echo e(old('fecha', $tour->fecha)); ?>"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <select name="categoria_id"
                                class="w-full rounded-xl border-gray-300 p-2.5">
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"
                                    <?php echo e($tour->categoria_id == $cat->id ? 'selected' : ''); ?>>
                                    <?php echo e($cat->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Ruta</label>

                        <select name="ruta_id" required
                                class="w-full rounded-xl border-gray-300 p-2.5">

                            <option value="">Seleccione una ruta</option>

                            <?php $__currentLoopData = $rutas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ruta->id); ?>"
                                    <?php echo e($tour->ruta_id == $ruta->id ? 'selected' : ''); ?>>
                                    <?php echo e($ruta->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Cambiar Imagen</label>
                        <input type="file" name="imagen"
                               class="w-full rounded-xl border-gray-300 p-2.5 bg-gray-50">
                    </div>

                    
                    <div class="flex gap-4 pt-4 border-t">
                        <button class="flex-1 bg-emerald-600 text-white py-2.5 rounded-xl">
                            Actualizar Tour
                        </button>

                        <a href="<?php echo e(route('admin.tours.index')); ?>"
                           class="flex-1 text-center bg-gray-100 py-2.5 rounded-xl">
                            Cancelar
                        </a>
                    </div>

                </form>

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
<?php endif; ?><?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/admin/tours/edit.blade.php ENDPATH**/ ?>