@extends('layouts.app')
@push('title')
    {{$title}}
@endpush
@section('content')
    <style>
        /* Premium Transaction List Section */
        .premium-transaction-list {
            background: var(--bg-primary, #0B0E11);
            padding: 40px 0;
            min-height: 100vh;
        }

        /* Premium Card */
        .premium-transaction-card {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Top Border Gradient */
        .premium-transaction-card::before {
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
        .premium-transaction-card .table-responsive {
            background: transparent !important;
        }

        .premium-transaction-card table.zTable,
        .premium-transaction-card table.dataTable,
        .premium-transaction-card #userTransactionDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-transaction-card table.zTable thead,
        .premium-transaction-card table.dataTable thead,
        .premium-transaction-card #userTransactionDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-transaction-card table.zTable thead th,
        .premium-transaction-card table.dataTable thead th,
        .premium-transaction-card #userTransactionDataTable thead th,
        .premium-transaction-card .dataTable thead th,
        .premium-transaction-card th {
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 12px 14px !important;
            background: var(--bg-elevated, #171C23) !important;
            border-top: none !important;
        }

        .premium-transaction-card table.zTable thead th div,
        .premium-transaction-card th div {
            color: var(--gold, #D4AF5A) !important;
            background: transparent !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .premium-transaction-card table.zTable tbody td,
        .premium-transaction-card table.dataTable tbody td,
        .premium-transaction-card #userTransactionDataTable tbody td,
        .premium-transaction-card td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-transaction-card table.zTable tbody tr,
        .premium-transaction-card table.dataTable tbody tr,
        .premium-transaction-card #userTransactionDataTable tbody tr {
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-transaction-card table.zTable tbody tr:hover td,
        .premium-transaction-card table.dataTable tbody tr:hover td,
        .premium-transaction-card #userTransactionDataTable tbody tr:hover td {
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Action Buttons */
        .premium-transaction-card .action-btn {
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

        .premium-transaction-card .action-btn:hover {
            background: var(--gold, #D4AF5A);
            border-color: var(--gold, #D4AF5A);
            transform: translateY(-2px);
        }

        .premium-transaction-card .action-btn:hover img {
            filter: brightness(0);
        }

        /* DataTables Dark Theme Overrides */
        .premium-transaction-card .dataTables_wrapper .dataTables_length,
        .premium-transaction-card .dataTables_wrapper .dataTables_filter,
        .premium-transaction-card .dataTables_wrapper .dataTables_info,
        .premium-transaction-card .dataTables_wrapper .dataTables_paginate {
            color: var(--text-primary, #E6EAF0);
        }

        .premium-transaction-card .dataTables_wrapper .dataTables_length select,
        .premium-transaction-card .dataTables_wrapper .dataTables_filter input {
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-primary, #E6EAF0);
            border-radius: 8px;
            padding: 6px 12px;
        }

        .premium-transaction-card .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #000000 !important;
            background: var(--gold, #D4AF5A) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 6px;
            margin: 0 4px;
            font-weight: 600;
        }

        .premium-transaction-card .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #FFFFFF !important;
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
            transform: translateY(-2px);
        }

        .premium-transaction-card .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #FFFFFF !important;
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
        }

        .premium-transaction-card .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
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

        /* Mobile Responsive */
        @media (max-width: 767px) {
            .premium-transaction-list {
                padding: 16px 0;
            }

            .premium-transaction-card {
                padding: 16px;
                border-radius: 16px;
            }

            .page-header {
                justify-content: center;
                margin-bottom: 20px !important;
            }

            .page-header h4 {
                font-size: 22px !important;
            }

            .page-header .header-icon {
                font-size: 22px !important;
            }

            /* DataTables mobile */
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                text-align: center !important;
                margin-bottom: 12px !important;
                width: 100% !important;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
                display: block;
                margin-top: 8px;
            }

            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                text-align: center !important;
                margin-top: 12px !important;
            }

            /* Expanded rows */
            table.dataTable>tbody>tr.child ul.dtr-details {
                display: block;
                width: 100%;
            }

            table.dataTable>tbody>tr.child ul.dtr-details>li {
                display: flex;
                justify-content: space-between;
                padding: 10px 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            table.dataTable>tbody>tr.child span.dtr-title {
                font-weight: 600;
                color: var(--gold, #D4AF5A);
            }

            /* Invoice modal */
            .modal-dialog.modal-lg {
                margin: 10px !important;
                max-width: calc(100% - 20px) !important;
            }

            .premium-modal {
                padding: 16px !important;
                border-radius: 16px !important;
            }
        }
    </style>

    <!-- Page content area start -->
    <div class="premium-transaction-list">
        <div class="container">
            <div class="page-header">
                <i class="fa-solid fa-file-invoice-dollar header-icon"></i>
                <h4>{{$title}}</h4>
            </div>

            <div class="premium-transaction-card">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="userTransactionDataTable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div><i class="fa-solid fa-user" style="margin-right: 8px;"></i>{{ __('User') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-bullseye" style="margin-right: 8px;"></i>{{ __('Purpose') }}
                                    </div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-receipt"
                                            style="margin-right: 8px;"></i>{{ __('Transaction ID') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-credit-card"
                                            style="margin-right: 8px;"></i>{{ __('Payment Method') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-calendar-alt"
                                            style="margin-right: 8px;"></i>{{ __('Date and Time') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-dollar-sign"
                                            style="margin-right: 8px;"></i>{{ __('Amount') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-file-invoice"
                                            style="margin-right: 8px;"></i>{{ __('Invoice') }}</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Page content area End -->


    <!-- Invoice Modal Start-->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 p-30 premium-modal">

            </div>
        </div>
    </div>
    <!-- Invoice Modal End-->
    <input type="hidden" id="user-transaction-route" value="{{ route('transaction.list') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/user-transaction.js') }}"></script>
@endpush