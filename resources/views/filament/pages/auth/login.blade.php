<div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: #ffffff; z-index: 99999; display: flex; font-family: 'Poppins', sans-serif; overflow: hidden;" class="login-wrapper">
    
    <!-- Left Side: Login Form -->
    <div class="login-left" style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px; background: #ffffff; overflow-y: auto; position: relative; z-index: 20;">
        <div style="width: 100%; max-width: 420px; position: relative;">
            
            <!-- Abstract subtle glow behind form -->
            <div style="position: absolute; top: -100px; right: -50px; width: 300px; height: 300px; background: #60a5fa; filter: blur(120px); opacity: 0.15; z-index: -1; border-radius: 50%;"></div>

            <!-- Welcome Header -->
            <div class="animate-fade-up" style="--delay: 0.1s; margin-bottom: 45px;">
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #f1f5f9;">
                     <!-- Placeholder Logo Container Kiri -->
                     <div style="background: white; padding: 6px; border-radius: 14px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.01); border: 1px solid #f8fafc; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px;">
                         
                         <!-- TODO: UNTUK MEMASANG LOGO NANTI, UNCOMMENT BARIS DI BAWAH INI -->
                         <!-- <img src="{{ asset('images/logo-anda.png') }}" alt="Logo" style="max-height: 100%; max-width: 100%; object-fit: contain;"> -->
                         
                         <!-- ... LALU HAPUS SVG PLACEHOLDER INI -->
                         <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="22" y2="22"/>
                            <line x1="6" x2="6" y1="18" y2="11"/>
                            <line x1="10" x2="10" y1="18" y2="11"/>
                            <line x1="14" x2="14" y1="18" y2="11"/>
                            <line x1="18" x2="18" y1="18" y2="11"/>
                            <polygon points="12 2 20 7 4 7"/>
                         </svg>
                     </div>
                     <div>
                        <h2 style="margin: 0; font-size: 19px; font-weight: 800; color: #1e3a8a; letter-spacing: -0.5px; line-height: 1.1;">CMS Government</h2>
                        <span style="font-size: 12px; color: #2563eb; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Admin Panel</span>
                     </div>
                </div>
                <h1 style="font-size: 36px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0; letter-spacing: -1.2px; line-height: 1.2;">Selamat Datang!</h1>
            </div>

            <!-- Form -->
            <div class="custom-filament-form animate-fade-up" style="--delay: 0.25s; position: relative;">
                <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 24px;">
                    {{ $this->form }}

                    <div style="display: flex; justify-content: flex-end; margin-top: -12px;">
                        @if (filament()->hasPasswordReset())
                            <a href="{{ filament()->getRequestPasswordResetUrl() }}" class="hover-link" style="font-size: 13px; font-weight: 700; color: #2563eb; text-decoration: none; transition: all 0.3s ease;">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <div class="btn-container" style="padding-top: 16px;">
                        <button type="submit" class="submit-btn" style="width: 100%; position: relative; overflow: hidden; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; padding: 16px; border-radius: 16px; font-size: 16px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 12px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4), 0 8px 10px -6px rgba(37, 99, 235, 0.1);">
                            <span style="position: relative; z-index: 2;">Masuk Sekarang</span>
                            <svg class="btn-icon" width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2; transition: transform 0.4s ease;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            <div class="btn-glow" style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: left 0.6s ease; z-index: 1;"></div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="animate-fade-up" style="--delay: 0.4s; margin-top: 80px; text-align: center; font-size: 10px; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.8;">
                © 2026 CMS GOVERNMENT.
            </div>
        </div>
    </div>

    <!-- Right Side: Visual Panel -->
    <div class="login-right hide-mobile" style="flex: 1.2; position: relative; background: #0f172a; display: flex; flex-direction: column; justify-content: center; align-items: center; overflow: hidden;">
        
        <!-- High Quality Hero Image with Slow Zoom Animation -->
        <div class="hero-bg-image" style="position: absolute; inset: 0; background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center; z-index: 0;"></div>
        
        <!-- Premium Gradient Overlay (Dark to Transparent) -->
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,58,138,0.7) 50%, rgba(37,99,235,0.4) 100%); z-index: 1;"></div>
        
        <!-- Elegant Grid Pattern (Optional subtle texture) -->
        <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 30px 30px; z-index: 2; opacity: 0.3;"></div>
        
        <!-- Content Container -->
        <div class="panel-content animate-fade-up" style="position: relative; z-index: 10; padding: 60px; text-align: center; max-width: 600px; display: flex; flex-direction: column; justify-content: center; align-items: center; --delay: 0.3s;">
            
            <!-- Floating Logo Box Placeholder with Glassmorphism -->
            <div style="margin-bottom: 40px; display: inline-flex; position: relative;">
                <div class="logo-glow animate-pulse-slow" style="position: absolute; inset: -20px; background: rgba(96, 165, 250, 0.4); filter: blur(40px); border-radius: 50%; z-index: -1;"></div>
                <div class="css-floating-logo" style="position: relative; width: 140px; height: 140px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5), inset 0 0 20px rgba(255,255,255,0.1);">
                    
                    <!-- TODO: UNTUK MEMASANG LOGO NANTI, UNCOMMENT BARIS DI BAWAH INI -->
                    <!-- <img class="logo-img" src="{{ asset('images/logo-anda.png') }}" alt="Logo Large" style="height: 90px; width: auto; filter: drop-shadow(0 15px 15px rgba(0,0,0,0.3)); position: relative; z-index: 2;"> -->

                    <!-- ... LALU HAPUS PLACEHOLDER ICON & TEXT INI -->
                    <div style="text-align: center; color: rgba(255,255,255,0.9); z-index: 2;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));">
                            <line x1="3" x2="21" y1="22" y2="22"/>
                            <line x1="6" x2="6" y1="18" y2="11"/>
                            <line x1="10" x2="10" y1="18" y2="11"/>
                            <line x1="14" x2="14" y1="18" y2="11"/>
                            <line x1="18" x2="18" y1="18" y2="11"/>
                            <polygon points="12 2 20 7 4 7"/>
                        </svg>
                        <div style="font-size: 11px; font-weight: 800; margin-top: 8px; letter-spacing: 2px; text-transform: uppercase;">YOUR LOGO</div>
                    </div>

                    <!-- Glass reflection -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 50%; background: linear-gradient(180deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%); border-radius: 40px 40px 0 0; pointer-events: none;"></div>
                </div>
            </div>

            <!-- Typography -->
            <h2 class="animate-fade-up" style="--delay: 0.2s; font-size: 48px; font-weight: 900; color: white; line-height: 1.15; margin: 0; letter-spacing: -1.5px; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                CMS Government<br>
                <span style="background: linear-gradient(135deg, #93c5fd 0%, #60a5fa 50%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">Admin Panel</span>
            </h2>
        </div>
    </div>

    <style>
        /* Lock body - Prevent Filament dark mode dari mengubah background */
        html, body {
            background: white !important;
            color: #1e293b !important;
            margin: 0;
            padding: 0;
        }

        /* Override CSS variables Filament dark mode */
        :root, html.dark {
            --fi-color-gray-950: #1e293b;
            --fi-color-gray-900: #1e293b;
        }

        .fi-simple-main, .fi-simple-main-ctn, .fi-simple-layout {
            all: unset !important;
            display: contents !important;
        }
        .fi-simple-header, .fi-simple-footer { display: none !important; }

        /* ========================================================= */
        /* PURE CSS ULTRA FAST ANIMATIONS (NO JS, 0ms DELAY)         */
        /* ========================================================= */
        
        /* 1. Left Panel Slide In */
        .login-left {
            animation: slideInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes slideInLeft {
            0% { transform: translateX(-30px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        /* 2. Right Panel Fade In */
        .login-right {
            animation: fadeIn 1s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* 3. Staggered Fade Up for Content Elements */
        .animate-fade-up {
            opacity: 0;
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            animation-delay: var(--delay, 0s);
        }
        @keyframes fadeUp {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* 4. Smooth Floating Logo */
        .css-floating-logo {
            animation: floatLogo 6s ease-in-out infinite;
        }
        @keyframes floatLogo {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            50% { transform: translateY(-15px) rotate(2deg) scale(1.02); }
        }

        /* 5. Hero Image Slow Zoom (Hardware Accelerated) */
        .hero-bg-image {
            animation: slowZoom 25s ease-in-out infinite alternate;
        }
        @keyframes slowZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.15); }
        }

        /* 6. Divider Expanding Line */
        .animate-divider {
            width: 0%;
            opacity: 0;
            animation: expandDivider 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            animation-delay: 0.6s;
        }
        @keyframes expandDivider {
            0% { width: 0%; opacity: 0; }
            100% { width: 80%; opacity: 0.5; }
        }

        /* Custom slow pulse animation for logo shadow */
        @keyframes customPulse {
            0% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.1); opacity: 0.6; }
            100% { transform: scale(1); opacity: 0.4; }
        }
        .animate-pulse-slow {
            animation: customPulse 4s ease-in-out infinite;
        }


        /* ========================================================= */
        /* FORMS & COMPONENTS STYLING                                */
        /* ========================================================= */

        /* LABEL */
        label,
        label.fi-fo-field-label,
        [class*="fi-fo-field-label"],
        .fi-fo-field-wrp label,
        .fi-form label,
        .custom-filament-form label {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            color: #334155 !important;
            font-size: 14px !important;
            font-weight: 700 !important;
            margin-bottom: 8px !important;
            letter-spacing: -0.2px;
            transition: color 0.3s ease;
        }

        .fi-fo-field-wrp:focus-within label {
            color: #2563eb !important;
        }

        /* Sembunyikan asterisk required (*) */
        label sup,
        label .fi-required,
        [class*="fi-fo-field-label"] sup,
        [class*="fi-fo-field-label"] [class*="required"],
        .fi-fo-field-label-required,
        label > span[class*="required"],
        label > sup,
        .fi-fo-field-wrp-label-required {
            display: none !important;
        }

        /* Input wrapper */
        .fi-input-wrp {
            border-radius: 16px !important;
            background: #f8fafc !important;
            border: 2px solid transparent !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02) inset !important;
            overflow: hidden !important;
        }
        
        .fi-input-wrp:hover {
            border-color: #cbd5e1 !important;
            background: #ffffff !important;
        }

        .fi-input-wrp:focus-within {
            border-color: #2563eb !important;
            background: white !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15), 0 2px 6px rgba(0,0,0,0.02) inset !important;
        }

        /* Input element */
        .fi-input-wrp input {
            background: transparent !important;
            color: #0f172a !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            padding: 14px 16px !important;
        }

        /* Prefix icon */
        .fi-input-wrp-prefix {
            padding-left: 18px !important;
        }
        .fi-input-wrp-prefix svg {
            width: 22px !important;
            height: 22px !important;
            color: #94a3b8 !important;
            transition: color 0.3s ease !important;
        }
        .fi-input-wrp:focus-within .fi-input-wrp-prefix svg {
            color: #2563eb !important;
        }

        /* Checkbox Override */
        input[type="checkbox"] {
            width: 18px !important;
            height: 18px !important;
            border-radius: 6px !important;
            border: 2px solid #cbd5e1 !important;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        input[type="checkbox"]:checked {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
        }

        /* Field & error spacing */
        .fi-fo-field-wrp { margin-bottom: 4px !important; }
        .fi-fo-field-wrp-error-message {
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #e11d48 !important;
            margin-top: 6px !important;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .fi-fo-field-wrp-error-message::before {
            content: "•";
            font-size: 16px;
        }

        /* Custom Hover Effects */
        .hover-link:hover {
            color: #1d4ed8 !important;
            text-shadow: 0 0 10px rgba(37, 99, 235, 0.2);
            transform: translateX(2px);
        }

        .submit-btn:hover {
            transform: translateY(-2px) scale(1.01) !important;
            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.4), 0 10px 15px -6px rgba(37, 99, 235, 0.2) !important;
        }
        
        .submit-btn:hover .btn-icon {
            transform: translateX(4px) !important;
        }
        
        .submit-btn:hover .btn-glow {
            left: 100% !important;
        }

        .submit-btn:active {
            transform: translateY(1px) scale(0.98) !important;
        }

        @media (max-width: 1023px) {
            .hide-mobile { display: none !important; }
            .login-left { padding: 30px 20px !important; }
        }
    </style>
</div>
