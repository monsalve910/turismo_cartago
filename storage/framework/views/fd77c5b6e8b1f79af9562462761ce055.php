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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Ruta</h2>
                <p class="text-sm text-gray-500"><?php echo e($ruta->nombre); ?></p>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">Información de la Ruta</h3>
                        <p class="text-gray-500 mt-1">Modifica los datos de la ruta turística</p>
                    </div>

                    <form action="<?php echo e(route('admin.rutas.update', $ruta->id)); ?>" method="POST" class="space-y-5">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div>
                            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre de la Ruta</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                </div>
                                <input type="text" name="nombre" id="nombre" value="<?php echo e($ruta->nombre); ?>" required
                                       class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            </div>
                            <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" required
                                      class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"><?php echo e($ruta->descripcion); ?></textarea>
                            <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t">
                            <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-xl hover:bg-emerald-700 transition font-semibold shadow-lg hover:shadow-xl">
                                Actualizar Ruta
                            </button>
                            <a href="<?php echo e(route('admin.rutas.index')); ?>" class="flex-1 text-center bg-gray-100 text-gray-700 py-2.5 px-6 rounded-xl hover:bg-gray-200 transition font-semibold">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Lugares</h3>
                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                <?php echo e($ruta->lugares ? $ruta->lugares->count() : 0); ?> lugares
                            </span>
                        </div>

                        <?php if($ruta->lugares && $ruta->lugares->count() > 0): ?>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $ruta->lugares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-gray-50 p-4 rounded-xl flex items-center justify-between hover:bg-gray-100 transition group">
                                        <div class="flex items-center gap-4">
                                            <?php if($lugar->imagen): ?>
                                                <img src="<?php echo e(asset('storage/' . $lugar->imagen)); ?>"
                                                     class="w-12 h-12 object-cover rounded-lg">
                                            <?php else: ?>
                                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-lg flex items-center justify-center text-white font-bold">
                                                    <?php echo e($lugar->orden); ?>

                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <p class="font-medium text-gray-800"><?php echo e($lugar->nombre); ?></p>
                                                <p class="text-xs text-gray-500">Orden: <?php echo e($lugar->orden); ?></p>
                                            </div>
                                        </div>

                                        <form action="<?php echo e(route('admin.lugares.destroy', $lugar->id)); ?>" method="POST" onsubmit="return confirm('¿Eliminar este lugar?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium opacity-0 group-hover:opacity-100 transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-6">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <p class="text-gray-500 text-sm">No hay lugares agregados aún.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Agregar Lugar</h4>

                        <form action="<?php echo e(route('admin.rutas.lugares', $ruta->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                            <?php echo csrf_field(); ?>

                            <div>
                                <label for="lugar_nombre" class="block text-gray-700 text-sm font-medium mb-1">Nombre</label>
                                <input type="text" name="nombre" id="lugar_nombre" placeholder="Nombre del lugar" required
                                       class="w-full border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            </div>

                            <div>
                                <label for="lugar_descripcion" class="block text-gray-700 text-sm font-medium mb-1">Descripción</label>
                                <textarea name="descripcion" id="lugar_descripcion" rows="2" placeholder="Descripción corta"
                                          class="w-full border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="lugar_orden" class="block text-gray-700 text-sm font-medium mb-1">Orden</label>
                                    <input type="number" name="orden" id="lugar_orden" placeholder="Orden" min="1" required
                                           class="w-full border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                                </div>
                                <div>
                                    <label for="lugar_imagen" class="block text-gray-700 text-sm font-medium mb-1">Imagen</label>
                                    <input type="file" name="imagen" id="lugar_imagen"
                                           class="w-full border-gray-300 rounded-xl p-2 bg-gray-50 text-sm">
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition font-semibold">
                                Agregar Lugar
                            </button>
                        </form>
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
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/admin/rutas/edit.blade.php ENDPATH**/ ?>