        <!-- ============================================ -->
        <!-- SECTION 3: INTERACTIVE FEATURED NEWS SLIDER -->
        <!-- ============================================ -->
        <section id="berita" class="py-20 relative overflow-hidden bg-white"
            x-data="{
                activeIndex: 0,
                news: {{ 
                    collect($featuredNewsItems ?? [])->whenEmpty(fn ($items) => collect([[
                        'title' => 'Belum ada berita tersedia',
                        'category' => 'Berita',
                        'date' => now()->translatedFormat('d F Y'),
                        'image' => asset('images/desamahakamulu.jpg'),
                        'excerpt' => 'Konten berita akan muncul di sini setelah dipublikasikan dari panel admin.',
                        'slug' => '#',
                    ]]))->values()->toJson() 
                }},
                get activeNews() { return this.news[this.activeIndex]; },
                prev() { this.activeIndex = (this.activeIndex - 1 + this.news.length) % this.news.length; },
                next() { this.activeIndex = (this.activeIndex + 1) % this.news.length; },
                transitionKey: 0
            }"
            x-effect="transitionKey = activeIndex"
        >
            <!-- Subtle dot pattern -->
            <div class="absolute inset-0 opacity-[0.02] pointer-events-none" style="background-image: radial-gradient(#274CA5 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                    <div data-aos="fade-right">
                        <span class="text-[#274CA5] font-bold tracking-wider uppercase text-xs">Berita & Informasi</span>
                        <h2 class="mt-2 font-montserrat font-black text-3xl md:text-5xl leading-tight">
                            <span class="text-[#274CA5]">Kabar Terkini</span>
                        </h2>
                    </div>
                    <a data-aos="fade-left" href="{{ route('berita.index') }}" wire:navigate class="group flex items-center gap-2 font-bold text-[#274CA5] hover:text-[#274CA5] transition-all px-6 py-2 rounded-full border border-slate-200 bg-white shadow-sm hover:shadow-md hover:scale-105 active:scale-95">
                        Lihat Semua Berita <span class="text-lg leading-none group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>

                <!-- Interactive News Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch" data-aos="fade-up">

                    <!-- LEFT: Slider + Thumbnail (2/3 width) -->
                    <div class="lg:col-span-2 flex flex-col gap-4">

                        <!-- Featured News Slider -->
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-slate-300/15 aspect-video w-full group bg-instansi-surface flex-shrink-0">

                            <!-- Cover Images (each slide - animating from bottom to up) -->
                            <template x-for="(item, index) in news" :key="index">
                                <div class="absolute inset-0 transform-gpu overflow-hidden"
                                     x-show="activeIndex === index"
                                     x-transition:enter="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-10"
                                     x-transition:enter-start="translate-y-full"
                                     x-transition:enter-end="translate-y-0"
                                     x-transition:leave="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-0"
                                     x-transition:leave-start="translate-y-0"
                                     x-transition:leave-end="-translate-y-full"
                                >
                                    <div class="absolute inset-0 shimmer-bg z-0"></div>
                                    <div class="absolute inset-0">
                                        <img :src="item.image" :alt="item.title" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                                    </div>
                                </div>
                            </template>

                            <!-- Content Overlay -->
                            <div class="absolute inset-0 z-20 flex flex-col justify-end p-6 md:p-8 pointer-events-none">
                                <div class="absolute inset-x-0 bottom-0 h-44 md:h-56 bg-gradient-to-t from-[#274CA5]/95 via-[#274CA5]/70 to-transparent z-10"></div>

                                <div class="max-w-3xl pointer-events-auto relative z-30">
                                    <div class="inline-flex items-center gap-2 rounded-full bg-black/40 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-white/90 backdrop-blur-sm border border-white/15 relative z-30">
                                        <span x-text="activeNews.category"></span>
                                        <span class="text-white/60">•</span>
                                        <span x-text="activeNews.date"></span>
                                    </div>

                                    <h3 class="mt-3 text-white font-montserrat font-black text-lg md:text-3xl leading-tight line-clamp-2 relative z-30"
                                        style="text-shadow: 0 2px 6px rgba(0,0,0,0.3), 0 0 18px rgba(0,0,0,0.3), 0 0 10px rgba(0,0,0,0.3);"
                                        x-text="activeNews.title"></h3>

                                    <h3 class="mt-3 text-white font-montserrat text-sm leading-tight  line-clamp-2 relative z-30"
                                    x-text="activeNews.excerpt"></h3>
                                </div>

                                <!-- Slider Controls -->
                                <div class="absolute top-4 right-4 md:top-6 md:right-6 flex items-center gap-2 z-30 pointer-events-auto">
                                    <button @click="prev()" class="w-8 h-8 rounded-full bg-slate-800/40 backdrop-blur-md border border-white/10 flex items-center justify-center text-white hover:bg-[#3255AA] hover:border-[#274CA5] hover:scale-110 active:scale-90 transition-all duration-300 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                                    </button>
                                    <span class="text-white/80 text-xs font-bold tabular-nums">
                                        <span class="text-white" x-text="activeIndex + 1"></span>/<span x-text="news.length"></span>
                                    </span>
                                    <button @click="next()" class="w-8 h-8 rounded-full bg-slate-800/40 backdrop-blur-md border border-white/10 flex items-center justify-center text-white hover:bg-[#3255AA] hover:border-[#274CA5] hover:scale-110 active:scale-90 transition-all duration-300 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail Strip -->
                        <div class="relative flex-shrink-0 mt-4 z-30">
                            <div class="flex gap-1.5 sm:gap-3 overflow-x-hidden pt-2 pb-2 sm:pt-4 sm:pb-4 px-0.5">
                                <template x-for="(item, index) in news" :key="'thumb-' + index">
                                    <button @click="activeIndex = index"
                                            class="flex-1 min-w-0 rounded-lg sm:rounded-xl overflow-hidden border-2 transition-all duration-300 group text-left bg-white shadow-sm transform-gpu"
                                            :class="activeIndex === index ? 'border-[#274CA5] shadow-[0_4px_10px_-2px_rgba(163,230,53,0.3)] ring-2 ring-[#d9f99d] -translate-y-1 sm:-translate-y-3' : 'border-slate-100 hover:border-[#bbf7d0] hover:shadow-md hover:-translate-y-1 opacity-80 hover:opacity-100'">
                                        <div class="relative overflow-hidden" style="aspect-ratio:16/9;">
                                            <img :src="item.image" :alt="item.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                            <div class="absolute inset-0 bg-gradient-to-t from-[#274CA5]/60 to-transparent"></div>
                                            <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider"
                                                  :class="activeIndex === index ? 'bg-[#274CA5] text-white' : 'bg-black/40 text-white/80'"
                                                  x-text="item.category"></span>
                                              <div class="absolute bottom-0 left-0 right-0 h-[3px] bg-[#274CA5] transition-opacity duration-300"
                                                 :class="activeIndex === index ? 'opacity-100' : 'opacity-0'"></div>
                                        </div>
                                        <div class="p-1.5 sm:p-2.5">
                                            <p class="text-[9px] sm:text-[11px] font-bold leading-snug line-clamp-2 transition-colors duration-300"
                                               :class="activeIndex === index ? 'text-[#274CA5]' : 'text-slate-700 group-hover:text-[#274CA5]'"
                                               x-text="item.title"></p>
                                            <span class="hidden sm:block text-[10px] text-slate-400 mt-0.5" x-text="item.date"></span>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT: GPR Komdigi (stretches to match height) -->
                        <div class="lg:col-span-1 relative min-h-[450px] lg:min-h-0" data-aos="fade-up" data-aos-delay="100">
                            <!-- Di desktop: absolute inset-0 agar mengikuti tinggi kolom kiri. Di mobile: tinggi otomatis -->
                            <div class="lg:absolute lg:inset-0 lg:pb-1 h-full">
                                <div class="bg-[#f0fdf4] rounded-2xl shadow-md border border-[#274CA5]/40 hover:shadow-xl transition-shadow duration-300 w-full h-full flex flex-col pt-1 gpr-custom-wrapper relative overflow-hidden">
                                    <!-- Custom Overlay Header -->
                                <div class="absolute top-0 left-0 right-0 bg-[#274CA5] px-5 py-4 z-10 flex flex-col pointer-events-none border-b border-[#688bdd]" style="height: 72px;">
                                    <h3 class="font-montserrat font-bold text-white text-base flex items-center gap-2">
                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        GPR Komdigi
                                    </h3>
                                    <p class="text-white text-[11px] mt-1 ml-7">Government Public Relations</p>
                                </div>
                                <!-- Widget Script -->
                                <script type="text/javascript" src="https://widget.komdigi.go.id/gpr-widget-kominfo.min.js"></script>
                                <div id="gpr-kominfo-widget-container" class="w-full flex-1 flex flex-col mt-12 min-h-0"></div>

                                <!-- JS: Force white background on GPR container (overrides inline style injected by widget) -->
                                <script>
                                (function() {
                                    var WHITE = '#f0fdf4';
                                    var TEXT  = '#274CA5';

                                    function forceWhite(el) {
                                        if (!el) return;
                                        el.style.setProperty('background-color', WHITE, 'important');
                                        el.style.setProperty('background',       WHITE, 'important');
                                        el.style.setProperty('color',            TEXT,  'important');
                                        el.style.removeProperty('border-radius');
                                        el.style.setProperty('border',           'none', 'important');
                                        el.style.setProperty('box-shadow',       'none', 'important');
                                        el.style.setProperty('outline',          'none', 'important');
                                    }

                                    function cleanWidget() {
                                        var ids = ['gpr-kominfo-widget-container',
                                                'gpr-kominfo-widget-header',
                                                'gpr-kominfo-widget-body',
                                                'gpr-kominfo-widget-footer'];
                                        ids.forEach(function(id) { forceWhite(document.getElementById(id)); });

                                        // Stretch body to fill card height
                                        var body = document.getElementById('gpr-kominfo-widget-body');
                                        if (body) {
                                            body.style.setProperty('flex', '1 1 auto', 'important');
                                            body.style.setProperty('height', '100%', 'important');
                                            body.style.setProperty('max-height', 'none', 'important');
                                            body.style.setProperty('overflow-y', 'auto', 'important');
                                            body.style.setProperty('display', 'flex', 'important');
                                            body.style.setProperty('flex-direction', 'column', 'important');
                                            
                                            // Find the ul list inside and remove its fixed max-height of 450px
                                            var ul = body.querySelector('ul');
                                            if (ul) {
                                                ul.style.setProperty('flex', '1 1 auto', 'important');
                                                ul.style.setProperty('max-height', 'none', 'important');
                                                ul.style.setProperty('height', '100%', 'important');
                                                ul.style.setProperty('margin', '0', 'important');
                                                ul.style.setProperty('padding-bottom', '10px', 'important');
                                            }
                                        }

                                        // Hide widget's own header
                                        var wHeader = document.getElementById('gpr-kominfo-widget-header');
                                        if (wHeader) {
                                            wHeader.style.setProperty('display', 'none', 'important');
                                            wHeader.style.setProperty('height', '0', 'important');
                                        }

                                        // Replace placeholder icons with real image (Gambar 1)
                                        var gprImages = document.querySelectorAll('#gpr-kominfo-widget-body ul li img');
                                        var defaultImgUrl = 'https://images.unsplash.com/photo-1577962917302-cd874462e648?q=80&w=400&auto=format&fit=crop';
                                        gprImages.forEach(function(img) {
                                            if(img.src !== defaultImgUrl) {
                                                img.src = defaultImgUrl;
                                            }
                                            img.style.setProperty('width', '64px', 'important');
                                            img.style.setProperty('height', '64px', 'important');
                                            img.style.setProperty('object-fit', 'cover', 'important');
                                            img.style.setProperty('border-radius', '12px', 'important');
                                            img.style.setProperty('padding', '0', 'important');
                                            img.style.setProperty('margin-right', '12px', 'important');
                                            
                                            var parent = img.parentElement;
                                            if (parent && parent.tagName.toLowerCase() === 'a' || parent.tagName.toLowerCase() === 'div') {
                                                parent.style.setProperty('background', 'transparent', 'important');
                                                parent.style.setProperty('padding', '0', 'important');
                                                parent.style.setProperty('border-radius', '0', 'important');
                                            }
                                        });

                                        // Also scan all child elements for dark backgrounds
                                        var container = document.getElementById('gpr-kominfo-widget-container');
                                        if (container) {
                                            container.querySelectorAll('*').forEach(function(el) {
                                                if (el.tagName.toLowerCase() === 'img') return; // Skip images so we don't mess up our custom thumbnails
                                                var bg = el.style.backgroundColor || window.getComputedStyle(el).backgroundColor;
                                                if (!bg) return;
                                                var m = bg.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\)/);
                                                if (m) {
                                                    var r=+m[1], g=+m[2], b=+m[3], total=r+g+b;
                                                    if (total < 350 && b >= r && b >= g) forceWhite(el);
                                                }
                                            });
                                        }
                                    }

                                    // Run immediately and repeatedly
                                    cleanWidget();
                                    [100, 500, 1000, 2000, 3500, 5000, 8000].forEach(function(ms) {
                                        setTimeout(cleanWidget, ms);
                                    });

                                    // MutationObserver on attributes of container itself
                                    var container = document.getElementById('gpr-kominfo-widget-container');
                                    if (container) {
                                        new MutationObserver(cleanWidget).observe(container, {
                                            attributes: true,
                                            attributeFilter: ['style'],
                                            childList: true,
                                            subtree: true
                                        });
                                    }
                                })();
                                </script>


                            </div>
                        </div>

                    </div>
            </div>
        </section>
