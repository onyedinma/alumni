@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-page">
        <!-- Hero -->
        <div class="pp-hero">
            <h1 class="pp-hero__title">{{ __('Career Opportunities') }}</h1>
            <p class="pp-hero__subtitle">{{ __('Find your next career move within our alumni network.') }}</p>
        </div>

        <!-- Jobs List -->
        <div class="pp-container">
            @if(count($allJob))
                <div class="pp-stack">
                    @foreach($allJob as $job)
                        <div class="pp-card" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                            <div class="pp-card__body" style="display:flex;flex-wrap:wrap;align-items:center;gap:24px;">
                                <!-- Company Logo -->
                                <div class="pp-job-logo">
                                    <img src="{{ getFileUrl($job->company_logo) }}" alt="{{ $job->title }}" loading="lazy">
                                </div>

                                <!-- Job Info -->
                                <div style="flex:1;min-width:250px;">
                                    <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:8px;">
                                        <h3 class="pp-card__title" style="margin-bottom:0;">
                                            <a href="{{ route('job.view.details', $job->slug) }}">{{ $job->title }}</a>
                                        </h3>
                                        @if($job->job_type)
                                            <span class="pp-badge pp-badge--glass">{{ $job->job_type }}</span>
                                        @endif
                                    </div>
                                    <p
                                        style="color:var(--pp-text-secondary);font-weight:500;margin-bottom:12px;font-family:'Inter',sans-serif;">
                                        {{ $job->company_name }}
                                    </p>
                                    <div class="pp-info">
                                        <span class="pp-info__item"><i class="fas fa-map-marker-alt"></i>
                                            {{ $job->location }}</span>
                                        <span class="pp-info__item"><i class="far fa-clock"></i> {{ __('Posted') }}
                                            {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span>
                                        <span class="pp-info__item"><i class="fas fa-money-bill-wave"></i> {{ $job->salary }}</span>
                                    </div>
                                </div>

                                <!-- Apply Button -->
                                <div style="flex-shrink:0;">
                                    <a href="{{ route('job.view.details', $job->slug) }}" class="pp-btn pp-btn--gold">
                                        {{ __('Apply Now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px; display:flex; justify-content:center;">
                    {{ $allJob->links() }}
                </div>
            @else
                <div class="pp-empty">
                    <div class="pp-empty__icon"><i class="fas fa-briefcase"></i></div>
                    <h3 class="pp-empty__title">{{ __('No Jobs Found') }}</h3>
                    <p class="pp-empty__text">{{ __('Check back later for new career opportunities.') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection