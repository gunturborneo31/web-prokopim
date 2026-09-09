<x-layouts.app>
    <x-slot name="pageTitle">{{ $news['title'] }} | PROKOPIM Mahakam Ulu</x-slot>
    <x-slot name="metaDescription">{{ $news['excerpt'] }}</x-slot>
    <x-slot name="metaImage">{{ $news['image'] }}</x-slot>

    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            {{-- Article Cover Image as hero background --}}
            <div class="absolute inset-0 z-0 opacity-30">
                <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="Background SVG"
                 class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/95 via-sky-900/80 to-sky-800/70 z-10 mix-blend-multiply"></div>
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="riverGoldShow" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldShow)" stroke-width="2"/>
            </svg>
        </div>

        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl mx-auto" data-aos="fade-up">
                {{-- Category badge --}}
                <div class="mb-5">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-sky-500 text-white text-[11px] font-bold uppercase tracking-wider shadow-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                        {{ $news['category'] }}
                    </span>
                </div>
                {{-- Title --}}
                <h1 class="font-montserrat font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight drop-shadow-2xl mb-6">
                    {{ $news['title'] }}
                </h1>
                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-5 text-sky-200 text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $news['author'] }}
                    </span>
                    <span class="text-white/20">|</span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $news['date'] }}
                    </span>
                    <span class="text-white/20">|</span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{ number_format($news['views']) }} views
                    </span>
                </div>
                {{-- Breadcrumb --}}
                <div class="mt-6 flex items-center gap-2 text-sm text-white/40">
                    <a href="{{ route('beranda') }}" wire:navigate class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <a href="{{ route('berita.index') }}" wire:navigate class="hover:text-[#274CA5] transition-colors">Berita</a>
                    <span>/</span>
                    <span class="text-[#274CA5] truncate max-w-[200px]">{{ $news['title'] }}</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ===================== ARTICLE BODY ===================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- ===== MAIN CONTENT ===== --}}
            <div class="lg:col-span-8" data-aos="fade-up">

                {{-- Back Button Top --}}
                <div class="mb-8">
                    <a href="{{ route('berita.index') }}" wire:navigate
                       class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-bold text-sm shadow-sm hover:bg-sky-50 hover:border-sky-400 hover:text-sky-600 hover:shadow-md active:scale-95 transition-all duration-200 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Berita
                    </a>
                </div>

                {{-- Cover Photo --}}
                <div class="rounded-2xl overflow-hidden shadow-xl mb-10 aspect-[16/9]">
                    <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}"
                         class="w-full h-full object-cover">
                </div>

                {{-- Excerpt / Lead --}}
                <div class="bg-sky-50 border-l-4 border-sky-400 rounded-r-xl p-6 mb-8">
                    <p class="text-sky-800 text-lg font-medium leading-relaxed italic">{{ $news['excerpt'] }}</p>
                </div>

                {{-- Article Content --}}
                @php
                    $articleContent = $news['content'] ?? '';
                    if ($articleContent !== '' && strip_tags($articleContent) === $articleContent) {
                        $paragraphs = array_values(array_filter(array_map('trim', preg_split('/\R+/', $articleContent))));
                        $paragraphs = array_map('e', $paragraphs);
                        $articleContent = ! empty($paragraphs)
                            ? '<p>' . implode('</p><p>', $paragraphs) . '</p>'
                            : '<p>' . e($articleContent) . '</p>';
                    }
                    $hasBlockHtml = preg_match('/<(p|div|h[1-6]|ul|ol|li|blockquote|table|figure)\b/i', $articleContent) === 1;
                    if ($articleContent !== '' && $hasBlockHtml === false) {
                        $articleContent = nl2br($articleContent, false);
                    }
                @endphp
                @once
                    <style>
                        .article-rich-content > * + * { margin-top: 1.75rem; }
                        .article-rich-content p { margin: 0 0 1.75rem !important; line-height: 2rem !important; }
                        .article-rich-content p:last-child { margin-bottom: 0 !important; }
                        .article-rich-content br { display: block; content: ""; margin-top: 0.9rem; }
                    </style>
                @endonce
                <div class="article-rich-content max-w-none text-slate-700 [&_ul]:mb-8 [&_ol]:mb-8 [&_ul]:list-disc [&_ol]:list-decimal [&_ul]:pl-6 [&_ol]:pl-6 [&_li]:mb-3 [&_h1]:text-3xl [&_h1]:font-bold [&_h1]:mb-6 [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:mb-5 [&_h3]:text-xl [&_h3]:font-semibold [&_h3]:mb-4 [&_blockquote]:border-l-4 [&_blockquote]:border-slate-300 [&_blockquote]:pl-4 [&_blockquote]:italic [&_blockquote]:my-8 [&_a]:text-sky-700 [&_a]:underline hover:[&_a]:text-sky-900 [&_strong]:font-semibold [&_img]:rounded-xl [&_img]:my-8">
                    {!! $articleContent ?: '<p class="text-slate-600">Belum ada konten berita.</p>' !!}
                </div>

                {{-- Tags --}}
                @if(!empty($news['tags']))
                <div class="mt-10 pt-8 border-t border-slate-100">
                    <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">Hashtag</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($news['tags'] as $tag)
                        <a href="{{ route('berita.index', ['tag' => $tag]) }}" wire:navigate
                           class="px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-bold hover:bg-sky-100 hover:text-sky-700 transition-colors">
                            #{{ $tag }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Share --}}
                <div class="mt-8 p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <p class="text-sm font-bold text-slate-500 mb-4 uppercase tracking-widest">Bagikan Artikel Ini</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1877F2] text-white text-sm font-bold hover:opacity-90 hover:scale-[1.02] active:scale-95 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news['title']) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 text-white text-sm font-bold hover:opacity-90 hover:scale-[1.02] active:scale-95 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            X (Twitter)
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($news['title'] . ' - ' . request()->fullUrl()) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#25D366] text-white text-sm font-bold hover:opacity-90 hover:scale-[1.02] active:scale-95 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp
                        </a>
                        <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}').then(() => alert('Link disalin!'))"
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-bold hover:bg-slate-200 hover:scale-[1.02] active:scale-95 transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Salin Link
                        </button>
                    </div>
                </div>


            </div>

            {{-- ===== SIDEBAR ===== --}}
            <aside class="lg:col-span-4 space-y-8" data-aos="fade-left" data-aos-delay="100">

                {{-- Recent News --}}
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-1 h-5 bg-gradient-to-b from-blue-400 to-blue-900rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Berita Terbaru</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentNews as $recent)
                        <a href="{{ route('berita.show', $recent['slug']) }}" wire:navigate
                           class="group flex gap-3 items-start hover:bg-slate-50 rounded-xl p-2 -mx-2 transition-colors duration-200 {{ $recent['slug'] === $news['slug'] ? 'opacity-50 pointer-events-none' : '' }}">
                            <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden">
                                <img src="{{ $recent['image'] }}" alt="{{ $recent['title'] }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="text-[9px] font-bold uppercase tracking-widest text-sky-500">{{ $recent['category'] }}</span>
                                <p class="text-sm font-bold text-slate-700 leading-snug line-clamp-2 group-hover:text-sky-600 transition-colors mt-0.5">
                                    {{ $recent['title'] }}
                                </p>
                                <span class="text-[11px] text-slate-400 mt-1 block">{{ $recent['date'] }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('berita.index') }}" wire:navigate
                       class="mt-5 flex items-center justify-center gap-2 py-2.5 rounded-xl border border-sky-200 bg-sky-50 text-sky-600 font-bold text-sm hover:bg-sky-100 transition-colors">
                        Lihat Semua Berita →
                    </a>
                </div>

                {{-- Related News --}}
                @if(count($related) > 0)
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-1 h-5 bg-gradient-to-b from-sky-400 to-blue-600 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Berita Terkait</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($related as $rel)
                        <a href="{{ route('berita.show', $rel['slug']) }}" wire:navigate
                           class="group block rounded-xl overflow-hidden border border-slate-100 hover:border-sky-300 hover:shadow-md transition-all duration-300">
                            <div class="relative overflow-hidden aspect-[16/9]">
                                <img src="{{ $rel['image'] }}" alt="{{ $rel['title'] }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                <span class="absolute top-2 left-2 px-2.5 py-1 rounded-full bg-sky-500/90 text-white text-[9px] font-bold uppercase tracking-wide">
                                    {{ $rel['category'] }}
                                </span>
                            </div>
                            <div class="p-4">
                                <p class="font-bold text-sm text-slate-700 leading-snug line-clamp-2 group-hover:text-sky-600 transition-colors">{{ $rel['title'] }}</p>
                                <span class="text-[11px] text-slate-400 mt-1.5 block">{{ $rel['date'] }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Categories Sidebar --}}
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-1 h-5 bg-gradient-to-b from-emerald-400 to-emerald-600 rounded-full"></div>
                        <h3 class="font-bold text-slate-800">Kategori</h3>
                    </div>
                    <div class="space-y-2">
                        @foreach(['Perencanaan', 'Teknologi', 'Infrastruktur', 'SDM', 'Pemerintahan', 'Inovasi'] as $cat)
                        <a href="{{ route('berita.index', ['kategori' => $cat]) }}" wire:navigate
                           class="flex items-center justify-between py-2.5 px-3 rounded-lg hover:bg-sky-50 hover:text-sky-600 transition-colors group {{ $news['category'] === $cat ? 'bg-sky-50 text-sky-600' : 'text-slate-600' }}">
                            <span class="text-sm font-bold">{{ $cat }}</span>
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>

            </aside>
        </div>
    </div>
</x-layouts.app>
