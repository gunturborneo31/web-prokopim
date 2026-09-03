@php
    $isDropdown = isset($menu['dropdown']) && is_array($menu['dropdown']) && count($menu['dropdown']) > 0;
    $activeRoutes = $menu['active_routes'] ?? [($menu['route'] ?? null)];
    $active = false;
    $menuRouteName = $menu['route'] ?? null;
    $menuHref = '#';

    $isPathActive = function (?string $href): bool {
        $href = trim((string) $href);

        if ($href === '' || $href === '#') {
            return false;
        }

        $path = parse_url($href, PHP_URL_PATH);
        $path = trim((string) $path, '/');

        if ($path === '') {
            return request()->path() === '/';
        }

        return request()->is($path) || request()->is($path . '/*');
    };

    if (!empty($menu['url'])) {
        $menuHref = $menu['url'];
    } elseif ($menuRouteName && Route::has($menuRouteName)) {
        $menuHref = route($menuRouteName);
    }

    foreach ($activeRoutes as $routeName) {
        if ($routeName && request()->routeIs($routeName)) {
            $active = true;
            break;
        }
    }

    if (! $active) {
        $active = $isPathActive($menuHref);
    }

    if ($isDropdown) {
        foreach ($menu['dropdown'] as $drop) {
            $dropRouteName = $drop['route'] ?? null;
            $dropHref = ! empty($drop['url'])
                ? $drop['url']
                : (($dropRouteName && Route::has($dropRouteName)) ? route($dropRouteName) : '#');

            $dropActiveRoutes = $drop['active_routes'] ?? [$dropRouteName];
            $dropActive = false;

            foreach ($dropActiveRoutes as $routeName) {
                if ($routeName && request()->routeIs($routeName)) {
                    $dropActive = true;
                    break;
                }
            }

            if (! $dropActive) {
                $dropActive = $isPathActive($dropHref);
            }

            if ($dropActive) {
                $active = true;
                break;
            }
        }
    }

    $menuKey = $menu['route'] ?? ($menu['label'] ?? 'menu-item');
    $menuKey = preg_replace('/[^A-Za-z0-9\-_]/', '-', (string) $menuKey);
@endphp

@if ($isDropdown)
    <div class="relative group overflow-visible shrink-0 snap-center md:min-w-[120px]"
         x-data="{
             open: false,
             subPos: { top: 0, left: 0 },
             updatePos() {
                 const btn = this.$refs.ddTrigger;
                 if (!btn) return;
                 const rect = btn.getBoundingClientRect();
                 this.subPos = { top: rect.top, left: rect.left + rect.width / 2 };
             }
         }"
         @mouseenter="if (!isMobile) { updatePos(); open = true; }"
         @mouseleave="open = false">
        <a href="{{ $menuHref }}"
            x-ref="ddTrigger"
            @click="
                if (isMobile) {
                    const sameItem = mobileLabel === '{{ $menuKey }}';
                    if (hideLabelsOnOverflow) {
                        mobileLabel = null;
                    } else {
                        mobileLabel = sameItem ? null : '{{ $menuKey }}';
                    }
                    mobileLabel = sameItem ? null : '{{ $menuKey }}';
                    $event.preventDefault();
                    updatePos();
                    open = !open;
                    checkLabelOverflow();
                }
            "
            data-bottom-nav-item
            class="relative isolate flex h-11 items-center justify-center gap-2 {{ $active ? 'is-active w-fit md:w-full bg-slate-900/80 text-white border border-white/20 rounded-full backdrop-blur-xl backdrop-saturate-150' : 'w-fit md:w-full text-slate-800 bg-transparent border border-transparent hover:bg-white/12 hover:border-white/20 hover:text-slate-900 rounded-full backdrop-blur-sm' }} px-3 md:px-4 transition-all active:scale-95 duration-300 group overflow-hidden cursor-pointer"
            :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true" :class="{ ' rounded-2xl': open }">
            <span class="pointer-events-none absolute inset-0 rounded-full bg-gradient-to-br from-white/20 via-white/10 to-transparent"></span>
            <span class="pointer-events-none absolute inset-x-2 top-1 h-4 rounded-full bg-white/12 blur-md"></span>
            <span
                class="material-symbols-outlined text-[1.25rem] md:text-[1.45rem] leading-none {{ $active ? 'text-white' : 'text-slate-800 group-hover:text-slate-900 transition-colors' }}">
                {{ $menu['icon'] }}
            </span>
            <span class="font-montserrat text-[11px] font-bold uppercase tracking-[0.08em]
                        {{ $active ? 'text-white' : 'text-slate-800' }}
                        text-[10px] md:text-[11px]
                        leading-none transition-all duration-300 whitespace-nowrap"
                :class="!isMobile ? 'opacity-100 max-w-xs ml-1.5' : (hideLabelsOnOverflow ? 'opacity-0 max-w-0 ml-0 pointer-events-none' : ((mobileLabel === '{{ $menuKey }}' || {{ $active ? 'true' : 'false' }}) ? 'opacity-100 max-w-xs ml-1.5' : 'opacity-0 max-w-0 ml-0 pointer-events-none'))">
                {{ $menu['label'] }}
            </span>
            <span class="material-symbols-outlined text-[10px] {{ $active ? 'text-white' : 'text-slate-700' }} md:text-xs align-middle transition-transform duration-200"
                :class="{ 'rotate-180': open }">expand_less</span>
            @if ($active)
                <span class="pointer-events-none absolute -bottom-1 left-3 right-3 h-2 rounded-full bg-sky-200/40 blur-md"></span>
            @endif
        </a>

        <template x-teleport="body">
            <div x-cloak x-show="open"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                :style="`position:fixed; top:${subPos.top - 8}px; left:${subPos.left}px; transform:translate(-50%,-100%); z-index:9999; min-width:190px;`"
                class="pointer-events-auto"
                @mouseenter="open = true" @mouseleave="open = false">
                <div class="bg-slate-900/80 rounded-2xl shadow-[0_16px_36px_rgba(15,23,42,0.24)] py-2 px-3 flex flex-col gap-1 border border-white/16 backdrop-blur-xl backdrop-saturate-150 ring-1 ring-white/10">
                @foreach ($menu['dropdown'] as $drop)
                    @php
                        $dropRouteName = $drop['route'] ?? null;
                        $dropHref = '#';
                        $dropActive = false;
                        $dropActiveRoutes = $drop['active_routes'] ?? [$dropRouteName];

                        if (!empty($drop['url'])) {
                            $dropHref = $drop['url'];
                        } elseif ($dropRouteName && Route::has($dropRouteName)) {
                            $dropHref = route($dropRouteName);
                        }

                        foreach ($dropActiveRoutes as $routeName) {
                            if ($routeName && request()->routeIs($routeName)) {
                                $dropActive = true;
                                break;
                            }
                        }

                        if (! $dropActive) {
                            $dropActive = $isPathActive($dropHref);
                        }
                    @endphp
                    <a href="{{ $dropHref }}"
                        class="flex items-center gap-2 text-sm py-2.5 px-3 rounded-xl transition-all {{ $dropActive ? 'bg-white/18 text-white font-semibold shadow-[inset_0_1px_0_rgba(255,255,255,0.25)]' : 'text-[#F7F3F0]/92 hover:bg-white/12 hover:text-white' }}">
                        <span class="material-symbols-outlined text-base {{ $dropActive ? 'text-blue-300' : '' }}">
                            {{ $drop['icon'] ?? 'chevron_right' }}
                        </span>
                        {{ $drop['label'] }}
                    </a>
                @endforeach
                </div>
            </div>
        </template>
    </div>
