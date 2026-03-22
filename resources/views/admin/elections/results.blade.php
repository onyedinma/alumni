@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
<style>
    .results-hero {
        padding: 40px;
        background: linear-gradient(135deg, rgba(139, 38, 53, 0.25), rgba(18, 22, 28, 0.98));
        border-radius: 24px;
        margin-bottom: 35px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(212, 175, 90, 0.15);
    }

    .results-hero::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(212, 175, 90, 0.25), transparent);
        top: -100px;
        right: -100px;
        border-radius: 50%;
        filter: blur(60px);
    }

    .results-hero-content {
        position: relative;
        z-index: 1;
    }

    .results-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 8px;
    }

    .results-title span {
        background: linear-gradient(90deg, #D4AF5A, #E3C16E);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Stats Cards */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: 1fr;
        }
    }

    .stat-card {
        background: rgba(30, 30, 35, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 18px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: rgba(212, 175, 90, 0.3);
        transform: translateY(-3px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        flex-shrink: 0;
    }

    .stat-icon.votes { background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(22, 163, 74, 0.2)); color: #4ade80; }
    .stat-icon.positions { background: linear-gradient(135deg, rgba(212, 175, 90, 0.2), rgba(139, 38, 53, 0.2)); color: #D4AF5A; }
    .stat-icon.candidates { background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.2)); color: #60a5fa; }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.5);
    }

    /* Position Results */
    .position-results {
        background: rgba(30, 30, 35, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .position-header {
        padding: 25px 30px;
        background: linear-gradient(135deg, rgba(139, 38, 53, 0.15), transparent);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .position-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #D4AF5A, #B8973E);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 22px;
    }

    .position-title {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .position-body {
        padding: 25px 30px;
    }

    /* Candidate Results */
    .candidate-result {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        margin-bottom: 15px;
        position: relative;
    }

    .candidate-result:last-child {
        margin-bottom: 0;
    }

    .candidate-result.winner {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.12), rgba(22, 163, 74, 0.08));
        border-color: rgba(34, 197, 94, 0.3);
    }

    .winner-crown {
        position: absolute;
        top: -12px;
        left: 20px;
        font-size: 22px;
    }

    .result-rank {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        border-radius: 12px;
        flex-shrink: 0;
    }

    .rank-1 { background: linear-gradient(135deg, #D4AF5A, #B8973E); color: #000; }
    .rank-2 { background: linear-gradient(135deg, #94a3b8, #64748b); color: #000; }
    .rank-3 { background: linear-gradient(135deg, #b45309, #92400e); color: #fff; }
    .rank-other { background: rgba(255, 255, 255, 0.1); color: rgba(255, 255, 255, 0.5); }

    .result-avatar {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid rgba(255, 255, 255, 0.1);
        flex-shrink: 0;
    }

    .candidate-result.winner .result-avatar {
        border-color: #22c55e;
    }

    .result-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .result-info {
        flex: 1;
        min-width: 0;
    }

    .result-name {
        font-size: 17px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 3px;
    }

    .winner-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        border-radius: 20px;
        margin-left: 10px;
        text-transform: uppercase;
    }

    .result-stats {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .progress-wrap {
        width: 200px;
    }

    .progress-bar-bg {
        height: 12px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease;
    }

    .progress-bar-fill.winner { background: linear-gradient(90deg, #22c55e, #4ade80); }
    .progress-bar-fill.default { background: linear-gradient(90deg, #D4AF5A, #E3C16E); }

    .progress-percent {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
        text-align: right;
        margin-top: 4px;
    }

    .vote-count {
        background: rgba(212, 175, 90, 0.1);
        border: 1px solid rgba(212, 175, 90, 0.2);
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 15px;
        font-weight: 600;
        color: #D4AF5A;
        white-space: nowrap;
    }

    .candidate-result.winner .vote-count {
        background: rgba(34, 197, 94, 0.15);
        border-color: rgba(34, 197, 94, 0.3);
        color: #4ade80;
    }

    .empty-candidates {
        padding: 50px;
        text-align: center;
        color: rgba(255, 255, 255, 0.4);
    }

    /* Publish Button */
    .publish-section {
        margin-top: 30px;
        padding: 30px;
        background: rgba(30, 30, 35, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        text-align: center;
    }

    .btn-publish {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        padding: 16px 40px;
        font-size: 16px;
        font-weight: 700;
        border-radius: 14px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-publish:hover {
        background: linear-gradient(135deg, #60a5fa, #3b82f6);
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 25px;
        transition: color 0.3s ease;
    }

    .back-link:hover {
        color: #D4AF5A;
    }
</style>
@endpush

@section('content')
    <div class="p-30">
        <a href="{{ route('admin.elections.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Elections') }}
        </a>

        <!-- Header -->
        <div class="results-hero">
            <div class="results-hero-content d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h1 class="results-title"><span>🏆</span> {{ __('Election Results') }}</h1>
                    <p class="text-gray-400 mb-0 fs-18">{{ $election->title }}</p>
                </div>
                <span class="election-status {{ $election->status }}" style="padding: 10px 20px; border-radius: 25px; font-size: 13px; font-weight: 600; text-transform: uppercase;
                    @if($election->status == 'published') background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.3)); border: 1px solid rgba(59, 130, 246, 0.3); color: #60a5fa;
                    @elseif($election->status == 'active') background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(22, 163, 74, 0.3)); border: 1px solid rgba(34, 197, 94, 0.3); color: #4ade80;
                    @else background: rgba(100, 100, 100, 0.3); border: 1px solid rgba(100, 100, 100, 0.3); color: #aaa; @endif">
                    {{ ucfirst($election->status) }}
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 mb-4" 
                style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.2)); border-left: 4px solid #22c55e !important; border-radius: 12px;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats -->
        @php
            $totalVotes = $election->votes->count();
            $totalCandidates = $election->positions->sum(fn($p) => $p->candidates->count());
        @endphp
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon votes"><i class="bi bi-check2-square"></i></div>
                <div>
                    <div class="stat-value">{{ $totalVotes }}</div>
                    <div class="stat-label">{{ __('Total Votes Cast') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon positions"><i class="bi bi-list-ul"></i></div>
                <div>
                    <div class="stat-value">{{ $election->positions->count() }}</div>
                    <div class="stat-label">{{ __('Positions') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon candidates"><i class="bi bi-people"></i></div>
                <div>
                    <div class="stat-value">{{ $totalCandidates }}</div>
                    <div class="stat-label">{{ __('Total Candidates') }}</div>
                </div>
            </div>
        </div>

        <!-- Results by Position -->
        @foreach($election->positions as $position)
            <div class="position-results">
                <div class="position-header">
                    <div class="position-icon"><i class="bi bi-award"></i></div>
                    <h3 class="position-title">{{ $position->title }}</h3>
                </div>
                <div class="position-body">
                    @php $positionVotes = $position->candidates->sum('vote_count'); @endphp

                    @forelse($position->candidates->sortByDesc('vote_count') as $index => $candidate)
                        @php 
                            $percent = $positionVotes > 0 ? round(($candidate->vote_count / $positionVotes) * 100, 1) : 0;
                            $isWinner = $index === 0 && $candidate->vote_count > 0;
                        @endphp
                        <div class="candidate-result {{ $isWinner ? 'winner' : '' }}">
                            @if($isWinner)
                                <span class="winner-crown">👑</span>
                            @endif
                            <div class="result-rank {{ $index === 0 ? 'rank-1' : ($index === 1 ? 'rank-2' : ($index === 2 ? 'rank-3' : 'rank-other')) }}">
                                {{ $index + 1 }}
                            </div>
                            <div class="result-avatar">
                                <img src="{{ asset(getFileUrl($candidate->user->image)) }}" alt="{{ $candidate->user->name }}">
                            </div>
                            <div class="result-info">
                                <div class="result-name">
                                    {{ $candidate->user->name }}
                                    @if($isWinner)
                                        <span class="winner-badge"><i class="bi bi-trophy-fill"></i> {{ __('Winner') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="result-stats">
                                <div class="progress-wrap">
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill {{ $isWinner ? 'winner' : 'default' }}" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <div class="progress-percent">{{ $percent }}%</div>
                                </div>
                                <div class="vote-count">{{ $candidate->vote_count }} {{ __('votes') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-candidates">
                            <i class="bi bi-person-x fs-32 mb-2 d-block"></i>
                            {{ __('No candidates for this position') }}
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach

        <!-- Publish Button -->
        @if($election->status !== 'published')
            <div class="publish-section">
                <p class="text-gray-400 mb-3">{{ __('Ready to announce the results?') }}</p>
                <form action="{{ route('admin.elections.publish', $election->slug) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-publish" onclick="return confirm('{{ __('Publish results? This will make results visible to all alumni.') }}')">
                        <i class="bi bi-megaphone-fill"></i> {{ __('Publish Results') }}
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
