@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="relative bg-maroon-900 py-24 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset(getFileUrl(getOption('upcoming_events_background'))) }}" alt=""
                class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-br from-maroon-900 to-secondary opacity-90 mix-blend-multiply">
            </div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl mb-4">
                {{ __('Events & Reunions') }}
            </h1>
            <p class="max-w-2xl text-xl text-gold-100 font-sans">
                {{ __('Join us for upcoming gatherings, workshops, and celebrations.') }}
            </p>
        </div>
    </div>

    <!-- Events List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($allEvent))
            <div class="grid gap-8 lg:grid-cols-2">
                @foreach($allEvent as $event)
                    <div
                        class="bg-white rounded-sm shadow-lg overflow-hidden flex flex-col md:flex-row hover:shadow-2xl transition-all duration-300 group ring-1 ring-gray-100 border-l-4 border-transparent hover:border-gold-500">
                        <div class="md:w-2/5 relative overflow-hidden h-64 md:h-auto">
                            <img src="{{ getFileUrl($event->thumbnail) }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div
                                class="absolute top-4 left-4 bg-white/95 backdrop-blur rounded-sm px-4 py-2 text-center shadow-lg border border-gray-100">
                                <span
                                    class="block text-2xl font-serif font-black text-maroon-800 leading-none">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                <span
                                    class="block text-xs font-bold text-gray-500 uppercase">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            </div>
                        </div>
                        <div class="p-8 md:w-3/5 flex flex-col justify-center">
                            <div class="flex items-center gap-4 text-sm font-medium text-gold-600 mb-3 font-sans">
                                <span class="flex items-center gap-1.5"><i class="far fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span class="flex items-center gap-1.5"><i class="fas fa-map-marker-alt"></i>
                                    {{ $event->location }}</span>
                            </div>
                            <h3
                                class="text-2xl font-serif font-bold text-gray-900 mb-3 leading-tight group-hover:text-maroon-700 transition-colors">
                                <a href="{{ route('event.view.details', $event->slug) }}">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            <p class="text-gray-500 mb-6 line-clamp-2 leading-relaxed font-sans">
                                {{ Str::limit(strip_tags($event->description), 100) }}
                            </p>
                            <a href="{{ route('event.view.details', $event->slug) }}"
                                class="inline-flex items-center font-bold text-maroon-700 hover:text-maroon-900 transition-colors font-serif">
                                Event Details <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 flex justify-center">
                {{ $allEvent->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-3xl">
                <div
                    class="w-20 h-20 bg-indigo-100 text-indigo-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="far fa-calendar-times"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ __('No Events Scheduled') }}</h3>
                <p class="text-gray-500 mt-2">{{ __('There are no upcoming events at the moment.') }}</p>
            </div>
        @endif
    </div>
@endsection