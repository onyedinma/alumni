@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <style>
        .checkin-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .checkin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .checkin-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #fff;
        }

        .checkin-title i {
            color: var(--gold, #D4AF5A);
            margin-right: 12px;
        }

        .event-card {
            background: linear-gradient(145deg, #1a1f2e 0%, #12161C 100%);
            border: 1px solid rgba(212, 175, 90, 0.2);
            border-radius: 20px;
            padding: 28px;
            transition: all 0.3s ease;
            margin-bottom: 24px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
        }

        .event-card:hover {
            border-color: var(--gold, #D4AF5A);
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(212, 175, 90, 0.15);
        }

        .event-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .event-name {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }

        .event-date {
            font-size: 15px;
            color: #8EC5FC;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .event-date i {
            color: var(--gold, #D4AF5A);
            margin-right: 8px;
            font-size: 16px;
        }

        .event-stats {
            display: flex;
            gap: 24px;
            margin-bottom: 20px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 14px;
        }

        .stat-item {
            text-align: center;
            flex: 1;
            padding: 8px 12px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: #FFD700;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
        }

        .stat-label {
            font-size: 11px;
            color: #E6EAF0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            margin-top: 6px;
            opacity: 0.9;
        }

        .progress-bar-container {
            background: rgba(0, 0, 0, 0.4);
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            border-radius: 5px;
            transition: width 0.5s ease;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
        }

        .event-actions {
            display: flex;
            gap: 12px;
        }

        .btn-scan {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #000;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-scan:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
            color: #000;
        }

        .btn-report {
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-report:hover {
            border-color: #FFD700;
            color: #FFD700;
            background: rgba(255, 215, 0, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: var(--text-secondary, #B4BCC8);
        }

        .empty-state i {
            font-size: 60px;
            color: var(--gold, #D4AF5A);
            margin-bottom: 20px;
        }
    </style>

    <div class="checkin-panel">
        <div class="checkin-header">
            <h1 class="checkin-title">
                <i class="bi bi-qr-code-scan"></i>{{ $title }}
            </h1>
        </div>

        @if($events->count() > 0)
            <div class="row">
                @foreach($events as $event)
                    @php
                        $percentage = $event->event_tickets_count > 0
                            ? round(($event->checked_in_count / $event->event_tickets_count) * 100)
                            : 0;
                    @endphp
                    <div class="col-lg-6 col-xl-4">
                        <div class="event-card">
                            <div class="event-card-header">
                                <div>
                                    <h3 class="event-name">{{ $event->title }}</h3>
                                    <div class="event-date">
                                        <i class="bi bi-calendar3"></i>
                                        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>

                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-value">{{ $event->event_tickets_count }}</div>
                                    <div class="stat-label">{{ __('Total') }}</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">{{ $event->checked_in_count }}</div>
                                    <div class="stat-label">{{ __('Checked In') }}</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">{{ $percentage }}%</div>
                                    <div class="stat-label">{{ __('Rate') }}</div>
                                </div>
                            </div>

                            <div class="progress-bar-container">
                                <div class="progress-bar-fill" style="width: {{ $percentage }}%"></div>
                            </div>

                            <div class="event-actions">
                                <a href="{{ route('admin.event-check-in.scan', $event->id) }}" class="btn-scan">
                                    <i class="bi bi-qr-code-scan"></i> {{ __('Scan Tickets') }}
                                </a>
                                <a href="{{ route('admin.event-check-in.report', $event->id) }}" class="btn-report">
                                    <i class="bi bi-file-earmark-text"></i> {{ __('Report') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-calendar-x"></i>
                <h4>{{ __('No Recent Events') }}</h4>
                <p>{{ __('Events from the past month will appear here for check-in.') }}</p>
            </div>
        @endif
    </div>
@endsection