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

        $imageSource = $resolveMediaUrl($content['image_upload'] ?? null) ?: trim((string) ($content['image_url'] ?? ''));
        $videoSource = $resolveMediaUrl($content['video_upload'] ?? null) ?: trim((string) ($content['video_url'] ?? ''));
        $imageCaption = trim((string) ($content['image_caption'] ?? ''));
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

                @if($profilePage->template === 'blank_editor' && $mediaItems->isNotEmpty())
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

                <div class="prose prose-slate max-w-none">
                    @if($profilePage->template === 'blank_editor')
                        {!! filled($mainContent) ? str($mainContent)->markdown()->sanitizeHtml() : '<p>Konten belum tersedia.</p>' !!}
                    @else
                        {!! $mainContent ?: '<p>Konten belum tersedia.</p>' !!}
                    @endif
                </div>
            </section>
        @endif
    </div>
</x-layouts.app>