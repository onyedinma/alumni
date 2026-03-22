@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-page">
        <!-- Hero -->
        <div class="pp-hero">
            <h1 class="pp-hero__title">{{ __('Notice Board') }}</h1>
            <p class="pp-hero__subtitle">{{ __('Official updates and administrative announcements.') }}</p>
        </div>

        <!-- Notices -->
        <div class="pp-container pp-container--narrow">
            @if(count($allNotice))
                <div class="pp-stack">
                    @foreach($allNotice as $notice)
                        <div class="pp-card pp-card--notice" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                            <!-- Date Chip -->
                            <div class="pp-card__date-chip">
                                <div class="day">{{ \Carbon\Carbon::parse($notice->created_at)->format('d') }}</div>
                                <div class="month">{{ \Carbon\Carbon::parse($notice->created_at)->format('M') }}</div>
                            </div>

                            <!-- Content -->
                            <div style="flex-grow:1;">
                                <h3 class="pp-card__title" style="margin-bottom:8px;">
                                    <a href="{{ route('notice.view.details', $notice->slug) }}">{{ $notice->title }}</a>
                                </h3>
                                <p class="pp-card__text" style="-webkit-line-clamp:2;margin-bottom:12px;">
                                    {{ Str::limit(strip_tags($notice->details), 150) }}
                                </p>
                                <a href="{{ route('notice.view.details', $notice->slug) }}" class="pp-link">
                                    {{ __('View Notice') }} <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px; display:flex; justify-content:center;">
                    {{ $allNotice->links() }}
                </div>
            @else
                <div class="pp-empty">
                    <div class="pp-empty__icon"><i class="fas fa-bullhorn"></i></div>
                    <h3 class="pp-empty__title">{{ __('No Notices') }}</h3>
                    <p class="pp-empty__text">{{ __('There are no notices to display at this time.') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection