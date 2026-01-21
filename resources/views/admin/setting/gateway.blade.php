@extends('layouts.app')
@section('content')
    @push('title')
        {{$title}}
    @endpush
    <style>
        /* Premium Admin Panel Standards */
        .premium-admin-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .premium-header {
            font-family: 'Playfair Display', serif;
            color: #fff;
        }

        /* Generic Premium Card */
        .premium-card {
            background-color: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--maroon, #8B2635), var(--gold, #D4AF5A), var(--maroon, #8B2635));
        }

        /* Table Styling Overrides (Shared with other pages) */
        .premium-card .table-responsive {
            background: transparent !important;
        }

        .premium-card table.zTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th {
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.3px !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 12px 14px !important;
            background: var(--bg-elevated, #171C23) !important;
            border-top: none !important;
        }

        .premium-card table.zTable thead th div {
            color: var(--gold, #D4AF5A) !important;
            background: transparent !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .premium-card table.zTable tbody td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
            vertical-align: middle;
        }

        .premium-card table.zTable tbody tr:hover td {
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Status Buttons */
        .status-btn-green {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid #28a745;
            padding: 5px 12px;
            border-radius: 6px;
            display: inline-block;
        }

        .status-btn-orange {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid #ffc107;
            padding: 5px 12px;
            border-radius: 6px;
            display: inline-block;
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Edit Button specific */
        .btn-action.edit {
            background: transparent !important;
            border: 1px solid var(--text-secondary, #B4BCC8) !important;
            border-radius: 8px;
            padding: 6px 10px;
            transition: all 0.3s ease;
        }

        .btn-action.edit:hover {
            border-color: var(--gold, #D4AF5A) !important;
            background: var(--bg-elevated, #171C23) !important;
        }

        .btn-action.edit img {
            filter: invert(1);
            /* Make the SVG white/light for dark mode */
        }

        /* Modal Styling */
        .modal-content {
            background-color: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 16px;
        }

        .modal-body h4,
        .modal-body label,
        .modal-title,
        .label-text-title {
            color: var(--text-primary, #E6EAF0) !important;
        }

        .modal-header,
        .modal-footer {
            border-color: var(--border-dark, #1F2630);
        }

        .btn-close {
            filter: invert(1);
        }

        .primary-form-control {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
        }

        .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
        }

        .bg-off-white {
            background-color: var(--bg-elevated, #171C23) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
        }

        /* Dynamic Conversion Section */
        #currencyConversionRateSection .input-group-text {
            background-color: var(--bg-elevated, #171C23);
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--gold, #D4AF5A);
        }

        #currencyConversionRateSection .form-control {
            background-color: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-primary, #E6EAF0);
        }

        /* Force dark background for gateway icons specifically in modal and list */
        /* Checks for wrappers and images directly to cover all "gray" instances */
        .profile-user .image,
        .btn.btn-dropdown.site-language,
        .upload-profile-photo-box .image {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
        }

        /* Ensure wrappers don't contribute gray background */
        .profile-user,
        .upload-profile-photo-box .profile-user {
            background-color: transparent !important;
        }
    </style>

    <!-- Page content area start -->
    <div class="premium-admin-panel">

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h4 class="fs-24 fw-600 premium-header mb-0">
                <i class="fa-solid fa-credit-card"
                    style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
        </div>

        <div class="premium-card">
            <input type="hidden" id="language-route" value="{{ route('admin.setting.languages.index') }}">
            <div class="table-responsive zTable-responsive">
                <table class="table zTable">
                    <thead>
                        <tr>
                            <th>
                                <div><i class="fa-solid fa-hashtag" style="margin-right: 8px;"></i>{{ __('SL') }}</div>
                            </th>
                            <th>
                                <div><i class="fa-solid fa-image" style="margin-right: 8px;"></i>{{ __('Image') }}</div>
                            </th>
                            <th>
                                <div><i class="fa-solid fa-heading" style="margin-right: 8px;"></i>{{ __('Title') }}</div>
                            </th>
                            <th>
                                <div><i class="fa-solid fa-link" style="margin-right: 8px;"></i>{{ __('Slug') }}</div>
                            </th>
                            <th>
                                <div><i class="fa-solid fa-toggle-on" style="margin-right: 8px;"></i>{{ __('Status') }}
                                </div>
                            </th>
                            <th>
                                <div><i class="fa-solid fa-wrench" style="margin-right: 8px;"></i>{{ __('Mode') }}</div>
                            </th>
                            <th>
                                <div><i class="fa-solid fa-cog" style="margin-right: 8px;"></i>{{ __('Action') }}</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gateways as $gateway)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="">
                                        <div class="btn btn-dropdown site-language"
                                            style="background: var(--bg-primary, #0B0E11); border-radius: 8px; padding: 5px; border: 1px solid var(--border-dark, #1F2630);">
                                            <img src="{{ asset($gateway->image) }}" class="gateway-image" alt=""
                                                style="max-height: 30px;">
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $gateway->title }}</td>
                                <td>{{ $gateway->slug }}</td>
                                <td>
                                    @if ($gateway->status == ACTIVE)
                                        <div class="status-btn status-btn-green font-13 radius-4">
                                            {{ __('Active') }}
                                        </div>
                                    @else
                                        <div class="status-btn status-btn-orange font-13 radius-4">
                                            {{ __('Deactive') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($gateway->mode == GATEWAY_MODE_LIVE)
                                        <div class="status-btn status-btn-green font-13 radius-4">
                                            {{ __('Live') }}
                                        </div>
                                    @elseif($gateway->slug != 'bank')
                                        <div class="status-btn status-btn-orange font-13 radius-4">
                                            {{ __('Sandbox') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn-action edit" data-toggle="tooltip" title="{{__('Edit')}}"
                                        data-id="{{ $gateway->id }}">
                                        <img src="{{asset('assets/images/icon/edit.svg')}}" alt="edit" style="width: 16px;">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Page content area end -->

    {{-- Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"
                    style="background: var(--bg-elevated, #171C23); border-bottom: 1px solid var(--gold, #D4AF5A);">
                    <h4 class="modal-title" id="editModalLabel"
                        style="color: var(--gold, #D4AF5A) !important; font-family: 'Playfair Display', serif;">
                        {{ __('Edit Gateway') }}</h4>
                    <button type="button" class="border-0 btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: invert(1);"></button>
                </div>
                <form class="ajax" action="{{ route('admin.setting.gateway.store') }}" method="POST"
                    data-handler="responseOnGatewaStore">
                    @csrf
                    <input type="hidden" name="id" id="id" required>
                    <div class="modal-body" style="background: var(--bg-surface, #12161C);">

                        <!-- Gateway Icon & Title Section -->
                        <div class="d-flex align-items-center mb-4 pb-3"
                            style="border-bottom: 1px solid var(--border-dark, #1F2630);">
                            <div class="me-3">
                                <div class="gateway-icon-wrapper"
                                    style="width: 80px; height: 80px; background: var(--bg-primary, #0B0E11); border: 2px solid var(--gold, #D4AF5A); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                                    <img src="" class="image" alt="Gateway Icon"
                                        style="max-width: 60%; max-height: 60%; object-fit: contain;">
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1" style="color: var(--text-primary, #E6EAF0); font-weight: 600;">
                                    {{ __('Gateway Settings') }}</h5>
                                <p class="mb-0 small" style="color: var(--text-secondary, #B4BCC8);">
                                    {{ __('Configure keys and access settings.') }}</p>
                            </div>
                        </div>

                        <div class="modal-inner-form-box bg-transparent p-0">

                            <!-- Static Fields (Title, Slug, Status, Mode) -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="primary-form-group">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2 form-label">{{ __('Title') }}</label>
                                        <input type="text" class="primary-form-control title" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="primary-form-group">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2 form-label">{{ __('Slug') }}</label>
                                        <input type="text" name="slug" class="primary-form-control slug" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="primary-form-group">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2 form-label">{{ __('Status') }}</label>
                                        <select name="status" id="status"
                                            class="primary-form-control sf-select-without-search">
                                            <option value="0">{{ __('Deactive') }}</option>
                                            <option value="1">{{ __('Active') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 mode-div">
                                    <div class="primary-form-group">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2 form-label">{{ __('Mode') }}</label>
                                        <select name="mode" id="mode" class="primary-form-control sf-select-without-search">
                                            <option value="1">{{ __('Live') }}</option>
                                            <option value="2">{{ __('Sandbox') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Bank Section -->
                            <div class="bank-div">
                                <div class="bank-div-append"></div>
                                <div class="row mb-3">
                                    <div class="col-12 text-end">
                                        <button type="button" class="premium-btn btn-sm add-bank"
                                            title="{{ __('Add Bank') }}">
                                            <span class="iconify" data-icon="material-symbols:add"></span>
                                            {{ __('Add Bank') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- API Credentials Section -->
                            <div class="row url-div">
                                <div class="col-md-12 mb-3 gateway-input" id="gateway-url">
                                    <div class="primary-form-group">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2 form-label">{{ __('Url') }}
                                            / {{ __('Hash') }}</label>
                                        <input class="primary-form-control" type="text" name="url">
                                    </div>
                                </div>
                            </div>
                            <div class="row key-secret-div">
                                <div class="col-md-12 mb-3 gateway-input" id="gateway-key">
                                    <div class="primary-form-group">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2 form-label">{{ __('Key') }}</label>
                                        <input class="primary-form-control" type="text" name="key">
                                    </div>
                                    <small
                                        class="text-secondary small">{{ __('Client id, Public Key, Key, Store id, Api Key') }}</small>
                                </div>
                                <div class="col-md-12 mb-3 gateway-input" id="gateway-secret">
                                    <div class="primary-form-group">
                                        <label
                                            class="label-text-title color-heading font-medium mb-2 form-label">{{ __('Secret') }}</label>
                                        <input class="primary-form-control" type="text" name="secret">
                                    </div>
                                    <small
                                        class="text-secondary small">{{ __('Client Secret, Secret, Store Password, Auth Token') }}</small>
                                </div>
                            </div>

                            <!-- Conversion Rate Section -->
                            <div class="row mt-3 pt-3" style="border-top: 1px solid var(--border-dark, #1F2630);">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <label
                                            class="label-text-title color-heading font-medium mb-0">{{ __('Conversion Rate') }}</label>
                                        <button type="button" class="add-currency"
                                            style="background: var(--gold, #D4AF5A); border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; color: #000; transition: transform 0.2s;">
                                            <i class="fa-solid fa-plus font-14"></i>
                                        </button>
                                    </div>
                                    <div id="currencyConversionRateSection"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between"
                        style="background: var(--bg-surface, #12161C); border-top: 1px solid var(--border-dark, #1F2630);">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            title="{{ __('Back') }}"
                            style="border-color: var(--border-dark); color: var(--text-secondary);">{{ __('Cancel') }}</button>
                        <button type="submit" class="premium-btn"
                            title="{{ __('Submit') }}">{{ __('Update Settings') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <input type="hidden" id="getInfoRoute" value="{{ route('admin.setting.gateway.get.info') }}">
    <input type="hidden" id="getCurrencySymbol" value="{{ getCurrencySymbol() }}">
    <input type="hidden" id="allCurrency" value="{{ json_encode(getCurrency()) }}">
    <input type="hidden" id="gatewaySettings" value="{{ gatewaySettings() }}">
@endsection
@push('script')
    <script src="{{ asset('admin/js/gateway.js') }}"></script>
@endpush