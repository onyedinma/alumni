<div class="modal-header">
    <h5 class="modal-title">{{ __('Edit House') }}</h5>
    <button type="button" class="border-0 btn-close" data-bs-dismiss="modal" aria-label="Close"
        style="filter: invert(1);"></button>
</div>
<form class="ajax" action="{{ route('admin.setting.houses.update', $house->id) }}" method="post"
    data-handler="commonResponseForModal">
    @csrf
    @method('PATCH')
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                        <label for="name" class="form-label">{{ __('Name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="primary-form-control" name="name" required
                            value="{{ $house->name }}" placeholder="{{ __('e.g., Red House, Blue House') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                        <label for="color_code" class="form-label">{{ __('House Color') }}</label>
                        <input type="color" class="primary-form-control" name="color_code" 
                            value="{{ $house->color_code ?? '#FF0000' }}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="primary-form-control" name="description" rows="3"
                            placeholder="{{ __('Optional description...') }}">{{ $house->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="premium-btn">{{ __('Update') }}</button>
    </div>
</form>
