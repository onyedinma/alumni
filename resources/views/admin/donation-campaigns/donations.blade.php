@extends('layouts.app')

@push('title')
    {{$title}}
@endpush

@section('content')
    <!-- Page content area start -->
    <div class="p-30">
        <div>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <div>
                    <h4 class="fs-24 fw-500 lh-34 text-black">{{ $campaign->title }} - {{ __('Donations') }}</h4>
                    <p class="text-muted mb-0">{{ __('Total Raised:') }} <strong
                            class="text-success">{{ showPrice($campaign->raised_amount) }}</strong></p>
                </div>
                <a href="{{ route('admin.donation-campaigns.index') }}"
                    class="py-10 px-26 bg-f5f5f5 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">
                    <i class="fa fa-arrow-left"></i> {{ __('Back to Campaigns') }}
                </a>
            </div>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div>{{ __('Date') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Donor Name') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Email') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Amount') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Message') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Status') }}</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr>
                                    <td>{{ $donation->created_at->format('M d, Y H:i') }}</td>
                                    <td>{{ $donation->donor_name }}</td>
                                    <td>{{ $donation->donor_email }}</td>
                                    <td><strong class="text-success">{{ showPrice($donation->amount) }}</strong></td>
                                    <td>{{ Str::limit($donation->message, 50) ?? '-' }}</td>
                                    <td>
                                        @if($donation->status == 1)
                                            <span class="badge bg-success">{{ __('Completed') }}</span>
                                        @elseif($donation->status == 0)
                                            <span class="badge bg-warning">{{ __('Pending') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('Failed') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted mb-0">{{ __('No donations yet for this campaign') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($donations->hasPages())
                    <div class="mt-3">
                        {{ $donations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Page content area end -->
@endsection