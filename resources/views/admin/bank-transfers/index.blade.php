@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .transfers-header {
            padding: 30px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.2), rgba(18, 22, 28, 0.98));
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(212, 175, 90, 0.15);
        }

        .transfers-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .transfers-title span {
            background: linear-gradient(90deg, #D4AF5A, #E3C16E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .stats-row {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.pending {
            background: rgba(234, 179, 8, 0.2);
            color: #fbbf24;
        }

        .stat-icon.approved {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
        }

        .stat-icon.rejected {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .transfers-table-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
        }

        .table-header {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h5 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        .premium-table {
            width: 100%;
            border-collapse: collapse;
        }

        .premium-table th {
            padding: 16px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .premium-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            color: #fff;
            font-size: 14px;
        }

        .premium-table tr:hover td {
            background: rgba(212, 175, 90, 0.05);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .amount-cell {
            font-weight: 600;
            color: #D4AF5A;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: rgba(234, 179, 8, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .status-approved {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-rejected {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-view {
            background: linear-gradient(135deg, #D4AF5A, #B8973E);
            color: #000;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 90, 0.3);
            color: #000;
        }

        .empty-state {
            padding: 60px;
            text-align: center;
            color: rgba(255, 255, 255, 0.4);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="p-30">
        <!-- Header -->
        <div class="transfers-header">
            <h1 class="transfers-title"><span>💳</span> {{ __('Bank Transfer Approvals') }}</h1>
            <p class="text-gray-400 mb-0">{{ __('Review and approve manual bank transfer payments') }}</p>
        </div>

        <!-- Stats -->
        @php
            $pending = $transfers->where('status', 'pending')->count();
            $approved = \App\Models\BankTransfer::tenant()->where('status', 'approved')->count();
            $rejected = \App\Models\BankTransfer::tenant()->where('status', 'rejected')->count();
        @endphp
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon pending"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <div class="stat-value">{{ $pending }}</div>
                    <div class="stat-label">{{ __('Pending Approval') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon approved"><i class="bi bi-check-circle"></i></div>
                <div>
                    <div class="stat-value">{{ $approved }}</div>
                    <div class="stat-label">{{ __('Approved') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rejected"><i class="bi bi-x-circle"></i></div>
                <div>
                    <div class="stat-value">{{ $rejected }}</div>
                    <div class="stat-label">{{ __('Rejected') }}</div>
                </div>
            </div>
        </div>

        <!-- Transfers Table -->
        <div class="transfers-table-card">
            <div class="table-header">
                <h5>{{ __('Recent Transfers') }}</h5>
            </div>

            @if($transfers->count() > 0)
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>{{ __('Reference') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Purpose') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transfers as $transfer)
                            <tr>
                                <td><code>{{ $transfer->reference }}</code></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
                                            <img src="{{ asset(getFileUrl($transfer->user->image)) }}" alt="">
                                        </div>
                                        <span>{{ $transfer->user->name }}</span>
                                    </div>
                                </td>
                                <td class="amount-cell">₦{{ number_format($transfer->amount, 2) }}</td>
                                <td>{{ ucfirst($transfer->payment_for) }}</td>
                                <td>{{ $transfer->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $transfer->status }}">
                                        {{ ucfirst($transfer->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bank-transfers.show', $transfer->id) }}" class="btn-view">
                                        {{ __('View') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $transfers->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>{{ __('No bank transfers yet') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection