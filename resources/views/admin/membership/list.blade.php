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
    .premium-card #memberListDataTable {
      background: var(--bg-primary, #0B0E11) !important;
      border-radius: 12px;
      overflow: hidden;
    }

    .premium-card table.zTable thead,
    .premium-card table.dataTable thead,
    .premium-card #memberListDataTable thead {
      background: var(--bg-elevated, #171C23) !important;
    }

    .premium-card table.zTable thead th,
    .premium-card table.dataTable thead th,
    .premium-card #memberListDataTable thead th,
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
    .premium-card #memberListDataTable tbody td,
    .premium-card td {
      color: var(--text-primary, #E6EAF0) !important;
      border-bottom: 1px solid var(--border-dark, #1F2630) !important;
      padding: 16px !important;
      background: var(--bg-primary, #0B0E11) !important;
    }

    .premium-card table.zTable tbody tr:hover td {
      background: var(--bg-elevated, #171C23) !important;
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
      <input type="hidden" id="member-list-route" value="{{ route('admin.membership.list') }}">

      <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
        <h4 class="fs-24 fw-600 premium-header text-white" style="font-family: 'Playfair Display', serif;">
          <i class="fa-solid fa-users" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{$title}}
        </h4>
      </div>
      <div class="premium-card">
        <!-- Table -->
        <div class="table-responsive zTable-responsive">
          <table class="table zTable" id="memberListDataTable">
            <thead>
              <tr>
                <th scope="col">
                  <div>{{ __('User name') }}</div>
                </th>
                <th scope="col">
                  <div>{{ __('Plan Name') }}</div>
                </th>
                <th scope="col">
                  <div>{{ __('Membership date') }}</div>
                </th>
                <th scope="col">
                  <div>{{ __('Expired date') }}</div>
                </th>
                <th scope="col">
                  <div>{{ __('Status') }}</div>
                </th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>
  <!-- Page content area end -->

@endsection

@push('script')
  <script src="{{ asset('admin/js/membership.js') }}"></script>
@endpush