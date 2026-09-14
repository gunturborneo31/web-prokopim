<x-filament-panels::page>
    @php
        $sliderStats = $this->getSliderStats();
        $pengumumanStats = $this->getPengumumanGambarStats();
        $visualIgStats = $this->getVisualIgStats();
    @endphp

    <style>
        .homepage-admin-shell {
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .homepage-admin-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            width: 100%;
        }

        @media (min-width: 768px) {
            .homepage-admin-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .homepage-admin-card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            min-height: 180px;
            padding: 1.25rem;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
        }

        .dark .homepage-admin-card {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(148, 163, 184, 0.3);
        }

        .homepage-admin-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .homepage-admin-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            color: #64748b;
            margin: 0;
        }

        .dark .homepage-admin-label {
            color: #94a3b8;
        }

        .homepage-admin-number {
            margin: 0.3rem 0 0;
            font-size: clamp(1.8rem, 2.5vw, 2.4rem);
            line-height: 1.1;
            font-weight: 800;
            color: #0f172a;
        }

        .dark .homepage-admin-number {
            color: #f8fafc;
        }

        .homepage-admin-meta {
            margin: 0.25rem 0 0;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .homepage-admin-icon {
            display: flex;
            height: 2.75rem;
            width: 2.75rem;
            align-items: center;
            justify-content: center;
            border-radius: 0.8rem;
            flex-shrink: 0;
        }

        .homepage-admin-icon svg {
            width: 1.4rem;
            height: 1.4rem;
        }

        .homepage-admin-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: auto;
        }

        .homepage-admin-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.55rem 0.9rem;
            border-radius: 0.75rem;
            font-size: 0.78rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .homepage-admin-button.primary {
            background: #2563eb;
            color: #fff;
        }

        .homepage-admin-button.primary:hover {
            background: #1d4ed8;
            color: #fff;
        }

        .homepage-admin-button.secondary {
            background: #f1f5f9;
            color: #0f172a;
        }

        .dark .homepage-admin-button.secondary {
            background: rgba(148, 163, 184, 0.12);
            color: #e2e8f0;
        }

        .homepage-admin-list-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            width: 100%;
        }

        @media (min-width: 1280px) {
            .homepage-admin-list-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .homepage-admin-list-card {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 1.1rem;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
        }

        .dark .homepage-admin-list-card {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(148, 163, 184, 0.3);
        }

        .homepage-admin-list-card h4 {
            margin: 0 0 0.35rem;
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
        }

        .dark .homepage-admin-list-card h4 {
            color: #f8fafc;
        }

        .homepage-admin-list-card p {
            margin: 0;
            color: #64748b;
            font-size: 0.75rem;
            line-height: 1.5;
        }

        .dark .homepage-admin-list-card p {
            color: #cbd5e1;
        }

        .homepage-admin-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .homepage-admin-list li {
            border: 1px solid #e2e8f0;
            border-radius: 0.8rem;
            background: #f8fafc;
            padding: 0.7rem 0.8rem;
        }

        .dark .homepage-admin-list li {
            background: rgba(15, 23, 42, 0.75);
            border-color: rgba(148, 163, 184, 0.2);
        }

        .homepage-admin-list-title {
            margin: 0;
            font-size: 0.82rem;
            font-weight: 700;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dark .homepage-admin-list-title {
            color: #f8fafc;
        }

        .homepage-admin-list-sub {
            margin: 0.2rem 0 0;
            font-size: 0.7rem;
            color: #64748b;
        }

        .dark .homepage-admin-list-sub {
            color: #cbd5e1;
        }
    </style>

    <div class="homepage-admin-shell">
        <div class="homepage-admin-grid">
            <div class="homepage-admin-card">
                <div class="homepage-admin-card-header">
                    <div>
                        <p class="homepage-admin-label">Slider</p>
                        <h3 class="homepage-admin-number">{{ $sliderStats['count'] }}</h3>
                        <p class="homepage-admin-meta" style="color: #16a34a;">{{ $sliderStats['active_count'] }} aktif</p>
                    </div>
                    <div class="homepage-admin-icon" style="background: #dbeafe; color: #2563eb;">
                        <x-heroicon-o-photo />
                    </div>
                </div>
                <div class="homepage-admin-actions">
                    <a href="{{ $sliderStats['url'] }}" class="homepage-admin-button primary">Lihat daftar</a>
                    <a href="{{ $sliderStats['create_url'] }}" class="homepage-admin-button secondary">Tambah</a>
                </div>
            </div>

            <div class="homepage-admin-card">
                <div class="homepage-admin-card-header">
                    <div>
                        <p class="homepage-admin-label">Pengumuman Gambar</p>
                        <h3 class="homepage-admin-number">{{ $pengumumanStats['count'] }}</h3>
                        <p class="homepage-admin-meta" style="color: #d97706;">{{ $pengumumanStats['active_count'] }} aktif</p>
                    </div>
                    <div class="homepage-admin-icon" style="background: #fef3c7; color: #d97706;">
                        <x-heroicon-o-megaphone />
                    </div>
                </div>
                <div class="homepage-admin-actions">
                    <a href="{{ $pengumumanStats['url'] }}" class="homepage-admin-button primary">Lihat daftar</a>
                    <a href="{{ $pengumumanStats['create_url'] }}" class="homepage-admin-button secondary">Tambah</a>
                </div>
            </div>

            <div class="homepage-admin-card">
                <div class="homepage-admin-card-header">
                    <div>
                        <p class="homepage-admin-label">Visual IG</p>
                        <h3 class="homepage-admin-number">{{ $visualIgStats['count'] }}</h3>
                        <p class="homepage-admin-meta" style="color: #16a34a;">{{ $visualIgStats['active_count'] }} aktif</p>
                    </div>
                    <div class="homepage-admin-icon" style="background: #dcfce7; color: #16a34a;">
                        <x-heroicon-o-camera />
                    </div>
                </div>
                <div class="homepage-admin-actions">
                    <a href="{{ $visualIgStats['url'] }}" class="homepage-admin-button primary">Lihat daftar</a>
                    <a href="{{ $visualIgStats['create_url'] }}" class="homepage-admin-button secondary">Tambah</a>
                </div>
            </div>
        </div>

        <div class="homepage-admin-list-grid">
            <div class="homepage-admin-list-card">
                <h4>Slider terbaru</h4>
                <p>Banner utama di halaman depan.</p>
                @if($sliderStats['items']->isNotEmpty())
                    <ul class="homepage-admin-list" style="margin-top: 0.9rem;">
                        @foreach($sliderStats['items'] as $item)
                            <li>
                                <p class="homepage-admin-list-title">{{ $item->caption ?: 'Slider' }}</p>
                                <p class="homepage-admin-list-sub">{{ $item->status ? 'Aktif' : 'Nonaktif' }} • {{ $item->is_pinned ? 'Pinned' : 'Normal' }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p style="margin-top: 0.9rem;">Belum ada slider yang dibuat.</p>
                @endif
            </div>

            <div class="homepage-admin-list-card">
                <h4>Pengumuman gambar terbaru</h4>
                <p>Slide gambar pengumuman yang tampil di beranda.</p>
                @if($pengumumanStats['items']->isNotEmpty())
                    <ul class="homepage-admin-list" style="margin-top: 0.9rem;">
                        @foreach($pengumumanStats['items'] as $item)
                            <li>
                                <p class="homepage-admin-list-title">{{ $item->title ?: 'Pengumuman' }}</p>
                                <p class="homepage-admin-list-sub">{{ $item->status ? 'Aktif' : 'Nonaktif' }} • #{{ $item->order ?? 0 }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p style="margin-top: 0.9rem;">Belum ada pengumuman gambar untuk ditampilkan.</p>
                @endif
            </div>

            <div class="homepage-admin-list-card">
                <h4>Visual IG terbaru</h4>
                <p>Galeri singkat yang tampil di homepage.</p>
                @if($visualIgStats['items']->isNotEmpty())
                    <ul class="homepage-admin-list" style="margin-top: 0.9rem;">
                        @foreach($visualIgStats['items'] as $item)
                            <li>
                                <p class="homepage-admin-list-title">{{ $item->title }}</p>
                                <p class="homepage-admin-list-sub">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }} • #{{ $item->order ?? 0 }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p style="margin-top: 0.9rem;">Belum ada item Visual IG.</p>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
