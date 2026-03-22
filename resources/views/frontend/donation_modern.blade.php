@extends('frontend.layouts.app')

@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        /* Donation Page - Premium Dark Theme */
        .donation-section {
            min-height: 100vh;
            padding: 100px 0 80px;
            background: linear-gradient(135deg, #0B0E11 0%, #12161C 50%, #0B0E11 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background orbs */
        .donation-section::before,
        .donation-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.4;
            z-index: 0;
        }

        .donation-section::before {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, rgba(139, 38, 53, 0.5), rgba(212, 175, 90, 0.3));
            top: 5%;
            left: -5%;
            animation: donationFloat 20s infinite ease-in-out;
        }

        .donation-section::after {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, rgba(212, 175, 90, 0.4), rgba(139, 38, 53, 0.3));
            bottom: 5%;
            right: -5%;
            animation: donationFloat 25s infinite ease-in-out reverse;
        }

        @keyframes donationFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(40px, -40px) scale(1.1);
            }
        }

        /* Header */
        .donation-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            z-index: 1;
        }

        .donation-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 16px;
        }

        .donation-header h1 span {
            background: linear-gradient(90deg, #D4AF5A, #E3C16E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .donation-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Campaign Cards */
        .campaigns-section {
            position: relative;
            z-index: 1;
            margin-bottom: 60px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #D4AF5A;
            margin-bottom: 30px;
            padding-left: 20px;
            border-left: 4px solid #8B2635;
        }

        .campaign-card {
            background: rgba(18, 22, 28, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .campaign-card:hover {
            border-color: rgba(212, 175, 90, 0.4);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .campaign-image {
            height: 200px;
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.3), rgba(18, 22, 28, 0.9));
            position: relative;
            overflow: hidden;
        }

        .campaign-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .campaign-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 6px 14px;
            background: linear-gradient(135deg, #8B2635, #751525);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .campaign-content {
            padding: 25px;
        }

        .campaign-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
        }

        .campaign-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Progress Bar */
        .progress-wrap {
            margin-bottom: 20px;
        }

        .progress-labels {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .progress-raised {
            color: #D4AF5A;
        }

        .progress-goal {
            color: rgba(255, 255, 255, 0.5);
        }

        .progress-bar-bg {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #D4AF5A, #E3C16E);
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .campaign-btn {
            width: 100%;
            padding: 12px 20px;
            background: rgba(212, 175, 90, 0.1);
            border: 1px solid rgba(212, 175, 90, 0.3);
            color: #D4AF5A;
            font-weight: 600;
            font-size: 14px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .campaign-btn:hover {
            background: rgba(212, 175, 90, 0.2);
            border-color: #D4AF5A;
        }

        /* Donation Form Card */
        .donation-form-card {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(18, 22, 28, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
        }

        .donation-form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8B2635, #D4AF5A, #8B2635);
        }

        .form-header {
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.4) 0%, rgba(18, 22, 28, 0.9) 100%);
            padding: 35px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-header h3 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
        }

        .form-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 15px;
        }

        .form-body {
            padding: 35px;
        }

        /* Selected Campaign Alert */
        .selected-campaign-alert {
            display: none;
            background: rgba(212, 175, 90, 0.1);
            border: 1px solid rgba(212, 175, 90, 0.3);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 25px;
            align-items: center;
            justify-content: space-between;
        }

        .selected-campaign-alert.show {
            display: flex;
        }

        .selected-campaign-alert span {
            color: #D4AF5A;
            font-size: 14px;
        }

        .selected-campaign-alert button {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            padding: 5px;
        }

        .selected-campaign-alert button:hover {
            color: #fff;
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #D4AF5A;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.15);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Amount Field */
        .amount-input-wrap {
            position: relative;
        }

        .amount-input-wrap .currency-symbol {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #D4AF5A;
            font-weight: 700;
            font-size: 18px;
        }

        .amount-input-wrap .form-control {
            padding-left: 45px;
            font-size: 20px;
            font-weight: 700;
            color: #fff !important;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, #8B2635 0%, #751525 100%);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(139, 38, 53, 0.4);
        }

        .secure-note {
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            margin-top: 20px;
        }

        .secure-note i {
            color: #D4AF5A;
            margin-right: 6px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .donation-header h1 {
                font-size: 36px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-body {
                padding: 25px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="donation-section">
        <div class="container">
            <!-- Header -->
            <div class="donation-header">
                <h1>Support Our <span>Community</span></h1>
                <p>{{ __('Your contributions help us grow and support alumni initiatives.') }}</p>
            </div>

            <!-- Campaigns -->
            @if(count($campaigns) > 0)
                <div class="campaigns-section">
                    <h2 class="section-title">{{ __('Featured Campaigns') }}</h2>
                    <div class="row g-4">
                        @foreach($campaigns as $campaign)
                            <div class="col-lg-4 col-md-6">
                                <div class="campaign-card">
                                    <div class="campaign-image">
                                        <img src="{{ getFileUrl($campaign->image) }}" alt="{{ $campaign->title }}">
                                        <span class="campaign-badge">Active</span>
                                    </div>
                                    <div class="campaign-content">
                                        <h3 class="campaign-title">{{ $campaign->title }}</h3>
                                        <p class="campaign-desc">{{ $campaign->description }}</p>

                                        <div class="progress-wrap">
                                            <div class="progress-labels">
                                                <span class="progress-raised">Raised:
                                                    ₦{{ number_format($campaign->raised_amount ?? 0) }}</span>
                                                <span class="progress-goal">Goal:
                                                    ₦{{ number_format($campaign->goal_amount ?? 10000) }}</span>
                                            </div>
                                            <div class="progress-bar-bg">
                                                <div class="progress-bar-fill"
                                                    style="width: {{ min(100, (($campaign->raised_amount ?? 0) / ($campaign->goal_amount ?? 1)) * 100) }}%">
                                                </div>
                                            </div>
                                        </div>

                                        <button onclick="selectCampaign({{ $campaign->id }}, '{{ $campaign->title }}')"
                                            class="campaign-btn">
                                            Donate to this Campaign
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Donation Form -->
            <div class="donation-form-card" id="donationForm">
                <div class="form-header">
                    <h3>{{ __('Make a Donation') }}</h3>
                    <p>{{ __('Secure and transparent payment processing.') }}</p>
                </div>

                <div class="form-body">
                    <form action="{{ route('donation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="campaign_id" id="campaign_id" value="">

                        <div class="selected-campaign-alert" id="selectedCampaignAlert">
                            <span><strong>Campaign:</strong> <span id="selectedCampaignName"></span></span>
                            <button type="button" onclick="clearCampaign()"><i class="fas fa-times"></i></button>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>{{ __('Your Name') }}</label>
                                <input type="text" name="donor_name" class="form-control"
                                    value="{{ auth()->user()->name ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Email Address') }}</label>
                                <input type="email" name="donor_email" class="form-control"
                                    value="{{ auth()->user()->email ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Donation Amount') }}</label>
                            <div class="amount-input-wrap">
                                <span class="currency-symbol">₦</span>
                                <input type="number" name="amount" class="form-control" placeholder="100.00" min="1"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Message (Optional)') }}</label>
                            <textarea name="message" class="form-control" rows="3"
                                placeholder="Leave a message of support..."></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            Proceed to Payment <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                        </button>

                        <p class="secure-note">
                            <i class="fas fa-lock"></i>
                            {{ __('Payments are processed securely. We do not store your card details.') }}
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        function selectCampaign(id, title) {
            document.getElementById('campaign_id').value = id;
            document.getElementById('selectedCampaignName').innerText = title;
            document.getElementById('selectedCampaignAlert').classList.add('show');
            document.getElementById('donationForm').scrollIntoView({ behavior: 'smooth' });
        }

        function clearCampaign() {
            document.getElementById('campaign_id').value = '';
            document.getElementById('selectedCampaignAlert').classList.remove('show');
        }
    </script>
@endpush