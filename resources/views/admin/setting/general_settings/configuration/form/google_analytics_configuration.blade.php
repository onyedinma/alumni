<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{__('Google analytics configuration')}}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax" action="{{ route('admin.setting.common.settings.update') }}" method="post"
        class="form-horizontal" data-handler="commonResponseForModal">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Google Analytics Tracking Id') }} </label>
                    <input type="text" min="0" max="100" step="any" name="google_analytics_tracking_id"
                        value="{{getOption('google_analytics_tracking_id')}}" class="form-control">
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