{{-- Shared Regulasi Sidebar --}}
<aside class="lg:col-span-1" data-aos="fade-right">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden sticky top-28">
        <div class="bg-gradient-to-br from-sky-600 to-sky-700 px-5 py-4">
            <h3 class="font-montserrat font-bold text-white text-sm flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                Menu Regulasi
            </h3>
        </div>
        <nav class="py-2">
            @php
                $menuItems = [
                    ['label' => 'Undang-Undang', 'href' => '/regulasi/undang-undang', 'icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V7m0 16H9m3 0h3'],
                    ['label' => 'Peraturan Menteri', 'href' => '/regulasi/peraturan-menteri', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ['label' => 'Peraturan Daerah', 'href' => '/regulasi/peraturan-daerah', 'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
                    ['label' => 'Peraturan Bupati', 'href' => '/regulasi/peraturan-bupati', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['label' => 'SK Bupati', 'href' => '/regulasi/sk-bupati', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['label' => 'SK Kepala', 'href' => '/regulasi/sk-kepala', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                    ['label' => 'Lain-lain', 'href' => '/regulasi/lain-lain', 'icon' => 'M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z'],
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
    </div>
</aside>
