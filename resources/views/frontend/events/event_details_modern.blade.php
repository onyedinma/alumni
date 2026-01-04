@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen pb-20">
        <!-- Immersive Header -->
        <div class="relative h-[50vh] min-h-[400px] w-full overflow-hidden">
            <img src="{{ getFileUrl($event->thumbnail) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
                <div class="max-w-7xl mx-auto">
                    <span
                        class="inline-block px-4 py-1 bg-gold-500 text-secondary text-xs font-bold uppercase tracking-wider rounded-sm mb-6">Upcoming
                        Event</span>
                    <h1
                        class="text-4xl md:text-6xl font-serif font-extrabold text-white mb-6 leading-tight max-w-4xl shadow-sm">
                        {{ $event->title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-6 text-gold-100 text-lg font-medium font-sans">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur flex items-center justify-center">
                                <i class="far fa-calendar text-white"></i>
                            </div>
                            <span>{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur flex items-center justify-center">
                                <i class="far fa-clock text-white"></i>
                            </div>
                            <span>{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <span>{{ $event->location }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Event Details</h3>
                        <div class="prose prose-lg prose-indigo max-w-none text-gray-600">
                            {!! $event->description !!}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Registration Card -->
                    <div class="bg-white rounded-sm shadow-xl p-8 border-t-4 border-gold-500 sticky top-24">
                        <div class="text-center mb-8">
                            <p class="text-sm text-gray-500 uppercase tracking-widest font-bold mb-2 font-sans">Ticket Price
                            </p>
                            <h2 class="text-5xl font-serif font-extrabold text-gray-900">
                                @if($event->ticket_price > 0)
                                    {{ $event->ticket_price }}
                                @else
                                    Free
                                @endif
                            </h2>
                        </div>

                        <button
                            class="w-full py-4 bg-maroon-700 hover:bg-maroon-800 text-white text-lg font-bold rounded-sm shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 mb-4 font-serif">
                            Register Now
                        </button>
                        <p class="text-center text-sm text-gray-400">Limited seats available</p>

                        <div class="mt-8 pt-8 border-t border-gray-100">
                            <h4 class="font-bold text-gray-900 mb-4">Event Organizer</h4>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ getOption('app_name') }}</p>
                                    <p class="text-sm text-gray-500">Alumni Association</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection