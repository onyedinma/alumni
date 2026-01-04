@extends('frontend.layouts.modern')

@push('title')
    {{ $title }}
@endpush

@section('content')
    <!-- Header -->
    <div class="relative bg-maroon-900 py-24 px-4 sm:px-6 lg:px-8 overflow-hidden text-center">
        <div class="absolute inset-0 bg-maroon-900/90 mix-blend-multiply"></div>
        <div class="relative max-w-7xl mx-auto">
            <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl mb-4">
                {{ __('Support Our Community') }}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gold-100 font-sans">
                {{ __('Your contributions help us grow and support alumni initiatives.') }}
            </p>
        </div>
    </div>

    <!-- Active Campaigns -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(count($campaigns) > 0)
            <h2 class="text-2xl font-serif font-bold text-gray-900 mb-8 border-l-4 border-gold-500 pl-4">
                {{ __('Featured Campaigns') }}
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($campaigns as $campaign)
                    <div
                        class="bg-white rounded-sm shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 hover:border-gold-300">
                        <div class="h-48 bg-gold-50 relative overflow-hidden">
                            <img src="{{ getFileUrl($campaign->image) }}" alt="{{ $campaign->title }}"
                                class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1 bg-maroon-600 text-white text-xs font-bold rounded-sm uppercase tracking-wider font-sans">Active</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">{{ $campaign->title }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2 font-sans">{{ $campaign->description }}</p>

                            <!-- Progress Bar (Mockup - replace with real data if available) -->
                            <div class="mb-4">
                                <div class="flex justify-between text-xs font-bold mb-1 font-sans">
                                    <span class="text-maroon-700">Raised:
                                        ${{ number_format($campaign->raised_amount ?? 0) }}</span>
                                    <span class="text-gray-400">Goal: ${{ number_format($campaign->goal_amount ?? 10000) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gold-500 h-2 rounded-full"
                                        style="width: {{ min(100, (($campaign->raised_amount ?? 0) / ($campaign->goal_amount ?? 1)) * 100) }}%">
                                    </div>
                                </div>
                            </div>

                            <button onclick="selectCampaign({{ $campaign->id }}, '{{ $campaign->title }}')"
                                class="w-full py-2 bg-gold-50 text-maroon-800 font-bold rounded-sm hover:bg-gold-100 transition-colors font-serif border border-gold-200">
                                Donate to this Campaign
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- General Donation Form -->
        <div class="max-w-2xl mx-auto bg-white rounded-sm shadow-2xl overflow-hidden" id="donationForm">
            <div class="bg-maroon-800 p-8 text-white text-center">
                <h3 class="text-2xl font-serif font-bold mb-2">{{ __('Make a Donation') }}</h3>
                <p class="text-gold-100 font-sans">{{ __('Secure and transparent payment processing.') }}</p>
            </div>

            <div class="p-8 md:p-10">
                <form action="{{ route('donation.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="campaign_id" id="campaign_id" value="">

                    <div id="selectedCampaignAlert"
                        class="hidden bg-gold-50 border border-gold-200 text-maroon-800 px-4 py-3 rounded-sm flex justify-between items-center">
                        <div>
                            <span class="font-bold text-sm uppercase mr-2 font-sans">Campaign:</span>
                            <span id="selectedCampaignName" class="font-medium font-serif"></span>
                        </div>
                        <button type="button" onclick="clearCampaign()" class="text-maroon-500 hover:text-maroon-700"><i
                                class="fas fa-times"></i></button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-sm font-bold text-gray-700 mb-2 font-sans">{{ __('Your Name') }}</label>
                            <input type="text" name="donor_name" value="{{ auth()->user()->name ?? '' }}"
                                class="w-full px-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-gold-500 focus:bg-white focus:ring-0 transition-colors"
                                required>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-bold text-gray-700 mb-2 font-sans">{{ __('Email Address') }}</label>
                            <input type="email" name="donor_email" value="{{ auth()->user()->email ?? '' }}"
                                class="w-full px-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-gold-500 focus:bg-white focus:ring-0 transition-colors"
                                required>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 mb-2 font-sans">{{ __('Donation Amount') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-bold">$</span>
                            </div>
                            <input type="number" name="amount"
                                class="w-full pl-8 pr-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-gold-500 focus:bg-white focus:ring-0 transition-colors font-bold text-lg"
                                placeholder="100.00" min="1" required>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 mb-2 font-sans">{{ __('Message (Optional)') }}</label>
                        <textarea name="message" rows="2"
                            class="w-full px-4 py-3 rounded-sm bg-gray-50 border-gray-200 focus:border-gold-500 focus:bg-white focus:ring-0 transition-colors"
                            placeholder="Leave a message of support..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-maroon-600 hover:bg-maroon-700 text-white font-bold rounded-sm shadow-lg transition-transform transform hover:-translate-y-1 font-serif">
                        Proceed to Payment
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-4 font-sans">
                        <i class="fas fa-lock mr-1"></i>
                        {{ __('Payments are processed securely. We do not store your card details.') }}
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function selectCampaign(id, title) {
            document.getElementById('campaign_id').value = id;
            document.getElementById('selectedCampaignName').innerText = title;
            document.getElementById('selectedCampaignAlert').classList.remove('hidden');
            document.getElementById('donationForm').scrollIntoView({ behavior: 'smooth' });
        }

        function clearCampaign() {
            document.getElementById('campaign_id').value = '';
            document.getElementById('selectedCampaignAlert').classList.add('hidden');
        }
    </script>
@endpush