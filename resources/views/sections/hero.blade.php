<section class="relative isolate overflow-hidden py-8 sm:py-10 lg:py-8">
	<div class="absolute inset-0 -z-30">
		
	<video 
  autoplay 
  loop 
  muted 
  playsinline 
  preload="metadata" 
  poster="cover.webp"
  style="width: 100%; height: auto;" class="h-full w-full object-cover">
  
  <!-- Browser modern (Chrome/Firefox) memilih WebM lebih dahulu (file lebih kecil) -->
  <source src="{{ asset('images/output.webm') }}" type="video/webm">  
  
  <!-- Safari/iOS & browser lain menggunakan MP4 FastStart -->
  <source src="{{ asset('images/output.mp4') }}" type="video/mp4">

  
  Browser Anda tidak mendukung tag video.
</video>
	</div>

	<div class="absolute inset-0 -z-20 bg-[#07122c]/40"></div>
	<div class="absolute inset-0 -z-10 bg-[radial-gradient(1200px_500px_at_20%_50%,rgba(39,76,165,0.55),transparent_60%),radial-gradient(850px_420px_at_85%_20%,rgba(245,158,11,0.16),transparent_55%)]"></div>

	<div class="pointer-events-none absolute inset-0 -z-10 opacity-20" style="background-image: linear-gradient(115deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0) 32%, rgba(255,255,255,0.08) 55%, rgba(255,255,255,0) 100%);"></div>

	<div class="container mx-auto px-4 sm:px-6 lg:px-12">
		<div class="grid items-center gap-8 lg:grid-cols-[1.15fr_0.85fr]">
			<div>
				<p class="mb-4 text-sm font-medium text-white sm:text-base">
					Selamat Datang di Website Resmi
				</p>

				<h1 class="max-w-4xl text-3xl font-black leading-tight sm:text-4xl lg:text-5xl xl:text-6xl">
					<span class="block uppercase tracking-tight text-white">Bagian PROKOPIM</span>
					<span class="mt-1 block uppercase tracking-tight text-white">MAHAKAM ULU</span>
				</h1>

				<p class="mt-6 inline-block border-l-4 border-amber-400 pl-4 text-base font-semibold text-white/85 sm:text-lg">
					Mahulu Melaju: Maju, Merata, Berkelanjutan
				</p>
			</div>

			<div class="flex justify-center lg:justify-end">
				<div class="relative w-full max-w-[360px] lg:max-w-[400px]">
					<div class="relative p-2 sm:p-4">
						<div class="relative flex aspect-[4/5] items-center justify-center">
							<img
								src="{{ asset('images/logo_mahulu.png') }}"
								alt="Logo Kabupaten Mahakam Ulu"
								class="h-full w-full object-contain p-10 sm:p-12"
							>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
