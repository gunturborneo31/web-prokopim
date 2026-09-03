{{-- Shared PPID Sidebar --}}
<aside class="lg:col-span-1" data-aos="fade-right">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden sticky top-28">
        <div class="bg-gradient-to-br from-sky-600 to-sky-700 px-5 py-4">
            <h3 class="font-montserrat font-bold text-white text-sm flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Menu PPID
            </h3>
        </div>
        <nav class="py-2">
            @php
                $menuItems = [
                    ['label' => 'Semua Jenis Informasi', 'href' => '/ppid/informasi', 'icon' => 'M3 7a2 2 0 012-2h14a2 2 0 012 2v3H3V7zm0 5h18v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5z'],
                    ['label' => 'Informasi Berkala', 'href' => '/ppid/berkala', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['label' => 'Permohonan Informasi', 'href' => '/ppid/permohonan', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['label' => 'Informasi Serta Merta', 'href' => '/ppid/serta-merta', 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
                    ['label' => 'Informasi Setiap Saat', 'href' => '/ppid/setiap-saat', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Informasi Dikecualikan', 'href' => '/ppid/dikecualikan', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'],
                ];
            @endphp
            @foreach($menuItems as $item)
                <a href="{{ $item['href'] }}"
                   class="flex items-center gap-3 px-5 py-3 text-sm font-medium transition-all duration-200 border-l-4
                          {{ request()->is(ltrim($item['href'], '/')) ? 'bg-sky-50 text-sky-700 border-sky-500 font-bold' : 'text-slate-600 border-transparent hover:bg-sky-50/50 hover:text-sky-600 hover:border-sky-300' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" /></svg>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Info Box --}}
        <div class="mx-4 mb-4 p-4 bg-sky-50 rounded-xl border border-sky-100">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-sky-800 mb-1">Pejabat Pengelola Informasi & Dokumentasi</p>
                    <p class="text-[11px] text-sky-600 leading-relaxed">Berdasarkan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</p>
                </div>
            </div>
        </div>
    </div>
</aside>
