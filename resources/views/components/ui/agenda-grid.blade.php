@props(['mode' => 'demo'])

{{-- 
    Komponen Agenda dengan State Management (Loading, Data, Empty)
    Mode 'demo' akan menjalankan statik timeout untuk demonstrasi loading -> data -> empty.
--}}
<div x-data="agendaStateManager('{{ $mode }}')" class="w-full max-w-6xl mx-auto py-8">
    
    {{-- Mode Toggle (Hanya untuk Demo) --}}
    <div x-show="isDemo" class="mb-8 flex justify-center gap-4 bg-slate-100 p-4 rounded-xl border border-slate-200">
        <button @click="setLoading()" class="btn-secondary text-sm py-2 px-4 shadow-none">Uji Loading</button>
        <button @click="setData()" class="btn-primary text-sm py-2 px-4 shadow-none">Uji Data</button>
        <button @click="setEmpty()" class="btn-secondary text-sm py-2 px-4 shadow-none">Uji Kosong</button>
    </div>

    {{-- 1. LOADING STATE (Skeleton) --}}
    <div x-show="state === 'loading'" x-transition.opacity.duration.300ms class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="i in 6" :key="i">
            <div class="card-base p-0 overflow-hidden">
                <!-- Skeleton Image Area -->
                <div class="h-48 bg-slate-200 animate-pulse w-full"></div>
                
                <div class="p-6">
                    <!-- Skeleton Date Badge -->
                    <div class="h-6 bg-slate-200 rounded-full w-1/4 mb-4 animate-pulse"></div>
                    
                    <!-- Skeleton Title lines -->
                    <div class="h-5 bg-slate-300 rounded w-3/4 mb-2 animate-pulse"></div>
                    <div class="h-5 bg-slate-300 rounded w-1/2 mb-6 animate-pulse"></div>
                    
                    <!-- Skeleton Description lines -->
                    <div class="h-3 bg-slate-200 rounded w-full mb-2 animate-pulse"></div>
                    <div class="h-3 bg-slate-200 rounded w-full mb-2 animate-pulse"></div>
                    <div class="h-3 bg-slate-200 rounded w-4/5 animate-pulse"></div>
                </div>
            </div>
        </template>
    </div>

    {{-- 2. DATA STATE (Grid Agenda) --}}
    <div x-show="state === 'data'" x-cloak x-transition.opacity.duration.500ms class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="agenda in items" :key="agenda.id">
            <div class="card-base flex flex-col overflow-hidden group cursor-pointer">
                <!-- Image/Color Banner -->
                <div class="h-48 bg-slate-100 relative overflow-hidden">
                    <img :src="agenda.image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Cover Agenda">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#274CA5]/60 to-transparent"></div>
                    
                    <!-- Floating Date Badge -->
                    <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-md text-primary font-bold px-3 py-1.5 rounded-lg text-sm shadow-sm flex flex-col items-center leading-tight">
                        <span x-text="agenda.date.day" class="text-xl font-black"></span>
                        <span x-text="agenda.date.month" class="text-[10px] uppercase tracking-wider"></span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-bold text-lg text-slate-800 mb-3 group-hover:text-primary transition-colors line-clamp-2" x-text="agenda.title"></h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-1" x-text="agenda.description"></p>
                    
                    <div class="flex items-center text-xs font-semibold text-slate-400 mt-auto pt-4 border-t border-slate-100">
                        <svg class="w-4 h-4 mr-1.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span x-text="agenda.time"></span>
                        <span class="mx-3 border-l border-slate-300 h-3"></span>
                        <svg class="w-4 h-4 mr-1.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span x-text="agenda.location" class="truncate max-w-[120px]"></span>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- 3. EMPTY STATE (Tidak Ada Data) --}}
    <div x-show="state === 'empty'" x-cloak x-transition.opacity.duration.300ms class="card-base max-w-2xl mx-auto p-12 text-center flex flex-col items-center justify-center border-dashed border-2 border-slate-200 bg-slate-50">
        <!-- Kalender Kosong Icon / Animasi ringan -->
        <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-sm mb-6 border border-slate-100">
            <svg class="w-12 h-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum ada agenda bulan ini</h3>
        <p class="text-slate-500 mb-8 max-w-sm">Jadwal kegiatan atau acara belum tersedia untuk saat ini. Silakan periksa kembali nanti untuk melihat pembaruan.</p>
        
        <a href="/" class="btn-secondary">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('agendaStateManager', (mode) => ({
            state: 'loading', // 'loading', 'data', 'empty'
            isDemo: mode === 'demo',
            items: [],
            
            // Dummy Data
            dummyData: [
                { id: 1, title: 'Rapat Paripurna DPRD Mengenai APBD 2026', description: 'Pembahasan rancangan awal Anggaran Pendapatan dan Belanja Daerah Kabupaten Mahakam Ulu tahun anggaran 2026.', date: { day: '14', month: 'Aug' }, time: '09:00 WITA', location: 'Gedung DPRD Mahulu', image: 'https://images.unsplash.com/photo-1577962917302-cd874462e648?q=80&w=600&auto=format&fit=crop' },
                { id: 2, title: 'Sosialisasi E-Planning untuk OPD', description: 'Pelatihan dan sosialisasi penggunaan sistem E-Planning terbaru untuk seluruh perwakilan Organisasi Perangkat Daerah.', date: { day: '22', month: 'Aug' }, time: '13:00 WITA', location: 'Ruang Rapat PROKOPIM', image: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=600&auto=format&fit=crop' },
                { id: 3, title: 'Kunjungan Kerja Kementerian Perencanaan', description: 'Monitoring evaluasi proyek strategis nasional di wilayah perbatasan Mahakam Ulu oleh tim kementerian.', date: { day: '05', month: 'Sep' }, time: '10:00 WITA', location: 'Kantor Bupati', image: 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=600&auto=format&fit=crop' }
            ],

            init() {
                if (this.isDemo) {
                    // Demo sequence
                    setTimeout(() => {
                        this.setData();
                    }, 2000);
                } else {
                    // In real app, call your API here
                    this.fetchData();
                }
            },

            // Metode Demo State
            setLoading() {
                this.state = 'loading';
                this.items = [];
            },
            
            setData() {
                this.state = 'loading'; // Show skeleton briefly for transition
                setTimeout(() => {
                    this.items = this.dummyData;
                    this.state = 'data';
                }, 800);
            },
            
            setEmpty() {
                this.state = 'loading';
                setTimeout(() => {
                    this.items = [];
                    this.state = 'empty';
                }, 800);
            },

            // Metode API Simulation
            async fetchData() {
                this.state = 'loading';
                try {
                    // const response = await fetch('/api/agendas');
                    // const data = await response.json();
                    
                    // Simulate API Delay
                    await new Promise(r => setTimeout(r, 1500));
                    
                    if (this.dummyData.length > 0) {
                        this.items = this.dummyData;
                        this.state = 'data';
                    } else {
                        this.state = 'empty';
                    }
                } catch (error) {
                    this.state = 'empty';
                    console.error("Gagal memanggil data agenda", error);
                }
            }
        }));
    });
</script>
