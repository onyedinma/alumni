<form class="ajax reset" action="{{ route('admin.event.category.update', $eventCategory->id) }}" method="post"
    data-handler="commonResponseForModal">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title fs-20 fw-600">{{__('Update Category')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <input type="hidden" name="id" value="{{$eventCategory->id}}">
        <div class="row">
            <div class="col-12">
                <div class="primary-form-group">
                    <div class="primary-form-group-wrap">
                        <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                        <div class="premium-input-group">
                            <span class="premium-input-group-text"><i class="fa-solid fa-tag"></i></span>
                            <input type="text" class="primary-form-control" name="name" value="{{$eventCategory->name}}"
                                placeholder="{{ __('Category Name') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="premium-btn">{{ __('Update') }}</button>
    </div>
</form>