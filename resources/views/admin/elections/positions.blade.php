@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .positions-layout {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
        }

        @media (max-width: 991px) {
            .positions-layout {
                grid-template-columns: 1fr;
            }
        }

        .positions-header {
            padding: 30px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.2), rgba(18, 22, 28, 0.98));
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(212, 175, 90, 0.15);
        }

        .positions-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .positions-title span {
            background: linear-gradient(90deg, #D4AF5A, #E3C16E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Add Position Card */
        .add-position-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
            position: sticky;
            top: 20px;
        }

        .add-position-card::before {
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

        .form-control-custom {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            color: #fff;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #D4AF5A;
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.15);
        }

        .form-control-custom::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        textarea.form-control-custom {
            min-height: 80px;
            resize: vertical;
        }

        .btn-add-position {
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

        .btn-add-position:hover {
            background: linear-gradient(135deg, #E3C16E, #D4AF5A);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 90, 0.3);
        }

        /* Positions List */
        .positions-list-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
        }

        .list-header {
            padding: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-header h5 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        .position-count {
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.2), rgba(139, 38, 53, 0.2));
            border: 1px solid rgba(212, 175, 90, 0.3);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            color: #D4AF5A;
            font-weight: 600;
        }

        .list-body {
            padding: 20px;
        }

        .position-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .position-item:last-child {
            margin-bottom: 0;
        }

        .position-item:hover {
            border-color: rgba(212, 175, 90, 0.3);
            background: rgba(0, 0, 0, 0.3);
        }

        .position-order {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.2), rgba(139, 38, 53, 0.2));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            color: #D4AF5A;
            flex-shrink: 0;
        }

        .position-info {
            flex: 1;
            min-width: 0;
        }

        .position-name {
            font-size: 17px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
        }

        .position-desc {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .position-meta {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .candidate-count {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-delete-position {
            width: 40px;
            height: 40px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            color: #f87171;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-delete-position:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.4);
        }

        .empty-positions {
            padding: 60px 30px;
            text-align: center;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.1), rgba(139, 38, 53, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .empty-icon i {
            font-size: 32px;
            color: rgba(212, 175, 90, 0.5);
        }

        .action-footer {
            padding: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(0, 0, 0, 0.2);
        }

        .btn-next-step {
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

        .btn-next-step:hover {
            background: linear-gradient(135deg, #4ade80, #22c55e);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
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
        <div class="positions-header">
            <h1 class="positions-title">{{ __('Manage Positions') }} - <span>{{ $election->title }}</span></h1>
            <p class="text-gray-400 mb-0">{{ __('Add the positions that voters will elect candidates for') }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 mb-4"
                style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.2)); border-left: 4px solid #22c55e !important; border-radius: 12px;"
                role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="positions-layout">
            <!-- Add Position Form -->
            <div class="add-position-card">
                <div class="add-card-header">
                    <h5><i class="bi bi-plus-circle"></i> {{ __('Add Position') }}</h5>
                </div>
                <div class="add-card-body">
                    <form action="{{ route('admin.elections.positions.add', $election->slug) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">{{ __('Position Title') }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control-custom"
                                placeholder="{{ __('e.g., President') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control-custom"
                                placeholder="{{ __('Brief description of this position') }}"></textarea>
                        </div>
                        <button type="submit" class="btn-add-position">
                            <i class="bi bi-plus-lg"></i> {{ __('Add Position') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Positions List -->
            <div class="positions-list-card">
                <div class="list-header">
                    <h5>{{ __('Election Positions') }}</h5>
                    <span class="position-count">{{ $election->positions->count() }} {{ __('positions') }}</span>
                </div>

                @if($election->positions->count() > 0)
                    <div class="list-body">
                        @foreach($election->positions as $index => $position)
                            <div class="position-item">
                                <div class="position-order">{{ $index + 1 }}</div>
                                <div class="position-info">
                                    <div class="position-name">{{ $position->title }}</div>
                                    @if($position->description)
                                        <div class="position-desc">{{ Str::limit($position->description, 60) }}</div>
                                    @endif
                                </div>
                                <div class="position-meta">
                                    <span class="candidate-count">
                                        <i class="bi bi-people"></i> {{ $position->allCandidates->count() }} {{ __('candidates') }}
                                    </span>
                                </div>
                                <form action="{{ route('admin.elections.positions.delete', $position->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('Delete this position?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-position">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="action-footer">
                        <a href="{{ route('admin.elections.candidates', $election->slug) }}" class="btn-next-step">
                            {{ __('Next: Add Candidates') }} <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @else
                    <div class="empty-positions">
                        <div class="empty-icon">
                            <i class="bi bi-list-ul"></i>
                        </div>
                        <h6 class="text-white fs-18 fw-500 mb-2">{{ __('No positions yet') }}</h6>
                        <p class="text-gray-400 fs-14 mb-0">{{ __('Add positions using the form on the left') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection