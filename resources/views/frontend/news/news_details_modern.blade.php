@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="bg-white min-h-screen pb-20">
        <!-- Header Image -->
        <div class="h-[40vh] min-h-[300px] w-full relative overflow-hidden">
            <img src="{{ getFileUrl($news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 relative z-10">
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12">
                <div class="flex items-center gap-3 mb-6">
                    <span
                        class="px-3 py-1 bg-gold-100 text-maroon-800 text-xs font-bold rounded-sm uppercase tracking-wider font-sans">
                        {{ $news->category->name }}
                    </span>
                    <span class="text-gray-500 text-sm font-medium font-sans">
                        {{ \Carbon\Carbon::parse($news->created_at)->format('F d, Y') }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-serif font-extrabold text-gray-900 mb-8 leading-tight">
                    {{ $news->title }}
                </h1>

                <div class="flex items-center gap-4 mb-10 pb-8 border-b border-gray-100">
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white shadow-sm">
                        <img src="{{ getFileUrl($news->author->image) }}" alt="{{ $news->author->name }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-gray-900 font-bold leading-none mb-1">{{ $news->author->name }}</p>
                        <p class="text-gray-500 text-xs uppercase tracking-wide">Author</p>
                    </div>
                </div>

                <div class="prose prose-lg prose-red max-w-none text-gray-700 leading-relaxed">
                    {!! $news->details !!}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between items-center">
                    <a href="{{ route('our.news') }}"
                        class="font-bold text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Back to News
                    </a>

                    <div class="flex gap-4">
                        <span class="text-gray-400 font-medium">Share:</span>
                        <a href="#" class="text-gray-400 hover:text-blue-600"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-700"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection