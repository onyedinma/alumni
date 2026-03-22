<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ getOption('app_name') }} - @stack('title')</title>
    <link rel="icon" href="{{ getSettingImage('app_logo') }}" type="image/png">

    <!-- SEO Meta Tags -->
    <meta name="description" content="@stack('meta_description', getOption('app_name') . ' - Alumni Association')">
    <meta property="og:title" content="{{ getOption('app_name') }} - @stack('title')">
    <meta property="og:description"
        content="@stack('meta_description', getOption('app_name') . ' - Alumni Association')">
    <meta property="og:image" content="@stack('meta_image', getSettingImage('app_logo'))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    @stack('meta')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/public-premium.css') }}" rel="stylesheet">

    <!-- Retain existing styles for plugins if needed, but try to override with Tailwind -->
    @stack('style')

    <!-- Improved Preloader Styles -->
    <style>
        #preloader {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex !important;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 50%, #0B0E11 100%) !important;
            z-index: 9999;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        #preloader_status {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        #preloader_status img {
            max-width: 120px !important;
            max-height: 120px !important;
            width: auto;
            height: auto;
            border-radius: 16px;
            animation: preloaderPulse 1.5s ease-in-out infinite !important;
            position: relative;
            z-index: 2;
        }

        #preloader_status::before,
        #preloader_status::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 2px solid rgba(212, 175, 90, 0.3);
            animation: preloaderRing 1.5s ease-out infinite;
        }

        #preloader_status::before {
            width: 140px;
            height: 140px;
        }

        #preloader_status::after {
            width: 180px;
            height: 180px;
            animation-delay: 0.3s;
        }

        @keyframes preloaderPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(0.95);
                opacity: 0.85;
            }
        }

        @keyframes preloaderRing {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 0.8;
            }

            100% {
                transform: translate(-50%, -50%) scale(1.3);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="font-sans antialiased" style="background-color: #0B0E11; color: #E6EAF0;">

    @if (getOption('app_preloader_status', 0) == STATUS_ACTIVE)
        <div id="preloader">
            <div id="preloader_status">
                <img src="{{ getSettingImage('app_preloader') }}" alt="{{ getOption('app_name') }}" />
            </div>
        </div>
    @endif

    <div class="min-h-screen flex flex-col">
        @include('frontend.layouts.modern-nav')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('frontend.layouts.modern-footer')
    </div>

    <!-- WhatsApp Widget -->
    @include('frontend.partials.whatsapp')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Robust preloader fade out - disable pointer events immediately
        (function () {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                // Immediately disable pointer events to prevent blocking
                preloader.style.pointerEvents = 'none';
                preloader.style.opacity = '0';
                // Remove after fade transition
                setTimeout(function () {
                    if (preloader && preloader.parentNode) {
                        preloader.parentNode.removeChild(preloader);
                    }
                }, 500);
            }
        })();

        // Backup: also run on window load
        window.addEventListener('load', function () {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.pointerEvents = 'none';
                preloader.style.opacity = '0';
                setTimeout(function () {
                    if (preloader && preloader.parentNode) {
                        preloader.parentNode.removeChild(preloader);
                    }
                }, 500);
            }
        });
    </script>
    @stack('script')
</body>

</html>