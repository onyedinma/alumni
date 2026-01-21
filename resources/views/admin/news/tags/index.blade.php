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

        /* Table Styling Overrides */
        .premium-card .table-responsive {
            background: transparent !important;
        }

        .premium-card table.zTable,
        .premium-card table.dataTable,
        .premium-card #newsTagDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead,
        .premium-card table.dataTable thead,
        .premium-card #newsTagDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th,
        .premium-card table.dataTable thead th,
        .premium-card #newsTagDataTable thead th,
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
        .premium-card #newsTagDataTable tbody td,
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
            color: #000 !important;
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

        .modal-header,
        .modal-footer {
            border-color: var(--border-dark, #1F2630);
        }

        .btn-close {
            filter: invert(1);
        }

        .primary-form-control {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
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

        /* DataTables Pagination & Info */
        .premium-card .dataTables_wrapper .dataTables_length,
        .premium-card .dataTables_wrapper .dataTables_filter,
        .premium-card .dataTables_wrapper .dataTables_info,
        .premium-card .dataTables_wrapper .dataTables_paginate {
            color: var(--text-secondary, #B4BCC8) !important;
            padding-top: 10px;
        }

        .premium-card .dataTables_wrapper .dataTables_length select,
        .premium-card .dataTables_wrapper .dataTables_filter input {
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-primary, #E6EAF0);
            border-radius: 8px;
            padding: 6px 12px;
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

    <div class="premium-admin-panel">
        <input type="hidden" id="news-list-route" value="{{ route('admin.news.tags.index') }}">

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h4 class="fs-24 fw-600 premium-header text-white" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-tags" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ $title }}
            </h4>
            <button type="button" class="premium-btn" data-bs-toggle="modal" data-bs-target="#add-modal"><i
                    class="fa fa-plus"></i> {{ __('Add New') }}</button>
        </div>

        <div class="premium-card">
            <!-- Table -->
            <div class="table-responsive zTable-responsive">
                <table class="table zTable" id="newsTagDataTable">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div><i class="fa-solid fa-tag" style="margin-right: 8px;"></i>{{ __('Name') }}</div>
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


    <!-- Add Modal section start -->
    <div class="modal fade zModalTwo" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">
                <form class="ajax reset" action="{{ route('admin.news.tags.store') }}" method="post"
                    data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-header">
                        <h4 class="fs-20 fw-500 lh-38" style="color:#fff">{{ __('Add New') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body zModalTwo-body">
                        <div class="primary-form-group mt-2">
                            <div class="primary-form-group-wrap">
                                <label for="currentPassword" class="form-label">{{ __('Name') }} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-group">
                                    <span class="premium-input-group-text"><i class="fa-solid fa-tag"></i></span>
                                    <input type="text" class="primary-form-control" name="name"
                                        placeholder="{{ __('Tag Name') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="premium-btn">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal section end -->

    <!-- Edit Modal section start -->
    <div class="modal fade zModalTwo" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">
                <!-- Ajax Content -->
            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection

@push('script')
    <script src="{{ asset('admin/js/newstags.js') }}"></script>
@endpush