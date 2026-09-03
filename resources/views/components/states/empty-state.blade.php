{{-- 
    Empty State Component
    Digunakan saat data tidak ditemukan
    
    Usage:
    <x-states.empty-state title="Data tidak ditemukan" />
    <x-states.empty-state 
        title="Belum ada berita" 
        message="Berita akan segera ditambahkan" 
        icon="newspaper" 
    />
--}}

@props([
    'title' => 'Data tidak ditemukan',
    'message' => 'Tidak ada data yang tersedia saat ini.',
    'icon' => 'document',
    'action' => null,
    'actionUrl' => null
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-16 px-4 text-center']) }}>
    {{-- Icon --}}
    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
        @if($icon === 'document')
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        @elseif($icon === 'newspaper')
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
        @elseif($icon === 'users')
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        @elseif($icon === 'calendar')
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        @elseif($icon === 'search')
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        @elseif($icon === 'folder')
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
        </svg>
        @endif
    </div>
    
    {{-- Title --}}
    <h3 class="text-xl font-bold text-[#274CA5] mb-2">{{ $title }}</h3>
    
    {{-- Message --}}
    <p class="text-sm text-slate-500 max-w-sm mb-6">{{ $message }}</p>
    
    {{-- Optional Action Button --}}
    @if($action && $actionUrl)
    <a href="{{ $actionUrl }}" 
       class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-sm font-bold uppercase tracking-wider hover:bg-emerald-700 transition-colors">
        {{ $action }}
    </a>
    @endif
</div>
