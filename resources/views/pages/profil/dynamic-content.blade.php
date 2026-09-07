<x-layouts.app>
    @php
        $content = $profilePage->content ?? [];
        $subtitle = $content['subtitle'] ?? $profilePage->meta_desc ?? 'Informasi profil PROKOPIM Kabupaten Mahakam Ulu.';
        $mainTitle = $profilePage->title;
        $sectionTitle = $content['judul'] ?? $profilePage->title;
        $rawMainContent = $content['isi_konten'] ?? ($content['content'] ?? null);

        $extractContentText = function ($value) use (&$extractContentText): string {
            if (is_string($value)) {
                return $value;
            }

            if (is_scalar($value)) {
                return (string) $value;
            }

            if (! is_array($value)) {
                return '';
            }

            foreach (['isi_konten', 'editor', 'content', 'body', 'text'] as $candidateKey) {
                if (array_key_exists($candidateKey, $value)) {
                    $candidate = $extractContentText($value[$candidateKey]);

                    if (trim($candidate) !== '') {
                        return $candidate;
                    }
                }
            }

            return collect($value)
                ->map(fn ($item) => $extractContentText($item))
                ->filter(fn ($item) => trim($item) !== '')
                ->implode("\n\n");
        };

        $mainContent = $extractContentText($rawMainContent);

        $resolveMediaUrl = function (?string $path): ?string {
            $path = trim((string) $path);

            if ($path === '') {
                return null;
            }

            if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }

            if (\Illuminate\Support\Str::startsWith($path, ['/storage/', 'storage/'])) {
                return asset(ltrim($path, '/'));
            }

            return asset('storage/' . ltrim($path, '/'));
        };

        $imageSource = $resolveMediaUrl($content['image_upload'] ?? null)
            ?: $resolveMediaUrl($content['image'] ?? null)
            ?: trim((string) ($content['image_url'] ?? ''));
        $videoSource = $resolveMediaUrl($content['video_upload'] ?? null) ?: trim((string) ($content['video_url'] ?? ''));
        $imageCaption = trim((string) ($content['image_caption'] ?? ($content['caption'] ?? '')));
        $videoCaption = trim((string) ($content['video_caption'] ?? ''));

        $buildEmbedVideoUrl = function (?string $videoUrl): ?string {
            $videoUrl = trim((string) $videoUrl);

            if ($videoUrl === '') {
                return null;
            }

            if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/)([^&?/]+)~', $videoUrl, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }

            if (preg_match('~vimeo\.com/(\d+)~', $videoUrl, $matches)) {
                return 'https://player.vimeo.com/video/' . $matches[1];
            }

            return null;
        };

        $mediaItems = collect($content['media_items'] ?? [])
            ->map(function ($item) use ($resolveMediaUrl, $buildEmbedVideoUrl) {
                $type = trim((string) ($item['type'] ?? 'image'));
                $upload = $type === 'video'
                    ? $resolveMediaUrl($item['video_upload'] ?? null)
                    : $resolveMediaUrl($item['upload'] ?? null);
                $url = trim((string) ($item['url'] ?? ''));
                $source = $upload ?: $url;

                if ($source === '') {
                    return null;
                }

                return [
                    'type' => $type === 'video' ? 'video' : 'image',
                    'source' => $source,
                    'caption' => trim((string) ($item['caption'] ?? '')),
                    'embed_url' => $type === 'video' ? $buildEmbedVideoUrl($source) : null,
                ];
            })
            ->filter()
            ->values();

        if ($mediaItems->isEmpty()) {
            if ($imageSource !== '') {
                $mediaItems->push([
                    'type' => 'image',
                    'source' => $imageSource,
                    'caption' => $imageCaption,
                    'embed_url' => null,
                ]);
            }

            if ($videoSource !== '') {
                $mediaItems->push([
                    'type' => 'video',
                    'source' => $videoSource,
                    'caption' => $videoCaption,
                    'embed_url' => $buildEmbedVideoUrl($videoSource),
                ]);
            }
        }

        // Template "galeri" stores its photos in content.images (a repeater of
        // {image, caption}), separate from content.media_items used by other
        // templates — map it into its own collection for the grid below.
        $galleryItems = collect($content['images'] ?? [])
            ->map(function ($item) use ($resolveMediaUrl) {
                $source = $resolveMediaUrl($item['image'] ?? null);

                if (blank($source)) {
                    return null;
                }

                return [
                    'source' => $source,
                    'caption' => trim((string) ($item['caption'] ?? '')),
                ];
            })
            ->filter()
            ->values();

    @endphp

    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/desamahakamulu.jpg') }}" alt="{{ $mainTitle }}" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="" class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
    
        </div>

        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-left" data-aos="fade-up">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/5 border border-[#2E52A8] text-[#2E52A8] text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl my-2">
                    <div class="relative flex h-2 w-2 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#2E52A8]"></span>
                    </div>
                    Profil Instansi
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">{{ $mainTitle }}</h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">{{ $subtitle }}</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16 space-y-8">
        @if($profilePage->template === 'penjelasan_2')
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <section class="bg-white rounded-3xl border border-[#515976] shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-[#274CA5] mb-5">{{ $content['box_1_title'] ?? 'Panel 1' }}</h2>
                    <div class="prose prose-slate max-w-none">{!! $content['box_1_content'] ?? '' !!}</div>
                </section>
                <section class="bg-white rounded-3xl border border-[#515976] shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-[#274CA5] mb-5">{{ $content['box_2_title'] ?? 'Panel 2' }}</h2>
                    <div class="prose prose-slate max-w-none">{!! $content['box_2_content'] ?? '' !!}</div>
                </section>
            </div>
        @else
            <section class="bg-white rounded-3xl border border-[#515976] shadow-xl p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1.5 h-8 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full"></div>
                    <h2 class="text-2xl font-bold text-[#274CA5]">{{ $sectionTitle }}</h2>
                </div>

                @if(in_array($profilePage->template, ['blank_editor', 'gambar_1'], true) && $mediaItems->isNotEmpty())
                    <div class="mb-8 space-y-6">
                        @foreach($mediaItems as $mediaItem)
                            <figure class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                                @if($mediaItem['type'] === 'image')
                                    <img src="{{ $mediaItem['source'] }}" alt="{{ $mediaItem['caption'] ?: $mainTitle }}" class="w-full h-auto object-cover">
                                @elseif($mediaItem['embed_url'])
                                    <div class="aspect-video">
                                        <iframe
                                            src="{{ $mediaItem['embed_url'] }}"
                                            title="{{ $mediaItem['caption'] ?: $mainTitle }}"
                                            class="h-full w-full"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <video controls class="w-full h-auto bg-black">
                                        <source src="{{ $mediaItem['source'] }}">
                                        Browser Anda tidak mendukung pemutaran video.
                                    </video>
                                @endif

                                @if($mediaItem['caption'] !== '')
                                    <figcaption class="px-4 py-3 text-sm text-slate-500 bg-white border-t border-slate-200">{{ $mediaItem['caption'] }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>
                @endif

                @if($profilePage->template === 'galeri' && $galleryItems->isNotEmpty())
                    <div class="mb-8"
                         x-data="{ lightboxOpen: false, activeIndex: 0, total: {{ $galleryItems->count() }},
                                    prev() { this.activeIndex = (this.activeIndex - 1 + this.total) % this.total; },
                                    next() { this.activeIndex = (this.activeIndex + 1) % this.total; } }"
                         @keydown.escape.window="lightboxOpen = false"
                         @keydown.arrow-left.window="if (lightboxOpen) prev()"
                         @keydown.arrow-right.window="if (lightboxOpen) next()">

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach($galleryItems as $index => $galleryItem)
                                <button type="button"
                                        @click="activeIndex = {{ $index }}; lightboxOpen = true"
                                        class="block w-full text-left group cursor-zoom-in">
                                    <figure class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                                        <img src="{{ $galleryItem['source'] }}" alt="{{ $galleryItem['caption'] ?: $mainTitle }}" class="w-full h-40 sm:h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                        @if($galleryItem['caption'] !== '')
                                            <figcaption class="px-3 py-2 text-xs text-slate-500 bg-white border-t border-slate-200">{{ $galleryItem['caption'] }}</figcaption>
                                        @endif
                                    </figure>
                                </button>
                            @endforeach
                        </div>

                        <!-- Lightbox Popup -->
                        <div x-show="lightboxOpen" x-cloak
                             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="fixed inset-0 z-[100] flex items-center justify-center bg-[#0f172a]/90 backdrop-blur-sm p-4 sm:p-8"
                             @click.self="lightboxOpen = false"
                             role="dialog" aria-modal="true">

                            <button type="button" @click="lightboxOpen = false"
                                    class="absolute top-4 right-4 sm:top-6 sm:right-6 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>

                            <button type="button" @click.stop="prev()" x-show="total > 1"
                                    class="absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            </button>

                            @foreach($galleryItems as $index => $galleryItem)
                                <div x-show="activeIndex === {{ $index }}" class="max-w-5xl w-full max-h-[85vh] flex flex-col items-center" @click.self="lightboxOpen = false">
                                    <img src="{{ $galleryItem['source'] }}" alt="{{ $galleryItem['caption'] ?: $mainTitle }}" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl pointer-events-none">
                                    @if($galleryItem['caption'] !== '')
                                        <p class="mt-4 text-white/90 text-sm text-center max-w-2xl">{{ $galleryItem['caption'] }}</p>
                                    @endif
                                </div>
                            @endforeach

                            <button type="button" @click.stop="next()" x-show="total > 1"
                                    class="absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors z-10">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </button>

                            <span x-show="total > 1" class="absolute bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2 text-white/70 text-xs font-bold tabular-nums z-10">
                                <span x-text="activeIndex + 1"></span>/<span x-text="total"></span>
                            </span>
                        </div>
                    </div>
                @endif

                <div class="prose prose-slate max-w-none">
                    @if($profilePage->template === 'blank_editor')
                        {!! filled($mainContent) ? str($mainContent)->markdown()->sanitizeHtml() : '<p>Konten belum tersedia.</p>' !!}
                    @elseif($profilePage->template === 'gambar_1' && blank($mainContent) && $mediaItems->isNotEmpty())
                        {{-- Template gambar_1 tidak memiliki field teks; gambar di atas sudah menjadi konten utama. --}}
                    @elseif($profilePage->template === 'galeri' && blank($mainContent) && $galleryItems->isNotEmpty())
                        {{-- Template galeri tidak memiliki field teks; foto-foto di atas sudah menjadi konten utama. --}}
                    @else
                        {!! $mainContent ?: '<p>Konten belum tersedia.</p>' !!}
                    @endif
                </div>
            </section>
        @endif
    </div>
</x-layouts.app>