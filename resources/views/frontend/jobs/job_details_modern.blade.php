@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen pb-20">
        <div class="bg-maroon-900 pb-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="w-24 h-24 bg-white rounded-sm p-4 flex items-center justify-center shadow-lg">
                        <img src="{{ getFileUrl($jobPostData->company_logo) }}" alt="{{ $jobPostData->company_name }}"
                            class="w-full h-full object-contain">
                    </div>
                    <div class="text-center md:text-left text-white">
                        <h1 class="text-3xl font-serif font-bold mb-2">{{ $jobPostData->title }}</h1>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 text-gold-100 font-sans">
                            <span class="font-medium text-white">{{ $jobPostData->company_name }}</span>
                            <span>•</span>
                            <span>{{ $jobPostData->location }}</span>
                            <span>•</span>
                            <span>{{ $jobPostData->job_type }}</span>
                        </div>
                    </div>
                    <div class="md:ml-auto mt-4 md:mt-0">
                        @if($jobPostData->application_deadline > now())
                            <a href="{{ $jobPostData->application_link }}" target="_blank"
                                class="px-8 py-3 bg-white text-maroon-900 font-serif font-bold rounded-sm shadow hover:bg-gray-100 transition-colors">
                                Apply Now
                            </a>
                        @else
                            <span
                                class="px-8 py-3 bg-red-800 text-white font-serif font-bold rounded-sm cursor-not-allowed border border-red-700">
                                Application Closed
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Job Description</h3>
                        <div class="prose prose-blue max-w-none text-gray-600">
                            {!! $jobPostData->description !!}
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Responsibilities</h3>
                        <div class="prose prose-blue max-w-none text-gray-600">
                            {!! $jobPostData->responsibilities !!}
                        </div>
                    </div>

                    <div class="bg-white rounded-sm shadow-lg p-8">
                        <h3 class="text-xl font-serif font-bold text-gray-900 mb-4 border-b pb-2">Requirements</h3>
                        <div class="prose prose-red max-w-none text-gray-600 font-sans">
                            {!! $jobPostData->requirements !!}
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-sm shadow-lg p-6">
                        <h3 class="font-serif font-bold text-gray-900 mb-6">Job Overview</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gold-50 flex items-center justify-center text-maroon-600 flex-shrink-0">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold font-sans">Salary</p>
                                    <p class="font-bold text-gray-900 font-sans">{{ $jobPostData->salary }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gold-50 flex items-center justify-center text-maroon-600 flex-shrink-0">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold font-sans">Posted Date</p>
                                    <p class="font-bold text-gray-900 font-sans">
                                        {{ \Carbon\Carbon::parse($jobPostData->created_at)->format('M d, Y') }}
                                    </p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-gold-50 flex items-center justify-center text-maroon-600 flex-shrink-0">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold font-sans">Deadline</p>
                                    <p class="font-bold text-gray-900 text-maroon-500 font-sans">
                                        {{ \Carbon\Carbon::parse($jobPostData->deadline)->format('M d, Y') }}
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection