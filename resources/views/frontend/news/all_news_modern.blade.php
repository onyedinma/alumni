@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-page">
        <!-- Hero -->
        <div class="pp-hero">
            <h1 class="pp-hero__title">{{ __('News & Announcements') }}</h1>
            <p class="pp-hero__subtitle">{{ __('Stay up to date with the latest news from our alumni community.') }}</p>
        </div>

        <!-- News Grid -->
        <div class="pp-container">
            @if(count($allNews))
                <div class="pp-grid pp-grid--3">
                    @foreach($allNews as $news)
                        <div class="pp-card">
                            <div class="pp-card__image">
                                <a href="{{ route('news.view.details', $news->slug) }}">
                                    <img src="{{ getFileUrl($news->image) }}" alt="{{ $news->title }}" loading="lazy">
                                </a>
                                <div class="pp-card__image-overlay"></div>
                                <!-- Category Badge -->
                                <div style="position:absolute;top:16px;left:16px;z-index:2;">
                                    <span class="pp-badge pp-badge--gold">{{ $news->category->name }}</span>
                                </div>
                            </div>
                            <div class="pp-card__body" style="display:flex;flex-direction:column;flex-grow:1;">
                                <div class="pp-card__meta">
                                    <span><i class="far fa-calendar-alt"></i>
                                        {{ \Carbon\Carbon::parse($news->created_at)->format('M d, Y') }}</span>
                                    <span class="pp-card__meta-dot"></span>
                                    <span><i class="far fa-user"></i> {{ $news->author->name }}</span>
                                </div>
                                <h3 class="pp-card__title">
                                    <a href="{{ route('news.view.details', $news->slug) }}">{{ $news->title }}</a>
                                </h3>
                                <p class="pp-card__text" style="flex-grow:1;">{{ Str::limit(strip_tags($news->details), 120) }}</p>
                                <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--pp-border);">
                                    <a href="{{ route('news.view.details', $news->slug) }}" class="pp-link">
                                        {{ __('Read Full Article') }} <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px; display:flex; justify-content:center;">
                    {{ $allNews->links() }}
                </div>
            @else
                <div class="pp-empty">
                    <div class="pp-empty__icon"><i class="far fa-newspaper"></i></div>
                    <h3 class="pp-empty__title">{{ __('No News Available') }}</h3>
                    <p class="pp-empty__text">{{ __('Currently, there are no news articles to display.') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection