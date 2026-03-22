@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
<style>
    .election-form-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .election-form-card {
        background: rgba(30, 30, 35, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
    }

    .election-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #8B2635, #D4AF5A, #8B2635);
    }

    .form-header {
        padding: 30px 35px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        background: linear-gradient(135deg, rgba(139, 38, 53, 0.15), transparent);
    }

    .form-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .form-header h2 span {
        background: linear-gradient(90deg, #D4AF5A, #E3C16E);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .form-body {
        padding: 35px;
    }

    .form-group-custom {
        margin-bottom: 28px;
    }

    .form-label-custom {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 10px;
    }

    .form-label-custom .required {
        color: #ef4444;
    }

    .form-control-custom,
    .form-select-custom {
        width: 100%;
        padding: 14px 18px;
        font-size: 15px;
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
        background: rgba(0, 0, 0, 0.4);
    }

    .form-control-custom::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    textarea.form-control-custom {
        min-height: 120px;
        resize: vertical;
    }

    .date-input-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 576px) {
        .date-input-group {
            grid-template-columns: 1fr;
        }
    }

    .status-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    @media (max-width: 576px) {
        .status-options {
            grid-template-columns: 1fr;
        }
    }

    .status-option {
        position: relative;
    }

    .status-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .status-option label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        background: rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .status-option input:checked + label {
        border-color: #D4AF5A;
        background: rgba(212, 175, 90, 0.1);
    }

    .status-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 18px;
    }

    .status-draft .status-icon { background: rgba(100, 100, 100, 0.3); color: #aaa; }
    .status-active .status-icon { background: rgba(34, 197, 94, 0.2); color: #4ade80; }
    .status-ended .status-icon { background: rgba(234, 179, 8, 0.2); color: #fbbf24; }
    .status-published .status-icon { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }

    .status-text {
        font-size: 15px;
        font-weight: 500;
        color: #fff;
    }

    .status-desc {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
    }

    .form-footer {
        padding: 25px 35px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-submit {
        background: linear-gradient(135deg, #D4AF5A, #B8973E);
        color: #000;
        padding: 14px 32px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 12px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #E3C16E, #D4AF5A);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(212, 175, 90, 0.3);
    }

    .btn-cancel {
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

    .btn-cancel:hover {
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

    .error-text {
        color: #f87171;
        font-size: 12px;
        margin-top: 6px;
    }
</style>
@endpush

@section('content')
    <div class="p-30">
        <a href="{{ route('admin.elections.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Elections') }}
        </a>

        <div class="election-form-container">
            <div class="election-form-card">
                <div class="form-header">
                    <h2>{{ __('Edit') }} <span>{{ $election->title }}</span></h2>
                </div>

                <form action="{{ route('admin.elections.update', $election->slug) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                {{ __('Election Title') }} <span class="required">*</span>
                            </label>
                            <input type="text" name="title" class="form-control-custom" 
                                value="{{ old('title', $election->title) }}" required>
                            @error('title') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control-custom">{{ old('description', $election->description) }}</textarea>
                            @error('description') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="date-input-group">
                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    {{ __('Start Date & Time') }} <span class="required">*</span>
                                </label>
                                <input type="datetime-local" name="start_date" class="form-control-custom" 
                                    value="{{ old('start_date', $election->start_date->format('Y-m-d\TH:i')) }}" required>
                                @error('start_date') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    {{ __('End Date & Time') }} <span class="required">*</span>
                                </label>
                                <input type="datetime-local" name="end_date" class="form-control-custom" 
                                    value="{{ old('end_date', $election->end_date->format('Y-m-d\TH:i')) }}" required>
                                @error('end_date') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">{{ __('Election Status') }}</label>
                            <div class="status-options">
                                <div class="status-option status-draft">
                                    <input type="radio" name="status" id="status_draft" value="draft" 
                                        {{ old('status', $election->status) == 'draft' ? 'checked' : '' }}>
                                    <label for="status_draft">
                                        <div class="status-icon"><i class="bi bi-pencil"></i></div>
                                        <div>
                                            <div class="status-text">{{ __('Draft') }}</div>
                                            <div class="status-desc">{{ __('Not visible to voters') }}</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="status-option status-active">
                                    <input type="radio" name="status" id="status_active" value="active" 
                                        {{ old('status', $election->status) == 'active' ? 'checked' : '' }}>
                                    <label for="status_active">
                                        <div class="status-icon"><i class="bi bi-broadcast"></i></div>
                                        <div>
                                            <div class="status-text">{{ __('Active') }}</div>
                                            <div class="status-desc">{{ __('Voting is open') }}</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="status-option status-ended">
                                    <input type="radio" name="status" id="status_ended" value="ended" 
                                        {{ old('status', $election->status) == 'ended' ? 'checked' : '' }}>
                                    <label for="status_ended">
                                        <div class="status-icon"><i class="bi bi-clock-history"></i></div>
                                        <div>
                                            <div class="status-text">{{ __('Ended') }}</div>
                                            <div class="status-desc">{{ __('Voting closed') }}</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="status-option status-published">
                                    <input type="radio" name="status" id="status_published" value="published" 
                                        {{ old('status', $election->status) == 'published' ? 'checked' : '' }}>
                                    <label for="status_published">
                                        <div class="status-icon"><i class="bi bi-megaphone"></i></div>
                                        <div>
                                            <div class="status-text">{{ __('Published') }}</div>
                                            <div class="status-desc">{{ __('Results visible') }}</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <a href="{{ route('admin.elections.index') }}" class="btn-cancel">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-lg"></i> {{ __('Update Election') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection