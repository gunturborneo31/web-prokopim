        <!-- ============================================ -->
        <!-- SECTION 6: MASUKAN & SARAN & SOSIAL MEDIA    -->
        <!-- ============================================ -->
        <!-- ============================================ -->
        <!-- SECTION 6: MASUKAN & SARAN & SOSIAL MEDIA    -->
        <!-- ============================================ -->
        <section class="py-24 relative bg-[#060b19] overflow-hidden">
            <!-- Animated Mesh Gradient Background Orbs -->
            <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] bg-[#3255AA]/20 rounded-full blur-[120px] mix-blend-screen animate-pulse" style="animation-duration: 4s;"></div>
            <div class="absolute top-[10%] -right-[10%] w-[50%] h-[50%] bg-[#274CA5]/15 rounded-full blur-[100px] mix-blend-screen animate-pulse" style="animation-duration: 5s;"></div>
            <div class="absolute -bottom-[20%] left-[20%] w-[60%] h-[60%] bg-yellow-500/10 rounded-full blur-[150px] mix-blend-screen animate-pulse" style="animation-duration: 6s;"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10 mix-blend-overlay"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                    <span class="inline-block py-1 px-3 rounded-full bg-white/5 border border-white/10 text-slate-300 font-semibold tracking-widest uppercase text-[10px] sm:text-xs mb-5 backdrop-blur-md">Layanan Hubungan Masyarakat</span>
                    <h2 class="font-montserrat font-black text-3xl md:text-4xl lg:text-5xl text-white tracking-tight mb-6">
                        Layanan <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#274CA5] to-yellow-200">Aspirasi & Pengaduan</span>
                    </h2>
                    <p class="text-slate-400 text-base md:text-lg leading-relaxed max-w-2xl mx-auto font-medium">Sampaikan masukan konstruktif, pengaduan, dan saran untuk pembangunan, atau terhubung langsung melalui kanal media sosial resmi <label class="whitespace-nowrap">PROKOPIM Mahakam Ulu.</label></p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                    
                    <!-- Left Column: Formal Bright Glass Form -->
                    <div class="lg:col-span-7 xl:col-span-8 flex flex-col" data-aos="fade-right" data-aos-delay="100">
                        <div x-data="feedbackForm()" class="flex-1 bg-white/[0.95] backdrop-blur-[40px] border border-slate-200/50 rounded-[2rem] p-8 md:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.2)] relative overflow-hidden group">
                            
                            <h3 class="text-xl md:text-2xl font-montserrat font-bold text-slate-800 mb-8 flex items-center tracking-tight">
                                <img src="{{ asset('images/Mahakam_Ulu.webp') }}" alt="Logo Mahakam Ulu" class="h-10 md:h-12 w-auto mr-3 md:mr-4 drop-shadow-sm">
                                Form Pengaduan & Saran
                            </h3>

                            <form @submit.prevent="submitForm" class="relative z-10 flex flex-col gap-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="relative">
                                        <input type="text" x-model="formData.nama" placeholder="Nama Lengkap" required
                                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-700 placeholder-slate-400 outline-none focus:ring-1 focus:ring-[#3255AA] focus:border-[#3255AA] focus:bg-white transition-all font-medium text-[15px] shadow-sm">
                                    </div>
                                    <div class="relative">
                                        <input type="tel" x-model="formData.no_hp" placeholder="Nomor HP / WhatsApp" required
                                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-700 placeholder-slate-400 outline-none focus:ring-1 focus:ring-[#3255AA] focus:border-[#3255AA] focus:bg-white transition-all font-medium text-[15px] shadow-sm">
                                    </div>
                                </div>
                                <div class="relative">
                                    <textarea x-model="formData.pesan" rows="5" placeholder="Tuliskan masukan dan saran Anda secara terperinci..." required
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-700 placeholder-slate-400 outline-none focus:ring-1 focus:ring-[#3255AA] focus:border-[#3255AA] focus:bg-white transition-all font-medium text-[15px] resize-none shadow-sm"></textarea>
                                </div>
                                <div class="mt-2 flex justify-end">
                                    <!-- Formal button -->
                                    <button type="submit" :disabled="isSubmitting" class="group relative px-8 py-4 rounded-xl bg-[#3255AA] text-white font-bold tracking-widest uppercase text-xs sm:text-sm hover:bg-[#166534] transition-all duration-300 w-full md:w-auto overflow-hidden disabled:opacity-70 disabled:cursor-not-allowed">
                                        <span class="relative z-10 flex items-center justify-center gap-3" x-show="!isSubmitting">
                                            Kirim Pesan
                                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </span>
                                        <span class="relative z-10 flex items-center justify-center gap-3" x-show="isSubmitting" x-cloak>
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            Memproses...
                                        </span>
                                    </button>
                                </div>
                            </form>

                            <!-- Success Modal Popup -->
                            <div x-show="showSuccess" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div x-show="showSuccess" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-[#274CA5]/60 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

                                <div x-show="showSuccess" 
                                     x-transition:enter="ease-out duration-300" 
                                     x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95" 
                                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                                     x-transition:leave="ease-in duration-300" 
                                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                                     x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-75" 
                                     class="relative bg-white rounded-[2rem] shadow-2xl overflow-hidden transform transition-all w-full max-w-md border border-slate-100">
                                    
                                    <!-- Decorative Modal Background -->
                                    <div class="absolute inset-0 pointer-events-none">
                                        <div class="absolute -top-24 -right-24 w-48 h-48 rounded-full bg-blue-100 blur-[40px]"></div>
                                        <div class="absolute -bottom-24 -left-24 w-48 h-48 rounded-full bg-yellow-100 blur-[40px]"></div>
                                    </div>

                                    <div class="relative px-6 py-10 sm:p-12 text-center">
                                        <!-- Animated Success Icon -->
                                        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-[#3255AA] to-[#274CA5] shadow-[0_10px_30px_rgba(21,128,61,0.4)] mb-6 ring-8 ring-[#f0fdf4]">
                                            <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                        </div>
                                        
                                        <h3 class="font-montserrat text-2xl font-black text-slate-800 mb-2 tracking-tight" id="modal-title">Terima Kasih!</h3>
                                        <div class="mt-2">
                                            <p class="text-slate-500 text-sm md:text-base leading-relaxed font-medium">Masukan dan saran Anda yang sangat berharga telah kami terima. Dukungan Anda membantu kami mewujudkan Mahakam Ulu yang lebih baik.</p>
                                        </div>
                                        
                                        <div class="mt-8">
                                            <button type="button" @click="closeModal()" class="w-full inline-flex justify-center items-center rounded-xl border border-transparent bg-[#274CA5] px-6 py-3.5 text-sm font-bold text-white shadow-lg hover:bg-slate-800 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#274CA5] focus:ring-offset-2 transition-all duration-300 uppercase tracking-widest">
                                                Tutup Pesan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right Column: Ultra-Clean Corporate Dark Cards -->
                    <div class="lg:col-span-5 xl:col-span-4 flex flex-col gap-4" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="text-xl md:text-2xl font-montserrat font-bold text-white mb-2 flex items-center lg:hidden tracking-tight">
                            <span class="w-1.5 h-6 md:h-8 rounded-full bg-gradient-to-b from-[#274CA5] to-yellow-200 mr-3 md:mr-4"></span>
                            Kanal Sosial Resmi
                        </h3>
                        
                        <!-- Youtube Card -->
                        <a href="#" target="_blank" class="group relative bg-[#0B1221] border border-slate-800 rounded-2xl p-6 flex flex-col md:flex-row md:items-center items-start justify-between min-h-[110px] overflow-hidden hover:border-red-500/50 hover:bg-[#0D1525] hover:shadow-[0_10px_30px_-5px_rgba(239,68,68,0.15)] transition-all duration-300">
                            <!-- Subtle highlight line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="flex items-center gap-5 relative z-10 w-full">
                                <div class="w-14 h-14 shrink-0 rounded-2xl bg-[#162032] border border-slate-700/50 flex items-center justify-center text-slate-400 group-hover:bg-red-500/10 group-hover:text-red-500 group-hover:border-red-500/20 transition-all duration-300">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-montserrat font-bold text-white text-[15px] tracking-widest mb-0.5 group-hover:text-red-500 transition-colors uppercase">YouTube</h4>
                                    <p class="text-slate-400 text-xs font-medium tracking-wide">PROKOPIM TV</p>
                                </div>
                                <!-- Arrow indicator -->
                                <div class="hidden md:flex w-8 h-8 shrink-0 items-center justify-center text-slate-600 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-red-500 transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </div>
                            </div>
                        </a>

                        <!-- Instagram Card -->
                        <a href="#" target="_blank" class="group relative bg-[#0B1221] border border-slate-800 rounded-2xl p-6 flex flex-col md:flex-row md:items-center items-start justify-between min-h-[110px] overflow-hidden hover:border-pink-500/50 hover:bg-[#0D1525] hover:shadow-[0_10px_30px_-5px_rgba(236,72,153,0.15)] transition-all duration-300">
                            <!-- Subtle highlight line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="flex items-center gap-5 relative z-10 w-full">
                                <div class="w-14 h-14 shrink-0 rounded-2xl bg-[#162032] border border-slate-700/50 flex items-center justify-center text-slate-400 group-hover:bg-gradient-to-tr group-hover:from-[#274CA5]/20 group-hover:via-pink-500/20 group-hover:to-purple-500/20 group-hover:text-pink-400 group-hover:border-pink-500/20 transition-all duration-300">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-montserrat font-bold text-white text-[15px] tracking-widest mb-0.5 group-hover:text-pink-400 transition-colors uppercase">Instagram</h4>
                                    <p class="text-slate-400 text-xs font-medium tracking-wide">@PROKOPIM.mahulu</p>
                                </div>
                                <!-- Arrow indicator -->
                                <div class="hidden md:flex w-8 h-8 shrink-0 items-center justify-center text-slate-600 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-pink-400 transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </div>
                            </div>
                        </a>

                        <!-- WhatsApp Card -->
                        <a href="#" target="_blank" class="group relative bg-[#0B1221] border border-slate-800 rounded-2xl p-6 flex flex-col md:flex-row md:items-center items-start justify-between min-h-[110px] overflow-hidden hover:border-green-500/50 hover:bg-[#0D1525] hover:shadow-[0_10px_30px_-5px_rgba(34,197,94,0.15)] transition-all duration-300">
                            <!-- Subtle highlight line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-green-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="flex items-center gap-5 relative z-10 w-full">
                                <div class="w-14 h-14 shrink-0 rounded-2xl bg-[#162032] border border-slate-700/50 flex items-center justify-center text-slate-400 group-hover:bg-green-500/10 group-hover:text-green-500 group-hover:border-green-500/20 transition-all duration-300">
                                    <svg class="w-6 h-6 border-transparent" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-montserrat font-bold text-white text-[15px] tracking-widest mb-0.5 group-hover:text-green-500 transition-colors uppercase">WhatsApp</h4>
                                    <p class="text-slate-400 text-xs font-medium tracking-wide">Layanan Cepat Tanggap</p>
                                </div>
                                <!-- Arrow indicator -->
                                <div class="hidden md:flex w-8 h-8 shrink-0 items-center justify-center text-slate-600 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-green-500 transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </div>
                            </div>
                        </a>

                    </div>

                </div>
            </div>
        </section>

        <!-- Alpine Component for Feedback Form -->
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('feedbackForm', () => ({
                    formData: {
                        nama: '',
                        no_hp: '',
                        pesan: ''
                    },
                    isSubmitting: false,
                    showSuccess: false,

                    async submitForm() {
                        this.isSubmitting = true;

                        try {
                            const response = await fetch('{{ route('feedback.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify(this.formData),
                            });

                            if (!response.ok) {
                                throw new Error('Gagal mengirim masukan.');
                            }

                            this.isSubmitting = false;
                            this.showSuccess = true;
                            this.formData.nama = '';
                            this.formData.no_hp = '';
                            this.formData.pesan = '';
                        } catch (error) {
                            this.isSubmitting = false;
                            alert(error.message || 'Terjadi kesalahan saat mengirim masukan.');
                        }
                    },

                    closeModal() {
                        this.showSuccess = false;
                    }
                }));
            });
        </script>
