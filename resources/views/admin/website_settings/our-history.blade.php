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

        .premium-sidebar-container {
            background-color: var(--bg-surface, #12161C) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            border-radius: 24px;
            height: 100%;
            padding: 30px;
        }

        .premium-sidebar-container .email__sidebar.bg-style {
            background: transparent !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
        }

        .premium-sidebar-container .list-item {
            color: var(--text-secondary, #B4BCC8) !important;
            padding: 12px 15px !important;
            border-radius: 12px !important;
            transition: all 0.3s ease !important;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .premium-sidebar-container .list-item:hover {
            background: rgba(212, 175, 90, 0.1) !important;
            color: var(--gold, #D4AF5A) !important;
            border-left-color: var(--gold, #D4AF5A);
        }

        .premium-sidebar-container .list-item .fa {
            color: var(--text-secondary, #B4BCC8);
            transition: color 0.3s ease;
        }

        .premium-sidebar-container .list-item:hover .fa {
            color: var(--gold, #D4AF5A);
        }

        /* Form Controls */
        .primary-form-control {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
            border-radius: 12px;
            padding: 12px 16px;
            width: 100%;
        }

        .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
            box-shadow: 0 0 0 2px rgba(212, 175, 90, 0.2) !important;
        }

        textarea.primary-form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-label {
            color: var(--text-primary, #E6EAF0) !important;
            font-weight: 500;
            margin-bottom: 8px !important;
            display: block !important;
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
        }

        .premium-btn {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
            color: #000 !important;
            border: none !important;
            font-weight: 600 !important;
            border-radius: 12px;
            padding: 10px 25px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
        }

        .premium-btn-sm {
            padding: 6px 16px;
            font-size: 0.85rem;
            border-radius: 8px;
        }

        .btn-outline-gold {
            background: transparent !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            color: var(--gold, #D4AF5A) !important;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 16px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline-gold:hover {
            background: rgba(212, 175, 90, 0.15) !important;
        }

        .btn-outline-danger {
            background: transparent !important;
            border: 1px solid #dc3545 !important;
            color: #dc3545 !important;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 16px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline-danger:hover {
            background: rgba(220, 53, 69, 0.15) !important;
        }

        /* Timeline Entry Cards */
        .timeline-entry-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
            position: relative;
        }

        .timeline-entry-card:hover {
            border-color: rgba(212, 175, 90, 0.3);
            background: rgba(255, 255, 255, 0.05);
        }

        .timeline-entry-card .entry-year {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--gold, #D4AF5A);
            font-weight: 700;
        }

        .timeline-entry-card .entry-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: #E6EAF0;
            font-weight: 600;
            margin-top: 4px;
        }

        .timeline-entry-card .entry-desc {
            font-size: 0.9rem;
            color: rgba(230, 234, 240, 0.7);
            margin-top: 8px;
            line-height: 1.6;
        }

        .timeline-entry-card .entry-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .entry-order-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(212, 175, 90, 0.15);
            color: var(--gold, #D4AF5A);
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Add New Entry Form */
        .add-entry-form {
            background: rgba(212, 175, 90, 0.05);
            border: 1px dashed rgba(212, 175, 90, 0.3);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .add-entry-form h6 {
            color: var(--gold, #D4AF5A);
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
        }

        /* Edit Form */
        .edit-form {
            display: none;
            background: rgba(212, 175, 90, 0.05);
            border: 1px solid rgba(212, 175, 90, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin-top: 12px;
        }

        .edit-form.active {
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary, #B4BCC8);
        }

        .empty-state i {
            font-size: 3rem;
            color: rgba(212, 175, 90, 0.3);
            margin-bottom: 16px;
        }

        .empty-state h5 {
            color: #E6EAF0;
            font-family: 'Playfair Display', serif;
            margin-bottom: 8px;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-landmark" style="color: var(--gold); margin-right: 10px;"></i>{{ __($title) }}
            </h4>
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-md-4 pr-0">
                    <div class="premium-sidebar-container">
                        @include('admin.website_settings.partials.sidebar')
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-md-8">
                    <div class="premium-card">
                        <div class="p-4 border-bottom border-dark mb-4">
                            <h5 class="text-gold mb-1" style="font-family: 'Playfair Display', serif;">
                                {{ __('History Timeline Entries') }}
                            </h5>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                {{ __('Manage the timeline milestones displayed on the public "Our History" page. Add, edit, or reorder entries.') }}
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-4" role="alert"
                                 style="background: rgba(40, 167, 69, 0.15); border: 1px solid rgba(40, 167, 69, 0.3); color: #28a745; border-radius: 12px;">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Add New Entry Form -->
                        <div class="px-4">
                            <div class="add-entry-form">
                                <h6><i class="fa-solid fa-plus-circle me-2"></i>{{ __('Add New Timeline Entry') }}</h6>
                                <form action="{{ route('admin.setting.website-settings.history-timeline.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label">{{ __('Year / Period') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="year" class="primary-form-control" required
                                                   placeholder="{{ __('e.g. May 17, 2017') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="primary-form-control" required
                                                   placeholder="{{ __('e.g. The Genesis') }}">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                            <textarea name="description" class="primary-form-control" rows="2" required
                                                      placeholder="{{ __('Describe this milestone...') }}"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="submit" class="premium-btn premium-btn-sm">
                                            <i class="fa-solid fa-plus me-1"></i>{{ __('Add Entry') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Existing Entries -->
                        <div class="px-4 pb-4">
                            @if(count($timelines) > 0)
                                <div id="timeline-entries">
                                    @foreach($timelines as $entry)
                                        <div class="timeline-entry-card" data-id="{{ $entry->id }}">
                                            <span class="entry-order-badge">#{{ $loop->iteration }}</span>
                                            <div class="entry-year">{{ $entry->year }}</div>
                                            <div class="entry-title">{{ $entry->title }}</div>
                                            <div class="entry-desc">{{ Str::limit($entry->description, 200) }}</div>
                                            <div class="entry-actions">
                                                <button type="button" class="btn-outline-gold btn-sm"
                                                        onclick="toggleEdit({{ $entry->id }})">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i>{{ __('Edit') }}
                                                </button>
                                                <button type="button" class="btn-outline-danger btn-sm"
                                                        onclick="deleteEntry({{ $entry->id }})">
                                                    <i class="fa-solid fa-trash me-1"></i>{{ __('Delete') }}
                                                </button>
                                            </div>

                                            <!-- Inline Edit Form -->
                                            <div class="edit-form" id="edit-form-{{ $entry->id }}">
                                                <form action="{{ route('admin.setting.website-settings.history-timeline.update', $entry->id) }}" method="POST">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('Year / Period') }}</label>
                                                            <input type="text" name="year" class="primary-form-control"
                                                                   value="{{ $entry->year }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">{{ __('Title') }}</label>
                                                            <input type="text" name="title" class="primary-form-control"
                                                                   value="{{ $entry->title }}" required>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label class="form-label">{{ __('Description') }}</label>
                                                            <textarea name="description" class="primary-form-control" rows="3" required>{{ $entry->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2 mt-3 justify-content-end">
                                                        <button type="button" class="btn-outline-gold btn-sm"
                                                                onclick="toggleEdit({{ $entry->id }})">
                                                            {{ __('Cancel') }}
                                                        </button>
                                                        <button type="submit" class="premium-btn premium-btn-sm">
                                                            <i class="fa-solid fa-check me-1"></i>{{ __('Save Changes') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fa-solid fa-timeline d-block"></i>
                                    <h5>{{ __('No Timeline Entries Yet') }}</h5>
                                    <p>{{ __('Add your first milestone using the form above. The default timeline will be shown on the frontend until you add entries.') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(id) {
            const form = document.getElementById('edit-form-' + id);
            form.classList.toggle('active');
        }

        function deleteEntry(id) {
            if (!confirm('{{ __("Are you sure you want to delete this timeline entry?") }}')) return;

            fetch("{{ url('admin/setting/website-settings/history-timeline/delete') }}/" + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' || data.success) {
                    location.reload();
                } else {
                    alert(data.message || '{{ __("Failed to delete entry.") }}');
                }
            })
            .catch(() => alert('{{ __("An error occurred. Please try again.") }}'));
        }
    </script>
@endsection