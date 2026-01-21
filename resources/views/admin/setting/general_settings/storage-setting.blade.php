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
            /* overflow: hidden; Removed to allow dropdowns */
            transition: all 0.3s ease;
            background-color: var(--bg-primary, #0B0E11);
        }

        .premium-input-group> :first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .premium-input-group> :last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
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

        /* Form Controls & Labels - Explicit Non-Overlapping */
        .primary-form-control {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
            border-radius: 12px;
            padding: 12px 16px;
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
        }

        .primary-form-group {
            margin-bottom: 24px;
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .premium-btn-outline {
            background: transparent !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            color: var(--gold, #D4AF5A) !important;
            border-radius: 12px;
            padding: 12px 30px;
            transition: all 0.3s ease;
        }

        .premium-btn-outline:hover {
            background: rgba(212, 175, 90, 0.1) !important;
        }

        .storage-instruction-box {
            background: rgba(212, 175, 90, 0.05);
            border: 1px solid rgba(212, 175, 90, 0.2);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 30px;
        }

        h4 {
            color: var(--text-primary, #fff) !important;
        }

        /* Select styling override */
        select.primary-form-control {
            appearance: auto !important;
            /* Force native appearance */
            background-color: var(--bg-primary, #0B0E11) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        select.primary-form-control option {
            background: var(--bg-primary, #0B0E11);
            color: var(--text-primary, #E6EAF0);
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-server" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">
                        <div
                            class="storage-instruction-box d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div>
                                <h5 class="text-white mb-2" style="font-family: 'Playfair Display', serif;">
                                    {{ __('Configuration Instructions') }}
                                </h5>
                                <p class="text-secondary mb-0">
                                    {{ __('Select your storage driver first, then click "Storage Link" to create the symbolic link.') }}
                                </p>
                            </div>
                            <a href="{{route('admin.setting.storage.link')}}"
                                class="premium-btn-outline text-decoration-none">
                                <i class="fa-solid fa-link"></i> {{ __('Storage Link') }}
                            </a>
                        </div>

                        <form class="ajax" action="{{route('admin.setting.storage.update')}}" method="POST"
                            enctype="multipart/form-data" data-handler="settingCommonHandler">
                            @csrf

                            <div class="primary-form-group">
                                <label for="storage_driver" class="form-label">{{ __('Storage Driver') }}</label>
                                <div class="premium-input-group">
                                    <span class="premium-input-group-text"><i class="fa-solid fa-database"></i></span>
                                    <select name="STORAGE_DRIVER" id="storage_driver" class="primary-form-control" required
                                        style="flex: 1;">
                                        <option value="{{ STORAGE_DRIVER_PUBLIC }}" {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_PUBLIC ? 'selected' : '' }}>
                                            {{__('Public')}}
                                        </option>
                                        <option value="{{ STORAGE_DRIVER_AWS }}" {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_AWS ? 'selected' : '' }}>{{__('AWS')}}
                                        </option>
                                        <option value="{{ STORAGE_DRIVER_WASABI }}" {{ env('STORAGE_DRIVER') == STORAGE_DRIVER_WASABI ? 'selected' : '' }}>
                                            {{__('Wasabi')}}
                                        </option>
                                        <option value="{{ STORAGE_DRIVER_VULTR }}" {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_VULTR ? 'selected' : '' }}>{{__('Vultr')}}
                                        </option>
                                        <option value="{{ STORAGE_DRIVER_DO }}" {{  env('STORAGE_DRIVER') == STORAGE_DRIVER_DO ? 'selected' : '' }}>{{__('Digital Ocean (DO)')}}</option>
                                    </select>
                                </div>
                            </div>

                            <!-- AWS Settings -->
                            <div class="d-none storage-driver" id="aws">
                                <h5 class="text-gold mb-3 mt-4 border-bottom border-dark pb-2">{{ __('AWS Configuration') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('AWS Access Key ID') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-key"></i></span>
                                                <input type="text" name="AWS_ACCESS_KEY_ID"
                                                    value="{{ env('AWS_ACCESS_KEY_ID') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('AWS Secret Access Key') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-lock"></i></span>
                                                <input type="text" name="AWS_SECRET_ACCESS_KEY"
                                                    value="{{ env('AWS_SECRET_ACCESS_KEY') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('AWS Default Region') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-globe"></i></span>
                                                <input type="text" name="AWS_DEFAULT_REGION"
                                                    value="{{ env('AWS_DEFAULT_REGION') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('AWS Bucket') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-box"></i></span>
                                                <input type="text" name="AWS_BUCKET" value="{{ env('AWS_BUCKET') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Wasabi Settings -->
                            <div class="d-none storage-driver" id="wasabi">
                                <h5 class="text-gold mb-3 mt-4 border-bottom border-dark pb-2">
                                    {{ __('Wasabi Configuration') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('WAS Access Key ID') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-key"></i></span>
                                                <input type="text" name="WASABI_ACCESS_KEY_ID"
                                                    value="{{ env('WASABI_ACCESS_KEY_ID') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('WAS Secret Access Key') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-lock"></i></span>
                                                <input type="text" name="WASABI_SECRET_ACCESS_KEY"
                                                    value="{{ env('WASABI_SECRET_ACCESS_KEY') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('WAS Default Region') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-globe"></i></span>
                                                <input type="text" name="WASABI_DEFAULT_REGION"
                                                    value="{{ env('WASABI_DEFAULT_REGION') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('WAS Bucket') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-box"></i></span>
                                                <input type="text" name="WASABI_BUCKET" value="{{ env('WASABI_BUCKET') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vultr Settings -->
                            <div class="d-none storage-driver" id="vultr">
                                <h5 class="text-gold mb-3 mt-4 border-bottom border-dark pb-2">
                                    {{ __('Vultr Configuration') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('VULTR Access Key') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-key"></i></span>
                                                <input type="text" name="VULTR_ACCESS_KEY_ID"
                                                    value="{{ env('VULTR_ACCESS_KEY') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('VULTR Secret Key') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-lock"></i></span>
                                                <input type="text" name="VULTR_SECRET_ACCESS_KEY"
                                                    value="{{ env('VULTR_SECRET_KEY') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('VULTR Region') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-globe"></i></span>
                                                <input type="text" name="VULTR_DEFAULT_REGION"
                                                    value="{{ env('VULTR_REGION') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('VULTR Bucket') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-box"></i></span>
                                                <input type="text" name="VULTR_BUCKET" value="{{ env('VULTR_BUCKET') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Digital Ocean Settings -->
                            <div class="d-none storage-driver" id="do">
                                <h5 class="text-gold mb-3 mt-4 border-bottom border-dark pb-2">
                                    {{ __('Digital Ocean Configuration') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('DO Access Key ID') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-key"></i></span>
                                                <input type="text" name="DO_ACCESS_KEY_ID"
                                                    value="{{ env('DO_ACCESS_KEY_ID') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('DO Secret Access Key') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-lock"></i></span>
                                                <input type="text" name="DO_SECRET_ACCESS_KEY"
                                                    value="{{ env('DO_SECRET_ACCESS_KEY') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('DO Default Region') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-globe"></i></span>
                                                <input type="text" name="DO_DEFAULT_REGION"
                                                    value="{{ env('DO_DEFAULT_REGION') }}" class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('DO Bucket') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-box"></i></span>
                                                <input type="text" name="DO_BUCKET" value="{{ env('DO_BUCKET') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('DO Folder') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-folder"></i></span>
                                                <input type="text" name="DO_FOLDER" value="{{ env('DO_FOLDER') }}"
                                                    class="primary-form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <label class="form-label">{{ __('DO CDN ID') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="premium-input-group">
                                                <span class="premium-input-group-text"><i
                                                        class="fa-solid fa-id-card"></i></span>
                                                <input type="text" name="DO_CDN_ID" value="{{ env('DO_CDN_ID') }}"
                                                    class="primary-form-control">
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
    <script src="{{ asset('admin/js/storage-settings.js') }}"></script>
    <script>
        // Ensure initial state is correct and handle changes
        $(document).ready(function () {
            function updateStorageFields() {
                var selectedDriver = $('#storage_driver').val();
                $('.storage-driver').addClass('d-none');

                if (selectedDriver === 'aws') $('#aws').removeClass('d-none');
                if (selectedDriver === 'wasabi') $('#wasabi').removeClass('d-none');
                if (selectedDriver === 'vultr') $('#vultr').removeClass('d-none');
                if (selectedDriver === 'do') $('#do').removeClass('d-none');
                if (selectedDriver === 'public') { /* do nothing else */ }
            }

            // Initial call
            updateStorageFields();

            // Handle changes
            $('#storage_driver').on('change', function () {
                updateStorageFields();
            });
        });
    </script>
@endpush