@props(['type' => 'success', 'message' => '', 'dismissible' => true, 'autoDismiss' => 0])

@php
$config = [
    'success' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-500', 'text' => 'text-emerald-800', 'iconBg' => 'text-emerald-600', 'dismissColor' => 'text-emerald-600 hover:text-emerald-800'],
    'error' => ['bg' => 'bg-red-50', 'border' => 'border-red-500', 'text' => 'text-red-800', 'iconBg' => 'text-red-600', 'dismissColor' => 'text-red-600 hover:text-red-800'],
    'warning' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-500', 'text' => 'text-amber-800', 'iconBg' => 'text-amber-600', 'dismissColor' => 'text-amber-600 hover:text-amber-800'],
    'info' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-500', 'text' => 'text-blue-800', 'iconBg' => 'text-blue-600', 'dismissColor' => 'text-blue-600 hover:text-blue-800'],
];

$cfg = $config[$type] ?? $config['success'];
@endphp

@if($message || $slot->isNotEmpty())
<div x-data="{ show: true }"
     x-show="show"
     x-init="if ({{ $autoDismiss }} > 0) setTimeout(() => show = false, {{ $autoDismiss }})"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-2"
     class="mb-6 {{ $cfg['bg'] }} border-l-4 {{ $cfg['border'] }} p-4 rounded-r-lg shadow-sm"
     role="alert"
     aria-live="polite">
    <div class="flex items-start justify-between">
        <div class="flex items-start gap-3">
            @if($type === 'success')
            <svg class="w-5 h-5 {{ $cfg['iconBg'] }} mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            @elseif($type === 'error')
            <svg class="w-5 h-5 {{ $cfg['iconBg'] }} mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            @elseif($type === 'warning')
            <svg class="w-5 h-5 {{ $cfg['iconBg'] }} mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            @elseif($type === 'info')
            <svg class="w-5 h-5 {{ $cfg['iconBg'] }} mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
            @endif
            <div>
                @if($message)
                <p class="{{ $cfg['text'] }} font-medium">{{ $message }}</p>
                @endif
                @if($slot->isNotEmpty())
                <div class="{{ $cfg['text'] }} {{ $message ? 'mt-2' : '' }}">
                    {{ $slot }}
                </div>
                @endif
            </div>
        </div>
        @if($dismissible)
        <button @click="show = false" class="{{ $cfg['dismissColor'] }} transition shrink-0 ml-3" aria-label="Cerrar">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        @endif
    </div>
</div>
@endif
