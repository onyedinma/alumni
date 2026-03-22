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

        .crest-preview {
            width: 120px;
            height: 120px;
            border-radius: 16px;
            border: 2px dashed var(--border-dark, #1F2630);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--bg-elevated, #171C23);
        }

        .crest-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .section-divider {
            border-top: 1px solid var(--border-dark, #1F2630);
            margin: 30px 0;
            padding-top: 30px;
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
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-school" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
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
                            <form class="ajax" action="{{ route('admin.setting.school-identity.update') }}" method="POST"
                                enctype="multipart/form-data" data-handler="settingCommonHandler">
                                @csrf

                                <!-- Basic Info -->
                                <div class="section-title">
                                    <i class="fa-solid fa-info-circle"></i> {{ __('Basic Information') }}
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('School Motto') }}</label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i
                                                            class="fa-solid fa-quote-left"></i></span>
                                                    <input type="text" name="school_motto"
                                                        value="{{ getOption('school_motto') }}" class="primary-form-control"
                                                        placeholder="{{ __('e.g., Knowledge is Power') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('Year Founded') }}</label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i
                                                            class="fa-solid fa-calendar"></i></span>
                                                    <input type="text" name="school_founded_year"
                                                        value="{{ getOption('school_founded_year') }}"
                                                        class="primary-form-control" placeholder="{{ __('e.g., 1960') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- School Crest -->
                                <div class="section-divider">
                                    <div class="section-title">
                                        <i class="fa-solid fa-shield"></i> {{ __('School Crest') }}
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="crest-preview">
                                                @if(getOption('school_crest'))
                                                    <img src="{{ getFileUrl(getOption('school_crest')) }}" alt="School Crest">
                                                @else
                                                    <i class="fa-solid fa-shield-alt"
                                                        style="font-size: 40px; color: var(--text-secondary);"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="primary-form-group my-2">
                                                <div class="primary-form-group-wrap">
                                                    <label class="form-label">{{ __('Upload School Crest') }}</label>
                                                    <input type="file" name="school_crest" class="primary-form-control"
                                                        accept="image/*">
                                                    <small
                                                        class="text-muted">{{ __('Recommended: PNG with transparent background, 200x200px') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- School Anthem -->
                                <div class="section-divider">
                                    <div class="section-title">
                                        <i class="fa-solid fa-music"></i> {{ __('School Anthem') }}
                                    </div>
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Anthem Lyrics') }}</label>
                                            <textarea name="school_anthem" class="primary-form-control" rows="8"
                                                placeholder="{{ __('Enter the school anthem lyrics here...') }}">{{ getOption('school_anthem') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- School History -->
                                <div class="section-divider">
                                    <div class="section-title">
                                        <i class="fa-solid fa-landmark"></i> {{ __('School History') }}
                                    </div>
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('History & Background') }}</label>
                                            <textarea name="school_history" class="primary-form-control" rows="10"
                                                placeholder="{{ __('Enter the school history and background...') }}">{{ getOption('school_history') }}</textarea>
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