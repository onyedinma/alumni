@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-extrabold text-gray-900">{{ __('Complete Your Donation') }}</h1>
                <p class="text-gray-500 mt-2">{{ __('Thank you for your generosity.') }}</p>
            </div>

            <div class="bg-white rounded-sm shadow-xl overflow-hidden">
                <div class="bg-maroon-800 p-8 text-white flex justify-between items-center">
                    <div>
                        <p class="text-gold-100 text-sm uppercase font-bold font-sans">Total Donation</p>
                        <h2 class="text-4xl font-serif font-extrabold">{{ getCurrencySymbol() }}
                            {{ number_format($price, 2) }}</h2>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center text-2xl text-gold-200">
                        <i class="fas fa-heart"></i>
                    </div>
                </div>

                <div class="p-8 md:p-10">
                    <form action="{{ route('donation.pay') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">

                        <h3 class="text-xl font-bold text-gray-900 mb-6">{{ __('Select Payment Method') }}</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                            @foreach($gateways as $gateway)
                                <label
                                    class="relative flex items-center p-4 border rounded-sm cursor-pointer hover:bg-gold-50 hover:border-gold-500 transition-all group">
                                    <input type="radio" name="gateway_id" value="{{ $gateway->id }}"
                                        class="peer h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300" required>
                                    <div class="ml-4 flex items-center justify-between w-full">
                                        <span
                                            class="font-bold text-gray-700 peer-checked:text-maroon-800 font-sans">{{ $gateway->title }}</span>
                                        <img src="{{ getFileUrl($gateway->image) }}" alt="{{ $gateway->title }}"
                                            class="h-8 max-w-[60px] object-contain grayscale group-hover:grayscale-0 peer-checked:grayscale-0 transition-all">
                                    </div>
                                    <div
                                        class="absolute inset-0 border-2 border-transparent peer-checked:border-gold-500 rounded-sm pointer-events-none">
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-maroon-600 hover:bg-maroon-700 text-white font-serif font-bold rounded-sm shadow-lg transition-transform transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <span>Pay Securely</span> <i class="fas fa-lock text-sm"></i>
                        </button>

                        <div class="mt-6 text-center">
                            <a href="{{ route('donation.index') }}"
                                class="text-gray-500 hover:text-gray-900 font-medium text-sm">Cancel and Return</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection