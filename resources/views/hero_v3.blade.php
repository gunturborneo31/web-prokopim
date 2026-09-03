        <!-- INLINE CSS TO ENSURE VISIBILITY REGARDLESS OF BUILD PROCESS -->
        <style>
            .mask-talawang-inline {
                clip-path: polygon(50% 0%, 100% 10%, 90% 85%, 50% 100%, 10% 85%, 0% 10%);
                transition: clip-path 0.5s ease-in-out;
            }
            .group:hover .mask-talawang-inline-hover {
                clip-path: polygon(50% 0%, 100% 5%, 95% 90%, 50% 100%, 5% 90%, 0% 5%);
            }
            .pattern-dayak-inline {
                background-color: #7f1d1d;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23F59E0B' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>

        <section class="relative min-h-screen flex flex-col pt-24 pb-12 overflow-hidden bg-instansi-surface">
            <!-- Decorative Background -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <!-- Ambient blur orbs -->
                <div class="absolute top-0 left-0 w-[600px] h-[600px] rounded-full bg-slate-100/40 blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full bg-instansi-action/10 blur-[100px] translate-x-1/3 translate-y-1/3"></div>
                
                <!-- Dayak Corner Ornament (Top Left) -->
                <svg class="absolute top-0 left-0 w-32 h-32 text-[#274CA5]/20" viewBox="0 0 100 100" fill="currentColor">
                    <path d="M0 0 L100 0 L100 20 L20 20 L20 100 L0 100 Z" />
                    <path d="M5 5 L95 5 L95 15 L15 15 L15 95 L5 95 Z" fill="none" stroke="currentColor" stroke-width="2"/>
                </svg>
                <!-- Dayak Corner Ornament (Top Right) -->
                <svg class="absolute top-0 right-0 w-32 h-32 text-[#274CA5]/20 rotate-90" viewBox="0 0 100 100" fill="currentColor">
                    <path d="M0 0 L100 0 L100 20 L20 20 L20 100 L0 100 Z" />
                </svg>

                <!-- 2. AMPLIFIED PATTERN OPACITY (0.025 -> 0.1) -->
                <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="dayakMotifV3" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                            <path d="M30 0L60 30L30 60L0 30Z" fill="none" stroke="currentColor" stroke-width="1"/>
                            <path d="M30 10L50 30L30 50L10 30Z" fill="none" stroke="currentColor" stroke-width="1"/>
                            <circle cx="30" cy="30" r="4" fill="currentColor"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#dayakMotifV3)" class="text-instansi-text-muted"/>
                </svg>

                <!-- River flow SVG curves -->
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 800" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- (Kept existing river gradients) -->
                    <defs>
                        <linearGradient id="riverGold1v3" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                            <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                            <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <path d="M-50,350 C200,280 400,450 720,320 S1100,200 1500,380" fill="none" stroke="url(#riverGold1v3)" stroke-width="2" class="river-line"/>
                </svg>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10 flex-1 flex flex-col justify-center py-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                    <!-- Text Content (6 cols) -->
                    <div class="lg:col-span-6 space-y-10">

                        <div data-aos="fade-right" data-aos-delay="200" class="space-y-2">
                            <h1 class="font-montserrat font-medium text-slate-300 text-3xl sm:text-4xl lg:text-[2.5rem] tracking-tight">
                                Selamat Datang di
                            </h1>
                            <div class="space-y-0">
                                <span class="block font-montserrat font-black text-4xl sm:text-6xl lg:text-[4rem] text-instansi-text-main leading-[0.9] tracking-tight">
                                    PROKOPIM
                                </span>
                                <span class="block font-montserrat font-black text-4xl sm:text-6xl lg:text-[4rem] text-transparent bg-clip-text leading-[1.05] tracking-tight" style="background-image: linear-gradient(135deg, #10192d 0%, #D97706 60%, #92400E 100%); filter: drop-shadow(0 4px 20px rgba(251, 191, 36,0.15));">
                                    MAHAKAM ULU
                                </span>
                            </div>
                        </div>

                        <p data-aos="fade-right" data-aos-delay="300" class="text-instansi-text-muted text-base sm:text-lg leading-relaxed max-w-lg font-medium pl-6 border-l-4 border-[#274CA5]">
                            Merajut perencanaan pembangunan yang <span class="text-instansi-text-main font-semibold">Inovatif</span> dan <span class="text-instansi-text-main font-semibold">Berkelanjutan</span>, berbasis kearifan lokal Dayak dan kekayaan alam Kalimantan.
                        </p>

                        <div data-aos="fade-up" data-aos-delay="400" class="flex flex-wrap gap-5 pt-4">
                            <a href="#layanan" class="group relative px-8 py-4 rounded-full font-bold text-sm shadow-2xl shadow-[#274CA5]/20 overflow-hidden transition-all hover:scale-[1.02] hover:-translate-y-1" style="background: linear-gradient(135deg, #B45309, #78350F); color: #FFF;">
                                <span class="relative flex items-center justify-center gap-3">
                                    Jelajahi Layanan
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Hero Image Card (6 cols) -->
                    <!-- 3. REMOVED HIDDEN CLASS to force display -->
                    <div class="lg:col-span-6 relative block" data-aos="fade-left" data-aos-delay="300">
                        <div class="relative group w-full max-w-md mx-auto aspect-[4/5]">
                            <!-- Glow effect behind shield -->
                            <div class="absolute inset-0 bg-[#274CA5]/20 blur-[60px] rounded-full mask-talawang-inline transform scale-90 translate-y-4"></div>

                            <!-- Border Frame (Gold) -->
                            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5] via-orange-600 to-rose-900 mask-talawang-inline p-[4px]">
                                <!-- Main Image Container -->
                                <div class="w-full h-full bg-instansi-surface mask-talawang-inline relative overflow-hidden group-hover:mask-talawang-inline-hover transition-all duration-500">
                                    <div class="absolute inset-0 shimmer-bg z-10"></div>
                                    <img src="https://images.unsplash.com/photo-1596005554384-d293674c91d7?q=80&w=800&auto=format&fit=crop"
                                         alt="Hutan dan Sungai Kalimantan"
                                         class="w-full h-full object-cover transform scale-110 group-hover:scale-100 transition-transform duration-1000"
                                         loading="lazy">
                                    
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 z-20 bg-gradient-to-t from-navy-dark/90 via-navy/20 to-transparent"></div>
                                    
                                    <!-- Inner Border pattern (MORE VISIBLE) -->
                                    <div class="absolute inset-0 z-30 opacity-60 pointer-events-none border-[12px] border-transparent" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M0 0h20v20H0V0zm10 17l-7-7 7-7 7 7-7 7z\' fill=\'%23F59E0B\' fill-opacity=\'0.4\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor; mask-composite: exclude;"></div>

                                    <!-- Location Label -->
                                    <div class="absolute bottom-10 left-0 right-0 text-center z-30">
                                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-black/40 backdrop-blur-md border border-white/10">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                            <span class="text-xs font-bold text-green-300 uppercase tracking-widest">Ujoh Bilang</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Stats Bar (Re-included) -->
                <div class="mt-12 lg:mt-24 relative z-20" data-aos="fade-up" data-aos-delay="500">
                    <div class="rounded-2xl p-1" style="background: linear-gradient(135deg, rgba(251, 191, 36,0.3), rgba(184,193,236,0.1), rgba(251, 191, 36,0.2)); box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
                        <div class="rounded-[0.875rem] bg-white/95 backdrop-blur-xl py-6 px-4 sm:px-8 border border-white/5">
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                                <!-- Stat 1 -->
                                <div class="text-center group">
                                    <div class="flex items-center justify-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-instansi-action/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-instansi-action" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <span class="font-montserrat font-bold text-2xl md:text-3xl text-instansi-text-main block leading-none">256</span>
                                            <span class="text-instansi-text-muted/60 text-xs font-medium uppercase tracking-wider mt-0.5 block">Proyek Selesai</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Stat 2 -->
                                <div class="text-center group">
                                    <div class="flex items-center justify-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-green-400/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <span class="font-montserrat font-bold text-2xl md:text-3xl text-instansi-text-main block leading-none">15</span>
                                            <span class="text-instansi-text-muted/60 text-xs font-medium uppercase tracking-wider mt-0.5 block">OPD Terlayani</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Stat 3 -->
                                <div class="text-center group">
                                    <div class="flex items-center justify-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-200/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-instansi-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <span class="font-montserrat font-bold text-2xl md:text-3xl text-instansi-text-main block leading-none">1,847</span>
                                            <span class="text-instansi-text-muted/60 text-xs font-medium uppercase tracking-wider mt-0.5 block">Dokumen Publik</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Stat 4 -->
                                <div class="text-center group">
                                    <div class="flex items-center justify-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-instansi-action/10 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-instansi-action" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <span class="font-montserrat font-bold text-2xl md:text-3xl text-instansi-text-main block leading-none">Rp 1.2T</span>
                                            <span class="text-instansi-text-muted/60 text-xs font-medium uppercase tracking-wider mt-0.5 block">Anggaran Dikelola</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. AMPLIFIED BOTTOM STRIP (h-8 -> h-16 + Border) -->
            <div class="absolute bottom-0 left-0 w-full h-16 z-20 pattern-dayak-inline border-t-4 border-[#274CA5] shadow-[0_-10px_40px_rgba(0,0,0,0.5)]"></div>
        </section>

