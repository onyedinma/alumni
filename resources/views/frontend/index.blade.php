@extends('frontend.layouts.app')
@push('title')
    {{ __('Home') }}
@endpush
@section('content')
    <style>
        :root {
            --home-primary: #751525;
            --home-secondary: #0B0E11;
            --home-gold: #D4AF5A;
            --home-text: #1F2630;
            --home-bg-light: #F9FAFB;
        }

        /* Typography */
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        /* Hero Section */
        .home-banner {
            position: relative;
            background-size: cover;
            background-position: center;
            padding: 180px 0 120px;
            overflow: hidden;
        }

        .home-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(11, 14, 17, 0.85) 0%, rgba(117, 21, 37, 0.75) 100%);
        }

        .home-banner .container {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            color: #ffffff;
            font-size: 64px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 24px;
            font-family: 'Playfair Display', serif;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.9);
            font-size: 20px;
            line-height: 1.6;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Buttons - Rectangular with Brand Colors */
        /* Colors: Gold (#D4AF5A), Maroon Red (#751525), Deep Ash (#3C3C3C), Dark (#0B0E11), White */
        .btn-home-primary {
            background-color: var(--home-gold);
            color: var(--home-secondary);
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            border: 2px solid var(--home-gold);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-home-primary:hover {
            background-color: var(--home-primary);
            border-color: var(--home-primary);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(117, 21, 37, 0.3);
        }

        .btn-home-secondary {
            background-color: var(--home-primary);
            color: #fff;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            border: 2px solid var(--home-primary);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-home-secondary:hover {
            background-color: var(--home-gold);
            border-color: var(--home-gold);
            color: var(--home-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .btn-home-outline {
            background-color: transparent;
            color: #fff;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-home-outline:hover {
            border-color: var(--home-gold);
            background-color: var(--home-gold);
            color: var(--home-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .btn-home-dark {
            background-color: var(--home-secondary);
            color: #fff;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            border: 2px solid var(--home-secondary);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-home-dark:hover {
            background-color: var(--home-gold);
            border-color: var(--home-gold);
            color: var(--home-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .btn-home-ash {
            background-color: #3C3C3C;
            color: #fff;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            border: 2px solid #3C3C3C;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-home-ash:hover {
            background-color: var(--home-gold);
            border-color: var(--home-gold);
            color: var(--home-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .btn-home-white {
            background-color: #fff;
            color: var(--home-secondary);
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            border: 2px solid #fff;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-home-white:hover {
            background-color: var(--home-gold);
            border-color: var(--home-gold);
            color: var(--home-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        /* Section Commons */
        .section-padding {
            padding: 100px 0;
        }

        .section-bg-light {
            background-color: var(--home-bg-light);
        }

        .section-bg-dark {
            background-color: var(--home-secondary);
            color: #fff;
        }

        .section-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: rgba(212, 175, 90, 0.15);
            color: var(--home-gold);
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
        }

        .section-title.dark-mode {
            color: #fff;
        }

        .section-desc {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 50px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-desc.dark-mode {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Why Join Us Cards */
        .feature-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.03);
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border-color: var(--home-gold);
        }

        .feature-icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(212, 175, 90, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon-wrapper {
            background: var(--home-gold);
        }

        .feature-icon-wrapper img {
            width: 40px;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon-wrapper img {
            filter: brightness(0) invert(1);
        }

        .feature-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--home-text);
        }

        /* Event Cards */
        .event-card-modern {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .event-card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .event-image {
            height: 220px;
            width: 100%;
            object-fit: cover;
        }

        .event-content {
            padding: 25px;
        }

        .event-date-badge {
            color: var(--home-gold);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
        }

        .event-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--home-text);
            font-family: 'Playfair Display', serif;
            display: block;
            text-decoration: none;
            transition: color 0.3s;
        }

        .event-title:hover {
            color: var(--home-primary);
        }

        .event-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .event-meta i {
            color: var(--home-gold);
        }

        /* Story Cards */
        .story-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .story-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .story-img-wrap {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .story-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .story-card:hover .story-img-wrap img {
            transform: scale(1.05);
        }

        .story-content {
            padding: 24px;
        }

        .read-more-link {
            color: var(--home-primary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: gap 0.3s;
        }

        .read-more-link:hover {
            gap: 12px;
            color: var(--home-gold);
        }

        /* Stat Counters */
        .stat-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 16px;
            text-align: center;
        }

        .stat-number {
            font-size: 42px;
            font-weight: 700;
            color: var(--home-gold);
            margin-bottom: 5px;
            font-family: 'Playfair Display', serif;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
        }
    </style>

    <!-- Start Banner -->
    <section class="home-banner d-flex align-items-center"
        data-background="{{ asset(getFileUrl(getOption('banner_background_breadcrumb'))) }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <span
                        class="section-badge bg-white-10 text-white border border-white-20 mb-4">{{ __('Welcome to the Community') }}</span>
                    <h1 class="hero-title">{{ getOption('banner_title') }}</h1>
                    <p class="hero-desc">{{ getOption('banner_description') }}</p>

                    <div class="d-flex justify-content-center flex-wrap gap-3 mt-5">
                        <a href="#about-us-section" class="btn-home-primary">
                            {{ __('About Us') }}
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('all.event') }}" class="btn-home-outline">
                            {{ __('All Events') }}
                            <i class="fa-solid fa-calendar-days"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner -->

    <!-- Start Why Join Us -->
    <section class="section-padding section-bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">{{ __('Community Benefits') }}</span>
                <h2 class="section-title">{{ __('Why you should join us') }}</h2>
                <p class="section-desc">
                    {{ __('Discover the advantages of being part of our extensive alumni network. Connect, grow, and give back.') }}
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <img src="{{ asset(getFileUrl(getOption('join_us_left_icon'))) }}" alt="" />
                        </div>
                        <h4 class="feature-title">{{ getOption('join_us_left_title') }}</h4>
                        <p class="text-muted">{!! getOption('join_us_left_description') !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <img src="{{ asset(getFileUrl(getOption('join_us_middle_icon'))) }}" alt="" />
                        </div>
                        <h4 class="feature-title">{{ getOption('join_us_middle_title') }}</h4>
                        <p class="text-muted">{!! getOption('join_us_middle_description') !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <img src="{{ asset(getFileUrl(getOption('join_us_right_icon'))) }}" alt="" />
                        </div>
                        <h4 class="feature-title">{{ getOption('join_us_right_title') }}</h4>
                        <p class="text-muted">{!! getOption('join_us_right_description') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Join Us -->

    <!-- Start About -->
    <section class="section-padding" id="about-us-section">
        <!-- Background Image Element (Optional, hidden on mobile) -->
        <div class="about-bg-element position-absolute bottom-0 start-0 d-none d-xl-block"
            style="opacity: 0.1; max-width: 400px; z-index: -1;">
            <img src="{{ asset(getFileUrl(getOption('about_us_background_breadcrumb'))) }}" alt="" class="w-100" />
        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="position-relative">
                        <img src="{{ asset(getFileUrl(getOption('about_us_background_breadcrumb'))) }}" alt="About Us"
                            class="img-fluid rounded-4 shadow-lg w-100" style="min-height: 400px; object-fit: cover;">
                        <div class="position-absolute bottom-0 end-0 bg-white p-4 rounded-top-4 ms-5 mb-n4 shadow d-none d-md-block"
                            style="max-width: 250px;">
                            <h4 class="font-playfair display-5 fw-bold text-primary mb-0">{{ $totalAlumni }}+</h4>
                            <p class="text-muted mb-0">Active Alumni Members</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <span class="section-badge">{{ __('About Us') }}</span>
                    <h2 class="section-title text-start">{{ getOption('about_us_title') }}</h2>
                    <div class="section-desc mx-0 text-start mb-4">
                        {!! getOption('about_us_description') !!}
                    </div>
                    <a href="{{ route('login') }}" class="btn-home-primary">
                        {{ __('Join Community') }}
                        <i class="fa-solid fa-user-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End About -->

    <!-- Start Upcoming Events -->
    @if (count($upcomingEvents))
        <section class="section-padding section-bg-dark"
            style="background-image: url('{{ asset(getFileUrl(getOption('upcoming_events_background'))) }}'); background-blend-mode: overlay; background-size: cover; background-attachment: fixed;">
            <div class="container">
                <div class="text-center mb-5">
                    <span
                        class="section-badge bg-white-10 text-warning border-warning-subtle">{{ __('Networking & Reunions') }}</span>
                    <h2 class="section-title dark-mode">{{ __('Upcoming Events') }}</h2>
                    <p class="section-desc dark-mode">
                        {{ __('Connect with fellow graduates, attend reunions, and stay updated with our thriving alumni community activities.') }}
                    </p>
                </div>

                <div class="swiper upcomingEvent">
                    <div class="swiper-wrapper pb-5">
                        @foreach ($upcomingEvents as $upcomingEvent)
                            <div class="swiper-slide">
                                <div class="event-card-modern">
                                    <div class="row g-0 h-100">
                                        <div class="col-md-5 position-relative">
                                            <img src="{{ getFileUrl($upcomingEvent->thumbnail) }}" alt="{{ $upcomingEvent->title }}"
                                                class="w-100 h-100 object-fit-cover" style="min-height: 250px;">
                                            <div class="position-absolute top-0 start-0 m-3 bg-white p-2 rounded text-center shadow-sm"
                                                style="min-width: 60px;">
                                                <span
                                                    class="d-block fw-bold fs-4">{{ \Carbon\Carbon::parse($upcomingEvent->date)->format('d') }}</span>
                                                <span
                                                    class="d-block small text-uppercase fw-bold text-muted">{{ \Carbon\Carbon::parse($upcomingEvent->date)->format('M') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="event-content d-flex flex-column justify-content-center h-100 bg-white">
                                                <div class="event-meta mb-2">
                                                    <span><i
                                                            class="fa-regular fa-clock me-2"></i>{{ \Carbon\Carbon::parse($upcomingEvent->date)->format('h:i A') }}</span>
                                                    <span><i
                                                            class="fa-solid fa-location-dot me-2"></i>{{ $upcomingEvent->location }}</span>
                                                </div>
                                                <a href="{{ route('event.view.details', $upcomingEvent->slug) }}"
                                                    class="event-title">{{ $upcomingEvent->title }}</a>

                                                <!-- Countdown (Simplified for now, JS hooks remain) -->
                                                <div class="mt-3 pt-3 border-top">
                                                    <a href="{{ route('event.view.details', $upcomingEvent->slug) }}"
                                                        class="read-more-link">
                                                        {{ __('View Details') }} <i class="fa-solid fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <div
                            class="swiper-button-prev position-static text-white border border-white rounded-circle w-50px h-50px d-flex align-items-center justify-content-center hover-bg-gold">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div
                            class="swiper-button-next position-static text-white border border-white rounded-circle w-50px h-50px d-flex align-items-center justify-content-center hover-bg-gold">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Upcoming Events -->

    <!-- Start Stories & Stats -->
    <section class="section-padding section-bg-light position-relative overflow-hidden">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-10"
            style="background: url('{{ asset('frontend/images/world-map.png') }}') no-repeat center right; background-size: contain;">
        </div>

        <div class="container position-relative z-1">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="section-badge">{{ __('Success Stories') }}</span>
                    <h2 class="section-title text-start">{{ __('Inspiring Journeys') }}</h2>
                    <div class="row g-4 mt-2">
                        @foreach ($stories as $story)
                            <div class="col-md-6">
                                <div class="story-card h-100">
                                    <div class="story-img-wrap">
                                        <img src="{{ getFileUrl($story->thumbnail) }}" alt="{{ $story->title }}">
                                    </div>
                                    <div class="story-content">
                                        <span
                                            class="text-muted small mb-2 d-block">{{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}</span>
                                        <h5 class="fw-bold mb-3 line-clamp-2"><a href="{{ route('story.view', $story->slug) }}"
                                                class="text-dark text-decoration-none">{{ $story->title }}</a></h5>
                                        <a href="{{ route('story.view', $story->slug) }}"
                                            class="read-more-link">{{ __('Read Story') }} <i
                                                class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1">
                    <div class="bg-dark text-white p-5 rounded-4 shadow-lg mt-4 mt-lg-0">
                        <h3 class="font-playfair mb-4">{{ __('Global Network') }}</h3>
                        <p class="text-white-50 mb-5">
                            {{ __('Connect alumni with mentors or coaches who can offer them guidance, advice, or feedback on their personal or professional goals.') }}
                        </p>

                        <div class="d-flex flex-column gap-3">
                            <div class="stat-item">
                                <div class="stat-number counter">{{ $totalAlumni }}</div>
                                <div class="stat-label">{{ __('Alumni Members') }}</div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="stat-item p-3">
                                        <div class="stat-number fs-3 counter">{{ $totalDepartments }}</div>
                                        <div class="stat-label small">{{ __("Departments") }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-item p-3">
                                        <div class="stat-number fs-3 counter">{{ $totalSessions }}</div>
                                        <div class="stat-label small">{{ __('Sessions') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="{{ route('login') }}" class="btn-home-primary w-100 justify-content-center">
                                {{ __('Join Us Today') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Stories -->

    <!-- Start New Alumni -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">{{ __('Fresh Faces') }}</span>
                <h2 class="section-title">{{ __('Recently Joined Alumni') }}</h2>
                <p class="section-desc">{{ __('Welcoming our newest members to the ever-growing family.') }}</p>
            </div>

            <div class="row g-4">
                @foreach ($alumnus as $alumni)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden text-center group-hover-lift">
                            <div class="position-relative overflow-hidden" style="height: 280px;">
                                <img src="{{ getFileUrl($alumni->image) }}" alt="{{ $alumni->name }}"
                                    class="w-100 h-100 object-fit-cover transition-transform duration-500 hover-scale-110">
                                <div
                                    class="position-absolute bottom-0 start-0 w-100 bg-gradient-to-t from-black-50 to-transparent p-3 text-white d-flex align-items-end justify-content-center h-50">
                                    <!-- Overlay content if needed -->
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold mb-1">{{ $alumni->name }}</h5>
                                <p class="text-muted small mb-0">{{ $alumni->final_class_name ?? 'N/A' }}</p>
                                <span class="badge bg-light text-dark mt-2">{{ $alumni->final_house_name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End New Alumni -->

    <!-- Start Gallery -->
    <section class="section-padding section-bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">{{ __('Memories') }}</span>
                <h2 class="section-title">{{ __('Image Gallery') }}</h2>
            </div>

            <div class="swiper imageGallery pb-5">
                <div class="swiper-wrapper">
                    @foreach ($photoGalleries as $photoGallery)
                        <div class="swiper-slide">
                            <div class="rounded-4 overflow-hidden position-relative shadow-sm" style="height: 350px;">
                                <a href="{{ getFileUrl($photoGallery->photo) }}" class="glightbox" data-gallery="gallery1">
                                    <img src="{{ getFileUrl($photoGallery->photo) }}" alt="{{ $photoGallery->caption }}"
                                        class="w-100 h-100 object-fit-cover transition-transform hover-scale-110" />
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <div
                        class="swiper-button-prev position-static text-dark border border-dark rounded-circle w-50px h-50px d-flex align-items-center justify-content-center hover-bg-gold hover-text-white">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <div
                        class="swiper-button-next position-static text-dark border border-dark rounded-circle w-50px h-50px d-flex align-items-center justify-content-center hover-bg-gold hover-text-white">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Gallery -->

    <!-- Start Blog -->
    <section class="section-padding">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
                <div class="text-start">
                    <span class="section-badge">{{ __('News & Updates') }}</span>
                    <h2 class="section-title mb-0">{{ __('Latest News') }}</h2>
                </div>
                <a href="{{ route('our.news') }}" class="read-more-link fs-5">
                    {{ __('View All News') }} <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">
                @foreach ($news as $singleNews)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">
                            <div class="position-relative" style="height: 240px;">
                                <img src="{{ getFileUrl($singleNews->image) }}" alt="{{ $singleNews->title }}"
                                    class="w-100 h-100 object-fit-cover">
                                <span
                                    class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm py-2 px-3">{{ \Carbon\Carbon::parse($singleNews->created_at)->format('M d, Y') }}</span>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <img src="{{ getFileUrl($singleNews->author->image) }}" alt="" class="rounded-circle"
                                        width="30" height="30">
                                    <span class="text-muted small">{{ $singleNews->author->name }}</span>
                                    <span class="text-muted small mx-1">•</span>
                                    <span class="text-primary small fw-bold">{{ $singleNews->category->name }}</span>
                                </div>
                                <h5 class="card-title fw-bold font-playfair mb-3"><a
                                        href="{{ route('news.view.details', $singleNews->slug) }}"
                                        class="text-dark text-decoration-none">{{ $singleNews->title }}</a></h5>
                                <a href="{{ route('news.view.details', $singleNews->slug) }}"
                                    class="read-more-link mt-auto">{{ __('Read Article') }} <i
                                        class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Blog -->
@endsection
@push('script')
    <script></script>
@endpush