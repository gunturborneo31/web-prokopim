<div class="widget-card h-full" style="padding: 1.5rem;" wire:poll.10s>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 class="text-main" style="font-size: 1.125rem; font-weight: 850;">{{ __('Dokumen Terbaru') }}</h3>
        <a href="{{ url('/site-admin/file-sharings') }}" class="text-dim" style="text-decoration: none; font-size: 0.75rem; font-weight: 600;">{{ __('Lihat Semua') }}</a>
    </div>
    
    <div style="display: flex; flex-direction: column; gap: 1rem;">
        @forelse($this->getData() as $doc)
            <a href="{{ url('/site-admin/file-sharings') }}" class="document-item inner-card" style="display: flex; align-items: center; gap: 1rem; padding: 0.75rem; transition: all 0.2s; text-decoration: none;">
                <div class="doc-icon-box">
                    <x-heroicon-o-document-text style="width: 1.25rem; height: 1.25rem;"/>
                </div>
                <div style="flex-grow: 1; min-width: 0;">
                    <div class="text-main" style="font-size: 0.875rem; font-weight: 750; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $doc['name'] }}</div>
                    <div class="text-dim" style="font-size: 0.65rem; font-weight: 600;">{{ $doc['type'] }} · {{ $doc['size'] }}</div>
                </div>
            </a>
        @empty
            <div class="text-dim" style="text-align: center; font-size: 0.875rem; padding: 2rem;">{{ __('Dokumen tidak ditemukan.') }}</div>
        @endforelse
    </div>

    <style>
        .document-item:hover {
            transform: translateX(4px);
            background: rgba(148, 163, 184, 0.05);
            border-color: rgba(148, 163, 184, 0.1);
        }
        .doc-icon-box {
            width: 40px; height: 40px; border-radius: 0.75rem; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .dark .doc-icon-box { background: rgba(37, 99, 235, 0.1); color: #60a5fa; }
    </style>
</div>

