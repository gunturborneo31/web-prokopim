<x-filament-panels::page>
    <style>
        .pgd-card { background: #fff; border-radius: 1rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,.06); overflow: hidden; transition: all 0.3s ease; }
        .dark .pgd-card { background: #111827; border-color: #374151; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2); }
        
        .pgd-card-header { padding: 1rem 1.5rem; display: flex; align-items: center; gap: .6rem; font-weight: 700; color: #fff; font-size: .875rem; }
        .pgd-card-body { padding: 1.5rem; }
        .pgd-field { display: flex; align-items: flex-start; gap: .75rem; margin-bottom: 1rem; }
        .pgd-field:last-child { margin-bottom: 0; }
        
        .pgd-icon { width: 2rem; height: 2rem; border-radius: .5rem; background: #f8fafc; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.3s ease; }
        .dark .pgd-icon { background: #1f2937; }
        
        .pgd-icon svg { width: 1.1rem; height: 1.1rem; color: #94a3b8; stroke: #94a3b8; }
        .dark .pgd-icon svg { color: #6b7280; stroke: #6b7280; }
        
        .pgd-label { font-size: .7rem; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; font-weight: 600; margin-bottom: .15rem; }
        .dark .pgd-label { color: #6b7280; }
        
        .pgd-value { font-size: .875rem; color: #1e293b; font-weight: 500; transition: all 0.3s ease; }
        .dark .pgd-value { color: #f3f4f6; }
        
        .pgd-badge { display: inline-flex; align-items: center; gap: .35rem; padding: .35rem .9rem; border-radius: 9999px; font-size: .8rem; font-weight: 700; }
        .pgd-divider { border: none; border-top: 1px solid #f1f5f9; margin: 1rem 0; }
        .dark .pgd-divider { border-color: #374151; }
        
        .pgd-respon-box { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: .75rem; padding: 1rem 1.25rem; transition: all 0.3s ease; }
        .dark .pgd-respon-box { background: rgba(22, 163, 74, 0.1); border-color: rgba(34, 197, 94, 0.2); }
        
        .pgd-respon-empty { text-align: center; padding: 2rem; color: #94a3b8; }
        .dark .pgd-respon-empty { color: #4b5563; }
        
        .pgd-catatan-box { background: #fffbeb; border: 1px solid #fde68a; border-radius: .75rem; padding: 1rem 1.25rem; transition: all 0.3s ease; }
        .dark .pgd-catatan-box { background: rgba(245, 158, 11, 0.1); border-color: rgba(251, 191, 36, 0.2); }
        
        .pgd-file-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .5rem 1rem; border-radius: .5rem; background: #f0fdf4; color: #16a34a; font-size: .8rem; font-weight: 600; text-decoration: none; margin-top: .5rem; border: 1px solid #bbf7d0; transition: all 0.2s; }
        .dark .pgd-file-btn { background: rgba(22, 163, 74, 0.1); color: #4ade80; border-color: rgba(34, 197, 94, 0.2); }
        .pgd-file-btn:hover { background: #dcfce7; }
        .dark .pgd-file-btn:hover { background: rgba(22, 163, 74, 0.2); }
    </style>

    <div style="display: flex; flex-direction: column; gap: 1.5rem;">

        {{-- ======= STATUS HEADER ======= --}}
        @php
            $statusConfig = match($record->status) {
                'baru'     => ['bg' => 'linear-gradient(135deg, #3b82f6, #6366f1)', 'label' => '📥 Laporan Baru',       'text' => '#dbeafe'],
                'diproses' => ['bg' => 'linear-gradient(135deg, #f59e0b, #f97316)', 'label' => '⏳ Sedang Diproses',    'text' => '#fef3c7'],
                'selesai'  => ['bg' => 'linear-gradient(135deg, #22c55e, #3b82f6)', 'label' => '✅ Laporan Selesai',    'text' => '#dcfce7'],
                'ditolak'  => ['bg' => 'linear-gradient(135deg, #ef4444, #dc2626)', 'label' => '❌ Ditolak',            'text' => '#fee2e2'],
                default    => ['bg' => 'linear-gradient(135deg, #64748b, #475569)', 'label' => $record->status,         'text' => '#f1f5f9'],
            };
        @endphp
        <div style="background: {{ $statusConfig['bg'] }}; border-radius: 1rem; padding: 1.5rem 2rem; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="background: rgba(255,255,255,.2); border-radius: .75rem; padding: .75rem;">
                    <svg style="width:1.75rem;height:1.75rem;stroke:white;fill:none;" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <div style="color: rgba(255,255,255,.75); font-size: .75rem; font-weight: 600; text-transform: uppercase; letter-spacing: .05em;">Kode Laporan</div>
                    <div style="color: white; font-size: 1.75rem; font-weight: 900; font-family: 'Courier New', monospace; letter-spacing: .1em;">{{ $record->kode_laporan }}</div>
                </div>
            </div>
            <div style="text-align: right;">
                <div style="display: inline-block; background: rgba(255,255,255,.2); border: 1px solid rgba(255,255,255,.3); color: white; padding: .5rem 1.25rem; border-radius: 9999px; font-size: .875rem; font-weight: 700;">
                    {{ $statusConfig['label'] }}
                </div>
                <div style="color: rgba(255,255,255,.7); font-size: .75rem; margin-top: .5rem;">
                    Diterima: {{ $record->created_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>

        {{-- ======= GRID ======= --}}
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem;">

            {{-- ======= KOLOM KIRI ======= --}}
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">

                {{-- Identitas Pelapor --}}
                <div class="pgd-card">
                    <div class="pgd-card-header" style="background: linear-gradient(135deg, #2563eb, #3b82f6);">
                        <svg style="width:1rem;height:1rem;stroke:white;fill:none;flex-shrink:0" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Identitas Pelapor
                    </div>
                    <div class="pgd-card-body">
                        @if($record->is_anonymous)
                            <div style="display:flex;align-items:center;gap:.5rem;padding:.6rem .9rem;background:#f8fafc;border-radius:.5rem;margin-bottom:1rem;border:1px solid #e2e8f0">
                                <svg style="width:.9rem;height:.9rem;stroke:#64748b;fill:none;flex-shrink:0" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span style="font-size:.8rem;color:#64748b;font-weight:600;">Laporan Anonim</span>
                            </div>
                        @endif

                        @php
                            $hidden = $record->is_anonymous ? '(Disembunyikan)' : null;
                        @endphp

                        <div class="pgd-field">
                            <div class="pgd-icon"><svg viewBox="0 0 24 24" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg></div>
                            <div>
                                <div class="pgd-label">Nama Lengkap</div>
                                <div class="pgd-value">{{ $hidden ?? $record->nama_lengkap }}</div>
                            </div>
                        </div>

                        <div class="pgd-field">
                            <div class="pgd-icon"><svg viewBox="0 0 24 24" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg></div>
                            <div>
                                <div class="pgd-label">NIK</div>
                                <div class="pgd-value">{{ $hidden ?? ($record->nik ?: '-') }}</div>
                            </div>
                        </div>

                        <div class="pgd-field">
                            <div class="pgd-icon"><svg viewBox="0 0 24 24" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg></div>
                            <div>
                                <div class="pgd-label">Email</div>
                                <div class="pgd-value">{{ $hidden ?? ($record->email ?: '-') }}</div>
                            </div>
                        </div>

                        <div class="pgd-field">
                            <div class="pgd-icon"><svg viewBox="0 0 24 24" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg></div>
                            <div>
                                <div class="pgd-label">No. Telepon / WA</div>
                                <div class="pgd-value">{{ $hidden ?? ($record->telepon ?: '-') }}</div>
                            </div>
                        </div>

                        <div class="pgd-field">
                            <div class="pgd-icon"><svg viewBox="0 0 24 24" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" /></svg></div>
                            <div>
                                <div class="pgd-label">Pekerjaan</div>
                                <div class="pgd-value">{{ $record->pekerjaan ?: '-' }}</div>
                            </div>
                        </div>

                        <div class="pgd-field">
                            <div class="pgd-icon"><svg viewBox="0 0 24 24" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg></div>
                            <div>
                                <div class="pgd-label">Unit Kerja</div>
                                <div class="pgd-value">{{ $record->unit_kerja ?: '-' }}</div>
                            </div>
                        </div>

                        @if($record->alamat && !$record->is_anonymous)
                            <div class="pgd-field">
                                <div class="pgd-icon"><svg viewBox="0 0 24 24" stroke-width="1.5" fill="none"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg></div>
                                <div>
                                    <div class="pgd-label">Alamat</div>
                                    <div class="pgd-value">{{ $record->alamat }}</div>
                                </div>
                            </div>
                        @endif

                        @if($record->file_identitas)
                            <hr class="pgd-divider">
                            <div>
                                <div class="pgd-label" style="margin-bottom:.5rem;">File Identitas</div>
                                <a href="{{ Storage::url($record->file_identitas) }}" target="_blank" class="pgd-file-btn">
                                    <svg style="width:1rem;height:1rem;stroke:currentColor;fill:none;flex-shrink:0" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    Lihat File Identitas
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Info Pengelolaan --}}
                <div class="pgd-card">
                    <div class="pgd-card-header" style="background: linear-gradient(135deg, #475569, #334155);">
                        <svg style="width:1rem;height:1rem;stroke:white;fill:none;flex-shrink:0" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Info Pengelolaan
                    </div>
                    <div class="pgd-card-body">
                        <div class="pgd-field">
                            <div>
                                <div class="pgd-label">Diproses Oleh</div>
                                <div class="pgd-value">{{ $record->handler?->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="pgd-field">
                            <div>
                                <div class="pgd-label">Waktu Diproses</div>
                                <div class="pgd-value">{{ $record->handled_at ? $record->handled_at->format('d M Y, H:i') : '-' }}</div>
                            </div>
                        </div>
                        @if($record->catatan_admin)
                            <hr class="pgd-divider">
                            <div>
                                <div class="pgd-label" style="margin-bottom:.5rem;">Catatan Internal Admin</div>
                                <div class="pgd-catatan-box">
                                    <p style="font-size:.875rem;line-height:1.6;white-space:pre-line;margin:0;" class="text-amber-900 dark:text-amber-200">{{ $record->catatan_admin }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ======= KOLOM KANAN ======= --}}
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">

                {{-- Detail Laporan --}}
                <div class="pgd-card">
                    <div class="pgd-card-header" style="background: linear-gradient(135deg, #4f46e5, #6366f1);">
                        <svg style="width:1rem;height:1rem;stroke:white;fill:none;flex-shrink:0" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        Detail Laporan
                    </div>
                    <div class="pgd-card-body">

                        {{-- Kategori + Tanggal --}}
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.25rem;">
                            <div style="border-radius:.75rem;padding:1rem;" class="bg-indigo-50 dark:bg-indigo-900/40">
                                <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.35rem;" class="text-indigo-600 dark:text-indigo-300">Kategori</div>
                                <div style="font-size:1rem;font-weight:800;" class="text-indigo-900 dark:text-indigo-100">{{ $record->kategori }}</div>
                            </div>
                            <div style="border-radius:.75rem;padding:1rem;" class="bg-rose-50 dark:bg-rose-900/40">
                                <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.35rem;" class="text-rose-500 dark:text-rose-300">Tgl. Kejadian</div>
                                <div style="font-size:1rem;font-weight:800;" class="text-rose-900 dark:text-rose-100">
                                    {{ $record->tanggal_kejadian ? $record->tanggal_kejadian->format('d M Y') : '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Judul --}}
                        <div style="margin-bottom:1.25rem;">
                            <div class="pgd-label" style="margin-bottom:.4rem;">Judul / Topik Laporan</div>
                            <h2 style="font-size:1.25rem;font-weight:800;line-height:1.4;margin:0;" class="text-[#274CA5] dark:text-white">{{ $record->judul_laporan }}</h2>
                        </div>

                        <hr class="pgd-divider">

                        {{-- Kronologis --}}
                        <div style="margin-bottom:1.25rem;">
                            <div class="pgd-label" style="margin-bottom:.5rem;">Kronologis Kejadian</div>
                            <div style="border-radius:.75rem;padding:1rem 1.25rem;border:1px solid #f1f5f9;" class="bg-slate-50 dark:bg-[#274CA5]/40 dark:border-slate-800">
                                <p style="font-size:.875rem;line-height:1.8;white-space:pre-line;margin:0;" class="text-slate-700 dark:text-slate-300">{{ $record->kronologis }}</p>
                            </div>
                        </div>

                        {{-- Bukti Pendukung --}}
                        @if($record->bukti_pendukung)
                            <hr class="pgd-divider">
                            <div>
                                <div class="pgd-label" style="margin-bottom:.75rem;">Bukti Pendukung</div>
                                @php
                                    $ext = strtolower(pathinfo($record->bukti_pendukung, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                @endphp
                                @if($isImage)
                                    <div style="position:relative;display:inline-block;">
                                        <img src="{{ Storage::url($record->bukti_pendukung) }}"
                                             alt="Bukti Pendukung"
                                             style="max-height:280px;border-radius:.75rem;border:1px solid #e2e8f0;object-contain;background:#f8fafc;display:block;">
                                        <a href="{{ Storage::url($record->bukti_pendukung) }}" target="_blank"
                                           style="position:absolute;top:.5rem;right:.5rem;background:rgba(255,255,255,.9);border-radius:.5rem;padding:.4rem;border:1px solid #e2e8f0;display:flex;align-items:center;">
                                            <svg style="width:1rem;height:1rem;stroke:#6366f1;fill:none;" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                            </svg>
                                        </a>
                                    </div>
                                @else
                                    <a href="{{ Storage::url($record->bukti_pendukung) }}" target="_blank"
                                       style="display:inline-flex;align-items:center;gap:.5rem;padding:.7rem 1.25rem;background:#eef2ff;color:#4f46e5;border-radius:.75rem;font-size:.875rem;font-weight:600;text-decoration:none;border:1px solid #c7d2fe;">
                                        <svg style="width:1.1rem;height:1.1rem;stroke:currentColor;fill:none;flex-shrink:0" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                        </svg>
                                        Unduh Bukti Pendukung (.{{ $ext }})
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tanggapan / Respon Publik --}}
                <div class="pgd-card">
                    <div class="pgd-card-header" style="background: linear-gradient(135deg, #0d9488, #3b82f6);">
                        <svg style="width:1rem;height:1rem;stroke:white;fill:none;flex-shrink:0" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                        Tanggapan untuk Pelapor
                    </div>
                    <div class="pgd-card-body">
                        @if($record->respon_publik)
                            <div class="pgd-respon-box">
                                @if($record->handled_at)
                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem;">
                                        <span style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;" class="text-green-700 dark:text-green-300">Tanggapan Resmi</span>
                                        <span style="font-size:.7rem;" class="text-gray-500 dark:text-gray-400">{{ $record->handled_at->format('d M Y, H:i') }}</span>
                                    </div>
                                @endif
                                <p style="font-size:.875rem;line-height:1.7;white-space:pre-line;margin:0;" class="text-green-900 dark:text-green-100">{{ $record->respon_publik }}</p>
                            </div>
                        @else
                            <div class="pgd-respon-empty">
                                <svg style="width:3rem;height:3rem;stroke:#e2e8f0;fill:none;margin:0 auto 1rem;" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                </svg>
                                <p style="font-weight:600;color:#94a3b8;margin:0 0 .25rem;">Belum ada tanggapan</p>
                                <p style="font-size:.8rem;color:#cbd5e1;margin:0;">Klik "Update Status" di atas untuk menambahkan tanggapan.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-filament-panels::page>
