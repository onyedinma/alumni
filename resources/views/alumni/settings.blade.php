@extends('layouts.app')
@push('title')
    {{ __('Settings') }}
@endpush
@push('style')
<style>
    /* Premium Settings Page Styles */
    .settings-page {
        background: var(--bg-primary, #0B0E11);
        min-height: 100vh;
    }
    
    .settings-page .page-title {
        font-family: 'Playfair Display', serif;
        color: var(--gold, #D4AF5A);
        font-size: 28px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .settings-page .page-subtitle {
        color: var(--text-muted, #8C96A6);
        font-size: 14px;
    }
    
    /* Premium Card */
    .premium-card {
        background: var(--bg-surface, #12161C);
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        overflow: hidden;
    }
    
    /* Pill Tabs */
    .pill-tabs {
        display: flex;
        gap: 12px;
        padding: 8px;
        background: var(--bg-elevated, #171C23);
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 12px;
        margin-bottom: 0;
    }
    
    .pill-tabs .nav-item {
        flex: 0 0 auto;
    }
    
    .pill-tabs .nav-link {
        padding: 12px 28px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        color: var(--text-secondary, #B4BCC8);
        background: transparent;
        border: none;
        transition: all 0.25s ease;
    }
    
    .pill-tabs .nav-link:hover {
        color: var(--maroon, #8B2635);
        background: rgba(139, 38, 53, 0.1);
    }
    
    .pill-tabs .nav-link.active {
        background: var(--maroon, #8B2635);
        color: #FFFFFF;
        box-shadow: 0 4px 12px rgba(139, 38, 53, 0.3);
    }
    
    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }
    
    .section-header .icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--gold-light, rgba(212, 175, 90, 0.15));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold, #D4AF5A);
        font-size: 18px;
    }
    
    .section-header h4 {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary, #E6EAF0);
        margin: 0;
    }
    
    .section-header p {
        font-size: 13px;
        color: var(--text-muted, #8C96A6);
        margin: 0;
    }
    
    /* Security List */
    .security-list-premium {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .security-list-premium li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid var(--border-dark, #1F2630);
    }
    
    .security-list-premium li:last-child {
        border-bottom: none;
    }
    
    .security-item-info {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    
    .security-item-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--gold-light, rgba(212, 175, 90, 0.15));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold, #D4AF5A);
        font-size: 18px;
        flex-shrink: 0;
    }
    
    .security-item-text h5 {
        font-size: 16px;
        font-weight: 500;
        color: var(--text-primary, #E6EAF0);
        margin: 0 0 4px 0;
    }
    
    .security-item-text p {
        font-size: 13px;
        color: var(--text-muted, #8C96A6);
        margin: 0;
    }
    
    /* Premium Buttons */
    .btn-verify {
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-verify.primary {
        background: var(--maroon, #8B2635);
        color: #FFFFFF;
    }
    
    .btn-verify.primary:hover {
        background: var(--maroon-dark, #6a1d28);
        box-shadow: 0 4px 12px rgba(139, 38, 53, 0.35);
        transform: translateY(-1px);
    }
    
    .btn-verify.verified {
        background: rgba(63, 163, 108, 0.2);
        color: var(--success, #3FA36C);
        border: 1px solid rgba(63, 163, 108, 0.3);
        cursor: default;
    }
    
    .btn-verify.verified i {
        margin-right: 6px;
    }
    
    .btn-verify.disable {
        background: var(--bg-elevated, #171C23);
        color: var(--maroon, #8B2635);
        border: 1px solid var(--border-dark, #1F2630);
    }
    
    .btn-verify.disable:hover {
        background: rgba(139, 38, 53, 0.1);
        border-color: var(--maroon, #8B2635);
    }
    
    /* Premium Toggle */
    .toggle-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
    }
    
    .toggle-wrapper .toggle-label {
        font-size: 11px;
        color: var(--text-muted, #8C96A6);
    }
    
    .premium-toggle {
        position: relative;
        width: 52px;
        height: 28px;
    }
    
    .premium-toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .premium-toggle .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--border-dark, #1F2630);
        border-radius: 28px;
        transition: 0.3s;
    }
    
    .premium-toggle .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 3px;
        bottom: 3px;
        background-color: var(--text-secondary, #B4BCC8);
        border-radius: 50%;
        transition: 0.3s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .premium-toggle input:checked + .slider {
        background-color: var(--maroon, #8B2635);
    }
    
    .premium-toggle input:checked + .slider:before {
        background-color: #FFFFFF;
        transform: translateX(24px);
    }
    
    /* Change Password Section */
    .password-section-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 28px;
    }
    
    .password-section-header .icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--gold-light, rgba(212, 175, 90, 0.15));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold, #D4AF5A);
        font-size: 20px;
    }
    
    .password-section-header h4 {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary, #E6EAF0);
        margin: 0 0 4px 0;
    }
    
    .password-section-header p {
        font-size: 13px;
        color: var(--text-muted, #8C96A6);
        margin: 0;
    }
    
    /* Form Inputs */
    .premium-form-group {
        margin-bottom: 20px;
    }
    
    .premium-form-group label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary, #E6EAF0);
        margin-bottom: 8px;
    }
    
    .premium-form-group input {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 10px;
        font-size: 15px;
        color: var(--text-primary, #E6EAF0);
        transition: all 0.2s ease;
        background: var(--bg-primary, #0B0E11);
    }
    
    .premium-form-group input:focus {
        outline: none;
        border-color: var(--gold, #D4AF5A);
        box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.12);
        background: var(--bg-elevated, #171C23);
    }
    
    .premium-form-group input::placeholder {
        color: var(--text-disabled, #5E6675);
    }
    
    /* Submit Button */
    .btn-save-password {
        padding: 14px 32px;
        background: var(--maroon, #8B2635);
        color: #FFFFFF;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s ease;
        margin-top: 12px;
    }
    
    .btn-save-password:hover {
        background: var(--maroon-dark, #6a1d28);
        box-shadow: 0 6px 16px rgba(139, 38, 53, 0.35);
        transform: translateY(-2px);
    }
    
    /* Modal Enhancements */
    .premium-modal .modal-content {
        border-radius: 16px;
        border: 1px solid var(--border-dark, #1F2630);
        background: var(--bg-surface, #12161C);
        overflow: hidden;
    }
    
    .premium-modal .modal-header {
        background: linear-gradient(135deg, var(--maroon, #8B2635) 0%, var(--maroon-dark, #6a1d28) 100%);
        color: #FFFFFF;
        padding: 20px 24px;
        border-bottom: none;
    }
    
    .premium-modal .modal-header .modal-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 600;
    }
    
    .premium-modal .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }
    
    .premium-modal .modal-body {
        padding: 28px;
        color: var(--text-primary, #E6EAF0);
    }
    
    .premium-modal .btn-modal-action {
        padding: 12px 28px;
        background: var(--maroon, #8B2635);
        color: #FFFFFF;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .premium-modal .btn-modal-action:hover {
        background: var(--maroon-dark, #6a1d28);
    }
    
    /* Gold Divider */
    .gold-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold, #D4AF5A), transparent);
        margin: 20px 0;
        opacity: 0.4;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .pill-tabs {
            flex-direction: column;
        }
        
        .pill-tabs .nav-link {
            text-align: center;
        }
        
        .security-list-premium li {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }
        
        .security-item-info {
            width: 100%;
        }
    }
</style>
@endpush
@section('content')
    <div class="settings-page p-30">
        <div class="container-fluid px-0">
            <!-- Page Header -->
            <div class="mb-4">
                <h4 class="page-title mb-1">{{ __('Settings') }}</h4>
                <p class="page-subtitle">{{ __('Manage your account security and preferences') }}</p>
            </div>
            
            <!-- Main Card -->
            <div class="premium-card p-4 p-md-5">
                <!-- Pill Tabs -->
                <ul class="pill-tabs nav" id="settingsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="security-tab" data-bs-toggle="tab"
                                data-bs-target="#security-tab-pane" type="button" role="tab"
                                aria-controls="security-tab-pane" aria-selected="true">
                            <i class="fa-solid fa-shield-halved me-2"></i>{{ __('Security') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="changePassword-tab" data-bs-toggle="tab"
                                data-bs-target="#changePassword-tab-pane" type="button" role="tab"
                                aria-controls="changePassword-tab-pane" aria-selected="false">
                            <i class="fa-solid fa-key me-2"></i>{{ __('Change Password') }}
                        </button>
                    </li>
                </ul>
                
                <div class="gold-divider"></div>
                
                <!-- Tab Content -->
                <div class="tab-content" id="settingsTabContent">
                    <!-- Security Tab -->
                    <div class="tab-pane fade show active" id="security-tab-pane" role="tabpanel"
                         aria-labelledby="security-tab" tabindex="0">
                        <div class="max-w-840">
                            <ul class="security-list-premium">
                                <!-- Google Authentication -->
                                @if (!empty(getOption('two_factor_googleauth_status')) && getOption('two_factor_googleauth_status') == STATUS_ACTIVE)
                                    <li>
                                        <div class="security-item-info">
                                            <div class="security-item-icon">
                                                <i class="fa-brands fa-google"></i>
                                            </div>
                                            <div class="security-item-text">
                                                <h5>{{ __('Google Authentication') }}</h5>
                                                <p>{{ __('Protect your account with 2FA (Recommended)') }}</p>
                                            </div>
                                        </div>
                                        @if (auth()->user()->google_auth_status == 1)
                                            <button class="btn-verify disable" data-bs-toggle="modal"
                                                    data-bs-target="#googleAuthDisableModal">{{ __('Disable') }}</button>
                                        @else
                                            <button class="btn-verify primary" data-bs-toggle="modal"
                                                    data-bs-target="#googleAuthEnableModal">{{ __('Enable') }}</button>
                                        @endif
                                    </li>
                                @endif
                                
                                <!-- Phone Verification -->
                                <li>
                                    <div class="security-item-info">
                                        <div class="security-item-icon">
                                            <i class="fa-solid fa-mobile-screen"></i>
                                        </div>
                                        <div class="security-item-text">
                                            <h5>{{ __('Phone Number Verification') }}</h5>
                                            <p>{{ auth()->user()->mobile ?? __('Secure your account with a verified mobile number') }}</p>
                                        </div>
                                    </div>
                                    @if (auth()->user()->phone_verification_status == 1)
                                        <button type="button" class="btn-verify verified">
                                            <i class="fa-solid fa-check-circle"></i>{{ __('Verified') }}
                                        </button>
                                    @else
                                        <button class="btn-verify primary" data-bs-toggle="modal"
                                                data-bs-target="#phoneVerificationModal">{{ __('Verify') }}</button>
                                    @endif
                                </li>
                                
                                <!-- Email Verification -->
                                <li>
                                    <div class="security-item-info">
                                        <div class="security-item-icon">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div class="security-item-text">
                                            <h5>{{ __('Email Address Verification') }}</h5>
                                            <p>
                                                @if (auth()->user()->email_verification_status == 1)
                                                    {{ auth()->user()->email }}
                                                @else
                                                    {{ __('Verify your email to secure transactions') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if (auth()->user()->email_verification_status == 1)
                                        <button type="button" class="btn-verify verified">
                                            <i class="fa-solid fa-check-circle"></i>{{ __('Verified') }}
                                        </button>
                                    @else
                                        <a href="{{ route('email.verify', auth()->user()->verify_token) }}"
                                           class="btn-verify primary">{{ __('Verify') }}</a>
                                    @endif
                                </li>
                                
                                <!-- Show Email Toggle -->
                                <li>
                                    <div class="security-item-info">
                                        <div class="security-item-icon">
                                            <i class="fa-solid fa-eye"></i>
                                        </div>
                                        <div class="security-item-text">
                                            <h5>{{ __('Show Email in Public Profile') }}</h5>
                                            <p>{{ __('Allow other alumni to see your email address') }}</p>
                                        </div>
                                    </div>
                                    <div class="toggle-wrapper">
                                        <label class="premium-toggle">
                                            <input type="checkbox" 
                                                   onchange="changeSettingStatus(this,'show_email_in_public')"
                                                   {{ auth()->user()->show_email_in_public == STATUS_ACTIVE ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                        <span class="toggle-label">
                                            {{ auth()->user()->show_email_in_public == STATUS_ACTIVE ? __('Visible to alumni') : __('Hidden from public') }}
                                        </span>
                                    </div>
                                </li>
                                
                                <!-- Show Phone Toggle -->
                                <li>
                                    <div class="security-item-info">
                                        <div class="security-item-icon">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div class="security-item-text">
                                            <h5>{{ __('Show Phone in Public Profile') }}</h5>
                                            <p>{{ __('Allow other alumni to see your phone number') }}</p>
                                        </div>
                                    </div>
                                    <div class="toggle-wrapper">
                                        <label class="premium-toggle">
                                            <input type="checkbox" 
                                                   onchange="changeSettingStatus(this,'show_phone_in_public')"
                                                   {{ auth()->user()->show_phone_in_public == STATUS_ACTIVE ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                        <span class="toggle-label">
                                            {{ auth()->user()->show_phone_in_public == STATUS_ACTIVE ? __('Visible to alumni') : __('Hidden from public') }}
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Change Password Tab -->
                    <div class="tab-pane fade" id="changePassword-tab-pane" role="tabpanel"
                         aria-labelledby="changePassword-tab" tabindex="0">
                        <div class="max-w-840">
                            <div class="password-section-header">
                                <div class="icon">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <div>
                                    <h4>{{ __('Change Password') }}</h4>
                                    <p>{{ __('Create a strong password to secure your account') }}</p>
                                </div>
                            </div>
                            
                            <form class="ajax reset" action="{{ route('change-password') }}" 
                                  data-handler="commonResponseRedirect" 
                                  data-redirect-url="{{ route('settings') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="premium-form-group">
                                            <label for="currentPassword">{{ __('Current Password') }}</label>
                                            <input type="password" name="current_password" id="currentPassword"
                                                   placeholder="{{ __('Enter your current password') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="premium-form-group">
                                            <label for="newPassword">{{ __('New Password') }}</label>
                                            <input type="password" name="password" id="newPassword" 
                                                   placeholder="{{ __('Enter new password') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="premium-form-group">
                                            <label for="confirmPassword">{{ __('Confirm Password') }}</label>
                                            <input type="password" name="password_confirmation" id="confirmPassword"
                                                   placeholder="{{ __('Confirm new password') }}"/>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn-save-password">
                                    <i class="fa-solid fa-save me-2"></i>{{ __('Update Password') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="statusChangeRoute" value="{{ route('setting_update') }}">
    
    <!-- Enable Authentication Modal -->
    <div class="modal fade premium-modal" id="googleAuthEnableModal" tabindex="-1"
         aria-labelledby="googleAuthEnableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Enable 2FA Authentication') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="mb-4">
                                <p class="mb-2"><strong>{{ __('Step 1') }}:</strong> {{ __('Install Google Authenticator from') }}
                                    <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"
                                       target="_blank" style="color: #7A1E2B; font-weight: 600;">{{ __('Play Store') }}</a> {{ __('or') }}
                                    <a href="https://itunes.apple.com/us/app/google-authenticator/id388497605"
                                       target="_blank" style="color: #7A1E2B; font-weight: 600;">{{ __('App Store') }}</a>
                                </p>
                                <p class="mb-3"><strong>{{ __('Step 2') }}:</strong> {{ __('Scan the QR code or add manually') }}</p>
                            </div>
                            
                            <div class="mb-4 p-3" style="background: #F5F6F8; border-radius: 10px;">
                                <p class="mb-1"><strong>{{ __('Account Name') }}:</strong> {{ getOption('app_name') }}</p>
                                <p class="mb-0"><strong>{{ __('Secret Key') }}:</strong> 
                                    <code style="background: #fff; padding: 4px 8px; border-radius: 4px;">{{ auth()->user()->google2fa_secret }}</code>
                                </p>
                            </div>
                            
                            <form class="ajax reset" action="{{ route('google2fa.authenticate.enable') }}"
                                  method="post" data-handler="commonResponseForModal">
                                @csrf
                                <div class="premium-form-group">
                                    <label for="authenticationCode">{{ __('Enter Authenticator Code') }}</label>
                                    <input required type="text" name="one_time_password" id="authenticationCode" 
                                           placeholder="{{ __('Enter 6-digit code') }}"/>
                                </div>
                                <button type="submit" class="btn-modal-action">{{ __('Confirm 2FA') }}</button>
                            </form>
                            
                            <p class="mt-3" style="color: #C62828; font-size: 13px;">
                                <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                {{ __('Warning: If you lose access to your authenticator, you may lose access to your account.') }}
                            </p>
                        </div>
                        <div class="col-lg-5 text-center pt-4">
                            <div class="qr-code p-3" style="background: #F5F6F8; border-radius: 12px; display: inline-block;">
                                <img src="{{ $qr_code ?? '' }}" alt="QR Code" style="max-width: 180px;">
                            </div>
                            <p class="mt-2" style="font-size: 13px; color: #6B7280;">{{ __('Scan with your app') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disable Authentication Modal -->
    <div class="modal fade premium-modal" id="googleAuthDisableModal" tabindex="-1"
         aria-labelledby="googleAuthDisableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Disable 2FA Authentication') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-4" style="color: #6B7280;">{{ __('Enter your authenticator code to disable 2FA protection.') }}</p>
                    <form class="ajax reset" action="{{ route('google2fa.authenticate.disable') }}"
                          method="post" data-handler="commonResponseForModal">
                        @csrf
                        <div class="premium-form-group">
                            <label for="authenticationCodeDisable">{{ __('Authenticator Code') }}</label>
                            <input type="text" name="one_time_password" id="authenticationCodeDisable"
                                   placeholder="{{ __('Enter 6-digit code') }}"/>
                        </div>
                        <button type="submit" class="btn-modal-action" style="background: #C62828;">
                            {{ __('Disable 2FA') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Phone Verification Modal -->
    <div class="modal fade premium-modal" id="phoneVerificationModal" tabindex="-1"
         aria-labelledby="phoneVerificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Phone Verification') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="send-otp-section">
                        <p class="mb-3" style="color: #6B7280;">{{ __('We will send a verification code to your phone number.') }}</p>
                        <form class="ajax reset" action="{{ route('phone.verification.sms.send') }}"
                              method="post" data-handler="responseForSendSMS">
                            @csrf
                            <div class="premium-form-group">
                                <label for="mobileNumber">{{ __('Mobile Number') }}</label>
                                <input readonly id="mobileNumber" type="text" name="phone_no"
                                       value="{{ auth()->user()->mobile ?? '' }}"
                                       style="background: #F5F6F8;">
                            </div>
                            <p class="text-muted mb-3" style="font-size: 12px;">
                                {{ __('Make sure your number includes the country code') }}
                            </p>
                            <button type="submit" class="btn-modal-action">{{ __('Send SMS') }}</button>
                        </form>
                    </span>

                    <span class="verify-otp-section d-none">
                        <div class="p-3 mb-3" style="background: rgba(46, 125, 50, 0.1); border-radius: 8px;">
                            <i class="fa-solid fa-circle-check text-success me-1"></i>
                            {{ __('Code sent! Please do not close this modal.') }}
                        </div>
                        <form class="ajax reset otp-form" action="{{ route('phone.verification.sms.verify') }}" 
                              method="post" data-handler="commonResponseForModal">
                            @csrf
                            <div class="otp-input-fields mb-3" id="otp-block" style="display: flex; gap: 8px; justify-content: center;">
                                <input type="text" class="otp-field" name="opt_field[]" maxlength="1" required 
                                       style="width: 45px; height: 50px; text-align: center; font-size: 20px; font-weight: 600; border: 2px solid #E3E5E8; border-radius: 10px;"/>
                                <input type="text" class="otp-field" name="opt_field[]" maxlength="1" required 
                                       style="width: 45px; height: 50px; text-align: center; font-size: 20px; font-weight: 600; border: 2px solid #E3E5E8; border-radius: 10px;"/>
                                <input type="text" class="otp-field" name="opt_field[]" maxlength="1" required 
                                       style="width: 45px; height: 50px; text-align: center; font-size: 20px; font-weight: 600; border: 2px solid #E3E5E8; border-radius: 10px;"/>
                                <input type="text" class="otp-field" name="opt_field[]" maxlength="1" required 
                                       style="width: 45px; height: 50px; text-align: center; font-size: 20px; font-weight: 600; border: 2px solid #E3E5E8; border-radius: 10px;"/>
                                <input type="text" class="otp-field" name="opt_field[]" maxlength="1" required 
                                       style="width: 45px; height: 50px; text-align: center; font-size: 20px; font-weight: 600; border: 2px solid #E3E5E8; border-radius: 10px;"/>
                                <input type="text" class="otp-field" name="opt_field[]" maxlength="1" required 
                                       style="width: 45px; height: 50px; text-align: center; font-size: 20px; font-weight: 600; border: 2px solid #E3E5E8; border-radius: 10px;"/>
                            </div>
                            <input class="otp-value" type="hidden" name="opt-value">
                            <input type="hidden" value="{{ route('phone.verification.sms.resend') }}" id="resendRoute">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="resend-otp" 
                                        style="background: none; border: none; color: #7A1E2B; font-size: 14px; cursor: pointer;">
                                    {{ __('Resend Code') }}
                                </button>
                                <button type="submit" class="btn-modal-action">{{ __('Confirm') }}</button>
                            </div>
                        </form>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/js/configuration.js') }}"></script>
    <script src="{{ asset('alumni/js/phone-verification.js') }}"></script>
@endpush
