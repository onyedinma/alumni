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

        .form-control-custom {
            width: 100%;
            padding: 14px 18px;
            font-size: 15px;
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
            background: rgba(0, 0, 0, 0.4);
        }

        .form-control-custom::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        textarea.form-control-custom {
            min-height: 120px;
            resize: vertical;
        }

        .form-hint {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 8px;
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
                    <h2>{{ __('Create New') }} <span>{{ __('Election') }}</span></h2>
                </div>

                <form action="{{ route('admin.elections.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                {{ __('Election Title') }} <span class="required">*</span>
                            </label>
                            <input type="text" name="title" class="form-control-custom" value="{{ old('title') }}"
                                placeholder="{{ __('e.g., 2024 EXCO Election') }}" required>
                            @error('title') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control-custom"
                                placeholder="{{ __('Describe the purpose of this election...') }}">{{ old('description') }}</textarea>
                            <p class="form-hint">{{ __('This will be shown to voters') }}</p>
                            @error('description') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="date-input-group">
                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    {{ __('Start Date & Time') }} <span class="required">*</span>
                                </label>
                                <input type="datetime-local" name="start_date" class="form-control-custom"
                                    value="{{ old('start_date') }}" required>
                                @error('start_date') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    {{ __('End Date & Time') }} <span class="required">*</span>
                                </label>
                                <input type="datetime-local" name="end_date" class="form-control-custom"
                                    value="{{ old('end_date') }}" required>
                                @error('end_date') <span class="error-text">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <a href="{{ route('admin.elections.index') }}" class="btn-cancel">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-arrow-right"></i> {{ __('Create & Add Positions') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection