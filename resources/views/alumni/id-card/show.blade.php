@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <style>
        .id-card-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .id-card-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .id-card-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: #fff;
        }

        .id-card-header h1 i {
            color: var(--gold, #D4AF5A);
            margin-right: 10px;
        }

        .id-card-container {
            max-width: 420px;
            margin: 0 auto;
        }

        .id-card {
            background: linear-gradient(145deg, #1A1A2E 0%, #0D0D12 100%);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .id-card-header-stripe {
            height: 80px;
            background: linear-gradient(135deg, var(--gold, #D4AF5A), #B8934A);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .id-card-org-name {
            color: #000;
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .id-card-photo-section {
            position: relative;
            padding: 20px;
            display: flex;
            justify-content: center;
            margin-top: -40px;
        }

        .id-card-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--gold, #D4AF5A);
            background: #1A1A2E;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .id-card-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .id-card-photo-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: var(--gold, #D4AF5A);
        }

        .id-card-body {
            padding: 0 30px 30px;
            text-align: center;
        }

        .id-card-name {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 5px;
        }

        .id-card-id {
            font-size: 14px;
            color: var(--gold, #D4AF5A);
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .id-card-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .id-card-detail {
            text-align: center;
        }

        .id-card-detail-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .id-card-detail-value {
            font-size: 14px;
            color: #fff;
            font-weight: 500;
        }

        .id-card-qr {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .id-card-qr img {
            width: 100px;
            height: 100px;
        }

        .id-card-validity {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .id-card-actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-download {
            background: linear-gradient(135deg, var(--gold, #D4AF5A), #B8934A);
            color: #000;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            color: #000;
        }

        .no-id-card {
            text-align: center;
            padding: 60px 20px;
            background: var(--bg-surface, #12161C);
            border-radius: 20px;
        }

        .no-id-card i {
            font-size: 60px;
            color: var(--gold, #D4AF5A);
            margin-bottom: 20px;
        }

        .no-id-card h3 {
            color: #fff;
            margin-bottom: 15px;
        }

        .no-id-card p {
            color: var(--text-secondary, #B4BCC8);
            margin-bottom: 25px;
        }

        .btn-generate {
            background: linear-gradient(135deg, var(--gold, #D4AF5A), #B8934A);
            color: #000;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-generate:hover {
            transform: translateY(-2px);
        }
    </style>

    <div class="id-card-panel">
        <div class="id-card-header">
            <h1><i class="bi bi-person-badge"></i>{{ $title }}</h1>
        </div>

        <div class="id-card-container">
            @if($hasIdCard)
                <div class="id-card">
                    <div class="id-card-header-stripe">
                        <span class="id-card-org-name">{{ getOption('app_name', 'Alumni Association') }}</span>
                    </div>

                    <div class="id-card-photo-section">
                        <div class="id-card-photo">
                            @if($idCardData['photo'])
                                <img src="{{ $idCardData['photo'] }}" alt="{{ $idCardData['name'] }}">
                            @else
                                <div class="id-card-photo-placeholder">
                                    <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="id-card-body">
                        <h2 class="id-card-name">{{ $idCardData['name'] }}</h2>
                        <div class="id-card-id">{{ $idCardData['alumni_id'] }}</div>

                        <div class="id-card-details">
                            @if($idCardData['graduation_year'])
                                <div class="id-card-detail">
                                    <div class="id-card-detail-label">{{ __('Set') }}</div>
                                    <div class="id-card-detail-value">{{ $idCardData['graduation_year'] }}</div>
                                </div>
                            @endif
                            @if($idCardData['house'])
                                <div class="id-card-detail">
                                    <div class="id-card-detail-label">{{ __('House') }}</div>
                                    <div class="id-card-detail-value">{{ $idCardData['house'] }}</div>
                                </div>
                            @endif
                        </div>

                        <div class="id-card-qr">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode($idCardData['qr_url']) }}"
                                alt="QR Code">
                        </div>

                        <div class="id-card-validity">
                            {{ __('Generated') }}: {{ $idCardData['generated_at'] }}
                        </div>
                    </div>
                </div>

                <div class="id-card-actions">
                    <a href="{{ route('alumniUser.id-card.download') }}" class="btn-download">
                        <i class="bi bi-printer"></i> {{ __('Print ID Card') }}
                    </a>
                </div>
            @else
                <div class="no-id-card">
                    <i class="bi bi-person-badge"></i>
                    <h3>{{ __('No ID Card Yet') }}</h3>
                    <p>{{ __('Generate your digital Alumni ID Card to use as proof of membership.') }}</p>

                    <form action="{{ route('alumniUser.id-card.generate') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-generate">
                            <i class="bi bi-magic"></i> {{ __('Generate My ID Card') }}
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection