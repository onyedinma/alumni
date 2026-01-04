@extends('frontend.layouts.app')
@push('title')
    {{ __('Donation Successful') }}
@endpush
@section('content')
    <!-- Start Breadcrumb -->
    <section class="breadcrumb-wrap py-50 py-md-75 py-lg-100" data-background="{{ getSettingImage('page_breadcrumb') }}">
        <div class="text-center position-relative">
            <h4 class="fs-50 fw-700 lh-60 text-white pb-8">{{ __('Thank You!') }}</h4>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                <li><a>{{ __('Donation Successful') }}</a></li>
            </ul>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <!-- Start Success Message -->
    <section class="pb-110 pt-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-white bd-ra-25 p-40 shadow-sm text-center">
                        <div class="mb-4">
                            <div
                                class="d-inline-flex justify-content-center align-items-center w-100px h-100px bd-ra-50 bg-success text-white fs-40">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <h3 class="fs-28 fw-600 text-primary-color mb-3">{{ __('Thank You for Your Donation!') }}</h3>

                        <p class="text-707070 mb-4">
                            {{ __('Your generous contribution will help us continue our mission of supporting FGC Ohafia 2007 Alumni members and giving back to our alma mater.') }}
                        </p>

                        <p class="text-707070 mb-4">
                            {{ __('A confirmation email will be sent to you shortly with the details of your donation.') }}
                        </p>

                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                            <a href="{{ route('index') }}"
                                class="d-inline-flex justify-content-center align-items-center fs-15 fw-500 lh-25 text-white p-13 px-30 bd-ra-12 bg-primary-color">
                                <i class="fas fa-home me-2"></i> {{ __('Back to Home') }}
                            </a>
                            <a href="{{ route('donation.index') }}"
                                class="d-inline-flex justify-content-center align-items-center fs-15 fw-500 lh-25 text-707070 p-13 px-30 bd-ra-12 bg-f5f5f5">
                                <i class="fas fa-heart me-2"></i> {{ __('Donate Again') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Success Message -->
@endsection