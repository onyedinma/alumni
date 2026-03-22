@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-page">
        <!-- Hero -->
        <div class="pp-hero">
            <h1 class="pp-hero__title">{{ __('Our Alumni') }}</h1>
            <p class="pp-hero__subtitle">{{ __('Connect with fellow graduates and explore our growing community.') }}</p>
        </div>

        <!-- Alumni Grid -->
        <div class="pp-container">
            @if(count($allAlumni))
                <div class="pp-grid pp-grid--4">
                    @foreach ($allAlumni as $alumni)
                        <div class="pp-card pp-card--profile">
                            <div class="pp-card__image">
                                <img src="{{ getFileUrl($alumni->image) }}" alt="{{ $alumni->name }}" loading="lazy">
                            </div>
                            <div class="pp-card__body">
                                <h3 class="pp-card__title" style="font-size:1.15rem;">{{ $alumni->name }}</h3>
                                <p class="pp-card__subtitle">{{ $alumni->final_class_name ?? 'N/A' }}</p>
                                <p class="pp-card__detail">{{ $alumni->final_house_name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="margin-top:48px; display:flex; justify-content:center;">
                    {{ $allAlumni->links('frontend.pagination.modern') }}
                </div>
            @else
                <div class="pp-empty">
                    <div class="pp-empty__icon"><i class="fas fa-user-graduate"></i></div>
                    <h3 class="pp-empty__title">{{ __('No Alumni Found') }}</h3>
                    <p class="pp-empty__text">{{ __('We are building our community. Check back soon!') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection