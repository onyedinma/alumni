@extends('layouts.app')
@push('title')
    {{ __('Profile View') }}
@endpush
@section('content')
    <style>
        /* Premium Profile Components */
        .premium-profile-view {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .premium-card {
            background-color: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
        }

        /* Typography */
        .premium-title {
            color: var(--gold, #D4AF5A);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 24px;
        }

        .premium-text-primary {
            color: var(--text-primary, #E6EAF0);
        }

        .premium-text-secondary {
            color: var(--text-secondary, #B4BCC8);
        }

        /* User Header Section */
        .user-header-section {
            border-bottom: 1px solid var(--border-dark, #1F2630);
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .user-avatar-premium {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 3px solid var(--gold, #D4AF5A);
            overflow: hidden;
            padding: 3px;
            background: var(--bg-elevated, #171C23);
        }

        .user-avatar-premium img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .social-link-premium {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-elevated, #171C23);
            border: 1px solid var(--border-dark, #1F2630);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-link-premium:hover {
            border-color: var(--gold, #D4AF5A);
            background: var(--bg-primary, #0B0E11);
            transform: translateY(-3px);
        }

        .social-link-premium img {
            filter: invert(80%) sepia(20%) saturate(200%) hue-rotate(350deg) brightness(95%) contrast(90%);
            width: 18px;
        }

        /* Info Sections */
        .info-box {
            background: var(--bg-elevated, #171C23);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border-dark, #1F2630);
            height: 100%;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-dark, #1F2630);
            padding-bottom: 15px;
        }

        .section-header .icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(212, 175, 90, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold, #D4AF5A);
            font-size: 16px;
        }

        .section-header h4 {
            color: var(--gold, #D4AF5A);
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }

        /* List Items */
        ul.premium-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }

        ul.premium-list li .bio-icon {
            color: var(--gold, #D4AF5A);
            font-size: 18px;
            margin-top: 2px;
            width: 20px;
        }

        ul.premium-list li p {
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
        }

        ul.premium-list li p:first-of-type {
            color: var(--text-secondary, #B4BCC8);
            min-width: 120px;
        }

        ul.premium-list li p:last-of-type {
            color: var(--text-primary, #E6EAF0);
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            ul.premium-list li {
                flex-direction: column;
                gap: 4px;
            }

            ul.premium-list li .bio-icon {
                display: none;
            }
        }
    </style>

    <div class="premium-profile-view">
        <h4 class="premium-title">{{ __('Alumni Profile View') }}</h4>

        <div class="premium-card">
            <!-- Top Section: Photo, Name, Social -->
            <div class="user-header-section">
                <div class="row align-items-center gy-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-4">
                            <div class="zUser-one position-relative">
                                <div class="user-avatar-premium">
                                    <img src="{{ asset(getFileUrl($user->image)) }}" alt="{{ $user->name }}" />
                                </div>
                                @if (!$user->currentMembership == null)
                                    <div class="zBadge position-absolute" style="bottom: -5px; right: -5px;">
                                        <img src="{{ getFileUrl($user->currentMembership->badge)}}" alt="" width="30" />
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="fs-24 fw-600 premium-text-primary mb-1">{{ $user->name }}</h4>
                                <p class="fs-14 premium-text-secondary mb-3">{{ $user->alumni?->company_designation }}</p>

                                <!-- Social Links -->
                                <ul class="d-flex align-items-center gap-2">
                                    @if($user->alumni?->facebook_url)
                                        <li>
                                            <a target="__blank" href="{{ $user->alumni?->facebook_url }}"
                                                class="social-link-premium">
                                                <img src="{{ asset('assets/images/icon/facebook-2.svg')}}" alt="" />
                                            </a>
                                        </li>
                                    @endif
                                    @if($user->alumni?->twitter_url)
                                        <li>
                                            <a target="__blank" href="{{ $user->alumni?->twitter_url }}"
                                                class="social-link-premium">
                                                <img src="{{ asset('assets/images/icon/twitter-2.svg')}}" alt="" />
                                            </a>
                                        </li>
                                    @endif
                                    @if($user->alumni?->linkedin_url)
                                        <li>
                                            <a target="__blank" href="{{ $user->alumni?->linkedin_url }}"
                                                class="social-link-premium">
                                                <img src="{{ asset('assets/images/icon/linkedin-2.svg')}}" alt="" />
                                            </a>
                                        </li>
                                    @endif
                                    @if($user->alumni?->instagram_url)
                                        <li>
                                            <a target="__blank" href="{{ $user->alumni?->instagram_url }}"
                                                class="social-link-premium">
                                                <img src="{{ asset('assets/images/icon/instagram-2.svg')}}" alt="" />
                                            </a>
                                        </li>
                                    @endif
                                    @if($user->show_phone_in_public == STATUS_SUCCESS && $user->mobile)
                                        <li>
                                            <a target="_blank"
                                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->mobile) }}"
                                                class="social-link-premium" style="background: #25D366; border-color: #25D366;">
                                                <svg width="18" height="18" fill="white" viewBox="0 0 24 24">
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <ul class="d-flex flex-column gap-3 premium-list justify-content-md-end align-items-md-end">
                            @if($user->show_phone_in_public == STATUS_SUCCESS)
                                <li class="d-flex align-items-center gap-3">
                                    <div class="social-link-premium" style="width: 32px; height: 32px;">
                                        <img src="{{ asset('assets/images/icon/phone.svg')}}" style="width: 14px;" alt="" />
                                    </div>
                                    <p class="mb-0 premium-text-primary">{{ $user->mobile }}</p>
                                    <span class="d-none"></span> <!-- Hack to fix flex alignment if list styles applied -->
                                </li>
                            @endif
                            @if($user->show_email_in_public == STATUS_SUCCESS)
                                <li class="d-flex align-items-center gap-3">
                                    <div class="social-link-premium" style="width: 32px; height: 32px;">
                                        <img src="{{ asset('assets/images/icon/envelope-1.svg')}}" style="width: 14px;"
                                            alt="" />
                                    </div>
                                    <p class="mb-0 premium-text-primary">{{ $user->email }}</p>
                                    <span class="d-none"></span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="row g-4">
                <!-- Bio & Personal Info -->
                <div class="col-lg-8">
                    <div class="info-box">
                        <!-- Bio -->
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <div class="section-header">
                                <div class="icon"><i class="fa-solid fa-user-circle"></i></div>
                                <h4>{{ __('Profile Bio') }}</h4>
                            </div>
                            <div class="premium-text-secondary lh-lg">
                                {!! $user->alumni?->about_me !!}
                            </div>
                        </div>

                        <!-- Personal Info -->
                        <ul class="premium-list">
                            <li>
                                <i class="fa-solid fa-user bio-icon"></i>
                                <p>{{ __('Full Name') }}</p>
                                <p>{{ $user->name }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-id-badge bio-icon"></i>
                                <p>{{ __('Nick Name') }}</p>
                                <p>{{ $user->nick_name }}</p>
                            </li>
                            @if($user->show_email_in_public == STATUS_SUCCESS)
                                <li>
                                    <i class="fa-solid fa-envelope bio-icon"></i>
                                    <p>{{ __('Email') }}</p>
                                    <p>{{ $user->email }}</p>
                                </li>
                            @endif
                            @if($user->show_phone_in_public == STATUS_SUCCESS)
                                <li>
                                    <i class="fa-solid fa-phone bio-icon"></i>
                                    <p>{{ __('Phone') }}</p>
                                    <p>{{ $user->mobile }}</p>
                                </li>
                            @endif
                            <li>
                                <i class="fa-solid fa-droplet bio-icon"></i>
                                <p>{{ __('Blood Group') }}</p>
                                <p>{{ $user->alumni?->blood_group }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-calendar bio-icon"></i>
                                <p>{{ __('Date of Birth') }}</p>
                                <p>{{ $user->alumni?->date_of_birth }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-city bio-icon"></i>
                                <p>{{ __('City') }}</p>
                                <p> {{ $user->alumni?->city }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-map bio-icon"></i>
                                <p>{{ __('State') }}</p>
                                <p> {{ $user->alumni?->state }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-globe bio-icon"></i>
                                <p>{{ __('Country') }}</p>
                                <p>{{ $user->alumni?->country }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-map-pin bio-icon"></i>
                                <p>{{ __('Zip Code') }}</p>
                                <p>{{ $user->alumni?->zip }}</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Educational & Professional Info -->
                <div class="col-lg-4">
                    <div class="info-box">
                        <!-- Education -->
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <div class="section-header">
                                <div class="icon"><i class="fa-solid fa-graduation-cap"></i></div>
                                <h4>{{ __('Educational Info') }}</h4>
                            </div>

                            @forelse ($user->institutions as $institute)
                                <div class="mb-4">
                                    <h6 class="premium-text-primary fw-bold mb-2">{{ $institute->degree }}</h6>
                                    <ul class="premium-list">
                                        <li>
                                            <p style="min-width: 80px;">{{ __('Institute') }}</p>
                                            <p>{{ $institute->institute }}</p>
                                        </li>
                                        <li>
                                            <p style="min-width: 80px;">{{ __('Year') }}</p>
                                            <p>{{ $institute->passing_year }}</p>
                                        </li>
                                    </ul>
                                </div>
                            @empty
                                <p class="premium-text-secondary">{{ __('No Educational Info Found') }}</p>
                            @endforelse
                        </div>

                        <!-- Professional -->
                        <div>
                            <div class="section-header">
                                <div class="icon"><i class="fa-solid fa-briefcase"></i></div>
                                <h4>{{ __('Professional Info') }}</h4>
                            </div>
                            <ul class="premium-list">
                                <li>
                                    <i class="fa-solid fa-building bio-icon"></i>
                                    <p>{{ __('Company') }}</p>
                                    <p>{{ $user->alumni?->company }}</p>
                                </li>
                                <li>
                                    <i class="fa-solid fa-user-tie bio-icon"></i>
                                    <p>{{ __('Designation') }}</p>
                                    <p>{{ $user->alumni?->company_designation }}</p>
                                </li>
                                <li>
                                    <i class="fa-solid fa-location-dot bio-icon"></i>
                                    <p>{{ __('Address') }}</p>
                                    <p>{{ $user->alumni?->company_address }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection