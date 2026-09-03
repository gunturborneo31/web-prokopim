<div>
    @php
        $pinnedSliders = $this->getPinnedSliders();
    @endphp

    @if($pinnedSliders->count() > 0)
    <div class="widget-card pinned-slider-banner animate-in" style="padding: 0; overflow: hidden; position: relative;">
        <div class="banner-overlay">
            <div class="overlay-text">
                <div class="pin-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 1rem; height: 1rem; transform: rotate(45deg);">
                        <path d="M19.5 13.5L16.5 10.5V4.5L15 3H9L7.5 4.5V10.5L4.5 13.5V15H11.25V21H12.75V15H19.5V13.5Z" />
                    </svg>
                    TERSEMAT
                </div>
                <h2>{{ $pinnedSliders->first()->caption }}</h2>
                <p>{{ \Illuminate\Support\Str::limit($pinnedSliders->first()->description ?? '', 120) }}</p>
                @if($pinnedSliders->first()->link)
                <a href="{{ $pinnedSliders->first()->link }}" target="_blank" class="btn-visit">Kunjungi Tautan</a>
                @endif
            </div>
        </div>
        
        @if($pinnedSliders->first()->file)
        <img src="{{ asset('storage/' . $pinnedSliders->first()->file->path) }}" 
             class="banner-img" 
             alt="{{ $pinnedSliders->first()->caption }}">
        @else
        <div class="banner-placeholder">Tidak ada gambar</div>
        @endif

        <style>
            .pinned-slider-banner {
                height: 280px;
                margin-bottom: 1.25rem;
                border: none;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            }
            .banner-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .banner-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);
                z-index: 10;
                display: flex;
                align-items: center;
                padding: 2.5rem;
            }
            .overlay-text {
                max-width: 60%;
                color: white;
            }
            .overlay-text h2 {
                font-size: 1.8rem;
                font-weight: 850;
                margin-bottom: 0.5rem;
                line-height: 1.2;
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }
            .overlay-text p {
                font-size: 0.9rem;
                opacity: 0.9;
                margin-bottom: 1.5rem;
                line-height: 1.5;
            }
            .pin-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                background: #2563eb;
                color: white;
                padding: 0.3rem 0.7rem;
                border-radius: 9999px;
                font-size: 0.65rem;
                font-weight: 800;
                margin-bottom: 1rem;
                letter-spacing: 1px;
            }
            .btn-visit {
                display: inline-block;
                background: white;
                color: #1e293b;
                padding: 0.6rem 1.2rem;
                border-radius: 0.75rem;
                font-size: 0.75rem;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            .btn-visit:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(255,255,255,0.3);
            }
            .banner-placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #e2e8f0;
                color: #64748b;
            }
        </style>
    </div>
    @endif
</div>
