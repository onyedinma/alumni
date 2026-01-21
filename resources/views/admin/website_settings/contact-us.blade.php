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
                <i class="fa-solid fa-address-book"
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
                        <div class="p-4 border-bottom border-dark mb-4">
                            <h5 class="text-gold mb-0" style="font-family: 'Playfair Display', serif;">{{ $title }}</h5>
                        </div>

                        <input type="hidden" id="contact-us-route"
                            value="{{ route('admin.setting.website-settings.contact-us') }}">

                        <div class="table-responsive">
                            <table class="table" id="contactUsDataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Message') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('admin/js/contact-us.js')}}"></script>
@endpush