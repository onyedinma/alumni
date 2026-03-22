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

        /* Modal Styling */
        .modal-content {
            background-color: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5) !important;
        }

        .modal-header {
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 20px 30px !important;
        }

        .modal-title {
            color: var(--gold, #D4AF5A) !important;
            font-family: 'Playfair Display', serif !important;
            font-weight: 600 !important;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .modal-body {
            padding: 30px !important;
        }

        .modal-footer {
            border-top: 1px solid var(--border-dark, #1F2630) !important;
            padding: 20px 30px !important;
        }

        /* Data Table Styling */
        .customers__area {
            background: transparent !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: var(--text-secondary, #B4BCC8) !important;
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_filter input {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
            border-radius: 8px !important;
            padding: 8px 15px !important;
        }

        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
            margin-top: 20px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
        }

        table.dataTable thead th {
            background-color: var(--bg-primary, #0B0E11) !important;
            color: var(--gold, #D4AF5A) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 15px 20px !important;
            font-family: 'Playfair Display', serif !important;
            font-weight: 600 !important;
        }

        table.dataTable tbody td {
            background-color: var(--bg-surface, #12161C) !important;
            color: var(--text-secondary, #B4BCC8) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 15px 20px !important;
            vertical-align: middle !important;
        }

        table.dataTable tbody tr:hover td {
            background-color: rgba(212, 175, 90, 0.05) !important;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-images"
                    style="color: var(--gold); margin-right: 10px;"></i>{{ __('Website Setting') }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.website_settings.partials.sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">
                        <div class="p-4 border-bottom border-dark mb-4 d-flex justify-content-between align-items-center">
                            <h5 class="text-gold mb-0" style="font-family: 'Playfair Display', serif;">{{ $title }}</h5>
                            <button class="premium-btn py-2 px-4 fs-14" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-modal">
                                <i class="fa fa-plus me-2"></i> {{ __('Add New') }}
                            </button>
                        </div>

                        <input type="hidden" id="gallery-route"
                            value="{{ route('admin.setting.website-settings.image_galleries.index') }}">

                        <div class="table-responsive">
                            <table class="table" id="photoGalleryDataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('SL#') }}</th>
                                        <th scope="col">{{ __('Caption') }}</th>
                                        <th scope="col">{{ __('Photo') }}</th>
                                        <th scope="col" class="text-end">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal section start -->
    <div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Photo') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="ajax reset" action="{{ route('admin.setting.website-settings.image_galleries.store') }}"
                    method="post" data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="caption" class="form-label">{{ __('Caption') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="premium-input-group">
                                            <span class="premium-input-group-text"><i
                                                    class="fa-solid fa-heading"></i></span>
                                            <input type="text" class="primary-form-control" name="caption" id="caption"
                                                required placeholder="{{ __('Caption') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <label class="form-label">{{ __('Upload Photo') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-upload-box">
                                        <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="upload-text">{{ __('Drag & drop image here or click to browse') }}
                                        </div>
                                        <p class="small text-muted mb-0">(jpg, jpeg, png)</p>
                                        <input type="file" name="photo" accept="image/*" onchange="previewFile(this)">
                                        <div class="mt-3">
                                            <img src="" class="upload-preview" style="display:none;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="premium-btn w-100">{{ __('Save Photo') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->

    <!-- Edit Modal section start -->
    <div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Content will be loaded via AJAX with consistent styling -->
            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->

    @include('admin.website_settings.partials.upload-preview-script')
@endsection
@push('script')
    <script src="{{ asset('admin/js/photo-gallery.js') }}"></script>
@endpush