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
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <a href="<?php echo e(url()->previous()); ?>" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-800 font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Reservar Tour</h2>
                <p class="text-gray-500 mt-1">Completa los datos para reservar tu tour</p>
            </div>

            <?php if(isset($tour)): ?>
                <div class="bg-emerald-50 rounded-xl p-4 mb-6 flex items-center gap-4">
                    <?php if($tour->imagen): ?>
                        <img src="<?php echo e(asset('storage/' . $tour->imagen)); ?>" alt="<?php echo e($tour->nombre); ?>" class="w-16 h-16 rounded-lg object-cover">
                    <?php endif; ?>
                    <div>
                        <h3 class="font-bold text-gray-800"><?php echo e($tour->nombre); ?></h3>
                        <p class="text-sm text-gray-600"><?php echo e(\Carbon\Carbon::parse($tour->fecha)->format('d/m/Y')); ?>  $<?php echo e(number_format($tour->precio, 0, ',', '.')); ?>  <?php echo e($tour->capacidad); ?> cupos</p>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('reservaciones.store')); ?>" method="POST" class="space-y-5">
                <?php echo csrf_field(); ?>

                <?php if(isset($tour)): ?>
                    <input type="hidden" name="tour_id" value="<?php echo e($tour->id); ?>">
                <?php else: ?>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Seleccionar Tour</label>
                        <select name="tour_id" id="tour-select" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                            <option value="">Elige un tour...</option>
                            <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t->id); ?>"><?php echo e($t->nombre); ?> - $<?php echo e(number_format($t->precio, 0, ',', '.')); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['tour_id'];
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
                <?php endif; ?>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Numero de Personas</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <input type="number" name="numero_personas" min="1" max="<?php echo e($tour->capacidad ?? 10); ?>" required
                               class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                               placeholder="Cantidad de personas">
                    </div>
                    <?php $__errorArgs = ['numero_personas'];
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
                   <?php if(isset($tour)): ?>
    <div>
        <label class="block text-gray-700 font-semibold mb-2">
            Fecha del Tour
        </label>

        <div class="w-full rounded-lg bg-gray-100 p-3 text-gray-700">
            <?php echo e(\Carbon\Carbon::parse($tour->fecha)->format('d/m/Y')); ?>

        </div>
    </div>
<?php endif; ?>
                </div>

                <?php if(isset($tour) && $tour->horarios && $tour->horarios->count() > 0): ?>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Horario del Tour</label>
                    <select name="hora_tour" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5">
                        <option value="">Seleccione un horario...</option>
                        <?php $__currentLoopData = $tour->horarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($horario->hora); ?>"><?php echo e(\Carbon\Carbon::parse($horario->hora)->format("H:i")); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ["hora_tour"];
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
                <?php endif; ?>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Comentarios Adicionales (Opcional)</label>
                    <textarea name="comentarios" rows="3"
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-2.5"
                              placeholder="Algun requerimiento especial..."></textarea>
                </div>

                    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="text-sm text-green-800">Tu reservacion sera <strong>aprobada</strong></p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 px-6 rounded-lg hover:bg-emerald-700 transition font-semibold">
                        Confirmar Reserva
                    </button>
                    <a href="<?php echo e(route('tours.index')); ?>" class="flex-1 text-center bg-gray-800 text-white py-2.5 px-6 rounded-lg hover:bg-gray-900 transition font-semibold">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php if(!isset($tour)): ?>
    <script>
        document.getElementById("tour-select")?.addEventListener("change", function() {
            if (this.value) {
                window.location.href = "<?php echo e(route('reservaciones.create')); ?>?tour_id=" + this.value;
            }
        });
    </script>
    <?php endif; ?>
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
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/reservaciones/create.blade.php ENDPATH**/ ?>