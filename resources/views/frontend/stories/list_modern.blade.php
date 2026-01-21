@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <style>
        :root {
            --bg-primary: #0B0E11;
            --bg-surface: #12161C;
            --bg-elevated: #171C23;
            --gold: #D4AF5A;
            --gold-hover: #b8934a;
            --maroon: #8B2635;
            --text-primary: #E6EAF0;
            --text-secondary: #B4BCC8;
            --text-muted: #5E6675;
            --border-dark: #1F2630;
        }

        /* Page Container */
        .premium-stories-page {
            background-color: var(--bg-primary);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        /* Hero Section */
        .stories-hero {
            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-surface) 100%);
            position: relative;
            padding: 80px 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-dark);
            overflow: hidden;
        }

        .stories-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--maroon), var(--gold), var(--maroon));
        }

        .stories-hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 16px;
        }

        .stories-hero-text {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Card Grid */
        .stories-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }

        /* Individual Card */
        .story-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-dark);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }

        .story-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .story-image-wrap {
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .story-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .story-card:hover .story-image {
            transform: scale(1.05);
        }

        .story-content {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .story-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gold);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .story-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .story-title a {
            color: inherit;
            text-decoration: none;
        }

        .story-card:hover .story-title {
            color: var(--gold);
        }

        .story-excerpt {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 24px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gold);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: gap 0.3s ease;
        }

        .read-more-btn:hover {
            gap: 12px;
            color: var(--gold-hover);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: var(--text-secondary);
            background: var(--bg-surface);
            border-radius: 20px;
            border: 1px dashed var(--border-dark);
            margin: 0 auto;
            max-width: 600px;
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--gold);
            opacity: 0.3;
            margin-bottom: 24px;
        }

        /* Pagination */
        .story-pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }
    </style>

    <div class="premium-stories-page">
        <!-- Header -->
        <div class="stories-hero">
            <div class="stories-hero-title">{{ __('Community Stories') }}</div>
            <p class="stories-hero-text">
                {{ __('Inspiring journeys, achievements, and memories shared by alumni from around the globe.') }}
            </p>
        </div>

        <!-- Stories Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if(count($stories))
                <div class="stories-grid">
                    @foreach($stories as $story)
                        <div class="story-card group">
                            <div class="story-image-wrap">
                                <a href="{{ route('story.view', $story->slug) }}">
                                    <img src="{{ getFileUrl($story->thumbnail) }}" alt="{{ $story->title }}" class="story-image">
                                </a>
                            </div>
                            <div class="story-content">
                                <div class="story-meta">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}
                                </div>
                                <h3 class="story-title">
                                    <a href="{{ route('story.view', $story->slug) }}">
                                        {{ $story->title }}
                                    </a>
                                </h3>
                                <div class="story-excerpt">
                                    {{ Str::limit(strip_tags($story->body), 120) }}
                                </div>
                                <a href="{{ route('story.view', $story->slug) }}" class="read-more-btn">
                                    {{ __('Read Full Story') }} <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="story-pagination">
                    {{ $stories->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ __('No Stories Yet') }}</h3>
                    <p>{{ __('Be the first to share your journey with the community.') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection