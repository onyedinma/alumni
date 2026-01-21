@extends('layouts.app')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <style>
        /* Premium Alumni List Section */
        .premium-alumni-list {
            background: var(--bg-primary, #0B0E11);
            padding: 40px 0;
            min-height: 100vh;
        }

        /* Premium Card */
        .premium-alumni-card {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Top Border Gradient */
        .premium-alumni-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
            border-radius: 24px 24px 0 0;
        }

        /* Table Styling */
        .premium-alumni-card .table-responsive {
            background: transparent !important;
        }

        .premium-alumni-card table.zTable,
        .premium-alumni-card table.dataTable,
        .premium-alumni-card #alumni-list-filter {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-alumni-card table.zTable thead,
        .premium-alumni-card table.dataTable thead,
        .premium-alumni-card #alumni-list-filter thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-alumni-card table.zTable thead th,
        .premium-alumni-card table.dataTable thead th,
        .premium-alumni-card #alumni-list-filter thead th,
        .premium-alumni-card .dataTable thead th,
        .premium-alumni-card th {
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 12px 14px !important;
            background: var(--bg-elevated, #171C23) !important;
            border-top: none !important;
        }

        .premium-alumni-card table.zTable thead th div,
        .premium-alumni-card th div {
            color: var(--gold, #D4AF5A) !important;
            background: transparent !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .premium-alumni-card table.zTable tbody td,
        .premium-alumni-card table.dataTable tbody td,
        .premium-alumni-card #alumni-list-filter tbody td,
        .premium-alumni-card td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-alumni-card table.zTable tbody tr,
        .premium-alumni-card table.dataTable tbody tr,
        .premium-alumni-card #alumni-list-filter tbody tr {
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-alumni-card table.zTable tbody tr:hover td,
        .premium-alumni-card table.dataTable tbody tr:hover td,
        .premium-alumni-card #alumni-list-filter tbody tr:hover td {
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Action Buttons */
        .premium-alumni-card .action-btn {
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

        .premium-alumni-card .action-btn:hover {
            background: var(--gold, #D4AF5A);
            border-color: var(--gold, #D4AF5A);
            transform: translateY(-2px);
        }

        .premium-alumni-card .action-btn:hover img {
            filter: brightness(0);
        }

        /* DataTables Dark Theme Overrides */
        .premium-alumni-card .dataTables_wrapper .dataTables_length,
        .premium-alumni-card .dataTables_wrapper .dataTables_filter,
        .premium-alumni-card .dataTables_wrapper .dataTables_info,
        .premium-alumni-card .dataTables_wrapper .dataTables_paginate {
            color: var(--text-primary, #E6EAF0);
        }

        .premium-alumni-card .dataTables_wrapper .dataTables_length select,
        .premium-alumni-card .dataTables_wrapper .dataTables_filter input {
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-primary, #E6EAF0);
            border-radius: 8px;
            padding: 6px 12px;
        }

        .premium-alumni-card .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #000000 !important;
            background: var(--gold, #D4AF5A) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 6px;
            margin: 0 4px;
            font-weight: 600;
        }

        .premium-alumni-card .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #FFFFFF !important;
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
            transform: translateY(-2px);
        }

        .premium-alumni-card .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #FFFFFF !important;
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
        }

        .premium-alumni-card .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: var(--text-disabled, #5E6675) !important;
            background: var(--bg-elevated, #171C23) !important;
            border-color: var(--border-dark, #1F2630) !important;
            opacity: 0.5;
        }

        /* Filter Section */
        .alumniFilter {
            background: var(--bg-elevated, #171C23) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 16px !important;
            padding: 24px !important;
            margin-bottom: 24px !important;
        }

        .alumniFilter h4 {
            color: var(--gold, #D4AF5A) !important;
            margin-bottom: 20px !important;
            font-family: 'Playfair Display', serif;
        }

        .alumniFilter .primary-form-group label {
            color: var(--text-primary, #E6EAF0) !important;
        }

        .alumniFilter .primary-form-control {
            background: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .alumniFilter .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
            box-shadow: 0 0 0 2px rgba(212, 175, 90, 0.2) !important;
        }

        .alumniFilter .advance-filter {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
            color: #000000 !important;
            font-weight: 600 !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
        }

        .alumniFilter .advance-filter:hover {
            background: linear-gradient(135deg, #e3c16e 0%, #c4a159 100%) !important;
            transform: translateY(-2px);
        }

        /* Modal Styling */
        .zModalTwo-content {
            background: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
        }

        .zModalTwo-body p {
            color: var(--text-secondary, #B4BCC8) !important;
        }

        .zModalTwo-body h4 {
            color: var(--gold, #D4AF5A) !important;
        }
    </style>

    <!-- Page content area start -->
    <div class="premium-alumni-list">
        <div class="container">
            <div class="premium-alumni-card">
                <!-- Search & Filter -->
                <div class="pb-30">
                    <!-- Search & Filter Button -->
                    <div class="d-flex align-items-center cg-5">
                        <!-- Search Field -->
                        <!-- Filter Button -->
                    </div>
                </div>
                <!-- Table -->
                <input type="hidden" id="alumni-list-advance-filter-route"
                    value="{{ route('alumni.list-search-with-filter') }}">
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable" id="alumni-list-filter">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div><i class="fa-solid fa-user" style="margin-right: 8px;"></i>{{ __('Full Name') }}
                                    </div>
                                </th>
                                <th scope="col" class="min-w-100">
                                    <div><i class="fa-solid fa-chalkboard"
                                            style="margin-right: 8px;"></i>{{ __('Final Class') }}</div>
                                </th>
                                <th scope="col" class="min-w-100">
                                    <div><i class="fa-solid fa-house-flag"
                                            style="margin-right: 8px;"></i>{{ __('Final House') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-graduation-cap"
                                            style="margin-right: 8px;"></i>{{ __('Passing Year') }}</div>
                                </th>
                                <th scope="col">
                                    <div><i class="fa-solid fa-map-marker-alt"
                                            style="margin-right: 8px;"></i>{{ __('Location') }}</div>
                                </th>
                                <th scope="col" class="text-center max-w-150 ">
                                    <div><i class="fa-solid fa-cog" style="margin-right: 8px;"></i>{{ __('Action') }}</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content area End -->

    <!-- Phone Number Modal -->
    <div class="modal fade zModalTwo" id="alumniPhoneNo" tabindex="-1" aria-labelledby="alumniPhoneNoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">
                <div class="modal-body zModalTwo-body">
                    <div class="text-center py-30">
                        <p class="fs-14 fw-500 lh-18 text-707070 pb-10">{{ __('Contact with') }} <span
                                class="contact-name"></span></p>
                        <h4 class="fs-32 fw-500 lh-42 text-black show-phone"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facebook Modal -->
    <div class="modal fade zModalTwo" id="alumniEmail" tabindex="-1" aria-labelledby="alumniFacebookLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">
                <div class="modal-body zModalTwo-body">
                    <div class="text-center py-30">
                        <p class="fs-14 fw-500 lh-18 text-707070 pb-10">{{ __('Contact with') }} <span
                                class="contact-name"></span></p>
                        <h4 class="fs-32 fw-500 lh-42 text-black show-email"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search-section">
        <div class="collapse" id="collapseExample">
            <div class="alumniFilter">
                <h4 class="fs-18 fw-500 lh-38 text-1b1c17 pb-10">{{__('Filter your search')}}</h4>
                <div class="filterOptions">
                    <div class="item">
                        <div class="primary-form-group">
                            <div class="primary-form-group-wrap">
                                <label for="Department" class="form-label">{{__('Department')}}</label>
                                <select class="sf-select-without-search primary-form-control" name='department'
                                    id='department'>
                                    <option selected="" value=0>{{__('All Department')}}</option>
                                    @foreach ($department as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="primary-form-group">
                            <div class="primary-form-group-wrap">
                                <label for="passing_year" class="form-label">{{__('Passing Year')}}</label>
                                <select class="sf-select-without-search primary-form-control" name='passing_year'
                                    id='passing-year'>
                                    <option selected="" value=0>{{__('All Year')}}</option>
                                    @foreach ($passingYear as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="primary-form-group">
                            <div class="primary-form-group-wrap">
                                <label for="is_member" class="form-label">{{__('Member')}}</label>
                                <select class="sf-select-without-search primary-form-control" name='is_member'
                                    id='is-member'>
                                    <option value="-1" selected>{{__('All')}}</option>
                                    @foreach (getAlumniMemberStatus() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button
                        class="bg-cdef84 border-0 bd-ra-12 py-13 px-26 fs-15 fw-500 lh-25 text-black hover-bg-one advance-filter">{{__('Search Now')}}</button>
                    <!-- <div class="item">
                                                              </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('alumni/js/alumni.js') }}"></script>
@endpush