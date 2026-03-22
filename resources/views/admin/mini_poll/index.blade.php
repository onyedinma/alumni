@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPollModal">
                        <i class="fa-solid fa-plus me-1"></i> {{ __('Create Poll') }}
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('Question') }}</th>
                                    <th>{{ __('Options') }}</th>
                                    <th>{{ __('Votes') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($polls as $poll)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $poll->question }}</td>
                                        <td>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($poll->options as $option)
                                                    <li>{{ $option->option_text }} - <strong>{{ $option->vote_count }}</strong>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $poll->votes_count ?? $poll->votes()->count() }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="status_{{ $poll->id }}"
                                                    onchange="changeStatus('{{ route('admin.mini-poll.change-status') }}', '{{ $poll->id }}', this.checked ? 1 : 0)"
                                                    {{ $poll->status == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>{{ $poll->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteItem('{{ route('admin.mini-poll.delete', $poll->id) }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">{{ __('No polls found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createPollModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Create Mini Poll') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.mini-poll.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Question') }}</label>
                            <input type="text" name="question" class="form-control" required
                                placeholder="e.g. What is your favorite school memory?">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Options') }}</label>
                            <div id="options-container">
                                <div class="input-group mb-2">
                                    <input type="text" name="options[]" class="form-control" placeholder="Option 1"
                                        required>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="text" name="options[]" class="form-control" placeholder="Option 2"
                                        required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addOption()">
                                <i class="fa-solid fa-plus"></i> {{ __('Add Option') }}
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            function addOption() {
                const container = document.getElementById('options-container');
                const count = container.children.length + 1;
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                            <input type="text" name="options[]" class="form-control" placeholder="Option ${count}" required>
                            <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        `;
                container.appendChild(div);
            }

            function changeStatus(url, id, status) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        id: id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        toastr.success(response.message);
                    },
                    error: function (error) {
                        toastr.error('Something went wrong');
                    }
                });
            }
        </script>
    @endpush
@endsection