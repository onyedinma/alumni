@extends('layouts.app')
@push('title')
    {{ $title }}
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

        /* Table Styling */
        .premium-card .table-responsive {
            background: transparent !important;
        }

        .premium-card table.zTable,
        .premium-card table.dataTable,
        .premium-card #classDataTable {
            background: var(--bg-primary, #0B0E11) !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .premium-card table.zTable thead,
        .premium-card table.dataTable thead,
        .premium-card #classDataTable thead {
            background: var(--bg-elevated, #171C23) !important;
        }

        .premium-card table.zTable thead th,
        .premium-card table.dataTable thead th,
        .premium-card #classDataTable thead th,
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
        .premium-card #classDataTable tbody td,
        .premium-card td {
            color: var(--text-primary, #E6EAF0) !important;
            border-bottom: 1px solid var(--border-dark, #1F2630) !important;
            padding: 16px !important;
            background: var(--bg-primary, #0B0E11) !important;
        }

        .premium-card table.zTable tbody tr:hover td {
            background: var(--bg-elevated, #171C23) !important;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge i {
            font-size: 6px;
        }

        .status-active {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .action-btn-edit {
            background: rgba(212, 175, 90, 0.15);
            color: var(--gold, #D4AF5A);
            border: 1px solid rgba(212, 175, 90, 0.3);
        }

        .action-btn-edit:hover {
            background: var(--gold, #D4AF5A);
            color: #000;
            transform: translateY(-2px);
        }

        .action-btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .action-btn-delete:hover {
            background: #ef4444;
            color: #fff;
            transform: translateY(-2px);
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

        /* Enhanced Modal Styling */
        .modal-content {
            background-color: var(--bg-surface, #12161C) !important;
            border: none !important;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--maroon, #8B2635) 0%, #5a1520 100%);
            border-bottom: none;
            padding: 20px 24px;
        }

        .modal-header .modal-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 600;
        }

        .modal-header .modal-title i {
            color: var(--gold, #D4AF5A);
            font-size: 20px;
        }

        .modal-header .btn-close {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 8px;
            opacity: 1;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            border-top: 1px solid var(--border-dark, #1F2630);
            padding: 16px 24px;
            gap: 12px;
        }

        .modal-title,
        .modal-body p,
        .modal-body label,
        .form-check-label {
            color: var(--text-primary, #E6EAF0) !important;
        }

        /* Form Section Headers */
        .form-section-title {
            color: var(--gold, #D4AF5A);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border-dark, #1F2630);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            font-size: 14px;
        }

        /* Enhanced Form Controls */
        .form-group-enhanced {
            margin-bottom: 20px;
        }

        .form-group-enhanced label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary, #B4BCC8) !important;
            margin-bottom: 8px;
        }

        .form-group-enhanced label .required {
            color: #e74c3c;
            margin-left: 4px;
        }

        .form-control-enhanced {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 2px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-control-enhanced:focus {
            border-color: var(--gold, #D4AF5A) !important;
            box-shadow: 0 0 0 3px rgba(212, 175, 90, 0.15);
            outline: none;
        }

        .form-control-enhanced::placeholder {
            color: #666;
        }

        /* Select styling */
        .form-control-enhanced option {
            background-color: var(--bg-primary, #0B0E11);
            color: var(--text-primary, #E6EAF0);
            padding: 10px;
        }

        /* Help text */
        .form-help {
            font-size: 12px;
            color: #888;
            margin-top: 6px;
        }

        /* Quick add buttons */
        .quick-add-section {
            background: var(--bg-primary, #0B0E11);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .quick-add-title {
            font-size: 12px;
            color: var(--gold, #D4AF5A);
            margin-bottom: 10px;
            font-weight: 500;
        }

        .quick-add-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .quick-add-btn {
            background: var(--bg-elevated, #171C23);
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-primary, #E6EAF0);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .quick-add-btn:hover {
            background: var(--gold, #D4AF5A);
            color: #000;
            border-color: var(--gold, #D4AF5A);
        }

        /* Cancel button */
        .btn-cancel {
            background: transparent;
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-secondary, #B4BCC8);
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: var(--bg-elevated, #171C23);
            color: var(--text-primary, #E6EAF0);
        }

        /* DataTables Pagination & Info */
        .premium-card .dataTables_wrapper .dataTables_length,
        .premium-card .dataTables_wrapper .dataTables_filter,
        .premium-card .dataTables_wrapper .dataTables_info,
        .premium-card .dataTables_wrapper .dataTables_paginate {
            color: var(--text-secondary, #B4BCC8) !important;
            padding-top: 10px;
        }

        .premium-card .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #000 !important;
            background: var(--gold, #D4AF5A) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            border-radius: 6px;
            margin: 0 4px;
        }

        .premium-card .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--maroon, #8B2635) !important;
            border-color: var(--maroon, #8B2635) !important;
            color: #fff !important;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-chalkboard"
                    style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="premium-card">
                <div class="row">
                    <input type="hidden" id="class-route" value="{{ route('admin.setting.classes.index') }}">
                    <div class="col-lg-12">
                        <div class="customers__area bg-style mb-30">
                            <div class="d-flex flex-wrap item-title justify-content-end">
                                <div class="mb-3">
                                    <button class="premium-btn" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-modal">
                                        <i class="fa fa-plus"></i> {{ __('Add Class') }}
                                    </button>
                                </div>
                            </div>
                            <div class="customers__table">
                                <div class="table-responsive zTable-responsive">
                                    <table class="table zTable" id="classDataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <div>{{ __('SL#') }}</div>
                                                </th>
                                                <th scope="col">
                                                    <div>{{ __('Class Name') }}</div>
                                                </th>
                                                <th scope="col">
                                                    <div>{{ __('Status') }}</div>
                                                </th>
                                                <th scope="col" class="text-end">
                                                    <div>{{ __('Action') }}</div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Class Modal -->
    <div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-graduation-cap"></i>
                        {{ __('Add New Class') }}
                    </h5>
                    <button type="button" class="border-0 btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: invert(1);"></button>
                </div>
                <form class="ajax reset" action="{{ route('admin.setting.classes.store') }}" method="post"
                    data-handler="commonResponseForModal">
                    @csrf
                    <div class="modal-body">
                        <!-- Quick Add Section -->
                        <div class="quick-add-section">
                            <div class="quick-add-title">
                                <i class="fa-solid fa-bolt"></i> Quick Add Common Classes
                            </div>
                            <div class="quick-add-buttons">
                                <button type="button" class="quick-add-btn"
                                    onclick="setClass('JSS1', 'junior', 1)">JSS1</button>
                                <button type="button" class="quick-add-btn"
                                    onclick="setClass('JSS2', 'junior', 2)">JSS2</button>
                                <button type="button" class="quick-add-btn"
                                    onclick="setClass('JSS3', 'junior', 3)">JSS3</button>
                                <button type="button" class="quick-add-btn"
                                    onclick="setClass('SS1', 'senior', 1)">SS1</button>
                                <button type="button" class="quick-add-btn"
                                    onclick="setClass('SS2', 'senior', 2)">SS2</button>
                                <button type="button" class="quick-add-btn"
                                    onclick="setClass('SS3', 'senior', 3)">SS3</button>
                            </div>
                        </div>

                        <!-- Class Name Section -->
                        <div class="form-section-title">
                            <i class="fa-solid fa-tag"></i> Class Information
                        </div>

                        <div class="form-group-enhanced">
                            <label for="name">Class Name <span class="required">*</span></label>
                            <input type="text" class="form-control-enhanced" name="name" id="className" required
                                placeholder="e.g., JSS1 A, SS3 G">
                            <div class="form-help">Enter the full class name as it should appear</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-enhanced">
                                    <label for="level">Level</label>
                                    <select class="form-control-enhanced" name="level" id="classLevel">
                                        <option value="">Select Level</option>
                                        <option value="junior">Junior (JSS)</option>
                                        <option value="senior">Senior (SS)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-enhanced">
                                    <label for="year_number">Year</label>
                                    <select class="form-control-enhanced" name="year_number" id="classYear">
                                        <option value="">Select Year</option>
                                        <option value="1">Year 1</option>
                                        <option value="2">Year 2</option>
                                        <option value="3">Year 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-enhanced">
                                    <label for="arm">Arm / Section</label>
                                    <select class="form-control-enhanced" name="arm" id="classArm">
                                        <option value="">Select Arm</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-enhanced">
                                    <label for="sort_order">Display Order</label>
                                    <input type="number" class="form-control-enhanced" name="sort_order" value="0" min="0">
                                    <div class="form-help">Lower numbers appear first</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="premium-btn">
                            <i class="fa-solid fa-check"></i> Save Class
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('admin/js/classes.js')}}"></script>
    <script>
        // Quick add function for common classes
        function setClass(prefix, level, year) {
            document.getElementById('classLevel').value = level;
            document.getElementById('classYear').value = year;
            document.getElementById('className').value = prefix + ' ';
            document.getElementById('className').focus();
        }

        // Auto-generate class name based on selections
        document.addEventListener('DOMContentLoaded', function () {
            const levelSelect = document.getElementById('classLevel');
            const yearSelect = document.getElementById('classYear');
            const armSelect = document.getElementById('classArm');
            const nameInput = document.getElementById('className');

            function updateClassName() {
                const level = levelSelect.value;
                const year = yearSelect.value;
                const arm = armSelect.value;

                if (level && year) {
                    const prefix = level === 'junior' ? 'JSS' : 'SS';
                    nameInput.value = prefix + year + (arm ? ' ' + arm : '');
                }
            }

            levelSelect.addEventListener('change', updateClassName);
            yearSelect.addEventListener('change', updateClassName);
            armSelect.addEventListener('change', updateClassName);
        });
    </script>
@endpush