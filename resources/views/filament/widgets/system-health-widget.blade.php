<div class="widget-card">
    <div style="margin-bottom: 1.25rem;">
        <h3 class="text-main" style="font-size: 0.95rem; font-weight: 850;">{{ __('⚡ Monitoring Integrasi') }}</h3>
    </div>

    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        <!-- Storage Progress -->
        <div>
            <div style="display: flex; justify-content: space-between; font-size: 0.7rem; font-weight: 800; margin-bottom: 0.5rem;" class="text-sub">
                <span>{{ __('Penyimpanan Berkas') }}</span>
                <span class="text-main">{{ $this->getData()['storage']['used'] }}%</span>
            </div>
            <div style="width: 100%; height: 8px; border-radius: 4px; overflow: hidden;" class="progress-bg">
                <div style="width: {{ $this->getData()['storage']['used'] }}%; height: 100%; background: linear-gradient(90deg, #3b82f6, #2563eb); border-radius: 4px;"></div>
            </div>
            <p class="text-dim" style="font-size: 0.65rem; margin-top: 0.4rem; font-weight: 600;">
                {{ __('Digunakan untuk') }} {{ $this->getData()['storage']['files'] }} {{ __('dokumen publik.') }}
            </p>
        </div>

        <hr style="border: 0; border-top: 1px solid rgba(148, 163, 184, 0.1); margin: 0;">

        <!-- Performance & Integration Stats -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
            <div class="inner-card">
                <div style="font-size: 0.6rem; font-weight: 850; text-transform: uppercase;" class="text-dim">{{ __('Link Terintegrasi') }}</div>
                <div style="display: flex; align-items: baseline; gap: 0.25rem;">
                    <div style="font-size: 1.1rem; font-weight: 900; color: #2563eb;">{{ $this->getData()['performance']['servers']['active'] }}</div>
                    <div style="font-size: 0.65rem; font-weight: 700;" class="text-dim">/ {{ $this->getData()['performance']['servers']['total'] }}</div>
                </div>
            </div>
            <div class="inner-card">
                <div style="font-size: 0.6rem; font-weight: 850; text-transform: uppercase;" class="text-dim">{{ __('Sinkronisasi') }}</div>
                <div style="font-size: 0.8rem; font-weight: 900; color: #2563eb; margin-top: 0.2rem;">{{ $this->getData()['last_sync'] }}</div>
            </div>
        </div>

        <!-- System Tag -->
        <div class="system-tag">
            <div style="width: 6px; height: 6px; background: #2563eb; border-radius: 50%;"></div>
            <span style="font-size: 0.65rem; font-weight: 800;">
                @if($this->getData()['performance']['servers']['inactive'] > 0)
                    {{ $this->getData()['performance']['servers']['inactive'] }} {{ __('Layanan Tidak Aktif') }}
                @else
                    {{ __('Semua Sistem Terhubung') }}
                @endif
            </span>
        </div>
    </div>

    <style>
        .progress-bg { background: #f1f5f9; }
        .dark .progress-bg { background: #1e293b; }

        .system-tag {
            background: #eff6ff;
            color: #1e3a8a;
            border-radius: 0.75rem;
            padding: 0.6rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dark .system-tag {
            background: rgba(37, 99, 235, 0.1);
            color: #60a5fa;
        }
    </style>
</div>

