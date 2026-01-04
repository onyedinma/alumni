@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="bg-maroon-900 py-20 px-4 text-center">
        <h1 class="text-4xl font-serif font-extrabold text-white mb-4">{{ __('Membership Plans') }}</h1>
        <p class="text-xl text-gold-100 max-w-2xl mx-auto font-sans">
            {{ __('Choose the plan that suits you best and enjoy exclusive benefits.') }}
        </p>
    </div>

    <!-- Pricing Tables -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($all_membership as $plan)
                <div
                    class="relative bg-white rounded-sm shadow-xl border border-gray-100 p-8 flex flex-col hover:scale-105 transition-transform duration-300 hover:border-gold-300 hover:shadow-2xl">
                    @if($plan->badge)
                        <div class="absolute top-0 right-0 transform translate-x-2 -translate-y-2">
                            <span
                                class="inline-block bg-gradient-to-r from-gold-500 to-maroon-600 text-white text-xs font-bold px-3 py-1 rounded-sm shadow-lg font-sans uppercase tracking-wider">
                                {{ $plan->badge }}
                            </span>
                        </div>
                    @endif

                    <h3 class="text-2xl font-serif font-bold text-gray-900 mb-2">{{ $plan->title }}</h3>
                    <div class="flex items-baseline mb-8">
                        <span class="text-5xl font-extrabold text-maroon-800 fa-dollar-sign font-serif">
                            {{ $plan->price }}
                        </span>
                        <span class="text-gray-500 ml-1 font-sans">/{{ $plan->duration }}</span>
                    </div>

                    <div class="flex-grow space-y-4 mb-8">
                        <p class="text-gray-600 font-sans">{{ $plan->description }}</p>
                        <!-- Feature List Mockup - Adjust based on actual data if available -->
                        <ul class="space-y-3">
                            <li class="flex items-center gap-2 text-gray-600 font-sans">
                                <i class="fas fa-check-circle text-gold-500"></i>
                                <span>Community Access</span>
                            </li>
                            <li class="flex items-center gap-2 text-gray-600 font-sans">
                                <i class="fas fa-check-circle text-gold-500"></i>
                                <span>Event Discounts</span>
                            </li>
                            <!-- Add dynamic features if your model supports them -->
                        </ul>
                    </div>

                    <a href="#"
                        class="block w-full py-4 text-center bg-maroon-700 hover:bg-maroon-800 text-white font-serif font-bold rounded-sm shadow-lg transition-colors">
                        Choose Plan
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection