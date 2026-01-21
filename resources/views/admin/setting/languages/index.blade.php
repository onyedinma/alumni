@extends('layouts.app')
@section('content')
    @push('title')
        {{$title}}
    @endpush
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

        /* Table Styling Overrides */
        .premium-card .table-responsive {
            background: transparent !important;
        }

        .premium-card table.zTable,
        .premium-card table.dataTable,
        .premium-card #commonDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead,
        .premium-card table.dataTable thead,
        .premium-card #commonDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th,
        .premium-card table.dataTable thead th,
        .premium-card #commonDataTable thead th,
        .premium-card .dataTable thead th,
        .premium-card th {
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 12px 14px !important;
            background: var(--bg-elevated, #171C23) !important;
            border-top: none !important;
        }

        .premium-card table.zTable thead th div,
        .premium-card th div {
            color: var(--gold, #D4AF5A) !important;
            background: transparent !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .premium-card table.zTable tbody td,
        .premium-card table.dataTable tbody td,
        .premium-card #commonDataTable tbody td,
        .premium-card td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-card table.zTable tbody tr:hover td {
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Buttons */
        .premium-btn {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
            color: #000 !important;
            border: none !important;
            font-weight: 600 !important;
            border-radius: 12px;
            padding: 10px 26px;
            transition: all 0.3s ease;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        /* Modal Styling */
        .modal-content {
            background-color: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 16px;
        }

        .modal-header {
            border-bottom: 1px solid var(--border-dark, #1F2630);
        }

        .modal-footer {
            border-top: 1px solid var(--border-dark, #1F2630);
        }

        .modal-title,
        .modal-body p,
        .modal-body label,
        .form-check-label {
            color: var(--text-primary, #E6EAF0) !important;
        }

        .primary-form-control {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
        }

        /* File Upload */
        .zImage-upload-details {
            border-color: var(--border-dark, #1F2630) !important;
            background-color: var(--bg-primary, #0B0E11) !important;
        }

        .zImage-inside p {
            color: var(--text-secondary, #B4BCC8) !important;
        }

        /* DataTables Pagination & Info */
        .premium-card .dataTables_wrapper .dataTables_length,
        .premium-card .dataTables_wrapper .dataTables_filter,
        .premium-card .dataTables_wrapper .dataTables_info,
        .premium-card .dataTables_wrapper .dataTables_paginate {
            color: var(--text-secondary, #B4BCC8) !important;
            padding-top: 10px;
        }

        .premium-card .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #000 !important;
            background: var(--gold, #D4AF5A) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 6px;
            margin: 0 4px;
        }

        .premium-card .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
            color: #fff !important;
        }
    </style>

    <!-- Page content area start -->
    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-language"
                    style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <input type="hidden" id="language-route" value="{{ route('admin.setting.languages.index') }}">
                <div class="col-lg-12">
                    <div class="premium-card">
                        <div class="d-flex flex-wrap item-title justify-content-end mb-3">
                            <div>
                                <button class="premium-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add-modal">
                                    <i class="fa fa-plus"></i> {{ __('Add Language') }}
                                </button>
                            </div>
                        </div>
                        <div class="customers__table">
                            <div class="table-responsive zTable-responsive">
                                <table class="table zTable" id="commonDataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <div><i class="fa-solid fa-flag"
                                                        style="margin-right: 8px;"></i>{{ __("Flag") }}</div>
                                            </th>
                                            <th scope="col">
                                                <div><i class="fa-solid fa-font"
                                                        style="margin-right: 8px;"></i>{{ __("Language") }}</div>
                                            </th>
                                            <th scope="col">
                                                <div><i class="fa-solid fa-code"
                                                        style="margin-right: 8px;"></i>{{ __("ISO code") }}</div>
                                            </th>
                                            <th scope="col">
                                                <div><i class="fa-solid fa-align-right"
                                                        style="margin-right: 8px;"></i>{{ __("RTL") }}</div>
                                            </th>
                                            <th scope="col">
                                                <div><i class="fa-solid fa-font-case"
                                                        style="margin-right: 8px;"></i>{{ __("Font") }}</div>
                                            </th>
                                            <th scope="col" class="text-center">
                                                <div><i class="fa-solid fa-cog"
                                                        style="margin-right: 8px;"></i>{{ __("Action") }}</div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <!-- Add Modal section start -->
    <div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Language') }}</h5>
                    <button type="button" class="border-0 btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: invert(1);"></button>
                </div>
                <form class="ajax reset" action="{{ route('admin.setting.languages.store') }}" method="post"
                    data-handler="commonResponseForModal" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row rg-25">
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Language') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" name="language"
                                            placeholder="{{ __('Language') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="iso_code" class="form-label">{{ __('ISO Code') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="iso_code" class="primary-form-control" id="sf-select-modal-add">
                                            <option value="">--{{ __('Select ISO Code') }}--</option>
                                            @foreach(languageIsoCode() as $code => $isoCountryName)
                                                <option value="{{$code}}">{{ $isoCountryName . '(' . $code . ')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap zImage-upload-details mw-100">
                                        <div class="zImage-inside">
                                            <div class="d-flex pb-12"><img
                                                    src="{{ asset('assets/images/icon/upload-img-1.svg')}}" alt="" />
                                            </div>
                                            <p class="fs-15 fw-500 lh-16 text-black">{{__('Drag & drop files here')}}</p>
                                        </div>
                                        <label for="zImageUpload" class="form-label">{{__('Flag')}} <span
                                                class="text-mime-type">(jpeg,png,jpg,svg,webp)</span> <span
                                                class="text-danger">*</span></label>
                                        <div class="upload-img-box">
                                            <img src="" />
                                            <input type="file" name="flag" id="flag" accept="image/*"
                                                onchange="previewFile(this)" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label for="attachmentFile" class="form-label">{{ __('Font File') }}</label>
                                    <input type="file" class="primary-form-control" id="attachmentFile"
                                        accept="application/pdf" name="font">
                                    @if ($errors->has('font'))
                                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{
                                        $errors->first('font') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input__group">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label class="form-label" for="rtl">{{ __('RTL Supported') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="rtl" class="sf-select-without-search primary-form-control">
                                                <option value="0">{{__("No")}}</option>
                                                <option value="1">{{__("Yes")}}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex form-check">
                                    <div class="zCheck form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1" name="default"
                                            role="switch" id="flexCheckChecked" />
                                    </div>
                                    <label class="form-check-label ps-3" for="flexCheckChecked">
                                        {{ __('Default Language') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="premium-btn">{{
        __('Save') }}</button>
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

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection
@push('script')
    <script src="{{asset('admin/js/languages.js')}}"></script>
@endpush