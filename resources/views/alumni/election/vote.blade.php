@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
<style>
    /* Voting Interface - Premium Experience */
    .voting-header {
        padding: 35px 40px;
        background: linear-gradient(135deg, rgba(139, 38, 53, 0.25), rgba(18, 22, 28, 0.98));
        border-radius: 20px;
        margin-bottom: 35px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(212, 175, 90, 0.15);
    }

    .voting-header::before {
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

    .voting-header-content {
        position: relative;
        z-index: 1;
    }

    .voting-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 10px;
    }

    .voting-title span {
        background: linear-gradient(90deg, #D4AF5A, #E3C16E);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .voting-timer {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 30px;
        color: #4ade80;
        font-size: 14px;
        font-weight: 500;
    }

    .voting-timer i {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Position Sections */
    .position-section {
        background: rgba(30, 30, 35, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        overflow: hidden;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .position-section:hover {
        border-color: rgba(212, 175, 90, 0.2);
    }

    .position-header {
        padding: 25px 30px;
        background: linear-gradient(135deg, rgba(139, 38, 53, 0.2), transparent);
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
        font-size: 24px;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .position-desc {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.5);
        margin: 4px 0 0;
    }

    .position-body {
        padding: 30px;
    }

    /* Candidate Cards */
    .candidates-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .candidate-card {
        background: rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.08);
        border-radius: 18px;
        padding: 25px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .candidate-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .candidate-card:hover {
        border-color: rgba(212, 175, 90, 0.4);
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .candidate-card.voted {
        border-color: #22c55e;
        background: rgba(34, 197, 94, 0.1);
    }

    .candidate-card.voted::before {
        opacity: 1;
    }

    .candidate-card.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    .candidate-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        margin: 0 auto 20px;
        overflow: hidden;
        border: 3px solid rgba(212, 175, 90, 0.3);
        transition: all 0.3s ease;
    }

    .candidate-card:hover .candidate-avatar {
        border-color: #D4AF5A;
        transform: scale(1.05);
    }

    .candidate-card.voted .candidate-avatar {
        border-color: #22c55e;
    }

    .candidate-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .candidate-name {
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        text-align: center;
        margin-bottom: 8px;
    }

    .candidate-manifesto {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.5);
        text-align: center;
        line-height: 1.5;
        margin-bottom: 20px;
        min-height: 40px;
    }

    .vote-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        animation: scaleIn 0.3s ease;
    }

    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }

    .btn-cast-vote {
        width: 100%;
        padding: 14px 20px;
        background: linear-gradient(135deg, rgba(212, 175, 90, 0.2), rgba(139, 38, 53, 0.2));
        border: 1px solid rgba(212, 175, 90, 0.3);
        border-radius: 12px;
        color: #D4AF5A;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-cast-vote:hover {
        background: linear-gradient(135deg, #D4AF5A, #B8973E);
        border-color: #D4AF5A;
        color: #000;
    }

    .btn-cast-vote:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-cast-vote.loading {
        pointer-events: none;
    }

    /* Vote Confirmation */
    .vote-confirmation {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 20px;
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(22, 163, 74, 0.2));
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 12px;
        color: #4ade80;
        font-size: 14px;
        font-weight: 600;
    }

    /* Finish Button */
    .finish-section {
        text-align: center;
        margin-top: 40px;
        padding-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .btn-finish-voting {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: #fff;
        padding: 18px 50px;
        font-size: 18px;
        font-weight: 700;
        border-radius: 16px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-finish-voting:hover {
        background: linear-gradient(135deg, #4ade80, #22c55e);
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(34, 197, 94, 0.4);
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

    /* Vote Alert */
    .vote-alert {
        padding: 16px 24px;
        border-radius: 14px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from { transform: translateY(-10px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .vote-alert.success {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.2));
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #4ade80;
    }

    .vote-alert.error {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.2));
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #f87171;
    }
</style>
@endpush

@section('content')
    <div class="p-30">
        <a href="{{ route('election.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Elections') }}
        </a>

        <!-- Header -->
        <div class="voting-header">
            <div class="voting-header-content d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h1 class="voting-title">{{ $election->title }}</h1>
                    <p class="text-gray-400 fs-16 mb-0">{{ __('Select your preferred candidate for each position') }}</p>
                </div>
                <div class="voting-timer">
                    <i class="bi bi-broadcast"></i>
                    {{ __('Voting ends') }}: {{ $election->end_date->format('M d, Y \a\t H:i') }}
                </div>
            </div>
        </div>

        <div id="voteAlerts"></div>

        <!-- Positions -->
        @foreach($election->positions as $position)
            <div class="position-section">
                <div class="position-header">
                    <div class="position-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <h2 class="position-title">{{ $position->title }}</h2>
                        @if($position->description)
                            <p class="position-desc">{{ $position->description }}</p>
                        @endif
                    </div>
                </div>

                <div class="position-body">
                    <div class="candidates-grid">
                        @foreach($position->candidates as $candidate)
                            @php
                                $hasVoted = isset($existingVotes[$position->id]);
                                $isSelected = $hasVoted && $existingVotes[$position->id] == $candidate->id;
                            @endphp
                            <div class="candidate-card {{ $isSelected ? 'voted' : '' }} {{ $hasVoted && !$isSelected ? 'disabled' : '' }}" 
                                data-position-id="{{ $position->id }}"
                                data-candidate-id="{{ $candidate->id }}">
                                
                                @if($isSelected)
                                    <div class="vote-badge">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                @endif

                                <div class="candidate-avatar">
                                    <img src="{{ asset(getFileUrl($candidate->user->image)) }}" 
                                        alt="{{ $candidate->user->name }}">
                                </div>

                                <h4 class="candidate-name">{{ $candidate->user->name }}</h4>
                                <p class="candidate-manifesto" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;" title="{{ $candidate->manifesto }}">
                                    {{ $candidate->manifesto ?: __('No manifesto provided') }}
                                </p>
                                @if($candidate->manifesto && mb_strlen($candidate->manifesto) > 80)
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 mb-3" style="color: #D4AF5A;" data-bs-toggle="modal" data-bs-target="#manifestoModal{{ $candidate->id }}">
                                        {{ __('Read more') }}
                                    </button>
                                @endif

                                @if($isSelected)
                                    <div class="vote-confirmation">
                                        <i class="bi bi-check-circle-fill"></i> {{ __('Your Vote') }}
                                    </div>
                                @elseif(!$hasVoted)
                                    <button type="button" 
                                        class="btn-cast-vote vote-btn"
                                        data-position-id="{{ $position->id }}"
                                        data-candidate-id="{{ $candidate->id }}"
                                        data-election-slug="{{ $election->slug }}">
                                        <i class="bi bi-check2-circle"></i> {{ __('Vote for') }} {{ explode(' ', $candidate->user->name)[0] }}
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        
        <!-- Manifesto Modals -->
        @foreach($election->positions as $position)
            @foreach($position->candidates as $candidate)
                @if($candidate->manifesto && mb_strlen($candidate->manifesto) > 80)
                    <div class="modal fade" id="manifestoModal{{ $candidate->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark border border-secondary shadow-lg">
                                <div class="modal-header border-0 pb-0">
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center pt-0 px-4 pb-4">
                                    <div class="candidate-avatar mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <img src="{{ asset(getFileUrl($candidate->user->image)) }}" alt="{{ $candidate->user->name }}" class="rounded-circle">
                                    </div>
                                    <h5 class="fw-bold mb-1 text-white">{{ $candidate->user->name }}</h5>
                                    <p class="text-primary fw-semibold mb-4" style="color: #D4AF5A !important;">{{ $position->title }}</p>
                                    
                                    <div class="text-start text-gray-400" style="line-height: 1.6; font-size: 15px;">
                                        {!! nl2br(e($candidate->manifesto)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach


        <!-- Finish Voting -->
        <div class="finish-section">
            <form action="{{ route('election.submit', $election->slug) }}" method="POST">
                @csrf
                <button type="submit" class="btn-finish-voting">
                    <i class="bi bi-check-all"></i> {{ __('Complete Voting') }}
                </button>
            </form>
            <p class="text-gray-500 mt-3 fs-13">{{ __('You can change your vote until the election ends') }}</p>
        </div>
    </div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.vote-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const positionId = this.dataset.positionId;
            const candidateId = this.dataset.candidateId;
            const electionSlug = this.dataset.electionSlug;
            const button = this;
            const card = this.closest('.candidate-card');

            button.classList.add('loading');
            button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> {{ __("Voting...") }}';

            fetch(`/election/${electionSlug}/vote`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    position_id: positionId,
                    candidate_id: candidateId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' || data.success) {
                    // Mark this card as voted
                    card.classList.add('voted');
                    
                    // Add vote badge
                    const badge = document.createElement('div');
                    badge.className = 'vote-badge';
                    badge.innerHTML = '<i class="bi bi-check-lg"></i>';
                    card.insertBefore(badge, card.firstChild);
                    
                    // Replace button with confirmation
                    button.outerHTML = `
                        <div class="vote-confirmation">
                            <i class="bi bi-check-circle-fill"></i> {{ __('Your Vote') }}
                        </div>
                    `;
                    
                    // Disable other candidates in this position
                    document.querySelectorAll(`.candidate-card[data-position-id="${positionId}"]`).forEach(c => {
                        if (!c.classList.contains('voted')) {
                            c.classList.add('disabled');
                            const otherBtn = c.querySelector('.vote-btn');
                            if (otherBtn) otherBtn.remove();
                        }
                    });
                    
                    showAlert('success', data.message || '{{ __("Vote cast successfully!") }}');
                } else {
                    showAlert('error', data.message || '{{ __("Failed to cast vote") }}');
                    button.classList.remove('loading');
                    button.innerHTML = '<i class="bi bi-check2-circle"></i> {{ __("Try Again") }}';
                }
            })
            .catch(error => {
                showAlert('error', '{{ __("An error occurred. Please try again.") }}');
                button.classList.remove('loading');
                button.innerHTML = '<i class="bi bi-check2-circle"></i> {{ __("Try Again") }}';
            });
        });
    });

    function showAlert(type, message) {
        const alertsContainer = document.getElementById('voteAlerts');
        const alert = document.createElement('div');
        alert.className = `vote-alert ${type}`;
        alert.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'}"></i>
            <span>${message}</span>
        `;
        alertsContainer.appendChild(alert);
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }, 4000);
    }
});
</script>
@endpush