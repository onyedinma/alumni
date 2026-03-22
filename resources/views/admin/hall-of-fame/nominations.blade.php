@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .nominations-header {
            padding: 30px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.15), rgba(18, 22, 28, 0.98));
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(212, 175, 90, 0.2);
        }

        .nominations-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #fff;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.1);
            color: #D4AF5A;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 175, 90, 0.3);
        }

        .btn-back:hover {
            background: rgba(212, 175, 90, 0.15);
            color: #D4AF5A;
        }

        .nominations-table {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
        }

        .table {
            margin: 0;
            color: #fff;
        }

        .table thead th {
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.05);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255, 255, 255, 0.6);
            padding: 16px 20px;
        }

        .table tbody td {
            border-color: rgba(255, 255, 255, 0.05);
            padding: 16px 20px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .nominee-name {
            font-weight: 600;
            color: #fff;
        }

        .nominee-email {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .category-badge {
            display: inline-block;
            background: rgba(212, 175, 90, 0.15);
            color: #D4AF5A;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: rgba(234, 179, 8, 0.15);
            color: #eab308;
        }

        .status-approved {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
        }

        .status-rejected {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        .nominator-info {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
        }

        .nomination-reason {
            max-width: 300px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-approve {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-approve:hover {
            background: rgba(34, 197, 94, 0.25);
        }

        .btn-reject {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-reject:hover {
            background: rgba(239, 68, 68, 0.25);
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            color: rgba(255, 255, 255, 0.4);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
            color: #D4AF5A;
        }
    </style>
@endpush

@section('content')
    <div class="p-30">
        <!-- Header -->
        <div class="nominations-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="nominations-title">📝 {{ __('Hall of Fame Nominations') }}</h1>
                <p class="text-gray-400 mb-0">{{ __('Review and approve alumni nominations') }}</p>
            </div>
            <a href="{{ route('admin.hall-of-fame.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> {{ __('Back to Hall of Fame') }}
            </a>
        </div>

        <!-- Table -->
        <div class="nominations-table">
            @if($nominations->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Nominee') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Reason') }}</th>
                            <th>{{ __('Nominated By') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nominations as $nomination)
                            <tr>
                                <td>
                                    <div class="nominee-name">{{ $nomination->nominee_name }}</div>
                                    @if($nomination->nominee_email)
                                        <div class="nominee-email">{{ $nomination->nominee_email }}</div>
                                    @endif
                                    @if($nomination->nominee_graduation_year)
                                        <div class="nominee-email">Set of {{ $nomination->nominee_graduation_year }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="category-badge">{{ $categories[$nomination->category] ?? $nomination->category }}</span>
                                </td>
                                <td>
                                    <div class="nomination-reason">{{ $nomination->nomination_reason }}</div>
                                </td>
                                <td class="nominator-info">
                                    {{ $nomination->nominator->name ?? __('Unknown') }}
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $nomination->status }}">
                                        {{ ucfirst($nomination->status) }}
                                    </span>
                                </td>
                                <td class="nominator-info">
                                    {{ $nomination->created_at->format('M d, Y') }}
                                </td>
                                <td>
                                    @if($nomination->status == 'pending')
                                        <div class="action-buttons">
                                            <form action="{{ route('admin.hall-of-fame.nominations.approve', $nomination->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-approve"
                                                    onclick="return confirm('{{ __('Approve this nomination and add to Hall of Fame?') }}')">
                                                    <i class="bi bi-check-lg"></i> {{ __('Approve') }}
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.hall-of-fame.nominations.reject', $nomination->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn-reject"
                                                    onclick="return confirm('{{ __('Reject this nomination?') }}')">
                                                    <i class="bi bi-x-lg"></i> {{ __('Reject') }}
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="bi bi-envelope-paper"></i>
                    <p>{{ __('No nominations yet') }}</p>
                </div>
            @endif
        </div>

        @if($nominations->count() > 0)
            <div class="mt-4">
                {{ $nominations->links() }}
            </div>
        @endif
    </div>
@endsection