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

        .current-photo {
            max-width: 150px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .photo-upload {
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .photo-upload:hover {
            border-color: rgba(212, 175, 90, 0.5);
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
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.7);
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-link {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
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
                <form action="{{ route('admin.in-memoriam.update', $entry->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="form-group">
                            <label>{{ __('Full Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required
                                value="{{ old('name', $entry->name) }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Graduation Year (Set)') }}</label>
                            <input type="number" name="graduation_year" class="form-control"
                                value="{{ old('graduation_year', $entry->graduation_year) }}" min="1900"
                                max="{{ date('Y') }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Date of Birth') }}</label>
                            <input type="date" name="date_of_birth" class="form-control"
                                value="{{ old('date_of_birth', $entry->date_of_birth?->format('Y-m-d')) }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Date of Passing') }} <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_passing" class="form-control" required
                                value="{{ old('date_of_passing', $entry->date_of_passing->format('Y-m-d')) }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('House') }}</label>
                            <input type="text" name="house" class="form-control" value="{{ old('house', $entry->house) }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Class Arm') }}</label>
                            <input type="text" name="class_arm" class="form-control"
                                value="{{ old('class_arm', $entry->class_arm) }}">
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Photo') }}</label>
                            @if($entry->photo)
                                <img src="{{ asset($entry->photo) }}" alt="{{ $entry->name }}" class="current-photo">
                            @endif
                            <div class="photo-upload" onclick="document.getElementById('photoInput').click()">
                                <i class="bi bi-image" style="font-size: 24px; color: rgba(255,255,255,0.3);"></i>
                                <p style="color: rgba(255,255,255,0.5); margin: 10px 0 0;">{{ __('Click to change photo') }}
                                </p>
                            </div>
                            <input type="file" id="photoInput" name="photo" accept="image/*" style="display: none">
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Tribute / Short Message') }}</label>
                            <textarea name="tribute" class="form-control">{{ old('tribute', $entry->tribute) }}</textarea>
                        </div>

                        <div class="form-group full-width">
                            <label>{{ __('Full Obituary') }}</label>
                            <textarea name="obituary" class="form-control"
                                style="min-height: 180px">{{ old('obituary', $entry->obituary) }}</textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg"></i> {{ __('Update Memorial') }}
                        </button>
                        <a href="{{ route('admin.in-memoriam.index') }}" class="btn-cancel">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection