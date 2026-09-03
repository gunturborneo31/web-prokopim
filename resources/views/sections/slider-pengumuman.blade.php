        <!-- ============================================ -->
        <!-- SECTION 2: SLIDE BERITA UTAMA & LAYANAN     -->
        <!-- ============================================ -->
        <section class="py-16 relative bg-white" x-data="{ currentSlide: 0, totalSlides: {{ count($pengumumanItems ?? []) }}, isModalOpen: false, modalImageSrc: '' }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % totalSlides }, 5000)" @keydown.escape.window="isModalOpen = false">
            <div class="container mx-auto px-4 sm:px-6 lg:px-12 mt-8">
                <div class="mx-auto grid w-full grid-cols-1 lg:grid-cols-[minmax(600px,1fr)_minmax(500px,620px)] xl:grid-cols-[minmax(680px,1fr)_minmax(560px,700px)] gap-4 lg:gap-4 items-center justify-center">
                    <!-- News Slider -->
                    <div data-aos="fade-right" class="relative justify-self-center rounded-3xl overflow-hidden shadow-2xl shadow-slate-300-dark/20 group border border-slate-300/10
                        h-[220px] sm:h-[250px] lg:h-[330px] xl:h-[360px] min-h-[220px] sm:min-h-[250px] lg:min-h-[330px] xl:min-h-[360px] w-full">
                        <!-- Shimmer skeleton -->
                        <div class="absolute inset-0 shimmer-bg z-0"></div>
                        <!-- Slides -->
                        @foreach($pengumumanItems as $index => $pengumuman)
                        <div class="absolute inset-0 transform-gpu"
                             x-show="currentSlide === {{ $index }}"
                             x-transition:enter="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-10"
                             x-transition:enter-start="translate-y-full"
                             x-transition:enter-end="translate-y-0"
                             x-transition:leave="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-0"
                             x-transition:leave-start="translate-y-0"
                             x-transition:leave-end="-translate-y-full">
                            <a href="#" @click.prevent="isModalOpen = true; modalImageSrc = '{{ $pengumuman['image'] }}'" class="absolute inset-0 flex items-center justify-center bg-white cursor-zoom-in">
                                <img src="{{ $pengumuman['image'] }}" alt="{{ $pengumuman['title'] }}" class="w-full h-full object-cover object-center transition-transform duration-[2s] ease-out" loading="lazy">
                            </a>
                        </div>
                        @endforeach

                        <!-- Minimalist Vertical Slider Controls -->
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 z-20 flex flex-col items-center gap-5">
                            <button @click="currentSlide = (currentSlide - 1 + totalSlides) % totalSlides" 
                                    class="text-slate-400 hover:text-instansi-action transition-all active:scale-90 p-1"
                                    title="Sebelumnya">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 15l-6-6-6 6" /></svg>
                            </button>
                            
                            <div class="flex flex-col gap-3">
                                @foreach($pengumumanItems as $index => $pengumuman)
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

                    <!-- Sidebar Agenda (terhubung DB agenda) -->
                    <div data-aos="fade-left" class="w-full flex-shrink-0"
                         x-data="{ 
                            newsIndex: 0, 
                            totalNews: {{ count($agendaItems ?? []) }},
                            secondaryIndex() {
                                if (this.totalNews <= 1) return this.newsIndex;
                                return (this.newsIndex + 1) % this.totalNews;
                            }
                         }"
                         x-init="if (totalNews > 1) { setInterval(() => { newsIndex = (newsIndex + 1) % totalNews }, 4200) }">
                        @if(!empty($agendaItems) && count($agendaItems) > 0)
                        <div class="grid grid-cols-2 gap-3 h-[220px] sm:h-[250px] lg:h-[330px] xl:h-[360px]">
                            <div class="relative h-full rounded-3xl border border-slate-200 shadow-xl overflow-hidden bg-slate-100">
                                
                                @foreach($agendaItems as $index => $agenda)
                                <a href="#"
                                   @click.prevent="isModalOpen = true; modalImageSrc = '{{ asset('images/desamahakamulu.jpg') }}'"
                                   class="absolute inset-0 block cursor-zoom-in"
                                   x-show="newsIndex === {{ $index }}"
                                   x-transition:enter="transition-opacity duration-700 ease-out"
                                   x-transition:enter-start="opacity-0"
                                   x-transition:enter-end="opacity-100"
                                   x-transition:leave="transition-opacity duration-500 ease-in"
                                   x-transition:leave-start="opacity-100"
                                   x-transition:leave-end="opacity-0">
                                    <img src="{{ asset('images/informasi.jpeg') }}"
                                         alt="{{ $agenda['title'] }}"
                                         class="h-full w-full object-cover object-center"
                                         loading="lazy">
                                </a>
                                @endforeach
                            </div>

                            <div class="relative h-full rounded-3xl border border-slate-200 shadow-xl overflow-hidden bg-slate-100">
                                
                                @foreach($agendaItems as $index => $agenda)
                                <a href="#"
                                   @click.prevent="isModalOpen = true; modalImageSrc = '{{ asset('images/desamahakamulu.jpg') }}'"
                                   class="absolute inset-0 block cursor-zoom-in"
                                   x-show="secondaryIndex() === {{ $index }}"
                                   x-transition:enter="transition-opacity duration-700 ease-out"
                                   x-transition:enter-start="opacity-0"
                                   x-transition:enter-end="opacity-100"
                                   x-transition:leave="transition-opacity duration-500 ease-in"
                                   x-transition:leave-start="opacity-100"
                                   x-transition:leave-end="opacity-0">
                                    <img src="{{ asset('images/informasi.jpeg') }}"
                                         alt="{{ $agenda['title'] }}"
                                         class="h-full w-full object-cover object-center"
                                         loading="lazy">
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="h-full min-h-[360px] rounded-3xl border border-slate-300/20 bg-white/80 p-6 flex items-center justify-center text-center">
                            <p class="text-slate-600 font-medium">Belum ada data agenda untuk ditampilkan.</p>
                        </div>
                        @endif
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
