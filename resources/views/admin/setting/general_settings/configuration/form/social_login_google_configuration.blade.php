<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{ __('Social Login (Google) Configuration') }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax" action="{{route('admin.setting.common.settings.update')}}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Google Client ID') }}</label>

                    <input type="text" name="google_client_id" id="google_client_id"
                        value="{{getOption('google_client_id')}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Google Client Secret') }} </label>

                    <input type="text" name="google_client_secret" id="google_client_secret"
                        value="{{getOption('google_client_secret')}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <label class="text-white">{{ __('Set callback URL') }} : <strong
                        style="color: var(--gold, #D4AF5A);">{{ url('/auth/google/callback') }}</strong></label>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-end">
                <button class="premium-btn" type="submit">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>