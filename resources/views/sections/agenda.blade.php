
        <!-- ============================================ -->
        <!-- SECTION 4: AGENDA INSPEKTORAT (DARK)        -->
        <!-- ============================================ -->
        <section class="py-24 relative bg-[#274CA5] overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute inset-0 pointer-events-none z-0">
                <!-- Abstract Shapes -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-[#3255AA]/5 blur-[120px]"></div>
                <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-[#274CA5]/5 blur-[100px]"></div>
                <!-- Subtle grid overlay -->
                <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 32px 32px;"></div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10"
                 x-data="agendaCarousel()"
                 x-init="init()">

                <!-- Section Header -->
                <div class="text-center mb-16" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#274CA5]/10 border border-[#274CA5]/20 mb-6 backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-[#274CA5] shadow-[0_0_10px_rgba(163,230,53,0.5)]"></span>
                        <span class="text-[#274CA5] font-bold tracking-widest uppercase text-xs">Jadwal Kegiatan</span>
                    </div>
                    <h2 class="font-montserrat font-black text-4xl md:text-5xl lg:text-6xl leading-tight text-white drop-shadow-lg ">
                        Agenda <span class="text-shadow-[0_0_10px_rgba(255,255,255,0.5)] text-[#0f2044]">Prokopim</span>
                    </h2>
                    <p class="mt-6 text-white text-lg font-medium max-w-2xl mx-auto">Pantau jadwal kegiatan inspeksi, pengawasan, dan rapat koordinasi terbaru di lingkungan Pemerintah Kabupaten Mahakam Ulu.</p>
                </div>

                <!-- Carousel Wrapper Container -->
                <div class="rounded-[2.5rem] border border-white/10 p-6 sm:p-8" data-aos="fade-up"
                     style="background: linear-gradient(145deg, rgba(30,41,59,0.7) 0%, rgba(15,23,42,0.8) 100%); backdrop-filter: blur(20px); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.5);">

                    <!-- Search Bar + Nav -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 mb-8">
                        <!-- Search & Date Wrapper -->
                        <div class="flex flex-col sm:flex-row flex-1 gap-3 max-w-2xl items-stretch sm:items-center">
                            <!-- TextInput -->
                            <div class="relative flex-1 group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-white/40 group-focus-within:text-[#274CA5] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                                <input type="text"
                                       x-model="search"
                                       @input="onSearch()"
                                       placeholder="Cari kegiatan..."
                                       class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-white/40 text-sm focus:outline-none focus:border-[#274CA5]/50 transition-all duration-300">
                            </div>
                            <!-- DateInput -->
                            <div class="relative sm:w-44 group">
                                <input type="date"
                                       x-model="searchDate"
                                        @input="onSearch()"
                                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-[#274CA5]/50 transition-all duration-300 [color-scheme:dark]">
                            </div>

                            <!-- Quick Filters -->
                            <div class="flex items-center gap-2">
                                <button @click="showToday()" 
                                        class="px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest border transition-all whitespace-nowrap"
                                        :class="isTodayActive ? 'bg-[#3255AA] border-[#3255AA] text-white shadow-lg shadow-[#3255AA]/20' : 'bg-white/5 border-white/10 text-slate-400 hover:text-white hover:bg-white/10'">
                                    Hari Ini
                                </button>
                                <button @click="showAll()" 
                                        class="px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-widest border transition-all whitespace-nowrap"
                                        :class="isAllActive ? 'bg-[#3255AA] border-[#3255AA] text-white shadow-lg shadow-[#3255AA]/20' : 'bg-white/5 border-white/10 text-slate-400 hover:text-white hover:bg-white/10'">
                                    Semua
                                </button>
                            </div>
                        </div>

                        <!-- Nav Info -->
                        <div class="flex items-center gap-4">
                            <span class="text-slate-400 text-sm font-medium bg-white/5 px-3 py-1.5 rounded-lg border border-white/5" x-text="filtered.length + ' agenda'"></span>
                            <span class="inline-flex items-center rounded-xl border border-[#274CA5]/30 bg-[#274CA5]/10 px-4 py-2 text-xs font-bold uppercase tracking-wider text-[#274CA5]">
                                Agenda Lainnya
                            </span>
                        </div>
                    </div>

                <!-- Tabel Agenda -->
                <div data-aos="fade-up" class="relative overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-white/10 text-slate-200 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Waktu</th>
                                    <th class="px-4 py-3">Hari</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Tempat</th>
                                    <th class="px-4 py-3">OPD</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y dividewhite/10">
                                <template x-for="(item, idx) in filtered" :key="item._i">
                                    <tr class="text-slate-100 hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-3 font-semibold" x-text="idx + 1"></td>
                                        <td class="px-4 py-3" x-text="item.date"></td>
                                        <td class="px-4 py-3" x-text="item.time"></td>
                                        <td class="px-4 py-3" x-text="item.hari || '-' "></td>
                                        <td class="px-4 py-3 font-semibold text-white" x-text="item.title"></td>
                                        <td class="px-4 py-3" x-text="item.location"></td>
                                        <td class="px-4 py-3" x-text="item.opd || '-' "></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    @if(($agendaTotalCount ?? 0) > 5)
                    <div class="border-t border-white/10 px-4 py-3 text-xs text-slate-300 sm:px-5">
                        Menampilkan 5 agenda terbaru dari total {{ $agendaTotalCount }} agenda. Gunakan filter untuk menyaring data yang ditampilkan.
                    </div>
                    @endif

                    <!-- Dynamic Empty State -->
                    <div x-show="filtered.length === 0" x-cloak class="py-16 px-4 text-center">
                        <div class="mb-6 inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/5 border border-white/10 mx-auto">
                            <svg class="w-10 h-10 text-white/10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        
                        <div x-show="isTodayActive">
                            <h4 class="text-white/90 text-2xl font-bold mb-2">Tidak ada agenda hari ini</h4>
                            <p class="text-slate-400 text-sm mb-8 max-w-sm mx-auto">Sepertinya jadwal hari ini sedang kosong. Apakah Anda ingin melihat agenda terdekat lainnya?</p>
                            <button @click="showNearest()" class="px-8 py-3 rounded-full bg-[#3255AA] text-white text-xs font-black uppercase tracking-widest shadow-xl shadow-[#3255AA]/30 hover:bg-[#274CA5] hover:scale-105 active:scale-95 transition-all">
                                Lihat Agenda Terdekat
                            </button>
                        </div>

                        <div x-show="!isTodayActive">
                            <h4 class="text-white/40 text-2xl font-bold mb-2">Agenda tidak ditemukan</h4>
                            <p class="text-slate-400/50 text-sm mb-8 max-w-sm mx-auto">Kami tidak dapat menemukan agenda yang sesuai dengan kriteria pencarian Anda.</p>
                            <button @click="showAll()" class="text-[#274CA5] font-bold hover:text-lime-300 transition-colors uppercase text-xs tracking-widest">
                                Tampilkan Semua Agenda
                            </button>
                        </div>
                    </div>
                </div>

                </div> <!-- /Carousel Wrapper -->
            </div>

            <!-- Agenda Data (injected from PHP) -->
            @php
                $agendaJson = collect($agendaItems ?? [])->map(function($item, $i) {
                    return [
                        '_i' => $i,
                        '_ci' => $i % 3,
                        'title' => $item['title'] ?? '-',
                        'description' => $item['description'] ?? '-',
                        'date' => $item['date'] ?? '-',
                        'iso' => $item['iso'] ?? null,
                        'time' => $item['time'] ?? '-',
                        'hari' => $item['hari'] ?? '-',
                        'location' => $item['location'] ?? 'Mahakam Ulu',
                        'opd' => $item['opd'] ?? '-',
                        'day' => $item['day'] ?? '-',
                        'month' => $item['month'] ?? '-',
                    ];
                })->values()->toArray();
            @endphp
            <script>window.__agendaItems = @json($agendaJson);</script>
            <script>
                if (typeof window.agendaCarousel !== 'function') {
                    window.agendaCarousel = function () {
                        return {
                            items: Array.isArray(window.__agendaItems) ? window.__agendaItems : [],
                            filtered: [],
                            search: '',
                            searchDate: '',
                            isTodayActive: false,
                            isAllActive: true,
                            dragging: false,
                            dragStartX: 0,
                            dragStartTx: 0,
                            dragOffset: 0,
                            position: 0,
                            maxPos: 0,
                            totalDots: 1,
                            perView: 3,
                            cardW: 320,
                            gap: 16,
                            tx: 0,

                            init() {
                                this.filtered = [...this.items];
                                this.updateMetrics();
                                this.onSearch();
                                window.addEventListener('resize', () => {
                                    this.updateMetrics();
                                });
                            },

                            getTodayIso() {
                                var now = new Date();
                                var tzOffsetMs = now.getTimezoneOffset() * 60000;
                                return new Date(now.getTime() - tzOffsetMs).toISOString().slice(0, 10);
                            },

                            showToday() {
                                this.searchDate = this.getTodayIso();
                                this.isTodayActive = true;
                                this.isAllActive = false;
                                this.onSearch();
                            },

                            showAll() {
                                this.search = '';
                                this.searchDate = '';
                                this.isTodayActive = false;
                                this.isAllActive = true;
                                this.onSearch();
                            },

                            showNearest() {
                                var todayIso = this.getTodayIso();
                                var nearest = this.items
                                    .filter(item => item.iso && item.iso >= todayIso)
                                    .sort((a, b) => String(a.iso).localeCompare(String(b.iso)))[0];

                                if (nearest) {
                                    this.searchDate = nearest.iso;
                                    this.isTodayActive = false;
                                    this.isAllActive = false;
                                    this.onSearch();
                                } else {
                                    this.showAll();
                                }
                            },

                            onSearch() {
                                var q = (this.search || '').toLowerCase().trim();
                                var selectedDate = this.searchDate || '';

                                this.filtered = this.items.filter((item) => {
                                    var byText = !q || [
                                        item.title,
                                        item.description,
                                        item.location,
                                        item.date,
                                        item.time,
                                    ].join(' ').toLowerCase().includes(q);

                                    var byDate = !selectedDate || (item.iso === selectedDate);
                                    return byText && byDate;
                                });

                                if (!selectedDate && !q) {
                                    this.isAllActive = true;
                                    this.isTodayActive = false;
                                } else if (selectedDate === this.getTodayIso() && !q) {
                                    this.isTodayActive = true;
                                    this.isAllActive = false;
                                } else {
                                    this.isTodayActive = false;
                                    this.isAllActive = false;
                                }

                                this.position = 0;
                                this.dragOffset = 0;
                                this.updateMetrics();
                            },

                            updateMetrics() {
                                var wrap = this.$refs.wrap;
                                if (!wrap) return;

                                var w = wrap.clientWidth || 0;
                                if (w >= 1280) this.perView = 3;
                                else if (w >= 768) this.perView = 2;
                                else this.perView = 1;

                                var totalGap = this.gap * (this.perView - 1);
                                this.cardW = Math.max(220, (w - totalGap) / this.perView);
                                this.maxPos = Math.max(0, this.filtered.length - this.perView);
                                if (this.position > this.maxPos) this.position = this.maxPos;
                                this.totalDots = this.maxPos + 1;
                                this.tx = -(this.position * (this.cardW + this.gap)) + this.dragOffset;
                            },

                            cardTransform(idx) {
                                var delta = idx - this.position;
                                var scale = Math.max(0.92, 1 - Math.abs(delta) * 0.03);
                                return 'transform: translateZ(0) scale(' + scale.toFixed(3) + ');';
                            },

                            prev() {
                                this.position = Math.max(0, this.position - 1);
                                this.dragOffset = 0;
                                this.updateMetrics();
                            },

                            next() {
                                this.position = Math.min(this.maxPos, this.position + 1);
                                this.dragOffset = 0;
                                this.updateMetrics();
                            },

                            goTo(pos) {
                                this.position = Math.max(0, Math.min(this.maxPos, pos));
                                this.dragOffset = 0;
                                this.updateMetrics();
                            },

                            onDown(e) {
                                if (!this.filtered.length) return;
                                this.dragging = true;
                                this.dragStartX = e.touches ? e.touches[0].clientX : e.clientX;
                                this.dragStartTx = this.tx;
                            },

                            onMove(e) {
                                if (!this.dragging) return;
                                var x = e.touches ? e.touches[0].clientX : e.clientX;
                                this.dragOffset = x - this.dragStartX;
                                this.tx = this.dragStartTx + this.dragOffset;
                            },

                            onUp() {
                                if (!this.dragging) return;
                                this.dragging = false;

                                var step = this.cardW + this.gap;
                                var moved = -this.dragOffset / (step || 1);
                                var target = Math.round(this.position + moved);
                                this.position = Math.max(0, Math.min(this.maxPos, target));
                                this.dragOffset = 0;
                                this.updateMetrics();
                            },
                        };
                    };
                }
            </script>
        </section>
