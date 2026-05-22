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
                Guías Turísticos
            </h2>
            <a href="<?php echo e(route('admin.guias.create')); ?>"
               class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg hover:bg-emerald-700 transition font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Guía
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <?php if($guias && $guias->count() > 0): ?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">Nombre</th>
                                <th class="p-4 font-semibold text-gray-700">Correo</th>
                                <th class="p-4 font-semibold text-gray-700">Disponibilidad</th>
                                <th class="p-4 font-semibold text-gray-700">Fecha Creación</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__currentLoopData = $guias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">
                                                <?php echo e(strtoupper(substr($guia->name, 0, 1))); ?>

                                            </div>
                                            <p class="font-semibold text-gray-800"><?php echo e($guia->name); ?></p>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-600"><?php echo e($guia->email); ?></td>
                                    <td class="p-4">
                                        <div class="flex gap-1 flex-wrap">
                                            <?php
                                                $diasNombre = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
                                            ?>
                                            <?php $__currentLoopData = $diasNombre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($guia->guiaDisponibilidad->contains('dia_semana', $i)): ?>
                                                    <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded text-xs font-semibold">
                                                        <?php echo e($dia); ?>

                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-gray-100 text-gray-400 px-2 py-0.5 rounded text-xs">
                                                        <?php echo e($dia); ?>

                                                    </span>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-500 text-sm"><?php echo e(optional($guia->created_at)->format('d/m/Y')); ?></td>
                                    <td class="p-4">
                                        <div class="flex justify-center gap-3">
                                            <a href="<?php echo e(route('admin.guias.edit', $guia)); ?>"
                                               class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">
                                                Editar
                                            </a>
                                            <a href="<?php echo e(route('admin.guias.disponibilidad', $guia)); ?>"
                                               class="text-amber-600 hover:text-amber-800 font-medium text-sm transition">
                                                Disponibilidad
                                            </a>
                                            <form action="<?php echo e(route('admin.guias.destroy', $guia)); ?>" method="POST"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este guía?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">
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
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No hay guías registrados</h3>
                <p class="text-gray-500 mb-6">Comienza creando tu primer guía turístico</p>
                <a href="<?php echo e(route('admin.guias.create')); ?>"
                   class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Primer Guía
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
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/admin/guias/index.blade.php ENDPATH**/ ?>