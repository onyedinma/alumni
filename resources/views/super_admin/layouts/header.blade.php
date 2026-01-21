<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ getOption('app_name') }} - @stack('title' ?? '')</title>
    @hasSection('meta')
        @stack('meta')
    @else
        @php
            $metaData = getMeta('home');
        @endphp

        <!-- Open Graph meta tags for social sharing -->
        <meta property="og:type" content="{{ __('zaisub') }}">
        <meta property="og:title" content="{{ $metaData['meta_title'] ?? getOption('app_name') }}">
        <meta property="og:description" content="{{ $metaData['meta_description'] ?? getOption('app_name') }}">
        <meta property="og:image" content="{{ $metaData['og_image'] ?? getSettingImageCentral('app_logo') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{getOption('app_name') }}">

        <!-- Twitter Card meta tags for Twitter sharing -->
        <meta name="twitter:card" content="{{ __('zaisub') }}">
        <meta name="twitter:title" content="{{ $metaData['meta_title'] ?? getOption('app_name') }}">
        <meta name="twitter:description" content="{{ $metaData['meta_description'] ?? getOption('app_name') }}">
        <meta name="twitter:image" content="{{ $metaData['og_image'] ?? getSettingImageCentral('app_logo') }}">

        <meta name="csrf-token" content="{{ csrf_token() }}" />
    @endif

    <!-- Place favicon.ico in the root directory -->
    <link rel="icon" href="{{ getSettingImageCentral('app_fav_icon') }}" type="image/png" sizes="16x16">
    <link rel="shortcut icon" href="{{ getSettingImageCentral('app_fav_icon') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ getSettingImageCentral('app_fav_icon') }}">
    <!-- fonts file -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900;1000&display=swap"
        rel="stylesheet" />
    <!-- css file  -->
    <link rel="stylesheet" href="{{ asset('super_admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('super_admin/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('super_admin/css/dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('super_admin/css/dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('super_admin/css/dataTables.responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('super_admin/scss/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('super_admin/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('super_admin/css/summernote/summernote-lite.min.css') }}" />
    <script src="{{ asset('super_admin/js/modernizr-3.11.2.min.js') }}"></script>
    @stack('style')

    <!-- Improved Preloader Styles -->
    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 50%, #0B0E11 100%) !important;
            z-index: 9999;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
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
            animation: preloaderPulse 1.5s ease-in-out infinite;
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