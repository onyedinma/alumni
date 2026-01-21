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

        .premium-card table.zTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th {
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 12px 14px !important;
            background: var(--bg-elevated, #171C23) !important;
            border-top: none !important;
        }

        .premium-card table.zTable thead th div {
            color: var(--gold, #D4AF5A) !important;
            background: transparent !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .premium-card table.zTable tbody td {
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
            color: #000 !important;
        }

        /* Badges */
        .badge.bg-success {
            background-color: rgba(15, 169, 88, 0.1) !important;
            color: #0fa958 !important;
            border: 1px solid rgba(15, 169, 88, 0.2);
        }

        .badge.bg-secondary {
            background-color: rgba(118, 118, 118, 0.1) !important;
            color: #a0a0a0 !important;
            border: 1px solid rgba(118, 118, 118, 0.2);
        }

        /* Dropdown */
        .dropdown-menu {
            background-color: var(--bg-elevated, #171C23);
            border: 1px solid var(--border-dark, #1F2630);
        }

        .dropdown-item {
            color: var(--text-primary, #E6EAF0);
        }

        .dropdown-item:hover {
            background-color: var(--bg-hover, #1C222B);
            color: var(--gold, #D4AF5A);
        }

        .dropdown-divider {
            border-top-color: var(--border-dark, #1F2630);
        }

        .btn-sm i.fa-ellipsis-v {
            color: var(--text-secondary, #B4BCC8);
        }

        /* Progress Bar */
        .progress {
            background-color: var(--bg-elevated, #171C23);
            border-radius: 10px;
        }

        .progress-bar.bg-success {
            background-color: #0fa958 !important;
        }

        /* Pagination */
        .pagination .page-item .page-link {
            background-color: var(--bg-primary, #0B0E11);
            border-color: var(--border-dark, #1F2630);
            color: var(--text-secondary, #B4BCC8);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--gold, #D4AF5A);
            border-color: var(--gold, #D4AF5A);
            color: #000;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h4 class="fs-24 fw-600 premium-header text-white" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-hand-holding-heart"
                    style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{$title}}
            </h4>
            <a href="{{ route('admin.donation-campaigns.create') }}" class="premium-btn">
                <i class="fa fa-plus"></i> {{ __('Create Campaign') }}
            </a>
        </div>

        <div class="premium-card">
            <!-- Table -->
            <div class="table-responsive zTable-responsive">
                <table class="table zTable">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div><i class="fa-solid fa-heading" style="margin-right: 8px;"></i>{{ __('Title') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-user-friends"
                                        style="margin-right: 8px;"></i>{{ __('Beneficiary') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-bullseye" style="margin-right: 8px;"></i>{{ __('Goal') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-hand-holding-usd"
                                        style="margin-right: 8px;"></i>{{ __('Raised') }}</div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-chart-line" style="margin-right: 8px;"></i>{{ __('Progress') }}
                                </div>
                            </th>
                            <th scope="col">
                                <div><i class="fa-solid fa-toggle-on" style="margin-right: 8px;"></i>{{ __('Status') }}
                                </div>
                            </th>
                            <th class="w-150 text-center" scope="col">
                                <div><i class="fa-solid fa-cog" style="margin-right: 8px;"></i>{{ __('Action') }}</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($campaigns as $campaign)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($campaign->image_id)
                                            <img src="{{ getFileURL($campaign->image) }}" alt="" class="me-2"
                                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                        @endif
                                        <span>{{ $campaign->title }}</span>
                                    </div>
                                </td>
                                <td>{{ $campaign->beneficiary_name ?? '-' }}</td>
                                <td>{{ $campaign->goal_amount ? showPrice($campaign->goal_amount) : __('No Goal') }}</td>
                                <td>{{ showPrice($campaign->raised_amount) }}</td>
                                <td>
                                    <div class="progress" style="height: 20px; min-width: 100px;">
                                        <div class="progress-bar bg-success"
                                            style="width: {{ $campaign->progress_percentage }}%">
                                            {{ $campaign->progress_percentage }}%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($campaign->status == STATUS_ACTIVE)
                                        <span class="badge bg-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.donation-campaigns.edit', $campaign->id) }}">
                                                    <i class="fa fa-edit me-2"></i>{{ __('Edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.donation-campaigns.donations', $campaign->id) }}">
                                                    <i class="fa fa-list me-2"></i>{{ __('View Donations') }}
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.donation-campaigns.delete', $campaign->id) }}"
                                                    method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fa fa-trash me-2"></i>{{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted mb-0">{{ __('No campaigns found') }}</p>
                                    <a href="{{ route('admin.donation-campaigns.create') }}" class="premium-btn mt-2">
                                        {{ __('Create First Campaign') }}
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($campaigns->hasPages())
                <div class="mt-3">
                    {{ $campaigns->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection