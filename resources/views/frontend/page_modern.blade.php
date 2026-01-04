@extends('frontend.layouts.modern')

@push('title')
    {{ $pageTitle }}
@endpush

@section('content')
    <!-- Header -->
    <div class="bg-gold-50 py-16 px-4 sm:px-6 lg:px-8 text-center border-b border-gold-200">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-serif font-extrabold text-gray-900 sm:text-5xl mb-4">{{ $pageTitle }}</h1>
            <div class="w-24 h-1 bg-maroon-600 mx-auto rounded-full"></div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-sm shadow-lg p-8 md:p-12 border border-gray-100">
            <div class="prose prose-lg prose-red max-w-none text-gray-600 font-sans">
                {!! $description !!}
            </div>
        </div>
    </div>
@endsection