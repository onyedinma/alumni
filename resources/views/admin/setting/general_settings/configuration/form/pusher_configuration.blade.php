<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{ __('Pusher Configuration') }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax" action="{{route('admin.setting.common.settings.update')}}" method="post" class="form-horizontal"
        data-handler="commonResponseForModal">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Pusher App Id') }}</label>
                    <input type="text" name="pusher_app_id" id="pusher_app_id" value="{{getOption('pusher_app_id')}}"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Pusher App Key') }} </label>
                    <input type="text" name="pusher_app_key" id="pusher_app_key" value="{{getOption('pusher_app_key')}}"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Pusher App Secret') }} </label>
                    <input type="text" name="pusher_app_secret" id="pusher_app_secret"
                        value="{{getOption('pusher_app_secret')}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Pusher Cluster') }} </label>
                    <input type="text" name="pusher_cluster" id="pusher_cluster" value="{{getOption('pusher_cluster')}}"
                        class="form-control">
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