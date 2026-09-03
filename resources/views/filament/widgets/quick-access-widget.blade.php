<div class="widget-card" style="padding: 1rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
        <h3 class="text-main" style="font-size: 0.9rem; font-weight: 850; display: flex; align-items: center; gap: 0.4rem;">
            Akses Cepat
        </h3>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
        @foreach($this->getLinks() as $link)
            @php
                $colors = [
                    'blue' => ['bg' => 'rgba(37, 99, 235, 0.1)', 'text' => '#3b82f6'],
                    'indigo' => ['bg' => 'rgba(16, 185, 129, 0.1)', 'text' => '#2563eb'],
                    'emerald' => ['bg' => 'rgba(37, 99, 235, 0.1)', 'text' => '#3b82f6'],
                    'amber' => ['bg' => 'rgba(217, 119, 6, 0.1)', 'text' => '#f59e0b'],
                    'red' => ['bg' => 'rgba(220, 38, 38, 0.1)', 'text' => '#ef4444'],
                    'cyan' => ['bg' => 'rgba(6, 182, 212, 0.1)', 'text' => '#0891b2'],
                    'pink' => ['bg' => 'rgba(219, 39, 119, 0.1)', 'text' => '#ec4899'],
                    'violet' => ['bg' => 'rgba(124, 58, 237, 0.1)', 'text' => '#8b5cf6'],
                    'slate' => ['bg' => 'rgba(71, 85, 105, 0.1)', 'text' => '#94a3b8'],
                    'orange' => ['bg' => 'rgba(234, 88, 12, 0.1)', 'text' => '#f97316'],
                    'teal' => ['bg' => 'rgba(13, 148, 136, 0.1)', 'text' => '#14b8a6'],
                ];
                $c = $colors[$link['color']] ?? $colors['slate'];
            @endphp
            <a href="{{ url($link['url']) }}" class="access-link">
                <div class="access-icon" style="background: {{ $c['bg'] }}; color: {{ $c['text'] }};">
                    @svg($link['icon'], '', ['style' => 'width: 1rem; height: 1rem;'])
                </div>
                <span class="text-sub" style="font-size: 0.55rem; font-weight: 800; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;">{{ $link['label'] }}</span>
            </a>
        @endforeach
    </div>

    <style>
        .access-link {
            display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 0.5rem; border-radius: 0.75rem; border: 1px solid transparent; transition: all 0.2s; text-decoration: none;
        }
        .access-link:hover {
            background: rgba(148, 163, 184, 0.05);
            transform: translateY(-2px);
            border-color: rgba(148, 163, 184, 0.1);
        }
        .access-icon {
            padding: 0.4rem; border-radius: 0.6rem; margin-bottom: 0.4rem; transition: transform 0.2s;
        }
        .access-link:hover .access-icon { transform: scale(1.1); }
    </style>
</div>

