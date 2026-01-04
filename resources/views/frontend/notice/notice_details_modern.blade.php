@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen py-16 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gold-50 px-8 py-6 border-b border-gold-100 flex items-center gap-4">
                <div class="text-maroon-600 text-3xl">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-serif font-bold text-gray-900 leading-tight">{{ $notice->title }}</h1>
                    <p class="text-sm text-gray-500 mt-1 font-sans">Posted on
                        {{ \Carbon\Carbon::parse($notice->created_at)->format('F d, Y') }}
                    </p>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="prose prose-red max-w-none text-gray-700">
                    {!! $notice->details !!}
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-between items-center">
                <a href="{{ route('our.notice') }}"
                    class="text-gray-500 font-bold hover:text-gray-900 transition-colors text-sm">
                    <i class="fas fa-arrow-left mr-2"></i> All Notices
                </a>
            </div>
        </div>
    </div>
@endsection