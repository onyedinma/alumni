@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        /* Alumni Elections - Premium Experience */
        .elections-hero {
            padding: 40px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.25), rgba(18, 22, 28, 0.95));
            border-radius: 24px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 90, 0.15);
        }

        .elections-hero::before,
        .elections-hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
        }

        .elections-hero::before {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(212, 175, 90, 0.4), transparent);
            top: -80px;
            right: -80px;
        }

        .elections-hero::after {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(139, 38, 53, 0.4), transparent);
            bottom: -60px;
            left: -60px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 12px;
        }

        .hero-title-icon {
            font-size: 48px;
            margin-right: 15px;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 18px;
            max-width: 500px;
        }

        /* Election Cards */
        .election-item {
            background: rgba(30, 30, 35, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
        }

        .election-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(212, 175, 90, 0.03));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .election-item:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 175, 90, 0.4);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.5),
                0 0 30px rgba(212, 175, 90, 0.1);
        }

        .election-item:hover::before {
            opacity: 1;
        }

        .election-banner {
            height: 140px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.4), rgba(212, 175, 90, 0.2));
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .election-banner-icon {
            font-size: 60px;
            opacity: 0.3;
        }

        .election-status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 20px;
        }

        .status-voting-open {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 10px rgba(34, 197, 94, 0.5);
            }

            50% {
                box-shadow: 0 0 25px rgba(34, 197, 94, 0.8);
            }
        }

        .status-results-available {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
        }

        .election-content {
            padding: 25px;
            position: relative;
            z-index: 1;
        }

        .election-item-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .election-item-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .election-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 12px;
        }

        .election-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .election-info-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.2), rgba(139, 38, 53, 0.2));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D4AF5A;
        }

        .election-info-text {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .election-info-value {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
        }

        .btn-vote-now {
            width: 100%;
            background: linear-gradient(135deg, #D4AF5A, #B8973E);
            color: #000;
            padding: 16px 28px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 14px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-vote-now:hover {
            background: linear-gradient(135deg, #E3C16E, #D4AF5A);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(212, 175, 90, 0.4);
            color: #000;
        }

        .btn-view-results {
            width: 100%;
            background: transparent;
            border: 2px solid rgba(59, 130, 246, 0.5);
            color: #60a5fa;
            padding: 14px 28px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-view-results:hover {
            background: rgba(59, 130, 246, 0.15);
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .empty-elections {
            padding: 100px 50px;
            background: rgba(30, 30, 35, 0.6);
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            text-align: center;
        }

        .empty-icon-wrapper {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.1), rgba(139, 38, 53, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }

        .empty-icon-wrapper i {
            font-size: 50px;
            color: rgba(212, 175, 90, 0.6);
        }
    </style>
@endpush

@section('content')
    <div class="p-30">
        <!-- Hero Section -->
        <div class="elections-hero">
            <div class="hero-content">
                <h1 class="hero-title">
                    <span class="hero-title-icon">🗳️</span>{{ __('Elections') }}
                </h1>
                <p class="hero-subtitle">
                    {{ __('Your voice matters. Cast your vote and shape the future of our alumni community.') }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 mb-4"
                style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.2)); border-left: 4px solid #22c55e !important; border-radius: 12px;"
                role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 mb-4"
                style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.2)); border-left: 4px solid #ef4444 !important; border-radius: 12px;"
                role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($elections as $election)
                <div class="col-md-6 col-lg-4">
                    <div class="election-item">
                        <div class="election-banner">
                            <i class="bi bi-clipboard2-check election-banner-icon"></i>
                            @if($election->status === 'active' && $election->is_active)
                                <span class="election-status-badge status-voting-open">
                                    <i class="bi bi-broadcast me-1"></i> {{ __('Voting Open') }}
                                </span>
                            @elseif($election->status === 'published')
                                <span class="election-status-badge status-results-available">
                                    <i class="bi bi-trophy me-1"></i> {{ __('Results') }}
                                </span>
                            @endif
                        </div>

                        <div class="election-content">
                            <h3 class="election-item-title">{{ $election->title }}</h3>
                            <p class="election-item-desc">
                                {{ Str::limit($election->description, 120) ?: __('Vote for your preferred candidates in this election.') }}
                            </p>

                            <div class="election-info">
                                <div class="election-info-item">
                                    <div class="election-info-icon">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div>
                                        <div class="election-info-text">
                                            @if($election->status === 'active')
                                                {{ __('Ends on') }}
                                            @else
                                                {{ __('Ended on') }}
                                            @endif
                                        </div>
                                        <div class="election-info-value">{{ $election->end_date->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div class="election-info-item">
                                    <div class="election-info-icon">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div>
                                        <div class="election-info-text">{{ __('Positions') }}</div>
                                        <div class="election-info-value">{{ $election->positions->count() }}</div>
                                    </div>
                                </div>
                            </div>

                            @if($election->status === 'active' && $election->is_active)
                                <a href="{{ route('election.vote', $election->slug) }}" class="btn-vote-now">
                                    <i class="bi bi-check2-square"></i> {{ __('Vote Now') }}
                                </a>
                            @elseif($election->status === 'published')
                                <a href="{{ route('election.results', $election->slug) }}" class="btn-view-results">
                                    <i class="bi bi-bar-chart-fill"></i> {{ __('View Results') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-elections">
                        <div class="empty-icon-wrapper">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <h4 class="text-white fs-24 fw-600 mb-3">{{ __('No Elections Available') }}</h4>
                        <p class="text-gray-400 fs-16 mb-0" style="max-width: 400px; margin: 0 auto;">
                            {{ __('There are no active or completed elections at this time. Check back later!') }}
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection