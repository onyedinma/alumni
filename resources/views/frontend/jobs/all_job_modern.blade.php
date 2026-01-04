@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="relative bg-maroon-900 py-24 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0 bg-maroon-900/90 mix-blend-multiply"></div>
        <div class="relative max-w-7xl mx-auto text-center">
            <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl mb-4">
                {{ __('Career Opportunities') }}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gold-100 font-sans">
                {{ __('Find your next career move within our alumni network.') }}
            </p>
        </div>
    </div>

    <!-- Jobs List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($allJob))
            <div class="space-y-6">
                @foreach($allJob as $job)
                    <div
                        class="bg-white rounded-sm shadow-lg border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:border-gold-300">
                        <div
                            class="flex-shrink-0 w-full sm:w-32 h-32 bg-gray-50 rounded-sm overflow-hidden flex items-center justify-center p-4 border border-gray-100">
                            <img src="{{ getFileUrl($job->company_logo) }}" alt="{{ $job->title }}"
                                class="w-full h-full object-contain">
                        </div>

                        <div class="flex-grow w-full text-center sm:text-left">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                <h3
                                    class="text-xl font-serif font-bold text-gray-900 group-hover:text-maroon-700 transition-colors">
                                    <a href="{{ route('job.view.details', $job->slug) }}">
                                        {{ $job->title }}
                                    </a>
                                </h3>
                                @if($job->job_type)
                                    <span
                                        class="inline-block px-2 py-0.5 bg-gold-50 text-maroon-700 text-xs font-bold rounded-sm uppercase tracking-wider mx-auto sm:mx-0 font-sans">
                                        {{ $job->job_type }}
                                    </span>
                                @endif
                            </div>

                            <p class="text-gray-600 font-medium mb-3 font-sans">{{ $job->company_name }}</p>

                            <div class="flex flex-wrap justify-center sm:justify-start gap-4 text-sm text-gray-500 mb-4 font-sans">
                                <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-gold-500"></i>
                                    {{ $job->location }}</span>
                                <span class="flex items-center gap-1"><i class="far fa-clock text-gold-500"></i> Posted
                                    {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span>
                                <span class="flex items-center gap-1"><i class="fas fa-money-bill-wave text-gold-500"></i>
                                    {{ $job->salary }}</span>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-full sm:w-auto">
                            <a href="{{ route('job.view.details', $job->slug) }}"
                                class="block w-full text-center px-6 py-3 bg-maroon-700 hover:bg-maroon-800 text-white font-bold rounded-sm shadow transition-colors font-serif">
                                Apply Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $allJob->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-3xl">
                <div
                    class="w-20 h-20 bg-blue-100 text-blue-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ __('No Jobs Found') }}</h3>
                <p class="text-gray-500 mt-2">{{ __('Check back later for new career opportunities.') }}</p>
            </div>
        @endif
    </div>
@endsection