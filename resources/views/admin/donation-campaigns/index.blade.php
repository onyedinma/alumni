@extends('layouts.app')

@push('title')
    {{$title}}
@endpush

@section('content')
    <!-- Page content area start -->
    <div class="p-30">
        <div>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-16">
                <h4 class="fs-24 fw-500 lh-34 text-black">{{$title}}</h4>
                <a href="{{ route('admin.donation-campaigns.create') }}"
                    class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">
                    <i class="fa fa-plus"></i> {{ __('Create Campaign') }}
                </a>
            </div>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Table -->
                <div class="table-responsive zTable-responsive">
                    <table class="table zTable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div>{{ __('Title') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Beneficiary') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Goal') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Raised') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Progress') }}</div>
                                </th>
                                <th scope="col">
                                    <div>{{ __('Status') }}</div>
                                </th>
                                <th class="w-150 text-center" scope="col">
                                    <div>{{ __('Action') }}</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaigns as $campaign)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($campaign->image_id)
                                                <img src="{{ getFileURL($campaign->image) }}" alt="" class="me-2"
                                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                            @endif
                                            <span>{{ $campaign->title }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $campaign->beneficiary_name ?? '-' }}</td>
                                    <td>{{ $campaign->goal_amount ? showPrice($campaign->goal_amount) : __('No Goal') }}</td>
                                    <td>{{ showPrice($campaign->raised_amount) }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px; min-width: 100px;">
                                            <div class="progress-bar bg-success"
                                                style="width: {{ $campaign->progress_percentage }}%">
                                                {{ $campaign->progress_percentage }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($campaign->status == STATUS_ACTIVE)
                                            <span class="badge bg-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.donation-campaigns.edit', $campaign->id) }}">
                                                        <i class="fa fa-edit me-2"></i>{{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.donation-campaigns.donations', $campaign->id) }}">
                                                        <i class="fa fa-list me-2"></i>{{ __('View Donations') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.donation-campaigns.delete', $campaign->id) }}"
                                                        method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fa fa-trash me-2"></i>{{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <p class="text-muted mb-0">{{ __('No campaigns found') }}</p>
                                        <a href="{{ route('admin.donation-campaigns.create') }}"
                                            class="btn btn-sm btn-primary mt-2">
                                            {{ __('Create First Campaign') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($campaigns->hasPages())
                    <div class="mt-3">
                        {{ $campaigns->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Page content area end -->
@endsection