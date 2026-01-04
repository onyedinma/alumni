@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="bg-white min-h-screen">
        <!-- Hero Image -->
        <div class="h-[50vh] min-h-[400px] w-full relative overflow-hidden">
            <img src="{{ getFileUrl($story->thumbnail) }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
                <div class="max-w-4xl mx-auto text-center">
                    <span
                        class="inline-block px-4 py-1 bg-white/20 backdrop-blur text-white text-xs font-bold uppercase tracking-wider rounded-full mb-6 border border-white/30">Alumni
                        Story</span>
                    <h1 class="text-4xl md:text-6xl font-serif font-extrabold text-white mb-4 leading-tight shadow-sm">
                        {{ $story->title }}
                    </h1>
                    <p class="text-gray-300 font-medium text-lg">
                        Published on {{ \Carbon\Carbon::parse($story->created_at)->format('F d, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <div
            class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-10 relative z-10 bg-white rounded-t-3xl md:rounded-3xl shadow-2xl">
            <div class="prose prose-lg prose-red max-w-none text-gray-700 leading-relaxed drop-cap">
                {!! $story->body !!}
            </div>

            <div class="mt-16 pt-10 border-t border-gray-100 text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Inspired by this story?</h3>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('all.stories') }}"
                        class="px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-full hover:bg-gray-200 transition-colors">
                        Read More Stories
                    </a>
                    <a href="{{ route('contact.us') }}"
                        class="px-8 py-3 bg-maroon-600 text-white font-bold rounded-full hover:bg-maroon-700 shadow-lg transition-colors">
                        Share Your Story
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .drop-cap:first-letter {
            font-size: 4rem;
            line-height: 1;
            float: left;
            margin-right: 0.5rem;
            color: #701c1c;
            /* maroon-900 */
            font-weight: 800;
        }
    </style>
@endpush