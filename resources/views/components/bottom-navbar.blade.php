<div>
    @php
        $resolveLink = function (?string $link): string {
            $link = trim((string) $link);

            if ($link === '') {
                return '#';
            }

            if (\Illuminate\Support\Str::startsWith($link, ['http://', 'https://', 'mailto:', 'tel:', '#'])) {
                return $link;
            }

            return str_starts_with($link, '/') ? $link : '/' . ltrim($link, '/');
        };

        $resolveIcon = function (?string $icon, ?string $name): string {
            $icon = strtolower(trim((string) $icon));
            $name = strtolower(trim((string) $name));

            $iconMap = [
                'home' => 'home',
                'user' => 'badge',
                'newspaper' => 'newspaper',
                'shield-check' => 'shield',
                'document-text' => 'description',
                'headset' => 'support_agent',
                'default' => 'menu',
            ];

            if ($icon !== '' && isset($iconMap[$icon])) {
                return $iconMap[$icon];
            }

            return match (true) {
                str_contains($name, 'beranda') => 'home',
                str_contains($name, 'profil') => 'badge',
                str_contains($name, 'berita'), str_contains($name, 'informasi') => 'newspaper',
                str_contains($name, 'regulasi'), str_contains($name, 'peraturan') => 'gavel',
                str_contains($name, 'ppid') => 'contact_page',
                str_contains($name, 'layanan') => 'support_agent',
                str_contains($name, 'pengumuman') => 'campaign',
                str_contains($name, 'dokumen') => 'description',
                default => 'menu',
            };
        };

        $menus = collect();

        try {
            $menus = \App\Models\Menu::query()
                ->with(['children' => function ($query) {
                    $query->where('position', 'website')
                        ->where('status', true)
                        ->orderBy('order');
                }])
                ->where('position', 'website')
                ->whereNull('parent_id')
                ->where('status', true)
                ->orderBy('order')
                ->get()
                ->map(function ($menu) use ($resolveLink, $resolveIcon) {
                    $children = $menu->children
                        ->map(function ($child) use ($resolveLink, $resolveIcon) {
                            return [
                                'url' => $resolveLink($child->link),
                                'label' => $child->name,
                                'icon' => $resolveIcon($child->icon, $child->name),
                            ];
                        })
                        ->values()
                        ->all();

                    $item = [
                        'url' => $resolveLink($menu->link),
                        'label' => $menu->name,
                        'icon' => $resolveIcon($menu->icon, $menu->name),
                    ];

                    if (! empty($children)) {
                        $item['dropdown'] = $children;
                    }

                    return $item;
                })
                ->values();
        } catch (\Throwable $e) {
            $menus = collect();
        }
    @endphp

    <nav
        x-data="{
            isMobile: window.matchMedia('(max-width: 767px)').matches,
            mobileLabel: null,
            hideLabelsOnOverflow: false,
            checkLabelOverflow() {
                if (!this.isMobile) {
                    this.hideLabelsOnOverflow = false;
                    return;
                }

                this.$nextTick(() => {
                    const inner = this.$refs.innerDiv;
                    if (!inner) return;
                    this.hideLabelsOnOverflow = (inner.scrollWidth - inner.clientWidth) > 6;
                });
            },
            init() {
                const onResize = () => {
                    this.isMobile = window.matchMedia('(max-width: 767px)').matches;
                    if (!this.isMobile) {
                        this.mobileLabel = null;
                    }
                    this.checkLabelOverflow();
                };

                window.addEventListener('resize', onResize);
                document.addEventListener('livewire:navigated', () => {
                    this.mobileLabel = null;
                    this.checkLabelOverflow();
                });

                this.checkLabelOverflow();
            }
        }"
        x-ref="bottomNav"
        id="floating-bottom-nav"
        aria-label="Navigasi bawah"
        class="fixed bottom-4 sm:bottom-4 left-1/2 -translate-x-1/2 z-50 py-2.5 sm:py-3 px-1.5 sm:px-2.5 bg-gradient-to-br from-white/12 via-white/8 to-white/5 backdrop-blur-3xl backdrop-saturate-200 w-fit rounded-[24px] sm:rounded-[28px] border border-white/18 shadow-[0_24px_60px_rgba(15,23,42,0.32)] transition-all duration-500 overflow-visible">
        <span class="pointer-events-none absolute inset-0 rounded-[24px] sm:rounded-[28px] bg-gradient-to-br from-white/22 via-white/10 to-transparent"></span>
        <span class="pointer-events-none absolute inset-x-3 top-1 h-6 rounded-full bg-white/12 blur-xl"></span>
        <span id="bottom-nav-active-bubble" class="pointer-events-none absolute inset-y-2 left-0 w-0 rounded-full bg-[#274CA5]/30 blur-md opacity-0 transition-all duration-500 ease-out"></span>
        <div x-ref="innerDiv" class="relative flex items-center justify-center gap-1 sm:gap-1.5 overflow-x-auto snap-x snap-mandatory [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
        @foreach ($menus as $menu)
            @include('components.navbar-menu-item', ['menu' => $menu])
        @endforeach
        </div>
    </nav>

    <div class="h-[106px]" aria-hidden="true"></div>
</div>

<script>
    (function () {
        const updateBottomNavBubble = () => {
            const nav = document.getElementById('floating-bottom-nav');
            const bubble = document.getElementById('bottom-nav-active-bubble');
            if (!nav || !bubble) return;

            const activeItem = nav.querySelector('[data-bottom-nav-item].is-active');
            if (!activeItem) {
                bubble.style.opacity = '0';
                bubble.style.width = '0px';
                return;
            }

            const navRect = nav.getBoundingClientRect();
            const itemRect = activeItem.getBoundingClientRect();
            const innerDiv = nav.querySelector('[x-ref="innerDiv"]') || nav.firstElementChild;
            const scrollLeft = innerDiv ? innerDiv.scrollLeft : 0;
            const left = itemRect.left - navRect.left + scrollLeft;

            bubble.style.opacity = '1';
            bubble.style.width = itemRect.width + 'px';
            bubble.style.transform = `translateX(${left}px)`;
        };

        document.addEventListener('DOMContentLoaded', updateBottomNavBubble);
        window.addEventListener('resize', updateBottomNavBubble);
        document.addEventListener('livewire:navigated', updateBottomNavBubble);
        setTimeout(updateBottomNavBubble, 60);
    })();
</script>
