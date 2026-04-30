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
        <div class="flex items-center gap-3">
            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de Administración
            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-emerald-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Tours</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalTours ?? 0); ?></p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Reservas</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalReservas ?? 0); ?></p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Usuarios</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalUsuarios ?? 0); ?></p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-amber-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Rutas</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?php echo e($totalRutas ?? 0); ?></p>
                    </div>
                    <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Accesos Rápidos
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <a href="<?php echo e(route('admin.tours.create')); ?>" class="flex flex-col items-center gap-2 p-4 bg-emerald-50 rounded-xl hover:bg-emerald-100 transition group">
                    <svg class="w-8 h-8 text-emerald-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="font-medium text-emerald-700 text-sm">Crear Tour</span>
                </a>
                <a href="<?php echo e(route('admin.rutas.create')); ?>" class="flex flex-col items-center gap-2 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition group">
                    <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="font-medium text-blue-700 text-sm">Crear Ruta</span>
                </a>
                <a href="<?php echo e(route('admin.lugares.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition group">
                    <svg class="w-8 h-8 text-indigo-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="font-medium text-indigo-700 text-sm">Lugares</span>
                </a>
                <a href="<?php echo e(route('admin.categorias.create')); ?>" class="flex flex-col items-center gap-2 p-4 bg-amber-50 rounded-xl hover:bg-amber-100 transition group">
                    <svg class="w-8 h-8 text-amber-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span class="font-medium text-amber-700 text-sm">Categoría</span>
                </a>
                <a href="<?php echo e(route('admin.administradores.create')); ?>" class="flex flex-col items-center gap-2 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition group">
                    <svg class="w-8 h-8 text-purple-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span class="font-medium text-purple-700 text-sm">Admin</span>
                </a>
                <a href="<?php echo e(route('admin.reportes.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-red-50 rounded-xl hover:bg-red-100 transition group">
                    <svg class="w-8 h-8 text-red-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium text-red-700 text-sm">Reportes</span>
                </a>
            </div>
        </div>

        <?php if(isset($recentReservas) && $recentReservas->count() > 0): ?>
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Reservas Recientes
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4 font-semibold text-gray-700">Tour</th>
                                <th class="p-4 font-semibold text-gray-700">Usuario</th>
                                <th class="p-4 font-semibold text-gray-700">Fecha</th>
                                <th class="p-4 font-semibold text-gray-700">Estado</th>
                                <th class="p-4 font-semibold text-gray-700 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recentReservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t hover:bg-gray-50 transition">
                                    <td class="p-4 font-medium"><?php echo e($reserva->tour->nombre ?? 'N/A'); ?></td>
                                    <td class="p-4"><?php echo e($reserva->user->name ?? 'N/A'); ?></td>
                                    <td class="p-4"><?php echo e(\Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y')); ?></td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            <?php if($reserva->estado == 'pendiente'): ?> bg-yellow-100 text-yellow-700
                                            <?php elseif($reserva->estado == 'aprobada'): ?> bg-green-100 text-green-700
                                            <?php elseif($reserva->estado == 'cancelada'): ?> bg-red-100 text-red-700
                                            <?php elseif($reserva->estado == 'finalizada'): ?> bg-blue-100 text-blue-700
                                            <?php else: ?> bg-gray-100 text-gray-700
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($reserva->status)); ?>

                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="<?php echo e(route('admin.reservaciones.index')); ?>" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Ver</a>
                                    </td>
                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="<?php echo e(route('admin.tours.index')); ?>" class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-emerald-500 rounded-xl p-3 group-hover:scale-110 transition">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500">Tours</dt>
                            <dd class="text-lg font-bold text-gray-900">Gestionar Tours</dd>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.rutas.index')); ?>" class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-xl p-3 group-hover:scale-110 transition">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500">Rutas</dt>
                            <dd class="text-lg font-bold text-gray-900">Gestionar Rutas</dd>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.lugares.index')); ?>" class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-xl p-3 group-hover:scale-110 transition">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500">Lugares</dt>
                            <dd class="text-lg font-bold text-gray-900">Gestionar Lugares</dd>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.categorias.index')); ?>" class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-amber-500 rounded-xl p-3 group-hover:scale-110 transition">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500">Categorías</dt>
                            <dd class="text-lg font-bold text-gray-900">Gestionar Categorías</dd>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.reservaciones.index')); ?>" class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-teal-500 rounded-xl p-3 group-hover:scale-110 transition">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500">Reservaciones</dt>
                            <dd class="text-lg font-bold text-gray-900">Gestionar Reservas</dd>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.administradores.index')); ?>" class="bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-xl transition group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gray-700 rounded-xl p-3 group-hover:scale-110 transition">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500">Administradores</dt>
                            <dd class="text-lg font-bold text-gray-900">Gestionar Admins</dd>
                        </div>
                    </div>
                </div>
            </a>
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
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>