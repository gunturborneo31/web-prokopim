<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
    @php
        $links = [
            __('Total Publikasi') => '/site-admin/posts',
            __('Arsip File') => '/site-admin/file-sharings',
            __('User Aktif') => '/site-admin/users',
            __('Traffic Harian') => '/site-admin/posts',
        ];
    @endphp
    @foreach($this->getData() as $stat)
        <a href="{{ url($links[$stat['label']] ?? '#') }}" style="background: white; border-radius: 1.5rem; padding: 1.5rem; border: 1px solid #f1f5f9; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 1rem; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='#2563eb';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#f1f5f9';">
            <span style="font-size: 0.75rem; font-weight: 700; color: #64748b; white-space: nowrap;">{{ $stat['label'] }}</span>
            
            <div style="position: relative; width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                <svg viewBox="0 0 36 36" style="width: 100%; height: 100%; transform: rotate(-90deg);">
                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#f1f5f9" stroke-width="3" />
                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="{{ $stat['color'] }}" stroke-width="3" stroke-dasharray="{{ ($stat['value'] / max(1, $stat['target'])) * 100 }}, 100" stroke-linecap="round" />
                </svg>
                <div style="position: absolute; display: flex; flex-direction: column; align-items: center;">
                    <span style="font-size: 1.125rem; font-weight: 900; color: #1e293b;">{{ $stat['value'] }}/{{ $stat['target'] }}</span>
                    <span style="font-size: 0.6rem; font-weight: 700; color: #94a3b8; text-transform: uppercase;">{{ $stat['unit'] }}</span>
                </div>
            </div>
        </a>
    @endforeach
</div>
