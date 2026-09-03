<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0f172a"> <!-- Navy Blue Soul -->

    <title>{{ config('app.name', 'PROKOPIM Mahakam Ulu') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0f172a', // Slate 900 / Navy Blue Core
                        secondary: '#10192d', // Amber 500 / Gold Accent
                        glass: 'rgba(255, 255, 255, 0.05)',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Alpine CSS Cloak */
        [x-cloak] { display: none !important; }
        
        /* Modern Scrollbar - Guest Theme */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a; 
        }
        ::-webkit-scrollbar-thumb {
            background: #334155; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #10192d; /* Amber 500 */
        }
    </style>

    <!-- Scripts -->
    <!-- Alpine.js for interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<!-- Blue-Gold Soul Theme applied to Guest Canvas -->
<body class="font-sans antialiased text-slate-100 bg-primary min-h-screen custom-scrollbar transition-all duration-300 relative overflow-x-hidden">
    
    <!-- Subtle Gradient / Noise App Background -->
    <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
        <!-- Accent Glow Bottom Right -->
        <div class="absolute -bottom-[20%] -right-[10%] w-[600px] h-[600px] rounded-full bg-secondary/10 blur-[120px]"></div>
        <!-- Accent Glow Top Left -->
        <div class="absolute -top-[20%] -left-[10%] w-[500px] h-[500px] rounded-full bg-blue-500/10 blur-[100px]"></div>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col justify-center items-center relative z-10 px-4 sm:px-6 lg:px-12 backdrop-blur-sm">
        {{ $slot }}
    </div>

</body>
</html>

