@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <style>
        /* Premium Admin Panel Standards */
        :root {
            --bg-primary: #0B0E11;
            --bg-surface: #12161C;
            --border-dark: #1F2630;
            --maroon: #8B2635;
            --gold: #D4AF5A;
            --text-primary: #E6EAF0;
            --text-secondary: #B4BCC8;
        }

        .premium-admin-panel {
            background-color: var(--bg-primary);
            min-height: 100vh;
            padding: 30px;
        }

        .premium-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-dark);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon), var(--gold), var(--maroon));
        }

        /* Sidebar Styling Override */
        .premium-sidebar-container {
            background-color: var(--bg-surface) !important;
            border: 1px solid var(--border-dark) !important;
            border-radius: 24px;
            height: 100%;
            padding: 30px;
        }

        .premium-sidebar-container .email__sidebar.bg-style {
            background: transparent !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
        }

        .premium-sidebar-container .list-item {
            color: var(--text-secondary) !important;
            padding: 12px 15px !important;
            border-radius: 12px !important;
            transition: all 0.3s ease !important;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .premium-sidebar-container .list-item:hover {
            background: rgba(212, 175, 90, 0.1) !important;
            color: var(--gold) !important;
            border-left-color: var(--gold);
        }

        .premium-sidebar-container .list-item .fa {
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .premium-sidebar-container .list-item:hover .fa {
            color: var(--gold);
        }

        /* Cache Item Row */
        .premium-cache-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid var(--border-dark);
            transition: background-color 0.3s ease;
        }

        .premium-cache-item:last-child {
            border-bottom: none;
        }

        .premium-cache-item:hover {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .premium-cache-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .premium-cache-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(212, 175, 90, 0.1);
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .premium-cache-title {
            color: var(--text-primary);
            font-size: 16px;
            font-weight: 500;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }

        /* Buttons */
        .premium-btn-sm {
            background: transparent !important;
            color: var(--gold) !important;
            border: 1px solid var(--gold) !important;
            font-weight: 500 !important;
            border-radius: 8px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .premium-btn-sm:hover {
            background: var(--gold) !important;
            color: #000 !important;
            transform: translateY(-2px);
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-server" style="color: var(--gold); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card p-0">
                        <div class="p-4 border-bottom border-dark">
                            <h5 class="text-gold mb-0" style="font-family: 'Playfair Display', serif;">
                                {{ __('System Maintenance') }}</h5>
                        </div>

                        <!-- Clear View Cache -->
                        <div class="premium-cache-item">
                            <div class="premium-cache-info">
                                <div class="premium-cache-icon">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <h6 class="premium-cache-title">{{ __('Clear View Cache') }}</h6>
                            </div>
                            <a href="{{ route('admin.setting.cache-update', 1) }}" class="premium-btn-sm">
                                <i class="fas fa-broom me-2"></i>{{ __('Clear Cache') }}
                            </a>
                        </div>

                        <!-- Clear Route Cache -->
                        <div class="premium-cache-item">
                            <div class="premium-cache-info">
                                <div class="premium-cache-icon">
                                    <i class="fa-solid fa-route"></i>
                                </div>
                                <h6 class="premium-cache-title">{{ __('Clear Route Cache') }}</h6>
                            </div>
                            <a href="{{ route('admin.setting.cache-update', 2) }}" class="premium-btn-sm">
                                <i class="fas fa-broom me-2"></i>{{ __('Clear Cache') }}
                            </a>
                        </div>

                        <!-- Clear Config Cache -->
                        <div class="premium-cache-item">
                            <div class="premium-cache-info">
                                <div class="premium-cache-icon">
                                    <i class="fa-solid fa-cogs"></i>
                                </div>
                                <h6 class="premium-cache-title">{{ __('Clear Config Cache') }}</h6>
                            </div>
                            <a href="{{ route('admin.setting.cache-update', 3) }}" class="premium-btn-sm">
                                <i class="fas fa-broom me-2"></i>{{ __('Clear Cache') }}
                            </a>
                        </div>

                        <!-- Application Clear Cache -->
                        <div class="premium-cache-item">
                            <div class="premium-cache-info">
                                <div class="premium-cache-icon">
                                    <i class="fa-solid fa-sync"></i>
                                </div>
                                <h6 class="premium-cache-title">{{ __('Application Clear Cache') }}</h6>
                            </div>
                            <a href="{{ route('admin.setting.cache-update', 4) }}" class="premium-btn-sm">
                                <i class="fas fa-broom me-2"></i>{{ __('Clear Cache') }}
                            </a>
                        </div>

                        <!-- Storage Link -->
                        <div class="premium-cache-item">
                            <div class="premium-cache-info">
                                <div class="premium-cache-icon">
                                    <i class="fa-solid fa-hdd"></i>
                                </div>
                                <h6 class="premium-cache-title">{{ __('Storage Link') }}</h6>
                            </div>
                            <a href="{{ route('admin.setting.cache-update', 5) }}" class="premium-btn-sm">
                                <i class="fas fa-link me-2"></i>{{ __('Create Link') }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection