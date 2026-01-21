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
        .premium-card #eventPendingDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead,
        .premium-card table.dataTable thead,
        .premium-card #eventPendingDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th,
        .premium-card table.dataTable thead th,
        .premium-card #eventPendingDataTable thead th,
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
        .premium-card #eventPendingDataTable tbody td,
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

    <div class="premium-admin-panel">
        <input type="hidden" id="event-pending-list-route" value="{{ route('admin.event.pending.index') }}">

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h4 class="fs-24 fw-600 premium-header text-white" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-clock" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{$title}}
            </h4>
        </div>

        <div class="premium-card">
            <div class="table-responsive zTable-responsive">
                <table class="table zTable" id="eventPendingDataTable">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div><i class="fa-solid fa-calendar-check"
                                        style="margin-right: 8px; color: var(--gold);"></i>{{ __('Event Title') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-layer-group"
                                        style="margin-right: 8px; color: var(--gold);"></i>{{ __('Category') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-tag"
                                        style="margin-right: 8px; color: var(--gold);"></i>{{ __('Type') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-clock"
                                        style="margin-right: 8px; color: var(--gold);"></i>{{ __('Date & Time') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-map-marker-alt"
                                        style="margin-right: 8px; color: var(--gold);"></i>{{ __('Location') }}</div>
                            </th>
                            <th class="w-110 text-center" scope="col">
                                <div><i class="fa-solid fa-cog"
                                        style="margin-right: 8px; color: var(--gold);"></i>{{ __('Action') }}</div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal Placeholder -->
    <div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('admin/js/event.js') }}"></script>
    <script src="{{ asset('admin/js/event-pending.js') }}"></script>
@endpush