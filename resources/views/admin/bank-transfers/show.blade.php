@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush

@push('style')
    <style>
        .transfer-detail-card {
            background: rgba(30, 30, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            overflow: hidden;
        }

        .detail-header {
            background: linear-gradient(135deg, rgba(139, 38, 53, 0.3), rgba(18, 22, 28, 0.98));
            padding: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .detail-header h4 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        .reference-code {
            background: rgba(212, 175, 90, 0.1);
            border: 1px solid rgba(212, 175, 90, 0.3);
            padding: 8px 16px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 14px;
            color: #D4AF5A;
        }

        .detail-body {
            padding: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-item label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .info-item .value {
            font-size: 16px;
            color: #fff;
        }

        .amount-display {
            font-size: 32px;
            font-weight: 700;
            color: #D4AF5A;
            font-family: 'Playfair Display', serif;
        }

        .proof-section {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .proof-section h5 {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 16px;
        }

        .proof-image {
            max-width: 100%;
            max-height: 400px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 16px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .btn-approve {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(34, 197, 94, 0.4);
        }

        .btn-reject {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-reject:hover {
            background: rgba(239, 68, 68, 0.25);
        }

        .status-badge-lg {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending-lg {
            background: rgba(234, 179, 8, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .status-approved-lg {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-rejected-lg {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .notes-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 16px;
            color: #fff;
            resize: vertical;
            min-height: 100px;
        }

        .notes-input:focus {
            outline: none;
            border-color: #D4AF5A;
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
        <a href="{{ route('admin.bank-transfers.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Transfers') }}
        </a>

        <div class="transfer-detail-card">
            <div class="detail-header d-flex justify-content-between align-items-center">
                <div>
                    <h4>{{ __('Transfer Details') }}</h4>
                    <span class="reference-code mt-2 d-inline-block">{{ $transfer->reference }}</span>
                </div>
                <span class="status-badge-lg status-{{ $transfer->status }}-lg">
                    @if($transfer->status === 'pending')
                        <i class="bi bi-hourglass-split"></i>
                    @elseif($transfer->status === 'approved')
                        <i class="bi bi-check-circle"></i>
                    @else
                        <i class="bi bi-x-circle"></i>
                    @endif
                    {{ ucfirst($transfer->status) }}
                </span>
            </div>

            <div class="detail-body">
                <!-- Amount -->
                <div class="text-center mb-4">
                    <label class="d-block"
                        style="color: rgba(255,255,255,0.5); font-size: 12px; text-transform: uppercase;">{{ __('Transfer Amount') }}</label>
                    <div class="amount-display">₦{{ number_format($transfer->amount, 2) }}</div>
                </div>

                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-item">
                        <label>{{ __('From') }}</label>
                        <div class="value d-flex align-items-center gap-2">
                            <img src="{{ asset(getFileUrl($transfer->user->image)) }}"
                                style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
                            {{ $transfer->user->name }}
                        </div>
                    </div>
                    <div class="info-item">
                        <label>{{ __('Email') }}</label>
                        <div class="value">{{ $transfer->user->email }}</div>
                    </div>
                    <div class="info-item">
                        <label>{{ __('Payment For') }}</label>
                        <div class="value">{{ ucfirst($transfer->payment_for) }}</div>
                    </div>
                    <div class="info-item">
                        <label>{{ __('Submitted') }}</label>
                        <div class="value">{{ $transfer->created_at->format('M d, Y \a\t h:i A') }}</div>
                    </div>
                    @if($transfer->bank_name)
                        <div class="info-item">
                            <label>{{ __('Bank Name') }}</label>
                            <div class="value">{{ $transfer->bank_name }}</div>
                        </div>
                    @endif
                    @if($transfer->account_name)
                        <div class="info-item">
                            <label>{{ __('Account Name') }}</label>
                            <div class="value">{{ $transfer->account_name }}</div>
                        </div>
                    @endif
                </div>

                <!-- Proof of Payment -->
                <div class="proof-section">
                    <h5><i class="bi bi-image"></i> {{ __('Proof of Payment') }}</h5>
                    <a href="{{ getFileUrl($transfer->proof_image) }}" target="_blank">
                        <img src="{{ getFileUrl($transfer->proof_image) }}" alt="Proof of Payment" class="proof-image">
                    </a>
                </div>

                @if($transfer->isPending())
                    <!-- Admin Notes & Actions -->
                    <form id="approveForm" action="{{ route('admin.bank-transfers.approve', $transfer->id) }}" method="POST"
                        class="ajax" data-handler="commonResponseHandler">
                        @csrf
                        <div class="mb-4">
                            <label
                                style="color: rgba(255,255,255,0.7); margin-bottom: 10px; display: block;">{{ __('Admin Notes (optional)') }}</label>
                            <textarea name="admin_notes" class="notes-input"
                                placeholder="{{ __('Add any notes about this transfer...') }}"></textarea>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" class="btn-approve">
                                <i class="bi bi-check-lg"></i> {{ __('Approve Transfer') }}
                            </button>
                            <button type="button" class="btn-reject" onclick="rejectTransfer()">
                                <i class="bi bi-x-lg"></i> {{ __('Reject') }}
                            </button>
                        </div>
                    </form>

                    <form id="rejectForm" action="{{ route('admin.bank-transfers.reject', $transfer->id) }}" method="POST"
                        class="ajax d-none" data-handler="commonResponseHandler">
                        @csrf
                        <input type="hidden" name="admin_notes" id="rejectNotes">
                    </form>
                @else
                    <!-- Already Processed -->
                    @if($transfer->admin_notes)
                        <div class="mb-4">
                            <label
                                style="color: rgba(255,255,255,0.7); margin-bottom: 10px; display: block;">{{ __('Admin Notes') }}</label>
                            <div style="background: rgba(255,255,255,0.05); padding: 16px; border-radius: 12px; color: #fff;">
                                {{ $transfer->admin_notes }}
                            </div>
                        </div>
                    @endif
                    @if($transfer->approver)
                        <p style="color: rgba(255,255,255,0.5);">
                            {{ __('Processed by') }}: {{ $transfer->approver->name }}
                            {{ __('on') }} {{ $transfer->approved_at->format('M d, Y \a\t h:i A') }}
                        </p>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function rejectTransfer() {
            const notes = document.querySelector('textarea[name="admin_notes"]').value;
            if (!notes.trim()) {
                toastr.error('{{ __("Please provide a reason for rejection") }}');
                return;
            }
            document.getElementById('rejectNotes').value = notes;
            if (confirm('{{ __("Are you sure you want to reject this transfer?") }}')) {
                document.getElementById('rejectForm').submit();
            }
        }
    </script>
@endpush