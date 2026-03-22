@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-page">
        <!-- Hero -->
        <div class="pp-hero">
            <h1 class="pp-hero__title">{{ __('Events & Reunions') }}</h1>
            <p class="pp-hero__subtitle">{{ __('Join us for upcoming gatherings, workshops, and celebrations.') }}</p>
        </div>

        <!-- Events List -->
        <div class="pp-container">
            @if(count($allEvent))
                <div class="pp-grid pp-grid--2">
                    @foreach($allEvent as $event)
                        <div class="pp-card pp-card--horizontal">
                            <div class="pp-card__image">
                                <img src="{{ getFileUrl($event->thumbnail) }}" alt="{{ $event->title }}" loading="lazy">
                                <div class="pp-card__image-overlay"></div>
                                <!-- Date badge -->
                                <div style="position:absolute;top:16px;left:16px;z-index:2;">
                                    <div class="pp-date-badge">
                                        <div class="pp-date-badge__day">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                        <div class="pp-date-badge__month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pp-card__body">
                                <div class="pp-card__meta">
                                    <span><i class="far fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                                    <span class="pp-card__meta-dot"></span>
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                                </div>
                                <h3 class="pp-card__title">
                                    <a href="{{ route('event.view.details', $event->slug) }}">{{ $event->title }}</a>
                                </h3>
                                <p class="pp-card__text">{{ Str::limit(strip_tags($event->description), 100) }}</p>
                                <div style="margin-top:20px;">
                                    <a href="{{ route('event.view.details', $event->slug) }}" class="pp-link">
                                        {{ __('Event Details') }} <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px; display:flex; justify-content:center;">
                    {{ $allEvent->links() }}
                </div>
            @else
                <div class="pp-empty">
                    <div class="pp-empty__icon"><i class="far fa-calendar-times"></i></div>
                    <h3 class="pp-empty__title">{{ __('No Events Scheduled') }}</h3>
                    <p class="pp-empty__text">{{ __('There are no upcoming events at the moment.') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection