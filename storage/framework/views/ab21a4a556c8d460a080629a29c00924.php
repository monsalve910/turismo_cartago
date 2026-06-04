<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'success', 'message' => '', 'dismissible' => true, 'autoDismiss' => 0]));

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

foreach (array_filter((['type' => 'success', 'message' => '', 'dismissible' => true, 'autoDismiss' => 0]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$config = [
    'success' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-500', 'text' => 'text-emerald-800', 'iconBg' => 'text-emerald-600', 'dismissColor' => 'text-emerald-600 hover:text-emerald-800'],
    'error' => ['bg' => 'bg-red-50', 'border' => 'border-red-500', 'text' => 'text-red-800', 'iconBg' => 'text-red-600', 'dismissColor' => 'text-red-600 hover:text-red-800'],
    'warning' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-500', 'text' => 'text-amber-800', 'iconBg' => 'text-amber-600', 'dismissColor' => 'text-amber-600 hover:text-amber-800'],
    'info' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-500', 'text' => 'text-blue-800', 'iconBg' => 'text-blue-600', 'dismissColor' => 'text-blue-600 hover:text-blue-800'],
];

$cfg = $config[$type] ?? $config['success'];
?>

<?php if($message || $slot->isNotEmpty()): ?>
<div x-data="{ show: true }"
     x-show="show"
     x-init="if (<?php echo e($autoDismiss); ?> > 0) setTimeout(() => show = false, <?php echo e($autoDismiss); ?>)"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-2"
     class="mb-6 <?php echo e($cfg['bg']); ?> border-l-4 <?php echo e($cfg['border']); ?> p-4 rounded-r-lg shadow-sm"
     role="alert"
     aria-live="polite">
    <div class="flex items-start justify-between">
        <div class="flex items-start gap-3">
            <?php if($type === 'success'): ?>
            <svg class="w-5 h-5 <?php echo e($cfg['iconBg']); ?> mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <?php elseif($type === 'error'): ?>
            <svg class="w-5 h-5 <?php echo e($cfg['iconBg']); ?> mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <?php elseif($type === 'warning'): ?>
            <svg class="w-5 h-5 <?php echo e($cfg['iconBg']); ?> mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <?php elseif($type === 'info'): ?>
            <svg class="w-5 h-5 <?php echo e($cfg['iconBg']); ?> mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
            <?php endif; ?>
            <div>
                <?php if($message): ?>
                <p class="<?php echo e($cfg['text']); ?> font-medium"><?php echo e($message); ?></p>
                <?php endif; ?>
                <?php if($slot->isNotEmpty()): ?>
                <div class="<?php echo e($cfg['text']); ?> <?php echo e($message ? 'mt-2' : ''); ?>">
                    <?php echo e($slot); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if($dismissible): ?>
        <button @click="show = false" class="<?php echo e($cfg['dismissColor']); ?> transition shrink-0 ml-3" aria-label="Cerrar">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/components/alert.blade.php ENDPATH**/ ?>