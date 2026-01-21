@extends('auth.layouts.app')
@push('title')
    {{ __('Register') }}
@endpush

@push('style')
<style>
    :root {
        --brand-gold: #D4AF5A;
        --brand-gold-light: rgba(212, 175, 90, 0.15);
        --brand-maroon: #751525;
        --brand-ash: #3C3C3C;
        --brand-dark: #0B0E11;
    }

    .register-area {
        min-height: 100vh;
        display: flex;
        background: linear-gradient(135deg, var(--brand-dark) 0%, #1a1a2e 100%);
    }

    .register-wrap {
        display: flex;
        width: 100%;
        min-height: 100vh;
    }

    /* Left Panel - Branding */
    .register-left {
        width: 45%;
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px;
    }

    .register-left::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(11, 14, 17, 0.9) 0%, rgba(117, 21, 37, 0.85) 100%);
    }

    .register-left-wrap {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 450px;
    }

    .register-left-wrap .logo {
        max-width: 180px;
        margin-bottom: 40px;
        filter: drop-shadow(0 4px 20px rgba(0, 0, 0, 0.3));
    }

    .register-left-wrap h2 {
        font-size: 42px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 20px;
        font-family: 'Playfair Display', serif;
        line-height: 1.2;
    }

    .register-left-wrap p {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        margin-bottom: 40px;
    }

    .feature-list {
        text-align: left;
        margin-top: 40px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .feature-item:last-child {
        border-bottom: none;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: var(--brand-gold-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .feature-icon i {
        color: var(--brand-gold);
        font-size: 20px;
    }

    .feature-text {
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
        font-weight: 500;
    }

    /* Right Panel - Form */
    .register-right {
        width: 55%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px;
        overflow-y: auto;
    }

    .form-container {
        width: 100%;
        max-width: 550px;
    }

    .form-header {
        margin-bottom: 35px;
    }

    .form-header h2 {
        font-size: 32px;
        font-weight: 700;
        color: var(--brand-dark);
        margin-bottom: 10px;
        font-family: 'Playfair Display', serif;
    }

    .form-header p {
        font-size: 16px;
        color: var(--brand-ash);
    }

    .form-header a {
        color: var(--brand-maroon);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .form-header a:hover {
        color: var(--brand-gold);
    }

    /* Form Fields */
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        flex: 1;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label,
    .form-container label,
    .form-container .form-group label {
        display: block !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #000000 !important;
        margin-bottom: 12px !important;
        letter-spacing: 0.3px;
        text-transform: none !important;
    }

    .form-group label .required {
        color: var(--brand-maroon);
    }

    .form-input {
        width: 100%;
        height: 52px;
        padding: 14px 18px;
        border: 2px solid #e8e8e8;
        border-radius: 10px;
        font-size: 15px;
        color: var(--brand-dark);
        background: #fafafa;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--brand-gold);
        background: #fff;
        box-shadow: 0 0 0 4px var(--brand-gold-light);
    }

    .form-input::placeholder {
        color: #999;
    }

    select.form-input {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%233C3C3C' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }

    .error-text {
        font-size: 12px;
        color: var(--brand-maroon);
        margin-top: 5px;
        display: block;
    }

    /* Submit Button */
    .btn-register {
        width: 100%;
        height: 56px;
        background: var(--brand-maroon);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .btn-register:hover {
        background: var(--brand-gold);
        color: var(--brand-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 90, 0.4);
    }

    .btn-register i {
        font-size: 18px;
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        margin: 30px 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e8e8e8;
    }

    .divider span {
        padding: 0 20px;
        color: #999;
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .register-left {
            width: 40%;
            padding: 40px;
        }
        .register-right {
            width: 60%;
            padding: 40px;
        }
    }

    @media (max-width: 991px) {
        .register-wrap {
            flex-direction: column;
        }
        .register-left {
            width: 100%;
            min-height: 300px;
            padding: 40px 20px;
        }
        .register-left-wrap h2 {
            font-size: 28px;
        }
        .feature-list {
            display: none;
        }
        .register-right {
            width: 100%;
            padding: 40px 20px;
        }
    }

    @media (max-width: 576px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        .form-row .form-group {
            margin-bottom: 20px;
        }
    }
</style>
@endpush

@section('content')
    <div class="register-area">
        <div class="register-wrap">
            <!-- Left Panel -->
            <div class="register-left" style="background-image: url({{ getSettingImage('login_left_image') }})">
                <div class="register-left-wrap">
                    <a href="{{ route('index') }}">
                        <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}" class="logo" />
                    </a>
                    <h2>{{ getOption('sign_up_left_text_title') ?: 'Join Our Alumni Network' }}</h2>
                    <p>{{ getOption('sign_up_left_text_subtitle') ?: 'Connect with fellow graduates and unlock exclusive opportunities.' }}</p>
                    
                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <span class="feature-text">Connect with thousands of alumni</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <span class="feature-text">Access exclusive job opportunities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <span class="feature-text">Attend reunions and events</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="register-right">
                <div class="form-container">
                    <div class="form-header">
                        <h2>{{ __('Create Account') }}</h2>
                        <p>{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Sign In') }}</a></p>
                    </div>

                    <form action="{{ route('register') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        
                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="fullName" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Full Name') }} <span style="color: #751525;">*</span></label>
                            <input type="text" class="form-input" id="fullName" name="name" 
                                   value="{{ old('name') }}" placeholder="{{ __('Enter your full name') }}" />
                            @error('name')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(!isCentralDomain() || !isAddonInstalled('ALUSAAS'))
                        <!-- First Class & House Row -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="FirstClass" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('First Year Class') }}</label>
                                <select class="form-input" id="FirstClass" name="first_class_id">
                                    <option value="">{{ __('Select Entry Class') }}</option>
                                    @foreach ($classes as $class)
                                        <option {{ old('first_class_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">
                                            {{ __($class->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="FirstHouse" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('First House') }}</label>
                                <select class="form-input" id="FirstHouse" name="first_house_id">
                                    <option value="">{{ __('Select Entry House') }}</option>
                                    @foreach ($houses as $house)
                                        <option {{ old('first_house_id') == $house->id ? 'selected' : '' }} value="{{ $house->id }}">
                                            {{ __($house->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Final Class & House Row -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="FinalClass" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Final Year Class') }}</label>
                                <select class="form-input" id="FinalClass" name="final_class_id">
                                    <option value="">{{ __('Select Exit Class') }}</option>
                                    @foreach ($classes as $class)
                                        <option {{ old('final_class_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">
                                            {{ __($class->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="FinalHouse" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Final House') }}</label>
                                <select class="form-input" id="FinalHouse" name="final_house_id">
                                    <option value="">{{ __('Select Exit House') }}</option>
                                    @foreach ($houses as $house)
                                        <option {{ old('final_house_id') == $house->id ? 'selected' : '' }} value="{{ $house->id }}">
                                            {{ __($house->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Passing Year & Nickname Row -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="PassingYear" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Class of (Year)') }}</label>
                                <select class="form-input" id="PassingYear" name="passing_year_id">
                                    <option value="">{{ __('Select Graduation Year') }}</option>
                                    @foreach ($passingYears as $passingYear)
                                        <option {{ old('passing_year_id') == $passingYear->id ? 'selected' : '' }} value="{{ $passingYear->id }}">
                                            {{ __($passingYear->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="NickName" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Nick Name / Alias') }}</label>
                                <input type="text" class="form-input" id="NickName" name="nickname"
                                       value="{{ old('nickname') }}" placeholder="{{ __('Your Nickname') }}" />
                            </div>
                        </div>
                        @endif

                        @if (!empty(getOption('register_file_required')) && getOption('register_file_required') == STATUS_ACTIVE)
                        <!-- Attachment -->
                        <div class="form-group">
                            <label for="attachmentFile" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">
                                {{ __('Attachment') }} (PDF)
                                @if (getOption('register_file_required', 0))
                                    <span style="color: #751525;">*</span>
                                @endif
                            </label>
                            <input type="file" class="form-input" id="attachmentFile" accept="application/pdf" name="file" 
                                   style="padding: 12px 18px;" />
                            @error('file')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        <!-- Birth Date & Gender Row -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="BirthDate" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Birth Date') }} <span style="color: #751525;">*</span></label>
                                <input type="date" class="form-input" id="BirthDate" name="date_of_birth"
                                       value="{{ old('date_of_birth') }}" />
                                @error('date_of_birth')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Gender" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Gender') }} <span style="color: #751525;">*</span></label>
                                <select class="form-input" id="Gender" name="gender">
                                    <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">{{ __('Male') }}</option>
                                    <option {{ old('gender') == 'female' ? 'selected' : '' }} value="female">{{ __('Female') }}</option>
                                    <option {{ old('gender') == 'other' ? 'selected' : '' }} value="other">{{ __('Other') }}</option>
                                </select>
                                @error('gender')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Row -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="Password" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Password') }} <span style="color: #751525;">*</span></label>
                                <input type="password" class="form-input" id="Password" name="password"
                                       placeholder="••••••••" />
                                @error('password')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword" style="color: #000000 !important; font-weight: 700 !important; font-size: 15px !important; display: block; margin-bottom: 10px;">{{ __('Confirm Password') }} <span style="color: #751525;">*</span></label>
                                <input type="password" class="form-input" id="ConfirmPassword" name="password_confirmation"
                                       placeholder="••••••••" />
                                @error('password_confirmation')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if (!empty(getOption('google_recaptcha_status')) && getOption('google_recaptcha_status') == 1)
                            <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                {!! RecaptchaV3::field('register') !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="error-text">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                            </div>
                        @endif

                        <button type="submit" class="btn-register">
                            <span>{{ __('Create Account') }}</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>

                    <div class="divider">
                        <span>{{ __('Secure Registration') }}</span>
                    </div>

                    <p style="text-align: center; color: #999; font-size: 13px;">
                        {{ __('By creating an account, you agree to our Terms of Service and Privacy Policy.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

