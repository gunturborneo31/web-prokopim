{{-- 
    Spinner Component
    Loading indicator untuk async operations
    
    Usage:
    <x-states.spinner />
    <x-states.spinner size="lg" color="white" />
    <x-states.spinner size="sm" label="Memuat..." />
--}}

@props([
    'size' => 'md',
    'color' => 'emerald',
    'label' => null
])

@php
    $sizeClasses = [
        'sm' => 'w-4 h-4',
        'md' => 'w-6 h-6',
        'lg' => 'w-10 h-10',
        'xl' => 'w-16 h-16'
    ];
    
    $colorClasses = [
        'emerald' => 'text-emerald-600',
        'white' => 'text-white',
        'slate' => 'text-slate-600',
        'current' => 'text-current'
    ];
    
    $spinnerSize = $sizeClasses[$size] ?? $sizeClasses['md'];
    $spinnerColor = $colorClasses[$color] ?? $colorClasses['emerald'];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-center gap-3']) }}>
    <svg class="animate-spin {{ $spinnerSize }} {{ $spinnerColor }}" 
         xmlns="http://www.w3.org/2000/svg" 
         fill="none" 
         viewBox="0 0 24 24">
        <circle class="opacity-25" 
                cx="12" 
                cy="12" 
                r="10" 
                stroke="currentColor" 
                stroke-width="4"></circle>
        <path class="opacity-75" 
              fill="currentColor" 
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    
    @if($label)
    <span class="{{ $spinnerColor }} text-sm font-medium">{{ $label }}</span>
    @endif
</div>
