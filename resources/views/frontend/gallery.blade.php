@extends('frontend.layouts.app')

@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .gallery-hero {
            background: #111827;
            padding: 48px 16px;
            text-align: center;
            border-bottom: 4px solid #eab308;
        }

        .gallery-hero__title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            margin: 0 0 8px;
        }

        .gallery-hero__subtitle {
            color: #9ca3af;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .gallery-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 16px 60px;
        }

        .gallery-layout {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        @media (min-width: 992px) {
            .gallery-layout {
                flex-direction: row;
            }
        }

        .gallery-sidebar {
            width: 100%;
            flex-shrink: 0;
        }

        @media (min-width: 992px) {
            .gallery-sidebar {
                width: 240px;
            }
        }

        .gallery-filter {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 24px;
            position: sticky;
            top: 100px;
        }

        .gallery-filter__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e5e7eb;
        }

        .gallery-filter__list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .gallery-filter__item {
            margin-bottom: 8px;
        }

        .gallery-filter__link {
            display: block;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .gallery-filter__link:hover {
            background: #f3f4f6;
            color: #7f1d1d;
        }

        .gallery-filter__link--active {
            background: #7f1d1d;
            color: #fff;
            box-shadow: 0 2px 6px rgba(127, 29, 29, 0.3);
        }

        .gallery-filter__link--active:hover {
            background: #991b1b;
            color: #fff;
        }

        .gallery-grid {
            flex: 1;
        }

        .gallery-photos {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 24px;
        }

        @media (min-width: 576px) {
            .gallery-photos {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 992px) {
            .gallery-photos {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .gallery-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .gallery-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }

        .gallery-card__image {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: #e5e7eb;
        }

        .gallery-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-card:hover .gallery-card__image img {
            transform: scale(1.1);
        }

        .gallery-card__overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .gallery-card:hover .gallery-card__overlay {
            background: rgba(0, 0, 0, 0.3);
        }

        .gallery-card__overlay i {
            font-size: 24px;
            color: #fff;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .gallery-card:hover .gallery-card__overlay i {
            opacity: 1;
            transform: scale(1);
        }

        .gallery-card__decade {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #eab308;
            color: #7f1d1d;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .gallery-card__caption {
            padding: 16px;
            border-top: 1px solid #f3f4f6;
        }

        .gallery-card__caption p {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 500;
            color: #1f2937;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .gallery-empty {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 48px;
            text-align: center;
        }

        .gallery-empty__icon {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .gallery-empty__title {
            font-size: 1.25rem;
            font-weight: 500;
            color: #111827;
            margin: 0 0 8px;
        }

        .gallery-empty__text {
            color: #6b7280;
            margin: 0 0 16px;
        }

        .gallery-empty__link {
            color: #7f1d1d;
            font-weight: 500;
            text-decoration: none;
        }

        .gallery-empty__link:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="gallery-hero">
        <h1 class="gallery-hero__title">{{ __('Photo Archive') }}</h1>
        <p class="gallery-hero__subtitle">{{ __('Relive the memories') }}</p>
    </div>

    <div class="gallery-container">
        <div class="gallery-layout">
            <!-- Sidebar -->
            <div class="gallery-sidebar">
                <div class="gallery-filter">
                    <h3 class="gallery-filter__title">{{ __('Filter by Decade') }}</h3>
                    <ul class="gallery-filter__list">
                        <li class="gallery-filter__item">
                            <a href="{{ route('gallery') }}"
                                class="gallery-filter__link {{ !$currentDecade ? 'gallery-filter__link--active' : '' }}">
                                {{ __('All Memories') }}
                            </a>
                        </li>
                        @foreach($decades as $decade)
                            <li class="gallery-filter__item">
                                <a href="{{ route('gallery', ['decade' => $decade]) }}"
                                    class="gallery-filter__link {{ $currentDecade == $decade ? 'gallery-filter__link--active' : '' }}">
                                    {{ $decade }}s
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                @if($photoGalleries->count() > 0)
                    <div class="gallery-photos">
                        @foreach($photoGalleries as $photo)
                            <div class="gallery-card">
                                <div class="gallery-card__image">
                                    <a href="{{ getFileUrl($photo->photo) }}" class="glightbox" data-gallery="gallery">
                                        <img src="{{ getFileUrl($photo->photo) }}" alt="{{ $photo->caption }}">
                                        <div class="gallery-card__overlay">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                        @if($photo->decade)
                                            <span class="gallery-card__decade">{{ $photo->decade }}s</span>
                                        @endif
                                    </a>
                                </div>
                                <div class="gallery-card__caption">
                                    <p>{{ $photo->caption }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="gallery-empty">
                        <div class="gallery-empty__icon">
                            <i class="far fa-images"></i>
                        </div>
                        <h3 class="gallery-empty__title">{{ __('No photos found') }}</h3>
                        <p class="gallery-empty__text">{{ __('Try selecting a different decade or check back later.') }}</p>
                        @if($currentDecade)
                            <a href="{{ route('gallery') }}" class="gallery-empty__link">
                                {{ __('View all photos') }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection