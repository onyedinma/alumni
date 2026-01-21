<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{__('Cookie Configuration')}}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax" action="{{ route('admin.setting.common.settings.update') }}" method="post"
        class="form-horizontal" data-handler="commonResponseForModal">
        @csrf
        <div class="row">
            <div class="col-12 mb-4">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{__('Cookie Consent Text')}} </label>
                    <textarea class="form-control" name="cookie_consent_text" cols="30"
                        rows="10">{{getOption('cookie_consent_text')}}</textarea>
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