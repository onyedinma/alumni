@extends('frontend.layouts.app')
@push('title')
    {{ __('Donation Successful') }}
@endpush

@push('style')
    <style>
        /* Donation Success - Premium Dark Theme */
        .donation-success-section {
            min-height: 80vh;
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 50%, #0B0E11 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        /* Animated background orbs */
        .donation-success-section::before,
        .donation-success-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.4;
            z-index: 0;
        }

        .donation-success-section::before {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, rgba(139, 38, 53, 0.5), rgba(212, 175, 90, 0.3));
            top: 10%;
            left: 10%;
            animation: floatSuccess 15s infinite ease-in-out;
        }

        .donation-success-section::after {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, rgba(212, 175, 90, 0.4), rgba(139, 38, 53, 0.3));
            bottom: 10%;
            right: 10%;
            animation: floatSuccess 20s infinite ease-in-out reverse;
        }

        @keyframes floatSuccess {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(30px, -30px) scale(1.1);
            }
        }

        /* Success Card */
        .success-card {
            background: rgba(18, 22, 28, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 90, 0.2);
            border-radius: 24px;
            padding: 60px 50px;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        }

        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8B2635, #D4AF5A, #8B2635);
            border-radius: 24px 24px 0 0;
        }

        /* Success Icon */
        .success-icon-wrap {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1));
            border: 3px solid rgba(76, 175, 80, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulseSuccess 2s infinite;
        }

        .success-icon-wrap i {
            font-size: 50px;
            color: #4CAF50;
        }

        @keyframes pulseSuccess {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4);
            }

            50% {
                box-shadow: 0 0 0 20px rgba(76, 175, 80, 0);
            }
        }

        /* Typography */
        .success-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: #D4AF5A;
            margin-bottom: 16px;
        }

        .success-message {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.7;
            max-width: 450px;
            margin: 0 auto 30px;
        }

        /* Buttons */
        .success-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
        }

        .btn-success-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #8B2635 0%, #751525 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-success-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(139, 38, 53, 0.4);
            color: #fff;
        }

        .btn-success-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: transparent;
            color: #D4AF5A;
            font-size: 15px;
            font-weight: 600;
            border: 2px solid rgba(212, 175, 90, 0.4);
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-success-secondary:hover {
            background: rgba(212, 175, 90, 0.1);
            border-color: #D4AF5A;
            color: #D4AF5A;
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .success-card {
                padding: 40px 25px;
            }

            .success-title {
                font-size: 26px;
            }

            .success-buttons {
                flex-direction: column;
            }

            .btn-success-primary,
            .btn-success-secondary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <section class="donation-success-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="success-card">
                        <!-- Success Icon -->
                        <div class="success-icon-wrap">
                            <i class="fas fa-check"></i>
                        </div>

                        <!-- Title -->
                        <h2 class="success-title">{{ __('Thank You for Your Donation!') }}</h2>

                        <!-- Message -->
                        <p class="success-message">
                            {{ __('Your generous contribution will help us continue our mission of supporting FGC Ohafia 2007 Alumni members and giving back to our alma mater.') }}
                        </p>

                        <p class="success-message">
                            {{ __('A confirmation email will be sent to you shortly with the details of your donation.') }}
                        </p>

                        <!-- Buttons -->
                        <div class="success-buttons">
                            <a href="{{ route('index') }}" class="btn-success-primary">
                                <i class="fas fa-home"></i>
                                {{ __('Back to Home') }}
                            </a>
                            <a href="{{ route('donation.index') }}" class="btn-success-secondary">
                                <i class="fas fa-heart"></i>
                                {{ __('Donate Again') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection