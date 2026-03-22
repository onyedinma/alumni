@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@section('content')
    <style>
        /* Premium Admin Panel Standards */
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

        /* Sidebar Styling Override */
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

        .premium-sidebar-container .list-item:hover {
            background: rgba(212, 175, 90, 0.1) !important;
            color: var(--gold, #D4AF5A) !important;
            border-left-color: var(--gold, #D4AF5A);
        }

        .premium-sidebar-container .list-item .fa {
            color: var(--text-secondary, #B4BCC8);
            transition: color 0.3s ease;
        }

        .premium-sidebar-container .list-item:hover .fa {
            color: var(--gold, #D4AF5A);
        }

        /* Input Group Styling */
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

        /* Form Controls */
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
            position: static !important;
            transform: none !important;
            background: transparent !important;
            padding: 0 !important;
            font-family: 'Playfair Display', serif;
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

        /* Buttons */
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

        /* File Upload */
        .premium-upload-box {
            border: 2px dashed var(--border-dark, #1F2630);
            background-color: var(--bg-primary, #0B0E11);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .premium-upload-box:hover {
            border-color: var(--gold, #D4AF5A);
            background-color: rgba(212, 175, 90, 0.05);
        }

        .premium-upload-box input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            font-size: 32px;
            color: var(--gold, #D4AF5A);
            margin-bottom: 15px;
        }

        .upload-text {
            color: var(--text-secondary, #B4BCC8);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .upload-preview {
            margin-top: 15px;
            max-width: 100%;
            border-radius: 8px;
            max-height: 150px;
            object-fit: contain;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-globe" style="color: var(--gold); margin-right: 10px;"></i>{{ __('Website Setting') }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.website_settings.partials.sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">
                        <div class="p-4 border-bottom border-dark mb-4">
                            <h5 class="text-gold mb-0" style="font-family: 'Playfair Display', serif;">{{ $title }}</h5>
                        </div>

                        <form class="ajax" action="{{ route('admin.setting.application-settings.update') }}" method="POST"
                            enctype="multipart/form-data" data-handler="settingCommonHandler">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Site Facebook Url') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text">
                                                    <i class="fab fa-facebook-f"></i>
                                                </span>
                                                <input type="url" name="facebook_url"
                                                    value="{{ getOption('facebook_url') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Site Linkedin Url') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </span>
                                                <input type="url" name="linkedin_url"
                                                    value="{{ getOption('linkedin_url') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Site Twitter Url') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text">
                                                    <i class="fab fa-twitter"></i>
                                                </span>
                                                <input type="url" name="twitter_url" value="{{ getOption('twitter_url') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Site Instagram Url') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text">
                                                    <i class="fab fa-instagram"></i>
                                                </span>
                                                <input type="url" name="instagram_url"
                                                    value="{{ getOption('instagram_url') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 my-3">
                                    <hr style="border-color: var(--border-dark);">
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Auth Page Title') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-heading"></i></span>
                                                <input type="text" name="sign_up_left_text_title"
                                                    value="{{ getOption('sign_up_left_text_title') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Join Our Community Title') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-heading"></i></span>
                                                <input type="text" name="join_our_community_title"
                                                    value="{{ getOption('join_our_community_title') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Auth Page Subtitle') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-align-left"></i></span>
                                                <textarea name="sign_up_left_text_subtitle" class="primary-form-control"
                                                    rows="3">{{ getOption('sign_up_left_text_subtitle') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Join Our Community Text') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-align-left"></i></span>
                                                <textarea name="join_our_community_text" class="primary-form-control"
                                                    rows="3">{{ getOption('join_our_community_text') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="primary-form-group my-2">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label">{{ __('Footer Left Text') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-align-left"></i></span>
                                                <textarea name="footer_left_text" class="primary-form-control"
                                                    rows="3">{{ getOption('footer_left_text') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 my-3">
                                    <hr style="border-color: var(--border-dark);">
                                    <h5 class="text-gold mb-4" style="font-family: 'Playfair Display', serif;">
                                        {{ __('Background Images') }}
                                    </h5>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <label class="form-label">{{ __('Page Breadcrumb Background') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-upload-box">
                                        <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="upload-text">{{ __('Drag & drop image here or click to browse') }}
                                        </div>
                                        <p class="small text-muted mb-0">(jpg, jpeg, png)</p>
                                        <input type="file" name="page_breadcrumb" accept="image/*"
                                            onchange="previewFile(this)">

                                        <div class="mt-3">
                                            @if (getOption('page_breadcrumb'))
                                                <img src="{{ getSettingImage('page_breadcrumb') }}" class="upload-preview" />
                                            @else
                                                <img src="" class="upload-preview" style="display:none;" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <label class="form-label">{{ __('Our Upcoming Events Background') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-upload-box">
                                        <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="upload-text">{{ __('Drag & drop image here or click to browse') }}
                                        </div>
                                        <p class="small text-muted mb-0">(jpg, jpeg, png)</p>
                                        <input type="file" name="upcoming_events_background" accept="image/*"
                                            onchange="previewFile(this)">

                                        <div class="mt-3">
                                            @if (getOption('upcoming_events_background'))
                                                <img src="{{ getSettingImage('upcoming_events_background') }}"
                                                    class="upload-preview" />
                                            @else
                                                <img src="" class="upload-preview" style="display:none;" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="premium-btn">{{ __('Update Settings') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.website_settings.partials.upload-preview-script')
@endsection