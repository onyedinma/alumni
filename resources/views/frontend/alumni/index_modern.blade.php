@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="relative bg-maroon-900 py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset(getFileUrl(getOption('about_us_background_breadcrumb'))) }}" alt=""
                class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-maroon-900 to-maroon-800 opacity-90 mix-blend-multiply">
            </div>
        </div>
        <div class="relative max-w-7xl mx-auto text-center">
            <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                {{ __('Our Alumni') }}
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gold-100 font-sans">
                {{ __('Connect with fellow graduates and explore our growing community.') }}
            </p>
        </div>
    </div>

    <!-- Alumni Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($allAlumni))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($allAlumni as $alumni)
                    <div
                        class="group relative bg-white rounded-sm shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="aspect-w-3 aspect-h-4 bg-gray-200">
                            <img src="{{ getFileUrl($alumni->image) }}" alt="{{ $alumni->name }}"
                                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-90"></div>

                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <h3 class="text-xl font-serif font-bold text-white mb-1">{{ $alumni->name }}</h3>
                            <p class="text-gold-200 text-sm font-medium mb-0.5 font-sans">{{ $alumni->department_name }}</p>
                            <p class="text-gray-300 text-xs uppercase tracking-wider font-sans">{{ __('Batch') }}
                                {{ $alumni->batch_name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $allAlumni->links() }}
                <!-- Note: Default pagination styles might need Tailwind customization or publishing vendor views -->
            </div>
        @else
            <div class="text-center py-20">
                <div
                    class="w-24 h-24 bg-blue-50 text-blue-300 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ __('No Alumni Found') }}</h3>
                <p class="text-gray-500 mt-2">{{ __('We are building our community. Check back soon!') }}</p>
            </div>
        @endif
    </div>
@endsection