@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
<style>
    .financial-header {
        padding: 30px;
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(18, 22, 28, 0.98));
        border-radius: 20px;
        margin-bottom: 30px;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .financial-title {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 600;
        color: #fff;
    }

    .financial-title span { color: #4ade80; }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    @media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .stats-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: rgba(30, 30, 35, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 24px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
    }

    .stat-card.donations::before { background: linear-gradient(180deg, #D4AF5A, #B8973E); }
    .stat-card.memberships::before { background: linear-gradient(180deg, #8B2635, #6B1D29); }
    .stat-card.pending::before { background: linear-gradient(180deg, #fbbf24, #d97706); }
    .stat-card.approved::before { background: linear-gradient(180deg, #4ade80, #22c55e); }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 16px;
    }

    .stat-icon.donations { background: rgba(212, 175, 90, 0.15); color: #D4AF5A; }
    .stat-icon.memberships { background: rgba(139, 38, 53, 0.15); color: #8B2635; }
    .stat-icon.pending { background: rgba(251, 191, 36, 0.15); color: #fbbf24; }
    .stat-icon.approved { background: rgba(74, 222, 128, 0.15); color: #4ade80; }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #fff;
        font-family: 'Playfair Display', serif;
    }

    .stat-label {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 4px;
    }

    .dashboard-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) { .dashboard-row { grid-template-columns: 1fr; } }

    .dashboard-card {
        background: rgba(30, 30, 35, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 24px;
    }

    .dashboard-card h5 {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dashboard-card h5 i { color: #D4AF5A; }

    /* Campaign Progress */
    .campaign-item {
        padding: 16px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .campaign-item:last-child { border-bottom: none; }

    .campaign-name {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 8px;
    }

    .campaign-progress {
        height: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .campaign-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #D4AF5A, #E3C16E);
        border-radius: 4px;
        transition: width 0.5s ease;
    }

    .campaign-stats {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
    }

    .campaign-stats .amount { color: #D4AF5A; font-weight: 600; }

    /* Contributors */
    .contributor-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .contributor-item:last-child { border-bottom: none; }

    .contributor-rank {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(212, 175, 90, 0.15);
        color: #D4AF5A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
    }

    .contributor-rank.gold { background: rgba(212, 175, 90, 0.3); }
    .contributor-rank.silver { background: rgba(192, 192, 192, 0.3); color: #c0c0c0; }
    .contributor-rank.bronze { background: rgba(205, 127, 50, 0.3); color: #cd7f32; }

    .contributor-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
    }

    .contributor-avatar img { width: 100%; height: 100%; object-fit: cover; }

    .contributor-info { flex: 1; }
    .contributor-name { font-size: 14px; font-weight: 500; color: #fff; }
    .contributor-amount { font-size: 14px; font-weight: 700; color: #D4AF5A; }

    /* Recent Transactions */
    .transaction-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .transaction-item:last-child { border-bottom: none; }

    .transaction-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .transaction-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        overflow: hidden;
    }

    .transaction-avatar img { width: 100%; height: 100%; object-fit: cover; }

    .transaction-name { font-size: 14px; color: #fff; }
    .transaction-type { font-size: 11px; color: rgba(255, 255, 255, 0.4); text-transform: uppercase; }
    .transaction-amount { font-size: 14px; font-weight: 600; color: #4ade80; }
    .transaction-date { font-size: 12px; color: rgba(255, 255, 255, 0.4); }

    /* Chart Placeholder */
    .chart-container {
        height: 250px;
        display: flex;
        align-items: flex-end;
        gap: 12px;
        padding: 20px 0;
    }

    .chart-bar-group {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .chart-bars {
        width: 100%;
        display: flex;
        gap: 4px;
        align-items: flex-end;
        height: 180px;
    }

    .chart-bar {
        flex: 1;
        border-radius: 4px 4px 0 0;
        min-height: 10px;
        transition: height 0.5s ease;
    }

    .chart-bar.donations { background: linear-gradient(180deg, #D4AF5A, #B8973E); }
    .chart-bar.memberships { background: linear-gradient(180deg, #8B2635, #6B1D29); }

    .chart-label {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.5);
        text-align: center;
    }

    .chart-legend {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 16px;
    }

    .chart-legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }

    .chart-legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 3px;
    }

    .chart-legend-dot.donations { background: #D4AF5A; }
    .chart-legend-dot.memberships { background: #8B2635; }
</style>
@endpush

@section('content')
    <div class="p-30">
        <!-- Header -->
        <div class="financial-header">
            <h1 class="financial-title"><span>📊</span> {{ __('Financial Dashboard') }}</h1>
            <p class="text-gray-400 mb-0">{{ __('Complete overview of donations, memberships, and financial activity') }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card donations">
                <div class="stat-icon donations"><i class="bi bi-gift"></i></div>
                <div class="stat-value">₦{{ number_format($totalDonations, 0) }}</div>
                <div class="stat-label">{{ __('Total Donations') }}</div>
            </div>
            <div class="stat-card memberships">
                <div class="stat-icon memberships"><i class="bi bi-award"></i></div>
                <div class="stat-value">₦{{ number_format($totalMemberships, 0) }}</div>
                <div class="stat-label">{{ __('Membership Revenue') }}</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-icon pending"><i class="bi bi-hourglass-split"></i></div>
                <div class="stat-value">{{ $pendingBankTransfers }}</div>
                <div class="stat-label">{{ __('Pending Transfers') }}</div>
            </div>
            <div class="stat-card approved">
                <div class="stat-icon approved"><i class="bi bi-check-circle"></i></div>
                <div class="stat-value">₦{{ number_format($approvedTransfersAmount, 0) }}</div>
                <div class="stat-label">{{ __('Approved Transfers') }}</div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="dashboard-row">
            <!-- Monthly Trends -->
            <div class="dashboard-card">
                <h5><i class="bi bi-graph-up"></i> {{ __('Monthly Revenue Trends') }}</h5>
                @php
                    $maxValue = max(array_merge(
                        array_column($monthlyTrends, 'donations'),
                        array_column($monthlyTrends, 'memberships')
                    )) ?: 1;
                @endphp
                <div class="chart-container">
                    @foreach($monthlyTrends as $trend)
                        <div class="chart-bar-group">
                            <div class="chart-bars">
                                <div class="chart-bar donations" style="height: {{ ($trend['donations'] / $maxValue) * 100 }}%"></div>
                                <div class="chart-bar memberships" style="height: {{ ($trend['memberships'] / $maxValue) * 100 }}%"></div>
                            </div>
                            <div class="chart-label">{{ $trend['month'] }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="chart-legend">
                    <div class="chart-legend-item">
                        <div class="chart-legend-dot donations"></div>
                        {{ __('Donations') }}
                    </div>
                    <div class="chart-legend-item">
                        <div class="chart-legend-dot memberships"></div>
                        {{ __('Memberships') }}
                    </div>
                </div>
            </div>

            <!-- Top Contributors -->
            <div class="dashboard-card">
                <h5><i class="bi bi-trophy"></i> {{ __('Top Contributors') }}</h5>
                @forelse($topContributors as $index => $contributor)
                    <div class="contributor-item">
                        <div class="contributor-rank {{ $index == 0 ? 'gold' : ($index == 1 ? 'silver' : ($index == 2 ? 'bronze' : '')) }}">
                            {{ $index + 1 }}
                        </div>
                        <div class="contributor-avatar">
                            <img src="{{ asset(getFileUrl($contributor->user->image ?? '')) }}" alt="">
                        </div>
                        <div class="contributor-info">
                            <div class="contributor-name">{{ $contributor->user->name ?? 'Unknown' }}</div>
                        </div>
                        <div class="contributor-amount">₦{{ number_format($contributor->total_amount, 0) }}</div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">{{ __('No donations yet') }}</p>
                @endforelse
            </div>
        </div>

        <!-- Campaigns & Transactions -->
        <div class="dashboard-row">
            <!-- Campaign Progress -->
            <div class="dashboard-card">
                <h5><i class="bi bi-bullseye"></i> {{ __('Campaign Progress') }}</h5>
                @forelse($campaigns as $campaign)
                    @php
                        $progress = $campaign->goal_amount > 0 ? min(100, ($campaign->donations_sum_amount / $campaign->goal_amount) * 100) : 0;
                    @endphp
                    <div class="campaign-item">
                        <div class="campaign-name">{{ $campaign->title }}</div>
                        <div class="campaign-progress">
                            <div class="campaign-progress-bar" style="width: {{ $progress }}%"></div>
                        </div>
                        <div class="campaign-stats">
                            <span class="amount">₦{{ number_format($campaign->donations_sum_amount ?? 0, 0) }}</span>
                            <span>{{ __('of') }} ₦{{ number_format($campaign->goal_amount, 0) }} ({{ round($progress) }}%)</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">{{ __('No active campaigns') }}</p>
                @endforelse
            </div>

            <!-- Membership Stats -->
            <div class="dashboard-card">
                <h5><i class="bi bi-people"></i> {{ __('Membership Status') }}</h5>
                <div class="d-flex flex-column gap-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: rgba(255,255,255,0.6)">{{ __('Active Memberships') }}</span>
                        <span style="font-size: 24px; font-weight: 700; color: #4ade80;">{{ $activeMemberships }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: rgba(255,255,255,0.6)">{{ __('Expiring Soon (30 days)') }}</span>
                        <span style="font-size: 24px; font-weight: 700; color: #fbbf24;">{{ $expiringMemberships }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="dashboard-card">
            <h5><i class="bi bi-clock-history"></i> {{ __('Recent Transactions') }}</h5>
            @forelse($recentPayments as $payment)
                <div class="transaction-item">
                    <div class="transaction-user">
                        <div class="transaction-avatar">
                            <img src="{{ asset(getFileUrl($payment->user->image ?? '')) }}" alt="">
                        </div>
                        <div>
                            <div class="transaction-name">{{ $payment->user->name ?? 'Unknown' }}</div>
                            <div class="transaction-type">{{ class_basename($payment->paymentable_type ?? 'Payment') }}</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="transaction-amount">+₦{{ number_format($payment->amount, 0) }}</div>
                        <div class="transaction-date">{{ $payment->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center py-4">{{ __('No transactions yet') }}</p>
            @endforelse
        </div>
    </div>
@endsection
