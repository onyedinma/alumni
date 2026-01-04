@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="relative bg-maroon-900 py-24 px-4 sm:px-6 lg:px-8 overflow-hidden text-center">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-maroon-900 opacity-90 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl mb-4">
                {{ __('News & Announcements') }}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gold-100 font-sans">
                {{ __('Stay up to date with the latest news from our alumni community.') }}
            </p>
        </div>
    </div>

    <!-- News Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($allNews))
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
                @foreach($allNews as $news)
                    <div
                        class="bg-white rounded-sm shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col group hover:border-gold-300">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ getFileUrl($news->image) }}" alt="{{ $news->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="inline-block px-3 py-1 bg-gold-500 text-secondary text-xs font-bold rounded-sm uppercase tracking-wider shadow-md font-sans">
                                    {{ $news->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center text-sm text-gray-400 mb-3 gap-3 font-sans">
                                <span class="flex items-center gap-1"><i class="far fa-calendar-alt text-gold-500"></i>
                                    {{ \Carbon\Carbon::parse($news->created_at)->format('M d, Y') }}</span>
                                <span>•</span>
                                <span class="flex items-center gap-1"><i class="far fa-user text-gold-500"></i>
                                    {{ $news->author->name }}</span>
                            </div>
                            <h3
                                class="text-xl font-serif font-bold text-gray-900 mb-3 leading-snug group-hover:text-maroon-700 transition-colors">
                                <a href="{{ route('news.view.details', $news->slug) }}">
                                    {{ $news->title }}
                                </a>
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3 font-sans">
                                {{ Str::limit(strip_tags($news->details), 120) }}
                            </p>
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <a href="{{ route('news.view.details', $news->slug) }}"
                                    class="text-maroon-700 font-bold hover:text-maroon-900 transition-colors text-sm flex items-center gap-2 font-serif">
                                    Read Full Article <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                {{ $allNews->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-3xl">
                <div
                    class="w-20 h-20 bg-blue-100 text-blue-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="far fa-newspaper"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ __('No News Available') }}</h3>
                <p class="text-gray-500 mt-2">{{ __('Currently, there are no news articles to display.') }}</p>
            </div>
        @endif
    </div>
@endsection