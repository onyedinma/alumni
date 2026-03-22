@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-detail">
        <!-- Hero with Image -->
        <div class="pp-hero pp-hero--image" style="min-height:40vh;">
            <div class="pp-hero__bg">
                <img src="{{ getFileUrl($news->image) }}" alt="{{ $news->title }}">
            </div>
            <div class="pp-hero__content" style="text-align:center;max-width:900px;">
                <span class="pp-badge pp-badge--gold" style="margin-bottom:16px;">{{ $news->category->name }}</span>
                <h1 class="pp-hero__title" style="text-align:center;">{{ $news->title }}</h1>
                <p style="color:var(--pp-text-muted);margin-top:12px;font-family:'Inter',sans-serif;">
                    {{ \Carbon\Carbon::parse($news->created_at)->format('F d, Y') }}
                </p>
            </div>
        </div>

        <!-- Content -->
        <div style="max-width:900px;margin:0 auto;padding:40px 24px;">
            <div class="pp-detail__main">
                <!-- Author -->
                <div
                    style="display:flex;align-items:center;gap:14px;padding-bottom:24px;margin-bottom:24px;border-bottom:1px solid var(--pp-border);">
                    <div
                        style="width:48px;height:48px;border-radius:50%;overflow:hidden;border:2px solid var(--pp-gold);flex-shrink:0;">
                        <img src="{{ getFileUrl($news->author->image) }}" alt="{{ $news->author->name }}"
                            style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div>
                        <p
                            style="color:var(--pp-text-primary);font-weight:700;font-family:'Inter',sans-serif;margin-bottom:2px;">
                            {{ $news->author->name }}</p>
                        <p
                            style="color:var(--pp-text-muted);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;font-family:'Inter',sans-serif;">
                            {{ __('Author') }}</p>
                    </div>
                </div>

                <!-- Article Body -->
                <div class="prose pp-prose">
                    {!! $news->details !!}
                </div>

                <!-- Footer: Back + Share -->
                <div
                    style="margin-top:48px;padding-top:24px;border-top:1px solid var(--pp-border);display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;gap:16px;">
                    <a href="{{ route('our.news') }}" class="pp-link" style="color:var(--pp-text-muted);">
                        <i class="fas fa-arrow-left"></i> {{ __('Back to News') }}
                    </a>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span
                            style="color:var(--pp-text-muted);font-size:0.9rem;font-family:'Inter',sans-serif;">{{ __('Share') }}:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank" style="color:var(--pp-text-muted);transition:color 0.3s;"
                            onmouseover="this.style.color='#1877F2'" onmouseout="this.style.color='var(--pp-text-muted)'">
                            <i class="fab fa-facebook" style="font-size:1.2rem;"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}"
                            target="_blank" style="color:var(--pp-text-muted);transition:color 0.3s;"
                            onmouseover="this.style.color='#1DA1F2'" onmouseout="this.style.color='var(--pp-text-muted)'">
                            <i class="fab fa-twitter" style="font-size:1.2rem;"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}"
                            target="_blank" style="color:var(--pp-text-muted);transition:color 0.3s;"
                            onmouseover="this.style.color='#25D366'" onmouseout="this.style.color='var(--pp-text-muted)'">
                            <i class="fab fa-whatsapp" style="font-size:1.2rem;"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($news->title) }}"
                            target="_blank" style="color:var(--pp-text-muted);transition:color 0.3s;"
                            onmouseover="this.style.color='#0077B5'" onmouseout="this.style.color='var(--pp-text-muted)'">
                            <i class="fab fa-linkedin" style="font-size:1.2rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection