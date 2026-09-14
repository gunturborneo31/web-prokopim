@php
    $record = $getRecord();
    $imagePath = asset('images/placeholder.jpg');

    if ($record->file) {
        $rawPath = $record->file->storage_path ?? $record->file->path ?? null;

        if (filled($rawPath)) {
           if (\Illuminate\Support\Str::startsWith($rawPath, ['http://', 'https://'])) {
               $imagePath = $rawPath;
           } else {
              $normalizedPath = str_replace('\\', '/', trim($rawPath));
              $normalizedPath = ltrim($normalizedPath, '/');
              $normalizedPath = preg_replace('#^(?:storage/app/public/|app/public/|public/storage/|public/)#i', '', $normalizedPath);
              $normalizedPath = preg_replace('#^storage/#i', '', $normalizedPath);
              $normalizedPath = ltrim((string) $normalizedPath, '/');

              if (filled($normalizedPath) && (\Illuminate\Support\Facades\Storage::disk('public')->exists($normalizedPath) || \Illuminate\Support\Facades\Storage::disk('local')->exists($normalizedPath))) {
                  $imagePath = \Illuminate\Support\Facades\Route::has('media.public')
                      ? route('media.public', ['path' => $normalizedPath], false)
                      : '/storage/' . $normalizedPath;
              }
           }
        }
    }

    $isPinned = $record->is_pinned;
@endphp

<div class="relative w-full group overflow-hidden rounded-t-xl">
    {{-- Main Image --}}
    <img src="{{ $imagePath }}" 
         alt="{{ $record->caption }}" 
         class="w-full h-48 object-cover transition-all duration-300 group-hover:brightness-95"
         onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';">

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
