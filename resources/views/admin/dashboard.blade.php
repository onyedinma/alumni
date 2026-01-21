@extends('layouts.app')
@push('title')
    {{$pageTitle}}
@endpush

@section('content')
    <style>
        /* Premium Admin Panel Standards */
        .premium-admin-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .premium-header {
            font-family: 'Playfair Display', serif;
            color: #fff;
        }

        /* Generic Premium Card */
        .premium-card {
            background-color: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
        }

        /* Stat Card Specifics */
        .premium-stat-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }

        .premium-stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--gold, #D4AF5A);
        }

        .stat-icon-wrapper {
            width: 50px;
            height: 50px;
            background: var(--bg-elevated, #171C23);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--gold, #D4AF5A);
            font-size: 24px;
            transition: all 0.3s ease;
        }

        .premium-stat-card:hover .stat-icon-wrapper {
            background: var(--gold, #D4AF5A);
            color: #000;
        }

        .stat-title {
            color: var(--text-secondary, #B4BCC8);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
        }

        /* Charts */
        .chart-container {
            margin-top: 10px;
        }

        /* Table Styling Overrides (Shared with other pages) */
        .premium-card .table-responsive {
            background: transparent !important;
        }

        .premium-card table.zTable,
        .premium-card table.dataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead,
        .premium-card table.dataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th,
        .premium-card table.dataTable thead th,
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
        .premium-card td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
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
        <h4 class="fs-24 fw-600 premium-header mb-4">
            <i class="fa-solid fa-gauge-high"
                style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($pageTitle) }}
        </h4>

        <!-- Stats Row -->
        <div class="row g-4 mb-4">
            @if(isAddonInstalled('ALUSAAS'))
                <div class="col-12">
                    <div class="premium-card d-flex align-items-center justify-content-between p-3" style="min-height: auto;">
                        <h2 class="fs-5 fw-semibold mb-0" style="color: var(--text-primary);">
                            {{ __('Current Domain') }} : <span
                                style="color: var(--gold);">{{auth()->user()->domain?->domain}}</span>
                        </h2>
                    </div>
                </div>
            @endif

            <!-- Total Alumni -->
            <div class="col-lg-3 col-md-6">
                <div class="premium-card premium-stat-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-title">{{ __('Total Alumni') }}</div>
                            <div class="stat-value">{{ $totalAlumni }}</div>
                        </div>
                        <div class="stat-icon-wrapper">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Members -->
            <div class="col-lg-3 col-md-6">
                <div class="premium-card premium-stat-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-title">{{ __('Current Members') }}</div>
                            <div class="stat-value">{{ $currentMember }}</div>
                        </div>
                        <div class="stat-icon-wrapper">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="col-lg-3 col-md-6">
                <div class="premium-card premium-stat-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-title">{{ __('Upcoming Event') }}</div>
                            <div class="stat-value">{{ $totalUpcomingEvent }}</div>
                        </div>
                        <div class="stat-icon-wrapper">
                            <i class="fa-solid fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Member This Month -->
            <div class="col-lg-3 col-md-6">
                <div class="premium-card premium-stat-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-title">{{ __('Member') }} <span
                                    style="font-size: 10px; opacity: 0.7;">({{ now()->format('F') }})</span></div>
                            <div class="stat-value">{{ $memberThisMonth }}</div>
                        </div>
                        <div class="stat-icon-wrapper">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Transaction This Month -->
            <div class="col-lg-3 col-md-6">
                <div class="premium-card premium-stat-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-title">{{ __('Transaction') }} <span
                                    style="font-size: 10px; opacity: 0.7;">({{ now()->format('F') }})</span></div>
                            <div class="stat-value">{{ showPrice($transactionThisMonth) }}</div>
                        </div>
                        <div class="stat-icon-wrapper">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="premium-card">
                    <h4 class="fs-18 fw-600 mb-3" style="color: #fff;">{{ __('Payment Summary') }}</h4>
                    <!-- Wrapper to help with ApexCharts sizing if needed -->
                    <div class="chart-container">
                        <div id="payment-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="premium-card">
                    <h4 class="fs-18 fw-600 mb-3" style="color: #fff;">{{ __('Event Ticket Summary') }}</h4>
                    <div class="chart-container">
                        <div id="event-ticket-chart" class="w-100"></div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="day-list" value="{{ $dayList }}">
        <input type="hidden" id="price-list" value="{{ $chartPrice }}">
        <input type="hidden" id="total-ticket-list" value="{{ $totalTickets }}">
        <input type="hidden" id="event-name-list" value="{{ $eventNames }}">


        <!-- Table Row -->
        <div class="premium-card">
            <h4 class="fs-18 fw-600 mb-3" style="color: #fff;">{{ __('Latest Transaction Summary') }}</h4>
            <div class="table-responsive zTable-responsive">
                <table class="table zTable" id="transactionDataTable">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div><i class="fa-solid fa-user" style="margin-right: 8px;"></i>{{ __('Name') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-bullseye" style="margin-right: 8px;"></i>{{ __('Purpose') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-hashtag" style="margin-right: 8px;"></i>{{ __('Transaction ID') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-credit-card" style="margin-right: 8px;"></i>{{ __('Payment Method') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-clock" style="margin-right: 8px;"></i>{{ __('Date and Time') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-dollar-sign" style="margin-right: 8px;"></i>{{ __('Amount') }}</div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <input type="hidden" id="transaction-route" value="{{ route('admin.dashboard') }}">
@endsection

@push('script')
    <script src="{{ asset('common/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/js/charts.js') }}"></script>
    <script src="{{ asset('admin/js/admin-dashboard.js') }}?ver={{ env('VERSION', 0) }}"></script>
@endpush