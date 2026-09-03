<x-filament-panels::page>
<style>
/* ── Base Reset ─────────────────────────────────── */
.pv-wrap * { box-sizing: border-box; }

/* ══ DARK MODE ══════════════════════════════════════
   Filament adds .dark to <html>.
   All inline bg/color set via style= are overridden here.
   ───────────────────────────────────────────────── */

/* Pills (Cara Mendapatkan / Cara Memperoleh) */
.dark .pv-pill {
    background: #1e293b !important;
    border-color: #334155 !important;
}
.dark .pv-pill-val { color: #f1f5f9 !important; }
.dark .pv-pill-label { color: #64748b !important; }

/* Cara Mendapatkan pill – blue tint */
.dark .pv-pill-blue { background: rgba(59,130,246,.1) !important; border-color: rgba(59,130,246,.15) !important; }
/* Cara Memperoleh pill – violet tint */
.dark .pv-pill-violet { background: rgba(139,92,246,.1) !important; border-color: rgba(139,92,246,.15) !important; }

/* Textarea boxes */
.dark .pv-textarea-slate {
    background: #1e293b !important;
    border-color: #334155 !important;
    color: #cbd5e1 !important;
}
.dark .pv-textarea-amber {
    background: rgba(120,53,15,.15) !important;
    border-color: rgba(180,83,9,.25) !important;
    color: #fcd34d !important;
}

/* Respon box */
.dark .pv-respon {
    background: rgba(16,185,129,.08) !important;
    border-color: rgba(16,185,129,.2) !important;
}
.dark .pv-respon p { color: #6ee7b7 !important; }
.dark .pv-respon-header span:first-child { color: #60a5fa !important; }

/* Catatan internal */
.dark .pv-catatan {
    background: rgba(120,53,15,.2) !important;
    border-color: rgba(217,119,6,.25) !important;
}
.dark .pv-catatan p { color: #fcd34d !important; }

/* Card head */
.dark .pv-card-head { background: #111827; }

/* Info pengelolaan rows */
.dark .pv-info-row { border-color: #1f2937 !important; }
.dark .pv-info-row span:first-child { color: #6b7280 !important; }
.dark .pv-info-row span:last-child  { color: #f3f4f6 !important; }

/* Respon empty state */
.dark .pv-respon-empty p:first-of-type { color: #4b5563 !important; }
.dark .pv-respon-empty p:last-of-type  { color: #374151 !important; }


/* ── Ticket Header ──────────────────────────────── */
.pv-ticket {
    position: relative;
    border-radius: 1.5rem;
    overflow: hidden;
    background: #0f172a;
    border: 1px solid rgba(255,255,255,.06);
}
.pv-ticket-bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 0% 0%, rgba(16,185,129,.3) 0%, transparent 60%),
                radial-gradient(ellipse at 100% 100%, rgba(99,102,241,.2) 0%, transparent 60%);
}
.pv-ticket-body { position: relative; z-index: 1; padding: 1.75rem 2rem; }
.pv-ticket-label {
    font-size: .65rem; font-weight: 800; letter-spacing: .25em;
    text-transform: uppercase; color: rgba(255,255,255,.45);
    margin-bottom: .35rem;
}
.pv-ticket-kode {
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    font-size: clamp(1.5rem, 3vw, 2.5rem);
    font-weight: 900; color: #fff;
    letter-spacing: .06em; line-height: 1;
}
.pv-ticket-meta {
    display: flex; align-items: center; gap: .5rem;
    margin-top: .6rem; font-size: .75rem;
    color: rgba(255,255,255,.5); font-weight: 500;
}
.pv-ticket-meta svg { width: .9rem; height: .9rem; opacity: .6; }

/* Status badge on ticket */
.pv-status-badge {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .4rem .85rem; border-radius: 100px;
    font-size: .7rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .1em;
    white-space: nowrap;
}

/* ── Progress Stepper ───────────────────────────── */
.pv-stepper {
    display: flex; align-items: center;
    padding: 1.25rem 2rem; gap: 0;
    border-top: 1px solid rgba(255,255,255,.06);
}
.pv-step { display: flex; flex-direction: column; align-items: center; flex: 1; }
.pv-step-dot {
    width: 1.75rem; height: 1.75rem; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .65rem; font-weight: 900; transition: all .2s;
    margin-bottom: .3rem;
}
.pv-step-dot.done { background: #3b82f6; color: #fff; }
.pv-step-dot.active { background: #fff; color: #0f172a; box-shadow: 0 0 0 4px rgba(255,255,255,.15); }
.pv-step-dot.pending { background: rgba(255,255,255,.08); color: rgba(255,255,255,.3); }
.pv-step-dot.rejected { background: #ef4444; color: #fff; }
.pv-step-label {
    font-size: .6rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .08em;
}
.pv-step-label.done, .pv-step-label.active { color: rgba(255,255,255,.9); }
.pv-step-label.pending { color: rgba(255,255,255,.25); }
.pv-step-label.rejected { color: #fca5a5; }
.pv-connector {
    height: 2px; flex: 1; margin-bottom: 1.25rem; border-radius: 100px;
}
.pv-connector.done { background: #3b82f6; }
.pv-connector.pending { background: rgba(255,255,255,.08); }

/* ── Cards ──────────────────────────────────────── */
.pv-card {
    background: var(--fi-bg, #fff);
    border-radius: 1.25rem;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    transition: box-shadow .2s;
}
.dark .pv-card { background: #111827; border-color: #1f2937; }
.pv-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.07); }
.dark .pv-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.3); }

.pv-card-head {
    display: flex; align-items: center; gap: .6rem;
    padding: .9rem 1.4rem;
    font-size: .7rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .12em; border-bottom: 1px solid #e2e8f0;
}
.dark .pv-card-head { border-color: #1f2937; }
.pv-card-head svg { width: .9rem; height: .9rem; flex-shrink: 0; }
.pv-card-body { padding: 1.4rem; }

/* ── Info Rows ──────────────────────────────────── */
.pv-row {
    display: flex; align-items: flex-start; gap: .9rem;
    padding: .8rem 0;
    border-bottom: 1px solid #f1f5f9;
}
.dark .pv-row { border-color: #1f2937; }
.pv-row:first-child { padding-top: 0; }
.pv-row:last-child { padding-bottom: 0; border-bottom: none; }
.pv-row-icon {
    width: 2rem; height: 2rem; border-radius: .6rem;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; background: #f8fafc;
}
.dark .pv-row-icon { background: #1f2937; }
.pv-row-icon svg { width: .95rem; height: .95rem; }
.pv-row-key {
    font-size: .65rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .08em; color: #94a3b8; margin-bottom: .15rem;
}
.dark .pv-row-key { color: #6b7280; }
.pv-row-val {
    font-size: .875rem; font-weight: 600; color: #0f172a; line-height: 1.5;
}
.dark .pv-row-val { color: #f3f4f6; }

/* ── Info Pills (cara mendapatkan/memperoleh) ──── */
.pv-pill-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; margin-bottom: 1.25rem; }
.pv-pill {
    border-radius: .9rem; padding: 1rem 1.1rem;
    border: 1px solid #e2e8f0; transition: all .2s;
}
.dark .pv-pill { border-color: #1f2937; }
.pv-pill-icon {
    display: flex; align-items: center; gap: .35rem;
    margin-bottom: .5rem;
}
.pv-pill-icon svg { width: .9rem; height: .9rem; }
.pv-pill-label {
    font-size: .6rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .1em; color: #94a3b8;
}
.pv-pill-val {
    font-size: .875rem; font-weight: 700; color: #0f172a;
    line-height: 1.3;
}
.dark .pv-pill-val { color: #f9fafb; }

/* ── Text Areas ─────────────────────────────────── */
.pv-textarea {
    border-radius: .75rem; padding: 1rem 1.1rem;
    font-size: .875rem; line-height: 1.8;
    white-space: pre-line; margin: 0;
    border: 1px solid #e2e8f0;
}
.dark .pv-textarea { border-color: #374151; }

/* ── Respon Box ─────────────────────────────────── */
.pv-respon {
    background: #f0fdf4; border: 1px solid #bbf7d0;
    border-radius: .9rem; padding: 1rem 1.2rem;
}
.dark .pv-respon { background: rgba(16,185,129,.08); border-color: rgba(16,185,129,.2); }
.pv-respon-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: .65rem;
}
.pv-respon-empty {
    text-align: center; padding: 2.5rem 1rem;
}
.pv-respon-empty svg { width: 2.5rem; height: 2.5rem; margin: 0 auto .75rem; display: block; }

/* ── Catatan Internal ─────────────────────────── */
.pv-catatan {
    background: #fffbeb; border: 1px solid #fde68a;
    border-radius: .9rem; padding: 1rem 1.2rem; margin-top: .9rem;
}
.dark .pv-catatan { background: rgba(245,158,11,.07); border-color: rgba(245,158,11,.2); }

/* ── Pengelolaan ─────────────────────────────── */
.pv-info-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: .6rem 0; border-bottom: 1px dashed #f1f5f9;
    font-size: .8rem;
}
.dark .pv-info-row { border-color: #1f2937; }
.pv-info-row:last-child { border-bottom: none; }
.pv-info-row span:first-child { color: #94a3b8; font-weight: 600; }
.pv-info-row span:last-child { color: #0f172a; font-weight: 700; }
.dark .pv-info-row span:last-child { color: #f3f4f6; }

/* ── Layout Grid ─────────────────────────────── */
.pv-grid { display: grid; grid-template-columns: minmax(280px, 1fr) 2fr; gap: 1.25rem; }
@media (max-width: 900px) { .pv-grid { grid-template-columns: 1fr; } }
</style>

@php
$statusStep = match($record->status) {
    'diajukan'  => 1,
    'diproses'  => 2,
    'disetujui' => 3,
    'ditolak'   => 4,
    default     => 1,
};
$isRejected = $record->status === 'ditolak';

$statusBadge = match($record->status) {
    'diajukan'  => ['bg' => '#dbeafe', 'color' => '#1d4ed8', 'dot' => '#3b82f6', 'text' => 'Diajukan'],
    'diproses'  => ['bg' => '#fef3c7', 'color' => '#92400e', 'dot' => '#f59e0b', 'text' => 'Diproses'],
    'disetujui' => ['bg' => '#dcfce7', 'color' => '#15803d', 'dot' => '#22c55e', 'text' => 'Disetujui'],
    'ditolak'   => ['bg' => '#fee2e2', 'color' => '#991b1b', 'dot' => '#ef4444', 'text' => 'Ditolak'],
    default     => ['bg' => '#f1f5f9', 'color' => '#334155', 'dot' => '#94a3b8', 'text' => ucfirst($record->status)],
};
@endphp

<div class="pv-wrap" style="display:flex;flex-direction:column;gap:1.25rem;">

    {{-- ═══ TICKET HEADER ═══════════════════════════════════ --}}
    <div class="pv-ticket">
        <div class="pv-ticket-bg"></div>

        <div class="pv-ticket-body" style="display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:1.25rem;">
            {{-- Left: Kode --}}
            <div>
                <div class="pv-ticket-label">Portal PPID Kab. Mahakam Ulu — Tiket Permohonan</div>
                <div class="pv-ticket-kode">{{ $record->kode_permohonan ?: '---' }}</div>
                <div class="pv-ticket-meta">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                    </svg>
                    Masuk: {{ $record->created_at->translatedFormat('d F Y, H:i') }} WIB
                </div>
            </div>

            {{-- Right: Status Badge --}}
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.5rem;">
                <span class="pv-status-badge" style="background:{{ $statusBadge['bg'] }};color:{{ $statusBadge['color'] }};">
                    <span style="width:.5rem;height:.5rem;border-radius:50%;background:{{ $statusBadge['dot'] }};flex-shrink:0;"></span>
                    {{ $statusBadge['text'] }}
                </span>
                @if($record->handled_at)
                <span style="font-size:.65rem;color:rgba(255,255,255,.35);font-weight:500;">
                    Diproses: {{ $record->handled_at->translatedFormat('d M Y, H:i') }}
                </span>
                @endif
            </div>
        </div>

        {{-- ── Progress Stepper ── --}}
        <div class="pv-stepper">
            @php
            $steps = [
                ['n'=>1, 'label'=>'Diajukan'],
                ['n'=>2, 'label'=>'Diproses'],
                ['n'=>3, 'label'=>$isRejected ? 'Ditolak' : 'Disetujui'],
            ];
            @endphp
            @foreach($steps as $i => $st)
                @php
                    if ($isRejected && $st['n'] === 3) {
                        $cls = $statusStep >= $st['n'] ? 'rejected' : 'pending';
                    } elseif ($statusStep > $st['n']) {
                        $cls = 'done';
                    } elseif ($statusStep === $st['n']) {
                        $cls = 'active';
                    } else {
                        $cls = 'pending';
                    }
                @endphp
                <div class="pv-step">
                    <div class="pv-step-dot {{ $cls }}">
                        @if($cls === 'done')
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="width:.75rem;height:.75rem">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        @elseif($cls === 'rejected')
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="width:.75rem;height:.75rem">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @else
                            {{ $st['n'] }}
                        @endif
                    </div>
                    <div class="pv-step-label {{ $cls }}">{{ $st['label'] }}</div>
                </div>
                @if(!$loop->last)
                    <div class="pv-connector {{ $statusStep > $st['n'] ? 'done' : 'pending' }}"></div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- ═══ CONTENT GRID ═══════════════════════════════════ --}}
    <div class="pv-grid">

        {{-- ── KOLOM KIRI ───────────────────────────────── --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Identitas Pemohon --}}
            <div class="pv-card">
                <div class="pv-card-head" style="color:#2563eb;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#2563eb">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Identitas Pemohon
                </div>
                <div class="pv-card-body" style="padding-top:.9rem;padding-bottom:.9rem;">
                    @foreach([
                        ['icon'=>'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z', 'key'=>'Nama Lengkap', 'val'=>$record->nama_lengkap, 'mono'=>false],
                        ['icon'=>'M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z', 'key'=>'NIK', 'val'=>$record->nik ?: '-', 'mono'=>true],
                        ['icon'=>'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75', 'key'=>'Email', 'val'=>$record->email ?: '-', 'mono'=>false],
                        ['icon'=>'M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z', 'key'=>'No. Telepon', 'val'=>$record->no_telepon ?: '-', 'mono'=>false],
                        ['icon'=>'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z', 'key'=>'Pekerjaan', 'val'=>$record->pekerjaan ?: '-', 'mono'=>false],
                    ] as $f)
                    <div class="pv-row">
                        <div class="pv-row-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['icon'] }}"/></svg>
                        </div>
                        <div>
                            <div class="pv-row-key">{{ $f['key'] }}</div>
                            <div class="pv-row-val" @if($f['mono']) style="font-family:monospace;letter-spacing:.04em;" @endif>{{ $f['val'] }}</div>
                        </div>
                    </div>
                    @endforeach

                    @if($record->alamat)
                    <div class="pv-row">
                        <div class="pv-row-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="pv-row-key">Alamat</div>
                            <div class="pv-row-val">{{ $record->alamat }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Info Pengelolaan --}}
            <div class="pv-card">
                <div class="pv-card-head" style="color:#64748b;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#94a3b8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/>
                    </svg>
                    Info Pengelolaan
                </div>
                <div class="pv-card-body">
                    <div class="pv-info-row">
                        <span>Diproses oleh</span>
                        <span>{{ optional($record->handler)->name ?? '—' }}</span>
                    </div>
                    <div class="pv-info-row">
                        <span>Waktu diproses</span>
                        <span>{{ $record->handled_at ? $record->handled_at->translatedFormat('d M Y, H:i') : '—' }}</span>
                    </div>
                    <div class="pv-info-row">
                        <span>Waktu masuk</span>
                        <span>{{ $record->created_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>

                    @if($record->catatan_admin)
                    <div class="pv-catatan" style="margin-top:1rem;">
                        <div style="display:flex;align-items:center;gap:.4rem;margin-bottom:.5rem;">
                            <svg style="width:.8rem;height:.8rem;color:#d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                            <span style="font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:#92400e;">Catatan Internal Admin</span>
                        </div>
                        <p style="font-size:.8rem;line-height:1.6;white-space:pre-line;margin:0;color:#78350f;">{{ $record->catatan_admin }}</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- ── KOLOM KANAN ──────────────────────────────── --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Detail Permohonan --}}
            <div class="pv-card">
                <div class="pv-card-head" style="color:#4f46e5;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#6366f1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    Rincian Permohonan
                </div>
                <div class="pv-card-body">

                    {{-- Cara pills --}}
                    <div class="pv-pill-grid">
                        <div class="pv-pill pv-pill-blue" style="background:#eff6ff;">
                            <div class="pv-pill-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke="#3b82f6" stroke-width="2" style="width:.9rem;height:.9rem">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="pv-pill-label" style="color:#3b82f6;">Cara Mendapatkan</span>
                            </div>
                            <div class="pv-pill-val">{{ $record->cara_mendapatkan ?: '-' }}</div>
                        </div>
                        <div class="pv-pill pv-pill-violet" style="background:#f5f3ff;">
                            <div class="pv-pill-icon">
                                <svg fill="none" viewBox="0 0 24 24" stroke="#8b5cf6" stroke-width="2" style="width:.9rem;height:.9rem">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                                <span class="pv-pill-label" style="color:#8b5cf6;">Cara Memperoleh</span>
                            </div>
                            <div class="pv-pill-val">{{ $record->cara_memperoleh ?: '-' }}</div>
                        </div>
                    </div>

                    {{-- Rincian Informasi --}}
                    <div style="margin-bottom:1.1rem;">
                        <div style="font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:#94a3b8;margin-bottom:.5rem;">
                            Informasi yang Dimohon
                        </div>
                        <p class="pv-textarea pv-textarea-slate" style="background:#f8fafc;color:#334155;">{{ $record->rincian_informasi }}</p>
                    </div>

                    {{-- Tujuan --}}
                    <div>
                        <div style="font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:#94a3b8;margin-bottom:.5rem;">
                            Tujuan Penggunaan Informasi
                        </div>
                        <p class="pv-textarea pv-textarea-amber" style="background:#fffbeb;color:#78350f;border-color:#fde68a;">{{ $record->tujuan_penggunaan }}</p>
                    </div>

                </div>
            </div>

            {{-- Tanggapan Admin --}}
            <div class="pv-card">
                <div class="pv-card-head" style="color:#0d9488;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#0d9488">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                    </svg>
                    Tanggapan untuk Pemohon
                    @if($record->respon_admin)
                        <span style="margin-left:auto;font-size:.6rem;background:#dcfce7;color:#15803d;padding:.2rem .6rem;border-radius:100px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;">
                            Sudah Dibalas
                        </span>
                    @else
                        <span style="margin-left:auto;font-size:.6rem;background:#f1f5f9;color:#94a3b8;padding:.2rem .6rem;border-radius:100px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;">
                            Belum Dibalas
                        </span>
                    @endif
                </div>
                <div class="pv-card-body">
                    @if($record->respon_admin)
                        <div class="pv-respon">
                            <div class="pv-respon-header">
                                <span style="font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:#15803d;">
                                    ✅ Tanggapan Resmi PPID
                                </span>
                                @if($record->handled_at)
                                <span style="font-size:.65rem;color:#6b7280;font-weight:500;">
                                    {{ $record->handled_at->translatedFormat('d M Y, H:i') }}
                                </span>
                                @endif
                            </div>
                            <p style="font-size:.875rem;line-height:1.75;white-space:pre-line;margin:0;color:#14532d;">{{ $record->respon_admin }}</p>
                        </div>
                    @else
                        <div class="pv-respon-empty">
                            <svg fill="none" viewBox="0 0 24 24" stroke="#e2e8f0" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            <p style="font-weight:700;color:#94a3b8;margin:0 0 .3rem;font-size:.9rem;">Belum ada tanggapan</p>
                            <p style="font-size:.78rem;color:#cbd5e1;margin:0;">Klik <strong style="color:#94a3b8">Update Status</strong> di atas untuk menambahkan tanggapan yang akan terlihat oleh pemohon.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
</x-filament-panels::page>
