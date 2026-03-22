@extends('frontend.layouts.modern')

@push('title')
    {{ $pageTitle }}
@endpush

@section('content')
    <div class="pp-page">
        <!-- Hero -->
        <div class="pp-hero">
            <h1 class="pp-hero__title">{{ $pageTitle }}</h1>
        </div>

        <!-- Content -->
        <div class="pp-container pp-container--narrow">
            <div class="pp-cms">
                <div class="prose pp-prose">
                    {!! $description !!}
                </div>
            </div>
        </div>
    </div>
@endsection