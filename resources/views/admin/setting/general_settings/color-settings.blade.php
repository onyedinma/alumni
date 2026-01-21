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

        /* Premium Upload Box */
        .premium-upload-box {
            background-color: var(--bg-primary);
            border: 2px dashed var(--border-dark);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }

        .premium-upload-box:hover {
            border-color: var(--gold);
            background-color: rgba(212, 175, 90, 0.02);
        }

        .premium-upload-box .icon-box {
            width: 60px;
            height: 60px;
            background: rgba(212, 175, 90, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: var(--gold);
            font-size: 24px;
        }

        .premium-upload-box .preview-image {
            max-width: 100%;
            max-height: 100px;
            object-fit: contain;
            margin-bottom: 16px;
            border-radius: 8px;
            background-color: #f0f0f0;
            /* Light bg for transparent logos */
            padding: 5px;
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

        .premium-upload-box p {
            color: var(--text-secondary);
            margin: 0;
            font-size: 14px;
        }

        /* Form Controls */
        .form-label {
            color: var(--text-primary) !important;
            font-weight: 500;
            margin-bottom: 12px !important;
            display: block !important;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
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

        /* Color Picker Styles */
        .custom-radio-group label {
            color: var(--text-primary);
            margin-right: 15px;
            cursor: pointer;
        }

        input[type="color"] {
            width: 50px;
            height: 50px;
            border: 2px solid var(--border-dark);
            border-radius: 8px;
            background: none;
            cursor: pointer;
            padding: 0;
        }

        input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        input[type="color"]::-webkit-color-swatch {
            border: none;
            border-radius: 6px;
        }

        .color-section-title {
            color: var(--gold);
            border-bottom: 1px solid var(--border-dark);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
        }

        .text-gold {
            color: var(--gold) !important;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-paintbrush" style="color: var(--gold); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">
                        <form class="ajax" action="{{route('admin.setting.application-settings.update')}}" method="POST"
                            enctype="multipart/form-data" data-handler="commonResponseForModal">
                            @csrf

                            <h5 class="text-gold mb-4" style="font-family: 'Playfair Display', serif;">
                                {{ __('Logo & Images') }}
                            </h5>

                            <div class="row g-4 mb-5">
                                <!-- App Preloader -->
                                <div class="col-md-4">
                                    <label class="form-label">{{__('App Preloader')}}</label>
                                    <div class="premium-upload-box">
                                        <div class="icon-box">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        @if(getOption('app_preloader'))
                                            <img src="{{ getSettingImage('app_preloader') }}" class="preview-image" />
                                        @endif
                                        <p>{{__('Drag & drop or click to upload')}}</p>
                                        <p class="mt-1" style="font-size: 12px; opacity: 0.7;">140 x 40 px</p>
                                        <input type="file" name="app_preloader" id="zImageUploadPreloader"
                                            accept="image/*,video/*" onchange="previewFile(this)" />
                                    </div>
                                    @if ($errors->has('app_preloader'))
                                        <span class="text-danger mt-1 d-block"><i class="fas fa-exclamation-triangle"></i>
                                            {{ $errors->first('app_preloader') }}</span>
                                    @endif
                                </div>

                                <!-- Logo Black -->
                                <div class="col-md-4">
                                    <label class="form-label">{{__('Logo Black')}}</label>
                                    <div class="premium-upload-box">
                                        <div class="icon-box">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        @if(getOption('app_black_logo'))
                                            <img src="{{ getSettingImage('app_black_logo') }}" class="preview-image" />
                                        @endif
                                        <p>{{__('Drag & drop or click to upload')}}</p>
                                        <input type="file" name="app_black_logo" id="zImageUploadBlackLogo"
                                            accept="image/*,video/*" onchange="previewFile(this)" />
                                    </div>
                                    @if ($errors->has('app_black_logo'))
                                        <span class="text-danger mt-1 d-block"><i class="fas fa-exclamation-triangle"></i>
                                            {{ $errors->first('app_black_logo') }}</span>
                                    @endif
                                </div>

                                <!-- Logo White -->
                                <div class="col-md-4">
                                    <label class="form-label">{{__('Logo White')}}</label>
                                    <div class="premium-upload-box">
                                        <div class="icon-box">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        @if(getOption('app_logo'))
                                            <img src="{{ getSettingImage('app_logo') }}" class="preview-image p-2 bg-dark" />
                                        @endif
                                        <p>{{__('Drag & drop or click to upload')}}</p>
                                        <p class="mt-1" style="font-size: 12px; opacity: 0.7;">140 x 40 px</p>
                                        <input type="file" name="app_logo" id="zImageUploadLogo" accept="image/*,video/*"
                                            onchange="previewFile(this)" />
                                    </div>
                                    @if ($errors->has('app_logo'))
                                        <span class="text-danger mt-1 d-block"><i class="fas fa-exclamation-triangle"></i>
                                            {{ $errors->first('app_logo') }}</span>
                                    @endif
                                </div>

                                <!-- Fav Icon -->
                                <div class="col-md-4">
                                    <label class="form-label">{{__('App Fav Icon')}}</label>
                                    <div class="premium-upload-box">
                                        <div class="icon-box">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        @if(getOption('app_fav_icon'))
                                            <img src="{{ getSettingImage('app_fav_icon') }}" class="preview-image" />
                                        @endif
                                        <p>{{__('Drag & drop or click to upload')}}</p>
                                        <p class="mt-1" style="font-size: 12px; opacity: 0.7;">16 x 16 px</p>
                                        <input type="file" name="app_fav_icon" id="zImageUploadFavIcon"
                                            accept="image/*,video/*" onchange="previewFile(this)" />
                                    </div>
                                    @if ($errors->has('app_fav_icon'))
                                        <span class="text-danger mt-1 d-block"><i class="fas fa-exclamation-triangle"></i>
                                            {{ $errors->first('app_fav_icon') }}</span>
                                    @endif
                                </div>

                                <!-- Login Left Image -->
                                <div class="col-md-4">
                                    <label class="form-label">{{__('Login Left Image')}}</label>
                                    <div class="premium-upload-box">
                                        <div class="icon-box">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        @if(getOption('login_left_image'))
                                            <img src="{{ getSettingImage('login_left_image') }}" class="preview-image" />
                                        @endif
                                        <p>{{__('Drag & drop or click to upload')}}</p>
                                        <input type="file" name="login_left_image" id="zImageUploadLoginImage"
                                            accept="image/*,video/*" onchange="previewFile(this)" />
                                    </div>
                                    @if ($errors->has('login_left_image'))
                                        <span class="text-danger mt-1 d-block"><i class="fas fa-exclamation-triangle"></i>
                                            {{ $errors->first('login_left_image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Color Settings (Hidden by default, structure kept for future use) -->
                            <div class="d-none">
                                <h5 class="color-section-title">{{__('Color Settings')}}</h5>

                                <div class="row mb-4">
                                    <div class="col-lg-3">
                                        <label class="text-white">{{ __('Design Type') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-9 custom-radio-group">
                                        <input type="radio" id="default" name="app_color_design_type" value="1" {{
        (empty(getOption('app_color_design_type')) ||
            getOption('app_color_design_type') == 1) ? 'checked' : '' }} required>
                                        <label for="default">Default</label>

                                        <input type="radio" id="custom" name="app_color_design_type" value="2" {{
        getOption('app_color_design_type') == 2 ? 'checked' : '' }}>
                                        <label for="custom">{{__('Custom')}}</label>
                                    </div>
                                </div>

                                <div class="customDiv">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-3"><label
                                                class="text-secondary">{{ __('Primary Color') }}</label></div>
                                        <div class="col-lg-9">
                                            <input type="color" name="app_primary_color" id="colorPicker1"
                                                value="{{ empty(getOption('app_primary_color')) ? '#FF671B' : getOption('app_primary_color') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-3"><label
                                                class="text-secondary">{{ __('Secondary Color') }}</label></div>
                                        <div class="col-lg-9">
                                            <input type="color" name="app_secondary_color" id="colorPicker2"
                                                value="{{ empty(getOption('app_secondary_color')) ? '#111111' : getOption('app_secondary_color') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-3"><label class="text-secondary">{{ __('Text Color') }}</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="color" name="app_text_color" id="colorPicker3"
                                                value="{{ empty(getOption('app_text_color')) ? '#585858' : getOption('app_text_color') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-3"><label
                                                class="text-secondary">{{ __('Section Background Color') }}</label></div>
                                        <div class="col-lg-9">
                                            <input type="color" name="app_section_bg_color" id="colorPicker4"
                                                value="{{ empty(getOption('app_section_bg_color')) ? '#FFFAF7' : getOption('app_section_bg_color') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>{{ __('Hero Background Color') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 mb-15">
                                            <span class="color-picker d-flex flex-wrap">
                                                <label for="colorPicker8" class="mb-0 me-3">
                                                    <input class="color1" type="color" name="app_hero_bg_color1"
                                                        value="{{  getOption('app_hero_bg_color1') }}" id="colorPicker8">
                                                </label>
                                                <label for="colorPicker9" class="mb-0 me-3">
                                                    <input class="color2" type="color" name="app_hero_bg_color2"
                                                        value="{{  getOption('app_hero_bg_color2') }}" id="colorPicker9">
                                                </label>
                                            </span>
                                            <div id="gradient" class="p-5">
                                                <input class="app_hero_bg_color" type="hidden" name="app_hero_bg_color"
                                                    value="{{  getOption('app_hero_bg_color') }}">
                                                <h5 class="text-white">{{ __('Current CSS Background') }}</h5>
                                                <h6 id="textContent" class="text-white"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button type="submit" class="premium-btn">{{__('Update Settings')}}</button>
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
        const colorDesignType = "{{ empty(getOption('app_color_design_type')) ? 1 : getOption('app_color_design_type') }}";

        function previewFile(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    // Find the image in this box (if exists) or create one
                    var box = $(input).closest('.premium-upload-box');
                    var img = box.find('img.preview-image');

                    if (img.length === 0) {
                        // Add image before the input if it doesn't exist
                        $('<img class="preview-image" src="" />').insertBefore(box.find('p').first());
                        img = box.find('img.preview-image');
                    }

                    img.attr('src', reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush