@extends('frontend.layouts.modern')

@push('title') {{ __('Home') }} @endpush

@section('content')

    <!-- Hero Section -->
    <div class="relative h-screen min-h-[700px] flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset(getFileUrl(getOption('banner_background_breadcrumb'))) }}" alt="Banner"
                class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-maroon-900/90 to-maroon-800/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center max-w-4xl px-6 animate-fade-in-up">
            <h1
                class="text-5xl md:text-7xl font-serif font-extrabold text-white mb-6 leading-tight tracking-tight drop-shadow-lg">
                {{ getOption('banner_title') }}
            </h1>
            <p class="text-xl md:text-2xl text-gold-50 mb-10 max-w-2xl mx-auto font-sans font-light leading-relaxed">
                {{ getOption('banner_description') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="group relative px-8 py-4 bg-white text-maroon-900 text-lg font-serif font-bold rounded-sm overflow-hidden shadow-2xl transition-all hover:shadow-gold-500/50 hover:scale-105 border border-white">
                        <div
                            class="absolute inset-0 w-full h-full bg-gold-50 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300">
                        </div>
                        <span class="relative flex items-center gap-2">
                            Go to Dashboard <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="group relative px-8 py-4 bg-gold-500 text-secondary text-lg font-serif font-bold rounded-sm overflow-hidden shadow-2xl transition-all hover:bg-gold-400 hover:shadow-gold-500/50 hover:scale-105">
                        <span class="relative flex items-center gap-2">
                            Join Community <i class="fas fa-user-plus"></i>
                        </span>
                    </a>
                    <a href="#about"
                        class="group px-8 py-4 bg-transparent border-2 border-white text-white text-lg font-serif font-bold rounded-sm shadow-lg transition-all hover:bg-white/10 hover:scale-105 backdrop-blur-sm">
                        Learn More
                    </a>
                @endauth
            </div>
        </div>

        <!-- Floating Stats Cards (Decorative) -->
        <div
            class="absolute bottom-10 left-10 md:left-20 glass-panel p-6 rounded-lg hidden md:block animate-float border-l-4 border-gold-500">
            <div class="text-4xl font-serif font-bold text-white">{{ $totalAlumni }}+</div>
            <div class="text-gold-200 text-sm font-sans uppercase tracking-wider">Active Alumni</div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-20 bg-ivory relative -mt-10 z-20 rounded-t-[3rem] shadow-[0_-20px_60px_-15px_rgba(0,0,0,0.1)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                <div
                    class="p-8 rounded-sm bg-white border border-gray-100 hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-16 h-16 mx-auto bg-maroon-50 text-maroon-600 rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-4xl font-serif font-extrabold text-secondary mb-2">{{ $totalAlumni }}</h3>
                    <p class="text-gray-500 font-medium font-sans">Alumni Members</p>
                </div>
                <div
                    class="p-8 rounded-sm bg-white border border-gray-100 hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-16 h-16 mx-auto bg-gold-50 text-gold-600 rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="text-4xl font-serif font-extrabold text-secondary mb-2">{{ $totalDepartments }}</h3>
                    <p class="text-gray-500 font-medium font-sans">Departments</p>
                </div>
                <div
                    class="p-8 rounded-sm bg-white border border-gray-100 hover:shadow-xl transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-16 h-16 mx-auto bg-gray-100 text-gray-600 rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="text-4xl font-serif font-extrabold text-secondary mb-2">{{ $totalSessions }}</h3>
                    <p class="text-gray-500 font-medium font-sans">Sessions</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    @if(count($upcomingEvents))
        <section class="py-24 bg-gold-50 relative overflow-hidden">
            <!-- Decorative Blob -->
            <div
                class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-gold-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex justify-between items-end mb-16">
                    <div>
                        <span class="text-maroon-600 font-bold tracking-wider uppercase text-sm mb-2 block font-sans">Mark Your
                            Calendars</span>
                        <h2 class="text-4xl md:text-5xl font-serif font-bold text-secondary">Upcoming Events</h2>
                    </div>
                    <a href="{{ route('all.event') }}"
                        class="hidden md:flex items-center gap-2 text-maroon-600 font-bold hover:text-maroon-800 transition-colors font-sans">
                        View All Events <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($upcomingEvents as $event)
                        <div
                            class="group bg-white rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 h-full flex flex-col border border-gray-100 hover:border-gold-300">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ getFileUrl($event->thumbnail) }}" alt="{{ $event->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div
                                    class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-sm text-center shadow-lg border-t-2 border-maroon-600">
                                    <span
                                        class="block text-2xl font-serif font-bold text-maroon-900 leading-none">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                    <span
                                        class="block text-xs font-bold text-gold-600 uppercase">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                </div>
                            </div>
                            <div class="p-8 flex-grow flex flex-col">
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4 font-sans">
                                    <span class="flex items-center gap-1"><i class="far fa-clock text-gold-500"></i>
                                        {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                                    <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-gold-500"></i>
                                        {{ $event->location }}</span>
                                </div>
                                <h3
                                    class="text-2xl font-serif font-bold text-secondary mb-4 group-hover:text-maroon-700 transition-colors">
                                    <a href="{{ route('event.view.details', $event->slug) }}">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                <div class="mt-auto pt-6 border-t border-gray-100 flex justify-between items-center">
                                    <span class="text-maroon-600 font-bold text-sm font-sans uppercase tracking-wide">Get
                                        Tickets</span>
                                    <a href="{{ route('event.view.details', $event->slug) }}"
                                        class="w-10 h-10 rounded-full bg-gold-50 text-maroon-600 flex items-center justify-center group-hover:bg-maroon-600 group-hover:text-white transition-all">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Stories Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <span class="text-maroon-600 font-bold tracking-wider uppercase text-sm mb-2 block font-sans">Community
                    Voices</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-secondary mb-6">Alumni Stories</h2>
                <p class="text-xl text-gray-500 max-w-2xl mx-auto font-sans">Inspiring journeys and achievements from our
                    global
                    community.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Featured Story (First item) -->
                @if(count($stories) > 0)
                    <div class="relative group rounded-md overflow-hidden shadow-2xl h-[600px]">
                        <img src="{{ getFileUrl($stories[0]->thumbnail) }}" alt="{{ $stories[0]->title }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-10 md:p-14">
                            <span
                                class="inline-block px-4 py-1 bg-gold-500 text-secondary text-xs font-bold tracking-wider uppercase rounded-sm mb-4">Featured</span>
                            <h3 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4 leading-tight">
                                <a href="{{ route('story.view', $stories[0]->slug) }}"
                                    class="hover:underline decoration-gold-500 decoration-4 underline-offset-4">
                                    {{ $stories[0]->title }}
                                </a>
                            </h3>
                            <div class="flex items-center gap-4 text-gray-300 font-sans">
                                <span>{{ \Carbon\Carbon::parse($stories[0]->created_at)->format('M d, Y') }}</span>
                                <div class="w-1 h-1 bg-gray-500 rounded-full"></div>
                                <a href="{{ route('story.view', $stories[0]->slug) }}"
                                    class="text-white font-bold flex items-center gap-2 group-hover:gap-4 transition-all">Read
                                    Story <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- List Stories -->
                <div class="space-y-8">
                    @foreach($stories as $key => $story)
                        @if($key > 0)
                            <div
                                class="flex flex-col md:flex-row gap-6 group border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                                <div class="w-full md:w-48 h-48 rounded-md overflow-hidden flex-shrink-0">
                                    <img src="{{ getFileUrl($story->thumbnail) }}" alt="{{ $story->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-grow py-2">
                                    <div class="flex items-center gap-2 text-sm text-maroon-600 font-bold mb-2 font-sans">
                                        <i class="far fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}
                                    </div>
                                    <h3
                                        class="text-xl font-serif font-bold text-secondary mb-3 group-hover:text-maroon-700 transition-colors">
                                        <a href="{{ route('story.view', $story->slug) }}">
                                            {{ $story->title }}
                                        </a>
                                    </h3>
                                    <a href="{{ route('story.view', $story->slug) }}"
                                        class="text-sm font-bold text-gray-600 border-b-2 border-transparent group-hover:border-gold-500 transition-all font-sans">Read
                                        full story</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24 bg-maroon-900 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-maroon-900 to-secondary opacity-90"></div>
            <!-- Abstract Decoration -->
            <svg class="absolute right-0 bottom-0 h-full w-1/2 text-gold-500/5 transform translate-x-1/3"
                fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-8">Ready to Reconnect?</h2>
            <p class="text-xl text-gold-100 mb-12 leading-relaxed font-sans">Join a vibrant community of {{ $totalAlumni }}
                alumni.
                Share your achievements, find mentorship, and stay connected with your alma mater.</p>

            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('register') }}"
                    class="px-10 py-5 bg-gold-500 text-secondary text-lg font-serif font-bold rounded-sm shadow-2xl hover:bg-gold-400 hover:scale-105 transition-all">
                    Become a Member
                </a>
                <a href="{{ route('contact_us') }}"
                    class="px-10 py-5 bg-transparent border-2 border-gold-300 text-white text-lg font-serif font-bold rounded-sm hover:bg-white/10 hover:border-white transition-all">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

@endsection

@push('style')
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
    </style>
@endpush