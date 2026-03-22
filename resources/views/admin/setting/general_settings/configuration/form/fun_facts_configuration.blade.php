<div class="modal-header">
    <h5 class="modal-title">{{ __('Fun Facts Configuration') }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('admin.setting.configuration-settings.update') }}" method="POST">
    @csrf
    <input type="hidden" name="key" value="fun_facts_status">
    <div class="modal-body">
        <div class="mb-3">
            <label for="fun_facts" class="form-label">{{ __('Fun Facts (One per line)') }}</label>
            <textarea name="value" id="fun_facts" class="form-control" rows="10"
                placeholder="Did you know? Our school was the first to...">{{ getOption('fun_facts_status') == 1 ? getOption('fun_facts_list') : '' }}</textarea>
            <small
                class="text-muted">{{ __('Enter each fact on a new line. The system will randomly pick one to display on the homepage.') }}</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
    </div>
</form>