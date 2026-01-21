@extends('layouts.app')
@push('title')
    {{ __('Profile') }}
@endpush
@section('content')
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __('Profile') }}</h4>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <!-- Tab List -->
                <ul class="nav nav-tabs zTabHead" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="true">{{ __('Profile') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="editProfile-tab" data-bs-toggle="tab"
                            data-bs-target="#editProfile-tab-pane" type="button" role="tab"
                            aria-controls="editProfile-tab-pane" aria-selected="false">{{ __('Edit Profile') }}</button>
                    </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content zTabContent" id="myTabContent">
                    <!-- Profile -->
                    <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel"
                        aria-labelledby="profile-tab" tabindex="0">
                        <!-- User Photo ~ Social link -->
                        <div class="pt-30 pb-40 d-flex justify-content-between align-items-center flex-wrap rg-30">
                            <!-- User Photo ~ name -->
                            <div class="d-flex align-items-center flex-wrap g-18">

                                <div class="flex-shrink-0 w-110 h-110 rounded-circle overflow-hidden bd-three bd-c-cdef84">
                                    <img class="w-100" src="{{ asset(getFileUrl($user->image)) }}"
                                        alt="{{ $user->name }}" />
                                </div>

                                <div class="">
                                    <h4 class="fs-24 fs-sm-20 fw-500 lh-34 text-1b1c17">{{ $user->name }}</h4>
                                    <p class="fs-14 fw-400 lh-17 text-707070 pb-10">
                                        {{ $user->alumni?->company_designation }}
                                    </p>
                                </div>
                            </div>
                            <!-- Social Link -->
                            <ul class="d-flex align-items-center cg-7">
                                @if ($user->alumni?->facebook_url != null && $user->alumni?->facebook_url != '')
                                    <li>
                                        <a target="__blank" href="{{ $user->alumni?->facebook_url }}"
                                            class="d-flex justify-content-center align-items-center w-48 h-48 rounded-circle bd-one bd-c-ededed bg-fafafa hover-bg-two hover-border-one"><img
                                                src="{{ asset('assets/images/icon/facebook.svg') }}" alt="" /></a>
                                    </li>
                                @endif
                                @if ($user->alumni?->twitter_url != null && $user->alumni?->twitter_url != '')
                                    <li>
                                        <a target="__blank" href="{{ $user->alumni?->twitter_url }}"
                                            class="d-flex justify-content-center align-items-center w-48 h-48 rounded-circle bd-one bd-c-ededed bg-fafafa hover-bg-two hover-border-one"><img
                                                src="{{ asset('assets/images/icon/twitter.svg') }}" alt="" /></a>
                                    </li>
                                @endif
                                @if ($user->alumni?->linkedin_url != null && $user->alumni?->linkedin_url != '')
                                    <li>
                                        <a target="__blank" href="{{ $user->alumni?->linkedin_url }}"
                                            class="d-flex justify-content-center align-items-center w-48 h-48 rounded-circle bd-one bd-c-ededed bg-fafafa hover-bg-two hover-border-one"><img
                                                src="{{ asset('assets/images/icon/linkedin.svg') }}" alt="" /></a>
                                    </li>
                                @endif
                                @if ($user->alumni?->instagram_url != null && $user->alumni?->instagram_url != '')
                                    <li>
                                        <a target="__blank" href="{{ $user->alumni?->instagram_url }}"
                                            class="d-flex justify-content-center align-items-center w-48 h-48 rounded-circle bd-one bd-c-ededed bg-fafafa hover-bg-two hover-border-one"><img
                                                src="{{ asset('assets/images/icon/instagram.svg') }}" alt="" /></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <!-- Bio ~ Info -->
                        <div class="row rg-30">
                            <!-- Bio -->
                            <div class="col-lg-8">
                                <div class="py-20 px-25 bd-ra-10 bg-f9f9f9">
                                    <!-- Bio text -->
                                    <div class="pb-25 mb-25 bd-b-one bd-c-ededed">
                                        <div class="section-header">
                                            <div class="icon"><i class="bi bi-person-lines-fill"></i></div>
                                            <h4>{{ __('Profile Bio') }}</h4>
                                        </div>
                                        <p class="fs-14 fw-400 lh-24 text-707070 pb-12">{!! $user->alumni?->about_me !!}</p>
                                    </div>
                                    <!-- Personal Info -->
                                    <ul class="zList-one">
                                        <li>
                                            <i class="bi bi-person-fill bio-icon"></i>
                                            <p>{{ __('Full Name') }} :</p>
                                            <p>{{ $user->name }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-person-badge bio-icon"></i>
                                            <p>{{ __('Nick Name') }} :</p>
                                            <p>{{ $user->nick_name }}</p>
                                        </li>
                                        @if ($user->show_email_in_public == STATUS_SUCCESS)
                                            <li>
                                                <i class="bi bi-envelope-fill bio-icon"></i>
                                                <p>{{ __('Email') }} :</p>
                                                <p>{{ $user->email }}</p>
                                            </li>
                                        @endif
                                        @if ($user->show_phone_in_public == STATUS_SUCCESS)
                                            <li>
                                                <i class="bi bi-telephone-fill bio-icon"></i>
                                                <p>{{ __('Phone') }} :</p>
                                                <p>{{ $user->mobile }}</p>
                                            </li>
                                        @endif
                                        <li>
                                            <i class="bi bi-droplet-fill bio-icon"></i>
                                            <p>{{ __('Blood Group') }} :</p>
                                            <p>{{ $user->alumni?->blood_group }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-calendar-event bio-icon"></i>
                                            <p>{{ __('Date of Birth') }} :</p>
                                            <p>{{ $user->alumni?->date_of_birth }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-building bio-icon"></i>
                                            <p>{{ __('City') }} :</p>
                                            <p> {{ $user->alumni?->city }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-geo bio-icon"></i>
                                            <p>{{ __('State of Residence') }} :</p>
                                            <p> {{ $user->alumni?->state }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-globe bio-icon"></i>
                                            <p>{{ __('Country of Residence') }} :</p>
                                            <p>{{ $user->alumni?->country }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-geo-alt-fill bio-icon"></i>
                                            <p>{{ __('State of Origin') }} :</p>
                                            <p>{{ $user->alumni?->state_of_origin }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-geo bio-icon"></i>
                                            <p>{{ __('LGA of Origin') }} :</p>
                                            <p>{{ $user->alumni?->lga_of_origin }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-signpost-fill bio-icon"></i>
                                            <p>{{ __('Zip Code') }} :</p>
                                            <p>{{ $user->alumni?->zip }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-mortarboard-fill bio-icon"></i>
                                            <p>{{ __('Class of (Year)') }} :</p>
                                            <p>{{ $user->alumni?->passingYear?->name }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-easel-fill bio-icon"></i>
                                            <p>{{ __('First Year Class') }} :</p>
                                            <p>{{ $user->alumni?->firstClass?->name }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-easel-fill bio-icon"></i>
                                            <p>{{ __('Final Year Class') }} :</p>
                                            <p>{{ $user->alumni?->finalClass?->name }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-house-door-fill bio-icon"></i>
                                            <p>{{ __('First House') }} :</p>
                                            <p>{{ $user->alumni?->firstHouse?->name }}</p>
                                        </li>
                                        <li>
                                            <i class="bi bi-house-door-fill bio-icon"></i>
                                            <p>{{ __('Final House') }} :</p>
                                            <p>{{ $user->alumni?->finalHouse?->name }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Info -->
                            <div class="col-lg-4">
                                <div class="py-20 px-30 bd-ra-10 bg-f9f9f9 max-w-503 m-auto">
                                    <div class="pb-25 mb-25 bd-b-one bd-c-ededed">
                                        <div class="section-header">
                                            <div class="icon"><i class="bi bi-mortarboard-fill"></i></div>
                                            <h4>{{ __('Educational Info') }}</h4>
                                        </div>
                                        @forelse ($user->institutions as $institute)
                                            <div class="{{ $loop->last ? '' : 'pb-17' }}">
                                                <p class="fs-14 fw-400 lh-17 text-707070 pb-10">{{ $institute->degree }}
                                                </p>
                                                <ul class="zList-one">
                                                    <li>
                                                        <p>{{ __('Institute') }} :</p>
                                                        <p>{{ $institute->institute }}</p>
                                                    </li>
                                                    <li>
                                                        <p>{{ __('Passing Year') }} :</p>
                                                        <p>{{ $institute->passing_year }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        @empty
                                            <div>
                                                <p class="fs-14 fw-400 lh-17 text-707070 pb-10">
                                                    {{ __('No Educational Info
                                                                                                    Found') }}
                                                </p>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="">
                                        <div class="section-header">
                                            <div class="icon"><i class="bi bi-briefcase-fill"></i></div>
                                            <h4>{{ __('Professional Info') }}</h4>
                                        </div>
                                        <ul class="zList-one">
                                            <li>
                                                <i class="bi bi-briefcase-fill bio-icon"></i>
                                                <p>{{ __('Current Job') }} :</p>
                                                <p>{{ $user->alumni?->current_job }}</p>
                                            </li>
                                            <li>
                                                <i class="bi bi-star-fill bio-icon"></i>
                                                <p>{{ __('Expertise') }} :</p>
                                                <p>{{ $user->alumni?->expertise }}</p>
                                            </li>
                                            <li>
                                                <i class="bi bi-buildings-fill bio-icon"></i>
                                                <p>{{ __('Company Name') }} :</p>
                                                <p>{{ $user->alumni?->company_name ?? $user->alumni?->company }}</p>
                                            </li>
                                            <li>
                                                <i class="bi bi-person-workspace bio-icon"></i>
                                                <p>{{ __('Designation') }} :</p>
                                                <p>{{ $user->alumni?->company_designation }}</p>
                                            </li>
                                            <li>
                                                <i class="bi bi-geo-alt-fill bio-icon"></i>
                                                <p>{{ __('Office Address') }} :</p>
                                                <p>{{ $user->alumni?->work_address ?? $user->alumni?->company_address }}</p>
                                            </li>
                                            @if($user->alumni?->bio)
                                                <li>
                                                    <i class="bi bi-file-text-fill bio-icon"></i>
                                                    <p>{{ __('Portfolio/Bio') }} :</p>
                                                    <p>{!! nl2br(e($user->alumni?->bio)) !!}</p>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Profile -->
                    <div class="tab-pane fade" id="editProfile-tab-pane" role="tabpanel" aria-labelledby="editProfile-tab"
                        tabindex="0">
                        <div class="max-w-840">
                            <form method="POST" class="ajax" data-handler="commonResponseRedirect"
                                data-redirect-url="{{ route('profile') }}" action="{{ route('profile_update') }}">
                                @csrf
                                <!-- Photo -->
                                <div class="pb-40"></div>
                                <!-- Personal Info -->
                                <div class="pb-30">
                                    <div class="section-header">
                                        <div class="icon"><i class="bi bi-person-fill"></i></div>
                                        <h4>{{ __('Personal Info') }}</h4>
                                    </div>
                                    <div class="row rg-25">
                                        <!-- Photo -->
                                        <div class="pb-40">
                                            <div class="upload-img-box profileImage-upload">
                                                <div class="icon"><img src="assets/images/icon/edit-2.svg" alt="" /></div>
                                                <img src="{{ getFileUrl($user->image) }}" />
                                                <input type="file" name="image" id="zImageUpload" accept="image/*,video/*"
                                                    onchange="previewFile(this)" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epPassingYear"
                                                        class="form-label">{{ __('Class of (Year)') }}</label>
                                                    <select class="primary-form-control form-select" id="epPassingYear"
                                                        name="passing_year_id">
                                                        <option value="">{{ __('Select Year') }}</option>
                                                        @foreach($passingYears as $year)
                                                            <option {{ $user->alumni?->passing_year_id == $year->id ? 'selected' : '' }} value="{{ $year->id }}">{{ $year->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epFullName" class="form-label">{{ __('Full Name') }}</label>
                                                    <input type="text" class="primary-form-control" id="epFullName"
                                                        value="{{ $user->name }}" name="name"
                                                        placeholder="{{ __('Your Name') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epNickName" class="form-label">{{ __('Nick Name') }}</label>
                                                    <input type="text" class="primary-form-control" id="epNickName"
                                                        value="{{ $user->nick_name }}" name="nick_name"
                                                        placeholder="{{ __('Your Nick Name') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="blood_group" class="form-label">{{ __('Blood Group') }}<span
                                                            class="text-danger"> *</span></label>
                                                    <select class="primary-form-control form-select" id="blood_group"
                                                        name="blood_group">
                                                        <option {{ $user->alumni?->blood_group == 'O-' ? 'selected' : '' }}
                                                            value="O-">O-</option>
                                                        <option {{ $user->alumni?->blood_group == 'O+' ? 'selected' : '' }}
                                                            value="O+">O+</option>
                                                        <option {{ $user->alumni?->blood_group == 'A−' ? 'selected' : '' }}
                                                            value="A−">A−</option>
                                                        <option {{ $user->alumni?->blood_group == 'A+' ? 'selected' : '' }}
                                                            value="A+">A+</option>
                                                        <option {{ $user->alumni?->blood_group == 'B−' ? 'selected' : '' }}
                                                            value="B−">B−</option>
                                                        <option {{ $user->alumni?->blood_group == 'B+' ? 'selected' : '' }}
                                                            value="B+">B+</option>
                                                        <option {{ $user->alumni?->blood_group == 'AB-' ? 'selected' : '' }}
                                                            value="AB-">AB−</option>
                                                        <option {{ $user->alumni?->blood_group == 'AB+' ? 'selected' : '' }}
                                                            value="AB+">AB+</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="primary-form-group">
                                                <div class="primary-form-group-wrap">
                                                    <label for="epBirthDate" class="form-label">{{ __('Birth Date')
                                                                                }}</label>
                                                    <input type="date" class="primary-form-control"
                                                        value="{{ $user->alumni?->date_of_birth }}" name="date_of_birth"
                                                        id="epBirthDate" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epStateOrigin"
                                                    class="form-label">{{ __('State of Origin') }}</label>
                                                <input type="text" class="primary-form-control"
                                                    value="{{ $user->alumni?->state_of_origin }}" name="state_of_origin"
                                                    id="epStateOrigin" placeholder="{{ __('State of Origin') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epLgaOrigin"
                                                    class="form-label">{{ __('LGA of Origin') }}</label>
                                                <input type="text" class="primary-form-control"
                                                    value="{{ $user->alumni?->lga_of_origin }}" name="lga_of_origin"
                                                    id="epLgaOrigin" placeholder="{{ __('LGA of Origin') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="primary-form-group">
                                            <div class="primary-form-group-wrap">
                                                <label for="epAbout" class="form-label">{{ __('About Me') }}</label>
                                                <textarea class="primary-form-control min-h-180" id="epAbout"
                                                    name="about_me"
                                                    placeholder="{{ __('Type about yourself') }}">{!! $user->alumni?->about_me !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- Class & House Info -->
                        <div class="pb-30">
                            <div class="section-header">
                                <div class="icon"><i class="bi bi-mortarboard-fill"></i></div>
                                <h4>{{ __('Class & House Info') }}</h4>
                            </div>
                            <div class="row rg-25">
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epFirstClass"
                                                class="form-label">{{ __('First Year Class') }}</label>
                                            <select class="primary-form-control form-select" id="epFirstClass"
                                                name="first_class_id">
                                                <option value="">{{ __('Select Class') }}</option>
                                                @foreach($classes as $class)
                                                    <option {{ $user->alumni?->first_class_id == $class->id ? 'selected' : '' }}
                                                        value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epFinalClass"
                                                class="form-label">{{ __('Final Year Class') }}</label>
                                            <select class="primary-form-control form-select" id="epFinalClass"
                                                name="final_class_id">
                                                <option value="">{{ __('Select Class') }}</option>
                                                @foreach($classes as $class)
                                                    <option {{ $user->alumni?->final_class_id == $class->id ? 'selected' : '' }}
                                                        value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epFirstHouse" class="form-label">{{ __('First House') }}</label>
                                            <select class="primary-form-control form-select" id="epFirstHouse"
                                                name="first_house_id">
                                                <option value="">{{ __('Select House') }}</option>
                                                @foreach($houses as $house)
                                                    <option {{ $user->alumni?->first_house_id == $house->id ? 'selected' : '' }}
                                                        value="{{ $house->id }}">{{ $house->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epFinalHouse" class="form-label">{{ __('Final House') }}</label>
                                            <select class="primary-form-control form-select" id="epFinalHouse"
                                                name="final_house_id">
                                                <option value="">{{ __('Select House') }}</option>
                                                @foreach($houses as $house)
                                                    <option {{ $user->alumni?->final_house_id == $house->id ? 'selected' : '' }}
                                                        value="{{ $house->id }}">{{ $house->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Contact Info -->
                        <div class="pb-30">
                            <div class="section-header">
                                <div class="icon"><i class="bi bi-telephone-fill"></i></div>
                                <h4>{{ __('Contact Info') }}</h4>
                            </div>
                            <div class="row rg-25">
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epPhoneNumber" class="form-label">{{ __('Phone Number')
                                                                                }}</label>
                                            <input type="mobile" value="{{ $user->mobile }}" name="mobile"
                                                class="primary-form-control" id="epPhoneNumber"
                                                placeholder="eg: (+880) 1254 8593" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epEmail" class="form-label">{{ __('Personal Email Address')
                                                                                }}</label>
                                            <input type="email" value="{{ $user->email }}" name="email" disabled
                                                class="primary-form-control" id="epEmail"
                                                placeholder="{{ __('Your Email') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epLinkedin" class="form-label">{{ 'Linkedin Url' }}</label>
                                            <input type="url" value="{{ $user->alumni?->linkedin_url }}" name="linkedin_url"
                                                class="primary-form-control" id="epLinkedin"
                                                placeholder="{{ __('Your Linkedin Profile Url') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epFacebook" class="form-label">{{ __('Facebook Url')
                                                                                }}</label>
                                            <input type="url" value="{{ $user->alumni?->facebook_url }}" name="facebook_url"
                                                class="primary-form-control" id="epFacebook"
                                                placeholder="{{ __('Your Facebook Profile Url') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epTwitter" class="form-label">{{ __('Twitter Url')
                                                                                }}</label>
                                            <input type="url" value="{{ $user->alumni?->twitter_url }}" name="twitter_url"
                                                class="primary-form-control" id="epTwitter"
                                                placeholder="{{ __('Your Twitter Profile Url') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epInstagram" class="form-label">{{ __('Instagram Url')
                                                                                }}</label>
                                            <input type="url" value="{{ $user->alumni?->instagram_url }}"
                                                name="instagram_url" class="primary-form-control" id="epInstagram"
                                                placeholder="{{ __('Your Instagram Profile Url') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Educational Info -->
                        <div class="pb-30" id="education-parent">
                            <div class="d-flex flex-column {{ count($user->institutions) ? 'rg-30' : '' }}">
                                @forelse ($user->institutions as $institute)
                                    <div class="education-item">
                                        <input type="hidden" name="institution[id][]" value="{{ $institute->id }}">
                                        @if ($loop->first)
                                                                <div class="d-flex justify-content-between align-items-center flex-wrap g-10 pb-20">
                                                                    <h4 class="fs-18 fw-500 lh-22 text-1b1c17">
                                                                        {{ __('Educational Info') }}
                                                                    </h4>
                                                                    <div class="d-flex align-items-center cg-16">
                                                                        <button type="button"
                                                                            class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-1b1c17 text-decoration-underline hover-color-one"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#addMoreModal">{{ __('+Add
                                                                                                                                                                                                                                                                                                            More') }}</button>
                                                                        <button type="button"
                                                                            class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-ed0006 text-decoration-underline hover-color-one delete-education">{{
                                            __('Delete') }}</button>
                                                                    </div>
                                                                </div>
                                        @else
                                                                <div class="d-flex justify-content-end align-items-center flex-wrap g-10 pb-20">
                                                                    <div class="d-flex align-items-center cg-16">
                                                                        <button type="button"
                                                                            class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-ed0006 text-decoration-underline hover-color-one delete-education">{{
                                            __('Delete') }}</button>
                                                                    </div>
                                                                </div>
                                        @endif
                                        <div class="row rg-25">
                                            <div class="col-md-6">
                                                <div class="primary-form-group">
                                                    <div class="primary-form-group-wrap">
                                                        <label for="epDegree" class="form-label">{{ __('Degree')
                                                                                                                    }}</label>
                                                        <input type="text" value="{{ $institute->degree }}"
                                                            name="institution[degree][]"
                                                            class="institution-degree primary-form-control" id="epDegree"
                                                            placeholder="{{ __('Your Degree') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="primary-form-group">
                                                    <div class="primary-form-group-wrap">
                                                        <label for="epPassingYear"
                                                            class="form-label">{{ __('Passing
                                                                                                                    Year') }}</label>
                                                        <input type="text" value="{{ $institute->passing_year }}"
                                                            name="institution[passing_year][]"
                                                            class="institution-passing_year primary-form-control"
                                                            id="epPassingYear" placeholder="{{ __('Passing Year') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="primary-form-group">
                                                    <div class="primary-form-group-wrap">
                                                        <label for="epInstitute" class="form-label">{{ __('Institute')
                                                                                                                    }}</label>
                                                        <input type="text" value="{{ $institute->institute }}"
                                                            name="institution[institute][]"
                                                            class="institution-institute primary-form-control" id="epInstitute"
                                                            placeholder="{{ __('Your Institution') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="d-flex justify-content-between align-items-center flex-wrap g-10 pb-20">
                                        <h4 class="fs-18 fw-500 lh-22 text-1b1c17">{{ __('Educational Info') }}
                                        </h4>
                                        <div class="d-flex align-items-center cg-16">
                                            <button type="button"
                                                class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-1b1c17 text-decoration-underline hover-color-one"
                                                data-bs-toggle="modal" data-bs-target="#addMoreModal">{{ __('+Add New')
                                                                                                        }}</button>
                                        </div>
                                    </div>
                                    <div class="">
                                        <span>{{ __('No Educational Info Found') }}</span>
                                    </div>
                                @endforelse
                            </div>
                            <div id="education-child-empty" class="d-none d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center flex-wrap g-10 pb-20">
                                    <h4 class="fs-18 fw-500 lh-22 text-1b1c17">{{ __('Educational Info') }}</h4>
                                    <div class="d-flex align-items-center cg-16">
                                        <button type="button"
                                            class="border-0 p-0 bg-transparent fs-14 fw-500 lh-17 text-1b1c17 text-decoration-underline hover-color-one"
                                            data-bs-toggle="modal" data-bs-target="#addMoreModal">{{ __('+Add New')
                                                                            }}</button>
                                    </div>
                                </div>
                                <div class="">
                                    <span>{{ __('No Educational Info Found') }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Professional Info -->
                        <div class="pb-30">
                            <div class="section-header">
                                <div class="icon"><i class="bi bi-briefcase-fill"></i></div>
                                <h4>{{ __('Professional Info') }}</h4>
                            </div>
                            <div class="row rg-25">
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epCurrentJob"
                                                class="form-label">{{ __('Current Job/Business') }}</label>
                                            <input type="text" value="{{ $user->alumni?->current_job }}" name="current_job"
                                                class="primary-form-control" id="epCurrentJob"
                                                placeholder="{{ __('Your Current Job') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epExpertise" class="form-label">{{ __('Expertise/Field') }}</label>
                                            <input type="text" value="{{ $user->alumni?->expertise }}" name="expertise"
                                                class="primary-form-control" id="epExpertise"
                                                placeholder="{{ __('Your Expertise') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epCompanyName" class="form-label">{{ __('Company Name')
                                                                                }}</label>
                                            <input type="text"
                                                value="{{ $user->alumni?->company_name ?? $user->alumni?->company }}"
                                                name="company_name" class="primary-form-control" id="epCompanyName"
                                                placeholder="{{ __('your Company') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epDesignation" class="form-label">{{ __('Designation')
                                                                                }}</label>
                                            <input type="text" value="{{ $user->alumni?->company_designation }}"
                                                name="company_designation" class="primary-form-control" id="epDesignation"
                                                placeholder="{{ __('Your Current Designation') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epWorkAddress" class="form-label">{{ __('Work Address') }}</label>
                                            <input type="text"
                                                value="{{ $user->alumni?->work_address ?? $user->alumni?->company_address }}"
                                                name="work_address" class="primary-form-control" id="epWorkAddress"
                                                placeholder="{{ __('Your Work/Company Address') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epBio" class="form-label">{{ __('Portfolio/Bio') }}</label>
                                            <textarea class="primary-form-control min-h-120" style="min-height: 120px;"
                                                id="epBio" name="bio"
                                                placeholder="{{ __('Your Professional Bio / Portfolio') }}">{{ $user->alumni?->bio }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="pb-30">
                            <div class="section-header">
                                <div class="icon"><i class="bi bi-geo-alt-fill"></i></div>
                                <h4>{{ __('Address') }}</h4>
                            </div>
                            <div class="row rg-25">
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epCity" class="form-label">{{ __('City') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="primary-form-control"
                                                value="{{ $user->alumni?->city }}" name="city" id="epCity"
                                                placeholder="{{ __('Current Company City') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epState" class="form-label">{{ __('State of Residence') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="primary-form-control"
                                                value="{{ $user->alumni?->state }}" name="state" id="epState"
                                                placeholder="{{ __('Current Company State') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epCountry" class="form-label">{{ __('Country of Residence') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->alumni?->country }}" name="country"
                                                class="primary-form-control" id="epCountry"
                                                placeholder="{{ __('Current Company Country') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epZipCode" class="form-label">{{ __('Zip Code') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->alumni?->zip }}" name="zip"
                                                class="primary-form-control" id="epZipCode"
                                                placeholder="{{ __('Current Company Zip Code') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epAddress" class="form-label">{{ __('Address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->alumni?->address }}" name="address"
                                                class="primary-form-control" id="epAddress"
                                                placeholder="{{ __('Current Company Address') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="py-13 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{
        __('Save Changes') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Add More Modal -->
    <div class="modal fade zModalTwo" id="addMoreModal" tabindex="-1" aria-labelledby="addMoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">
                <div class="modal-body zModalTwo-body">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center pb-30">
                        <h4 class="fs-20 fw-500 lh-38 text-1b1c17">{{ __('Add Info') }}</h4>
                        <div class="mClose">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                    src="{{ asset('assets/images/icon/delete.svg') }}" alt="" /></button>
                        </div>
                    </div>
                    <!-- Body -->
                    <form method="POST" class="ajax" data-handler="commonResponseForModal"
                        action="{{ route('add_institution') }}">
                        @csrf
                        <div class="pb-25">
                            <div class="row rg-25">
                                <div class="col-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epDegree1" class="form-label">{{ __('Degree') }}</label>
                                            <input type="text" class="primary-form-control" id="epDegree1" name="degree"
                                                placeholder="{{ __('Your Degree') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epInstitute" class="form-label">{{ __('Institution') }}</label>
                                            <input type="text" class="primary-form-control" id="epInstitute"
                                                name="institute" placeholder="{{ __('Your Institution') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="primary-form-group">
                                        <div class="primary-form-group-wrap">
                                            <label for="epPassingYear1" class="form-label">{{ __('Passing Year') }}</label>
                                            <input type="text" class="primary-form-control" id="epPassingYear1"
                                                name="passing_year" placeholder="{{ __('Your Passing Year') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="py-13 px-26 bg-cdef84 border-0 bd-ra-12 fs-15 fw-500 lh-25 text-black hover-bg-one">{{
        __('Save Now') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('alumni/js/profile.js') }}"></script>
@endpush