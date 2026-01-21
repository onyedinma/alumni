@extends('layouts.app')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <style>
        /* Premium My Story List Section */
        .premium-story-list {
            background: var(--bg-primary, #0B0E11);
            padding: 40px 0;
            min-height: 100vh;
        }

        /* Premium Card */
        .premium-story-card {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Top Border Gradient */
        .premium-story-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
            border-radius: 24px 24px 0 0;
        }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .page-header .header-icon {
            color: var(--gold, #D4AF5A);
            font-size: 28px;
        }

        .page-header h4 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--gold, #D4AF5A);
            margin: 0;
        }

        /* Table Styling */
        .premium-story-card .table-responsive {
            background: transparent !important;
        }

        .premium-story-card table.zTable,
        .premium-story-card table.dataTable,
        .premium-story-card #storyDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-story-card table.zTable thead,
        .premium-story-card table.dataTable thead,
        .premium-story-card #storyDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-story-card table.zTable thead th,
        .premium-story-card table.dataTable thead th,
        .premium-story-card #storyDataTable thead th,
        .premium-story-card .dataTable thead th,
        .premium-story-card th {
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 12px 14px !important;
            background: var(--bg-elevated, #171C23) !important;
            border-top: none !important;
        }

        .premium-story-card table.zTable thead th div,
        .premium-story-card th div {
            color: var(--gold, #D4AF5A) !important;
            background: transparent !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .premium-story-card table.zTable tbody td,
        .premium-story-card table.dataTable tbody td,
        .premium-story-card #storyDataTable tbody td,
        .premium-story-card td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-story-card table.zTable tbody tr,
        .premium-story-card table.dataTable tbody tr,
        .premium-story-card #storyDataTable tbody tr {
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-story-card table.zTable tbody tr:hover td,
        .premium-story-card table.dataTable tbody tr:hover td,
        .premium-story-card #storyDataTable tbody tr:hover td {
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Action Buttons */
        .premium-story-card .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border-dark, #1F2630);
            background: var(--bg-elevated, #171C23);
            transition: all 0.3s ease;
        }

        .premium-story-card .action-btn:hover {
            background: var(--gold, #D4AF5A);
            border-color: var(--gold, #D4AF5A);
            transform: translateY(-2px);
        }

        .premium-story-card .action-btn:hover img {
            filter: brightness(0);
        }

        /* DataTables Dark Theme Overrides */
        .premium-story-card .dataTables_wrapper .dataTables_length,
        .premium-story-card .dataTables_wrapper .dataTables_filter,
        .premium-story-card .dataTables_wrapper .dataTables_info,
        .premium-story-card .dataTables_wrapper .dataTables_paginate {
            color: var(--text-primary, #E6EAF0);
        }

        .premium-story-card .dataTables_wrapper .dataTables_length select,
        .premium-story-card .dataTables_wrapper .dataTables_filter input {
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-primary, #E6EAF0);
            border-radius: 8px;
            padding: 6px 12px;
        }

        .premium-story-card .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #000000 !important;
            background: var(--gold, #D4AF5A) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 6px;
            margin: 0 4px;
            font-weight: 600;
        }

        .premium-story-card .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #FFFFFF !important;
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
            transform: translateY(-2px);
        }

        .premium-story-card .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #FFFFFF !important;
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
        }

        .premium-story-card .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: var(--text-disabled, #5E6675) !important;
            background: var(--bg-elevated, #171C23) !important;
            border-color: var(--border-dark, #1F2630) !important;
            opacity: 0.5;
        }

        .premium-modal {
            background: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }
    </style>

    <!-- Page content area start -->
    <div class="premium-story-list">
        <div class="container">
            <input type="hidden" id="story-pending-list-route" value="{{ route('stories.my-story') }}">

            <div class="page-header">
                <i class="fa-solid fa-book-open header-icon"></i>
                <h4>{{ $title }}</h4>
            </div>

            <div class="premium-story-card">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="storyDataTable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div><i class="fa-solid fa-image" style="margin-right: 8px;"></i>{{ __('Image') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-heading" style="margin-right: 8px;"></i>{{ __('Title') }}
                                    </div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-circle-check"
                                            style="margin-right: 8px;"></i>{{ __('Status') }}</div>
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

    <!-- Edit Modal section start -->
    <div class="modal fade zModalTwo" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content zModalTwo-content premium-modal">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->
@endsection

@push('script')
    <script src="{{ asset('alumni/js/stories.js') }}"></script>
@endpush