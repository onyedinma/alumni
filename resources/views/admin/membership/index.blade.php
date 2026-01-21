@extends('layouts.app')

@push('title')
    {{$title}}
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

        /* Table Styling Overrides */
        .premium-card .table-responsive {
            background: transparent !important;
        }

        .premium-card table.zTable,
        .premium-card table.dataTable,
        .premium-card #membershipDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead,
        .premium-card table.dataTable thead,
        .premium-card #membershipDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th,
        .premium-card table.dataTable thead th,
        .premium-card #membershipDataTable thead th,
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
        .premium-card #membershipDataTable tbody td,
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
        .zModalTwo-content {
            background-color: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 16px;
        }

        .zModalTwo-body h4,
        .zModalTwo-body label {
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
        <div>
            <input type="hidden" id="membership-create-route" value="{{ route('admin.membership.index') }}">

            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-600 premium-header text-white" style="font-family: 'Playfair Display', serif;">
                    <i class="fa-solid fa-crown" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{$title}}
                </h4>
                <button type="submit" class="premium-btn text-black hover-bg-one" data-bs-toggle="modal"
                    data-bs-target="#add-modal"><i class="fa fa-plus"></i> {{ __('Add New')
                    }}</button>
            </div>
            <div class="premium-card">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="membershipDataTable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div><i class="fa-solid fa-id-badge" style="margin-right: 8px;"></i>{{ __('Badge') }}
                                    </div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-heading" style="margin-right: 8px;"></i>{{ __('Title') }}
                                    </div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-dollar-sign" style="margin-right: 8px;"></i>{{ __('Price') }}
                                    </div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-clock" style="margin-right: 8px;"></i>{{ __('Duration') }}
                                    </div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-toggle-on" style="margin-right: 8px;"></i>{{ __('Status') }}
                                    </div>
                                </th>
                                <th class="w-110 text-center" scope="col">
                                    <div><i class="fa-solid fa-cog" style="margin-right: 8px;"></i>{{ __('Action') }}</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <!-- Add Modal section start -->
    <div class="modal fade zModalTwo" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">
                <form class="ajax reset" action="{{ route('admin.membership.store') }}" method="post"
                    data-handler="commonResponseForModal" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body zModalTwo-body model-lg">
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center pb-30">
                            <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{__('Add New')}}</h4>
                            <div class="mClose">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    style="filter: invert(1);"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="primary-form-group mt-2">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Title') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" name="title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group mt-2">
                                    <div class="primary-form-group-wrap">
                                        <label for="eventType" class="form-label">{{__('Duration Type')}} <span
                                                class="text-danger">*</span></label>
                                        <select class="primary-form-control sf-select-without-search" id="eventType"
                                            name="duration_type">
                                            @foreach(getDurationType() as $index => $type)
                                                <option value="{{$index}}"> {{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group mt-4">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Duration Time') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="primary-form-control" name="duration">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group mt-4">
                                    <div class="primary-form-group-wrap">
                                        <label for="currentPassword" class="form-label">{{ __('Price') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="primary-form-control" step="0.01" name="price">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="primary-form-group mt-4">
                                    <div class="primary-form-group-wrap">
                                        <label for="BatchName" class="form-label">{{ __('Status') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="primary-form-control sf-select-without-search" id="BatchName"
                                            name="status">
                                            <option value="1">{{ __('Active') }}</option>
                                            <option value="0">{{ __('Deactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap zImage-upload-details w-100">
                                        <div class="zImage-inside">
                                            <div class="d-flex pb-12"><img src="{{ getDefaultImage() }}"></div>
                                            <p class="fs-15 fw-500 lh-16 text-1b1c17">{{__('Drag & drop files here')}}</p>
                                        </div>
                                        <label for="zImageUpload" class="form-label">{{__('Upload Image')}} <span
                                                class="text-mime-type">(jpg,jpeg,png)</span> <span
                                                class="text-danger">*</span></label>
                                        <div class="upload-img-box">
                                            <img src="">
                                            <input type="file" name="badge" accept="image/*" onchange="previewFile(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top-color: var(--border-dark);">
                        <button type="submit" class="premium-btn">{{
        __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->

    <!-- Edit Modal section start -->
    <div class="modal fade zModalTwo" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection

@push('script')
    <script src="{{ asset('admin/js/membership.js') }}"></script>
@endpush