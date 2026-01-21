@extends('layouts.app')
@push('admin-style')
<link rel="stylesheet" href="{{ asset('admin/styles/main.css') }}">
@endpush
@push('title')
{{ $title }}
@endpush
@section('content')
<style>
    /* Premium Admin Panel Standards */
    .premium-admin-panel {
        background-color: var(--bg-primary, #0B0E11);
        min-height: 100vh;
        padding: 30px;
    }

    .premium-header {
        font-family: 'Playfair Display', serif;
        color: #fff;
    }

    /* Generic Premium Card */
    .premium-card {
        background-color: var(--bg-surface, #12161C);
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .premium-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
    }

    /* Table Styling Overrides (Shared with other pages) */
    .premium-card .table-responsive {
        background: transparent !important;
    }

    .premium-card table.zTable {
        background: var(--bg-primary, #0B0E11) !important;
        border-radius: 12px;
        overflow: hidden;
    }

    .premium-card table.zTable thead {
        background: var(--bg-elevated, #171C23) !important;
    }

    .premium-card table.zTable thead th {
        color: var(--gold, #D4AF5A) !important;
        font-weight: 500 !important;
        font-size: 13px !important;
        letter-spacing: 0.3px !important;
        border-bottom: 1px solid var(--border-dark, #1F2630) !important;
        padding: 12px 14px !important;
        background: var(--bg-elevated, #171C23) !important;
        border-top: none !important;
    }

    .premium-card table.zTable thead th div {
        color: var(--gold, #D4AF5A) !important;
        background: transparent !important;
        font-size: 13px !important;
        font-weight: 500 !important;
    }

    .premium-card table.zTable tbody td {
        color: var(--text-primary, #E6EAF0) !important;
        border-bottom: 1px solid var(--border-dark, #1F2630) !important;
        padding: 16px !important;
        background: var(--bg-primary, #0B0E11) !important;
        vertical-align: middle;
    }
    
    .premium-card table.zTable tbody td h6 {
         color: var(--text-primary, #E6EAF0) !important;
         margin-bottom: 5px;
    }
    
    .premium-card table.zTable tbody td small {
         color: var(--text-secondary, #B4BCC8) !important;
    }

    .premium-card table.zTable tbody tr:hover td {
        background: var(--bg-elevated, #171C23) !important;
    }

    /* Buttons */
    .premium-btn {
        background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
        color: #000 !important;
        border: none !important;
        font-weight: 600 !important;
        border-radius: 12px;
        padding: 10px 26px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-outline-success {
        border-color: var(--gold, #D4AF5A) !important;
        color: var(--gold, #D4AF5A) !important;
        background: transparent !important;
    }
    
    .btn-outline-success:hover {
        background: var(--gold, #D4AF5A) !important;
        color: #000 !important;
    }
    
    .btn-outline-dark {
         border-color: var(--text-secondary, #B4BCC8) !important;
         color: var(--text-secondary, #B4BCC8) !important;
    }
    
    .btn-outline-dark:hover {
        background: var(--bg-elevated, #171C23) !important;
        color: #fff !important;
    }

     /* Modal Styling */
    .zModalTwo-content {
        background-color: var(--bg-surface, #12161C) !important;
        border: 1px solid var(--gold, #D4AF5A) !important;
        border-radius: 16px;
    }

    .zModalTwo-body h4,
    .zModalTwo-body label,
    .zModalTwo-body .col-form-label,
    .modal-title {
        color: var(--text-primary, #E6EAF0) !important;
    }
    
    .modal-header, .modal-footer {
         border-color: var(--border-dark, #1F2630);
    }
    
    .btn-close {
         filter: invert(1);
    }

    .form-control {
        background-color: var(--bg-primary, #0B0E11) !important;
        border: 1px solid var(--border-dark, #1F2630) !important;
        color: var(--text-primary, #E6EAF0) !important;
    }

    .form-control:focus {
        border-color: var(--gold, #D4AF5A) !important;
    }
</style>

<div class="premium-admin-panel">
    
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-24 fw-600 premium-header mb-0">
            <i class="fa-solid fa-cogs" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
        </h4>
    </div>

    <div class="premium-card">
        <div class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
            <input type="hidden" id="statusChangeRoute"
                value="{{ route('admin.setting.configuration-settings.update') }}">
            <input type="hidden" id="configureUrl"
                value="{{ route('admin.setting.configuration-settings.configure') }}">
            <input type="hidden" id="helpUrl" value="{{ route('admin.setting.configuration-settings.help') }}">
            <form class="ajax" action="{{ route('admin.setting.configuration-settings.update') }}" method="POST"
                enctype="multipart/form-data" data-handler="settingCommonHandler">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive zTable-responsive">
                            <table class="table zTable">
                                <thead>
                                    <tr>
                                        <th class="min-w-160">
                                            <div><i class="fa-solid fa-puzzle-piece" style="margin-right: 8px;"></i>{{ __('Extension') }}</div>
                                        </th>
                                        <th class="text-center">
                                            <div><i class="fa-solid fa-toggle-on" style="margin-right: 8px;"></i>{{ __('Status') }}</div>
                                        </th>
                                        <th class="text-center">
                                            <div><i class="fa-solid fa-cog" style="margin-right: 8px;"></i>{{ __('Action') }}</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Email Verification') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable Email
                                                Verification, new user have to verify the email to access this
                                                system.') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'email_verification_status')"
                                                    value="1" {{
                                                    getOption('email_verification_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="email_verification_status"
                                                    type="checkbox" role="switch"
                                                    id="email_verification_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                @if(!isAddonInstalled('ALUSAAS'))
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('email_verification_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                @endif
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('email_verification_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @if(!isAddonInstalled('ALUSAAS'))
                                    <tr>
                                        <td>
                                            <h6>{{ __('E-mail credentials status') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for sending email') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'app_mail_status')"
                                                    value="1" {{ getOption('app_mail_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="app_mail_status" type="checkbox"
                                                    role="switch" id="app_mail_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                @if(!isAddonInstalled('ALUSAAS'))
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('app_mail_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                @endif
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('app_mail_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            <h6>{{ __('SMS credentials status') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for sending sms') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'app_sms_status')"
                                                    value="1" {{ getOption('app_sms_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="app_sms_status" type="checkbox"
                                                    role="switch" id="app_sms_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('app_sms_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('app_sms_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Pusher credentials status') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for pusher') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'pusher_status')"
                                                    value="1" {{ getOption('pusher_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="pusher_status" type="checkbox"
                                                    role="switch" id="pusher_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('pusher_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('pusher_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Social Login (Google)') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for Google. User can use our gmail account
                                                and sign in') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'google_login_status')"
                                                    value="1" {{ getOption('google_login_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="google_login_status"
                                                    type="checkbox" role="switch" id="google_login_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('google_login_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('google_login_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Social Login (Facebook)') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for Facebook. User can use our facebook
                                                account and sign in') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'facebook_login_status')"
                                                    value="1" {{
                                                    getOption('facebook_login_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="facebook_login_status"
                                                    type="checkbox" role="switch" id="facebook_login_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('facebook_login_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('facebook_login_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Google Recaptcha Credentials') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for google recaptcha credentials') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'google_recaptcha_status')"
                                                    value="1" {{
                                                    getOption('google_recaptcha_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="google_recaptcha_status"
                                                    type="checkbox" role="switch" id="google_recaptcha_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('google_recaptcha_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('google_recaptcha_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Google Analytics') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for google analytics. ') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'google_analytics_status')"
                                                    value="1" {{
                                                    getOption('google_analytics_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="google_analytics_status"
                                                    type="checkbox" role="switch" id="google_analytics_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('google_analytics_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('google_analytics_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Cookie Consent') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for cookie consent settings. User Can manage
                                                cookie consent setting') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'cookie_status')"
                                                    value="1" {{ getOption('cookie_status')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="cookie_status" type="checkbox"
                                                    role="switch" id="cookie_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-success p-2"
                                                    onclick="configureModal('cookie_status')"
                                                    title="{{ __('Configure') }}">
                                                    <i class="fa-solid fa-wrench"></i> {{ __('Configure') }}
                                                </button>
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('cookie_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Google 2fa') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for google 2fa. By wearing it you will know
                                                how this setting works') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'two_factor_googleauth_status')"
                                                    value="1" {{
                                                    getOption('two_factor_googleauth_status', 0)==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="two_factor_googleauth_status"
                                                    type="checkbox" role="switch"
                                                    id="two_factor_googleauth_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('two_factor_googleauth_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Register File Required') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for register file required approval. By
                                                wearing it you will know how this setting works.') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'register_file_required')"
                                                    value="1" {{
                                                    getOption('register_file_required')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="register_file_required"
                                                    type="checkbox" role="switch" id="register_file_required">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('register_file_required')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Preloader') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable preloader,
                                                the preloader will be show before load the content.') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'app_preloader_status')"
                                                    value="1" {{
                                                    getOption('app_preloader_status')==STATUS_ACTIVE ? 'checked'
                                                    : '' }} name="app_preloader_status" type="checkbox"
                                                    role="switch" id="app_preloader_status">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('app_preloader_status')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Disable Registration') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for disable registration. By wearing it you
                                                will know how this setting works') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'disable_registration')"
                                                    value="1" {{
                                                    getOption('disable_registration')==STATUS_ACTIVE ? 'checked'
                                                    : '' }} name="disable_registration" type="checkbox"
                                                    role="switch" id="disable_registration">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('disable_registration')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('Registration Approval') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for registration approval. By wearing it you
                                                will know how this setting works.') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'registration_approval')"
                                                    value="1" {{
                                                    getOption('registration_approval')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="registration_approval"
                                                    type="checkbox" role="switch" id="registration_approval">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('registration_approval')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @if(!isAddonInstalled('ALUSAAS'))
                                    <tr>
                                        <td>
                                            <h6>{{ __('Show Language Switcher') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this. The
                                                system will enable for show language switcher. By wearing it you
                                                will know how this setting works.') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'show_language_switcher')"
                                                    value="1" {{
                                                    getOption('show_language_switcher')==STATUS_ACTIVE
                                                    ? 'checked' : '' }} name="show_language_switcher"
                                                    type="checkbox" role="switch" id="show_language_switcher">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('show_language_switcher')"
                                                    title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>{{ __('App Debug') }}</h6>
                                            <small class="fst-italic fw-normal">({{ __('If you enable this.No
                                                warning message will be shown for any error. By wearing it you
                                                will know how this setting works.') }}
                                                )</small>
                                        </td>
                                        <td class="text-center pt-17">
                                            <div class="zCheck form-switch">
                                                <input class="form-check-input mt-0"
                                                    onchange="changeSettingStatus(this,'app_debug')" value="1"
                                                    {{ getOption('app_debug')==STATUS_ACTIVE ? 'checked' : '' }}
                                                    name="app_debug" type="checkbox" role="switch"
                                                    id="app_debug">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons d-flex justify-content-end gap-2">
                                                <button type="button"
                                                    class="btn btn-action btn-outline-dark p-2"
                                                    onclick="helpModal('app_debug')" title="{{ __('Help') }}">
                                                    <i class="fa-solid fa-circle-question"></i> {{ __('Help') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Configuration section start -->
<div class="modal fade main-modal" id="configureModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">

        </div>
    </div>
</div>

<!-- Configuration section end -->
<!-- Help section start -->
<div class="modal fade main-modal" id="helpModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">

        </div>
    </div>
</div>
<!-- Help section end -->

<!-- Test Email section start -->
<div class="modal fade" id="sendTestMail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Test Mail') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.setting.mail.test') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 text-black">
                        <label for="to" class="col-form-label">{{ __('Recipient') }}:</label>
                        <input type="email" name="to" class="form-control" id="to"
                            placeholder="{{ __('Recipient Mail') }}" required>
                    </div>
                    <div class="mb-3 text-black">
                        <label for="to" class="col-form-label">{{ __('Subject') }}:</label>
                        <input type="text" name="subject" class="form-control" id="to" placeholder="{{ __('Subject') }}"
                            value="Test Mail" required>
                    </div>
                    <div class="mb-3 text-black">
                        <label for="message" class="col-form-label">{{ __('Your Message') }}:</label>
                        <textarea name="message" class="form-control" id="message-text">{{ __('Hi, This is a test mail')
                            }}</textarea>
                    </div>
                </div>
                <div class="modal-footer button__list">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="premium-btn">{{
                        __('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- TEST EMail section end -->

<!-- TEST SMS section start -->
<div class="modal fade" id="sendTestSMS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content zModalTwo-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Test SMS') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax reset" action="{{ route('admin.setting.sms.test') }}" method="post"
            enctype="multipart/form-data" data-handler="commonResponseForModal" >
                @csrf
                <div class="modal-body">
                    <div class="mb-3 text-black">
                        <label for="to" class="col-form-label">{{ __('Recipient Number') }}:</label>
                        <input type="text" name="to" class="form-control" id="to"
                            placeholder="{{ __('Recipient Number') }}" required>
                    </div>
                    <div class="mb-3 text-black">
                        <label for="message" class="col-form-label">{{ __('Your Message') }}:</label>
                        <textarea name="message" class="form-control" id="message-text">{{ __('Hi, This is a test sms')
                            }}</textarea>
                    </div>
                </div>
                <div class="modal-footer button__list">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="premium-btn">{{
                        __('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- TEST SMS section end -->
@endsection
@push('script')
<script src="{{ asset('admin/js/configuration.js') }}"></script>
@endpush
