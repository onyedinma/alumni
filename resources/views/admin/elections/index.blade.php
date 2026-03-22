@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        /* Election Page Premium Styles */
        .election-hero {
            padding: 30px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.2), rgba(18, 22, 28, 0.95));
            border-radius: 20px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 90, 0.2);
        }

        .election-hero::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(212, 175, 90, 0.3), transparent);
            top: -50px;
            right: -50px;
            border-radius: 50%;
            filter: blur(60px);
        }

        .election-card {
            background: rgba(30, 30, 35, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
        }

        .election-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8B2635, #D4AF5A);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .election-card:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 175, 90, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
                0 0 20px rgba(212, 175, 90, 0.1);
        }

        .election-card:hover::before {
            opacity: 1;
        }

        .election-card-header {
            padding: 25px 25px 0;
            position: relative;
        }

        .election-card-body {
            padding: 20px 25px;
        }

        .election-card-footer {
            padding: 20px 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(0, 0, 0, 0.2);
        }

        .election-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 20px;
        }

        .election-status.draft {
            background: linear-gradient(135deg, rgba(100, 100, 100, 0.3), rgba(80, 80, 80, 0.5));
            color: #aaa;
            border: 1px solid rgba(100, 100, 100, 0.3);
        }

        .election-status.active {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(22, 163, 74, 0.3));
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .election-status.ended {
            background: linear-gradient(135deg, rgba(234, 179, 8, 0.2), rgba(202, 138, 4, 0.3));
            color: #fbbf24;
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .election-status.published {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.3));
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .election-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
            color: #fff;
            margin: 12px 0 8px;
            line-height: 1.3;
        }

        .election-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            line-height: 1.6;
        }

        .election-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }

        .election-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .election-meta-item i {
            color: #D4AF5A;
            font-size: 14px;
        }

        .election-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn-election {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-election-primary {
            background: linear-gradient(135deg, #D4AF5A, #B8973E);
            color: #000;
        }

        .btn-election-primary:hover {
            background: linear-gradient(135deg, #E3C16E, #D4AF5A);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 175, 90, 0.3);
        }

        .btn-election-outline {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-election-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(212, 175, 90, 0.5);
            color: #D4AF5A;
        }

        .btn-election-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(22, 163, 74, 0.3));
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
        }

        .btn-election-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(220, 38, 38, 0.3));
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        .btn-create-election {
            background: linear-gradient(135deg, #8B2635, #751525);
            color: #fff;
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-create-election:hover {
            background: linear-gradient(135deg, #9B3645, #8B2635);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 38, 53, 0.4);
            color: #fff;
        }

        .empty-state {
            padding: 80px 40px;
            background: rgba(30, 30, 35, 0.6);
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            text-align: center;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.1), rgba(139, 38, 53, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }

        .empty-state-icon i {
            font-size: 36px;
            color: #D4AF5A;
        }

        .page-title-gradient {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
        }

        .page-title-gradient span {
            background: linear-gradient(90deg, #D4AF5A, #E3C16E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
@endpush

@section('content')
    <div class="p-30">
        <!-- Hero Header -->
        <div class="election-hero">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h4 class="page-title-gradient mb-2"><span>🗳️</span> {{ __('Elections') }}</h4>
                    <p class="text-gray-400 mb-0">{{ __('Manage and monitor all alumni elections') }}</p>
                </div>
                <a href="{{ route('admin.elections.create') }}" class="btn-create-election">
                    <i class="bi bi-plus-lg"></i> {{ __('Create Election') }}
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0"
                style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.2)); border-left: 4px solid #22c55e !important;"
                role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($elections as $election)
                <div class="col-md-6 col-xl-4">
                    <div class="election-card">
                        <div class="election-card-header">
                            <span class="election-status {{ $election->status }}">
                                @if($election->status == 'active')
                                    <i class="bi bi-broadcast"></i> {{ __('Live') }}
                                @elseif($election->status == 'draft')
                                    <i class="bi bi-pencil"></i> {{ __('Draft') }}
                                @elseif($election->status == 'ended')
                                    <i class="bi bi-clock-history"></i> {{ __('Ended') }}
                                @else
                                    <i class="bi bi-megaphone"></i> {{ __('Published') }}
                                @endif
                            </span>
                            <h3 class="election-title">{{ $election->title }}</h3>
                        </div>

                        <div class="election-card-body">
                            <p class="election-desc">
                                {{ Str::limit($election->description, 100) ?: __('No description provided') }}</p>

                            <div class="election-meta">
                                <div class="election-meta-item">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ $election->start_date->format('M d') }} - {{ $election->end_date->format('M d, Y') }}
                                </div>
                                <div class="election-meta-item">
                                    <i class="bi bi-person-badge"></i>
                                    {{ $election->positions_count }} {{ __('Positions') }}
                                </div>
                            </div>
                        </div>

                        <div class="election-card-footer">
                            <div class="election-actions">
                                <a href="{{ route('admin.elections.positions', $election->slug) }}"
                                    class="btn-election btn-election-outline">
                                    <i class="bi bi-list-ul"></i> {{ __('Positions') }}
                                </a>
                                <a href="{{ route('admin.elections.candidates', $election->slug) }}"
                                    class="btn-election btn-election-outline">
                                    <i class="bi bi-people"></i> {{ __('Candidates') }}
                                </a>
                                <a href="{{ route('admin.elections.results', $election->slug) }}"
                                    class="btn-election btn-election-success">
                                    <i class="bi bi-bar-chart"></i> {{ __('Results') }}
                                </a>
                                <a href="{{ route('admin.elections.edit', $election->slug) }}"
                                    class="btn-election btn-election-outline">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.elections.delete', $election->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('{{ __('Are you sure you want to delete this election?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-election btn-election-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <h5 class="text-white fs-20 fw-600 mb-2">{{ __('No Elections Yet') }}</h5>
                        <p class="text-gray-400 mb-4">{{ __('Create your first election to start the voting process') }}</p>
                        <a href="{{ route('admin.elections.create') }}" class="btn-create-election">
                            <i class="bi bi-plus-lg"></i> {{ __('Create First Election') }}
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection