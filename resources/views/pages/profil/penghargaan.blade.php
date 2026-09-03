<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/desamahakamulu.jpg') }}"
                     alt="Mahakam Ulu" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="Background SVG"
                 class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
    
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="riverGoldPenghargaan" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldPenghargaan)" stroke-width="2"/>
            </svg>
        </div>

        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#9ae600]"></span>
                    </div>
                    Profil Instansi
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">
                    Peng<span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">hargaan</span>
                </h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">
                    Rekam jejak prestasi dan penghargaan yang diraih oleh PROKOPIM Kabupaten Mahakam Ulu.
                </p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-[#274CA5]">Penghargaan</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ===================== PAGE CONTENT ===================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">

        {{-- Section Header --}}
        <div class="flex items-center gap-3 mb-10" data-aos="fade-up">
            <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full"></div>
            <h2 class="text-2xl font-bold text-slate-800">Daftar Penghargaan</h2>
        </div>

        {{-- Award Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="100">
            @foreach([
                ['tahun' => '2024', 'judul' => 'Penghargaan Perencanaan Terbaik', 'pemberi' => 'Bappenas RI', 'level' => 'Nasional', 'color' => 'yellow', 'file' => asset('images/pengumuman-calon-penerima-gratispol-untuk-mahasiswa-perguruan-tinggi-swasta-pts-dalam-kaltim-tahun-2026-tahap-2.pdf')],
                ['tahun' => '2023', 'judul' => 'Inovasi Pelayanan Publik Terbaik', 'pemberi' => 'Kemenpan-RB RI', 'level' => 'Nasional', 'color' => 'sky', 'file' => asset('images/pengumuman-calon-penerima-gratispol-untuk-mahasiswa-perguruan-tinggi-swasta-pts-dalam-kaltim-tahun-2026-tahap-2.pdf')],
                ['tahun' => '2023', 'judul' => 'E-Planning Terinovatif', 'pemberi' => 'Pemerintah Provinsi Kaltim', 'level' => 'Provinsi', 'color' => 'emerald', 'file' => asset('images/pengumuman-calon-penerima-gratispol-untuk-mahasiswa-perguruan-tinggi-swasta-pts-dalam-kaltim-tahun-2026-tahap-2.pdf')],
            ] as $award)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-{{ $award['color'] }}-100 flex items-center justify-center text-{{ $award['color'] }}-600 group-hover:bg-{{ $award['color'] }}-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-600">{{ $award['tahun'] }}</span>
                </div>
                <h3 class="font-bold text-slate-800 text-lg mb-1 group-hover:text-{{ $award['color'] }}-600 transition-colors">{{ $award['judul'] }}</h3>
                <p class="text-slate-500 text-sm mb-4">{{ $award['pemberi'] }}</p>
                <div class="flex items-center justify-between mb-5">
                    <span class="inline-flex items-center gap-1 text-xs font-bold px-3 py-1 rounded-full bg-{{ $award['color'] }}-50 text-{{ $award['color'] }}-700 border border-{{ $award['color'] }}-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-{{ $award['color'] }}-500"></span>
                        {{ $award['level'] }}
                    </span>
                </div>
                {{-- Action Buttons --}}
                <div class="flex items-center gap-2 pt-4 border-t border-slate-100 mt-2">
                    <button type="button" onclick="openPdfModal('{{ $award['file'] }}', '{{ addslashes($award['judul']) }}')" class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-slate-50 text-slate-600 text-xs font-bold hover:bg-sky-500 hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat
                    </button>
                    <a href="{{ $award['file'] }}" download="{{ \Illuminate\Support\Str::slug($award['judul']) }}.pdf" class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-slate-50 text-slate-600 text-xs font-bold hover:bg-slate-800 hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>

    {{-- PDF Modal --}}
    <div id="pdfModal" class="fixed inset-0 z-[100] hidden bg-[#274CA5]/95 backdrop-blur-sm p-4 sm:p-6 lg:p-8 flex items-center justify-center transition-all duration-300 opacity-0 data-[state=open]:opacity-100" data-state="closed">
        {{-- Close Modal Overlay Background --}}
        <div class="absolute inset-0 z-[105]" onclick="closePdfModal()"></div>
        
        {{-- Close Button --}}
        <button type="button" onclick="closePdfModal()" class="absolute top-4 right-4 sm:top-6 sm:right-6 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 hover:scale-110 rounded-full p-2.5 transition-all duration-300 z-[115] shadow-lg">
            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- PDF Container --}}
        <div class="relative w-full h-full max-w-5xl flex flex-col items-center justify-center bg-slate-800 rounded-xl overflow-hidden shadow-2xl ring-1 ring-white/10 z-[110] transform scale-95 data-[state=open]:scale-100 transition-transform duration-300">
            <!-- Modal Header -->
            <div class="w-full bg-[#274CA5] border-b borderwhite/10 flex items-center justify-between px-4 py-3 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-yellow-500/20 rounded-lg text-[#274CA5]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span id="pdfModalTitle" class="font-semibold text-white truncate max-w-[200px] sm:max-w-md">Preview Dokumen</span>
                </div>
                <a id="pdfDownloadBtn" href="#" download class="hidden sm:flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-400 text-white text-sm font-bold rounded-lg transition-colors shadow-lg shadow-sky-500/20">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download PDF
                </a>
            </div>
            <!-- Iframe -->
            <iframe id="pdfViewer" src="" class="w-full flex-1 border-0 bg-white" title="PDF Viewer"></iframe>
        </div>
    </div>

    <script>
        function openPdfModal(fileUrl, title) {
            const modal = document.getElementById('pdfModal');
            const viewer = document.getElementById('pdfViewer');
            const titleEl = document.getElementById('pdfModalTitle');
            const downloadBtn = document.getElementById('pdfDownloadBtn');
            const container = modal.querySelector('.relative');
            
            viewer.src = fileUrl;
            titleEl.textContent = title || 'Preview Dokumen';
            downloadBtn.href = fileUrl;
            downloadBtn.download = title ? title + '.pdf' : 'Download.pdf';
            
            modal.classList.remove('hidden');
            // Small timeout to allow browser to render block before fading in
            setTimeout(() => {
                modal.dataset.state = 'open';
                container.dataset.state = 'open';
            }, 10);
            
            document.body.style.overflow = 'hidden';
        }

        function closePdfModal() {
            const modal = document.getElementById('pdfModal');
            const viewer = document.getElementById('pdfViewer');
            const container = modal.querySelector('.relative');
            
            modal.dataset.state = 'closed';
            container.dataset.state = 'closed';
            
            // Wait for transition to finish
            setTimeout(() => {
                modal.classList.add('hidden');
                viewer.src = '';
                document.body.style.overflow = '';
            }, 300);
        }
    </script>
</x-layouts.app>

