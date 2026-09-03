<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[56px] pb-10 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-45">
                <img src="{{ asset('images/batucermin.jpg') }}" alt="Berita" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 z-10 bg-gradient-to-b from-[#274CA5]/55 via-[#274CA5]/35 to-[#10192D]/70 backdrop-blur-2xl"></div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">

            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="rgBerita" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0" />
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2" />
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#rgBerita)"
                    stroke-width="2" />
            </svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="mx-auto max-w-4xl rounded-[2rem] px-6 py-6 text-center sm:px-10 sm:py-8" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border border-white/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 px-3 mr-2">
                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-white opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                    </div>Berita
                </div>

                <h1 class="font-montserrat font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight drop-shadow-2xl">
                    Berita <span class="text-sky-200">&amp;</span> Informasi
                </h1>
                <div class="mt-5 flex items-center justify-center gap-2 text-sm text-white/70">
                    <a href="{{ route('beranda') }}" wire:navigate class="hover:text-sky-200 transition-colors">Beranda</a><span>/</span><span
                        class="text-sky-200">Berita</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none"
                class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z" />
            </svg></div>
    </section>

    {{-- ===================== FEATURED NEWS ===================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14">

        {{-- Featured / Hero News --}}
        <div data-aos="fade-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-7 bg-gradient-to-b from-[#274CA5] to-[#0f172a] rounded-full"></div>
                <h2 class="text-xl font-bold text-slate-800">Berita Utama</h2>
            </div>

            <a href="{{ route('berita.show', $featuredNews['slug']) }}" wire:navigate
               class="group relative rounded-3xl overflow-hidden block shadow-2xl shadow-slate-300/20 min-h-[400px] lg:min-h-[480px]">
                <img src="{{ $featuredNews['image'] }}" alt="{{ $featuredNews['title'] }}"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-[#274CA5]/95 via-[#274CA5]/50 to-transparent"></div>
                <div class="absolute inset-0 /60 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12 z-10">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-sky-500 text-white text-[11px] font-bold uppercase tracking-wider mb-4 shadow-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                        {{ $featuredNews['category'] }}
                    </span>
                    <h2 class="font-montserrat font-black text-2xl md:text-4xl text-white leading-tight mb-4 max-w-3xl drop-shadow-lg group-hover:text-sky-200 transition-colors duration-300">
                        {{ $featuredNews['title'] }}
                    </h2>
                    <p class="text-sky-100 text-base mb-6 max-w-2xl leading-relaxed line-clamp-2 opacity-90">
                        {{ $featuredNews['excerpt'] }}
                    </p>
                    <div class="flex items-center gap-6 text-sm text-sky-200">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $featuredNews['date'] }}
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ number_format($featuredNews['views']) }} views
                        </span>
                        <span class="hidden md:inline-flex items-center gap-2 px-5 py-2 bg-white/10 backdrop-blur-sm border borderwhite/20 rounded-full text-white font-bold text-sm group-hover:bg-[#274CA5] group-hover:border-sky-300 transition-all duration-300">
                            Baca Selengkapnya →
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </section>

    {{-- ===================== FILTER + NEWS GRID ===================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pb-20"
             x-data="{
                 search: '{{ $searchQuery ?? '' }}',
                 activeCategory: '{{ $activeCategory ?? '' }}'
             }">

        {{-- Filter & Search Bar --}}
        <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 mb-10" data-aos="fade-up">
            {{-- Category Pills --}}
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('berita.index') }}" wire:navigate
                   class="px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ !$activeCategory ? 'bg-sky-500 text-white shadow-md shadow-sky-200' : 'bg-white border border-slate-200 text-slate-600 hover:border-sky-400 hover:text-sky-600' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('berita.index', ['kategori' => $cat]) }}" wire:navigate
                   class="px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ $activeCategory === $cat ? 'bg-sky-500 text-white shadow-md shadow-sky-200' : 'bg-white border border-slate-200 text-slate-600 hover:border-sky-400 hover:text-sky-600' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>

            {{-- Search --}}
            <form method="GET" action="{{ route('berita.index') }}" class="relative flex-shrink-0 w-full md:w-72">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                @if($activeCategory)
                    <input type="hidden" name="kategori" value="{{ $activeCategory }}">
                @endif
                <input type="text" name="q" value="{{ $searchQuery }}"
                       placeholder="Cari berita..."
                       class="w-full pl-11 pr-10 py-3 rounded-xl border border-slate-200 bg-white text-sm font-medium text-slate-700 placeholder-slate-400 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all">
                @if($searchQuery)
                <a href="{{ route('berita.index', $activeCategory ? ['kategori' => $activeCategory] : []) }}" wire:navigate
                   class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </form>
        </div>

        {{-- Results info --}}
        @if($searchQuery || $activeCategory)
        <div class="mb-6 flex items-center gap-2 text-sm text-slate-500" data-aos="fade-up">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Menampilkan <span class="font-bold text-slate-700">{{ $allNews->total() }}</span> artikel
            @if($searchQuery) untuk "<span class="font-bold text-sky-600">{{ $searchQuery }}</span>" @endif
            @if($activeCategory) dalam kategori "<span class="font-bold text-sky-600">{{ $activeCategory }}</span>" @endif
        </div>
        @endif

        {{-- News Grid --}}
        @if($allNews->total() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($allNews as $i => $news)
            <article class="group bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300"
                     data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">
                {{-- Thumbnail --}}
                <a href="{{ route('berita.show', $news['slug']) }}" wire:navigate class="block relative overflow-hidden aspect-[16/9]">
                    <div class="absolute inset-0 bg-slate-200 shimmer-bg"></div>
                    <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#274CA5]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="absolute top-4 left-4 inline-flex items-center px-3 py-1.5 rounded-full bg-sky-500/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wider shadow-sm">
                        {{ $news['category'] }}
                    </span>
                </a>

                {{-- Content --}}
                <div class="p-6">
                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $news['date'] }}
                        </span>
                        <span class="text-slate-200">•</span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ number_format($news['views']) }}
                        </span>
                    </div>

                    <h3 class="font-bold text-slate-800 text-lg leading-snug mb-3 line-clamp-2 group-hover:text-sky-600 transition-colors duration-300">
                        <a href="{{ route('berita.show', $news['slug']) }}" wire:navigate>{{ $news['title'] }}</a>
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-5">{{ $news['excerpt'] }}</p>

                    <a href="{{ route('berita.show', $news['slug']) }}" wire:navigate
                       class="inline-flex items-center gap-2 text-sky-600 font-bold text-sm hover:text-sky-700 transition-colors group/link">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-12 flex justify-center w-full" data-aos="fade-up">
            {{ $allNews->links() }}
        </div>
        @else
        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-24 text-center" data-aos="fade-up">
            <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-600 mb-2">Tidak Ada Berita Ditemukan</h3>
            <p class="text-slate-400 text-sm mb-6">Coba ubah kata kunci atau kategori pencarian.</p>
            <a href="{{ route('berita.index') }}" wire:navigate
               class="inline-flex items-center gap-2 px-6 py-3 bg-sky-500 text-white font-bold rounded-xl hover:bg-sky-600 transition-colors">
                Lihat Semua Berita
            </a>
        </div>
        @endif

    </section>
</x-layouts.app>
