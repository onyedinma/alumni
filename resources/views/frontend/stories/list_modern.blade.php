@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="relative bg-maroon-900 py-24 px-4 sm:px-6 lg:px-8 overflow-hidden text-center">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-maroon-900 opacity-90 mix-blend-multiply"></div>
            <!-- Decorative map or texture -->
            <img src="{{ asset('frontend/images/world-map.png') }}"
                class="absolute inset-0 w-full h-full object-contain opacity-10" alt="">
        </div>
        <div class="relative max-w-7xl mx-auto">
            <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl mb-4">
                {{ __('Community Stories') }}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gold-100 font-sans">
                {{ __('Inspiring journeys and achievements from alumni around the globe.') }}
            </p>
        </div>
    </div>

    <!-- Stories Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($stories))
            <div class="grid gap-10 md:grid-cols-2">
                @foreach($stories as $story)
                    <div
                        class="bg-white rounded-sm shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col md:flex-row h-full md:h-72 hover:border-gold-300">
                        <div class="md:w-2/5 relative overflow-hidden h-60 md:h-full">
                            <img src="{{ getFileUrl($story->thumbnail) }}" alt="{{ $story->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="p-8 md:w-3/5 flex flex-col">
                            <div class="flex items-center gap-2 text-sm text-gold-600 font-bold mb-3 font-sans">
                                <i class="far fa-calendar-check"></i>
                                {{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}
                            </div>
                            <h3
                                class="text-2xl font-serif font-bold text-gray-900 mb-3 leading-tight group-hover:text-maroon-700 transition-colors">
                                <a href="{{ route('story.view', $story->slug) }}">
                                    {{ $story->title }}
                                </a>
                            </h3>
                            <p class="text-gray-500 mb-6 flex-grow line-clamp-3 font-sans">
                                {{ Str::limit(strip_tags($story->body), 100) }}
                            </p>
                            <a href="{{ route('story.view', $story->slug) }}"
                                class="inline-flex items-center font-bold text-maroon-700 hover:text-maroon-900 transition-colors font-serif">
                                Read Story <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 flex justify-center">
                {{ $stories->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-3xl">
                <div
                    class="w-20 h-20 bg-teal-100 text-teal-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ __('No Stories Yet') }}</h3>
                <p class="text-gray-500 mt-2">{{ __('Be the first to share your journey with the community.') }}</p>
            </div>
        @endif
    </div>
@endsection