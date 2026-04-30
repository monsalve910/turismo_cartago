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

        <?php if(isset($tour)): ?>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">

            <!-- IMAGEN -->
            <div class="w-full h-64 md:h-96 bg-gradient-to-br from-emerald-400 to-teal-500 relative">
                <?php if($tour->imagen): ?>
                <img src="<?php echo e(asset('storage/' . $tour->imagen)); ?>"
                    class="w-full h-full object-cover">
                <?php endif; ?>

                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end">
                    <div class="p-8 text-white">
                        <h1 class="text-4xl font-bold mb-2">
                            <?php echo e($tour->nombre); ?>

                        </h1>

                        <?php if($tour->categoria): ?>
                        <span class="bg-white bg-opacity-20 px-4 py-1 rounded-full text-sm">
                            <?php echo e($tour->categoria->name); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="p-8">

                <div class="grid md:grid-cols-3 gap-8">

                    <!-- IZQUIERDA -->
                    <div class="md:col-span-2">

                        <!-- DESCRIPCIÓN -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">
                            Descripción
                        </h2>

                        <p class="text-gray-600 mb-6">
                            <?php echo e($tour->descripcion); ?>

                        </p>

                        <!-- ================= RUTAS ================= -->
                        <?php if($tour->rutas && $tour->rutas->count() > 0): ?>

                        <div class="mt-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                Rutas del tour
                            </h3>

                            <div class="flex flex-wrap gap-2">
                                <?php $__currentLoopData = $tour->rutas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    <?php echo e($ruta->nombre); ?>

                                </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <?php endif; ?>

                        <!-- ================= LUGARES ================= -->
                        <?php if($tour->rutas && $tour->rutas->count() > 0): ?>

                        <div class="mt-8">

                            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                                Lugares del recorrido
                            </h2>

                            <?php $__currentLoopData = $tour->rutas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="mb-6">

                                <h3 class="text-lg font-semibold text-emerald-600 mb-3">
                                    <?php echo e($ruta->nombre); ?>

                                </h3>

                                <?php if($ruta->lugares && $ruta->lugares->count() > 0): ?>

                                <div class="space-y-4">

                                    <?php $__currentLoopData = $ruta->lugares->sortBy('orden'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="flex gap-4 bg-gray-50 p-4 rounded-xl">

                                        <?php if($lugar->imagen): ?>
                                        <img src="<?php echo e(asset('storage/' . $lugar->imagen)); ?>"
                                            class="w-20 h-20 object-cover rounded-lg">
                                        <?php else: ?>
                                        <div class="w-20 h-20 bg-emerald-100 rounded-lg"></div>
                                        <?php endif; ?>

                                        <div>

                                            <h4 class="font-bold text-gray-800">
                                                <?php echo e($lugar->nombre); ?>

                                            </h4>

                                            <p class="text-sm text-gray-600">
                                                <?php echo e($lugar->descripcion); ?>

                                            </p>

                                            <span class="text-xs text-gray-400">
                                                Orden: <?php echo e($lugar->orden); ?>

                                            </span>

                                        </div>

                                    </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                                <?php else: ?>
                                <p class="text-sm text-gray-400">
                                    No hay lugares en esta ruta
                                </p>
                                <?php endif; ?>

                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                        <?php endif; ?>

                        <!-- ================= COMENTARIOS ================= -->
                        <div class="border-t pt-6 mt-8">

                            <h3 class="text-xl font-bold text-gray-800 mb-4">
                                Comentarios
                            </h3>

                            <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('comentarios.store')); ?>" method="POST"
                                class="mb-6 bg-gray-50 p-4 rounded-xl">

                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="tour_id" value="<?php echo e($tour->id); ?>">

                                <textarea name="comentario" rows="3" required
                                    class="w-full border-gray-300 rounded-lg p-3 mb-3"
                                    placeholder="Escribe tu comentario..."></textarea>

                                <div class="flex justify-between items-center">

                                    <div class="flex gap-1">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <button type="button"
                                            class="star-btn text-2xl text-gray-300 hover:text-yellow-400"
                                            data-rating="<?php echo e($i); ?>">
                                            ★
                                            </button>
                                            <?php endfor; ?>

                                            <input type="hidden" name="calificacion" id="rating-value">
                                    </div>

                                    <button type="submit"
                                        class="bg-emerald-600 text-white px-6 py-2 rounded-lg">
                                        Enviar
                                    </button>
                                </div>
                            </form>

                            <script>
                                document.querySelectorAll('.star-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        let rating = this.dataset.rating;
                                        document.getElementById('rating-value').value = rating;

                                        document.querySelectorAll('.star-btn').forEach((star, i) => {
                                            star.classList.toggle('text-yellow-400', i < rating);
                                            star.classList.toggle('text-gray-300', i >= rating);
                                        });
                                    });
                                });
                            </script>
                            <?php else: ?>
                            <p class="text-gray-500 mb-6">
                                Inicia sesión para comentar
                            </p>
                            <?php endif; ?>

                            <?php if($tour->comentarios && $tour->comentarios->count() > 0): ?>

                            <?php $__currentLoopData = $tour->comentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="bg-gray-50 p-4 rounded-xl mb-3">

                                <div class="flex justify-between">
                                    <p class="font-semibold">
                                        <?php echo e($comentario->user->name ?? 'Anónimo'); ?>

                                    </p>

                                    <div class="text-yellow-400">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php echo $i <=$comentario->calificacion ? '★' : '<span class="text-gray-300">★</span>'; ?>

                                            <?php endfor; ?>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-600 mt-2">
                                    <?php echo e($comentario->comentario); ?>

                                </p>

                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>
                            <p class="text-gray-500">
                                No hay comentarios aún.
                            </p>
                            <?php endif; ?>

                        </div>

                    </div>

                    <!-- SIDEBAR -->
                    <div>

                        <div class="bg-gray-50 rounded-xl p-6 sticky top-24">

                            <p class="text-gray-500 text-sm">Precio</p>
                            <p class="text-4xl font-bold text-emerald-600 mb-4">
                                $<?php echo e(number_format($tour->precio, 0, ',', '.')); ?>

                            </p>

                            <p class="text-sm text-gray-500">Fecha</p>
                            <p class="font-semibold mb-4">
                                <?php echo e(\Carbon\Carbon::parse($tour->fecha)->format('d/m/Y')); ?>

                            </p>

                            <p class="text-sm text-gray-500">Capacidad</p>
                            <p class="font-semibold mb-6">
                                <?php echo e($tour->capacidad); ?> personas
                            </p>

                            <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('reservaciones.create')); ?>?tour_id=<?php echo e($tour->id); ?>"
                                class="block text-center bg-emerald-600 text-white py-3 rounded-lg">
                                Reservar
                            </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>"
                                class="block text-center bg-gray-800 text-white py-3 rounded-lg">
                                Iniciar sesión
                            </a>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <a href="<?php echo e(route('tours.index')); ?>" class="text-emerald-600">
            ← Volver a tours
        </a>

        <?php else: ?>
        <p>Tour no encontrado</p>
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
<?php endif; ?><?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/tours/show.blade.php ENDPATH**/ ?>