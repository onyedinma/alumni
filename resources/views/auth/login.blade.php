@extends('auth.layouts.app')

@push('title')
    {{ __('Login') }}
@endpush

@push('style')
    <style>
        /* ============================================
       LOGIN PAGE REDESIGN - PREMIUM DARK THEME
       ============================================ */

        /* Main Container */
        .login-redesign {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 50%, #0B0E11 100%);
        }

        /* Animated Background Orbs */
        .login-redesign::before,
        .login-redesign::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            animation: float 8s ease-in-out infinite;
        }

        .login-redesign::before {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #8B2635 0%, #6a1d28 100%);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .login-redesign::after {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #D4AF5A 0%, rgba(212, 175, 90, 0.5) 100%);
            bottom: -100px;
            right: -100px;
            animation-delay: -4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(30px, -30px) scale(1.05);
            }
        }

        /* Glassmorphic Login Card */
        .login-glass-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            background: rgba(18, 22, 28, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 90, 0.15);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow:
                0 25px 80px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.03) inset,
                0 1px 0 rgba(255, 255, 255, 0.05) inset;
            animation: cardAppear 0.6s ease-out forwards;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Logo Wrapper */
        .login-logo-wrapper {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo-wrapper a {
            display: inline-block;
            padding: 4px;
            border: 2px solid rgba(212, 175, 90, 0.4);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .login-logo-wrapper a:hover {
            border-color: #D4AF5A;
            transform: scale(1.02);
        }

        .login-logo-wrapper img {
            max-width: 150px;
            height: auto;
            border-radius: 12px;
        }

        /* Title Section */
        .login-title-section {
            text-align: center;
            margin-bottom: 36px;
        }

        .login-title-section h2 {
            font-family: 'Playfair Display', 'Inter Tight', serif;
            font-size: 2rem;
            font-weight: 600;
            color: #E6EAF0;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .login-title-section p {
            font-size: 0.9375rem;
            color: #8C96A6;
            margin: 0;
        }

        .login-title-section p a {
            color: #D4AF5A;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .login-title-section p a:hover {
            color: #E6EAF0;
            text-decoration: underline;
        }

        /* Form Styling */
        .login-form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .login-form-group label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #B4BCC8;
            margin-bottom: 8px;
            letter-spacing: 0.02em;
        }

        .login-form-control {
            width: 100%;
            height: 52px;
            padding: 0 18px;
            background: rgba(14, 18, 24, 0.8);
            border: 1px solid rgba(31, 38, 48, 0.8);
            border-radius: 12px;
            color: #E6EAF0;
            font-size: 0.9375rem;
            font-family: inherit;
            transition: all 0.25s ease;
        }

        .login-form-control::placeholder {
            color: #5E6675;
        }

        .login-form-control:focus {
            outline: none;
            border-color: #8B2635;
            background: rgba(14, 18, 24, 1);
            box-shadow:
                0 0 0 3px rgba(139, 38, 53, 0.2),
                inset 0 0 15px rgba(139, 38, 53, 0.03);
        }

        .login-form-error {
            margin-top: 6px;
            font-size: 0.75rem;
            color: #E55353;
        }

        /* Forgot Password Link */
        .login-forgot-link {
            display: inline-block;
            font-size: 0.8125rem;
            color: #8C96A6;
            text-decoration: none;
            margin-bottom: 24px;
            transition: color 0.2s ease;
        }

        .login-forgot-link:hover {
            color: #D4AF5A;
        }

        /* Primary Button */
        .login-btn-primary {
            width: 100%;
            height: 52px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #8B2635 0%, #6a1d28 100%);
            border: none;
            border-radius: 12px;
            color: #FFFFFF;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .login-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow:
                0 10px 30px rgba(139, 38, 53, 0.4),
                0 0 0 1px rgba(212, 175, 90, 0.2);
        }

        .login-btn-primary:hover::before {
            left: 100%;
        }

        .login-btn-primary:active {
            transform: translateY(0);
        }

        /* Divider */
        .login-divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            gap: 16px;
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 90, 0.3), transparent);
        }

        .login-divider span {
            font-size: 0.75rem;
            color: #8C96A6;
            white-space: nowrap;
        }

        /* Social Buttons */
        .login-social-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
        }

        .login-social-btn {
            width: 56px;
            height: 56px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(23, 28, 35, 0.9);
            border: 1px solid rgba(31, 38, 48, 0.6);
            border-radius: 50%;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .login-social-btn img {
            width: 24px;
            height: 24px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .login-social-btn:hover {
            background: rgba(31, 38, 48, 1);
            border-color: rgba(212, 175, 90, 0.4);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .login-social-btn:hover img {
            transform: scale(1.1);
        }

        /* Demo Credentials Table */
        .login-info-table {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(31, 38, 48, 0.6);
        }

        .login-info-table table {
            width: 100%;
            background: rgba(23, 28, 35, 0.6);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(31, 38, 48, 0.6);
        }

        .login-info-table .login-info {
            padding: 12px 16px;
            font-size: 0.8125rem;
            color: #B4BCC8;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            border-bottom: 1px solid rgba(31, 38, 48, 0.6);
        }

        .login-info-table tr:last-child .login-info {
            border-bottom: none;
        }

        .login-info-table .login-info:hover {
            background: rgba(139, 38, 53, 0.15);
            color: #E6EAF0;
        }

        .login-info-table .login-info b {
            color: #D4AF5A;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 575px) {
            .login-glass-card {
                padding: 36px 24px;
                border-radius: 20px;
            }

            .login-title-section h2 {
                font-size: 1.75rem;
            }

            .login-logo-wrapper img {
                max-width: 120px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="login-redesign">
        <div class="login-glass-card">
            <!-- Logo -->
            <div class="login-logo-wrapper">
                <a href="{{ route('index') }}">
                    <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}" />
                </a>
            </div>

            <!-- Title -->
            <div class="login-title-section">
                <h2>{{ __('Welcome Back') }}</h2>
                @if (getOption('disable_registration') != 1)
                    <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}">{{ __('Sign up') }}</a></p>
                @endif
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="login-form-group">
                    <label for="EmailAddress">{{ __('Email Address') }}</label>
                    <input type="text" class="login-form-control" id="EmailAddress" name="email" value="{{ old('email') }}"
                        placeholder="{{ __('Enter your email') }}" required />
                    @error('email')
                        <div class="login-form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="login-form-group">
                    <label for="Password">{{ __('Password') }}</label>
                    <input type="password" class="login-form-control" id="Password" name="password"
                        placeholder="{{ __('Enter your password') }}" required />
                    @error('password')
                        <div class="login-form-error">{{ $message }}</div>
                    @enderror
                </div>

                @if (!empty(getOption('google_recaptcha_status')) && getOption('google_recaptcha_status') == 1)
                    <div class="login-form-group">
                        {!! RecaptchaV3::field('register') !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="login-form-error">
                                {{ $errors->first('g-recaptcha-response') }}
                            </div>
                        @endif
                    </div>
                @endif

                <a href="{{ route('password.request') }}" class="login-forgot-link">
                    {{ __('Forgot your Password?') }}
                </a>

                <button type="submit" class="login-btn-primary">
                    {{ __('Log In') }}
                </button>
            </form>

            @if (getOption('google_login_status') == 1 || getOption('facebook_login_status') == 1)
                <!-- Social Login -->
                <div class="login-divider">
                    <span>{{ __('Or continue with') }}</span>
                </div>

                <div class="login-social-buttons">
                    @if (getOption('facebook_login_status') == 1)
                        <a href="{{ route('facebook-login') }}" class="login-social-btn">
                            <img src="{{ asset('assets/images/facebook.svg') }}" alt="facebook" />
                        </a>
                    @endif
                    @if (getOption('google_login_status') == 1)
                        <a href="{{ route('google-login') }}" class="login-social-btn">
                            <img src="{{ asset('assets/images/google.svg') }}" alt="google" />
                        </a>
                    @endif
                </div>
            @endif

            @if (env('LOGIN_HELP') == 'active')
                <div class="login-info-table">
                    <table>
                        <tbody>
                            @if(isCentralDomain())
                                <tr>
                                    <td id="superAdminCredentialShow" class="login-info">
                                        <b>Super Admin :</b> superadmin@gmail.com | 123456
                                    </td>
                                </tr>
                                <tr>
                                    <td id="adminCredentialShow" class="login-info">
                                        <b>Admin :</b> admin@gmail.com | 123456
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td id="adminCredentialShow" class="login-info">
                                        <b>Admin :</b> admin@gmail.com | 123456
                                    </td>
                                </tr>
                                <tr>
                                    <td id="userCredentialShow" class="login-info">
                                        <b>Alumni :</b> alumni@gmail.com | 123456
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict"
        $('#adminCredentialShow').on('click', function () {
            $('#EmailAddress').val('admin@gmail.com');
            $('#Password').val('123456');
        });
        $('#superAdminCredentialShow').on('click', function () {
            $('#EmailAddress').val('superadmin@gmail.com');
            $('#Password').val('123456');
        });
        $('#userCredentialShow').on('click', function () {
            $('#EmailAddress').val('alumni@gmail.com');
            $('#Password').val('123456');
        });
    </script>
@endpush