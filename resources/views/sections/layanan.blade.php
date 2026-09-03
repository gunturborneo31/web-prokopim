        <!-- ============================================ -->
        <!-- SECTION 5: APLIKASI & LAYANAN (LIGHT)       -->
        <!-- ============================================ -->
        <section id="layanan" class="pt-24 pb-24 relative overflow-hidden bg-gradient-to-b from-[#eff6ff] via-[#bfdbfe]/10 to-[#dbeafe]" style="border-top: 1px solid rgba(191, 219, 254, 0.5); border-bottom: 1px solid rgba(191, 219, 254, 0.5);">
            <!-- Subtle gradient Background -->
            <div class="absolute inset-0 opacity-5" style="background: linear-gradient(180deg, #60a5fa 0%, #eff6ff 100%);"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                    <span class="inline-block py-1 px-3 rounded-full bg-[#10192B] text-[#ffffff] font-bold tracking-wider uppercase text-xs mb-3 border border-[#60a5fa]/40">Akses Digital</span>
                    <h2 class="mt-2 font-montserrat font-black text-4xl md:text-5xl leading-tight text-[#10192B]">
                        Aplikasi & <span class="text-[#1e48aa]">Layanan</span>
                    </h2>
                    <p class="mt-4 text-[#334155] text-lg font-medium">Platform digital terintegrasi untuk kemudahan masyarakat Mahakam Ulu</p>
                </div>

                <!-- Infinite Slider Container (Draggable) -->
                <div class="relative w-full overflow-hidden cursor-grab active:cursor-grabbing" 
                     x-data="{ 
                        items: @js($allLinks),
                        isDown: false,
                        startX: 0,
                        scrollLeft: 0,
                        momentumID: null,
                        velX: 0,
                        autoScrollID: null,
                        autoScrollSpeed: 0.8,
                        
                        startDrag(e) {
                            this.isDown = true;
                            if(this.autoScrollID) cancelAnimationFrame(this.autoScrollID);
                            if(this.momentumID) cancelAnimationFrame(this.momentumID);
                            
                            this.startX = (e.pageX || e.touches?.[0]?.pageX) - this.$refs.slider.offsetLeft;
                            this.scrollLeft = this.$refs.slider.scrollLeft;
                        },
                        
                        stopDrag() {
                            this.isDown = false;
                            this.beginMomentum();
                        },
                        
                        onDrag(e) {
                            if(!this.isDown) return;
                            e.preventDefault(); 
                            
                            const x = (e.pageX || e.touches?.[0]?.pageX) - this.$refs.slider.offsetLeft;
                            const walk = (x - this.startX) * 1.5; 
                            
                            const prevScrollLeft = this.$refs.slider.scrollLeft;
                            this.$refs.slider.scrollLeft = this.scrollLeft - walk;
                            this.velX = this.$refs.slider.scrollLeft - prevScrollLeft;
                            this.checkLoop();
                        },

                        checkLoop() {
                            const slider = this.$refs.slider;
                            const track1 = this.$refs.track1;
                            if(!track1) return;
                            const resetWidth = track1.getBoundingClientRect().width + 24; 
                            
                            if (slider.scrollLeft >= resetWidth) {
                                slider.scrollLeft -= resetWidth;
                                this.scrollLeft -= resetWidth;
                            } else if (slider.scrollLeft <= 0) {
                                slider.scrollLeft += resetWidth;
                                this.scrollLeft += resetWidth;
                            }
                        },
                        
                        beginMomentum() {
                            const friction = 0.95; 
                            const step = () => {
                                if(this.isDown) return;

                                if (Math.abs(this.velX) > 0.5) {
                                    this.$refs.slider.scrollLeft += this.velX;
                                    this.velX *= friction;
                                    this.checkLoop();
                                    this.momentumID = requestAnimationFrame(step);
                                } else {
                                    this.velX = 0;
                                    this.startAutoScroll();
                                }
                            };
                            this.momentumID = requestAnimationFrame(step);
                        },

                        startAutoScroll() {
                            if(this.autoScrollID) cancelAnimationFrame(this.autoScrollID);
                            const step = () => {
                                if(!this.isDown && Math.abs(this.velX) < 0.5) {
                                    this.$refs.slider.scrollLeft += this.autoScrollSpeed;
                                    this.checkLoop();
                                }
                                this.autoScrollID = requestAnimationFrame(step);
                            };
                            this.autoScrollID = requestAnimationFrame(step);
                        },

                        init() {
                            this.$nextTick(() => {
                                const track1 = this.$refs.track1;
                                if(track1) {
                                    // Calculate loop width correctly with proper timeout to allow DOM layout
                                    setTimeout(() => {
                                        const resetWidth = track1.getBoundingClientRect().width + 24;
                                        this.$refs.slider.scrollLeft = resetWidth;
                                    }, 100);
                                }
                                this.startAutoScroll();
                            });
                        }
                     }"
                     x-init="init()">
                    
                    <!-- Gradient masks for smooth fade edges -->
                    <div class="absolute left-0 top-0 bottom-0 w-8 md:w-24 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-8 md:w-24 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>

                    <!-- Slider track (Scrollable Container) -->
                    <div x-ref="slider"
                         class="flex overflow-x-hidden scroll-auto select-none py-4"
                         style="scrollbar-width: none; -ms-overflow-style: none;"
                         @mouseleave="if(isDown) stopDrag()"
                         @mousedown="startDrag($event)"
                         @mouseup="stopDrag()"
                         @mousemove="onDrag($event)"
                         @touchstart.passive="startDrag($event)"
                         @touchend.passive="stopDrag()"
                         @touchmove.passive="onDrag($event)">
                        
                        <style>
                            .hide-scrollbar::-webkit-scrollbar { display: none; }
                        </style>

                        <!-- Wrapper for tracks -->
                        <div class="flex gap-6 w-max hide-scrollbar px-6">
                            
                            <!-- 4 Identical Tracks for infinite loop -->
                            <template x-for="i in 4" :key="'group-'+i">
                                <div class="flex items-stretch gap-6 min-w-max pointer-events-auto" :x-ref="i === 1 ? 'track1' : null" :aria-hidden="i !== 1">
                                    <template x-for="(link, index) in items" :key="'link-'+i+'-'+index">
                                        <a :href="link.link" target="_blank"
                                           @click="if(Math.abs(velX) > 5) $event.preventDefault()" 
                                           draggable="false"
                                           class="group relative bg-[#e8f4f9] border border-[#97beef] rounded-2xl p-6 transition-all duration-300 hover:border-[#60a5fa] hover:shadow-[0_10px_30px_rgba(88,143,252,0.15)] hover:-translate-y-1 active:scale-[0.98] flex flex-col items-center text-center overflow-hidden w-[320px] shrink-0 min-h-[200px]">
                                            
                                            <!-- Subtle Accent line -->
                                            <div class="absolute top-0 left-0 right-0 h-1 bg-[#3b82f6] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                            <!-- Icon Container -->
                                            <div class="w-36 h-36 rounded-3xl bg-[#dbeafe] flex items-center justify-center border border-[#bfdbfe] mb-6 group-hover:bg-[#bfdbfe]/30 group-hover:border-[#60a5fa] transition-all duration-300 shadow-sm">
                                                <img :src="link.logo" :alt="link.name" draggable="false" class="w-28 h-28 object-contain mx-auto filter group-hover:scale-110 transition-transform duration-300" loading="lazy">
                                            </div>

                                        </a>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>

