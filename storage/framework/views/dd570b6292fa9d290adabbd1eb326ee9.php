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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Nuevo Tour</h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <form action="<?php echo e(route('admin.tours.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nombre del Tour</label>
                        <input type="text" name="nombre" required
                               class="w-full rounded-xl border-gray-300 p-2.5"
                               placeholder="Ej: Tour Valle del Cauca">
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Descripci�n</label>
                        <textarea name="descripcion" rows="3" required
                                  class="w-full rounded-xl border-gray-300 p-2.5"></textarea>
                    </div>

                    
                    <div class="grid grid-cols-2 gap-4">
                        <input type="number" name="precio" placeholder="Precio"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <input type="number" name="capacidad" placeholder="Capacidad"
                               class="w-full rounded-xl border-gray-300 p-2.5">
                    </div>

                    
                    <div class="grid grid-cols-2 gap-4">
                        <input type="date" name="fecha"
                               class="w-full rounded-xl border-gray-300 p-2.5">

                        <select name="categoria_id"
                                class="w-full rounded-xl border-gray-300 p-2.5">
                            <option value="">Categoria</option>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Ruta</label>
                        <select name="ruta_id" required
                                class="w-full rounded-xl border-gray-300 p-2.5">
                            <option value="">Seleccione una ruta</option>
                            <?php $__currentLoopData = $rutas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ruta->id); ?>"><?php echo e($ruta->nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Guía Asignado</label>
                        <select name="guia_id" id="guia-select"
                                class="w-full rounded-xl border-gray-300 p-2.5">
                            <option value="">Seleccione un guía</option>
                            <?php $__currentLoopData = $guias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($guia->id); ?>"
                                    data-categoria="<?php echo e($guia->categoria_id ?? ''); ?>"
                                    <?php echo e(old('guia_id') == $guia->id ? 'selected' : ''); ?>>
                                    <?php echo e($guia->name); ?> <?php if($guia->categoria): ?>(<?php echo e($guia->categoria->name); ?>)<?php endif; ?>
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['guia_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Horarios Disponibles</label>
                        <div id="horarios-container">
                            <div class="flex gap-2 mb-2 horario-item">
                                <input type="time" name="horarios[]"
                                       class="w-full rounded-xl border-gray-300 p-2.5">
                                <button type="button" onclick="this.parentElement.remove()"
                                        class="px-3 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200">X</button>
                            </div>
                        </div>
                        <button type="button" onclick="agregarHorario()"
                                class="text-emerald-600 hover:text-emerald-800 text-sm font-semibold">
                            + Agregar otro horario
                        </button>
                    </div>

                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Imagen</label>
                        <input type="file" name="imagen"
                               class="w-full rounded-xl border-gray-300 p-2.5 bg-gray-50">
                    </div>

                    
                    <div class="flex gap-4 pt-4 border-t">
                        <button class="flex-1 bg-emerald-600 text-white py-2.5 rounded-xl">
                            Guardar Tour
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

    <script>
        function agregarHorario() {
            const container = document.getElementById('horarios-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2 mb-2 horario-item';
            div.innerHTML = '<input type="time" name="horarios[]" class="w-full rounded-xl border-gray-300 p-2.5">' +
                '<button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200">X</button>';
            container.appendChild(div);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const categoriaSelect = document.querySelector('select[name="categoria_id"]');
            const guiaSelect = document.getElementById('guia-select');

            function filtrarGuias() {
                const catId = categoriaSelect.value;
                const opciones = guiaSelect.querySelectorAll('option');
                opciones.forEach(opt => {
                    if (opt.value === '') return;
                    const optCat = opt.getAttribute('data-categoria');
                    if (!catId || optCat === catId) {
                        opt.style.display = '';
                    } else {
                        opt.style.display = 'none';
                    }
                });
                if (guiaSelect.selectedOptions[0] && guiaSelect.selectedOptions[0].style.display === 'none') {
                    guiaSelect.value = '';
                }
            }

            categoriaSelect.addEventListener('change', filtrarGuias);
            filtrarGuias();
        });
    </script>
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
<?php /**PATH C:\laragon\www\turismo_cartago\resources\views/admin/tours/create.blade.php ENDPATH**/ ?>