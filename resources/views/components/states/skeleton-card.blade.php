{{-- 
    Skeleton Card Component
    Digunakan saat loading data dari API
    
    Usage:
    <x-states.skeleton-card />
    <x-states.skeleton-card type="news" />
    <x-states.skeleton-card type="table-row" :count="5" />
--}}

@props([
    'type' => 'card',
    'count' => 1
])

@for($i = 0; $i < $count; $i++)
    @if($type === 'card')
    {{-- Standard Card Skeleton --}}
    <div class="bg-white rounded-2xl p-4 animate-pulse shadow-sm border border-gray-100">
        <div class="bg-slate-200 h-48 rounded-xl mb-4"></div>
        <div class="bg-slate-200 h-3 rounded w-1/4 mb-3"></div>
        <div class="bg-slate-200 h-5 rounded w-3/4 mb-2"></div>
        <div class="bg-slate-200 h-5 rounded w-1/2 mb-4"></div>
        <div class="flex gap-4">
            <div class="bg-slate-200 h-3 rounded w-20"></div>
            <div class="bg-slate-200 h-3 rounded w-24"></div>
        </div>
    </div>

    @elseif($type === 'news')
    {{-- News Card Skeleton (Landing Page) --}}
    <div class="bg-white rounded-[2.5rem] p-4 animate-pulse shadow-xl border border-gray-100">
        <div class="bg-slate-200 h-[400px] rounded-[2rem] mb-4"></div>
        <div class="bg-slate-200 h-4 rounded-full w-24 mb-4"></div>
        <div class="bg-slate-200 h-8 rounded w-full mb-2"></div>
        <div class="bg-slate-200 h-8 rounded w-3/4 mb-6"></div>
        <div class="flex gap-6">
            <div class="bg-slate-200 h-4 rounded w-28"></div>
            <div class="bg-slate-200 h-4 rounded w-32"></div>
        </div>
    </div>

    @elseif($type === 'sidebar-item')
    {{-- News Sidebar Item Skeleton --}}
    <div class="flex gap-4 p-4 animate-pulse">
        <div class="flex-1">
            <div class="bg-slate-200 h-3 rounded-full w-16 mb-2"></div>
            <div class="bg-slate-200 h-4 rounded w-full mb-1"></div>
            <div class="bg-slate-200 h-4 rounded w-3/4 mb-2"></div>
            <div class="bg-slate-200 h-3 rounded w-24"></div>
        </div>
    </div>

    @elseif($type === 'table-row')
    {{-- Table Row Skeleton --}}
    <tr class="animate-pulse">
        <td class="px-6 py-4"><div class="bg-slate-200 h-4 rounded w-8"></div></td>
        <td class="px-6 py-4"><div class="bg-slate-200 h-4 rounded w-full"></div></td>
        <td class="px-6 py-4"><div class="bg-slate-200 h-4 rounded w-16"></div></td>
        <td class="px-6 py-4"><div class="bg-slate-200 h-4 rounded w-16"></div></td>
        <td class="px-6 py-4"><div class="bg-slate-200 h-8 rounded w-24"></div></td>
    </tr>

    @elseif($type === 'profile-card')
    {{-- Profile/Aparatur Card Skeleton --}}
    <div class="bg-white rounded-2xl p-6 animate-pulse shadow-sm border border-gray-100 text-center">
        <div class="w-32 h-32 bg-slate-200 rounded-full mx-auto mb-4"></div>
        <div class="bg-slate-200 h-5 rounded w-3/4 mx-auto mb-2"></div>
        <div class="bg-slate-200 h-4 rounded w-1/2 mx-auto mb-2"></div>
        <div class="bg-slate-200 h-3 rounded w-2/3 mx-auto"></div>
    </div>

    @elseif($type === 'text-block')
    {{-- Text/Content Block Skeleton --}}
    <div class="animate-pulse space-y-4">
        <div class="bg-slate-200 h-6 rounded w-1/3 mb-6"></div>
        <div class="bg-slate-200 h-4 rounded w-full"></div>
        <div class="bg-slate-200 h-4 rounded w-full"></div>
        <div class="bg-slate-200 h-4 rounded w-4/5"></div>
        <div class="bg-slate-200 h-4 rounded w-full"></div>
        <div class="bg-slate-200 h-4 rounded w-3/4"></div>
    </div>
    @endif
@endfor
