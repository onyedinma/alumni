@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="pp-page">
        <div style="padding:120px 24px 60px;max-width:900px;margin:0 auto;">
            <!-- Notice Card -->
            <div class="pp-detail__main">
                <!-- Header -->
                <div
                    style="display:flex;align-items:center;gap:16px;padding-bottom:24px;margin-bottom:24px;border-bottom:1px solid var(--pp-border);">
                    <div style="color:var(--pp-gold);font-size:2rem;">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div>
                        <h1
                            style="font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:700;color:var(--pp-text-primary);margin-bottom:4px;">
                            {{ $notice->title }}
                        </h1>
                        <p style="color:var(--pp-text-muted);font-size:0.85rem;font-family:'Inter',sans-serif;">
                            {{ __('Posted on') }} {{ \Carbon\Carbon::parse($notice->created_at)->format('F d, Y') }}
                        </p>
                    </div>
                </div>

                <!-- Content -->
                <div class="prose pp-prose">
                    {!! $notice->details !!}
                </div>

                <!-- Footer -->
                <div style="margin-top:40px;padding-top:20px;border-top:1px solid var(--pp-border);">
                    <a href="{{ route('our.notice') }}" class="pp-link" style="color:var(--pp-text-muted);">
                        <i class="fas fa-arrow-left"></i> {{ __('All Notices') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection