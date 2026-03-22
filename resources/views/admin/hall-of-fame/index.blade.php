@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .hof-header {
            padding: 30px;
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.15), rgba(18, 22, 28, 0.98));
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(212, 175, 90, 0.2);
        }

        .hof-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #fff;
        }

        .hof-title span {
            color: #D4AF5A;
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

        .btn-secondary-alt {
            background: rgba(255, 255, 255, 0.1);
            color: #D4AF5A;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 175, 90, 0.3);
        }

        .btn-secondary-alt:hover {
            background: rgba(212, 175, 90, 0.15);
            color: #D4AF5A;
        }

        .hof-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 1200px) {
            .hof-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hof-grid {
                grid-template-columns: 1fr;
            }
        }

        .hof-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .hof-card:hover {
            transform: translateY(-5px);
            border-color: rgba(212, 175, 90, 0.3);
        }

        .hof-card.featured {
            border-color: rgba(212, 175, 90, 0.5);
        }

        .hof-card.featured::before {
            content: '★';
            position: absolute;
            top: 15px;
            right: 15px;
            color: #D4AF5A;
            font-size: 24px;
            z-index: 2;
        }

        .hof-photo {
            height: 200px;
            background: linear-gradient(180deg, rgba(212, 175, 90, 0.1) 0%, rgba(0, 0, 0, 0.8) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .hof-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hof-photo .placeholder-icon {
            font-size: 48px;
            opacity: 0.3;
            color: #D4AF5A;
        }

        .hof-content {
            padding: 20px;
        }

        .hof-name {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .hof-category {
            display: inline-block;
            background: rgba(212, 175, 90, 0.15);
            color: #D4AF5A;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .hof-achievement {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
        }

        .hof-meta {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .hof-description {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
            margin-top: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .hof-actions {
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
            color: #D4AF5A;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-active {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
        }

        .status-inactive {
            background: rgba(156, 163, 175, 0.15);
            color: #9ca3af;
        }
    </style>
@endpush

@section('content')
    <div class="p-30">
        <!-- Header -->
        <div class="hof-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="hof-title"><span>🏆</span> {{ __('Hall of Fame') }}</h1>
                <p class="text-gray-400 mb-0">{{ __('Celebrate distinguished alumni achievements') }}</p>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('admin.hall-of-fame.nominations') }}" class="btn-secondary-alt">
                    <i class="bi bi-envelope-paper"></i> {{ __('Nominations') }}
                </a>
                <a href="{{ route('admin.hall-of-fame.create') }}" class="btn-add">
                    <i class="bi bi-plus-lg"></i> {{ __('Add Inductee') }}
                </a>
            </div>
        </div>

        <!-- Grid -->
        <div class="hof-grid">
            @forelse($entries as $entry)
                <div class="hof-card {{ $entry->is_featured ? 'featured' : '' }}">
                    <div class="hof-photo">
                        @if($entry->photo)
                            <img src="{{ asset($entry->photo) }}" alt="{{ $entry->name }}">
                        @else
                            <i class="bi bi-trophy placeholder-icon"></i>
                        @endif
                    </div>
                    <div class="hof-content">
                        <h3 class="hof-name">{{ $entry->name }}</h3>
                        <span class="hof-category">{{ $categories[$entry->category] ?? $entry->category }}</span>
                        <p class="hof-achievement">{{ $entry->achievement_title }}</p>
                        <div class="hof-meta">
                            @if($entry->graduation_year)
                                Set of {{ $entry->graduation_year }} •
                            @endif
                            Inducted {{ $entry->year_inducted }}
                            <span
                                class="status-badge {{ $entry->status == 'active' ? 'status-active' : 'status-inactive' }} ms-2">
                                {{ ucfirst($entry->status) }}
                            </span>
                        </div>
                        @if($entry->achievement_description)
                            <p class="hof-description">{{ $entry->achievement_description }}</p>
                        @endif
                        <div class="hof-actions">
                            <a href="{{ route('admin.hall-of-fame.edit', $entry->id) }}" class="btn-edit">
                                <i class="bi bi-pencil"></i> {{ __('Edit') }}
                            </a>
                            <button type="button" class="btn-delete" onclick="deleteEntry({{ $entry->id }})">
                                <i class="bi bi-trash"></i> {{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-trophy"></i>
                    <p>{{ __('No Hall of Fame entries yet') }}</p>
                    <a href="{{ route('admin.hall-of-fame.create') }}" class="btn-add mt-3">
                        <i class="bi bi-plus-lg"></i> {{ __('Add First Inductee') }}
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
        function deleteEntry(id) {
            if (confirm('{{ __("Are you sure you want to delete this Hall of Fame entry?") }}')) {
                $.ajax({
                    url: '{{ url("admin/hall-of-fame") }}/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function () {
                        toastr.error('{{ __("Failed to delete entry") }}');
                    }
                });
            }
        }
    </script>
@endpush