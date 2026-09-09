<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0f172a">
    <meta name="description" content="{{ $metaDescription ?? 'Portal resmi Bagian Protokol dan Komunikasi Pimpinan (PROKOPIM) Kabupaten Mahakam Ulu. Informasi keprotokolan, komunikasi pimpinan, agenda, regulasi, dan layanan publik.' }}">
    <meta name="keywords" content="PROKOPIM, Mahakam Ulu, Perencanaan Pembangunan, PPID, Informasi Publik, Kalimantan Timur">
    <meta name="author" content="PROKOPIM Kabupaten Mahakam Ulu">
    <meta name="robots" content="index, follow">

    @php
        $socialImage = $metaImage ?? asset('images/slider_fix.png');
        $socialImagePath = parse_url($socialImage, PHP_URL_PATH) ?? $socialImage;
        $socialImageExt = strtolower(pathinfo($socialImagePath, PATHINFO_EXTENSION));
        $socialImageType = match ($socialImageExt) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'webp' => 'image/webp',
            default => 'image/jpeg',
        };

        // Hitung dimensi asli gambar agar og:image:width/height selalu akurat.
        // Dimensi yang salah/tidak sesuai aspek gambar sering membuat WhatsApp/Facebook
        // menolak menampilkan thumbnail preview.
        $socialImageWidth = 1200;
        $socialImageHeight = 630;

        $localImagePath = null;
        if ($socialImagePath) {
            $relativePath = ltrim($socialImagePath, '/');
            $candidatePath = public_path($relativePath);
            if (is_file($candidatePath)) {
                $localImagePath = $candidatePath;
            }
        }

        if ($localImagePath) {
            $dimensions = \Illuminate\Support\Facades\Cache::remember(
                'og_image_dimensions_' . md5($localImagePath) . '_' . filemtime($localImagePath),
                now()->addDay(),
                fn () => @getimagesize($localImagePath) ?: null
            );

            if ($dimensions) {
                [$socialImageWidth, $socialImageHeight] = $dimensions;
            }
        }
    @endphp

    {{-- Security Meta Tags --}}
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
    <meta name="referrer" content="strict-origin-when-cross-origin">

    {{-- Open Graph / Social Media --}}
    <meta property="og:title" content="{{ $pageTitle ?? config('app.name', 'PROKOPIM Mahakam Ulu') }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Portal resmi PROKOPIM Kabupaten Mahakam Ulu — Merajut perencanaan pembangunan yang inovatif dan berkelanjutan.' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $socialImage }}">
    <meta property="og:image:secure_url" content="{{ $socialImage }}">
    <meta property="og:image:type" content="{{ $socialImageType }}">
    <meta property="og:image:width" content="{{ $socialImageWidth }}">
    <meta property="og:image:height" content="{{ $socialImageHeight }}">
    <meta property="og:image:alt" content="{{ $pageTitle ?? config('app.name', 'PROKOPIM Mahakam Ulu') }}">
    <meta property="og:site_name" content="PROKOPIM Mahakam Ulu">
    <meta property="og:locale" content="id_ID">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle ?? config('app.name', 'PROKOPIM Mahakam Ulu') }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Portal resmi PROKOPIM Kabupaten Mahakam Ulu — Merajut perencanaan pembangunan yang inovatif dan berkelanjutan.' }}">
    <meta name="twitter:image" content="{{ $socialImage }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    <title>{{ $pageTitle ?? config('app.name', 'PROKOPIM Mahakam Ulu') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="{{ asset('images/Mahakam_Ulu.webp') }}">
    <link rel="shortcut icon" type="image/webp" href="{{ asset('images/Mahakam_Ulu.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/Mahakam_Ulu.webp') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
</head>
<body class="font-sans antialiased bg-instansi-surface text-instansi-text-main custom-scrollbar overflow-x-hidden transition-all duration-300">
    <!-- Scroll Progress Bar -->
    <div id="scroll-progress" class="scroll-progress" style="width: 0%"></div>

    <div class="min-h-screen flex flex-col relative">
        <x-navbar.floating />

        <main class="flex-grow">
            {{ $slot }}
        </main>

        @include('components.bottom-navbar')
        @include('components.footer')
    </div>

    <script>
        // Scroll Progress Bar
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            const progressBar = document.getElementById('scroll-progress');
            if (progressBar) {
                progressBar.style.width = progress + '%';
            }
        });
    </script>
</body>
</html>
