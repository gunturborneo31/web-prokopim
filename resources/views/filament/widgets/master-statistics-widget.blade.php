<div class="widget-card">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.25rem;">
        <div>
            <h3 class="text-main" style="font-size: 1.1rem; font-weight: 850; letter-spacing: -0.02em;">Statistik Ekosistem Portal</h3>
            <p class="text-dim" style="font-size: 0.7rem; font-weight: 600; margin-top: 0.15rem;">Pemantauan seluruh sumber daya secara waktu-nyata</p>
        </div>
        <div style="background: rgba(37, 99, 235, 0.1); color: #2563eb; padding: 0.3rem 0.6rem; border-radius: 0.6rem; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
            {{ count($this->getStats()) }} Menu
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem;">
        @foreach($this->getStats() as $stat)
            <div class="inner-card" style="position: relative; overflow: hidden; display: flex; flex-direction: column;">
                <!-- Background Icon Pattern -->
                <div style="position: absolute; right: -8px; bottom: -8px; opacity: 0.05; z-index: 0;">
                    @svg($stat['icon'], '', ['style' => 'width: 80px; height: 80px;', 'class' => 'text-main'])
                </div>

                <!-- Card Header (Main Link Overlay) -->
                <a href="{{ url($stat['url']) }}" style="text-decoration: none; position: relative; z-index: 1; display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1rem;">
                    <div style="width: 42px; height: 42px; min-width: 42px; border-radius: 1rem; background: {{ $stat['color'] }}15; color: {{ $stat['color'] }}; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px {{ $stat['color'] }}15;">
                        @svg($stat['icon'], '', ['style' => 'width: 1.4rem; height: 1.4rem;'])
                    </div>
                    <div style="flex: 1;">
                        <div class="text-main" style="font-size: 1.4rem; font-weight: 900; line-height: 1;">{{ number_format($stat['count']) }}</div>
                        <div class="text-main" style="font-size: 0.85rem; font-weight: 850; margin-top: 0.15rem;">{{ $stat['label'] }}</div>
                        <p class="text-dim" style="font-size: 0.65rem; font-weight: 600; margin-top: 0.25rem; line-height: 1.3;">{{ $stat['description'] }}</p>
                    </div>
                </a>

                <!-- Sub-Menu Navigation -->
                <div style="position: relative; z-index: 2; margin-top: auto; border-top: 1px solid rgba(148, 163, 184, 0.1); padding-top: 0.75rem; display: flex; flex-wrap: wrap; gap: 0.4rem;">
                    @foreach($stat['sub_menus'] as $sub)
                        <a href="{{ url($sub['url']) }}" 
                           class="stat-sub-btn"
                           style="padding: 0.25rem 0.6rem; border-radius: 0.6rem; font-size: 0.6rem; font-weight: 800; text-decoration: none; transition: all 0.2s; white-space: nowrap;"
                        >
                            {{ $sub['label'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Progress Bar Decor -->
                <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: transparent; overflow: hidden;">
                    <div style="width: 100%; height: 100%; background: {{ $stat['color'] }}; opacity: 0.3;"></div>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .stat-sub-btn {
            background: white;
            border: 1px solid #e2e8f0;
            color: #64748b;
        }
        .dark .stat-sub-btn {
            background: #0f172a;
            border-color: #334155;
            color: #94a3b8;
        }
        .stat-sub-btn:hover {
            border-color: #2563eb;
            color: #2563eb;
            background: #eff6ff;
        }
        .dark .stat-sub-btn:hover {
            background: rgba(37, 99, 235, 0.1);
            color: #60a5fa;
            border-color: #3b82f6;
        }
    </style>
</div>


