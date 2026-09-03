@php
    $record = $getRecord();
    $imagePath = $record->file ? asset('storage/' . $record->file->path) : asset('images/placeholder.jpg');
    $isPinned = $record->is_pinned;
@endphp

<div class="relative w-full group overflow-hidden rounded-t-xl">
    {{-- Main Image --}}
    <img src="{{ $imagePath }}" 
         alt="{{ $record->caption }}" 
         class="w-full h-48 object-cover transition-all duration-300 group-hover:brightness-95">

    {{-- Pin Indicator at TOP-LEFT (Clickable) --}}
    <button wire:click="callTableAction('pin', '{{ $record->getKey() }}')"
            type="button"
            title="{{ $isPinned ? 'Lepas Sematan' : 'Sematkan ke Atas' }}"
            class="absolute top-3 left-3 z-30 p-2 rounded-lg shadow-lg border border-white/20 transition-all duration-300 active:scale-95
                   {{ $isPinned 
                        ? 'bg-primary-600 text-white hover:bg-primary-700' 
                        : 'bg-white/80 dark:bg-gray-800/80 text-gray-500 hover:text-primary-600 hover:bg-white dark:hover:bg-gray-800' 
                   }}">
        
        @if($isPinned)
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5 4a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 20V4z"/>
            </svg>
        @else
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 20V5z"/>
            </svg>
        @endif
    </button>
</div>
