@extends('layouts.app')
@push('admin-style')
@endpush
@section('content')
    <style>
        /* Premium Admin Panel Standards */
        .premium-admin-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .premium-card {
            background-color: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
        }

        /* Table Styling Overrides */
        .premium-card .table-responsive {
            background: transparent !important;
        }

        .premium-card table.zTable,
        .premium-card table.dataTable,
        .premium-card #commonDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead,
        .premium-card table.dataTable thead,
        .premium-card #commonDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th,
        .premium-card table.dataTable thead th,
        .premium-card #commonDataTable thead th,
        .premium-card .dataTable thead th,
        .premium-card th {
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 12px 14px !important;
            background: var(--bg-elevated, #171C23) !important;
            border-top: none !important;
        }

        .premium-card table.zTable thead th div,
        .premium-card th div {
            color: var(--gold, #D4AF5A) !important;
            background: transparent !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .premium-card table.zTable tbody td,
        .premium-card table.dataTable tbody td,
        .premium-card #commonDataTable tbody td,
        .premium-card td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-card table.zTable tbody tr:hover td {
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Buttons */
        .premium-btn {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
            color: #000 !important;
            border: none !important;
            font-weight: 600 !important;
            border-radius: 12px;
            padding: 10px 26px;
            transition: all 0.3s ease;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .premium-btn-secondary {
            background: var(--bg-elevated, #171C23) !important;
            color: var(--text-primary, #E6EAF0) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            font-weight: 500;
            border-radius: 12px;
            padding: 10px 26px;
            transition: all 0.3s ease;
        }

        .premium-btn-secondary:hover {
            border-color: var(--gold, #D4AF5A) !important;
            color: var(--gold, #D4AF5A) !important;
        }

        .primary-form-control {
            background-color: var(--bg-elevated, #171C23) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
        }

        /* Textareas in table */
        .table textarea.form-control {
            background: transparent !important;
            border: 1px solid transparent !important;
            color: var(--text-primary, #E6EAF0) !important;
            resize: none;
        }

        .table textarea.form-control:focus {
            background: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
        }

        /* Modal Styling */
        .modal-content {
            background-color: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 16px;
        }

        .modal-header {
            border-bottom: 1px solid var(--border-dark, #1F2630);
        }

        .modal-footer {
            border-top: 1px solid var(--border-dark, #1F2630);
        }

        .modal-title,
        .modal-body p,
        .modal-body label,
        .form-check-label {
            color: var(--text-primary, #E6EAF0) !important;
        }

        /* Select styling override */
        .sf-select {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-language"
                    style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="premium-card">
                <input type="hidden" id="language-route" value="{{ route('admin.setting.languages.index') }}">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap gap-2 item-title justify-content-between mb-20">
                        <button type="button" class="premium-btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#importModal" title="{{ __('Import Keywords') }}">
                            <i class="fa-solid fa-file-import" style="margin-right: 8px;"></i>{{__('Import Keywords')}}
                        </button>
                        <button type="button" class="premium-btn addmore">
                            <i class="fa fa-plus"></i>
                            {{__('Add More')}}
                        </button>
                    </div>
                    <div class="table-responsive zTable-responsive">
                        <table class="table zTable">
                            <thead>
                                <tr>
                                <tr>
                                    <th class="min-w-160">
                                        <div>{{ __('Key') }}</div>
                                    </th>
                                    <th class="min-w-160">
                                        <div>{{ __('Value') }}</div>
                                    </th>
                                    <th class="text-center w-28">
                                        <div>{{ __('Action') }}</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="append">
                                @foreach ($translators as $key => $value)
                                                        <tr>
                                                            <td>
                                                                <textarea type="text" class="key form-control" readonly required>{!! $key
                                                                    !!}</textarea>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" value="0" class="is_new">
                                                                <textarea type="text" class="val form-control" required>{!! $value
                                                                    !!}</textarea>
                                                            </td>
                                                            <td class="text-end">
                                                                <button type="button" class="premium-btn updateLangItem">{{
                                    __('Update')
                                                                    }}</button>
                                                            </td>
                                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal section start -->
    <div class="modal fade" id="importModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="ajax" action="{{ route('admin.setting.languages.import') }}" method="POST"
                    data-handler="languageHandler">
                    @csrf
                    <input type="hidden" name="current" value="{{ $language->iso_code }}">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Import Language') }}</h5>
                        <button type="button" class="w-30 h-30 rounded-circle bd-one bd-c-e4e6eb p-0 bg-transparent"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-times" style="color: var(--text-secondary);"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-inner-form-box">
                            <div class="row">
                                <div class="mb-30">
                                    <span class="text-danger text-center">{{ __('Note: If you import keywords, your current
                                        keywords will be deleted and replaced by the imported keywords.') }}</span>
                                </div>
                                <div class="col mb-25">
                                    <label for="status" class="label-text-title color-heading font-medium mb-2">
                                        {{ __('Language') }} </label>
                                    <select name="import" class="sf-select flex-shrink-0 export" id="inputGroupSelect02">
                                        <option value=""> {{ __('Select Option') }} </option>
                                        @foreach ($languages as $lang)
                                            <option value="{{ $lang->iso_code }}">{{ __($lang->language) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-start border-0 pt-0">
                        <button type="button" class="premium-btn-secondary" data-bs-dismiss="modal"
                            title="Back">{{ __('Back') }}</button>
                        <button type="submit" class="premium-btn" title="Submit">{{ __('Import') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="updateLangItemRoute"
        value="{{ route('admin.setting.languages.update.translate', [$language->id]) }}">
@endsection

@push('script')
    <script src="{{asset('admin/js/languages.js')}}"></script>
@endpush