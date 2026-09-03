<x-layouts.app>
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-30">
                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="Background SVG"
                 class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/95 via-sky-900/80 to-sky-800/70 z-10 mix-blend-multiply"></div>
        </div>

        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl mx-auto" data-aos="fade-up">
                <div class="mb-5">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-sky-500 text-white text-[11px] font-bold uppercase tracking-wider shadow-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                        {{ $item['category'] }}
                    </span>
                </div>
                <h1 class="font-montserrat font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight drop-shadow-2xl mb-6">
                    {{ $item['title'] }}
                </h1>
                <div class="flex flex-wrap items-center gap-5 text-sky-200 text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $item['date'] }}
                    </span>
                    <span class="text-white/20">|</span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{ number_format($item['views']) }} views
                    </span>
                </div>
                <div class="mt-6 flex items-center gap-2 text-sm text-white/40">
                    <a href="{{ route('beranda') }}" wire:navigate class="hover:text-[#93c5fd] transition-colors">Beranda</a>
                    <span>/</span>
                    <a href="{{ route('pengumuman.index') }}" wire:navigate class="hover:text-[#93c5fd] transition-colors">Pengumuman</a>
                    <span>/</span>
                    <span class="text-[#93c5fd] truncate max-w-[200px]">{{ $item['title'] }}</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-8" data-aos="fade-up">
                <div class="mb-8">
                    <a href="{{ route('pengumuman.index') }}" wire:navigate
                       class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-bold text-sm shadow-sm hover:bg-sky-50 hover:border-sky-400 hover:text-sky-600 hover:shadow-md active:scale-95 transition-all duration-200 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Pengumuman
                    </a>
                </div>

                <div class="rounded-2xl overflow-hidden shadow-xl mb-10 max-w-xl mx-auto">
                    <div class="aspect-[3/4]">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="bg-sky-50 border-l-4 border-sky-400 rounded-r-xl p-6 mb-8">
                    <p class="text-sky-800 text-lg font-medium leading-relaxed italic">{{ $item['excerpt'] }}</p>
                </div>

                <div class="prose prose-lg prose-slate max-w-none">
                    @foreach(array_filter(explode("\n\n", $item['content'])) as $paragraph)
                    <p class="text-slate-600 leading-relaxed text-base mb-6">{{ trim($paragraph) }}</p>
                    @endforeach
                </div>

                @if(!empty($item['tags']))
                <div class="mt-10 pt-8 border-t border-slate-100">
                    <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">Tags</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($item['tags'] as $tag)
                        <span class="px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-bold hover:bg-sky-100 hover:text-sky-700 transition-colors cursor-default">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <aside class="lg:col-span-4 space-y-8" data-aos="fade-left" data-aos-delay="100">
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-1 h-5 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Pengumuman Terbaru</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentItems as $recent)
                        <a href="{{ route('pengumuman.show', $recent['slug']) }}" wire:navigate
                           class="group flex gap-3 items-start hover:bg-slate-50 rounded-xl p-2 -mx-2 transition-colors duration-200 {{ $recent['slug'] === $item['slug'] ? 'opacity-50 pointer-events-none' : '' }}">
                            <div class="flex-shrink-0 w-14 rounded-lg overflow-hidden">
                                <div class="aspect-[3/4]">
                                    <img src="{{ $recent['image'] }}" alt="{{ $recent['title'] }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-700 leading-snug line-clamp-2 group-hover:text-sky-600 transition-colors">
                                    {{ $recent['title'] }}
                                </p>
                                <span class="text-[11px] text-slate-400 mt-1 block">{{ $recent['date'] }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('pengumuman.index') }}" wire:navigate
                       class="mt-5 flex items-center justify-center gap-2 py-2.5 rounded-xl border border-sky-200 bg-sky-50 text-sky-600 font-bold text-sm hover:bg-sky-100 transition-colors">
                        Lihat Semua Pengumuman →
                    </a>
                </div>

                @if(count($related) > 0)
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-1 h-5 bg-gradient-to-b from-sky-400 to-blue-600 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Pengumuman Terkait</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($related as $rel)
                        <a href="{{ route('pengumuman.show', $rel['slug']) }}" wire:navigate
                           class="group block rounded-xl overflow-hidden border border-slate-100 hover:border-sky-300 hover:shadow-md transition-all duration-300">
                            <div class="relative overflow-hidden aspect-[3/4]">
                                <img src="{{ $rel['image'] }}" alt="{{ $rel['title'] }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                <div class="absolute inset-x-0 bottom-0 p-3 bg-gradient-to-t from-[#0f172a]/80 to-transparent">
                                    <p class="font-bold text-xs text-white leading-snug line-clamp-2">{{ $rel['title'] }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</x-layouts.app>
