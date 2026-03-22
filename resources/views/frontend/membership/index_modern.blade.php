@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-page">
        <!-- Hero -->
        <div class="pp-hero">
            <h1 class="pp-hero__title">{{ __('Membership Plans') }}</h1>
            <p class="pp-hero__subtitle">{{ __('Choose the plan that suits you best and enjoy exclusive benefits.') }}</p>
        </div>

        <!-- Pricing Cards -->
        <div class="pp-container">
            <div class="pp-grid pp-grid--3">
                @foreach($all_membership as $plan)
                    <div class="pp-card pp-card--pricing">
                        @if($plan->badge)
                            <span class="pp-card__badge">{{ $plan->badge }}</span>
                        @endif

                        <h3 class="pp-card__title" style="text-align:center;">{{ $plan->title }}</h3>
                        <div class="pp-card__price">{{ $plan->price }}</div>
                        <div class="pp-card__duration">/{{ $plan->duration }}</div>

                        <p
                            style="color:var(--pp-text-secondary);font-size:0.95rem;margin-bottom:24px;font-family:'Inter',sans-serif;text-align:center;">
                            {{ $plan->description }}
                        </p>

                        <ul class="pp-card__features">
                            <li><i class="fas fa-check-circle"></i> <span>Community Access</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Event Discounts</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Exclusive Content</span></li>
                        </ul>

                        <a href="#" class="pp-btn pp-btn--gold pp-btn--block">
                            {{ __('Choose Plan') }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection