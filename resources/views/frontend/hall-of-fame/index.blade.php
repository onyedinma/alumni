@extends('frontend.layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .hof-section {
            background: linear-gradient(180deg, #FAF8F5 0%, #fff 100%);
            padding-bottom: 80px;
        }

        .hof-header {
            text-align: center;
            padding: 60px 0 40px;
        }

        .hof-badge {
            display: inline-block;
            padding: 8px 20px;
            background: rgba(212, 175, 90, 0.15);
            color: #B8934A;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-radius: 50px;
            margin-bottom: 20px;
        }

        .hof-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            color: #1A1A2E;
            margin-bottom: 15px;
        }

        .hof-subtitle {
            font-size: 18px;
            color: #6C757D;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        /* Featured Section */
        .featured-section {
            margin-bottom: 60px;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        @media (max-width: 991px) {
            .featured-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .featured-grid {
                grid-template-columns: 1fr;
            }
        }

        .featured-card {
            background: linear-gradient(135deg, #1A1A2E 0%, #0D0D0D 100%);
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .featured-card::before {
            content: '★';
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: #D4AF5A;
            z-index: 10;
        }

        .featured-photo {
            height: 280px;
            position: relative;
            overflow: hidden;
        }

        .featured-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-photo .placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.2), rgba(117, 21, 37, 0.2));
        }

        .featured-photo .placeholder i {
            font-size: 80px;
            color: #D4AF5A;
            opacity: 0.5;
        }

        .featured-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
        }

        .featured-category {
            display: inline-block;
            padding: 4px 12px;
            background: #D4AF5A;
            color: #1A1A2E;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .featured-name {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 5px;
        }

        .featured-achievement {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }

        .featured-meta {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 10px;
        }

        /* All Inductees Grid */
        .inductees-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        @media (max-width: 1200px) {
            .inductees-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 991px) {
            .inductees-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .inductees-grid {
                grid-template-columns: 1fr;
            }
        }

        .inductee-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .inductee-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .inductee-photo {
            height: 200px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.1), rgba(117, 21, 37, 0.1));
        }

        .inductee-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .inductee-card:hover .inductee-photo img {
            transform: scale(1.08);
        }

        .inductee-photo .placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inductee-photo .placeholder i {
            font-size: 60px;
            color: #D4AF5A;
            opacity: 0.3;
        }

        .inductee-content {
            padding: 20px;
        }

        .inductee-category {
            display: inline-block;
            padding: 4px 10px;
            background: rgba(212, 175, 90, 0.15);
            color: #B8934A;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .inductee-name {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #1A1A2E;
            margin-bottom: 8px;
        }

        .inductee-achievement {
            font-size: 14px;
            color: #6C757D;
            line-height: 1.5;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .inductee-meta {
            font-size: 12px;
            color: #9CA3AF;
        }

        .section-header {
            margin-bottom: 40px;
        }

        .section-header h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #1A1A2E;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #6C757D;
        }

        .empty-state i {
            font-size: 60px;
            color: #D4AF5A;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')

    <section class="breadcrumb-wrap py-50 py-md-75 py-lg-100" data-background="{{ getSettingImage('page_breadcrumb') }}">
        <div class="text-center position-relative">
            <h4 class="fs-50 fw-700 lh-60 text-white pb-8">{{ $title }}</h4>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                <li><a>{{ $title }}</a></li>
            </ul>
        </div>
    </section>

    <section class="hof-section">
        <div class="container">
            <div class="hof-header">
                <span class="hof-badge">🏆 {{ __('Distinguished Alumni') }}</span>
                <h1 class="hof-title">{{ __('Hall of Fame') }}</h1>
                <p class="hof-subtitle mx-auto">
                    {{ __('Celebrating the extraordinary achievements of our alumni who have made significant contributions in their fields.') }}
                </p>
            </div>

            @if($featuredEntries->count() > 0)
                <div class="featured-section">
                    <div class="section-header">
                        <h3>⭐ {{ __('Featured Inductees') }}</h3>
                    </div>
                    <div class="featured-grid">
                        @foreach($featuredEntries as $entry)
                            <div class="featured-card">
                                <div class="featured-photo">
                                    @if($entry->photo)
                                        <img src="{{ asset($entry->photo) }}" alt="{{ $entry->name }}">
                                    @else
                                        <div class="placeholder">
                                            <i class="bi bi-trophy"></i>
                                        </div>
                                    @endif
                                    <div class="featured-overlay">
                                        <span
                                            class="featured-category">{{ $categories[$entry->category] ?? $entry->category }}</span>
                                        <h3 class="featured-name">{{ $entry->name }}</h3>
                                        <p class="featured-achievement">{{ $entry->achievement_title }}</p>
                                        <div class="featured-meta">
                                            @if($entry->graduation_year)
                                                Set of {{ $entry->graduation_year }} •
                                            @endif
                                            Inducted {{ $entry->year_inducted }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($entries->count() > 0)
                <div class="section-header">
                    <h3>{{ __('All Inductees') }}</h3>
                </div>
                <div class="inductees-grid">
                    @foreach($entries as $entry)
                        <div class="inductee-card">
                            <div class="inductee-photo">
                                @if($entry->photo)
                                    <img src="{{ asset($entry->photo) }}" alt="{{ $entry->name }}">
                                @else
                                    <div class="placeholder">
                                        <i class="bi bi-trophy"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="inductee-content">
                                <span class="inductee-category">{{ $categories[$entry->category] ?? $entry->category }}</span>
                                <h4 class="inductee-name">{{ $entry->name }}</h4>
                                <p class="inductee-achievement">{{ $entry->achievement_title }}</p>
                                <div class="inductee-meta">
                                    @if($entry->graduation_year)
                                        Set of {{ $entry->graduation_year }} •
                                    @endif
                                    Inducted {{ $entry->year_inducted }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $entries->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-trophy"></i>
                    <h4>{{ __('No inductees yet') }}</h4>
                    <p>{{ __('Check back soon to see our distinguished alumni.') }}</p>
                </div>
            @endif
        </div>
    </section>

@endsection