<div class="modal-header">
    <h5 class="modal-title">{{ __('Edit Class') }}</h5>
    <button type="button" class="border-0 btn-close" data-bs-dismiss="modal" aria-label="Close"
        style="filter: invert(1);"></button>
</div>
<form class="ajax" action="{{ route('admin.setting.classes.update', $class->id) }}" method="post"
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
                            value="{{ $class->name }}" placeholder="{{ __('e.g., JSS1 A, SS3 G') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                        <label for="level" class="form-label">{{ __('Level') }}</label>
                        <select class="primary-form-control" name="level">
                            <option value="">{{ __('Select Level') }}</option>
                            <option value="junior" {{ $class->level == 'junior' ? 'selected' : '' }}>{{ __('Junior (JSS)') }}</option>
                            <option value="senior" {{ $class->level == 'senior' ? 'selected' : '' }}>{{ __('Senior (SS)') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                        <label for="year_number" class="form-label">{{ __('Year') }}</label>
                        <select class="primary-form-control" name="year_number">
                            <option value="">{{ __('Select Year') }}</option>
                            <option value="1" {{ $class->year_number == 1 ? 'selected' : '' }}>{{ __('1') }}</option>
                            <option value="2" {{ $class->year_number == 2 ? 'selected' : '' }}>{{ __('2') }}</option>
                            <option value="3" {{ $class->year_number == 3 ? 'selected' : '' }}>{{ __('3') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                        <label for="arm" class="form-label">{{ __('Arm') }}</label>
                        <input type="text" class="primary-form-control" name="arm"
                            value="{{ $class->arm }}" placeholder="{{ __('e.g., A, B, C') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="primary-form-group mt-2">
                    <div class="primary-form-group-wrap">
                        <label for="sort_order" class="form-label">{{ __('Sort Order') }}</label>
                        <input type="number" class="primary-form-control" name="sort_order" value="{{ $class->sort_order }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="premium-btn">{{ __('Update') }}</button>
    </div>
</form>