@else
    <a href="{{ $menuHref }}"
        @click="
            if (isMobile) {
                if (mobileLabel !== '{{ $menuKey }}' && !hideLabelsOnOverflow) {
                    $event.preventDefault();
                    mobileLabel = '{{ $menuKey }}';
                    checkLabelOverflow();
                } else if (hideLabelsOnOverflow) {
                    mobileLabel = null;
                }
            }
        "
        data-bottom-nav-item
        class="relative isolate shrink-0 snap-center w-fit md:min-w-[120px] flex h-11 items-center justify-center gap-2 {{ $active ? 'is-active bg-slate-900/80 text-white border border-white/20 rounded-full backdrop-blur-xl backdrop-saturate-150' : 'text-slate-800 bg-transparent border border-transparent hover:bg-white/12 hover:border-white/20 hover:text-slate-900 rounded-full backdrop-blur-sm' }} px-3 md:px-4 transition-all active:scale-95 duration-300 group overflow-hidden">
        <span class="pointer-events-none absolute inset-0 rounded-full bg-gradient-to-br from-white/20 via-white/10 to-transparent"></span>
        <span class="pointer-events-none absolute inset-x-2 top-1 h-4 rounded-full bg-white/12 blur-md"></span>
        <span
            class="material-symbols-outlined text-[1.25rem] md:text-[1.45rem] leading-none {{ $active ? 'text-white' : 'text-slate-800 group-hover:text-slate-900 transition-colors' }}">
            {{ $menu['icon'] }}
        </span>
        <span class="font-montserrat text-[11px] font-bold uppercase tracking-[0.08em]
                {{ $active ? 'text-white' : 'text-slate-800' }}
                    text-[10px] md:text-[11px]
                leading-none transition-all duration-300 whitespace-nowrap"
            :class="!isMobile ? 'opacity-100 max-w-xs ml-1.5' : (hideLabelsOnOverflow ? 'opacity-0 max-w-0 ml-0 pointer-events-none' : ((mobileLabel === '{{ $menuKey }}' || {{ $active ? 'true' : 'false' }}) ? 'opacity-100 max-w-xs ml-1.5' : 'opacity-0 max-w-0 ml-0 pointer-events-none'))">
            {{ $menu['label'] }}
        </span>
        @if ($active)
            <span class="pointer-events-none absolute -bottom-1 left-3 right-3 h-2 rounded-full bg-sky-200/40 blur-md"></span>
        @endif
    </a>
@endif
