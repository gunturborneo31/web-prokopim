<!-- LAYANAN UTAMA SECTION (dari reference/section/layanan.html) -->
<section class="relative isolate min-h-screen py-16 md:py-24 overflow-hidden bg-[#274CA5] flex items-center">
    <!-- Full Bleed Background -->
    <div class="absolute inset-0 -z-20 bg-[#274CA5]"></div>
    <div class="absolute inset-0 -z-10 bg-center bg-cover bg-no-repeat opacity-35" style="background-image: url('{{ asset('images/background-layanan.png') }}');"></div>
    
    <div class="absolute left-1/2 top-[-18%] -z-10 h-[420px] w-[420px] -translate-x-1/2 rounded-full bg-[#274CA5]/12 blur-[120px]"></div>
    <div class="absolute bottom-[-16%] right-[-6%] -z-10 h-[360px] w-[360px] rounded-full bg-[#34d399]/10 blur-[120px]"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10 w-full">
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="font-montserrat font-black text-4xl md:text-5xl leading-tight text-white mb-4 drop-shadow-[0_0_18px_rgba(15,23,42,0.28)]">
                Layanan Utama
            </h2>
            <p class="text-white/90 text-lg font-medium">Layanan unggulan dari Protokol dan Komunikasi Pimpinan</p>
        </div>

        <!-- Layout Layanan Utama (Bento Grid Style) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto lg:px-8 xl:px-16">
            <!-- Card 1: Layanan Keprotokolan -->
            <div class="glass-card group relative overflow-hidden rounded-[32px] p-8 flex flex-col justify-between h-[240px]">
                <div class="relative z-10">
                    <span class="material-symbols-outlined absolute -top-6 -right-6 text-[11rem] md:text-[12rem] opacity-30 blur-[1px] -z-10 transition-all duration-500 group-hover:opacity-60 group-hover:scale-110 text-[#274CA5]">shield</span>
                    <h3 class="font-montserrat font-black text-3xl uppercase text-[#123c8b] mb-3">Layanan<br>Keprotokolan</h3>
                </div>
                    <div class="relative z-20 mt-auto">
                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <span class="inline-flex items-center font-bold gap-2 text-[#274CA5]">
                                Buka <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </span>
                        </div>
                    </div>
                <div class="absolute  opacity-20 group-hover:opacity-40 transition-opacity duration-500 left-0 bottom-0">
                    <img alt="Protokol" class="slanted-image rounded-2xl grayscale hover:grayscale-0 transition-all duration-700 w-full h-full object-cover" src="/images/protokol.png" />
                </div>
            </div>

            <!-- Card 2: Layanan Kopim -->
            <div class="glass-card group relative overflow-hidden rounded-[32px] p-8 flex flex-col justify-between h-[240px]">
                <div class="relative z-10">
                    <span class="material-symbols-outlined absolute -top-6 -right-6 text-[11rem] md:text-[12rem] opacity-30 blur-[1px] -z-10 transition-all duration-500 group-hover:opacity-60 group-hover:scale-110 text-[#274CA5]">campaign</span>
                    <h3 class="font-montserrat font-black text-3xl uppercase text-[#123c8b] mb-3">Layanan<br>Kopim</h3>
                </div>
                <div class="relative z-20 mt-auto">
                    <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <span class="inline-flex items-center font-bold gap-2" style="text-[#123C8B];">
                            Buka <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </span>
                    </div>
                </div>
                <div class="absolute  opacity-20 group-hover:opacity-40 transition-opacity duration-500 left-0 bottom-0">
                    <img alt="Kopim" class="slanted-image rounded-2xl grayscale hover:grayscale-0 transition-all duration-700 w-full h-full object-cover" src="/images/kopim.png" />
                </div>
            </div>

            <!-- Card 3: Layanan Dokpim -->
            <div class="glass-card group relative overflow-hidden rounded-[32px] p-8 flex flex-col justify-between h-[240px]">
                <div class="relative z-10">
                    <span class="material-symbols-outlined absolute -top-6 -right-6 text-[11rem] md:text-[12rem] opacity-30 blur-[1px] -z-10 transition-all duration-500 group-hover:opacity-60 group-hover:scale-110 text-[#274CA5]">description</span>
                    <h3 class="font-montserrat font-black text-3xl uppercase text-[#123c8b] mb-3">Layanan<br>Dokpim</h3>
                </div>
                <div class="relative z-20 mt-auto">
                    <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <span class="inline-flex items-center font-bold gap-2" style="text-[#123C8B];">
                            Buka <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </span>
                    </div>
                </div>
                <div class="absolute  opacity-20 group-hover:opacity-40 transition-opacity duration-500 left-0 bottom-0">
                    <img alt="Dokpim" class="slanted-image rounded-2xl grayscale hover:grayscale-0 transition-all duration-700 w-full h-full object-cover" src="/images/dokpim.png" />
                </div>
            </div>
        </div>
    </div>

    <style>
        .gradient-overlay {
            background: linear-gradient(180deg, #274CA5 0%, #f8fbff 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(39, 76, 165, 0.16);
            box-shadow: 0 10px 30px -12px rgba(15, 23, 42, 0.16);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.97);
            transform: translateY(-8px);
            border-color: rgba(39, 76, 165, 0.35);
            box-shadow: 0 20px 35px -15px rgba(39, 76, 165, 0.28);
        }

        .slanted-image {
            
        }
    </style>
</section>
