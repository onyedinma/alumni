@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@section('content')
    <div class="p-30">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('admin.excos.index', ['tenor_id' => $exco->exco_tenor_id]) }}" class="text-decoration-none text-muted mb-2 d-inline-block">
                    <i class="bi bi-arrow-left"></i> {{ __('Back to Excos') }}
                </a>
                <h4 class="mb-1">{{ $title }}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('admin.excos.update', $exco->id) }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm">
                    @csrf
                    @method('PUT')
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Select Tenor') }} <span class="text-danger">*</span></label>
                            <select name="exco_tenor_id" class="form-select" required>
                                <option value="">{{ __('--- Select Tenor ---') }}</option>
                                @foreach($tenors as $tenor)
                                    <option value="{{ $tenor->id }}" {{ $exco->exco_tenor_id == $tenor->id ? 'selected' : '' }}>
                                        {{ $tenor->title }} {{ $tenor->is_current ? ' (Current)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name', $exco->name) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Position') }} <span class="text-danger">*</span></label>
                                <input type="text" name="position" class="form-control" required value="{{ old('position', $exco->position) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Sort Order') }}</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', $exco->order) }}">
                                <small class="text-muted">{{ __('Lower number appears first') }}</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ __('Status') }}</label>
                                <select name="status" class="form-select">
                                    <option value="active" {{ $exco->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                    <option value="inactive" {{ $exco->status == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Upload New Photo') }}</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" id="photoInput">
                            <div class="mt-2 preview-container" style="{{ !$exco->photo ? 'display: none;' : '' }}">
                                <img id="photoPreview" src="{{ $exco->photo ? asset($exco->photo) : '' }}" alt="Preview" class="rounded" style="max-height: 150px; border: 1px solid #ddd; padding: 3px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ __('Short Bio') }}</label>
                            <textarea name="bio" class="form-control" rows="4">{{ old('bio', $exco->bio) }}</textarea>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.excos.index', ['tenor_id' => $exco->exco_tenor_id]) }}" class="btn btn-secondary me-2">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Update Exco') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    $('#photoInput').on('change', function() {
        const [file] = this.files;
        if (file) {
            $('.preview-container').show();
            $('#photoPreview').attr('src', URL.createObjectURL(file));
        }
    });
</script>
@endpush
