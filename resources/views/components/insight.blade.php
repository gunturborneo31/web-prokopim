<section id="insight-section" class="relative overflow-hidden bg-[#10192B] text-[#e0e3e5]" style="font-family: Inter, sans-serif;">
    <style>
        #insight-section .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        #insight-section .grid-pattern {
            background-image: linear-gradient(rgba(163, 230, 53, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(163, 230, 53, 0.03) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        #insight-section .glass-card {
            background: rgba(29, 32, 34, 0.4);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        #insight-section .glass-card:hover {
            border-color: #274CA5;
            background: rgba(29, 32, 34, 0.7);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -20px rgba(163, 230, 53, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.1);
        }

        #insight-section .glow-lime {
            filter: drop-shadow(0 0 8px rgba(163, 230, 53, 0.5));
        }

        @keyframes insight-pulse-slow {
            0%, 100% {
                opacity: 0.2;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(1.1);
            }
        }

        #insight-section .animate-pulse-slow {
            animation: insight-pulse-slow 10s infinite ease-in-out;
        }

        #insight-section .circuit-line {
            position: absolute;
            background: linear-gradient(90deg, transparent, #274CA5, transparent);
            height: 1px;
            width: 100%;
            opacity: 0.1;
        }
    </style>

    <main class="grid-pattern relative w-full py-32 px-4 sm:px-6 lg:px-32">
        <div class="absolute right-0 top-0 -z-10 h-[500px] w-[500px] animate-pulse-slow rounded-full bg-lime-400/20 blur-[140px]"></div>
        <div class="absolute bottom-40 left-0 -z-10 h-96 w-96 animate-pulse-slow rounded-full bg-sky-300/10 blur-[120px]" style="animation-delay: -3s;"></div>

        <div class="mb-16 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="glass-card group relative flex h-44 flex-col justify-between overflow-hidden rounded-2xl p-6">
                <div class="circuit-line left-0 top-1/2 opacity-[0.05]"></div>
                <div class="relative z-10 flex items-center justify-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg border border-lime-400/20 bg-lime-400/10 transition-colors group-hover:border-lime-400/50">
                        <span class="material-symbols-outlined glow-lime text-2xl text-lime-400">terminal</span>
                    </div>
                    <h3 class="text-2xl font-black uppercase tracking-tight text-white">Berita Pemkab</h3>
                </div>
                <div class="relative z-10">
                    <div class="flex items-baseline gap-2">
                        <span class="tabular-nums text-3xl font-black tracking-tighter text-white">3,726</span>
                        <span class="text-2xl font-bold tracking-widest text-lime-400">+</span>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 rotate-12 scale-110 opacity-[0.03] transition-all duration-700 group-hover:opacity-[0.1]">
                    <span class="material-symbols-outlined text-[120px]">newspaper</span>
                </div>
            </div>

            <div class="glass-card group relative flex h-44 flex-col justify-between overflow-hidden rounded-2xl p-6">
                <div class="relative z-10 flex items-center justify-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg border border-sky-300/20 bg-sky-300/10 transition-colors group-hover:border-sky-300/50">
                        <span class="material-symbols-outlined text-2xl text-sky-300">sensors</span>
                    </div>
                    <h3 class="text-2xl font-black uppercase tracking-tight text-white">Galeri Foto</h3>
                </div>
                <div class="relative z-10">
                    <div class="flex items-baseline gap-2">
                        <span class="tabular-nums text-3xl font-black tracking-tighter text-white">5,188</span>
                        <span class="text-2xl font-bold tracking-widest text-sky-300/50">+</span>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 -rotate-12 opacity-[0.03] transition-all duration-700 group-hover:opacity-[0.1]">
                    <span class="material-symbols-outlined text-[120px]">photo_library</span>
                </div>
            </div>

            <div class="glass-card group relative flex h-44 flex-col justify-between overflow-hidden rounded-2xl p-6">
                <div class="relative z-10 flex items-center justify-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg border border-lime-400/20 bg-lime-400/10 transition-colors group-hover:border-lime-400/50">
                        <span class="material-symbols-outlined glow-lime text-2xl text-lime-400">stream</span>
                    </div>
                    <h3 class="text-2xl font-black uppercase tracking-tight text-white">Video Kegiatan</h3>
                </div>
                <div class="relative z-10">
                    <div class="flex items-baseline gap-2">
                        <span class="tabular-nums text-3xl font-black tracking-tighter text-white">249</span>
                        <span class="text-[10px] tracking-tight text-lime-400/40">+</span>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 rotate-45 opacity-[0.03] transition-all duration-700 group-hover:opacity-[0.1]">
                    <span class="material-symbols-outlined text-[120px]">smart_display</span>
                </div>
            </div>

            <div class="glass-card group relative flex h-44 flex-col justify-between overflow-hidden rounded-2xl p-6">
                <div class="relative z-10 flex items-center justify-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg border border-sky-300/20 bg-sky-300/10 transition-colors group-hover:border-sky-300/50">
                        <span class="material-symbols-outlined text-2xl text-sky-300">monitoring</span>
                    </div>
                    <h3 class="text-2xl font-black uppercase tracking-tight text-white">Infografis</h3>
                </div>
                <div class="relative z-10">
                    <div class="flex items-baseline gap-2">
                        <span class="tabular-nums text-3xl font-black tracking-tighter text-white">163</span>
                        <span class="text-2xl font-bold tracking-widest text-sky-300/30">+</span>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 scale-125 opacity-[0.03] transition-all duration-700 group-hover:opacity-[0.1]">
                    <span class="material-symbols-outlined text-[120px]">bar_chart</span>
                </div>
            </div>
        </div>

        <div class="mt-24">
            <div class="mb-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">
                <div class="flex items-center gap-6">
                    <img src="/images/logo_jdih.png" alt="JDIH Mahakam Ulu Logo">
                    <div>
                        <p class="opacity-60">Ingin Tau Produk Hukum Mahakam Ulu?</p>
                        <h2 class="mb-1 text-3xl font-bold tracking-tight text-white">JDIH Mahakam Ulu</h2>
                    </div>
                </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="glass-card group relative flex flex-col items-center gap-8 overflow-hidden rounded-3xl border border-white/10 p-8 sm:flex-row">

                    <div class="relative z-10 flex-1 text-center items-center justify-center ">
                        <h4 class="mb-2 text-2xl flex gap-2 items-center font-black tracking-tight text-white"> <span class="material-symbols-outlined glow-lime text-5xl text-lime-400" style="font-variation-settings: 'FILL' 1;">android</span> Versi Android</h4>
                        <button class="flex w-full items-center justify-center gap-3 rounded-xl bg-lime-400 px-6 py-3 text-sm font-bold uppercase tracking-tight text-lime-950 shadow-lg shadow-lime-400/20 transition-all duration-300 hover:bg-white hover:text-black sm:w-fit">
                            <span>Download APK</span>
                            <span class="material-symbols-outlined text-lg">download</span>
                        </button>
                    </div>

                    <div class="absolute -right-8 -top-8 opacity-[0.02] transition-opacity group-hover:opacity-[0.06]">
                        <span class="material-symbols-outlined text-[180px]">terminal</span>
                    </div>
                </div>

                <div class="glass-card group relative flex flex-col items-center gap-8 overflow-hidden rounded-3xl border border-white/10 p-8 sm:flex-row">

                    <div class="relative z-10 flex-1 text-center items-center justify-center ">
                        <h4 class="mb-2 text-2xl flex gap-2 items-center font-black tracking-tight text-white"><span class="material-symbols-outlined text-5xl text-sky-300" style="font-variation-settings: 'FILL' 1;">public</span> Website JDIH</h4>
                        <button class="flex w-full items-center justify-center gap-3 rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-bold uppercase tracking-tight text-white transition-all duration-300 hover:border-sky-300 hover:bg-sky-300 hover:text-slate-950 sm:w-fit">
                            <span>Kunjungi Web</span>
                            <span class="material-symbols-outlined text-lg">open_in_new</span>
                        </button>
                    </div>

                    <div class="absolute -right-8 -top-8 opacity-[0.02] transition-opacity group-hover:opacity-[0.06]">
                        <span class="material-symbols-outlined text-[180px]">dns</span>
                    </div>
                </div>
            </div>
            </div>

        
        </div>
    </main>

    <script>
        (function () {
            var section = document.getElementById('insight-section');
            if (!section || section.dataset.counterReady === '1') return;

            section.dataset.counterReady = '1';
            var counters = section.querySelectorAll('.tabular-nums');

            function animateCounter(el) {
                var text = (el.innerText || '').replace(/[+,]/g, '');
                var target = parseInt(text, 10);
                if (isNaN(target)) return;

                var current = 0;
                var duration = 2500;
                var stepTime = 20;
                var increment = target / (duration / stepTime);

                var timer = setInterval(function () {
                    current += increment;
                    if (current >= target) {
                        el.innerText = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        el.innerText = Math.floor(current).toLocaleString();
                    }
                }, stepTime);
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            counters.forEach(function (counter) {
                observer.observe(counter);
            });
        })();
    </script>
</section>
