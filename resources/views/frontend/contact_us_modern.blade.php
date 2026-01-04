@extends('frontend.layouts.modern')

@push('title')
    {{ $pageTitle }}
@endpush

@section('content')
    <!-- Header -->
    <div class="relative bg-maroon-900 py-24 px-4 sm:px-6 lg:px-8 overflow-hidden text-center">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-maroon-900 to-secondary opacity-90"></div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl mb-4">
                {{ __('Get in Touch') }}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gold-100 font-sans">
                {{ __('Have questions or suggestions? We\'d love to hear from you.') }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-10 relative z-10">
        <div class="bg-white rounded-sm shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <!-- Contact Info Sidebar -->
            <div class="bg-maroon-800 p-10 md:w-2/5 text-white flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-serif font-bold mb-6">Contact Information</h3>
                    <p class="text-gold-100 mb-8 leading-relaxed font-sans">Fill up the form and our team will get back to
                        you within
                        24 hours.</p>

                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-maroon-700 flex items-center justify-center flex-shrink-0 border border-maroon-600">
                                <i class="fas fa-phone-alt text-gold-400"></i>
                            </div>
                            <div>
                                <p class="text-gold-200 text-xs uppercase font-bold">Phone</p>
                                <p class="font-bold text-lg font-sans">{{ getOption('app_contact_number') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-maroon-700 flex items-center justify-center flex-shrink-0 border border-maroon-600">
                                <i class="fas fa-envelope text-gold-400"></i>
                            </div>
                            <div>
                                <p class="text-gold-200 text-xs uppercase font-bold">Email</p>
                                <p class="font-bold text-lg font-sans">{{ getOption('app_email') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-maroon-700 flex items-center justify-center flex-shrink-0 border border-maroon-600">
                                <i class="fas fa-map-marker-alt text-gold-400"></i>
                            </div>
                            <div>
                                <p class="text-gold-200 text-xs uppercase font-bold">Address</p>
                                <p class="font-bold text-lg font-sans">{{ getOption('app_address') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="mt-12">
                    <h4 class="font-bold mb-4 font-serif text-lg">Follow Us</h4>
                    <div class="flex gap-4">
                        @if(getOption('facebook_link'))
                            <a href="{{ getOption('facebook_link') }}"
                                class="w-10 h-10 rounded-full bg-maroon-700 hover:bg-white hover:text-maroon-800 flex items-center justify-center transition-all border border-maroon-600"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endif
                        @if(getOption('twitter_link'))
                            <a href="{{ getOption('twitter_link') }}"
                                class="w-10 h-10 rounded-full bg-maroon-700 hover:bg-white hover:text-maroon-800 flex items-center justify-center transition-all border border-maroon-600"><i
                                    class="fab fa-twitter"></i></a>
                        @endif
                        @if(getOption('linkedin_link'))
                            <a href="{{ getOption('linkedin_link') }}"
                                class="w-10 h-10 rounded-full bg-maroon-700 hover:bg-white hover:text-maroon-800 flex items-center justify-center transition-all border border-maroon-600"><i
                                    class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if(getOption('instagram_link'))
                            <a href="{{ getOption('instagram_link') }}"
                                class="w-10 h-10 rounded-full bg-maroon-700 hover:bg-white hover:text-maroon-800 flex items-center justify-center transition-all border border-maroon-600"><i
                                    class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="p-10 md:w-3/5">
                <form action="{{ route('contact_us.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2 font-sans">Full Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full px-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-maroon-600 focus:bg-white focus:ring-0 transition-colors"
                            placeholder="John Doe" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2 font-sans">Email
                            Address</label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-maroon-600 focus:bg-white focus:ring-0 transition-colors"
                            placeholder="john@example.com" required>
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-bold text-gray-700 mb-2 font-sans">Subject</label>
                        <input type="text" name="subject" id="subject"
                            class="w-full px-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-maroon-600 focus:bg-white focus:ring-0 transition-colors"
                            placeholder="How can we help?" required>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-bold text-gray-700 mb-2 font-sans">Message</label>
                        <textarea name="message" id="message" rows="4"
                            class="w-full px-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-maroon-600 focus:bg-white focus:ring-0 transition-colors"
                            placeholder="Write your message here..." required></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-maroon-700 hover:bg-maroon-800 text-white font-bold rounded-sm shadow-lg transition-all transform hover:-translate-y-1 font-serif">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Map Section (Optional) -->
    <div class="h-96 w-full grayscale contrast-125 filter">
        <iframe
            src="https://maps.google.com/maps?q={{ getOption('app_location_latitude') }},{{ getOption('app_location_longitude') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
    </div>
@endsection