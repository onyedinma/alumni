@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="p-30">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">{{ $title }}</h4>
                <p class="text-muted mb-0">{{ __('Manage the different periods of executives') }}</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTenorModal">
                    <i class="bi bi-plus-lg"></i> {{ __('Add Tenor') }}
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">{{ __('Title') }}</th>
                                <th class="py-3">{{ __('Start Date') }}</th>
                                <th class="py-3">{{ __('End Date') }}</th>
                                <th class="py-3">{{ __('Status') }}</th>
                                <th class="px-4 py-3 text-end">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tenors as $tenor)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-bold">{{ $tenor->title }}</div>
                                    </td>
                                    <td class="py-3">{{ \Carbon\Carbon::parse($tenor->start_date)->format('M d, Y') }}</td>
                                    <td class="py-3">
                                        {{ $tenor->end_date ? \Carbon\Carbon::parse($tenor->end_date)->format('M d, Y') : __('Present') }}
                                    </td>
                                    <td class="py-3">
                                        @if($tenor->is_current)
                                            <span class="badge bg-success">{{ __('Current') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('Past') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" data-bs-target="#editTenorModal{{ $tenor->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        
                                        <!-- Manage Excos Button -->
                                        <a href="{{ route('admin.excos.index', ['tenor_id' => $tenor->id]) }}" 
                                           class="btn btn-sm btn-outline-info me-1" title="Manage Members">
                                           <i class="bi bi-people"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteItem('{{ route('admin.exco-tenors.destroy', $tenor->id) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editTenorModal{{ $tenor->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.exco-tenors.update', $tenor->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('Edit Tenor') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3 text-start">
                                                        <label class="form-label">{{ __('Title (e.g. 2025 - 2028 Executives)') }} <span class="text-danger">*</span></label>
                                                        <input type="text" name="title" class="form-control" value="{{ $tenor->title }}" required>
                                                    </div>
                                                    <div class="mb-3 text-start">
                                                        <label class="form-label">{{ __('Start Date') }} <span class="text-danger">*</span></label>
                                                        <input type="date" name="start_date" class="form-control" value="{{ $tenor->start_date }}" required>
                                                    </div>
                                                    <div class="mb-3 text-start">
                                                        <label class="form-label">{{ __('End Date') }}</label>
                                                        <input type="date" name="end_date" class="form-control" value="{{ $tenor->end_date }}">
                                                        <small class="text-muted">{{ __('Leave blank if this is the current active tenor') }}</small>
                                                    </div>
                                                    <div class="mb-3 text-start">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="is_current" value="1" id="is_current_{{ $tenor->id }}" {{ $tenor->is_current ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="is_current_{{ $tenor->id }}">
                                                                {{ __('Mark as current active tenor') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                        {{ __('No tenors found. Add your first exco tenor.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($tenors->hasPages())
                <div class="card-footer bg-white border-0 pt-3 pb-3">
                    {{ $tenors->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addTenorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.exco-tenors.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Tenor') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-start">
                            <label class="form-label">{{ __('Title (e.g. 2025 - 2028 Executives)') }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">{{ __('Start Date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">{{ __('End Date') }}</label>
                            <input type="date" name="end_date" class="form-control">
                            <small class="text-muted">{{ __('Leave blank if this is the current active tenor') }}</small>
                        </div>
                        <div class="mb-3 text-start">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_current" value="1" id="is_current_new" checked>
                                <label class="form-check-label" for="is_current_new">
                                    {{ __('Mark as current active tenor') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save Tenor') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function deleteItem(url) {
            Swal.fire({
                title: '{{ __("Are you sure?") }}',
                text: '{{ __("You will not be able to revert this! All excos under this tenor will also be deleted.") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ __("Yes, delete it!") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (response) {
                            toastr.error('{{ __("Something went wrong.") }}');
                        }
                    });
                }
            })
        }
    </script>
@endpush
