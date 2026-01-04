<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ getOption('app_name') }} - @stack('title' ?? '')</title>

    <!-- Favicon -->
    @if(centralDomain() && isAddonInstalled('ALUSAAS'))
        <link rel="icon" href="{{ getSettingImageCentral('app_logo') }}" type="image/png">
    @else
        <link rel="icon" href="{{ getSettingImage('app_logo') }}" type="image/png">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <!-- Retain Boostrap for plugins/tables if needed, but we'll try to override -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.css') }}" />

    <!-- Main Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom Square UI Overrides -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #000000;
            /* Deep Black */
            color: #d1d5db;
            /* Gray 300 */
        }

        .square-card {
            background-color: #111111;
            /* Dark Grey Surface */
            border: 1px solid #27272a;
            /* Zinc 800 */
            border-radius: 12px;
        }

        .square-input {
            background-color: #1a1a1a;
            border: 1px solid #3f3f46;
            color: white;
            border-radius: 8px;
        }

        .square-input:focus {
            border-color: #c5a059;
            /* Gold accent */
            outline: none;
        }
    </style>

    @stack('style')
</head>

<body class="bg-black text-gray-300 font-sans antialiased overflow-x-hidden">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('layouts.sidebar_square')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-black">
            <!-- Navbar -->
            @include('layouts.nav_square')

            <!-- Main Content -->
            <main
                class="flex-1 overflow-y-auto p-6 scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-transparent">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- Use existing app scripts but might need adjustments -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('script')
</body>

</html>