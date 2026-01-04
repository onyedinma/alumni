@extends('frontend.layouts.app')
@push('title')
    {{ __('Make a Donation') }}
@endpush
@section('content')
    <!-- Start Breadcrumb -->
    <section class="breadcrumb-wrap py-50 py-md-75 py-lg-100" data-background="{{ getSettingImage('page_breadcrumb') }}">
        <div class="text-center position-relative">
            <h4 class="fs-50 fw-700 lh-60 text-white pb-8">{{ __('Make a Donation') }}</h4>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                <li><a>{{ __('Donate') }}</a></li>
            </ul>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <!-- Start Donation Form -->
    <section class="pb-110 pt-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-white bd-ra-25 p-30 shadow-sm">
                        <div class="text-center mb-4">
                            <h3 class="fs-28 fw-600 text-primary-color">{{ __('Support FGC Ohafia 2007 Alumni') }}</h3>
                            <p class="text-707070">
                                {{ __('Your donation helps us organize reunions, support members in need, and give back to our alma mater.') }}
                            </p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('donation.store') }}" method="post">
                            @csrf

                            @if($campaigns->count() > 0)
                                <!-- Campaign Selection -->
                                <div class="mb-4">
                                    <label class="form-label fw-500 mb-3">{{ __('Select a Cause (Optional)') }}</label>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="campaign-card p-15 border bd-ra-10 cursor-pointer h-100 campaign-selected"
                                                data-campaign="">
                                                <div class="text-center">
                                                    <i class="fas fa-hand-holding-heart fs-24 text-primary-color mb-2"></i>
                                                    <p class="mb-0 fw-500">{{ __('General Fund') }}</p>
                                                    <small class="text-muted">{{ __('Support alumni activities') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($campaigns as $campaign)
                                            <div class="col-md-4">
                                                <div class="campaign-card p-15 border bd-ra-10 cursor-pointer h-100"
                                                    data-campaign="{{ $campaign->id }}">
                                                    <div class="text-center">
                                                        @if($campaign->image_id)
                                                            <img src="{{ getFileURL($campaign->image) }}" alt="" class="mb-2"
                                                                style="max-height: 40px;">
                                                        @else
                                                            <i class="fas fa-heart fs-24 text-danger mb-2"></i>
                                                        @endif
                                                        <p class="mb-1 fw-500">{{ $campaign->title }}</p>
                                                        @if($campaign->beneficiary_name)
                                                            <small class="text-muted d-block">{{ $campaign->beneficiary_name }}</small>
                                                        @endif
                                                        @if($campaign->goal_amount)
                                                            <div class="progress mt-2" style="height: 6px;">
                                                                <div class="progress-bar bg-success"
                                                                    style="width: {{ $campaign->progress_percentage }}%"></div>
                                                            </div>
                                                            <small class="text-success">{{ showPrice($campaign->raised_amount) }} /
                                                                {{ showPrice($campaign->goal_amount) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="campaign_id" id="campaign_id" value="">
                                </div>

                                <hr class="my-4">
                            @endif

                            <!-- Quick Amount Buttons -->
                            <div class="mb-4">
                                <label class="form-label fw-500 mb-3">{{ __('Select Amount') }}</label>
                                <div class="row g-3">
                                    <div class="col-4 col-md-2">
                                        <button type="button"
                                            class="amount-btn w-100 py-12 bd-ra-10 border-0 bg-f5f5f5 fw-500 hover-bg-primary"
                                            data-amount="5000">₦5,000</button>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <button type="button"
                                            class="amount-btn w-100 py-12 bd-ra-10 border-0 bg-f5f5f5 fw-500 hover-bg-primary"
                                            data-amount="10000">₦10,000</button>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <button type="button"
                                            class="amount-btn w-100 py-12 bd-ra-10 border-0 bg-f5f5f5 fw-500 hover-bg-primary"
                                            data-amount="25000">₦25,000</button>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <button type="button"
                                            class="amount-btn w-100 py-12 bd-ra-10 border-0 bg-f5f5f5 fw-500 hover-bg-primary"
                                            data-amount="50000">₦50,000</button>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <button type="button"
                                            class="amount-btn w-100 py-12 bd-ra-10 border-0 bg-f5f5f5 fw-500 hover-bg-primary"
                                            data-amount="100000">₦100,000</button>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <button type="button"
                                            class="amount-btn w-100 py-12 bd-ra-10 border-0 bg-f5f5f5 fw-500 hover-bg-primary"
                                            data-amount="custom">{{ __('Other') }}</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Custom Amount Input -->
                            <div class="pb-21">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="amount" class="form-label">{{ __('Donation Amount (₦)') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="primary-form-control" id="amount" name="amount"
                                            min="100" value="{{ old('amount', 5000) }}"
                                            placeholder="{{ __('Enter amount') }}" required />
                                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Donor Information -->
                            <h5 class="fw-600 mb-3">{{ __('Your Information') }}</h5>

                            <div class="pb-21">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="donor_name" class="form-label">{{ __('Full Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="primary-form-control" id="donor_name" name="donor_name"
                                            value="{{ old('donor_name', auth()->check() ? auth()->user()->name : '') }}"
                                            placeholder="{{ __('Your Full Name') }}" required />
                                        @error('donor_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="pb-21">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="donor_email" class="form-label">{{ __('Email Address') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="primary-form-control" id="donor_email" name="donor_email"
                                            value="{{ old('donor_email', auth()->check() ? auth()->user()->email : '') }}"
                                            placeholder="{{ __('Your Email') }}" required />
                                        @error('donor_email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="pb-21">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="donor_phone" class="form-label">{{ __('Phone Number') }}</label>
                                        <input type="tel" class="primary-form-control" id="donor_phone" name="donor_phone"
                                            value="{{ old('donor_phone') }}"
                                            placeholder="{{ __('Your Phone (Optional)') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="pb-21">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="message" class="form-label">{{ __('Message (Optional)') }}</label>
                                        <textarea name="message" id="message" class="primary-form-control min-h-100"
                                            placeholder="{{ __('Leave a message with your donation...') }}">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-100 d-inline-flex justify-content-center align-items-center border-0 fs-18 fw-600 lh-25 text-white p-15 bd-ra-12 bg-primary-color">
                                <i class="fas fa-heart me-2"></i> {{ __('Continue to Payment') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Donation Form -->
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Campaign card click handler
            $('.campaign-card').on('click', function() {
                $('.campaign-card').removeClass('campaign-selected border-primary bg-light');
                $(this).addClass('campaign-selected border-primary bg-light');
                $('#campaign_id').val($(this).data('campaign'));
            });

            // Quick amount button click handler
            $('.amount-btn').on('click', function () {
                $('.amount-btn').removeClass('bg-primary-color text-white').addClass('bg-f5f5f5');
                $(this).addClass('bg-primary-color text-white').removeClass('bg-f5f5f5');

                var amount = $(this).data('amount');
                if (amount !== 'custom') {
                    $('#amount').val(amount);
                } else {
                    $('#amount').val('').focus();
                }
            });

            // Highlight the default selected amount
            $('.amount-btn[data-amount="5000"]').addClass('bg-primary-color text-white').removeClass('bg-f5f5f5');
        });
    </script>
@endpush