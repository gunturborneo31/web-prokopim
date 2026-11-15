@props(['attachments' => []])

@if (!empty($attachments))
<section class="mt-10 pt-8 border-t border-slate-100" aria-labelledby="lampiran-heading">
    <h3 id="lampiran-heading" class="flex items-center gap-2 text-lg font-bold text-slate-900 mb-5">
        <span class="material-symbols-outlined text-sky-600" aria-hidden="true">attach_file</span>
        Lampiran
    </h3>

    <div class="space-y-6">
        @foreach ($attachments as $file)
            @if ($file['type'] === 'video')
                <figure class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-950">
                    <video controls preload="metadata" playsinline class="w-full max-h-[70vh] bg-black">
                        <source src="{{ $file['url'] }}" type="{{ $file['extension'] === 'mov' ? 'video/quicktime' : 'video/' . ($file['extension'] === 'ogv' ? 'ogg' : $file['extension']) }}">
                        Browser Anda tidak mendukung pemutar video.
                        <a href="{{ $file['url'] }}" class="underline">Unduh video</a>.
                    </video>
                    <figcaption class="flex items-center justify-between gap-3 bg-white px-4 py-3 text-sm">
                        <span class="flex min-w-0 items-center gap-2 font-medium text-slate-700">
                            <span class="material-symbols-outlined text-rose-500" aria-hidden="true">movie</span>
                            <span class="truncate">{{ $file['name'] }}</span>
                        </span>
                        <a href="{{ $file['url'] }}" download class="shrink-0 font-semibold text-sky-700 hover:text-sky-900">Unduh</a>
                    </figcaption>
                </figure>
            @elseif ($file['type'] === 'pdf')
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white" x-data="{ preview: false }">
                    <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3">
                        <span class="flex min-w-0 items-center gap-2 text-sm font-medium text-slate-700">
                            <span class="material-symbols-outlined text-red-600" aria-hidden="true">picture_as_pdf</span>
                            <span class="truncate">{{ $file['name'] }}</span>
                        </span>
                        <div class="flex shrink-0 items-center gap-2 text-sm">
                            <button type="button" @click="preview = !preview" :aria-expanded="preview"
                                    class="hidden sm:inline-flex rounded-lg border border-slate-200 px-3 py-1.5 font-semibold text-slate-700 hover:bg-slate-50"
                                    x-text="preview ? 'Tutup Pratinjau' : 'Pratinjau'">Pratinjau</button>
                            <a href="{{ $file['url'] }}" target="_blank" rel="noopener noreferrer"
                               class="rounded-lg border border-slate-200 px-3 py-1.5 font-semibold text-slate-700 hover:bg-slate-50">Buka</a>
                            <a href="{{ $file['url'] }}" download
                               class="rounded-lg bg-sky-600 px-3 py-1.5 font-semibold text-white hover:bg-sky-700">Unduh</a>
                        </div>
                    </div>
                    <template x-if="preview">
                        <iframe src="{{ $file['url'] }}#view=FitH" title="Pratinjau {{ $file['name'] }}"
                                class="h-[75vh] w-full border-t border-slate-200" loading="lazy"></iframe>
                    </template>
                </div>
            @else
                <a href="{{ $file['url'] }}" download
                   class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    <span class="material-symbols-outlined text-slate-500" aria-hidden="true">description</span>
                    <span class="truncate">{{ $file['name'] }}</span>
                </a>
            @endif
        @endforeach
    </div>
</section>
@endif
