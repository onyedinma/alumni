@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-detail">
        <!-- Hero Header -->
        <div class="pp-hero" style="padding-bottom:100px;">
            <div
                style="display:flex;flex-wrap:wrap;align-items:center;gap:24px;max-width:1400px;margin:0 auto;text-align:left;position:relative;z-index:1;">
                <div class="pp-job-logo" style="width:100px;height:100px;">
                    <img src="{{ getFileUrl($jobPostData->company_logo) }}" alt="{{ $jobPostData->company_name }}">
                </div>
                <div style="flex:1;min-width:200px;">
                    <h1 class="pp-hero__title" style="text-align:left;margin-bottom:8px;">{{ $jobPostData->title }}</h1>
                    <div class="pp-info" style="color:var(--pp-gold-light);">
                        <span class="pp-info__item"
                            style="color:#fff;font-weight:600;">{{ $jobPostData->company_name }}</span>
                        <span class="pp-info__item"><i class="fas fa-map-marker-alt"></i>
                            {{ $jobPostData->location }}</span>
                        <span class="pp-info__item"><i class="fas fa-briefcase"></i> {{ $jobPostData->job_type }}</span>
                    </div>
                </div>
                <div style="flex-shrink:0;">
                    @if($jobPostData->application_deadline > now())
                        <a href="{{ $jobPostData->application_link }}" target="_blank" class="pp-btn pp-btn--gold">
                            {{ __('Apply Now') }}
                        </a>
                    @else
                        <span class="pp-btn"
                            style="background:rgba(139,38,53,0.3);color:var(--pp-text-muted);border-color:var(--pp-maroon);cursor:not-allowed;">
                            {{ __('Application Closed') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="pp-detail__content" style="margin-top:-60px;">
            <div class="pp-detail__grid">
                <!-- Main Content -->
                <div style="display:flex;flex-direction:column;gap:32px;">
                    <div class="pp-detail__main">
                        <h3 style="font-size:1.3rem;padding-bottom:16px;border-bottom:1px solid var(--pp-border);">
                            {{ __('Job Description') }}</h3>
                        <div class="prose pp-prose">{!! $jobPostData->description !!}</div>
                    </div>

                    <div class="pp-detail__main" style="animation-delay:0.1s;">
                        <h3 style="font-size:1.3rem;padding-bottom:16px;border-bottom:1px solid var(--pp-border);">
                            {{ __('Responsibilities') }}</h3>
                        <div class="prose pp-prose">{!! $jobPostData->responsibilities !!}</div>
                    </div>

                    <div class="pp-detail__main" style="animation-delay:0.2s;">
                        <h3 style="font-size:1.3rem;padding-bottom:16px;border-bottom:1px solid var(--pp-border);">
                            {{ __('Requirements') }}</h3>
                        <div class="prose pp-prose">{!! $jobPostData->requirements !!}</div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="pp-detail__sidebar">
                    <h4 style="margin-bottom:24px;">{{ __('Job Overview') }}</h4>

                    <div style="display:flex;flex-direction:column;gap:20px;">
                        <div style="display:flex;align-items:center;gap:14px;">
                            <div
                                style="width:44px;height:44px;border-radius:10px;background:rgba(212,175,90,0.1);border:1px solid var(--pp-border-gold);display:flex;align-items:center;justify-content:center;color:var(--pp-gold);flex-shrink:0;">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div>
                                <p
                                    style="font-size:0.7rem;color:var(--pp-text-muted);text-transform:uppercase;font-weight:600;letter-spacing:0.1em;margin-bottom:2px;font-family:'Inter',sans-serif;">
                                    {{ __('Salary') }}</p>
                                <p style="color:var(--pp-text-primary);font-weight:700;font-family:'Inter',sans-serif;">
                                    {{ $jobPostData->salary }}</p>
                            </div>
                        </div>

                        <div style="display:flex;align-items:center;gap:14px;">
                            <div
                                style="width:44px;height:44px;border-radius:10px;background:rgba(212,175,90,0.1);border:1px solid var(--pp-border-gold);display:flex;align-items:center;justify-content:center;color:var(--pp-gold);flex-shrink:0;">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p
                                    style="font-size:0.7rem;color:var(--pp-text-muted);text-transform:uppercase;font-weight:600;letter-spacing:0.1em;margin-bottom:2px;font-family:'Inter',sans-serif;">
                                    {{ __('Posted Date') }}</p>
                                <p style="color:var(--pp-text-primary);font-weight:700;font-family:'Inter',sans-serif;">
                                    {{ \Carbon\Carbon::parse($jobPostData->created_at)->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div style="display:flex;align-items:center;gap:14px;">
                            <div
                                style="width:44px;height:44px;border-radius:10px;background:rgba(212,175,90,0.1);border:1px solid var(--pp-border-gold);display:flex;align-items:center;justify-content:center;color:var(--pp-gold);flex-shrink:0;">
                                <i class="far fa-clock"></i>
                            </div>
                            <div>
                                <p
                                    style="font-size:0.7rem;color:var(--pp-text-muted);text-transform:uppercase;font-weight:600;letter-spacing:0.1em;margin-bottom:2px;font-family:'Inter',sans-serif;">
                                    {{ __('Deadline') }}</p>
                                <p style="color:var(--pp-gold);font-weight:700;font-family:'Inter',sans-serif;">
                                    {{ \Carbon\Carbon::parse($jobPostData->deadline)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection