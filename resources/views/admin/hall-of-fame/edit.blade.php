@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .form-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, rgba(212, 175, 90, 0.15), rgba(18, 22, 28, 0.98));
            padding: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .form-header h4 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        .form-body {
            padding: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 14px 16px;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #D4AF5A;
            background: rgba(255, 255, 255, 0.08);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        select.form-control {
            appearance: none;
            cursor: pointer;
        }

        .photo-upload {
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .photo-upload:hover {
            border-color: rgba(212, 175, 90, 0.5);
        }

        .photo-upload i {
            font-size: 36px;
            color: rgba(255, 255, 255, 0.3);
            margin-bottom: 10px;
        }

        .photo-upload p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            margin: 0;
        }

        .photo-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 12px;
        }

        .current-photo {
            margin-bottom: 15px;
        }

        .current-photo img {
            max-width: 150px;
            border-radius: 12px;
        }

        .form-actions {
            display: flex;
            gap: 16px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .btn-save {
            background: linear-gradient(135deg, #D4AF5A, #B8973E);
            color: #000;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212, 175, 90, 0.3);
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.7);
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .back-link {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #D4AF5A;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.7);
        }

        .checkbox-label input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: #D4AF5A;
        }
    </style>
@endpush

@section('content')
    <div class="p-30">
        <a href="{{ route('admin.hall-of-fame.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Hall of Fame') }}
        </a>

        <div class="form-card">
            <div class="form-header">
                <h4>🏆 {{ $title }}</h4>
            </div>
            <div class="form-body">
                <form action="{{ route('admin.hall-of-fame.update', $entry->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="form-group">
                            <label>{{ __('Full Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="{{ __('Enter full name') }}" value="{{ old('name', $entry->name) }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Graduation Year (Set)') }}</label>
                            <input type="number" name="graduation_year" class="form-control" placeholder="e.g. 2007"
                                value="{{ old('graduation_year', $entry->graduation_year) }}" min="1900"
                                max="{{ date('Y') }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Category') }} <span class="text-danger">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="">{{ __('Select category') }}</option>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', $entry->category) == $key ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Year Inducted') }} <span class="text-danger">*</span></label>
                            <input type="number" name="year_inducted" class="form-control" required
                                value="{{ old('year_inducted', $entry->year_inducted) }}" min="1900" max="{{ date('Y') }}">
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Achievement Title') }} <span class="text-danger">*</span></label>
                            <input type="text" name="achievement_title" class="form-control" required
                                placeholder="{{ __('e.g. Outstanding Leadership Award') }}"
                                value="{{ old('achievement_title', $entry->achievement_title) }}">
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Photo') }}</label>
                            @if($entry->photo)
                                <div class="current-photo">
                                    <img src="{{ asset($entry->photo) }}" alt="{{ $entry->name }}">
                                    <p class="text-gray-400 mt-2">{{ __('Current photo') }}</p>
                                </div>
                            @endif
                            <div class="photo-upload" onclick="document.getElementById('photoInput').click()">
                                <i class="bi bi-trophy"></i>
                                <p>{{ __('Click to upload new photo') }}</p>
                                <img id="photoPreview" class="photo-preview" src="" style="display: none;">
                            </div>
                            <input type="file" id="photoInput" name="photo" accept="image/*" style="display: none"
                                onchange="previewPhoto(this)">
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Achievement Description') }}</label>
                            <textarea name="achievement_description" class="form-control"
                                placeholder="{{ __('Describe the achievements that warranted this recognition...') }}">{{ old('achievement_description', $entry->achievement_description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status', $entry->status) == 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="inactive" {{ old('status', $entry->status) == 'inactive' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>&nbsp;</label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $entry->is_featured) ? 'checked' : '' }}>
                                {{ __('Feature this inductee on homepage') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg"></i> {{ __('Update Inductee') }}
                        </button>
                        <a href="{{ route('admin.hall-of-fame.index') }}" class="btn-cancel">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('photoPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush