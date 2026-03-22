@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <style>
        .scan-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .scan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .scan-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .scan-title i {
            color: var(--gold, #D4AF5A);
            margin-right: 12px;
        }

        .btn-back {
            background: transparent;
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-secondary, #B4BCC8);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            border-color: var(--gold, #D4AF5A);
            color: var(--gold, #D4AF5A);
        }

        .scan-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        @media (max-width: 991px) {
            .scan-container {
                grid-template-columns: 1fr;
            }
        }

        .scan-card {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 16px;
            padding: 30px;
        }

        .scan-card-title {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .scan-card-title i {
            color: var(--gold, #D4AF5A);
        }

        .manual-input-group {
            display: flex;
            gap: 10px;
        }

        .manual-input {
            flex: 1;
            background: var(--bg-primary, #0B0E11);
            border: 1px solid var(--border-dark, #1F2630);
            color: #fff;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 16px;
            text-transform: uppercase;
        }

        .manual-input:focus {
            outline: none;
            border-color: var(--gold, #D4AF5A);
        }

        .btn-checkin {
            background: linear-gradient(135deg, var(--gold, #D4AF5A), #B8934A);
            color: #000;
            border: none;
            padding: 14px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-checkin:hover {
            transform: scale(1.02);
        }

        .btn-checkin:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 24px;
        }

        .stat-box {
            background: var(--bg-primary, #0B0E11);
            padding: 16px;
            border-radius: 10px;
            text-align: center;
        }

        .stat-box-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--gold, #D4AF5A);
        }

        .stat-box-label {
            font-size: 12px;
            color: var(--text-secondary, #B4BCC8);
            text-transform: uppercase;
        }

        .recent-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .recent-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border-bottom: 1px solid var(--border-dark, #1F2630);
        }

        .recent-item:last-child {
            border-bottom: none;
        }

        .recent-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .recent-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gold, #D4AF5A);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #000;
        }

        .recent-name {
            color: #fff;
            font-weight: 500;
        }

        .recent-time {
            color: var(--text-secondary, #B4BCC8);
            font-size: 13px;
        }

        .result-message {
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            display: none;
        }

        .result-message.success {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22C55E;
            display: block;
        }

        .result-message.error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #EF4444;
            display: block;
        }

        .result-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .qr-scanner-area {
            background: var(--bg-primary, #0B0E11);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            margin-bottom: 20px;
        }

        .qr-scanner-area i {
            font-size: 60px;
            color: var(--gold, #D4AF5A);
            margin-bottom: 15px;
        }

        .qr-scanner-text {
            color: var(--text-secondary, #B4BCC8);
        }
    </style>

    <div class="scan-panel">
        <div class="scan-header">
            <h1 class="scan-title">
                <i class="bi bi-qr-code-scan"></i>{{ $event->title }}
            </h1>
            <a href="{{ route('admin.event-check-in.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> {{ __('Back to Events') }}
            </a>
        </div>

        <div class="scan-container">
            <!-- Scanner Column -->
            <div class="scan-card">
                <h3 class="scan-card-title">
                    <i class="bi bi-keyboard"></i> {{ __('Manual Entry') }}
                </h3>

                <div class="qr-scanner-area">
                    <i class="bi bi-qr-code"></i>
                    <p class="qr-scanner-text">{{ __('Enter ticket number below or scan QR code') }}</p>
                </div>

                <form id="checkInForm">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <div class="manual-input-group">
                        <input type="text" name="ticket_number" id="ticketNumber" class="manual-input"
                            placeholder="{{ __('Enter ticket number...') }}" autofocus autocomplete="off">
                        <button type="submit" class="btn-checkin" id="checkInBtn">
                            <i class="bi bi-check-circle"></i> {{ __('Check In') }}
                        </button>
                    </div>
                </form>

                <div id="resultMessage" class="result-message"></div>
            </div>

            <!-- Stats Column -->
            <div class="scan-card">
                <h3 class="scan-card-title">
                    <i class="bi bi-bar-chart"></i> {{ __('Live Stats') }}
                </h3>

                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-box-value" id="statTotal">{{ $stats['total'] }}</div>
                        <div class="stat-box-label">{{ __('Total') }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-box-value" id="statCheckedIn">{{ $stats['checked_in'] }}</div>
                        <div class="stat-box-label">{{ __('Checked In') }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-box-value" id="statPending">{{ $stats['pending'] }}</div>
                        <div class="stat-box-label">{{ __('Pending') }}</div>
                    </div>
                </div>

                <h4 class="scan-card-title" style="font-size: 16px;">
                    <i class="bi bi-clock-history"></i> {{ __('Recent Check-ins') }}
                </h4>

                <div class="recent-list" id="recentList">
                    @forelse($recentCheckins as $ticket)
                        <div class="recent-item">
                            <div class="recent-user">
                                <div class="recent-avatar">
                                    {{ strtoupper(substr($ticket->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="recent-name">{{ $ticket->user->name ?? 'Unknown' }}</div>
                                    <div class="recent-time">{{ $ticket->checked_in_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-4">{{ __('No check-ins yet') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('checkInForm');
                const ticketInput = document.getElementById('ticketNumber');
                const resultDiv = document.getElementById('resultMessage');
                const checkInBtn = document.getElementById('checkInBtn');

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const ticketNumber = ticketInput.value.trim();
                    if (!ticketNumber) return;

                    checkInBtn.disabled = true;
                    checkInBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';

                    try {
                        const response = await fetch('{{ route("admin.event-check-in.process") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                ticket_number: ticketNumber,
                                event_id: {{ $event->id }}
                                })
                        });

                        const data = await response.json();

                        if (data.status === 1) {
                            resultDiv.className = 'result-message success';
                            resultDiv.innerHTML = `
                                    <div class="result-name">✓ ${data.data.ticket.user_name}</div>
                                    <div>Checked in at ${data.data.ticket.checked_in_at}</div>
                                `;

                            // Update stats
                            const checkedIn = parseInt(document.getElementById('statCheckedIn').textContent) + 1;
                            const pending = parseInt(document.getElementById('statPending').textContent) - 1;
                            document.getElementById('statCheckedIn').textContent = checkedIn;
                            document.getElementById('statPending').textContent = Math.max(0, pending);

                            // Add to recent list
                            const recentList = document.getElementById('recentList');
                            const initial = data.data.ticket.user_name.charAt(0).toUpperCase();
                            const newItem = `
                                    <div class="recent-item">
                                        <div class="recent-user">
                                            <div class="recent-avatar">${initial}</div>
                                            <div>
                                                <div class="recent-name">${data.data.ticket.user_name}</div>
                                                <div class="recent-time">Just now</div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            recentList.insertAdjacentHTML('afterbegin', newItem);

                            // Play success sound (optional)
                            // new Audio('/sounds/success.mp3').play();
                        } else {
                            resultDiv.className = 'result-message error';
                            if (data.data && data.data.already_checked_in) {
                                resultDiv.innerHTML = `
                                        <div class="result-name">⚠ Already Checked In</div>
                                        <div>${data.data.user_name} was checked in at ${data.data.checked_in_at}</div>
                                    `;
                            } else {
                                resultDiv.innerHTML = `<div class="result-name">✗ ${data.message}</div>`;
                            }
                        }
                    } catch (error) {
                        resultDiv.className = 'result-message error';
                        resultDiv.innerHTML = `<div class="result-name">✗ Connection error</div>`;
                    }

                    checkInBtn.disabled = false;
                    checkInBtn.innerHTML = '<i class="bi bi-check-circle"></i> Check In';
                    ticketInput.value = '';
                    ticketInput.focus();
                });
            });
        </script>
    @endpush
@endsection