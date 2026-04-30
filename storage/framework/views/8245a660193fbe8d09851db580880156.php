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
                Gestión de Tours
            </h2>

            <a href="<?php echo e(route('admin.tours.create')); ?>"
               class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Tour
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">

        <?php if($tours && $tours->count() > 0): ?>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">

                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4">Imagen</th>
                                <th class="p-4">Nombre</th>

                                
                                <th class="p-4">Ruta</th>

                                <th class="p-4">Categoría</th>
                                <th class="p-4">Precio</th>
                                <th class="p-4">Fecha</th>
                                <th class="p-4 text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition">

                                    
                                    <td class="p-4">
                                        <?php if($tour->imagen): ?>
                                            <img src="<?php echo e(asset('storage/' . $tour->imagen)); ?>"
                                                 class="w-16 h-16 rounded-lg object-cover">
                                        <?php else: ?>
                                            <div class="w-16 h-16 rounded-lg bg-gray-200"></div>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="p-4">
                                        <p class="font-semibold text-gray-800"><?php echo e($tour->nombre); ?></p>
                                        <p class="text-xs text-gray-500">
                                            <?php echo e(Str::limit($tour->descripcion, 50)); ?>

                                        </p>
                                    </td>

                                    
                                    <td class="p-4">
                                        <?php if($tour->ruta): ?>
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                <?php echo e($tour->ruta->nombre); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400 text-sm">Sin ruta</span>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="p-4">
                                        <?php if($tour->categoria): ?>
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                                <?php echo e($tour->categoria->name); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400">Sin categoría</span>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="p-4 font-semibold text-emerald-600">
                                        $<?php echo e(number_format($tour->precio, 0, ',', '.')); ?>

                                    </td>

                                    
                                    <td class="p-4 text-gray-600 text-sm">
                                        <?php echo e(\Carbon\Carbon::parse($tour->fecha)->format('d/m/Y')); ?>

                                    </td>

                                    
                                    <td class="p-4">
                                        <div class="flex justify-center gap-3">

                                            <a href="<?php echo e(route('admin.tours.edit', $tour)); ?>"
                                               class="text-blue-600 hover:text-blue-800">
                                                Editar
                                            </a>

                                            <form action="<?php echo e(route('admin.tours.destroy', $tour)); ?>"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Eliminar este tour?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button class="text-red-600 hover:text-red-800">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>

                </div>
            </div>

        <?php else: ?>

            <div class="bg-white p-12 text-center rounded-2xl shadow">
                <h3 class="text-xl font-bold">No hay tours registrados</h3>
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
<?php endif; ?><?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/admin/tours/index.blade.php ENDPATH**/ ?>