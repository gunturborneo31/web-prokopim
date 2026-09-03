@php
    $perPage = 5;
    $currentPage = request()->get('page', 1);
    $totalItems = count($informasi);
    $totalPages = max(1, ceil($totalItems / $perPage));
    $currentPage = max(1, min($currentPage, $totalPages));
    $offset = ($currentPage - 1) * $perPage;
    $paginatedItems = array_slice($informasi, $offset, $perPage);

    $statsMap = $statsMap ?? [];
@endphp

{{-- Shared PPID Information List Cards --}}
<div class="space-y-4">
    @foreach($paginatedItems as $i => $item)
    @php
        $docKey    = $item['key'] ?? '';
        $views     = $statsMap[$docKey]['views']     ?? $item['views']     ?? 0;
        $downloads = $statsMap[$docKey]['downloads'] ?? $item['downloads'] ?? 0;
        $hasFile   = !empty($item['file']);
        $fileUrl   = $hasFile ? $item['file'] : '';
        $viewUrl   = $hasFile ? route('stats.view',     ['key' => $docKey, 'type' => 'ppid', 'category' => $ppidCategory ?? '', 'url' => $fileUrl]) : '';
        $downloadUrl = $hasFile ? route('stats.download', ['key' => $docKey, 'type' => 'ppid', 'category' => $ppidCategory ?? '', 'url' => $fileUrl]) : '';
    @endphp
    <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg hover:border-sky-200 transition-all duration-300 overflow-hidden"
         data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
        <div class="flex items-stretch">
            <div class="w-1.5 bg-gradient-to-b from-sky-400 to-sky-600 group-hover:from-[#274CA5] group-hover:to-yellow-500 transition-all duration-300 flex-shrink-0"></div>
            <div class="flex-1 p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2 flex-wrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-sky-50 text-sky-700 text-[11px] font-bold uppercase tracking-wider">{{ $item['no'] }}</span>
                            @if(isset($item['kategori']))
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-600">
                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                {{ $item['kategori'] }}
                            </span>
                            @endif
                            @if(isset($item['type']))
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600">
                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                {{ $item['type'] }}
                            </span>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-sky-700 transition-colors duration-200 leading-tight">{{ $item['title'] }}</h3>
                        <div class="flex items-center gap-4 mt-2 text-sm text-slate-400 flex-wrap">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                Tahun {{ $item['year'] }}
                            </span>
                            {{-- Views counter --}}
                            @if($docKey)
                            <span class="flex items-center gap-1 text-slate-400" id="views-{{ $docKey }}" title="Jumlah dilihat">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <span class="views-count font-medium text-slate-500">{{ number_format($views) }}</span> dilihat
                            </span>
                            {{-- Downloads counter --}}
                            <span class="flex items-center gap-1 text-slate-400" id="downloads-{{ $docKey }}" title="Jumlah diunduh">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                <span class="downloads-count font-medium text-slate-500">{{ number_format($downloads) }}</span> diunduh
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:flex-shrink-0">
                        @if($hasFile)
                                <a href="{{ $viewUrl }}"
                           onclick="incrementStatDisplay('{{ $docKey }}', 'views')"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-sky-50 text-sky-600 text-sm font-semibold rounded-xl hover:bg-sky-100 active:scale-95 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Lihat
                        </a>
                        <a href="{{ $downloadUrl }}"
                           onclick="incrementStatDisplay('{{ $docKey }}', 'downloads')"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 text-sm font-semibold rounded-xl hover:bg-emerald-100 active:scale-95 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            Unduh
                        </a>
                        @else
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-400 text-sm font-semibold rounded-xl cursor-not-allowed" title="File belum tersedia">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Lihat
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-400 text-sm font-semibold rounded-xl cursor-not-allowed" title="File belum tersedia">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            Unduh
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Pagination --}}
@if($totalPages > 1)
<div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4" data-aos="fade-up">
    <p class="text-sm text-slate-500">
        Menampilkan <span class="font-semibold text-slate-700">{{ $offset + 1 }}-{{ min($offset + $perPage, $totalItems) }}</span> dari <span class="font-semibold text-slate-700">{{ $totalItems }}</span> informasi
    </p>
    <nav class="flex items-center gap-1">
        @if($currentPage > 1)
        <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-sky-50 hover:text-sky-600 hover:border-sky-200 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </a>
        @else
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-300 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </span>
        @endif
        @for($page = 1; $page <= $totalPages; $page++)
            @if($page == $currentPage)
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-sky-600 text-white font-bold text-sm shadow-lg shadow-sky-200">{{ $page }}</span>
            @else
            <a href="{{ request()->fullUrlWithQuery(['page' => $page]) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-600 font-medium text-sm hover:bg-sky-50 hover:text-sky-600 hover:border-sky-200 transition-all duration-200">{{ $page }}</a>
            @endif
        @endfor
        @if($currentPage < $totalPages)
        <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-sky-50 hover:text-sky-600 hover:border-sky-200 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </a>
        @else
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white text-slate-300 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </span>
        @endif
    </nav>
</div>
@else
@if($totalItems > 0)
<div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4" data-aos="fade-up">
    <p class="text-sm text-slate-500">
        Menampilkan <span class="font-semibold text-slate-700">1-{{ $totalItems }}</span> dari <span class="font-semibold text-slate-700">{{ $totalItems }}</span> informasi
    </p>
</div>
@endif
@endif

{{-- JS helper to optimistically increment displayed counters --}}
<script>
function incrementStatDisplay(key, type) {
    if (!key) return;
    const el = document.getElementById((type === 'views' ? 'views-' : 'downloads-') + key);
    if (!el) return;
    const countEl = el.querySelector('.' + type + '-count');
    if (countEl) {
        const current = parseInt(countEl.textContent.replace(/\D/g, '')) || 0;
        countEl.textContent = (current + 1).toLocaleString('id-ID');
    }
}
</script>
