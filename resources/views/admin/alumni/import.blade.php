@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp
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

        /* Buttons */
        .premium-btn {
            background: linear-gradient(135deg, var(--gold, #D4AF5A) 0%, #b8934a 100%) !important;
            color: #000 !important;
            border: none !important;
            font-weight: 600 !important;
            border-radius: 12px;
            padding: 10px 26px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 90, 0.3);
            color: #000;
        }

        .premium-btn-outline {
            background: transparent !important;
            color: var(--gold, #D4AF5A) !important;
            border: 1px solid var(--gold, #D4AF5A) !important;
            font-weight: 600 !important;
            border-radius: 12px;
            padding: 10px 26px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .premium-btn-outline:hover {
            background: rgba(212, 175, 90, 0.1) !important;
            transform: translateY(-2px);
        }

        .primary-form-control {
            background-color: var(--bg-primary, #0B0E11) !important;
            border: 1px solid var(--border-dark, #1F2630) !important;
            color: var(--text-primary, #E6EAF0) !important;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
        }

        .primary-form-control:focus {
            border-color: var(--gold, #D4AF5A) !important;
            outline: none;
        }

        .text-gold {
            color: var(--gold, #D4AF5A);
        }

        .text-white {
            color: #fff;
        }

        .text-muted-light {
            color: #B4BCC8;
        }

        .alert-custom {
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-success-custom {
            background: rgba(40, 167, 69, 0.1);
            border-color: rgba(40, 167, 69, 0.3);
            color: #28a745;
        }

        .alert-error-custom {
            background: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.3);
            color: #dc3545;
        }
    </style>

    <div class="premium-admin-panel">
        <div class="container-fluid">
            <h4 class="fs-24 fw-600 premium-header text-white pb-16" style="font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-file-import"
                    style="color: var(--gold, #D4AF5A); margin-right: 10px;"></i>{{ __($title) }}
            </h4>

            @if(session('success'))
                <div class="alert alert-success alert-custom alert-success-custom">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-custom alert-error-custom">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-custom alert-error-custom">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="premium-card mb-4">
                        <h5 class="text-white mb-3">1. Download Sample</h5>
                        <p class="text-muted-light mb-4">Download the sample CSV file to ensure your data is formatted
                            correctly.</p>
                        <a href="{{ route('admin.alumni.import.sample') }}" class="premium-btn-outline">
                            <i class="fa fa-download me-2"></i> Download Sample CSV
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="premium-card">
                        <h5 class="text-white mb-3">2. Upload CSV File</h5>
                        <p class="text-muted-light mb-4">Upload your filled CSV file here. Ensure email addresses are
                            unique.</p>

                        <form action="{{ route('admin.alumni.import.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label text-gold">Select CSV File</label>
                                <input type="file" name="file" id="file" class="primary-form-control" accept=".csv, .txt"
                                    required>
                                <small class="text-muted-light">Allowed types: .csv, .txt</small>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="update_existing"
                                        id="update_existing" value="1"
                                        style="background-color: var(--bg-primary); border-color: var(--gold);">
                                    <label class="form-check-label text-muted-light" for="update_existing">
                                        <strong class="text-gold">Update existing records</strong> - If an email already
                                        exists, update their profile instead of skipping
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="premium-btn">
                                <i class="fa fa-upload me-2"></i> Import Alumni
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="premium-card" style="border-top-color: var(--border-dark);">
                        <h5 class="text-white mb-3">Import Instructions</h5>
                        <ul class="text-muted-light ps-3">
                            <li><strong>Format:</strong> Please save your Excel file as <strong>CSV (Comma
                                    delimited)</strong> before uploading.</li>
                            <li><strong>Classes:</strong> Use the exact names like "JSS1 A", "SS3 G". If a class is not
                                found, it may be ignored.</li>
                            <li><strong>Houses:</strong> Use the exact names like "Red House", "Green House".</li>
                            <li><strong>Dates:</strong> Use format YYYY-MM-DD (e.g., 1990-01-01).</li>
                            <li><strong>Emails:</strong> Must be unique. Duplicate emails will be skipped unless "Update
                                existing records" is checked.</li>
                            <li><strong>Update Mode:</strong> When checked, existing alumni profiles will be updated with
                                new data from the CSV.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection