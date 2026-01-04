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
                <a href="{{ route('admin.donation-campaigns.index') }}"
                    class="py-10 px-26 bg-f5f5f5 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">
                    <i class="fa fa-arrow-left"></i> {{ __('Back to List') }}
                </a>
            </div>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <form action="{{ route('admin.donation-campaigns.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="primary-form-group mt-2">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Campaign Title') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="primary-form-control" name="title" value="{{ old('title') }}"
                                        required>
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="primary-form-group mt-2">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <select class="primary-form-control sf-select-without-search" name="status">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="primary-form-group mt-4">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Description') }}</label>
                                    <textarea class="primary-form-control" name="description"
                                        rows="4">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group mt-4">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Beneficiary Name') }}</label>
                                    <input type="text" class="primary-form-control" name="beneficiary_name"
                                        value="{{ old('beneficiary_name') }}"
                                        placeholder="{{ __('e.g., John Doe (Burial Fund)') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group mt-4">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Goal Amount') }} ({{ getCurrencySymbol() }})</label>
                                    <input type="number" class="primary-form-control" name="goal_amount" step="0.01"
                                        value="{{ old('goal_amount') }}" placeholder="{{ __('Leave empty for no goal') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group mt-4">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Start Date') }}</label>
                                    <input type="date" class="primary-form-control" name="start_date"
                                        value="{{ old('start_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group mt-4">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('End Date') }}</label>
                                    <input type="date" class="primary-form-control" name="end_date"
                                        value="{{ old('end_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group mt-4">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Featured Campaign') }}</label>
                                    <select class="primary-form-control sf-select-without-search" name="is_featured">
                                        <option value="0">{{ __('No') }}</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="primary-form-group mt-4">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Campaign Image') }}</label>
                                    <input type="file" class="primary-form-control" name="image" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="py-10 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">
                            {{ __('Create Campaign') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Page content area end -->
@endsection