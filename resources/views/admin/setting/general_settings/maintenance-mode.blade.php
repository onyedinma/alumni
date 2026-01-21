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

        /* Form Controls */
        .premium-form-control {
            background-color: var(--bg-primary) !important;
            border: 1px solid var(--border-dark) !important;
            color: var(--text-primary) !important;
            border-radius: 12px !important;
            padding: 12px 15px !important;
            height: auto !important;
        }

        .premium-form-control:focus {
            border-color: var(--gold) !important;
            box-shadow: 0 0 0 2px rgba(212, 175, 90, 0.2) !important;
        }

        .form-label {
            color: var(--text-primary) !important;
            font-weight: 500;
            margin-bottom: 8px !important;
            font-family: 'Playfair Display', serif;
        }

        /* Info Box */
        .premium-info-box {
            background: rgba(212, 175, 90, 0.05);
            border: 1px dashed var(--gold);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .premium-info-box h5 {
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .premium-info-box p,
        .premium-info-box li {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.6;
        }

        .premium-info-box li {
            margin-bottom: 10px;
        }

        .premium-info-box b {
            color: var(--text-primary);
        }

        .premium-info-box .iconify {
            color: var(--gold);
            vertical-align: middle;
            margin: 0 5px;
        }

        /* Buttons */
        .premium-btn {
            background: linear-gradient(135deg, var(--gold) 0%, #b8934a 100%) !important;
            color: #000 !important;
            border: none !important;
            font-weight: 600 !important;
            border-radius: 12px;
            padding: 12px 30px;
            transition: all 0.3s ease;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-wrench" style="color: var(--gold); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">

                        <div class="premium-info-box">
                            <h5><i class="fas fa-info-circle me-2"></i>{{ __('Instructions') }}</h5>
                            <p>{{ __("You need to follow some instruction after maintenance mode changes. Instruction list given below-") }}
                            </p>
                            <div class="ps-3">
                                <ul style="list-style-type: none; padding-left: 0;">
                                    <li>
                                        <i class="fas fa-angle-right me-2 text-gold"></i>
                                        {{ __("If you select maintenance mode") }} <b>{{ __("Maintenance O") }}n</b>,
                                        {{__("you need to input secret key for maintenance work. Otherwise you can't work this website. And your created secret key helps you to work under maintenance.")}}
                                    </li>
                                    <li>
                                        <i class="fas fa-angle-right me-2 text-gold"></i>
                                        {{ __("After created maintenance key, you can use this website secretly through this url") }}
                                        <span class="iconify" data-icon="arcticons:url-forwarder"></span>
                                        <span class="text-gold">{{ url('/') }}/(Your created secret key)</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-angle-right me-2 text-gold"></i>
                                        {{__("Only one time url is browsing with secret key, and you can browse your site in maintenance mode. When maintenance mode on, any user can see maintenance mode error message.")}}
                                    </li>
                                    <li>
                                        <i class="fas fa-angle-right me-2 text-gold"></i>
                                        {{ __("Unfortunately you forget your secret key and try to connect with your website.") }}
                                        <br> {{ __("Then you go to your project folder location") }}
                                        <b>{{ __("Main Files") }}</b>{{ __("(where your file in cpanel or your hosting)") }}
                                        <span class="iconify"
                                            data-icon="arcticons:url-forwarder"></span><b>{{ __("storage") }}</b>
                                        <span class="iconify"
                                            data-icon="arcticons:url-forwarder"></span><b>{{ __("framework") }}</b>.
                                        {{ __("You can see 2 files and need to delete 2 files. Files are:") }}
                                        <br>
                                        {{ __("1. down") }} <br>
                                        {{ __("2. maintenance.php") }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <form class="ajax" action="{{route('admin.setting.maintenance.change')}}" method="POST"
                            enctype="multipart/form-data" data-handler="commonResponseForModal">
                            @csrf

                            <div class="row mb-4 align-items-center">
                                <label class="col-lg-3 form-label">{{ __('Maintenance Mode') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select name="maintenance_mode" class="premium-form-control maintenance_mode">
                                        <option value="">--{{ __('Select Option') }}--</option>
                                        <option value="1" @if(getOption('maintenance_mode') == 1) selected @endif>
                                            {{ __('Maintenance On') }}
                                        </option>
                                        <option value="2" @if(getOption('maintenance_mode') != 1) selected @endif>
                                            {{ __('Live') }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4 align-items-center">
                                <label class="col-lg-3 form-label">{{ __('Maintenance Mode Secret Key') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="maintenance_secret_key"
                                        value="{{ getOption('maintenance_secret_key') }}" minlength="6"
                                        class="premium-form-control maintenance_secret_key">
                                </div>
                            </div>

                            <div class="row mb-4 align-items-center">
                                <label class="col-lg-3 form-label">{{ __('Maintenance Mode Url') }} </label>
                                <div class="col-lg-9">
                                    <input type="text" name="" value="" class="premium-form-control maintenance_mode_url"
                                        disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" class="premium-btn">{{ __('Update Settings') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        'use strict'
        let getUrl = "{{ url('') }}";
        const maintenanceSecretKey = "{{ getOption('maintenance_secret_key') }}";
        const maintenanceModeConst = "{{ getOption('maintenance_mode') }}";
    </script>
    <script src="{{ asset('admin/js/maintenance-mode.js') }}"></script>
@endpush