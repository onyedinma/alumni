<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{ __('WhatsApp Widget Configuration') }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax" action="{{route('admin.setting.common.settings.update')}}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('WhatsApp Number') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number"
                        value="{{getOption('whatsapp_number')}}" class="form-control" placeholder="e.g. 15551234567"
                        required>
                    <small
                        class="text-muted">{{ __('Enter phone number with country code, no spaces or symbols (e.g. 15551234567)') }}</small>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Default Message') }}</label>
                    <textarea name="whatsapp_default_message" id="whatsapp_default_message" class="form-control"
                        rows="3"
                        placeholder="Hi, I have a question...">{{getOption('whatsapp_default_message', 'Hi, I need assistance')}}</textarea>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Widget Position') }}</label>
                    <select name="whatsapp_position" class="form-control">
                        <option value="right" {{ getOption('whatsapp_position') == 'right' ? 'selected' : '' }}>
                            {{ __('Bottom Right') }}</option>
                        <option value="left" {{ getOption('whatsapp_position') == 'left' ? 'selected' : '' }}>
                            {{ __('Bottom Left') }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-end">
                <button class="premium-btn" type="submit">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>