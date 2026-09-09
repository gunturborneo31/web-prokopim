        <!-- ============================================ -->
        <!-- SECTION 2: SLIDE BERITA UTAMA & LAYANAN     -->
        <!-- ============================================ -->
        <section class="py-16 relative bg-white" x-data="{ currentSlide: 0, totalSlides: {{ count($sliderItems ?? []) }}, isModalOpen: false, modalImageSrc: '' }" x-init="if (totalSlides > 1) { setInterval(() => { currentSlide = (currentSlide + 1) % totalSlides }, 5000) }" @keydown.escape.window="isModalOpen = false">
            <div class="container mx-auto px-4 sm:px-6 lg:px-12 mt-8">
                <div class="mx-auto grid w-full grid-cols-1 lg:grid-cols-[minmax(600px,1fr)_minmax(500px,620px)] xl:grid-cols-[minmax(680px,1fr)_minmax(560px,700px)] gap-4 lg:gap-4 items-center justify-center">
                    <!-- News Slider -->
                    <div data-aos="fade-right" class="relative justify-self-center rounded-3xl overflow-hidden shadow-2xl shadow-slate-300-dark/20 group border border-slate-300/10
                        h-[220px] sm:h-[250px] lg:h-[330px] xl:h-[360px] min-h-[220px] sm:min-h-[250px] lg:min-h-[330px] xl:min-h-[360px] w-full">
                        <!-- Shimmer skeleton -->
                        <div class="absolute inset-0 shimmer-bg z-0"></div>
                        <!-- Slides -->
                        @forelse($sliderItems ?? [] as $index => $slide)
                        <div class="absolute inset-0 transform-gpu"
                             x-show="currentSlide === {{ $index }}"
                             x-transition:enter="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-10"
                             x-transition:enter-start="translate-y-full"
                             x-transition:enter-end="translate-y-0"
                             x-transition:leave="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-0"
                             x-transition:leave-start="translate-y-0"
                             x-transition:leave-end="-translate-y-full">
                            <a href="#" @click.prevent="isModalOpen = true; modalImageSrc = '{{ $slide['image'] }}'" class="absolute inset-0 flex items-center justify-center bg-white cursor-zoom-in">
                                <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="w-full h-full object-cover object-center transition-transform duration-[2s] ease-out" loading="lazy">
                            </a>
                        </div>
                        @empty
                        <div class="absolute inset-0 flex items-center justify-center bg-slate-50 text-slate-400 font-medium text-sm">
                            Belum ada slider untuk ditampilkan.
                        </div>
                        @endforelse

                        <!-- Minimalist Vertical Slider Controls -->
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 z-20 flex flex-col items-center gap-5">
                            <button @click="currentSlide = (currentSlide - 1 + totalSlides) % totalSlides" 
                                    class="text-slate-400 hover:text-instansi-action transition-all active:scale-90 p-1"
                                    title="Sebelumnya">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 15l-6-6-6 6" /></svg>
                            </button>
                            
                            <div class="flex flex-col gap-3">
                                @foreach($sliderItems ?? [] as $index => $slide)
                                <button @click="currentSlide = {{ $index }}" 
                                        class="w-1 rounded-full transition-all duration-500" 
                                        :class="currentSlide === {{ $index }} ? 'bg-instansi-action h-8' : 'bg-slate-300/40 h-1.5 hover:bg-slate-400'"></button>
                                @endforeach
                            </div>

                            <button @click="currentSlide = (currentSlide + 1) % totalSlides" 
                                    class="text-slate-400 hover:text-instansi-action transition-all active:scale-90 p-1"
                                    title="Selanjutnya">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 9l6 6 6-6" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Sidebar Pengumuman (terhubung DB pengumuman) -->
                    <div data-aos="fade-left" class="w-full flex-shrink-0"
                         x-data="{ 
                            newsIndex: 0, 
                            totalNews: {{ count($pengumumanItems ?? []) }},
                            secondaryIndex() {
                                if (this.totalNews <= 1) return this.newsIndex;
                                return (this.newsIndex + 1) % this.totalNews;
                            }
                         }"
                         x-init="if (totalNews > 1) { setInterval(() => { newsIndex = (newsIndex + 1) % totalNews }, 4200) }">
                        @if(!empty($pengumumanItems) && count($pengumumanItems) > 0)
                        <div class="grid grid-cols-2 gap-3 h-[220px] sm:h-[250px] lg:h-[330px] xl:h-[360px]">
                            <div class="relative h-full rounded-3xl border border-slate-200 shadow-xl overflow-hidden bg-slate-100">
                                
                                @foreach($pengumumanItems as $index => $pengumuman)
                                <a href="{{ $pengumuman['link'] }}"
                                   class="absolute inset-0 block group"
                                   x-show="newsIndex === {{ $index }}"
                                   x-transition:enter="transition-opacity duration-700 ease-out"
                                   x-transition:enter-start="opacity-0"
                                   x-transition:enter-end="opacity-100"
                                   x-transition:leave="transition-opacity duration-500 ease-in"
                                   x-transition:leave-start="opacity-100"
                                   x-transition:leave-end="opacity-0">
                                    <img src="{{ $pengumuman['image'] }}"
                                         alt="{{ $pengumuman['title'] }}"
                                         class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                                    <p class="absolute bottom-0 inset-x-0 p-3 text-white text-xs font-semibold line-clamp-2">{{ $pengumuman['title'] }}</p>
                                </a>
                                @endforeach
                            </div>

                            <div class="relative h-full rounded-3xl border border-slate-200 shadow-xl overflow-hidden bg-slate-100">
                                
                                @foreach($pengumumanItems as $index => $pengumuman)
                                <a href="{{ $pengumuman['link'] }}"
                                   class="absolute inset-0 block group"
                                   x-show="secondaryIndex() === {{ $index }}"
                                   x-transition:enter="transition-opacity duration-700 ease-out"
                                   x-transition:enter-start="opacity-0"
                                   x-transition:enter-end="opacity-100"
                                   x-transition:leave="transition-opacity duration-500 ease-in"
                                   x-transition:leave-start="opacity-100"
                                   x-transition:leave-end="opacity-0">
                                    <img src="{{ $pengumuman['image'] }}"
                                         alt="{{ $pengumuman['title'] }}"
                                         class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                                    <p class="absolute bottom-0 inset-x-0 p-3 text-white text-xs font-semibold line-clamp-2">{{ $pengumuman['title'] }}</p>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="h-full min-h-[360px] rounded-3xl border border-slate-300/20 bg-white/80 p-6 flex items-center justify-center text-center">
                            <p class="text-slate-600 font-medium">Belum ada pengumuman untuk ditampilkan.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Berita Visual IG -->
                @php
                    $visualIgChunks = collect($beritaVisualIgItems ?? [])->chunk(4)->values();
                @endphp
                <div class="mt-10" data-aos="fade-up"
                     x-data="{ igSlide: 0, igTotalSlides: {{ $visualIgChunks->count() }} }"
                     x-init="if (igTotalSlides > 1) { setInterval(() => { igSlide = (igSlide + 1) % igTotalSlides }, 4500) }">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-instansi-action" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                            <h3 class="font-heading font-bold text-slate-800 text-sm sm:text-base uppercase tracking-wide">Berita Visual IG</h3>
                        </div>
                        @if($visualIgChunks->count() > 1)
                        <div class="flex items-center gap-2">
                            @for($i = 0; $i < $visualIgChunks->count(); $i++)
                            <button @click="igSlide = {{ $i }}"
                                    class="h-1.5 rounded-full transition-all duration-500"
                                    :class="igSlide === {{ $i }} ? 'bg-instansi-action w-6' : 'bg-slate-300/60 w-1.5 hover:bg-slate-400'"></button>
                            @endfor
                        </div>
                        @endif
                    </div>

                    @if($visualIgChunks->isNotEmpty())
                    <div class="relative">
                        @foreach($visualIgChunks as $chunkIndex => $chunk)
                        <div x-show="igSlide === {{ $chunkIndex }}"
                             x-transition:enter="transition-opacity duration-700 ease-out"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition-opacity duration-500 ease-in"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            @foreach($chunk as $visual)
                            <a href="{{ $visual['link'] ?: '#' }}"
                               @if(!$visual['link']) @click.prevent="isModalOpen = true; modalImageSrc = '{{ $visual['image'] }}'" @else target="_blank" rel="noopener" @endif
                               class="group relative block aspect-square rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-slate-100 cursor-pointer">
                                <img src="{{ $visual['image'] }}"
                                     alt="{{ $visual['title'] ?: 'Berita Visual IG' }}"
                                     class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                @if($visual['title'])
                                <p class="absolute bottom-0 inset-x-0 p-2 text-white text-xs font-medium line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ $visual['title'] }}</p>
                                @endif
                            </a>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 flex items-center justify-center text-center">
                        <p class="text-slate-500 font-medium text-sm">Belum ada berita visual IG untuk ditampilkan.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Lightbox Modal -->
            <div x-show="isModalOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-sm p-4 sm:p-8"
                 x-cloak>
                
                <!-- Close Button -->
                <button @click="isModalOpen = false" class="absolute top-6 right-6 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full p-2 transition-all duration-300 z-[110]">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <!-- Full Image -->
                <div class="relative max-w-7xl w-full max-h-full flex items-center justify-center" @click.away="isModalOpen = false">
                    <img :src="modalImageSrc" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl ring-1 ring-white/10" alt="Pengumuman Full"
                         x-show="isModalOpen"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100" />
                </div>
            </div>
        </section>
