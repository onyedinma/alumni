@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <style>
        .premium-admin-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .premium-card {
            background-color: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
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
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
        }

        .premium-sidebar-container {
            background-color: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
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
            color: var(--text-secondary, #B4BCC8) !important;
            padding: 12px 15px !important;
            border-radius: 12px !important;
            transition: all 0.3s ease !important;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .premium-sidebar-container .list-item:hover,
        .premium-sidebar-container .list-item.active {
            background: rgba(212, 175, 90, 0.1) !important;
            color: var(--gold, #D4AF5A) !important;
            border-left-color: var(--gold, #D4AF5A);
        }

        .premium-input-group {
            display: flex;
            align-items: stretch;
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: var(--bg-primary, #0B0E11);
        }

        .premium-input-group:focus-within {
            border-color: var(--gold, #D4AF5A);
            box-shadow: 0 0 0 2px rgba(212, 175, 90, 0.2);
        }

        .premium-input-group-text {
            background: var(--bg-elevated, #171C23);
            border-right: 1px solid var(--border-dark, #1F2630);
            color: var(--gold, #D4AF5A);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
        }

        .premium-input-group .primary-form-control {
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            height: auto;
        }

        .primary-form-control {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
            border-radius: 12px;
            padding: 12px 16px;
            width: 100%;
        }

        .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
            box-shadow: 0 0 0 2px rgba(212, 175, 90, 0.2) !important;
        }

        .form-label {
            color: var(--text-primary, #E6EAF0) !important;
            font-weight: 500;
            margin-bottom: 12px !important;
            display: block !important;
        }

        .primary-form-group-wrap {
            display: block !important;
            position: relative !important;
            padding-top: 5px !important;
        }

        .primary-form-group.my-2 {
            padding-top: 0 !important;
            margin-top: 1.5rem !important;
        }

        .premium-btn {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
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

        h4 {
            color: var(--text-primary, #fff) !important;
        }

        .section-title {
            color: var(--gold, #D4AF5A);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background-color: var(--bg-elevated, #171C23);
            border: 1px solid var(--border-dark, #1F2630);
            transition: 0.3s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 3px;
            background-color: var(--text-secondary, #B4BCC8);
            transition: 0.3s;
            border-radius: 50%;
        }

        .toggle-switch input:checked + .toggle-slider {
            background-color: var(--gold, #D4AF5A);
            border-color: var(--gold, #D4AF5A);
        }

        .toggle-switch input:checked + .toggle-slider:before {
            transform: translateX(24px);
            background-color: #000;
        }

        .toggle-label {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-primary, #E6EAF0);
        }

        .countdown-preview {
            background: linear-gradient(135deg, #1A1A2E, #0D0D0D);
            border: 1px solid rgba(212, 175, 90, 0.3);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            margin-top: 20px;
        }

        .countdown-preview-title {
            color: #D4AF5A;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .countdown-preview-timer {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .countdown-preview-item {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(212, 175, 90, 0.3);
            border-radius: 12px;
            padding: 15px 20px;
        }

        .countdown-preview-number {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: #D4AF5A;
        }

        .countdown-preview-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-clock" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">
                        <div class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
                            <div class="item-top mb-30">
                                <h4>{{ $title }}</h4>
                            </div>
                            <form class="ajax" action="{{ route('admin.setting.reunion-settings.update') }}" method="POST"
                                enctype="multipart/form-data" data-handler="settingCommonHandler">
                                @csrf

                                <!-- Enable Toggle -->
                                <div class="section-title">
                                    <i class="fa-solid fa-toggle-on"></i> {{ __('Countdown Status') }}
                                </div>

                                <div class="primary-form-group my-2">
                                    <div class="primary-form-group-wrap">
                                        <label class="toggle-label">
                                            <label class="toggle-switch">
                                                <input type="checkbox" name="reunion_countdown_enabled" value="1"
                                                    {{ getOption('reunion_countdown_enabled') == '1' ? 'checked' : '' }}>
                                                <span class="toggle-slider"></span>
                                            </label>
                                            <span>{{ __('Enable Reunion Countdown on Homepage') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Event Details -->
                                <div class="section-title mt-4">
                                    <i class="fa-solid fa-calendar-day"></i> {{ __('Event Details') }}
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('Reunion Title') }}</label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i
                                                            class="fa-solid fa-heading"></i></span>
                                                    <input type="text" name="reunion_title"
                                                        value="{{ getOption('reunion_title', 'Annual Alumni Reunion') }}" class="primary-form-control"
                                                        placeholder="{{ __('e.g., Annual Alumni Reunion 2026') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('Reunion Date') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i
                                                            class="fa-solid fa-calendar"></i></span>
                                                    <input type="datetime-local" name="reunion_date"
                                                        value="{{ getOption('reunion_date') }}"
                                                        class="primary-form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('Venue / Location') }}</label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i
                                                            class="fa-solid fa-location-dot"></i></span>
                                                    <input type="text" name="reunion_location"
                                                        value="{{ getOption('reunion_location') }}" class="primary-form-control"
                                                        placeholder="{{ __('e.g., School Auditorium, Lagos, Nigeria') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview -->
                                <div class="countdown-preview">
                                    <div class="countdown-preview-title">{{ __('Preview') }}</div>
                                    <div class="countdown-preview-timer">
                                        <div class="countdown-preview-item">
                                            <div class="countdown-preview-number">00</div>
                                            <div class="countdown-preview-label">{{ __('Days') }}</div>
                                        </div>
                                        <div class="countdown-preview-item">
                                            <div class="countdown-preview-number">00</div>
                                            <div class="countdown-preview-label">{{ __('Hours') }}</div>
                                        </div>
                                        <div class="countdown-preview-item">
                                            <div class="countdown-preview-number">00</div>
                                            <div class="countdown-preview-label">{{ __('Minutes') }}</div>
                                        </div>
                                        <div class="countdown-preview-item">
                                            <div class="countdown-preview-number">00</div>
                                            <div class="countdown-preview-label">{{ __('Seconds') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="input__group general-settings-btn text-end">
                                            <button type="submit" class="premium-btn">
                                                <i class="fa-solid fa-save me-2"></i>{{ __('Save Changes') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
