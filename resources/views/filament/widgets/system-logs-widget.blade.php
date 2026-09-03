<div class="widget-card h-full" style="padding: 1.5rem;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
        <div>
            <h3 class="text-main" style="font-size: 1.125rem; font-weight: 850;">{{ __('Pembaruan Berita') }}</h3>
            <p class="text-dim" style="font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.25rem;">{{ __('Pembaruan Waktu-Nyata') }}</p>
        </div>
        
        <div style="display: flex; gap: 0.5rem; align-items: center;">
            <select wire:model.live="filter" class="filter-select">
                <option value="terbaru">{{ __('Terbaru') }}</option>
                <option value="lama">{{ __('Berita Lama') }}</option>
            </select>
            <a href="{{ url('/site-admin/posts') }}" class="view-all-btn">{{ __('Lihat Semua') }}</a>
        </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 1rem;" wire:poll.10s>
        @foreach($this->getData() as $log)
            <a href="{{ $log['url'] }}" class="log-item inner-card" style="text-decoration: none; display: flex; gap: 1rem; align-items: flex-start; padding: 1rem; transition: all 0.2s;">
                <div style="margin-top: 0.25rem;">
                    <div class="log-bullet"></div>
                </div>
                <div style="flex: 1;">
                    <h4 class="text-main" style="font-size: 0.85rem; font-weight: 800; margin-bottom: 0.25rem; line-height: 1.4;">{{ $log['title'] }}</h4>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div class="text-dim" style="font-size: 0.65rem; font-weight: 700; text-transform: uppercase;">{{ $log['date'] }}</div>
                        <div class="view-tag">
                            <x-heroicon-m-eye style="width: 0.75rem; height: 0.75rem;"/>
                            {{ $log['views'] }} {{ __('Tayangan') }}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <style>
        .filter-select {
            font-size: 0.65rem; font-weight: 700; color: #64748b; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.2rem 0.5rem; outline: none; cursor: pointer;
        }
        .dark .filter-select { background: #1e293b; border-color: #334155; color: #94a3b8; }

        .view-all-btn {
            font-size: 0.65rem; color: #2563eb; font-weight: 700; text-decoration: none; padding: 0.3rem 0.6rem; background: #eff6ff; border-radius: 0.5rem; white-space: nowrap; transition: all 0.2s;
        }
        .view-all-btn:hover { background: #2563eb; color: white; }
        .dark .view-all-btn { background: rgba(37, 99, 235, 0.1); color: #60a5fa; }
        .dark .view-all-btn:hover { background: #3b82f6; color: white; }

        .log-item:hover {
            transform: translateX(5px);
            border-color: #3b82f6 !important;
            background: white !important;
        }
        .dark .log-item:hover { background: #1e293b !important; }

        .log-bullet { width: 8px; height: 8px; background: #2563eb; border-radius: 50%; box-shadow: 0 0 10px rgba(37, 99, 235, 0.4); }
        .dark .log-bullet { background: #3b82f6; box-shadow: 0 0 10px rgba(59, 130, 246, 0.4); }

        .view-tag { display: flex; align-items: center; gap: 0.25rem; font-size: 0.65rem; color: #2563eb; font-weight: 800; background: #eff6ff; padding: 0.1rem 0.4rem; border-radius: 0.4rem; }
        .dark .view-tag { background: rgba(37, 99, 235, 0.1); color: #60a5fa; }
    </style>
</div>

