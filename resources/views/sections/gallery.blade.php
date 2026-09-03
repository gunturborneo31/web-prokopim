<section id="gallery" class="relative overflow-hidden bg-white py-10">
	<div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-32">
		<div class="relative z-10 -mb-10 place-self-center px-6 pt-8 text-center">
			<h2 class="font-montserrat text-3xl font-bold md:text-5xl text-[#274CA5]">
				Galeri <span class="text-gray-800 drop-shadow drop-shadow-2xl font-bold">Dokumentasi</span>
			</h2>
			<p class="mx-auto my-4 max-w-2xl text-sm leading-relaxed tracking-tight text-slate-500 md:text-base">
				Satu tempat untuk melihat dokumentasi kegiatan pimpinan, agenda resmi,
				dan momen protokoler dalam tampilan galeri interaktif.
			</p>
            

		</div>
        <div class="relative z-10 mx-auto mt-8 h-8 w-24 rounded-full "></div>

		<div id="gallery-scroll" class="relative h-[100vh] rounded rounded-2xl" style="perspective:1000px; perspective-origin:center top; transform-style:preserve-3d;">
			<div class="sticky left-0 top-0 h-screen w-full overflow-hidden rounded rounded-2xl" style="perspective:1000px; perspective-origin:center top; transform-style:preserve-3d;">
				<div id="gallery-grid"
					 class="relative grid h-full w-full grid-cols-4 gap-2 rounded-2xl"
					 style="transform-style:preserve-3d; transform-origin:50% 50%;">

					<div class="gallery-col flex w-full flex-col gap-2 -mt-2" data-y-from="-28" data-y-to="8">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/1.jpg') }}" alt="Galeri 1">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-1-2.jpg') }}" alt="Galeri 2">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita2.jpg') }}" alt="Galeri 3">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-2-1.jpg') }}" alt="Galeri 4">
					</div>

					<div class="gallery-col mt-[-50%] flex w-full flex-col gap-2" data-y-from="36" data-y-to="10">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita2-2 (1).jpg') }}" alt="Galeri 5">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita2-2.jpg') }}" alt="Galeri 6">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-4-1.jpg') }}" alt="Galeri 7">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-6.jpg') }}" alt="Galeri 8">
					</div>

					<div class="gallery-col flex w-full flex-col gap-2 -mt-2" data-y-from="-28" data-y-to="8">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-7.jpg') }}" alt="Galeri 9">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-13 (1).jpg') }}" alt="Galeri 10">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-13.jpg') }}" alt="Galeri 11">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-14.jpg') }}" alt="Galeri 12">
					</div>

                    <div class="gallery-col mt-[-50%] flex w-full flex-col gap-2" data-y-from="36" data-y-to="10">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita21.jpg') }}" alt="Galeri 13">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita-Seremonial.jpg') }}" alt="Galeri 14">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/IMG_20251020_091357.jpg') }}" alt="Galeri 15">
						<img class="gallery-img aspect-video block h-auto w-full rounded-md object-cover shadow cursor-pointer hover:opacity-90 transition-opacity" loading="lazy" src="{{ asset('images/Cover-Berita2-2.jpg') }}" alt="Galeri 16">
					</div>
				</div>
			</div>
		</div>
        
	</div>

    			<div class="mt-6 flex items-center justify-center gap-2">
				<a href="#" class="inline-flex items-center rounded-2xl bg-[#1e48aa] px-4 py-2 text-sm font-semibold text-white hover:bg-[#3255AA] transition-colors">
					Lihat Semua Galeri 
				</a>
			</div>

	<!-- Gallery Modal Detail -->
	<div id="gallery-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm">
		<div class="relative w-11/12 max-w-3xl rounded-xl bg-white shadow-2xl overflow-hidden">
			<button id="gallery-modal-close" class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-[#274CA5] text-white hover:bg-slate-800 transition-all duration-200 hover:scale-110">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
				</svg>
			</button>
			<img id="gallery-modal-img" class="w-full max-h-[70vh] object-cover" src="" alt="">
			<div class="bg-gradient-to-r from-slate-50 towhite px-6 py-4 border-t border-slate-200">
				<p id="gallery-modal-caption" class="text-center text-sm font-semibold text-slate-700"></p>
			</div>
		</div>
	</div>

	<script>
		(function () {
			var wrap = document.getElementById('gallery-scroll');
			var grid = document.getElementById('gallery-grid');
			if (!wrap || !grid) return;

			var cols = wrap.querySelectorAll('.gallery-col');
			var ticking = false;

			function clamp(v, min, max) {
				return Math.min(max, Math.max(min, v));
			}

			function lerp(a, b, t) {
				return a + (b - a) * t;
			}

			function easeInOutCubic(t) {
				return t < 0.5
					? 4 * t * t * t
					: 1 - Math.pow(-2 * t + 2, 3) / 2;
			}

			function update() {
				var rect = wrap.getBoundingClientRect();
				var viewH = window.innerHeight;
				// Mulai animasi dari saat section masuk viewport (rect.top = viewH)
				// selesai saat section habis di-scroll (rect.top = -(max_base))
				var maxBase = Math.max(1, wrap.offsetHeight - viewH);
				var totalRange = maxBase + viewH;
				var scrolled = clamp(viewH - rect.top, 0, totalRange);
				var p = scrolled / totalRange;

				// Fase animasi:
				// 0.00-0.35 rotate dari 75deg ke 0deg (langsung bereaksi saat masuk)
				// 0.35-0.55 hold (stop sebentar)
				// 0.55-1.00 kolom bergerak paralaks
				var ROTATE_END = 1.0; // Sedikit lebih awal dari 0.55 untuk memberi ruang hold pada 0.35-0.55
				var SCALE_START = 0.2;
				var SCALE_END = 0.1;
				var COL_START = 0.1;
				var COL_END = 0.4;

				var rotateT = easeInOutCubic(clamp(p / ROTATE_END, 0, 1));
				var scaleT = easeInOutCubic(clamp((p - SCALE_START) / (SCALE_END - SCALE_START), 0, 1));

				var rotateX = lerp(75, 0, rotateT);
				var scale = p < SCALE_START ? 1.2 : lerp(1.2, 1, scaleT);
				grid.style.transform = 'rotateX(' + rotateX.toFixed(2) + 'deg) scale(' + scale.toFixed(3) + ')';

				cols.forEach(function (col) {
					var from = parseFloat(col.getAttribute('data-y-from') || '0');
					var to = parseFloat(col.getAttribute('data-y-to') || '0');
					var colT = easeInOutCubic(clamp((p - COL_START) / (COL_END - COL_START), 0, 1));
					var y = lerp(from, to, colT);
					col.style.transform = 'translateY(' + y.toFixed(2) + '%)';
				});

				ticking = false;
			}

			function onScroll() {
				if (!ticking) {
					window.requestAnimationFrame(update);
					ticking = true;
				}
			}

			window.addEventListener('scroll', onScroll, { passive: true });
			window.addEventListener('resize', onScroll);
			document.addEventListener('livewire:navigated', onScroll);
			onScroll();

			// Gallery image click handler untuk modal
			var galleryImages = document.querySelectorAll('.gallery-img');
			var modal = document.getElementById('gallery-modal');
			var modalImg = document.getElementById('gallery-modal-img');
			var modalCaption = document.getElementById('gallery-modal-caption');
			var closeBtn = document.getElementById('gallery-modal-close');

			// Load image bertahap: hanya 4 gambar awal yang langsung diunduh.
			var PLACEHOLDER = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="16" height="9" viewBox="0 0 16 9"%3E%3Crect width="16" height="9" fill="%23e2e8f0"/%3E%3C/svg%3E';
			galleryImages.forEach(function (img, index) {
				img.decoding = 'async';
				if (index > 3) {
					img.dataset.src = img.src;
					img.src = PLACEHOLDER;
					img.setAttribute('loading', 'lazy');
					img.setAttribute('fetchpriority', 'low');
				}
			});

			if ('IntersectionObserver' in window) {
				var imageObserver = new IntersectionObserver(function (entries, observer) {
					entries.forEach(function (entry) {
						if (!entry.isIntersecting) return;

						var img = entry.target;
						if (img.dataset.src) {
							img.src = img.dataset.src;
							delete img.dataset.src;
						}

						observer.unobserve(img);
					});
				}, { rootMargin: '240px 0px' });

				galleryImages.forEach(function (img, index) {
					if (index > 3) {
						imageObserver.observe(img);
					}
				});
			}

			if (modal && closeBtn && galleryImages.length > 0) {
				galleryImages.forEach(function(img) {
					img.addEventListener('click', function(e) {
						e.stopPropagation();
						modal.classList.remove('hidden');
						modal.classList.add('flex');
						modalImg.src = this.dataset.src || this.src;
						modalCaption.textContent = this.alt;
					}, false);
				});

				closeBtn.addEventListener('click', function() {
					modal.classList.add('hidden');
					modal.classList.remove('flex');
				});

				modal.addEventListener('click', function(e) {
					if (e.target === modal) {
						modal.classList.add('hidden');
						modal.classList.remove('flex');
					}
				});
			}
		})();
	</script>
</section>
