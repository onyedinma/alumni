<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ getOption('app_name') }} - @stack('title')</title>
    <link rel="icon" href="{{ getSettingImage('app_logo') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/b53fe7da2e.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Retain existing styles for plugins if needed, but try to override with Tailwind -->
    @stack('style')
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50">

    @if (getOption('app_preloader_status', 0) == STATUS_ACTIVE)
        <div id="preloader"
            class="fixed inset-0 z-50 flex items-center justify-center bg-white transition-opacity duration-500">
            <div id="preloader_status">
                <img src="{{ getSettingImage('app_preloader') }}" alt="{{ getOption('app_name') }}" class="animate-pulse" />
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Simple preloader fade out
        window.addEventListener('load', function () {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }
        });
    </script>
    @stack('script')
</body>

</html>