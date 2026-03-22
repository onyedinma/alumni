@extends('frontend.layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .verify-section {
            padding: 80px 0;
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        .verify-card {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .verify-header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .verify-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: #1A1A2E;
            margin: 0;
        }

        .verify-body {
            padding: 40px 30px;
            text-align: center;
        }

        .verify-status {
            margin-bottom: 30px;
        }

        .status-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
        }

        .status-icon.verified {
            background: rgba(34, 197, 94, 0.15);
            color: #22C55E;
        }

        .status-icon.invalid {
            background: rgba(239, 68, 68, 0.15);
            color: #EF4444;
        }

        .status-text {
            font-size: 18px;
            font-weight: 600;
        }

        .status-text.verified {
            color: #22C55E;
        }

        .status-text.invalid {
            color: #EF4444;
        }

        .alumni-info {
            padding: 20px;
            background: #f9f9f9;
            border-radius: 16px;
            margin-top: 20px;
        }

        .alumni-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 15px;
            overflow: hidden;
            border: 3px solid #D4AF5A;
        }

        .alumni-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .alumni-photo-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee;
            font-size: 40px;
            color: #D4AF5A;
        }

        .alumni-name {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
            color: #1A1A2E;
            margin-bottom: 5px;
        }

        .alumni-id {
            font-size: 14px;
            color: #D4AF5A;
            font-weight: 600;
        }

        .alumni-year {
            font-size: 14px;
            color: #6C757D;
            margin-top: 10px;
        }

        .verify-id-display {
            font-family: monospace;
            font-size: 16px;
            background: #f0f0f0;
            padding: 10px 20px;
            border-radius: 8px;
            color: #333;
        }
    </style>
@endpush

@section('content')
    <section class="breadcrumb-wrap py-50 py-md-75 py-lg-100" data-background="{{ getSettingImage('page_breadcrumb') }}">
        <div class="text-center position-relative">
            <h4 class="fs-50 fw-700 lh-60 text-white pb-8">{{ $title }}</h4>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                <li><a>{{ $title }}</a></li>
            </ul>
        </div>
    </section>

    <section class="verify-section">
        <div class="container">
            <div class="verify-card">
                <div class="verify-header">
                    <h2>{{ __('Alumni Verification') }}</h2>
                </div>

                <div class="verify-body">
                    <div class="verify-status">
                        @if($verified)
                            <div class="status-icon verified">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="status-text verified">{{ __('Verified Alumni') }}</div>
                        @else
                            <div class="status-icon invalid">
                                <i class="bi bi-x-circle-fill"></i>
                            </div>
                            <div class="status-text invalid">{{ __('Not Found') }}</div>
                        @endif
                    </div>

                    <div class="verify-id-display">{{ $alumniId }}</div>

                    @if($verified)
                        <div class="alumni-info">
                            <div class="alumni-photo">
                                @if($alumni['photo'])
                                    <img src="{{ $alumni['photo'] }}" alt="{{ $alumni['name'] }}">
                                @else
                                    <div class="alumni-photo-placeholder">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="alumni-name">{{ $alumni['name'] }}</div>
                            <div class="alumni-id">{{ $alumni['id'] }}</div>
                            @if($alumni['graduation_year'])
                                <div class="alumni-year">{{ __('Set of') }} {{ $alumni['graduation_year'] }}</div>
                            @endif
                        </div>
                    @else
                        <p class="mt-4 text-muted">
                            {{ __('This Alumni ID could not be verified. Please check the ID and try again.') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection