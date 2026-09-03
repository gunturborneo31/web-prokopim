{{-- Mobile Bottom Navigation (data-driven from website menus) --}}
@php
    $ppidActive = request()->is('ppid*');
    $egovActive = request()->is('e-gov*') || request()->is('portal*');

    $isLinkActive = function (?string $href): bool {
        $path = trim((string) parse_url((string) $href, PHP_URL_PATH), '/');

        if ($path === '') {
            return request()->is('/');
        }

        return request()->is($path) || request()->is($path . '/*');
    };

    $websiteMenus = collect();
    $primaryMenuItems = collect();

    if (! $ppidActive) {
        $allMenus = \App\Models\Menu::query()
            ->where('position', 'website')
            ->where('status', true)
            ->orderBy('order')
            ->get(['id', 'name', 'link', 'parent_id']);

        $childrenByParent = $allMenus->groupBy('parent_id');

        $collectDescendants = function (int $parentId, int $depth = 0) use (&$collectDescendants, $childrenByParent, $isLinkActive) {
            return ($childrenByParent[$parentId] ?? collect())
                ->flatMap(function ($child) use (&$collectDescendants, $depth, $isLinkActive) {
                    $items = collect([[
                        'label' => str_repeat('- ', $depth) . $child->name,
                        'href' => $child->link ?: '#',
                        'active' => $isLinkActive($child->link),
                    ]]);

                    return $items->merge($collectDescendants($child->id, $depth + 1));
                })
                ->values();
        };

        $websiteMenus = $allMenus
            ->whereNull('parent_id')
            ->values()
            ->map(function ($menu) use ($collectDescendants, $isLinkActive) {
                $children = $collectDescendants($menu->id, 0);

                $isParentActive = $isLinkActive($menu->link);
                $isActive = $isParentActive || $children->contains('active', true);

                return [
                    'sheet' => 'menu-' . $menu->id,
                    'label' => $menu->name,
                    'href' => $menu->link ?: '#',
                    'active' => $isActive,
                    'children' => $children,
                ];
            });

        $primaryMenuItems = $websiteMenus->values();
    }
@endphp

@if($ppidActive)
<div class="lg:hidden">
    <nav class="fixed bottom-0 inset-x-0 z-[90]"
         style="height: calc(72px + env(safe-area-inset-bottom)); padding-bottom: env(safe-area-inset-bottom);">
        <div class="absolute inset-0 bg-[#04091a]/97 backdrop-blur-2xl border-t border-blue-500/20"
             style="box-shadow: 0 -4px 40px rgba(59,130,246,0.12), 0 -1px 0 rgba(59,130,246,0.15);"></div>
        <div class="absolute top-0 inset-x-0 h-[2px] bg-gradient-to-r from-transparent via-blue-500/70 to-transparent"></div>

        <div class="relative z-10 flex items-center justify-between h-[72px] px-2 gap-1">
            @php
                $ppidHubActive = request()->routeIs('ppid.index');
                $ppidInfoActive = request()->routeIs('ppid.informasi') || request()->routeIs('ppid.berkala') || request()->routeIs('ppid.serta-merta') || request()->routeIs('ppid.setiap-saat') || request()->routeIs('ppid.dikecualikan');
                $ppidPermohonanActive = request()->routeIs('ppid.permohonan') || request()->routeIs('ppid.permohonan.status');
            @endphp

            <a href="{{ route('ppid.index') }}" wire:navigate class="flex-1 min-w-0 max-w-[84px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative {{ $ppidHubActive ? 'text-blue-400' : 'text-slate-500 hover:text-blue-300' }}">
                @if($ppidHubActive)
                    <span class="absolute inset-0 bg-blue-500/12 rounded-2xl border border-blue-500/25"></span>
                @endif
                <svg class="w-[20px] h-[20px] relative z-10" fill="{{ $ppidHubActive ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $ppidHubActive ? 0 : 1.7 }}"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="text-[9px] font-bold tracking-wide leading-none">Hub</span>
            </a>

            <a href="{{ route('ppid.informasi') }}" wire:navigate class="flex-1 min-w-0 max-w-[84px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative {{ $ppidInfoActive ? 'text-blue-400' : 'text-slate-500 hover:text-blue-300' }}">
                @if($ppidInfoActive)
                    <span class="absolute inset-0 bg-blue-500/12 rounded-2xl border border-blue-500/25"></span>
                @endif
                <svg class="w-[20px] h-[20px] relative z-10" fill="{{ $ppidInfoActive ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $ppidInfoActive ? 0 : 1.7 }}"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-[9px] font-bold tracking-wide leading-none">Informasi</span>
            </a>

            <a href="{{ route('ppid.permohonan') }}" wire:navigate class="flex-1 min-w-0 max-w-[84px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative {{ $ppidPermohonanActive ? 'text-blue-400' : 'text-slate-500 hover:text-blue-300' }}">
                @if($ppidPermohonanActive)
                    <span class="absolute inset-0 bg-blue-500/12 rounded-2xl border border-blue-500/25"></span>
                @endif
                <svg class="w-[20px] h-[20px] relative z-10" fill="{{ $ppidPermohonanActive ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $ppidPermohonanActive ? 0 : 1.7 }}"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span class="text-[9px] font-bold tracking-wide leading-none">Permohonan</span>
            </a>

            <a href="{{ route('beranda') }}" wire:navigate class="flex-1 min-w-0 max-w-[84px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative text-yellow-500 hover:text-yellow-300">
                <svg class="w-[20px] h-[20px] relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m2.586-9.586a2 2 0 112.828 2.828L11 19H8v-3l12.586-12.586z"/></svg>
                <span class="text-[9px] font-bold tracking-wide leading-none">Web</span>
            </a>
        </div>
    </nav>

    <div class="h-[72px]" aria-hidden="true"></div>
</div>
@else
<div class="lg:hidden"
     x-data="{ activeSheet: null, toggleSheet(key){ this.activeSheet = this.activeSheet === key ? null : key }, closeSheet(){ this.activeSheet = null } }"
     @keydown.escape.window="closeSheet()">

    <div x-show="activeSheet !== null" x-cloak @click="closeSheet()"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[70]"></div>

    @foreach($websiteMenus as $menu)
        @if($menu['children']->isNotEmpty())
            <div x-show="activeSheet === '{{ $menu['sheet'] }}'" x-cloak
                 x-transition:enter="transition ease-out duration-250" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8"
                 class="fixed bottom-[80px] inset-x-0 z-[80] px-3">
                <div class="bg-[#060d1f] border border-blue-500/30 rounded-2xl shadow-[0_0_40px_rgba(59,130,246,0.15)] overflow-hidden">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-blue-500/15">
                        <span class="font-bold text-white text-sm tracking-wide">{{ $menu['label'] }}</span>
                        <button type="button" @click="closeSheet()" class="w-7 h-7 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 hover:text-white hover:bg-blue-500/30 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="p-2 space-y-1.5 max-h-[58vh] overflow-y-auto">
                        @foreach($menu['children'] as $sub)
                            @php
                                $subHref = $sub['href'] ?: '#';
                                $subInternal = str_starts_with($subHref, '/');
                            @endphp
                            <a href="{{ $subHref }}" @if($subInternal) wire:navigate @endif @click="closeSheet()"
                               class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl transition-all active:scale-[0.98] {{ $sub['active'] ? 'bg-blue-500/20 text-blue-300 border border-blue-500/30' : 'hover:bg-blue-500/10 text-slate-300 hover:text-white' }}">
                                <span class="text-sm font-medium">{{ $sub['label'] }}</span>
                                <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <nav class="fixed bottom-0 inset-x-0 z-[90]"
         style="height: calc(72px + env(safe-area-inset-bottom)); padding-bottom: env(safe-area-inset-bottom);">
        <div class="absolute inset-0 bg-[#04091a]/97 backdrop-blur-2xl border-t border-blue-500/20"
             style="box-shadow: 0 -4px 40px rgba(59,130,246,0.12), 0 -1px 0 rgba(59,130,246,0.15);"></div>
        <div class="absolute top-0 inset-x-0 h-[2px] bg-gradient-to-r from-transparent via-blue-500/70 to-transparent"></div>

        <div class="relative z-10 flex items-center justify-between h-[72px] px-1 gap-0.5">
            @foreach($primaryMenuItems as $menu)
                @php
                    $menuHasChildren = $menu['children']->isNotEmpty();
                    $menuHref = $menu['href'] ?: '#';
                    $menuInternal = str_starts_with($menuHref, '/');
                @endphp

                @if($menuHasChildren)
                    <button type="button" @click="toggleSheet('{{ $menu['sheet'] }}')"
                        class="flex-1 min-w-0 max-w-[64px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative {{ $menu['active'] ? 'text-blue-400' : 'text-slate-500 hover:text-blue-300' }}"
                        :class="activeSheet === '{{ $menu['sheet'] }}' ? 'text-blue-400' : ''">
                        <span class="absolute inset-0 rounded-2xl transition-all"
                              :class="activeSheet === '{{ $menu['sheet'] }}' ? 'bg-blue-500/12 border border-blue-500/25' : '{{ $menu['active'] ? 'bg-blue-500/12 border border-blue-500/25' : '' }}'"></span>
                        <svg class="w-[19px] h-[19px] relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        <span class="text-[9px] font-bold tracking-wide leading-none text-center truncate w-full px-0.5 relative z-10">{{ \Illuminate\Support\Str::limit($menu['label'], 9, '') }}</span>
                    </button>
                @else
                    <a href="{{ $menuHref }}" @if($menuInternal) wire:navigate @endif
                        class="flex-1 min-w-0 max-w-[64px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative {{ $menu['active'] ? 'text-blue-400' : 'text-slate-500 hover:text-blue-300' }}">
                        @if($menu['active'])
                            <span class="absolute inset-0 bg-blue-500/12 rounded-2xl border border-blue-500/25"></span>
                        @endif
                        <svg class="w-[19px] h-[19px] relative z-10" fill="{{ $menu['active'] ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $menu['active'] ? 0 : 1.8 }}"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span class="text-[9px] font-bold tracking-wide leading-none text-center truncate w-full px-0.5 relative z-10">{{ \Illuminate\Support\Str::limit($menu['label'], 9, '') }}</span>
                    </a>
                @endif
            @endforeach

            <a href="/ppid/permohonan" wire:navigate
               class="flex-1 min-w-0 max-w-[64px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative {{ $ppidActive ? 'text-yellow-300' : 'text-yellow-600/80 hover:text-[#274CA5]' }}">
                @if($ppidActive)
                    <span class="absolute inset-0 bg-yellow-500/10 rounded-2xl border border-yellow-500/30"></span>
                @endif
                <svg class="w-[19px] h-[19px] relative z-10" fill="{{ $ppidActive ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $ppidActive ? 0 : 1.7 }}"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span class="text-[9px] font-bold tracking-wide leading-none">PPID</span>
            </a>

            <a href="{{ route('egov') }}" wire:navigate
                    class="flex-1 min-w-0 max-w-[64px] flex flex-col items-center justify-center gap-1.5 h-[68px] px-1 rounded-2xl transition-all duration-200 active:scale-90 relative {{ $egovActive ? 'text-blue-400' : 'text-slate-500 hover:text-blue-300' }}">
                @if($egovActive)
                    <span class="absolute inset-0 bg-blue-500/12 rounded-2xl border border-blue-500/25"></span>
                @endif
                <svg class="w-[19px] h-[19px] relative z-10" fill="{{ $egovActive ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $egovActive ? 0 : 1.7 }}"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                <span class="text-[9px] font-bold tracking-wide leading-none">e-Gov</span>
            </a>
        </div>
    </nav>

    <div class="h-[72px]" aria-hidden="true"></div>
</div>
@endif
