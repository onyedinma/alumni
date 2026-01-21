@extends('frontend.layouts.modern')

@push('title')
    {{ $pageTitle }}
@endpush

@push('style')
    <style>
        /* Contact Page - Premium Dark Theme */
        .contact-section {
            min-height: 100vh;
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 50%, #0B0E11 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background orbs */
        .contact-section::before,
        .contact-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(139, 38, 53, 0.4), rgba(212, 175, 90, 0.3));
            filter: blur(100px);
            opacity: 0.5;
            animation: contactFloat 20s infinite ease-in-out;
            z-index: 0;
        }

        .contact-section::before {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 5%;
        }

        .contact-section::after {
            width: 400px;
            height: 400px;
            bottom: 10%;
            right: 5%;
            animation-delay: 5s;
        }

        @keyframes contactFloat {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(30px, 30px) rotate(90deg);
            }

            50% {
                transform: translate(-30px, -30px) rotate(180deg);
            }

            75% {
                transform: translate(30px, -30px) rotate(270deg);
            }
        }

        /* Page header */
        .contact-header {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            z-index: 1;
        }

        .contact-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 16px;
        }

        .contact-header h1 span {
            background: linear-gradient(90deg, #D4AF5A, #E3C16E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .contact-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Main card */
        .contact-card {
            background: rgba(18, 22, 28, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        /* Top gradient border */
        .contact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8B2635, #D4AF5A, #8B2635);
        }

        .contact-row {
            display: flex;
            flex-wrap: wrap;
        }

        /* Left column - Info */
        .contact-info {
            flex: 0 0 40%;
            max-width: 40%;
            padding: 50px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.2) 0%, rgba(23, 28, 35, 0.9) 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 991px) {
            .contact-info {
                flex: 0 0 100%;
                max-width: 100%;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
        }

        .contact-info-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #D4AF5A;
            margin-bottom: 30px;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 28px;
        }

        .contact-info-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #D4AF5A, #B8934A);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-info-icon i {
            font-size: 20px;
            color: #0B0E11;
        }

        .contact-info-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .contact-info-content p {
            font-size: 16px;
            color: #fff;
            margin: 0;
        }

        .contact-info-content a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-info-content a:hover {
            color: #D4AF5A;
        }

        /* Social links */
        .contact-social {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-social h4 {
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .contact-social-links {
            display: flex;
            gap: 12px;
        }

        .contact-social-links a {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D4AF5A;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .contact-social-links a:hover {
            background: #D4AF5A;
            color: #0B0E11;
            transform: translateY(-3px);
        }

        /* Right column - Form */
        .contact-form-wrap {
            flex: 0 0 60%;
            max-width: 60%;
            padding: 50px;
        }

        @media (max-width: 991px) {
            .contact-form-wrap {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .contact-form-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 30px;
        }

        .contact-form-group {
            margin-bottom: 24px;
        }

        .contact-form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
        }

        .contact-form-control {
            width: 100%;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .contact-form-control:focus {
            outline: none;
            border-color: #D4AF5A;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.2);
        }

        .contact-form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        textarea.contact-form-control {
            min-height: 150px;
            resize: vertical;
        }

        .contact-submit-btn {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, #8B2635 0%, #751525 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .contact-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 38, 53, 0.4);
        }

        .contact-submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .contact-submit-btn:hover::before {
            left: 100%;
        }

        .contact-submit-btn i {
            margin-left: 8px;
        }
    </style>
@endpush

@section('content')
    <section class="contact-section">
        <div class="container">
            <!-- Header -->
            <div class="contact-header">
                <h1>Get in <span>Touch</span></h1>
                <p>Have questions or want to connect? We'd love to hear from you.</p>
            </div>

            <!-- Main Card -->
            <div class="contact-card">
                <div class="contact-row">
                    <!-- Contact Info -->
                    <div class="contact-info">
                        <h3 class="contact-info-title">Contact Information</h3>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Phone</h4>
                                <p><a
                                        href="tel:{{ getOption('app_contact_number', '+1234567890') }}">{{ getOption('app_contact_number', '+1234567890') }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Email</h4>
                                <p><a href="mailto:{{ getOption('app_email', 'info@example.com') }}">{{
                                        getOption('app_email', 'info@example.com') }}</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Address</h4>
                                <p>{{ getOption('app_address', 'FGC Ohafia, Abia State, Nigeria') }}</p>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="contact-social">
                            <h4>Follow Us</h4>
                            <div class="contact-social-links">
                                @if(getOption('facebook_link'))
                                    <a href="{{ getOption('facebook_link') }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                @endif
                                @if(getOption('twitter_link'))
                                    <a href="{{ getOption('twitter_link') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if(getOption('instagram_link'))
                                    <a href="{{ getOption('instagram_link') }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a>
                                @endif
                                @if(getOption('linkedin_link'))
                                    <a href="{{ getOption('linkedin_link') }}" target="_blank"><i
                                            class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if(!getOption('facebook_link') && !getOption('twitter_link') && !getOption('instagram_link') && !getOption('linkedin_link'))
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form-wrap">
                        <h3 class="contact-form-title">Send us a Message</h3>

                        <form action="{{ route('contact_us.store') }}" method="post" data-handler="settingCommonHandler">
                            @csrf
                            <div class="contact-form-group">
                                <label for="csName">Full Name</label>
                                <input type="text" class="contact-form-control" id="csName" name="name"
                                    placeholder="John Doe" required />
                            </div>

                            <div class="contact-form-group">
                                <label for="csEmail">Email Address</label>
                                <input type="email" class="contact-form-control" id="csEmail" name="email"
                                    placeholder="john@example.com" required />
                            </div>

                            <div class="contact-form-group">
                                <label for="csSubject">Subject</label>
                                <input type="text" class="contact-form-control" id="csSubject" name="subject"
                                    placeholder="How can we help?" required />
                            </div>

                            <div class="contact-form-group">
                                <label for="csMessage">Message</label>
                                <textarea name="message" id="csMessage" class="contact-form-control"
                                    placeholder="Write your message here..." required></textarea>
                            </div>

                            <button type="submit" class="contact-submit-btn">
                                Send Message <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection