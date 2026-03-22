@extends('frontend.layouts.app')

@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .si-hero {
            background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 50%, #7f1d1d 100%);
            padding: 80px 16px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .si-hero__crest {
            width: 128px;
            height: 128px;
            background: #fff;
            border-radius: 50%;
            padding: 8px;
            margin: 0 auto 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 4px solid #eab308;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .si-hero__crest:hover {
            transform: scale(1.05);
        }

        .si-hero__crest img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .si-hero__crest i {
            font-size: 48px;
            color: #7f1d1d;
        }

        .si-hero__title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 16px;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        .si-hero__motto {
            color: #eab308;
            font-size: 1.1rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .si-container {
            max-width: 1200px;
            margin: -40px auto 60px;
            padding: 0 16px;
            position: relative;
            z-index: 10;
        }

        .si-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        @media (min-width: 992px) {
            .si-grid {
                grid-template-columns: 1fr 1fr;
            }

            .si-grid--full {
                grid-column: span 2;
            }
        }

        .si-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .si-card__header {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .si-card__header--maroon {
            background: #7f1d1d;
        }

        .si-card__header--dark {
            background: #1f2937;
        }

        .si-card__header--gold {
            background: #eab308;
        }

        .si-card__header i {
            font-size: 20px;
        }

        .si-card__header--maroon i,
        .si-card__header--dark i {
            color: #eab308;
        }

        .si-card__header--gold i {
            color: #7f1d1d;
        }

        .si-card__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .si-card__header--maroon .si-card__title,
        .si-card__header--dark .si-card__title {
            color: #fff;
        }

        .si-card__header--gold .si-card__title {
            color: #7f1d1d;
        }

        .si-card__body {
            padding: 32px;
        }

        .si-card__body--history {
            font-size: 1rem;
            line-height: 1.8;
            color: #4b5563;
        }

        .si-card__body--anthem {
            font-style: italic;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            line-height: 2;
            color: #374151;
            text-align: center;
            white-space: pre-line;
        }

        .si-card__body--values {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }

        .si-values__icon {
            width: 80px;
            height: 80px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .si-values__icon i {
            font-size: 32px;
            color: #991b1b;
        }

        .si-values__quote {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .si-values__text {
            color: #6b7280;
        }

        /* Timeline Styles */
        .si-timeline {
            padding: 60px 0;
            position: relative;
        }

        .si-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background: #e5e7eb;
            transform: translateX(-50%);
        }

        .si-timeline__item {
            margin-bottom: 48px;
            position: relative;
        }

        .si-timeline__content {
            width: calc(50% - 40px);
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #7f1d1d;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            position: relative;
        }

        .si-timeline__date {
            font-weight: 700;
            color: #7f1d1d;
            margin-bottom: 8px;
            display: block;
        }

        .si-timeline__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            margin: 0 0 8px;
            color: #111827;
        }

        .si-timeline__desc {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        .si-timeline__dot {
            position: absolute;
            left: 50%;
            top: 24px;
            width: 20px;
            height: 20px;
            background: #eab308;
            border: 4px solid #fff;
            border-radius: 50%;
            box-shadow: 0 0 0 2px #eab308;
            transform: translateX(-50%);
            z-index: 2;
        }

        .si-timeline__item:nth-child(odd) .si-timeline__content {
            margin-left: auto;
            border-left: none;
            border-right: 4px solid #7f1d1d;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            border-left: 1px solid #e5e7eb;
        }

        .si-timeline__item:nth-child(even) .si-timeline__content {
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .si-timeline::before {
                left: 16px;
            }

            .si-timeline__content {
                width: calc(100% - 48px);
                margin-left: 48px !important;
                border-left: 4px solid #7f1d1d !important;
                border-right: 1px solid #e5e7eb !important;
            }

            .si-timeline__dot {
                left: 16px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="si-hero">
        <div class="si-hero__crest">
            @if(getOption('school_crest'))
                <img src="{{ getFileUrl(getOption('school_crest')) }}" alt="School Crest">
            @else
                <i class="fas fa-university"></i>
            @endif
        </div>
        <h1 class="si-hero__title">{{ __('School Identity') }}</h1>
        <p class="si-hero__motto">{{ getOption('school_motto', __('Knowledge is Power')) }}</p>
    </div>

    <div class="si-container">
        <div class="si-grid">
            <!-- History -->
            <div class="si-card si-grid--full">
                <div class="si-card__header si-card__header--maroon">
                    <i class="fas fa-history"></i>
                    <h2 class="si-card__title">{{ __('History & Background') }}</h2>
                </div>
                <div class="si-card__body si-card__body--history">
                    {!! nl2br(e(getOption('school_history', __('Our school has a rich history of excellence...')))) !!}
                </div>
            </div>

            <!-- Anthem -->
            <div class="si-card">
                <div class="si-card__header si-card__header--dark">
                    <i class="fas fa-music"></i>
                    <h2 class="si-card__title">{{ __('School Anthem') }}</h2>
                </div>
                <div class="si-card__body si-card__body--anthem">
                    {{ getOption('school_anthem', __('Arise O Compatriots...')) }}
                </div>
            </div>

            <!-- Core Values -->
            <div class="si-card">
                <div class="si-card__header si-card__header--gold">
                    <i class="fas fa-star"></i>
                    <h2 class="si-card__title">{{ __('Our Core Values') }}</h2>
                </div>
                <div class="si-card__body si-card__body--values">
                    <div class="si-values__icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <blockquote class="si-values__quote">
                        "{{ getOption('school_motto', __('Knowledge is Power')) }}"
                    </blockquote>
                    <p class="si-values__text">{{ __('The guiding principle of our institution') }}</p>
                </div>
            </div>

            <!-- Timeline -->
            <div class="si-grid--full">
                <div class="si-card">
                    <div class="si-card__header si-card__header--dark">
                        <i class="fas fa-stream"></i>
                        <h2 class="si-card__title">{{ __('School Milestones') }}</h2>
                    </div>
                    <div class="si-card__body">
                        <div class="si-timeline">
                            <!-- Milestone 1 -->
                            <div class="si-timeline__item">
                                <div class="si-timeline__dot"></div>
                                <div class="si-timeline__content">
                                    <span class="si-timeline__date">1990</span>
                                    <h3 class="si-timeline__title">Established</h3>
                                    <p class="si-timeline__desc">The school was founded with a vision to provide excellence
                                        in education.</p>
                                </div>
                            </div>
                            <!-- Milestone 2 -->
                            <div class="si-timeline__item">
                                <div class="si-timeline__dot"></div>
                                <div class="si-timeline__content">
                                    <span class="si-timeline__date">2000</span>
                                    <h3 class="si-timeline__title">First Graduating Set</h3>
                                    <p class="si-timeline__desc">A decade of resilience culminated in the celebration of our
                                        pioneer set's graduation.</p>
                                </div>
                            </div>
                            <!-- Milestone 3 -->
                            <div class="si-timeline__item">
                                <div class="si-timeline__dot"></div>
                                <div class="si-timeline__content">
                                    <span class="si-timeline__date">2010</span>
                                    <h3 class="si-timeline__title">New Campus</h3>
                                    <p class="si-timeline__desc">Relocated to the permanent site, featuring state-of-the-art
                                        facilities and laboratories.</p>
                                </div>
                            </div>
                            <!-- Milestone 4 -->
                            <div class="si-timeline__item">
                                <div class="si-timeline__dot"></div>
                                <div class="si-timeline__content">
                                    <span class="si-timeline__date">2020</span>
                                    <h3 class="si-timeline__title">Silver Jubilee</h3>
                                    <p class="si-timeline__desc">Celebrating 30 years of academic excellence and molding
                                        future leaders.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection