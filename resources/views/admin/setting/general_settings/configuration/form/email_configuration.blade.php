<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{ __('Mail Configuration') }}</h4>
        <a href="javascript:void(0);" id="sendTestMailBtn" class="premium-btn"
            style="padding: 8px 20px; font-size: 14px;"> <i class="fa fa-envelope border-0"></i>
            {{ __('Send Test Mail') }}
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>

    <form class="ajax" action="{{ route('admin.setting.settings_env.update') }}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('MAIL MAILER') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="MAIL_MAILER" value="{{ env('MAIL_MAILER') }}" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('MAIL HOST') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('MAIL PORT') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('MAIL USERNAME') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('MAIL PASSWORD') }} <span
                            class="text-danger">*</span></label>
                    <input type="password" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label for="MAIL_ENCRYPTION" class="form-label text-white">{{ __('MAIL ENCRYPTION') }}<span
                            class="text-danger">*</span></label>
                    <select name="MAIL_ENCRYPTION" class="form-control sf-select-edit-modal">
                        <option value="tls" {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }}>
                            {{ __('tls') }}
                        </option>
                        <option value="ssl" {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }}>
                            {{ __('ssl') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('MAIL FROM ADDRESS') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}"
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('MAIL FROM NAME') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}" class="form-control">
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