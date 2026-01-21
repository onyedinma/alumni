<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{ __('SMS Configuration') }}</h4>

        <a href="javascript:void(0);" id="sendTestSMSBtn" class="premium-btn"
            style="padding: 8px 20px; font-size: 14px;"> <i class="fa fa-envelope border-0"></i>
            {{ __('Send Test SMS') }} </a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax reset" action="{{route('admin.setting.sms-configuration')}}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf
        <div class="row">
            <div class="col-sm-6 col-md-4 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{__('TWILIO ACCOUNT SID')}} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="TWILIO_ACCOUNT_SID" value="{{getOption('TWILIO_ACCOUNT_SID')}}"
                        class="form-control">
                </div>
            </div>

            <div class="col-sm-6 col-md-4 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{__('TWILIO AUTH TOKEN')}} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="TWILIO_AUTH_TOKEN" value="{{getOption('TWILIO_AUTH_TOKEN')}}"
                        class="form-control">
                </div>
            </div>

            <div class="col-sm-6 col-md-4 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{__('TWILIO PHONE NUMBER')}} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="TWILIO_PHONE_NUMBER" value="{{getOption('TWILIO_PHONE_NUMBER')}}"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-end">
                <button class="premium-btn" type="submit">{{ __('Update') }}</button>
            </div>
        </div>

    </form>
</div>