@extends('layouts.app')
@push('title')
    {{$title}}
@endpush

@section('content')
    <style>
        /* Premium Job Post Section */
        .create-job-section {
            background: var(--bg-primary, #0B0E11);
            padding: 40px 0;
            min-height: 100vh;
        }

        /* Premium Card with Gold/Red Glow */
        .premium-job-card {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Top Border Gradient */
        .premium-job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
            border-radius: 24px 24px 0 0;
        }

        /* Headings */
        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--gold, #D4AF5A);
            margin-bottom: 30px;
        }

        /* Labels */
        .premium-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary, #E6EAF0);
            margin-bottom: 8px;
        }

        .premium-label .label-icon {
            color: var(--gold, #D4AF5A);
            font-size: 16px;
        }

        .text-required {
            color: var(--maroon, #8B2635);
        }

        /* Input Fields */
        .premium-input,
        .premium-select {
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 12px;
            padding: 12px 16px;
            color: var(--text-primary, #E6EAF0);
            font-size: 14px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .premium-input:focus,
        .premium-select:focus {
            outline: none;
            border-color: var(--gold, #D4AF5A);
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.1);
        }

        .premium-input::placeholder {
            color: var(--text-disabled, #5E6675);
        }

        /* Textarea */
        .note-editor {
            background: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 12px !important;
        }

        .note-editing-area .note-editable {
            background: var(--bg-primary, #0B0E11) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        /* Submit Button */
        .btn-premium-gold {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%);
            color: #000000;
            border: none;
            border-radius: 12px;
            padding: 13px 50px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(212, 175, 90, 0.3);
        }

        .btn-premium-gold:hover {
            background: linear-gradient(135deg, #e3c16e 0%, #c4a159 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(212, 175, 90, 0.4);
            color: #000000;
        }

        .text-mime-type {
            color: var(--text-secondary, #B4BCC8);
            font-size: 12px;
        }
    </style>

    <div class="create-job-section">
        <div class="container">
            <h4 class="form-title"><i class="fa-solid fa-briefcase"
                    style="color: var(--gold, #D4AF5A); margin-right: 12px;"></i>{{$title}}</h4>
            <div class="premium-job-card">
                <input type="hidden" id="my-job-post-route" value="{{ route('jobPost.create') }}">
                <form class="ajax reset" data-handler="commonResponseRedirect"
                    data-redirect-url="{{route('jobPost.my-job-post')}}" action="{{ route('jobPost.add-new-job-post') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="max-w-840">
                        <div class="row rg-25">
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="jobCreateTitle" class="premium-label">
                                            <i class="fa-solid fa-heading label-icon"></i>
                                            {{__('Job Title')}} <span class="text-required">*</span>
                                        </label>
                                        <input type="text" name="title" class="premium-input" id="title"
                                            placeholder="{{ __('Title') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="employeeStatus" class="premium-label">
                                            <i class="fa-solid fa-user-tie label-icon"></i>
                                            {{__('Employee Status')}} <span class="text-required">*</span>
                                        </label>
                                        <select class="premium-select sf-select-without-search" name="employee_status"
                                            id="employeeStatus">
                                            @foreach (getEmployeeStatus() as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="jobCompensationBenefits" class="premium-label">
                                            <i class="fa-solid fa-gift label-icon"></i>
                                            {{__('Compensation & Benefits')}} <span class="text-required">*</span>
                                        </label>
                                        <input type="text" name="compensation_n_benefits" class="premium-input"
                                            id="compensation_n_benefits" placeholder="{{ __('As per company policy') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="jobUploadCompanyLogo" class="premium-label">
                                            <i class="fa-solid fa-image label-icon"></i>
                                            {{__('Upload Company Logo')}}
                                            <span class="text-mime-type">(jpg,jpeg,png)</span> <span
                                                class="text-required">*</span>
                                        </label>
                                        <input type="file" name="company_logo" class="premium-input" id="company_logo" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="jobSalary" class="premium-label">
                                            <i class="fa-solid fa-dollar-sign label-icon"></i>
                                            {{__('Salary')}} <span class="text-required">*</span>
                                        </label>
                                        <input type="text" name="salary" class="premium-input" id="salary"
                                            placeholder="$45k" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="jobLocation" class="premium-label">
                                            <i class="fa-solid fa-location-dot label-icon"></i>
                                            {{__('Location')}} <span class="text-required">*</span>
                                        </label>
                                        <input type="text" name="location" class="premium-input" id="location"
                                            placeholder="{{ __('Location') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="application_deadline" class="premium-label">
                                            <i class="fa-solid fa-calendar-days label-icon"></i>
                                            {{__('Application Deadline')}} <span class="text-required">*</span>
                                        </label>
                                        <input type="datetime-local" class="premium-input" id="application_deadline"
                                            name="application_deadline" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="jobURL" class="premium-label">
                                            <i class="fa-solid fa-link label-icon"></i>
                                            {{__('URL')}} <span class="text-required">*</span>
                                        </label>
                                        <input type="text" name="post_link" class="premium-input" id="post_link"
                                            placeholder="{{ __('Apply Url') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="job_context" class="premium-label">
                                            <i class="fa-solid fa-align-left label-icon"></i>
                                            {{__('Job Context')}} <span class="text-required">*</span>
                                        </label>
                                        <textarea class="summernoteOne" name="job_context" id="job_context"
                                            placeholder="{{ __('Write Job Context') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="job_responsibility" class="premium-label">
                                            <i class="fa-solid fa-list-check label-icon"></i>
                                            {{__('Job Responsibility')}} <span class="text-required">*</span>
                                        </label>
                                        <textarea class="summernoteOne" name="job_responsibility" id="job_responsibility"
                                            placeholder="{{ __('Write Job Responsibility') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="educational_requirements" class="premium-label">
                                            <i class="fa-solid fa-graduation-cap label-icon"></i>
                                            {{__('Educational Requirements')}} <span class="text-required">*</span>
                                        </label>
                                        <textarea class="summernoteOne" name="educational_requirements"
                                            id="educational_requirements"
                                            placeholder="{{ __('Write Educational Requirements') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="primary-form-group">
                                    <div class="primary-form-group-wrap">
                                        <label for="additional_requirements" class="premium-label">
                                            <i class="fa-solid fa-plus-circle label-icon"></i>
                                            {{__('Additional Requirements')}}
                                        </label>
                                        <textarea class="summernoteOne" name="additional_requirements"
                                            id="additional_requirements"
                                            placeholder="{{ __('Write Additional Requirements') }}"> </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex cg-10">
                                    <button type="submit" name="status" value="pending"
                                        class="btn-premium-gold">{{__('Post')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('alumni/js/job_post.js') }}"></script>
@endpush