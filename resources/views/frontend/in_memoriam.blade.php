@extends('frontend.layouts.app')

@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .memoriam-hero {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            padding: 60px 16px;
            text-align: center;
            position: relative;
        }

        .memoriam-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("assets/images/candle-pattern.png") }}') center/cover;
            opacity: 0.05;
        }

        .memoriam-hero__icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .memoriam-hero__icon i {
            font-size: 36px;
            color: #fbbf24;
        }

        .memoriam-hero__title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 12px;
        }

        .memoriam-hero__subtitle {
            color: #9ca3af;
            font-size: 1rem;
            font-style: italic;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .memoriam-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 16px;
        }

        .memoriam-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 32px;
        }

        @media (min-width: 768px) {
            .memoriam-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .memoriam-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .memoriam-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .memoriam-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .memoriam-card__photo {
            height: 280px;
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .memoriam-card__photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(30%);
        }

        .memoriam-card__photo-placeholder {
            font-size: 80px;
            color: rgba(255, 255, 255, 0.3);
        }

        .memoriam-card__ribbon {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(0, 0, 0, 0.6);
            color: #fbbf24;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .memoriam-card__body {
            padding: 24px;
            text-align: center;
        }

        .memoriam-card__name {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 8px;
        }

        .memoriam-card__dates {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .memoriam-card__class {
            display: inline-block;
            background: #f3f4f6;
            color: #374151;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .memoriam-card__tribute {
            font-size: 0.9rem;
            color: #4b5563;
            font-style: italic;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .memoriam-empty {
            text-align: center;
            padding: 80px 16px;
            background: #f9fafb;
            border-radius: 16px;
        }

        .memoriam-empty__icon {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 24px;
        }

        .memoriam-empty__title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #374151;
            margin: 0 0 12px;
        }

        .memoriam-empty__text {
            color: #6b7280;
        }
    </style>
@endpush

@section('content')
    <div class="memoriam-hero">
        <div class="memoriam-hero__icon">
            <i class="fas fa-dove"></i>
        </div>
        <h1 class="memoriam-hero__title">{{ __('In Memoriam') }}</h1>
        <p class="memoriam-hero__subtitle mx-auto">
            {{ __('Honoring the memory of our departed alumni who touched our lives and left lasting legacies.') }}
        </p>
    </div>

    <div class="memoriam-container">
        @if($entries->count() > 0)
            <div class="memoriam-grid">
                @foreach($entries as $entry)
                    <div class="memoriam-card">
                        <div class="memoriam-card__photo">
                            @if($entry->photo)
                                <img src="{{ asset($entry->photo) }}" alt="{{ $entry->name }}">
                            @else
                                <i class="fas fa-user memoriam-card__photo-placeholder"></i>
                            @endif
                            @if($entry->graduation_year)
                                <span class="memoriam-card__ribbon">Class of {{ $entry->graduation_year }}</span>
                            @endif
                        </div>
                        <div class="memoriam-card__body">
                            <h3 class="memoriam-card__name">{{ $entry->name }}</h3>
                            <p class="memoriam-card__dates">
                                @if($entry->date_of_birth && $entry->date_of_passing)
                                    {{ $entry->date_of_birth->format('M j, Y') }} – {{ $entry->date_of_passing->format('M j, Y') }}
                                @elseif($entry->date_of_passing)
                                    Passed: {{ $entry->date_of_passing->format('F j, Y') }}
                                @endif
                            </p>
                            @if($entry->house || $entry->class_arm)
                                <span class="memoriam-card__class">
                                    {{ $entry->house }}{{ $entry->house && $entry->class_arm ? ' • ' : '' }}{{ $entry->class_arm }}
                                </span>
                            @endif
                            @if($entry->tribute)
                                <p class="memoriam-card__tribute">"{{ $entry->tribute }}"</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="memoriam-empty">
                <div class="memoriam-empty__icon">
                    <i class="fas fa-candle-holder"></i>
                </div>
                <h3 class="memoriam-empty__title">{{ __('No memorials yet') }}</h3>
                <p class="memoriam-empty__text">
                    {{ __('We remember all our departed alumni. Check back for tributes and memorials.') }}
                </p>
            </div>
        @endif
    </div>
@endsection