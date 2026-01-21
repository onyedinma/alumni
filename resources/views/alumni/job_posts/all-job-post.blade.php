@extends('layouts.app')

@push('title')
  {{$title}}
@endpush

@section('content')
  <style>
    /* Premium Job Post List Section */
    .premium-job-list {
      background: var(--bg-primary, #0B0E11);
      padding: 40px 0;
      min-height: 100vh;
    }

    /* Premium Card */
    .premium-job-card {
      background: var(--bg-surface, #12161C);
      border: 1px solid var(--border-dark, #1F2630);
      border-radius: 24px;
      padding: 40px;
      box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
      position: relative;
    }

    /* Top Border Gradient */
    .premium-job-card::before {
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
    .premium-job-card .table-responsive {
      background: transparent !important;
    }

    .premium-job-card table.zTable,
    .premium-job-card table.dataTable,
    .premium-job-card #jobPostAlldataTable {
      background: var(--bg-primary, #0B0E11) !important;
      border-radius: 12px;
      overflow: hidden;
    }

    .premium-job-card table.zTable thead,
    .premium-job-card table.dataTable thead,
    .premium-job-card #jobPostAlldataTable thead {
      background: var(--bg-elevated, #171C23) !important;
    }

    .premium-job-card table.zTable thead th,
    .premium-job-card table.dataTable thead th,
    .premium-job-card #jobPostAlldataTable thead th,
    .premium-job-card .dataTable thead th,
    .premium-job-card th {
      color: var(--gold, #D4AF5A) !important;
      font-weight: 500 !important;
      font-size: 13px !important;
      letter-spacing: 0.3px !important;
      border-bottom: 1px solid var(--border-dark, #1F2630) !important;
      padding: 12px 14px !important;
      background: var(--bg-elevated, #171C23) !important;
      border-top: none !important;
    }

    .premium-job-card table.zTable thead th div,
    .premium-job-card th div {
      color: var(--gold, #D4AF5A) !important;
      background: transparent !important;
      font-size: 13px !important;
      font-weight: 500 !important;
    }

    .premium-job-card table.zTable tbody td,
    .premium-job-card table.dataTable tbody td,
    .premium-job-card #jobPostAlldataTable tbody td,
    .premium-job-card td {
      color: var(--text-primary, #E6EAF0) !important;
      border-bottom: 1px solid var(--border-dark, #1F2630) !important;
      padding: 16px !important;
      background: var(--bg-primary, #0B0E11) !important;
    }

    .premium-job-card table.zTable tbody tr,
    .premium-job-card table.dataTable tbody tr,
    .premium-job-card #jobPostAlldataTable tbody tr {
      background: var(--bg-primary, #0B0E11) !important;
    }

    .premium-job-card table.zTable tbody tr:hover td,
    .premium-job-card table.dataTable tbody tr:hover td,
    .premium-job-card #jobPostAlldataTable tbody tr:hover td {
      background: var(--bg-elevated, #171C23) !important;
    }

    /* Status Badges */
    .status-approved {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
      background: rgba(15, 169, 88, 0.1);
      color: #0fa958;
    }

    .status-pending {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
      background: rgba(245, 180, 10, 0.1);
      color: #f5b40a;
    }

    /* Action Buttons */
    .premium-job-card .action-btn {
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

    .premium-job-card .action-btn:hover {
      background: var(--gold, #D4AF5A);
      border-color: var(--gold, #D4AF5A);
      transform: translateY(-2px);
    }

    .premium-job-card .action-btn:hover img {
      filter: brightness(0);
    }

    /* DataTables Dark Theme Overrides */
    .premium-job-card .dataTables_wrapper .dataTables_length,
    .premium-job-card .dataTables_wrapper .dataTables_filter,
    .premium-job-card .dataTables_wrapper .dataTables_info,
    .premium-job-card .dataTables_wrapper .dataTables_paginate {
      color: var(--text-primary, #E6EAF0);
    }

    .premium-job-card .dataTables_wrapper .dataTables_length select,
    .premium-job-card .dataTables_wrapper .dataTables_filter input {
      background: var(--bg-primary, #0B0E11);
      border: 1px solid var(--border-dark, #1F2630);
      color: var(--text-primary, #E6EAF0);
      border-radius: 8px;
      padding: 6px 12px;
    }

    .premium-job-card .dataTables_wrapper .dataTables_paginate .paginate_button {
      color: #000000 !important;
      background: var(--gold, #D4AF5A) !important;
      border: 1px solid var(--gold, #D4AF5A) !important;
      border-radius: 6px;
      margin: 0 4px;
      font-weight: 600;
    }

    .premium-job-card .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      color: #FFFFFF !important;
      background: var(--maroon, #8B2635) !important;
      border-color: var(--maroon, #8B2635) !important;
      transform: translateY(-2px);
    }

    .premium-job-card .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      color: #FFFFFF !important;
      background: var(--maroon, #8B2635) !important;
      border-color: var(--maroon, #8B2635) !important;
    }

    .premium-job-card .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
      color: var(--text-disabled, #5E6675) !important;
      background: var(--bg-elevated, #171C23) !important;
      border-color: var(--border-dark, #1F2630) !important;
      opacity: 0.5;
    }
  </style>


  <!-- Page content area start -->
  <div class="premium-job-list">
    <div class="container">
      <input type="hidden" id="job-post-list-route" value="{{ route('jobPost.all-job-post') }}">

      <div class="page-header">
        <i class="fa-solid fa-briefcase header-icon"></i>
        <h4>{{$title}}</h4>
      </div>

      <div class="premium-job-card">
        <!-- Table -->
        <div class="table-responsive zTable-responsive">
          <table class="table zTable" id="jobPostAlldataTable">
            <thead>
              <tr>
                <th scope="col">
                  <div><i class="fa-solid fa-building" style="margin-right: 8px;"></i>{{ __('Company') }}</div>
                </th>
                <th scope="col">
                  <div><i class="fa-solid fa-heading" style="margin-right: 8px;"></i>{{ __('Job Title') }}</div>
                </th>
                <th scope="col">
                  <div><i class="fa-solid fa-user-tie" style="margin-right: 8px;"></i>{{ __('Employee Status') }}</div>
                </th>
                <th scope="col">
                  <div><i class="fa-solid fa-dollar-sign" style="margin-right: 8px;"></i>{{ __('Salary') }}</div>
                </th>
                <th scope="col">
                  <div><i class="fa-solid fa-calendar-days"
                      style="margin-right: 8px;"></i>{{ __('Application Deadline') }}</div>
                </th>
                {{-- <th scope="col">
                  <div>{{ __('Status') }}</div>
                </th> --}}
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
  <!-- Page content area End -->

  <!-- Edit Modal section start -->
  <div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

      </div>
    </div>
  </div>
  <!-- Edit Modal section end -->
@endsection

@push('script')
  <script src="{{ asset('alumni/js/job_post.js') }}"></script>
@endpush