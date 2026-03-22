@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
<style>
    /* Results Page Premium Styles */
    .results-header {
        padding: 40px;
        background: linear-gradient(135deg, rgba(139, 38, 53, 0.25), rgba(18, 22, 28, 0.98));
        border-radius: 24px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(212, 175, 90, 0.15);
        text-align: center;
    }

    .results-header::before,
    .results-header::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.4;
    }

    .results-header::before {
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(212, 175, 90, 0.5), transparent);
        top: -80px;
        left: -80px;
    }

    .results-header::after {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(139, 38, 53, 0.4), transparent);
        bottom: -60px;
        right: -60px;
    }

    .results-header-content {
        position: relative;
        z-index: 1;
    }

    .trophy-icon {
        font-size: 60px;
        margin-bottom: 15px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .results-title {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 10px;
    }

    .results-subtitle {
        color: rgba(255, 255, 255, 0.6);
        font-size: 18px;
    }

    /* Position Cards */
    .position-results {
        background: rgba(30, 30, 35, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .position-results-header {
        padding: 25px 30px;
        background: linear-gradient(135deg, rgba(139, 38, 53, 0.15), transparent);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .position-results-icon {
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

    .position-results-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .position-results-body {
        padding: 30px;
    }

    /* Candidate Results */
    .candidate-result {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 16px;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        position: relative;
    }

    .candidate-result:last-child {
        margin-bottom: 0;
    }

    .candidate-result:hover {
        background: rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .candidate-result.winner {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.1));
        border-color: rgba(34, 197, 94, 0.3);
    }

    .winner-crown {
        position: absolute;
        top: -12px;
        left: 25px;
        font-size: 24px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(-5deg); }
        50% { transform: translateY(-5px) rotate(5deg); }
    }

    .candidate-rank {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        border-radius: 14px;
        flex-shrink: 0;
    }

    .rank-1 {
        background: linear-gradient(135deg, #D4AF5A, #B8973E);
        color: #000;
    }

    .rank-2 {
        background: linear-gradient(135deg, #94a3b8, #64748b);
        color: #000;
    }

    .rank-3 {
        background: linear-gradient(135deg, #b45309, #92400e);
        color: #fff;
    }

    .rank-other {
        background: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.5);
    }

    .candidate-result-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .candidate-result.winner .candidate-result-avatar {
        border-color: #22c55e;
    }

    .candidate-result-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .candidate-result-info {
        flex: 1;
        min-width: 0;
    }

    .candidate-result-name {
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 5px;
    }

    .winner-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        border-radius: 20px;
        margin-left: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .candidate-result-stats {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .votes-count {
        background: rgba(212, 175, 90, 0.1);
        border: 1px solid rgba(212, 175, 90, 0.2);
        padding: 6px 14px;
        border-radius: 20px;
        color: #D4AF5A;
        font-size: 14px;
        font-weight: 600;
    }

    .candidate-result.winner .votes-count {
        background: rgba(34, 197, 94, 0.15);
        border-color: rgba(34, 197, 94, 0.3);
        color: #4ade80;
    }

    .vote-progress-wrapper {
        flex: 1;
        max-width: 250px;
    }

    .vote-progress {
        height: 12px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .vote-progress-bar {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease;
    }

    .vote-progress-bar.winner-bar {
        background: linear-gradient(90deg, #22c55e, #4ade80);
    }

    .vote-progress-bar.default-bar {
        background: linear-gradient(90deg, #D4AF5A, #E3C16E);
    }

    .percentage-text {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 4px;
        text-align: right;
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

    .no-candidates {
        text-align: center;
        padding: 40px;
        color: rgba(255, 255, 255, 0.4);
    }
</style>
@endpush

@section('content')
    <div class="p-30">
        <a href="{{ route('election.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Elections') }}
        </a>

        <!-- Header -->
        <div class="results-header">
            <div class="results-header-content">
                <div class="trophy-icon">🏆</div>
                <h1 class="results-title">{{ $election->title }}</h1>
                <p class="results-subtitle">{{ __('Official Election Results') }}</p>
            </div>
        </div>

        <!-- Results by Position -->
        @foreach($election->positions as $position)
            <div class="position-results">
                <div class="position-results-header">
                    <div class="position-results-icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <h3 class="position-results-title">{{ $position->title }}</h3>
                </div>

                <div class="position-results-body">
                    @php $totalVotes = $position->candidates->sum('votes_count'); @endphp

                    @forelse($position->candidates as $index => $candidate)
                        @php 
                            $percentage = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 1) : 0;
                            $isWinner = $index === 0 && $candidate->votes_count > 0;
                        @endphp
                        <div class="candidate-result {{ $isWinner ? 'winner' : '' }}">
                            @if($isWinner)
                                <div class="winner-crown">👑</div>
                            @endif

                            <div class="candidate-rank {{ $index === 0 ? 'rank-1' : ($index === 1 ? 'rank-2' : ($index === 2 ? 'rank-3' : 'rank-other')) }}">
                                {{ $index + 1 }}
                            </div>

                            <div class="candidate-result-avatar">
                                <img src="{{ asset(getFileUrl($candidate->user->image)) }}" alt="{{ $candidate->user->name }}">
                            </div>

                            <div class="candidate-result-info">
                                <div class="candidate-result-name">
                                    {{ $candidate->user->name }}
                                    @if($isWinner)
                                        <span class="winner-badge"><i class="bi bi-trophy-fill"></i> {{ __('Winner') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="candidate-result-stats">
                                <div class="vote-progress-wrapper">
                                    <div class="vote-progress">
                                        <div class="vote-progress-bar {{ $isWinner ? 'winner-bar' : 'default-bar' }}" 
                                            style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="percentage-text">{{ $percentage }}%</div>
                                </div>
                                <div class="votes-count">
                                    {{ $candidate->votes_count }} {{ __('votes') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-candidates">
                            <i class="bi bi-people fs-32 mb-2 d-block"></i>
                            {{ __('No candidates for this position') }}
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
@endsection
