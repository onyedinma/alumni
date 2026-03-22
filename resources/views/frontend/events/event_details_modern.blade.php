@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-detail">
        <!-- Immersive Hero with Image -->
        <div class="pp-hero pp-hero--image" style="min-height:50vh;">
            <div class="pp-hero__bg">
                <img src="{{ getFileUrl($event->thumbnail) }}" alt="{{ $event->title }}">
            </div>
            <div class="pp-hero__content">
                <span class="pp-badge pp-badge--gold" style="margin-bottom:20px;">{{ __('Upcoming Event') }}</span>
                <h1 class="pp-hero__title">{{ $event->title }}</h1>
                <div class="pp-info" style="margin-top:16px;">
                    <span class="pp-info__item" style="color:var(--pp-gold-light);font-size:1rem;">
                        <i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}
                    </span>
                    <span class="pp-info__item" style="color:var(--pp-gold-light);font-size:1rem;">
                        <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}
                    </span>
                    <span class="pp-info__item" style="color:var(--pp-gold-light);font-size:1rem;">
                        <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="pp-detail__content">
            <div class="pp-detail__grid">
                <!-- Main Content -->
                <div class="pp-detail__main">
                    <h3 style="font-size:1.5rem;">{{ __('Event Details') }}</h3>
                    <div class="prose pp-prose">
                        {!! $event->description !!}
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="pp-detail__sidebar">
                    <p class="pp-detail__sidebar-title">{{ __('Ticket Price') }}</p>
                    <div class="pp-detail__sidebar-price">
                        @if($event->ticket_price > 0)
                            {{ $event->ticket_price }}
                        @else
                            {{ __('Free') }}
                        @endif
                    </div>

                    <button class="pp-btn pp-btn--maroon pp-btn--block" style="margin-bottom:12px;">
                        {{ __('Register Now') }}
                    </button>
                    <p
                        style="text-align:center;font-size:0.85rem;color:var(--pp-text-muted);font-family:'Inter',sans-serif;">
                        {{ __('Limited seats available') }}
                    </p>

                    <hr class="pp-detail__sidebar-divider">

                    <h4>{{ __('Event Organizer') }}</h4>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div
                            style="width:44px;height:44px;background:var(--pp-bg-elevated);border:1px solid var(--pp-border);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--pp-text-muted);">
                            <i class="fas fa-users"></i>
                        </div>
                        <span style="color:var(--pp-text-secondary);font-family:'Inter',sans-serif;font-size:0.9rem;">
                            {{ __('Alumni Association') }}
                        </span>
                    </div>

                    <hr class="pp-detail__sidebar-divider">

                    <h4>{{ __('Share This Event') }}</h4>
                    <a href="https://wa.me/?text={{ urlencode($event->title . ' - ' . url()->current()) }}" target="_blank"
                        class="pp-whatsapp-btn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        {{ __('Share on WhatsApp') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection