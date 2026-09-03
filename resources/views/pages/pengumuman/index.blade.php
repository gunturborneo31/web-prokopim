<x-layouts.app>
    <section class="relative pt-[56px] pb-10 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-45">
                <img src="{{ asset('images/batucermin.jpg') }}" alt="Pengumuman" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 z-10 bg-gradient-to-b from-[#274CA5]/55 via-[#274CA5]/35 to-[#10192D]/70 backdrop-blur-2xl"></div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt=""
                 class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">

            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none"
                 xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="rgPengumuman" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0" />
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2" />
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#rgPengumuman)"
                      stroke-width="2" />
            </svg>
        </div>

        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="mx-auto max-w-4xl rounded-[2rem] px-6 py-6 text-center sm:px-10 sm:py-8" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border border-white/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 px-3 mr-2">
                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-white opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                    </div>Informasi
                </div>

                <h1 class="font-montserrat font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight drop-shadow-2xl">
                    Pengumuman
                </h1>
                <div class="mt-5 flex items-center justify-center gap-2 text-sm text-white/70">
                    <a href="{{ route('beranda') }}" wire:navigate class="hover:text-sky-200 transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-sky-200">Pengumuman</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none"
                class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z" />
            </svg></div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14"
             x-data="{ search: '{{ $searchQuery ?? '' }}', activeCategory: '{{ $activeCategory ?? '' }}' }">

        <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 mb-10" data-aos="fade-up">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('pengumuman.index') }}" wire:navigate
                   class="px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ !$activeCategory ? 'bg-sky-500 text-white shadow-md shadow-sky-200' : 'bg-white border border-slate-200 text-slate-600 hover:border-sky-400 hover:text-sky-600' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('pengumuman.index', ['kategori' => $cat]) }}" wire:navigate
                   class="px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ $activeCategory === $cat ? 'bg-sky-500 text-white shadow-md shadow-sky-200' : 'bg-white border border-slate-200 text-slate-600 hover:border-sky-400 hover:text-sky-600' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>

            <form method="GET" action="{{ route('pengumuman.index') }}" class="relative flex-shrink-0 w-full md:w-72">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                @if($activeCategory)
                    <input type="hidden" name="kategori" value="{{ $activeCategory }}">
                @endif
                <input type="text" name="q" value="{{ $searchQuery }}"
                       placeholder="Cari pengumuman..."
                       class="w-full pl-11 pr-10 py-3 rounded-xl border border-slate-200 bg-white text-sm font-medium text-slate-700 placeholder-slate-400 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all">
                @if($searchQuery)
                <a href="{{ route('pengumuman.index', $activeCategory ? ['kategori' => $activeCategory] : []) }}" wire:navigate
                   class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </form>
        </div>

        @if($searchQuery || $activeCategory)
        <div class="mb-6 flex items-center gap-2 text-sm text-slate-500" data-aos="fade-up">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Menampilkan <span class="font-bold text-slate-700">{{ $allItems->total() }}</span> pengumuman
            @if($searchQuery) untuk "<span class="font-bold text-sky-600">{{ $searchQuery }}</span>" @endif
            @if($activeCategory) dalam kategori "<span class="font-bold text-sky-600">{{ $activeCategory }}</span>" @endif
        </div>
        @endif

        @if($allItems->total() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-6">
            @foreach($allItems as $i => $item)
            <a href="{{ route('pengumuman.show', $item['slug']) }}" wire:navigate
               class="group relative block rounded-2xl overflow-hidden border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300"
               data-aos="fade-up" data-aos-delay="{{ $i * 40 }}">
                <div class="aspect-[3/4] relative overflow-hidden bg-slate-200">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a]/88 via-[#0f172a]/35 to-transparent"></div>
                    <div class="absolute left-0 right-0 bottom-0 p-4">
                        <h3 class="font-bold text-white text-sm md:text-base leading-snug line-clamp-3 drop-shadow-lg">
                            {{ $item['title'] }}
                        </h3>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center w-full" data-aos="fade-up">
            {{ $allItems->links() }}
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-24 text-center" data-aos="fade-up">
            <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-600 mb-2">Belum Ada Pengumuman</h3>
            <p class="text-slate-400 text-sm mb-6">Coba ubah kata kunci atau kategori pencarian.</p>
            <a href="{{ route('pengumuman.index') }}" wire:navigate
               class="inline-flex items-center gap-2 px-6 py-3 bg-sky-500 text-white font-bold rounded-xl hover:bg-sky-600 transition-colors">
                Lihat Semua Pengumuman
            </a>
        </div>
        @endif
    </section>
</x-layouts.app>
