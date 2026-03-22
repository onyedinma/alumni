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
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3), rgba(18, 22, 28, 0.98));
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
            display: none;
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
    </style>
@endpush

@section('content')
    <div class="p-30">
        <a href="{{ route('admin.in-memoriam.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Memorials') }}
        </a>

        <div class="form-card">
            <div class="form-header">
                <h4>🕯️ {{ $title }}</h4>
            </div>
            <div class="form-body">
                <form action="{{ route('admin.in-memoriam.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>{{ __('Full Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="{{ __('Enter full name') }}" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Graduation Year (Set)') }}</label>
                            <input type="number" name="graduation_year" class="form-control" placeholder="e.g. 2007"
                                value="{{ old('graduation_year') }}" min="1900" max="{{ date('Y') }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Date of Birth') }}</label>
                            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Date of Passing') }} <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_passing" class="form-control" required
                                value="{{ old('date_of_passing') }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('House') }}</label>
                            <input type="text" name="house" class="form-control" placeholder="{{ __('e.g. Red House') }}"
                                value="{{ old('house') }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Class Arm') }}</label>
                            <input type="text" name="class_arm" class="form-control" placeholder="{{ __('e.g. SS3A') }}"
                                value="{{ old('class_arm') }}">
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Photo') }}</label>
                            <div class="photo-upload" onclick="document.getElementById('photoInput').click()">
                                <i class="bi bi-image"></i>
                                <p>{{ __('Click to upload photo') }}</p>
                                <img id="photoPreview" class="photo-preview" src="">
                            </div>
                            <input type="file" id="photoInput" name="photo" accept="image/*" style="display: none"
                                onchange="previewPhoto(this)">
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Tribute / Short Message') }}</label>
                            <textarea name="tribute" class="form-control"
                                placeholder="{{ __('A short tribute or remembrance...') }}">{{ old('tribute') }}</textarea>
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Full Obituary') }}</label>
                            <textarea name="obituary" class="form-control" style="min-height: 180px"
                                placeholder="{{ __('Full obituary or life story...') }}">{{ old('obituary') }}</textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg"></i> {{ __('Save Memorial') }}
                        </button>
                        <a href="{{ route('admin.in-memoriam.index') }}" class="btn-cancel">
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