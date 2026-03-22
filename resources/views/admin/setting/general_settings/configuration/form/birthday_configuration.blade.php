<div class="">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fs-18 fw-600 mb-0 text-white">{{ __('Birthday Auto-Post Configuration') }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="filter: invert(1);"></button>
    </div>
    <form class="ajax" action="{{route('admin.setting.common.settings.update')}}" method="POST"
        enctype="multipart/form-data" data-handler="commonResponseForModal">
        @csrf
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="primary-form-group">
                    <label class="form-label text-white">{{ __('Birthday Messages') }} <span
                            class="text-danger">*</span></label>
                    <textarea name="birthday_messages" id="birthday_messages" class="form-control" rows="10"
                        placeholder="Happy Birthday {name}!
Wishing you a great day, {name}!">{{ getOption('birthday_messages', "🎂 Happy Birthday to our amazing alumni, {name}{set}! 🎉 Wishing you a wonderful day filled with joy and blessings!\n🎈 Today we celebrate {name}{set}! 🎂 Happy Birthday! May this year bring you success and happiness!\n🎉 It's {name}'s special day{set}! Happy Birthday! 🎂 The alumni family wishes you all the best!") }}</textarea>
                    <small class="text-muted d-block mt-2">
                        <strong>Instructions:</strong><br>
                        - Enter one message per line.<br>
                        - The system will randomly pick one message for each birthday.<br>
                        - Use <code>{name}</code> placeholder for the Alumni's name.<br>
                        - Use <code>{set}</code> placeholder for the Alumni's Set Year (e.g. " (Set of 2010)").
                    </small>
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