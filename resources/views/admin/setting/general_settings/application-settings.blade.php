@extends('layouts.app')
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
    
    .premium-card {
        background-color: var(--bg-surface, #12161C);
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.4);
        position: relative;
        overflow: hidden;
    }

    .premium-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
    }
    
    /* Sidebar Styling Override */
    .premium-sidebar-container {
        background-color: var(--bg-surface, #12161C) !important;
        border: 1px solid var(--border-dark, #1F2630) !important;
        border-radius: 24px;
        height: 100%;
        padding: 30px;
        /* Force override inner sidebar backgrounds */
    }

    .premium-sidebar-container .email__sidebar.bg-style {
        background: transparent !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
    }

    .premium-sidebar-container .list-item {
        color: var(--text-secondary, #B4BCC8) !important;
        padding: 12px 15px !important;
        border-radius: 12px !important;
        transition: all 0.3s ease !important;
        border-left: 3px solid transparent;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .premium-sidebar-container .list-item:hover {
        background: rgba(212, 175, 90, 0.1) !important;
        color: var(--gold, #D4AF5A) !important;
        border-left-color: var(--gold, #D4AF5A);
    }

    .premium-sidebar-container .list-item .fa {
        color: var(--text-secondary, #B4BCC8);
        transition: color 0.3s ease;
    }

    .premium-sidebar-container .list-item:hover .fa {
        color: var(--gold, #D4AF5A);
    }

    /* Active State (You might need to target the specific active class output by blade) */
    .premium-sidebar-container .list-item .font-bold.text-1b1c17 { /* Overriding the text color class */
        color: inherit !important;
        font-weight: 500 !important;
    }
    
    /* Input Group Styling */
    .premium-input-group {
        display: flex;
        align-items: stretch;
        border: 1px solid var(--border-dark, #1F2630);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        background-color: var(--bg-primary, #0B0E11);
    }
    
    .premium-input-group:focus-within {
        border-color: var(--gold, #D4AF5A);
        box-shadow: 0 0 0 2px rgba(212, 175, 90, 0.2);
    }

    .premium-input-group-text {
        background: var(--bg-elevated, #171C23);
        border-right: 1px solid var(--border-dark, #1F2630);
        color: var(--gold, #D4AF5A);
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
    }
    
    .premium-input-group .primary-form-control {
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        height: auto;
    }
    
    /* Form Controls */
    .primary-form-control {
        background-color: var(--bg-primary, #0B0E11) !important;
        border: 1px solid var(--border-dark, #1F2630) !important;
        color: var(--text-primary, #E6EAF0) !important;
        border-radius: 12px;
        padding: 12px 16px;
    }
    
    .primary-form-control:focus {
        border-color: var(--gold, #D4AF5A) !important;
        box-shadow: 0 0 0 2px rgba(212, 175, 90, 0.2) !important;
    }
    
    .form-label {
        color: var(--text-primary, #E6EAF0) !important;
        font-weight: 500;
        margin-bottom: 12px !important; /* Force space */
        display: block !important; /* Force block */
        position: static !important; /* Force static */
        transform: none !important; /* Force no transform */
        background: transparent !important;
        padding: 0 !important;
    }
    
    /* Ensure no container pushes it incorrectly */
    .primary-form-group-wrap {
        display: block !important;
        position: relative !important;
        padding-top: 5px !important; /* Add slight top padding for breathing room */
    }

    /* Remove any negative margins from groupings that might pull labels down */
    .primary-form-group.my-2 {
        padding-top: 0 !important;
        margin-top: 1.5rem !important;
    }
    
    /* Buttons */
    .premium-btn {
        background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
        color: #000 !important;
        border: none !important;
        font-weight: 600 !important;
        border-radius: 12px;
        padding: 12px 30px;
        transition: all 0.3s ease;
    }
    
    .premium-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
    }
    
    h4 {
        color: var(--text-primary, #fff) !important;
    }
    
    /* Select styling override */
    .sf-select {
        background-color: var(--bg-primary, #0B0E11) !important;
        border: 1px solid var(--border-dark, #1F2630) !important;
        color: var(--text-primary, #E6EAF0) !important;
    }
</style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-cogs" style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.setting.partials.general-sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">
                        <div class="email-inbox__area bg-style form-horizontal__item bg-style admin-general-settings-page">
                            <div class="item-top mb-30">
                                <h4>{{ $title }}</h4>
                            </div>
                            <form class="ajax" action="{{ route('admin.setting.application-settings.update') }}"
                                method="POST" enctype="multipart/form-data" data-handler="settingCommonHandler">
                                @csrf
                                <div class="row">
                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('App Name') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                                                    <input type="text" name="app_name" value="{{ getOption('app_name') }}" class="primary-form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('App Email') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                                    <input type="text" name="app_email" value="{{ getOption('app_email') }}" class="primary-form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('App Contact Number') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                    <input type="text" name="app_contact_number" value="{{ getOption('app_contact_number') }}" class="primary-form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('App Location') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i class="fa-solid fa-map-marker-alt"></i></span>
                                                    <input type="text" name="app_location" value="{{ getOption('app_location') }}" class="primary-form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!isAddonInstalled('ALUSAAS'))
                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('App Copyright') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i class="fa-solid fa-copyright"></i></span>
                                                    <input type="text" name="app_copyright" value="{{ getOption('app_copyright') }}" class="primary-form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label class="form-label">{{ __('Developed By') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i class="fa-solid fa-code"></i></span>
                                                    <input type="text" name="app_developed" value="{{ getOption('app_developed') }}" class="primary-form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="primary-form-group my-2">
                                            <div class="primary-form-group-wrap">
                                                <label for="app_timezone" class="form-label">{{ __('Timezone') }} <span class="text-danger">*</span></label>
                                                <div class="premium-input-group">
                                                    <span class="premium-input-group-text"><i class="fa-solid fa-clock"></i></span>
                                                    <select name="app_timezone" class="primary-form-control sf-select" style="flex: 1;">
                                                        @foreach ($timezones as $timezone)
                                                            <option value="{{ $timezone }}"
                                                                {{ $timezone == getOption('app_timezone') ? 'selected' : '' }}>
                                                                {{ $timezone }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input__group general-settings-btn text-end">
                                                <button type="submit"
                                                    class="premium-btn">{{ __('Update') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
