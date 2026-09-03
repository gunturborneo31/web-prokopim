<x-filament-panels::page>
    <div class="dashboard-wrapper">

        <!-- DASHBOARD GRID WRAPPER (Auto-Adapts to Sidebar) -->
        <div class="dashboard-container">
            <div class="dashboard-grid">

                <!-- COLUMN 1: IDENTITY & HEALTH -->
                <div class="col-identity animate-in">
                    @livewire(\App\Filament\Widgets\SiteIdentityWidget::class)

                    <div style="margin-top: 1rem;">
                        @livewire(\App\Filament\Widgets\SystemHealthWidget::class)
                    </div>

                    <!-- Premium Promo Card -->
                    <div class="premium-card">
                        <div class="card-glow"></div>
                        <h3>{{ __('Manajemen Portal PBJ') }}</h3>
                        <p>{{ __('Kelola identitas website, layanan informasi, dan konten publik secara efisien.') }}
                        </p>
                        <a href="{{ url('/site-admin/website-identities') }}" class="btn-primary">
                            {{ __('Atur Identitas') }}
                        </a>
                    </div>
                </div>

                <!-- MAIN COLUMN: MONITORING & ACTIONS -->
                <div class="col-main animate-in" style="animation-delay: 0.1s;">
                    <!-- Dynamic Header -->
                    <div class="main-header">
                        <div>
                            <h1>{{ $this->greeting }}, {{ __('Admin!') }}</h1>
                            <p class="subtitle">
                                <span class="user-name">{{ auth()->user()->name }}</span> ·
                                <span class="live-clock"
                                    wire:poll.1s>{{ now('Asia/Makassar')->translatedFormat('H:i:s') }}
                                    {{ __('WITA') }}</span>
                            </p>
                        </div>
                        <div class="header-actions">
                            <a href="{{ url('/site-admin/posts') }}" class="btn-ghost">
                                <x-heroicon-m-document-text style="width: 1rem; height: 1rem;" />
                                {{ __('Berita') }}
                            </a>
                            <a href="{{ url('/site-admin/agendas') }}" class="btn-solid">
                                <x-heroicon-m-calendar style="width: 1rem; height: 1rem;" />
                                {{ __('Agenda') }}
                            </a>
                        </div>
                    </div>

                    <!-- Pinned Sliders Banner -->
                    @livewire(\App\Filament\Widgets\PinnedSliderWidget::class)

                    <!-- Master Stats -->
                    @livewire(\App\Filament\Widgets\MasterStatisticsWidget::class)

                    <!-- Charts Row (Dua Diagram Utama) -->
                    <div class="charts-row">
                        <div class="chart-card">
                            <div class="chart-header">
                                <h3>{{ __('Tren Publikasi') }}</h3>
                                <a href="{{ url('/site-admin/posts') }}" class="btn-small">{{ __('Detail') }}</a>
                            </div>
                            @livewire(\App\Filament\Widgets\PerformanceTrendChart::class)
                        </div>

                        <div class="activity-card">
                            <h3>{{ __('Aktivitas Mingguan') }}</h3>
                            @livewire(\App\Filament\Widgets\ActivityBarChart::class)
                        </div>
                    </div>

                    <!-- Lower Data Row -->
                    <div class="data-row">
                        @livewire(\App\Filament\Widgets\RecentDocumentsWidget::class)
                        @livewire(\App\Filament\Widgets\SystemLogsWidget::class)
                    </div>
                </div>

                <!-- RIGHT COLUMN: RESOURCES & DISTRIBUTION -->
                <div class="col-sidebar animate-in" style="animation-delay: 0.2s;">
                    @livewire(\App\Filament\Widgets\RightSidebarWidget::class)

                    <div style="margin-top: 1rem;">
                        @livewire(\App\Filament\Widgets\QuickAccessWidget::class)
                    </div>

                    <div style="margin-top: 1rem;">
                        @livewire(\App\Filament\Widgets\ContentDistributionPieChart::class)
                    </div>

                    <div class="ticker-box">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span class="pulse-dot"></span>
                            <span class="ticker-label">{{ __('OPTIMASI SISTEM') }}</span>
                        </div>
                        <div class="ticker-value">{{ __('Status') }}: <span class="text-blue">{{ __('Stabil') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Initial states for GSAP (prevent flicker)
                gsap.set('.col-identity, .col-main, .col-sidebar', { opacity: 0, y: 30 });

                // Main Entrance Timeline
                const tl = gsap.timeline({ defaults: { ease: 'power4.out', duration: 1.2 } });

                tl.to('.col-identity', { opacity: 1, y: 0 })
                    .to('.col-main', { opacity: 1, y: 0 }, '-=0.9')
                    .to('.col-sidebar', { opacity: 1, y: 0 }, '-=0.9');

                // Stagger items inside columns
                const items = document.querySelectorAll('.charts-row > div, .data-row > div, .premium-card, .ticker-box, [class*="Widget"]');
                gsap.from(items, {
                    opacity: 0,
                    y: 20,
                    stagger: 0.05,
                    duration: 0.8,
                    delay: 0.6,
                    ease: 'power2.out'
                });

                // Card Interactive Elevation
                const cards = document.querySelectorAll('.widget-card, .chart-card, .activity-card, .premium-card, .ticker-box, .inner-card');
                cards.forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        gsap.to(card, {
                            y: -8,
                            scale: 1.02,
                            boxShadow: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                            duration: 0.4
                        });
                    });
                    card.addEventListener('mouseleave', () => {
                        gsap.to(card, {
                            y: 0,
                            scale: 1,
                            boxShadow: '0 1px 3px rgba(0,0,0,0.02)',
                            duration: 0.4
                        });
                    });
                });

                // Smooth pulsing for live clock
                gsap.to('.live-clock', {
                    scale: 1.05,
                    duration: 1,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });
            });
        </script>

        <style>
            [x-cloak] {
                display: none !important;
            }

            .dashboard-wrapper {
                background: #f1f5f9;
                min-height: 100vh;
                border-radius: 1.5rem;
                padding: 1.5rem;
                transition: all 0.3s ease;
                position: relative;
                z-index: 1;
            }

            .dark .dashboard-wrapper {
                background: #020617;
            }

            .dashboard-container {
                width: 100%;
                max-width: 100% !important;
                margin: 0;
            }

            .dashboard-grid {
                display: grid;
                grid-template-columns: 260px minmax(0, 1fr) 280px;
                gap: 1.25rem;
                align-items: start;
            }

            /* Layout Elements */
            .col-main {
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
                min-width: 0;
                overflow: hidden;
            }

            .charts-row,
            .data-row {
                display: grid;
                gap: 1.25rem;
                width: 100%;
            }

            /* Responsive Charts wrapping */
            .charts-row {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }

            .data-row {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            }

            /* Fluid Flow - Responsive Breakpoints */
            @media (max-width: 1400px) {
                .dashboard-grid {
                    grid-template-columns: 260px minmax(0, 1fr);
                }

                .col-sidebar {
                    display: none;
                }
            }

            @media (max-width: 1100px) {
                .dashboard-grid {
                    grid-template-columns: 1fr;
                }

                .col-identity {
                    display: none;
                }
            }

            /* Typography & Header */
            .main-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                margin-bottom: 0.25rem;
            }

            .main-header h1 {
                font-size: 1.6rem;
                font-weight: 850;
                color: #1e293b;
                margin: 0;
                letter-spacing: -0.02em;
            }

            .dark .main-header h1 {
                color: #f1f5f9;
            }

            .subtitle {
                font-size: 0.75rem;
                color: #94a3b8;
                font-weight: 600;
                margin-top: 0.25rem;
            }

            .user-name {
                color: #1e293b;
                font-weight: 700;
            }

            .dark .user-name {
                color: #f1f5f9;
            }

            .live-clock {
                color: #2563eb;
                font-weight: 800;
                font-family: monospace;
                background: #fff;
                padding: 0.2rem 0.5rem;
                border-radius: 0.5rem;
                border: 1px solid #e2e8f0;
                margin-left: 0.5rem;
                display: inline-block;
            }

            .dark .live-clock {
                background: #020617;
                border-color: #1e293b;
                color: #60a5fa;
            }

            /* Generic Widget Card Styling */
            .widget-card,
            .chart-card,
            .activity-card,
            .ticker-box {
                background: white;
                border-radius: 1.25rem;
                padding: 1.5rem;
                border: 1px solid #e2e8f0;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
                transition: border-color 0.3s ease;
            }

            .dark .widget-card,
            .dark .chart-card,
            .dark .activity-card,
            .dark .ticker-box {
                background: #0f172a;
                border-color: #1e293b;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
            }

            /* List items or inner cards */
            .inner-card {
                background: #f8fafc;
                border: 1px solid #f1f5f9;
                border-radius: 1rem;
                padding: 0.75rem;
                transition: all 0.3s ease;
            }

            .dark .inner-card {
                background: #1e293b;
                border-color: #334155;
            }

            .inner-card:hover {
                border-color: #2563eb;
                background: white;
                transform: translateY(-2px);
            }

            .dark .inner-card:hover {
                background: #1e293b;
                border-color: #2563eb;
            }

            /* Generic Text Colors */
            .text-main {
                color: #1e293b;
            }

            .dark .text-main {
                color: #f1f5f9;
            }

            .text-sub {
                color: #64748b;
            }

            .dark .text-sub {
                color: #94a3b8;
            }

            .text-dim {
                color: #94a3b8;
            }

            .dark .text-dim {
                color: #64748b;
            }

            .chart-card h3,
            .activity-card h3 {
                color: #1e293b;
                font-weight: 700;
            }

            .dark .chart-card h3,
            .dark .activity-card h3 {
                color: #f1f5f9;
            }

            .chart-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 1.5rem;
            }

            .main-val {
                font-size: 1.5rem;
                font-weight: 900;
                color: #1e293b;
            }

            .dark .main-val {
                color: #f1f5f9;
            }

            .premium-card {
                background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%);
                border-radius: 1.25rem;
                padding: 1.5rem;
                color: white;
                position: relative;
                overflow: hidden;
                margin-top: 1rem;
            }

            .premium-card h3 {
                font-size: 1rem;
                font-weight: 850;
                margin-bottom: 0.5rem;
            }

            .premium-card p {
                font-size: 0.75rem;
                opacity: 0.9;
                line-height: 1.4;
                margin-bottom: 1rem;
            }

            .btn-primary {
                display: block;
                background: rgba(255, 255, 255, 0.2);
                color: white;
                text-align: center;
                padding: 0.6rem;
                border-radius: 0.75rem;
                font-size: 0.75rem;
                font-weight: 700;
                text-decoration: none;
                backdrop-filter: blur(4px);
            }

            .btn-primary:hover {
                background: rgba(255, 255, 255, 0.3);
            }

            .btn-solid {
                background: #1e293b;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.75rem;
                font-size: 0.75rem;
                font-weight: 700;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .dark .btn-solid {
                background: #2563eb;
            }

            .btn-ghost {
                background: white;
                border: 1px solid #e2e8f0;
                color: #64748b;
                padding: 0.5rem 1rem;
                border-radius: 0.75rem;
                font-size: 0.75rem;
                font-weight: 700;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .dark .btn-ghost {
                background: #1e293b;
                border-color: #334155;
                color: #94a3b8;
            }

            .ticker-box {
                margin-top: 1rem;
                padding: 1rem;
                border-radius: 1rem;
            }

            .ticker-label {
                font-size: 0.6rem;
                font-weight: 850;
                color: #94a3b8;
            }

            .ticker-value {
                font-size: 0.7rem;
                font-weight: 700;
                color: #64748b;
            }

            .dark .ticker-value {
                color: #94a3b8;
            }

            .pulse-dot {
                width: 6px;
                height: 6px;
                background: #2563eb;
                border-radius: 50%;
                display: inline-block;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    opacity: 0.5;
                }

                50% {
                    opacity: 1;
                }

                100% {
                    opacity: 0.5;
                }
            }

            .header-actions {
                display: flex;
                gap: 0.5rem;
            }

            .btn-small {
                font-size: 0.7rem;
                font-weight: 700;
                color: #64748b;
                text-decoration: none;
                padding: 0.4rem 0.8rem;
                background: #f8fafc;
                border-radius: 0.5rem;
            }

            .dark .btn-small {
                background: #334155;
                color: #cbd5e1;
            }

            .text-blue {
                color: #2563eb;
            }

            /* Cleanup Filament Overrides */
            .fi-main {
                padding: 1.5rem !important;
            }
        </style>
    </div>
</x-filament-panels::page>