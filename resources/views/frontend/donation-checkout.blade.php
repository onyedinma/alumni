@extends('frontend.layouts.app')
@push('title')
    {{ __('Complete Donation') }}
@endpush
@section('content')
    <!-- Start Breadcrumb -->
    <section class="breadcrumb-wrap py-50 py-md-75 py-lg-100" data-background="{{ getSettingImage('page_breadcrumb') }}">
        <div class="text-center position-relative">
            <h4 class="fs-50 fw-700 lh-60 text-white pb-8">{{ __('Complete Donation') }}</h4>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('donation.index') }}">{{ __('Donate') }}</a></li>
                <li><a>{{ __('Checkout') }}</a></li>
            </ul>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <!-- Start Checkout -->
    <section class="pb-110 pt-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-white bd-ra-25 p-30 shadow-sm">

                        <!-- Donation Summary -->
                        <div class="mb-4 p-20 bg-f5f5f5 bd-ra-15">
                            <h5 class="fw-600 mb-3">{{ __('Donation Summary') }}</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('Donor Name:') }}</span>
                                <strong>{{ $donation->donor_name }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('Email:') }}</span>
                                <strong>{{ $donation->donor_email }}</strong>
                            </div>
                            @if($donation->message)
                                <div class="mb-2">
                                    <span>{{ __('Message:') }}</span>
                                    <p class="mb-0 mt-1 fst-italic">"{{ $donation->message }}"</p>
                                </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between fs-20">
                                <strong>{{ __('Donation Amount:') }}</strong>
                                <strong class="text-primary-color">{{ showPrice($donation->amount) }}</strong>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <h5 class="fw-600 mb-3">{{ __('Select Payment Method') }}</h5>

                        @if($gateways->count() > 0)
                            <div class="row g-3 mb-4">
                                @foreach($gateways as $gateway)
                                    <div class="col-6 col-md-4">
                                        <div class="payment-method-card p-15 border bd-ra-10 text-center cursor-pointer"
                                            data-gateway="{{ $gateway->slug }}">
                                            <img src="{{ getFileURL($gateway->image) }}" alt="{{ $gateway->title }}"
                                                class="img-fluid mb-2" style="max-height: 40px;">
                                            <p class="mb-0 small">{{ $gateway->title }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning">
                                {{ __('No payment gateways available. Please contact administrator.') }}
                            </div>
                        @endif

                        <!-- Bank Transfer Option -->
                        @if($banks->count() > 0)
                            <div class="mb-4">
                                <h6 class="fw-500 mb-2">{{ __('Or Transfer Directly:') }}</h6>
                                @foreach($banks as $bank)
                                    <div class="p-15 bg-f5f5f5 bd-ra-10 mb-2">
                                        <p class="mb-1"><strong>{{ __('Bank:') }}</strong> {{ $bank->name }}</p>
                                        <p class="mb-1"><strong>{{ __('Account Name:') }}</strong> {{ $bank->account_name }}</p>
                                        <p class="mb-0"><strong>{{ __('Account Number:') }}</strong> <span
                                                class="text-primary-color fs-18">{{ $bank->account_number }}</span></p>
                                    </div>
                                @endforeach
                                <p class="small text-muted">
                                    {{ __('After transfer, please send your payment receipt to our email or WhatsApp.') }}</p>
                            </div>
                        @endif

                        <div class="d-flex gap-3">
                            <a href="{{ route('donation.index') }}"
                                class="flex-grow-1 d-inline-flex justify-content-center align-items-center fs-15 fw-500 lh-25 text-707070 p-13 bd-ra-12 bg-f5f5f5">
                                <i class="fas fa-arrow-left me-2"></i> {{ __('Back') }}
                            </a>
                            <button type="button" id="confirmDonation"
                                class="flex-grow-1 d-inline-flex justify-content-center align-items-center border-0 fs-15 fw-500 lh-25 text-white p-13 bd-ra-12 bg-primary-color"
                                disabled>
                                <i class="fas fa-check me-2"></i> {{ __('Confirm Donation') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Checkout -->
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Payment method selection
            $('.payment-method-card').on('click', function () {
                $('.payment-method-card').removeClass('border-primary bg-light');
                $(this).addClass('border-primary bg-light');
                $('#confirmDonation').prop('disabled', false);
            });

            // For now, just redirect to success (in production, integrate with actual payment gateway)
            $('#confirmDonation').on('click', function () {
                window.location.href = "{{ route('donation.success') }}";
            });
        });
    </script>
@endpush