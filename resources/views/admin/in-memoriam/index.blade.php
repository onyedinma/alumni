@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .memoriam-header {
            padding: 30px;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3), rgba(18, 22, 28, 0.98));
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .memoriam-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #fff;
        }

        .memoriam-title span {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-add {
            background: linear-gradient(135deg, #D4AF5A, #B8973E);
            color: #000;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212, 175, 90, 0.3);
            color: #000;
        }

        .memoriam-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 1200px) {
            .memoriam-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .memoriam-grid {
                grid-template-columns: 1fr;
            }
        }

        .memoriam-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .memoriam-card:hover {
            transform: translateY(-5px);
            border-color: rgba(212, 175, 90, 0.3);
        }

        .memoriam-photo {
            height: 200px;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 100%),
                rgba(139, 38, 53, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .memoriam-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .memoriam-photo .placeholder-icon {
            font-size: 48px;
            opacity: 0.3;
        }

        .memoriam-content {
            padding: 20px;
        }

        .memoriam-name {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .memoriam-dates {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 12px;
        }

        .memoriam-set {
            display: inline-block;
            background: rgba(212, 175, 90, 0.15);
            color: #D4AF5A;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }

        .memoriam-tribute {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
            margin-top: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .memoriam-actions {
            display: flex;
            gap: 10px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .btn-edit,
        .btn-delete {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: rgba(212, 175, 90, 0.15);
            color: #D4AF5A;
            border: 1px solid rgba(212, 175, 90, 0.3);
        }

        .btn-edit:hover {
            background: rgba(212, 175, 90, 0.25);
            color: #D4AF5A;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            cursor: pointer;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.25);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px;
            color: rgba(255, 255, 255, 0.4);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="p-30">
        <!-- Header -->
        <div class="memoriam-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="memoriam-title"><span>🕯️</span> {{ __('In Memoriam') }}</h1>
                <p class="text-gray-400 mb-0">{{ __('Honor and remember our departed alumni') }}</p>
            </div>
            <a href="{{ route('admin.in-memoriam.create') }}" class="btn-add">
                <i class="bi bi-plus-lg"></i> {{ __('Add Memorial') }}
            </a>
        </div>

        <!-- Grid -->
        <div class="memoriam-grid">
            @forelse($entries as $entry)
                <div class="memoriam-card">
                    <div class="memoriam-photo">
                        @if($entry->photo)
                            <img src="{{ asset($entry->photo) }}" alt="{{ $entry->name }}">
                        @else
                            <i class="bi bi-person placeholder-icon"></i>
                        @endif
                    </div>
                    <div class="memoriam-content">
                        <h3 class="memoriam-name">{{ $entry->name }}</h3>
                        <div class="memoriam-dates">
                            @if($entry->date_of_birth)
                                {{ $entry->date_of_birth->format('M d, Y') }} -
                            @endif
                            {{ $entry->date_of_passing->format('M d, Y') }}
                            @if($entry->age)
                                ({{ $entry->age }} years)
                            @endif
                        </div>
                        @if($entry->graduation_year)
                            <span class="memoriam-set">Set of {{ $entry->graduation_year }}</span>
                        @endif
                        @if($entry->tribute)
                            <p class="memoriam-tribute">{{ $entry->tribute }}</p>
                        @endif
                        <div class="memoriam-actions">
                            <a href="{{ route('admin.in-memoriam.edit', $entry->id) }}" class="btn-edit">
                                <i class="bi bi-pencil"></i> {{ __('Edit') }}
                            </a>
                            <button type="button" class="btn-delete" onclick="deleteMemorial({{ $entry->id }})">
                                <i class="bi bi-trash"></i> {{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-flower1"></i>
                    <p>{{ __('No memorial entries yet') }}</p>
                    <a href="{{ route('admin.in-memoriam.create') }}" class="btn-add mt-3">
                        <i class="bi bi-plus-lg"></i> {{ __('Add First Memorial') }}
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $entries->links() }}
        </div>
    </div>
@endsection

@push('script')
    <script>
        function deleteMemorial(id) {
            if (confirm('{{ __("Are you sure you want to delete this memorial entry?") }}')) {
                $.ajax({
                    url: '{{ url("admin/in-memoriam") }}/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function () {
                        toastr.error('{{ __("Failed to delete memorial") }}');
                    }
                });
            }
        }
    </script>
@endpush