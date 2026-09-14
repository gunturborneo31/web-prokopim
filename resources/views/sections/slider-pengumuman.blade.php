        <!-- ============================================ -->
        <!-- SECTION 2: SLIDE BERITA UTAMA & LAYANAN     -->
        <!-- ============================================ -->
        @php
            $announcementSlides = !empty($pengumumanGambarItems) && count($pengumumanGambarItems) > 0
                ? $pengumumanGambarItems
                : ($pengumumanItems ?? []);
        @endphp

        <section class="py-16 relative bg-white"
            x-data="{
                currentSlide: 0,
                totalSlides: {{ count($sliderItems ?? []) }},
                announcementSlide: 0,
                totalAnnouncements: {{ count($announcementSlides ?? []) }},
                isModalOpen: false,
                modalImageSrc: ''
            }"
            x-init="
                if (totalSlides > 1) {
                    setInterval(() => { currentSlide = (currentSlide + 1) % totalSlides }, 5000)
                }
                if (totalAnnouncements > 1) {
                    setInterval(() => { announcementSlide = (announcementSlide + 1) % totalAnnouncements }, 4200)
                }
            "
            @keydown.escape.window="isModalOpen = false">
            <div class="container mx-auto px-4 sm:px-6 lg:px-12 mt-8">
                <div class="mx-auto grid w-full max-w-[1500px] grid-cols-1 gap-4 lg:grid-cols-[minmax(0,3.2fr)_minmax(340px,1.4fr)] lg:gap-6 items-stretch">
                    <!-- Slider utama -->
                    <div data-aos="fade-right" class="relative justify-self-center rounded-[2rem] overflow-hidden shadow-2xl shadow-slate-300/20 group border border-slate-200/70 bg-slate-50
                        h-[260px] sm:h-[320px] lg:h-[420px] xl:h-[480px] min-h-[260px] sm:min-h-[320px] lg:min-h-[420px] xl:min-h-[480px] w-full">
                        <!-- Shimmer skeleton -->
                        <div class="absolute inset-0 shimmer-bg z-0"></div>
                        <!-- Slides -->
                        @forelse($sliderItems ?? [] as $index => $slide)
                        <div class="absolute inset-0 transform-gpu"
                             x-show="currentSlide === {{ $index }}"
                             x-cloak
                             x-transition:enter="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-10"
                             x-transition:enter-start="translate-y-full"
                             x-transition:enter-end="translate-y-0"
                             x-transition:leave="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-0"
                             x-transition:leave-start="translate-y-0"
                             x-transition:leave-end="-translate-y-full">
                            <a href="{{ !empty($slide['link']) ? $slide['link'] : '#' }}"
                               @if (empty($slide['link'])) @click.prevent="isModalOpen = true; modalImageSrc = '{{ $slide['image'] }}'" @endif
                               class="absolute inset-0 flex items-center justify-center bg-white {{ !empty($slide['link']) ? 'cursor-pointer' : 'cursor-zoom-in' }}">
                               <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="w-full h-full object-cover object-center transition-transform duration-[2s] ease-out group-hover:scale-[1.02]" loading="lazy">
                            </a>
                        </div>
                        @empty
                        <div class="absolute inset-0 flex items-center justify-center bg-slate-50 text-slate-400 font-medium text-sm">
                            Belum ada slider untuk ditampilkan.
                        </div>
                        @endforelse

                        <div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 h-32 bg-gradient-to-t from-slate-900/30 via-slate-900/5 to-transparent"></div>


                        <!-- Minimalist Vertical Slider Controls -->
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 z-20 flex flex-col items-center gap-4">
                            <button @click="currentSlide = (currentSlide - 1 + totalSlides) % totalSlides" 
                                    class="rounded-full bg-white/80 p-2 text-slate-500 shadow-md backdrop-blur transition-all hover:text-instansi-action active:scale-90"
                                    title="Sebelumnya">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 15l-6-6-6 6" /></svg>
                            </button>
                            
                            <div class="flex flex-col gap-2.5 rounded-full bg-white/70 px-2 py-3 shadow-md backdrop-blur">
                                @foreach($sliderItems ?? [] as $index => $slide)
                                <button @click="currentSlide = {{ $index }}" 
                                        class="w-1.5 rounded-full transition-all duration-500" 
                                        :class="currentSlide === {{ $index }} ? 'bg-instansi-action h-8' : 'bg-slate-300/70 h-2 hover:bg-slate-400'"></button>
                                @endforeach
                            </div>

                            <button @click="currentSlide = (currentSlide + 1) % totalSlides" 
                                    class="rounded-full bg-white/80 p-2 text-slate-500 shadow-md backdrop-blur transition-all hover:text-instansi-action active:scale-90"
                                    title="Selanjutnya">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 9l6 6 6-6" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Pengumuman gambar -->
                    <div data-aos="fade-up" class="w-full">
                        @if(!empty($announcementSlides) && count($announcementSlides) > 0)
                        <div class="relative h-[260px] sm:h-[320px] lg:h-[420px] xl:h-[480px] overflow-hidden rounded-[2rem] border border-slate-200/80 bg-slate-100 shadow-xl shadow-slate-300/20">
                            @foreach($announcementSlides as $index => $pengumuman)
                            <a href="{{ !empty($pengumuman['link']) ? $pengumuman['link'] : '#' }}"
                                class="absolute inset-0 block group"
                                x-show="announcementSlide === {{ $index }}"
                                x-cloak
                                @if (empty($pengumuman['link'])) @click.prevent="isModalOpen = true; modalImageSrc = '{{ $pengumuman['image'] }}'" @endif
                                x-transition:enter="transition-all duration-700 ease-out"
                                x-transition:enter-start="opacity-0 translate-y-3"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition-all duration-500 ease-in"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-3">
                                <img src="{{ $pengumuman['image'] }}"
                                    alt="{{ $pengumuman['title'] ?? 'Pengumuman' }}"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-slate-900/20 to-transparent"></div>
                                <div class="absolute inset-x-0 top-0 flex items-start justify-between p-4">
                                    @if(count($announcementSlides) > 1)
                                    <span class="rounded-full bg-slate-900/55 px-2.5 py-1 text-[11px] font-semibold text-white backdrop-blur">{{ $index + 1 }}/{{ count($announcementSlides) }}</span>
                                    @endif
                                </div>
                                <div class="absolute inset-x-0 bottom-0 p-4 text-white">
                                    <p class="text-sm font-semibold leading-5 line-clamp-3">{{ $pengumuman['title'] ?? 'Pengumuman' }}</p>
                                </div>
                            </a>
                            @endforeach

                            @if(count($announcementSlides) > 1)
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 z-20 flex flex-col items-center gap-4">
                                <button @click="announcementSlide = (announcementSlide - 1 + totalAnnouncements) % totalAnnouncements"
                                        class="rounded-full bg-white/80 p-2 text-slate-500 shadow-md backdrop-blur transition-all hover:text-instansi-action active:scale-90"
                                        title="Pengumuman sebelumnya">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 15l-6-6-6 6" /></svg>
                                </button>

                                <button @click="announcementSlide = (announcementSlide + 1) % totalAnnouncements"
                                        class="rounded-full bg-white/80 p-2 text-slate-500 shadow-md backdrop-blur transition-all hover:text-instansi-action active:scale-90"
                                        title="Pengumuman selanjutnya">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 9l6 6 6-6" /></svg>
                                </button>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="h-[260px] sm:h-[320px] lg:h-[420px] xl:h-[480px] rounded-[2rem] border border-slate-300/20 bg-white/80 p-6 flex items-center justify-center text-center">
                            <p class="text-slate-600 font-medium">Belum ada pengumuman untuk ditampilkan.</p>
                        </div>
                        @endif
                    </div>

                    <!-- Berita visual -->
                    <div data-aos="fade-up" class="w-full lg:col-span-2">
                        <div class="h-[90px] sm:h-[110px] rounded-[2rem] border border-slate-300/20 bg-white/80 p-6 flex items-center justify-center text-center">
                            <p class="text-slate-700 font-semibold tracking-wide uppercase">Berita Visual</p>
                        </div>
                    </div>
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
