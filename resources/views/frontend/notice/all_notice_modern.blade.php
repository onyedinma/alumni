@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="bg-gray-100 py-16 px-4 sm:px-6 lg:px-8 text-center border-b border-gray-200">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-3">
                {{ __('Notice Board') }}
            </h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-600">
                {{ __('Official updates and administrative announcements.') }}
            </p>
        </div>
    </div>

    <!-- Notices List -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($allNotice))
            <div class="space-y-6">
                @foreach($allNotice as $notice)
                    <div
                        class="bg-white rounded-sm shadow-md border-l-4 border-gold-500 p-6 flex flex-col sm:flex-row gap-6 hover:shadow-lg transition-shadow">
                        <div class="flex-shrink-0 text-center sm:text-left">
                            <div class="bg-gold-50 text-maroon-700 font-serif font-bold rounded-sm px-4 py-2 inline-block">
                                <div class="text-2xl leading-none">{{ \Carbon\Carbon::parse($notice->created_at)->format('d') }}
                                </div>
                                <div class="text-xs uppercase font-sans">
                                    {{ \Carbon\Carbon::parse($notice->created_at)->format('M') }}</div>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">
                                <a href="{{ route('notice.view.details', $notice->slug) }}"
                                    class="hover:underline decoration-gold-400 decoration-2">
                                    {{ $notice->title }}
                                </a>
                            </h3>
                            <p class="text-gray-500 text-sm mb-3 font-sans">
                                {{ Str::limit(strip_tags($notice->details), 150) }}
                            </p>
                            <a href="{{ route('notice.view.details', $notice->slug) }}"
                                class="text-maroon-600 font-bold text-sm hover:text-maroon-800 font-serif">
                                View Notice
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $allNotice->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">{{ __('No notices found.') }}</p>
            </div>
        @endif
    </div>
@endsection