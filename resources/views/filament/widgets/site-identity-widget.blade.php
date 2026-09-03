<div class="h-full">
    @php $data = $this->getData(); @endphp
    <div class="widget-card h-full" style="padding: 2.5rem; position: relative;">
        <!-- Tombol Edit -->
        <a href="{{ url('/site-admin/website-identities') }}" class="edit-btn">
            <x-heroicon-o-pencil-square style="width: 1.25rem; height: 1.25rem;"/>
        </a>

        <!-- Profil -->
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div class="avatar-container" style="background: white; border: 2px solid #eff6ff; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.1);">
                @if($data['logo'])
                    <img src="{{ $data['logo'] }}" 
                         style="max-width: 90px; max-height: 90px; object-fit: contain; padding: 10px;"
                         onerror="this.src='{{ $data['logo_avatar'] }}'">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="22" y2="22"/>
                            <line x1="6" x2="6" y1="18" y2="11"/>
                            <line x1="10" x2="10" y1="18" y2="11"/>
                            <line x1="14" x2="14" y1="18" y2="11"/>
                            <line x1="18" x2="18" y1="18" y2="11"/>
                            <polygon points="12 2 20 7 4 7"/>
                        </svg>
                    </div>
                @endif
                <div style="position: absolute; bottom: 10px; right: 10px; width: 24px; height: 24px; background: #2563eb; border: 4px solid white; border-radius: 50%;" class="status-dot"></div>
            </div>
            <h2 class="text-main" style="font-size: 1.5rem; font-weight: 850; margin-bottom: 0.25rem;">{{ $data['user_name'] }}</h2>
            <p class="text-dim" style="font-size: 0.875rem; font-weight: 600;">{{ $data['user_role'] }}</p>
            
            <div style="display: flex; justify-content: center; gap: 0.75rem; margin-top: 1.25rem;">
                <span class="badge-secondary">{{ $data['site_name'] }}</span>
                <span class="badge-primary">{{ $data['status'] }}</span>
            </div>
        </div>

        <div style="height: 1px; background: rgba(148, 163, 184, 0.1); margin-bottom: 2rem;"></div>

        <!-- Grid Info -->
        <div style="display: grid; gap: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span class="text-dim" style="font-size: 0.875rem; font-weight: 600;">{{ __('Tipe Server') }}</span>
                <span class="text-main" style="font-size: 0.875rem; font-weight: 700;">{{ __('Local / Production') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span class="text-dim" style="font-size: 0.875rem; font-weight: 600;">{{ __('Model Engine') }}</span>
                <span class="text-main" style="font-size: 0.875rem; font-weight: 700;">{{ __('Laravel Hybrid') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span class="text-dim" style="font-size: 0.875rem; font-weight: 600;">{{ __('Pembaruan Terakhir') }}</span>
                <span class="text-main" style="font-size: 0.875rem; font-weight: 700;">{{ now()->translatedFormat('d M Y') }}</span>
            </div>
        </div>

        <!-- Media Sosial -->
        <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 2.5rem;">
            <a href="{{ url('/site-admin/static-pages') }}" title="{{ __('Halaman Statis') }}" class="social-btn">
                <x-heroicon-o-globe-alt style="width: 1.125rem; height: 1.125rem;"/>
            </a>
            <a href="{{ url('/site-admin/services') }}" title="{{ __('Layanan') }}" class="social-btn">
                 <x-heroicon-o-chat-bubble-left-right style="width: 1.125rem; height: 1.125rem;"/>
            </a>
            <a href="mailto:{{ $data['email'] }}" title="{{ __('Email') }}" class="social-btn">
                <x-heroicon-o-envelope style="width: 1.125rem; height: 1.125rem;"/>
            </a>
        </div>

        <!-- Informasi Sistem -->
        <div style="margin-top: 3rem;">
             <h3 class="text-main" style="font-size: 0.875rem; font-weight: 850; margin-bottom: 1.5rem;">{{ __('Informasi Sistem') }}</h3>
             <div style="display: grid; gap: 1.5rem;">
                <a href="{{ url('/site-admin/users') }}" style="display: flex; gap: 1rem; align-items: center; text-decoration: none;">
                    <div class="icon-box info">
                        <x-heroicon-o-user style="width: 1.125rem; height: 1.125rem;"/>
                    </div>
                    <div>
                        <div class="text-dim" style="font-size: 0.65rem; text-transform: uppercase; font-weight: 800;">{{ __('Administrator') }}</div>
                        <div class="text-main" style="font-size: 0.85rem; font-weight: 700;">{{ $data['admin_count'] }} {{ __('Personel') }}</div>
                    </div>
                </a>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <div class="icon-box warning">
                        <x-heroicon-o-envelope style="width: 1.125rem; height: 1.125rem;"/>
                    </div>
                    <div>
                        <div class="text-dim" style="font-size: 0.65rem; text-transform: uppercase; font-weight: 800;">{{ __('Konteks Email') }}</div>
                        <div class="text-main" style="font-size: 0.85rem; font-weight: 700;">{{ $data['email'] }}</div>
                    </div>
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <div class="icon-box info">
                        <x-heroicon-o-phone style="width: 1.125rem; height: 1.125rem;"/>
                    </div>
                    <div>
                        <div class="text-dim" style="font-size: 0.65rem; text-transform: uppercase; font-weight: 800;">{{ __('Hotline') }}</div>
                        <div class="text-main" style="font-size: 0.85rem; font-weight: 700;">{{ $data['phone'] }}</div>
                    </div>
                </div>
                <a href="{{ url('/site-admin/website-identities') }}" style="display: flex; gap: 1rem; align-items: center; text-decoration: none;">
                    <div class="icon-box danger">
                        <x-heroicon-o-map-pin style="width: 1.125rem; height: 1.125rem;"/>
                    </div>
                    <div>
                        <div class="text-dim" style="font-size: 0.65rem; text-transform: uppercase; font-weight: 800;">{{ __('Geolokasi') }}</div>
                        <div class="text-main" style="font-size: 0.85rem; font-weight: 700; line-height: 1.4;">{{ $data['address'] }}</div>
                    </div>
                </a>
             </div>
        </div>
    </div>

    <style>
        .edit-btn, .avatar-container, .social-btn {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            transition: all 0.2s;
        }
        .dark .edit-btn, .dark .avatar-container, .dark .social-btn {
            background: #1e293b;
            border-color: #334155;
        }
        .edit-btn {
            position: absolute; top: 1.5rem; right: 1.5rem; width: 40px; height: 40px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;
        }
        .edit-btn:hover { background: #2563eb; color: white; }

        .avatar-container {
            position: relative; display: inline-flex; justify-content: center; align-items: center; border-radius: 2.5rem; width: 140px; height: 140px; margin-bottom: 1.5rem;
        }
        .dark .status-dot { border-color: #1e293b !important; }

        .badge-secondary { background: #f1f5f9; color: #64748b; font-size: 0.7rem; font-weight: 800; padding: 0.4rem 0.8rem; border-radius: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .dark .badge-secondary { background: #1e293b; color: #94a3b8; }

        .badge-primary { background: #eff6ff; color: #2563eb; font-size: 0.7rem; font-weight: 800; padding: 0.4rem 0.8rem; border-radius: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .dark .badge-primary { background: rgba(37, 99, 235, 0.1); color: #60a5fa; }

        .social-btn {
            width: 32px; height: 32px; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;
        }
        .social-btn:hover { color: #2563eb; border-color: #2563eb; }
        .dark .social-btn { color: #94a3b8; }

        .icon-box {
            width: 36px; height: 36px; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;
        }
        .icon-box.info { background: #eff6ff; color: #2563eb; }
        .icon-box.warning { background: #fffbeb; color: #d97706; }
        .icon-box.danger { background: #fef2f2; color: #dc2626; }
        
        .dark .icon-box.info { background: rgba(37, 99, 235, 0.1); color: #60a5fa; }
        .dark .icon-box.warning { background: rgba(245, 158, 11, 0.1); color: #10192d; }
        .dark .icon-box.danger { background: rgba(220, 38, 38, 0.1); color: #f87171; }
    </style>
</div>

