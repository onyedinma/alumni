@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .pp-drop-cap .prose:first-letter,
        .pp-drop-cap .pp-prose:first-letter {
            font-size: 4rem;
            line-height: 1;
            float: left;
            margin-right: 0.5rem;
            color: var(--pp-gold);
            font-weight: 800;
            font-family: 'Playfair Display', serif;
        }
    </style>
@endpush

@section('content')
    <div class="pp-detail">
        <!-- Hero with Image -->
        <div class="pp-hero pp-hero--image" style="min-height:50vh;">
            <div class="pp-hero__bg">
                <img src="{{ getFileUrl($story->thumbnail) }}" alt="{{ $story->title }}">
            </div>
            <div class="pp-hero__content" style="text-align:center;max-width:900px;">
                <span class="pp-badge pp-badge--glass" style="margin-bottom:16px;">{{ __('Alumni Story') }}</span>
                <h1 class="pp-hero__title" style="text-align:center;">{{ $story->title }}</h1>
                <p style="color:var(--pp-text-muted);margin-top:12px;font-family:'Inter',sans-serif;">
                    {{ __('Published on') }} {{ \Carbon\Carbon::parse($story->created_at)->format('F d, Y') }}
                </p>
            </div>
        </div>

        <!-- Content -->
        <div style="max-width:900px;margin:0 auto;padding:40px 24px;">
            <div class="pp-detail__main pp-drop-cap">
                <div class="prose pp-prose">
                    {!! $story->body !!}
                </div>

                <!-- CTA Section -->
                <div style="margin-top:48px;padding-top:32px;border-top:1px solid var(--pp-border);text-align:center;">
                    <h3
                        style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;color:var(--pp-text-primary);margin-bottom:20px;">
                        {{ __('Inspired by this story?') }}
                    </h3>
                    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:16px;">
                        <a href="{{ route('all.stories') }}" class="pp-btn pp-btn--outline">
                            {{ __('Read More Stories') }}
                        </a>
                        <a href="{{ route('contact.us') }}" class="pp-btn pp-btn--maroon">
                            {{ __('Share Your Story') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection