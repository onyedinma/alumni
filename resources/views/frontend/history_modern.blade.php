@extends('frontend.layouts.modern')

@push('title')
    {{ __('Our History') }}
@endpush

@push('style')
    <style>
        .history-hero {
            padding: 120px 0 60px;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 100%);
            text-align: center;
            border-bottom: 1px solid rgba(212, 175, 90, 0.1);
        }

        .history-hero__title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            color: #D4AF5A;
            margin-bottom: 1rem;
        }

        .history-hero__subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 800px;
            margin: 0 auto;
        }

        /* ====== Timeline ====== */
        .timeline-section {
            padding: 100px 0;
            background: #0B0E11;
            position: relative;
            overflow: hidden;
        }

        .timeline-container {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .timeline-container::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, transparent, #D4AF5A, #751525, transparent);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 60px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            position: relative;
            width: 45%;
            padding: 30px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(212, 175, 90, 0.2);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateY(-5px);
            border-color: #D4AF5A;
            background: rgba(255, 255, 255, 0.05);
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            top: 30%;
            width: 20px;
            height: 20px;
            background: #D4AF5A;
            border: 4px solid #0B0E11;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            box-shadow: 0 0 15px rgba(212, 175, 90, 0.5);
        }

        .timeline-year {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #D4AF5A;
            font-weight: 800;
            margin-bottom: 0.5rem;
            display: block;
        }

        .timeline-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: #E6EAF0;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .timeline-text {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            line-height: 1.7;
            color: rgba(230, 234, 240, 0.8);
        }

        .vision-box {
            margin-top: 100px;
            padding: 60px;
            background: linear-gradient(135deg, rgba(117, 21, 37, 0.1) 0%, rgba(212, 175, 90, 0.05) 100%);
            border: 1px solid rgba(212, 175, 90, 0.3);
            border-radius: 20px;
            text-align: center;
            position: relative;
        }

        .vision-box::before {
            content: '\f10d';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 50px;
            color: #D4AF5A;
            background: #0B0E11;
            padding: 0 20px;
        }

        .vision-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-style: italic;
            color: #E6EAF0;
            line-height: 1.5;
            max-width: 900px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .timeline-container::before {
                left: 30px;
            }

            .timeline-item {
                flex-direction: row !important;
                justify-content: flex-start;
                padding-left: 60px;
            }

            .timeline-content {
                width: 100%;
            }

            .timeline-dot {
                left: 30px;
            }

            .vision-box {
                padding: 40px 20px;
            }

            .vision-text {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero -->
    <header class="history-hero">
        <div class="container mx-auto" data-aos="fade-up">
            <h1 class="history-hero__title">{{ __('Our Journey') }}</h1>
            <p class="history-hero__subtitle">
                {{ __('The story of FGC Ohafia Class of 2007 Alumni Group – built on unity, service, and a lifelong commitment to one another.') }}
            </p>
        </div>
    </header>

    <section class="timeline-section">
        <div class="container mx-auto">
            <div class="timeline-container">
                @if(isset($timelines) && $timelines->count() > 0)
                    {{-- Dynamic: Entries from admin panel --}}
                    @foreach($timelines as $timeline)
                        <div class="timeline-item" data-aos="{{ $loop->odd ? 'fade-right' : 'fade-left' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">{{ $timeline->year }}</span>
                                <h3 class="timeline-title">{{ $timeline->title }}</h3>
                                <p class="timeline-text">{{ $timeline->description }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Default hardcoded fallback --}}
                    <div class="timeline-item" data-aos="fade-right">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">May 17, 2017</span>
                            <h3 class="timeline-title">{{ __('The Genesis') }}</h3>
                            <p class="timeline-text">
                                {{ __('The journey officially began when the late Ms. Ihuoma Ella, alongside three other pioneering members, created the WhatsApp group that would eventually grow into the vibrant alumni community we have today.') }}
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item" data-aos="fade-left">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">2017</span>
                            <h3 class="timeline-title">{{ __('First Major Milestone') }}</h3>
                            <p class="timeline-text">
                                {{ __('The first major milestone was the collective support for our brother Nnamdi Njasi. The overwhelming response solidified trust and demonstrated the collective strength of the alumni.') }}
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item" data-aos="fade-right">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">{{ __('Catalyst for Growth') }}</span>
                            <h3 class="timeline-title">{{ __('A Platform for Solidarity') }}</h3>
                            <p class="timeline-text">
                                {{ __('A defining moment came during the illness of Paul Arisa. Information shared with the group became a catalyst for rapid growth, drawing in many alumni who had been out of touch.') }}
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item" data-aos="fade-left">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">{{ __('Early Leadership') }}</span>
                            <h3 class="timeline-title">{{ __('Excellence through Service') }}</h3>
                            <p class="timeline-text">
                                {{ __('Leadership emerged naturally through service. Ms. Ella oversaw accounting, documentation, and reports. Later, Comr. CHIJIOKE FELIX MADUKA was appointed Chairman of the Caretaker Committee.') }}
                            </p>
                        </div>
                    </div>

                    <div class="timeline-item" data-aos="fade-right">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <span class="timeline-year">{{ __('Democratic Transition') }}</span>
                            <h3 class="timeline-title">{{ __('A Structured Future') }}</h3>
                            <p class="timeline-text">
                                {{ __('Caleb was elected as President with Anita as Vice President in our first major elections, marking a significant step toward a formal structure.') }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Vision Box -->
            <div class="vision-box" data-aos="zoom-in">
                <p class="vision-text">
                    "{{ __('The core vision: to bring together all members under one unified platform, create opportunities for one another, and uphold the values of being one another\'s brother\'s and sister\'s keeper.') }}"
                </p>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <div class="timeline-text max-w-2xl mx-auto mb-5" style="font-style: italic;">
                    {{ __('Today, we stand stronger together, committed to building a lasting legacy for ourselves and future generations.') }}
                </div>
                <a href="{{ route('register') }}" class="hp-btn hp-btn--maroon">
                    {{ __('Join the Legacy') }}
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
@endsection