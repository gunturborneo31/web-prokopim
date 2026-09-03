{{-- 
    Error State Component
    Digunakan saat terjadi error fetching data dari API
    
    Usage:
    <x-states.error-state />
    <x-states.error-state 
        title="Gagal memuat data" 
        message="Terjadi kesalahan saat menghubungi server" 
        :retryable="true"
    />
--}}

@props([
    'title' => 'Terjadi Kesalahan',
    'message' => 'Maaf, terjadi kesalahan saat memuat data. Silakan coba lagi.',
    'retryable' => true,
    'retryUrl' => null
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-12 px-4 text-center']) }}>
    {{-- Error Icon --}}
    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-5">
        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
    </div>
    
    {{-- Title --}}
    <h3 class="text-lg font-bold text-[#274CA5] mb-2">{{ $title }}</h3>
    
    {{-- Message --}}
    <p class="text-sm text-slate-500 max-w-sm mb-6">{{ $message }}</p>
    
    {{-- Retry Actions --}}
    @if($retryable)
    <div class="flex gap-3">
        @if($retryUrl)
        <a href="{{ $retryUrl }}" 
           class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold uppercase tracking-wider hover:bg-emerald-700 transition-colors">
            Coba Lagi
        </a>
        @else
        <button onclick="window.location.reload()" 
                class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold uppercase tracking-wider hover:bg-emerald-700 transition-colors">
            Muat Ulang
        </button>
        @endif
        
        <a href="{{ route('home') }}" 
           class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl text-sm font-bold uppercase tracking-wider hover:bg-slate-200 transition-colors">
            Kembali
        </a>
    </div>
    @endif
</div>
