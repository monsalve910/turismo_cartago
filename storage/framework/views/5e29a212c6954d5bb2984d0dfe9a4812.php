<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'message' => '¿Estás seguro de realizar esta acción?',
    'confirmText' => 'Sí, confirmar',
    'cancelText' => 'Cancelar',
    'type' => 'danger',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'message' => '¿Estás seguro de realizar esta acción?',
    'confirmText' => 'Sí, confirmar',
    'cancelText' => 'Cancelar',
    'type' => 'danger',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$iconColor = match($type) {
    'danger' => 'text-red-500',
    'warning' => 'text-amber-500',
    'info' => 'text-blue-500',
    default => 'text-red-500',
};
$confirmBg = match($type) {
    'danger' => 'bg-red-600 hover:bg-red-700',
    'warning' => 'bg-amber-600 hover:bg-amber-700',
    'info' => 'bg-blue-600 hover:bg-blue-700',
    default => 'bg-red-600 hover:bg-red-700',
};
?>

<div x-data="{ open: false, formEl: null }"
     x-init="() => {
         formEl = $el.querySelector('form');
         if (formEl) {
             formEl.addEventListener('submit', (e) => {
                 e.preventDefault();
                 open = true;
             });
         }
     }"
     <?php echo e($attributes); ?>>
    <?php echo e($slot); ?>


    <template x-teleport="body">
        <div x-show="open"
             class="fixed inset-0 z-[100] flex items-center justify-center"
             style="display:none"
             role="dialog"
             aria-modal="true"
             aria-labelledby="confirm-title">
            <div class="fixed inset-0 bg-black/50" @click="open = false"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl p-6 max-w-md w-full mx-4"
                 @keydown.escape.window="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-6 h-6 <?php echo e($iconColor); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <h3 id="confirm-title" class="text-lg font-bold text-gray-800">Confirmar acción</h3>
                </div>
                <p class="text-gray-600"><?php echo e($message); ?></p>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="open = false"
                            class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 font-medium transition text-gray-700">
                        <?php echo e($cancelText); ?>

                    </button>
                    <button type="button" @click="open = false; $nextTick(() => { if (formEl) formEl.submit(); })"
                            class="px-4 py-2 rounded-lg <?php echo e($confirmBg); ?> text-white font-medium transition">
                        <?php echo e($confirmText); ?>

                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/components/confirm.blade.php ENDPATH**/ ?>