 {{-- S8: SOSIAL MEDIA --}}
    <section class="relative bg-slate-50 py-20 lg:py-28 overflow-hidden reveal border-t border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-32 max-w-7xl relative z-10">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">

                {{-- Kiri: Instagram Embed --}}
                <div class="w-full lg:w-[55%] flex flex-col">
                    <div class="mb-8">
                        <span
                            class="inline-block px-4 py-1.5 bg-[#10192B] text-[#ffffff] text-[10px] font-black rounded-full mb-4 tracking-[0.2em] uppercase font-heading">Instagram</span>
                        <h2
                            class="text-3xl md:text-4xl font-black text-[#274CA5] font-heading tracking-tighter uppercase leading-none">
                            IKUTI KAMI DI <span
                                class="text-transparent bg-clip-text bg-[#1e48aa]">INSTAGRAM</span>
                        </h2>
                        <div class="w-16 h-1.5 bg-[#1e48aa] rounded-full mt-4"></div>
                    </div>

                    {{-- Instagram Embed Widget --}}
                    <div class="w-full relative rounded-[2rem] shadow-2xl bg-white overflow-hidden">
                        {{-- Overlay border (Frame) untuk menutupi garis kotak tajam bawaan IG --}}
                        <div
                            class="absolute inset-0 border-[12px] md:border-[16px] border-white rounded-[2rem] pointer-events-none z-10">
                        </div>

                        {{-- Patch putih untuk menutupi logo IG yang terpotong di ujung kanan atas --}}
                        <div class="absolute top-0 right-0 w-20 h-20 bg-white z-20 rounded-bl-3xl"></div>

                        <div class="w-full h-full p-0 m-0">
                            <blockquote class="instagram-media w-full !m-0"
                                data-instgrm-permalink="https://www.instagram.com/pemkab_mahulu/" data-instgrm-version="14"
                                style="background:#FFF;border:0;border-radius:0;box-shadow:none;margin:0;max-width:100%;min-width:100%;padding:0;width:100%;">
                            </blockquote>
                            <script async src="//www.instagram.com/embed.js"></script>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Daftar Sosmed --}}
                <div class="w-full lg:w-[45%] flex flex-col">
                    <div class="mb-8">
                        <span
                            class="inline-block px-4 py-1.5 bg-primary-light text-primary text-[10px] font-black rounded-full mb-4 tracking-[0.2em] uppercase font-heading">Temukan
                            Kami</span>
                        <h2
                            class="text-3xl md:text-4xl font-black text-[#274CA5] font-heading tracking-tighter uppercase leading-none">
                            MEDIA <span class="text-[#1e48aa]">SOSIAL</span>
                        </h2>
                    </div>

                    <div class="flex flex-col gap-4">
                        {{-- Instagram --}}
                        <a href="https://www.instagram.com/pemkab_mahulu/" target="_blank" rel="noopener"
                            class="ui-social-btn group flex items-center gap-5 bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:border-pink-200">
                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 shadow-lg shadow-pink-200">
                                <svg class="ui-social-icon w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5 font-heading">
                                    Instagram</p>
                                <h4
                                    class="font-heading font-black text-slate-800 text-base group-hover:text-pink-600 transition-colors truncate">
                                    @pemkab_mahulu</h4>
                                <p class="text-xs text-slate-500 font-body mt-0.5">Foto & Info Kegiatan</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-pink-500 group-hover:translate-x-1 transition-all shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>

                        {{-- Facebook --}}
                        <a href="https://www.facebook.com/pemkabmahakamulu" target="_blank" rel="noopener"
                            class="ui-social-btn group flex items-center gap-5 bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:border-blue-200">
                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 bg-[#1877F2] shadow-lg shadow-blue-200">
                                <svg class="ui-social-icon w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5 font-heading">
                                    Facebook</p>
                                <h4
                                    class="font-heading font-black text-slate-800 text-base group-hover:text-blue-600 transition-colors truncate">
                                    Prokopim Mahulu</h4>
                                <p class="text-xs text-slate-500 font-body mt-0.5">Berita & Pengumuman</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>

                        {{-- YouTube --}}
                        <a href="https://www.youtube.com/@prokopimmahulu/videos" target="_blank" rel="noopener"
                            class="ui-social-btn group flex items-center gap-5 bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:border-red-200">
                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 bg-[#FF0000] shadow-lg shadow-red-200">
                                <svg class="ui-social-icon w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5 font-heading">
                                    YouTube</p>
                                <h4
                                    class="font-heading font-black text-slate-800 text-base group-hover:text-red-600 transition-colors truncate">
                                    PEMERINTAH KABUPATEN MAHAKAM ULU</h4>
                                <p class="text-xs text-slate-500 font-body mt-0.5">Dokumentasi Pimpinan</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-red-500 group-hover:translate-x-1 transition-all shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>

                        {{-- Twitter / X --}}
                        <a href="https://x.com/pemkabmahulu" target="_blank" rel="noopener"
                            class="ui-social-btn group flex items-center gap-5 bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:border-slate-300">
                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 bg-black shadow-lg shadow-slate-200">
                                <svg class="ui-social-icon w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5 font-heading">
                                    X (Twitter)</p>
                                <h4
                                    class="font-heading font-black text-slate-800 text-base group-hover:text-[#274CA5] transition-colors truncate">
                                    @pemkabmahulu</h4>
                                <p class="text-xs text-slate-500 font-body mt-0.5">Info & Update Real-time</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-slate-700 group-hover:translate-x-1 transition-all shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>

                        {{-- TikTok --}}
                        <a href="https://www.tiktok.com/@pemkab.mahulu" target="_blank" rel="noopener"
                            class="ui-social-btn group flex items-center gap-5 bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:border-slate-300">
                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 bg-black shadow-lg shadow-slate-200">
                                <svg class="ui-social-icon w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5 font-heading">
                                    TikTok</p>
                                <h4
                                    class="font-heading font-black text-slate-800 text-base group-hover:text-[#274CA5] transition-colors truncate">
                                    @pemkab.mahulu</h4>
                                <p class="text-xs text-slate-500 font-body mt-0.5">Konten Edukasi</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-slate-700 group-hover:translate-x-1 transition-all shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
