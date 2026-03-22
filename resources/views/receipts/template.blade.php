<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Payment Receipt - {{ $receipt_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
            color: #333;
        }

        .receipt {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            background: linear-gradient(135deg, #8B2635, #6B1D29);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .receipt-header img {
            max-height: 60px;
            margin-bottom: 15px;
        }

        .org-name {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .receipt-title {
            font-size: 14px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .receipt-body {
            padding: 30px;
        }

        .receipt-number {
            text-align: center;
            background: #f8f8f8;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .receipt-number label {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .receipt-number span {
            display: block;
            font-size: 18px;
            font-weight: 700;
            color: #8B2635;
            margin-top: 5px;
            font-family: monospace;
        }

        .amount-section {
            text-align: center;
            padding: 25px;
            background: linear-gradient(135deg, #D4AF5A, #B8973E);
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .amount-label {
            font-size: 12px;
            color: rgba(0, 0, 0, 0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .amount-value {
            font-size: 36px;
            font-weight: 700;
            color: #000;
            margin-top: 5px;
        }

        .details-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .detail-row {
            display: table-row;
        }

        .detail-label,
        .detail-value {
            display: table-cell;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            color: #888;
            font-size: 13px;
            width: 40%;
        }

        .detail-value {
            font-weight: 500;
            text-align: right;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .receipt-footer {
            background: #f8f8f8;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .footer-text {
            font-size: 12px;
            color: #888;
            line-height: 1.6;
        }

        .contact-info {
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }

        .contact-info span {
            margin: 0 10px;
        }

        .print-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #8B2635;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .receipt {
                box-shadow: none;
                max-width: 100%;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="receipt-header">
            @if($org_logo)
                <img src="{{ getFileUrl($org_logo) }}" alt="{{ $org_name }}">
            @endif
            <div class="org-name">{{ $org_name }}</div>
            <div class="receipt-title">Official Payment Receipt</div>
        </div>

        <div class="receipt-body">
            <div class="receipt-number">
                <label>Receipt Number</label>
                <span>{{ $receipt_number }}</span>
            </div>

            <div class="amount-section">
                <div class="amount-label">Amount Paid</div>
                <div class="amount-value">₦{{ number_format($amount, 2) }}</div>
            </div>

            <div class="details-grid">
                <div class="detail-row">
                    <div class="detail-label">Date</div>
                    <div class="detail-value">{{ $date->format('F d, Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Paid By</div>
                    <div class="detail-value">{{ $payer_name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ $payer_email }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Purpose</div>
                    <div class="detail-value">{{ $purpose }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Payment Method</div>
                    <div class="detail-value">{{ $payment_method }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Reference</div>
                    <div class="detail-value" style="font-family: monospace;">{{ $reference }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <span class="status-badge status-{{ $status }}">{{ ucfirst($status) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="receipt-footer">
            <div class="footer-text">
                Thank you for your payment. This receipt serves as confirmation of your transaction.
            </div>
            <div class="contact-info">
                @if($org_email)<span>📧 {{ $org_email }}</span>@endif
                @if($org_phone)<span>📞 {{ $org_phone }}</span>@endif
            </div>
            <button onclick="window.print()" class="print-btn">
                🖨️ Print Receipt
            </button>
        </div>
    </div>
</body>

</html>