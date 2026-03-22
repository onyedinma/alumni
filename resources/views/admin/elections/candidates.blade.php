@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .candidates-layout {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 30px;
        }

        @media (max-width: 991px) {
            .candidates-layout {
                grid-template-columns: 1fr;
            }
        }

        .candidates-header {
            padding: 30px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.2), rgba(18, 22, 28, 0.98));
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(212, 175, 90, 0.15);
        }

        .candidates-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .candidates-title span {
            background: linear-gradient(90deg, #D4AF5A, #E3C16E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Add Candidate Card */
        .add-candidate-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
            position: sticky;
            top: 20px;
        }

        .add-candidate-card::before {
            content: '';
            display: block;
            height: 4px;
            background: linear-gradient(90deg, #8B2635, #D4AF5A);
        }

        .add-card-header {
            padding: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .add-card-header h5 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #D4AF5A;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .add-card-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
        }

        .form-control-custom,
        .form-select-custom {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            color: #fff;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            outline: none;
            border-color: #D4AF5A;
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.15);
        }

        .form-select-custom option {
            background: #1a1a1a;
            color: #fff;
        }

        textarea.form-control-custom {
            min-height: 100px;
            resize: vertical;
        }

        .btn-add-candidate {
            width: 100%;
            background: linear-gradient(135deg, #D4AF5A, #B8973E);
            color: #000;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-add-candidate:hover {
            background: linear-gradient(135deg, #E3C16E, #D4AF5A);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 90, 0.3);
        }

        /* Candidates by Position */
        .position-candidates-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .position-header {
            padding: 20px 25px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.15), transparent);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .position-header h5 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #D4AF5A;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .candidate-count-badge {
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.2), rgba(139, 38, 53, 0.2));
            border: 1px solid rgba(212, 175, 90, 0.3);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: #D4AF5A;
            font-weight: 600;
        }

        .position-body {
            padding: 20px;
        }

        .candidate-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .candidate-item:last-child {
            margin-bottom: 0;
        }

        .candidate-item:hover {
            border-color: rgba(212, 175, 90, 0.3);
            background: rgba(0, 0, 0, 0.3);
        }

        .candidate-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(212, 175, 90, 0.3);
            flex-shrink: 0;
        }

        .candidate-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .candidate-info {
            flex: 1;
            min-width: 0;
        }

        .candidate-name {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
        }

        .candidate-manifesto {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .candidate-status {
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .status-approved {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-pending {
            background: rgba(234, 179, 8, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .btn-remove-candidate {
            width: 38px;
            height: 38px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            color: #f87171;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            flex-shrink: 0;
        }

        .btn-remove-candidate:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.4);
        }

        .empty-candidates {
            padding: 40px;
            text-align: center;
            color: rgba(255, 255, 255, 0.4);
        }

        .empty-candidates i {
            font-size: 28px;
            margin-bottom: 10px;
            display: block;
        }

        .action-footer {
            padding: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-view-results {
            background: linear-gradient(135deg, #22c55e, #16a34a);
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

        .btn-view-results:hover {
            background: linear-gradient(135deg, #4ade80, #22c55e);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
            color: #fff;
        }

        .btn-back {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.7);
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            color: #fff;
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
        <div class="candidates-header">
            <h1 class="candidates-title">{{ __('Manage Candidates') }} - <span>{{ $election->title }}</span></h1>
            <p class="text-gray-400 mb-0">{{ __('Add candidates to each position for voters to choose from') }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 mb-4"
                style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.2)); border-left: 4px solid #22c55e !important; border-radius: 12px;"
                role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="candidates-layout">
            <!-- Add Candidate Form -->
            <div class="add-candidate-card">
                <div class="add-card-header">
                    <h5><i class="bi bi-person-plus"></i> {{ __('Add Candidate') }}</h5>
                </div>
                <div class="add-card-body">
                    <form action="{{ route('admin.elections.candidates.add', $election->slug) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">{{ __('Position') }} <span class="text-danger">*</span></label>
                            <select name="position_id" class="form-select-custom" required>
                                <option value="">{{ __('Select Position') }}</option>
                                @foreach($election->positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Alumni Member') }} <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-select-custom" required>
                                <option value="">{{ __('Select Alumni') }}</option>
                                @foreach($alumni as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Manifesto') }}</label>
                            <textarea name="manifesto" class="form-control-custom"
                                placeholder="{{ __('Candidate\'s election promise or manifesto') }}"></textarea>
                        </div>
                        <button type="submit" class="btn-add-candidate">
                            <i class="bi bi-plus-lg"></i> {{ __('Add Candidate') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Candidates by Position -->
            <div>
                @forelse($election->positions as $position)
                    <div class="position-candidates-card">
                        <div class="position-header">
                            <h5><i class="bi bi-person-badge"></i> {{ $position->title }}</h5>
                            <span class="candidate-count-badge">{{ $position->allCandidates->count() }}
                                {{ __('candidates') }}</span>
                        </div>

                        @if($position->allCandidates->count() > 0)
                            <div class="position-body">
                                @foreach($position->allCandidates as $candidate)
                                    <div class="candidate-item">
                                        <div class="candidate-avatar">
                                            <img src="{{ asset(getFileUrl($candidate->user->image)) }}"
                                                alt="{{ $candidate->user->name }}">
                                        </div>
                                        <div class="candidate-info">
                                            <div class="candidate-name">{{ $candidate->user->name }}</div>
                                            <div class="candidate-manifesto" title="{{ $candidate->manifesto }}">{{ $candidate->manifesto ?: __('No manifesto') }}</div>
                                            @if($candidate->manifesto && mb_strlen($candidate->manifesto) > 80)
                                                <button type="button" class="btn btn-link btn-sm text-decoration-none p-0" style="color: #D4AF5A; font-size: 12px;" data-bs-toggle="modal" data-bs-target="#manifestoModal{{ $candidate->id }}">
                                                    {{ __('Read more') }}
                                                </button>
                                            @endif
                                        </div>
                                        <span
                                            class="candidate-status {{ $candidate->status === 'approved' ? 'status-approved' : 'status-pending' }}">
                                            {{ $candidate->status }}
                                        </span>
                                        <form action="{{ route('admin.elections.candidates.delete', $candidate->id) }}" method="POST"
                                            onsubmit="return confirm('{{ __('Remove this candidate?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-remove-candidate">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-candidates">
                                <i class="bi bi-person-x"></i>
                                {{ __('No candidates added yet') }}
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="position-candidates-card">
                        <div class="empty-candidates" style="padding: 60px;">
                            <i class="bi bi-exclamation-triangle" style="font-size: 36px;"></i>
                            <p class="mt-3 mb-0">{{ __('No positions defined. Please add positions first.') }}</p>
                        </div>
                    </div>
                @endforelse

                <div class="action-footer" style="background: transparent; border: none; padding: 0; margin-top: 20px;">
                    <a href="{{ route('admin.elections.positions', $election->slug) }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> {{ __('Back to Positions') }}
                    </a>
                    <a href="{{ route('admin.elections.results', $election->slug) }}" class="btn-view-results">
                        <i class="bi bi-bar-chart"></i> {{ __('View Results') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Manifesto Modals -->
    @foreach($election->positions as $position)
        @foreach($position->allCandidates as $candidate)
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
@endsection