<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{ __('Google Recaptcha Credentials') }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax" action="{{route('admin.setting.common.settings.update')}}" method="post" class="form-horizontal"
        data-handler="commonResponseForModal">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Google Recaptcha Site Key') }}</label>
                    <input type="text" name="google_recaptcha_site_key" id="google_recaptcha_site_key"
                        value="{{getOption('google_recaptcha_site_key')}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Google Recaptcha Secret Key') }} </label>
                    <input type="text" name="google_recaptcha_secret_key" id="google_recaptcha_secret_key"
                        value="{{getOption('google_recaptcha_secret_key')}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-end">
                <button type="submit" class="premium-btn">{{__('Update')}}</button>
            </div>
        </div>
    </form>
</div>