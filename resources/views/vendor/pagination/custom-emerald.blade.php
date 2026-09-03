@if ($paginator->hasPages())
    <div class="pagination-container flex items-center justify-center gap-6 px-4 py-8">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="rounded-[1.25rem] border border-gray-100 bg-white px-8 py-3 text-xs font-black text-gray-300 uppercase tracking-widest cursor-not-allowed shadow-sm">
                SEBELUMNYA
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="rounded-[1.25rem] border border-gray-200 bg-white px-8 py-3 text-xs font-black text-slate-600 uppercase tracking-widest hover:border-emerald-500 hover:text-emerald-600 hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-300" rel="prev">
                SEBELUMNYA
            </a>
        @endif

        {{-- Pagination Information --}}
        <div class="text-xs font-black text-slate-500 uppercase tracking-widest">
            HALAMAN <span class="text-emerald-600">{{ $paginator->currentPage() }}</span> DARI <span class="text-slate-800">{{ $paginator->lastPage() }}</span>
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="rounded-[1.25rem] border border-gray-200 bg-white px-8 py-3 text-xs font-black text-slate-600 uppercase tracking-widest hover:border-emerald-500 hover:text-emerald-600 hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-300" rel="next">
                SELANJUTNYA
            </a>
        @else
            <span class="rounded-[1.25rem] border border-gray-100 bg-white px-8 py-3 text-xs font-black text-gray-300 uppercase tracking-widest cursor-not-allowed shadow-sm">
                SELANJUTNYA
            </span>
        @endif
    </div>
@endif
