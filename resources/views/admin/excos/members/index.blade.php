@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
<style>
    .exco-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
@endpush

@section('content')
    <div class="p-30">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h4 class="mb-1">{{ $title }}</h4>
                <p class="text-muted mb-0">{{ __('Manage individual excos for each tenor') }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.exco-tenors.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-calendar-event"></i> {{ __('Manage Tenors') }}
                </a>
                <a href="{{ route('admin.excos.create', ['tenor_id' => $selected_tenor]) }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> {{ __('Add Exco') }}
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.excos.index') }}" method="GET" class="row gx-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">{{ __('Filter by Tenor') }}</label>
                        <select name="tenor_id" class="form-control" onchange="this.form.submit()">
                            <option value="">{{ __('All Tenors') }}</option>
                            @foreach($tenors as $tenor)
                                <option value="{{ $tenor->id }}" {{ $selected_tenor == $tenor->id ? 'selected' : '' }}>
                                    {{ $tenor->title }} {{ $tenor->is_current ? ' (Current)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3">{{ __('Order') }}</th>
                                <th class="py-3">{{ __('Exco') }}</th>
                                <th class="py-3">{{ __('Position') }}</th>
                                <th class="py-3">{{ __('Tenor') }}</th>
                                <th class="py-3">{{ __('Status') }}</th>
                                <th class="px-4 py-3 text-end">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($excos as $exco)
                                <tr>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-secondary rounded-pill">{{ $exco->order }}</span>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            @if($exco->photo)
                                                <img src="{{ asset($exco->photo) }}" class="exco-photo me-3" alt="{{ $exco->name }}">
                                            @else
                                                <div class="exco-photo bg-light d-flex align-items-center justify-content-center me-3">
                                                    <i class="bi bi-person text-secondary fs-4"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $exco->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $exco->position }}</td>
                                    <td class="py-3">
                                        <span class="badge bg-info text-dark">{{ $exco->tenor->title }}</span>
                                    </td>
                                    <td class="py-3">
                                        @if($exco->status == 1)
                                            <span class="badge bg-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <a href="{{ route('admin.excos.edit', $exco->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteItem('{{ route('admin.excos.destroy', $exco->id) }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="bi bi-people fs-2 d-block mb-2"></i>
                                        {{ __('No excos found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($excos->hasPages())
                <div class="card-footer bg-white border-0 pt-3 pb-3">
                    {{ $excos->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script>
        function deleteItem(url) {
            Swal.fire({
                title: '{{ __("Are you sure?") }}',
                text: '{{ __("You will not be able to revert this!") }}',
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
