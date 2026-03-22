@extends('frontend.layouts.modern')

@push('title')
    {{ __('Page Not Found') }}
@endpush

@push('style')
    <style>
        .error-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 70vh;
            padding: 60px 20px;
            text-align: center;
        }

        .error-page__code {
            font-family: 'Playfair Display', serif;
            font-size: clamp(6rem, 15vw, 12rem);
            font-weight: 800;
            background: linear-gradient(135deg, #D4AF5A 0%, #751525 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 1rem;
        }

        .error-page__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            color: #E6EAF0;
            margin-bottom: 1rem;
        }

        .error-page__text {
            font-family: 'Inter', sans-serif;
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.6);
            max-width: 500px;
            margin: 0 auto 2rem;
            line-height: 1.7;
        }

        .error-page__btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #D4AF5A 0%, #B8934A 100%);
            color: #0B0E11;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .error-page__btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(212, 175, 90, 0.4);
            color: #0B0E11;
        }
    </style>
@endpush

@section('content')
    <div class="error-page">
        <div>
            <div class="error-page__code">404</div>
            <h1 class="error-page__title">{{ __('Page Not Found') }}</h1>
            <p class="error-page__text">
                {{ __("The page you're looking for doesn't exist or has been moved. Let's get you back on track.") }}
            </p>
            <a href="{{ route('index') }}" class="error-page__btn">
                <i class="fa-solid fa-house"></i>
                {{ __('Back to Home') }}
            </a>
        </div>
    </div>
@endsection