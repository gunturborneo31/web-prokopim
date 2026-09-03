<x-filament-panels::page>
    <style>
        .beranda-card-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        @media (min-width: 768px) {
            .beranda-card-grid { grid-template-columns: repeat(2, 1fr); }
        }
        .beranda-card {
            display: flex; align-items: center; gap: 1rem; padding: 1.25rem;
            border-radius: 1rem; border: 1px solid #e2e8f0;
            background: white; text-decoration: none; transition: all 0.2s ease-in-out;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .dark .beranda-card { background: rgba(30, 41, 59, 0.4); border-color: #334155; }
        
        .beranda-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
        
        .beranda-icon-wrap {
            display: flex; align-items: center; justify-content: center;
            width: 3rem; height: 3rem; border-radius: 0.75rem; flex-shrink: 0;
            transition: transform 0.3s;
        }
        .beranda-card:hover .beranda-icon-wrap { transform: scale(1.1); }
        
        .beranda-title { margin: 0; font-size: 1rem; font-weight: 700; color: #1e293b; transition: color 0.2s; }
        .dark .beranda-title { color: #f1f5f9; }
        
        .beranda-desc { margin: 0; margin-top: 0.25rem; font-size: 0.75rem; color: #64748b; line-height: 1.4; }
        .dark .beranda-desc { color: #94a3b8; }
        
        /* Emerald */
        .card-emerald:hover { border-color: #3b82f6; background: #f0fdf4; }
        .dark .card-emerald:hover { border-color: #2563eb; background: rgba(37, 99, 235, 0.1); }
        .card-emerald .beranda-icon-wrap { background: #dbeafe; color: #2563eb; }
        .dark .card-emerald .beranda-icon-wrap { background: rgba(16, 185, 129, 0.2); color: #60a5fa; }
        .card-emerald:hover .beranda-title { color: #2563eb; }
        .dark .card-emerald:hover .beranda-title { color: #60a5fa; }
        
        /* Blue */
        .card-blue:hover { border-color: #3b82f6; background: #eff6ff; }
        .dark .card-blue:hover { border-color: #2563eb; background: rgba(37, 99, 235, 0.1); }
        .card-blue .beranda-icon-wrap { background: #dbeafe; color: #2563eb; }
        .dark .card-blue .beranda-icon-wrap { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }
        .card-blue:hover .beranda-title { color: #2563eb; }
        .dark .card-blue:hover .beranda-title { color: #60a5fa; }
        
        /* Amber */
        .card-amber:hover { border-color: #f59e0b; background: #fffbeb; }
        .dark .card-amber:hover { border-color: #d97706; background: rgba(217, 119, 6, 0.1); }
        .card-amber .beranda-icon-wrap { background: #fef3c7; color: #d97706; }
        .dark .card-amber .beranda-icon-wrap { background: rgba(245, 158, 11, 0.2); color: #10192d; }
        .card-amber:hover .beranda-title { color: #d97706; }
        .dark .card-amber:hover .beranda-title { color: #10192d; }
        
        /* Indigo */
        .card-indigo:hover { border-color: #6366f1; background: #eef2ff; }
        .dark .card-indigo:hover { border-color: #4f46e5; background: rgba(79, 70, 229, 0.1); }
        .card-indigo .beranda-icon-wrap { background: #e0e7ff; color: #4f46e5; }
        .dark .card-indigo .beranda-icon-wrap { background: rgba(99, 102, 241, 0.2); color: #818cf8; }
        .card-indigo:hover .beranda-title { color: #4f46e5; }
        .dark .card-indigo:hover .beranda-title { color: #818cf8; }
    </style>

    <x-filament::section>
        <x-slot name="heading">
            Pengaturan Beranda
        </x-slot>
        <x-slot name="description">
            Silakan pilih sub-menu di bawah ini untuk mengelola berbagai konten yang muncul di beranda website.
        </x-slot>

        <div class="beranda-card-grid">
            <!-- Identitas Website -->
            <a href="{{ url('/site-admin/website-identities') }}" class="beranda-card card-emerald">
                <div class="beranda-icon-wrap">
                    <x-heroicon-o-globe-alt style="width: 1.5rem; height: 1.5rem;"/>
                </div>
                <div>
                    <h3 class="beranda-title">Identitas Website</h3>
                    <p class="beranda-desc">Kelola nama, logo, footer, dan deskripsi utama website</p>
                </div>
            </a>

            <!-- Slider -->
            <a href="{{ url('/site-admin/sliders') }}" class="beranda-card card-blue">
                <div class="beranda-icon-wrap">
                    <x-heroicon-o-photo style="width: 1.5rem; height: 1.5rem;"/>
                </div>
                <div>
                    <h3 class="beranda-title">Slider Banner</h3>
                    <p class="beranda-desc">Atur gambar banner berjalan ukuran besar di halaman depan</p>
                </div>
            </a>

            <!-- Agenda -->
            <a href="{{ url('/site-admin/agendas') }}" class="beranda-card card-amber">
                <div class="beranda-icon-wrap">
                    <x-heroicon-o-calendar style="width: 1.5rem; height: 1.5rem;"/>
                </div>
                <div>
                    <h3 class="beranda-title">Agenda Kegiatan</h3>
                    <p class="beranda-desc">Kelola daftar jadwal kegiatan organisasi Anda</p>
                </div>
            </a>

            <!-- Layanan E-Gov -->
            <a href="{{ url('/site-admin/services') }}" class="beranda-card card-indigo">
                <div class="beranda-icon-wrap">
                    <x-heroicon-o-briefcase style="width: 1.5rem; height: 1.5rem;"/>
                </div>
                <div>
                    <h3 class="beranda-title">Layanan E-Gov</h3>
                    <p class="beranda-desc">Manajemen kotak list aplikasi & layanan interaktif publik</p>
                </div>
            </a>
        </div>
    </x-filament::section>
</x-filament-panels::page>
