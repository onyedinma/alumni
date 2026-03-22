<?php

namespace App\Http\Services;

use App\Models\Payment;
use App\Models\BankTransfer;
use App\Models\Donation;
use Illuminate\Support\Facades\View;

class ReceiptService
{
    /**
     * Generate receipt HTML for a payment.
     */
    public function generateReceipt($payment, $type = 'payment')
    {
        $data = $this->prepareReceiptData($payment, $type);
        return View::make('receipts.template', $data)->render();
    }

    /**
     * Generate and download receipt as PDF.
     */
    public function downloadPdf($payment, $type = 'payment')
    {
        $html = $this->generateReceipt($payment, $type);
        $filename = 'receipt_' . ($payment->reference ?? $payment->id) . '.pdf';

        // Using basic HTML to PDF conversion
        // For production, install dompdf: composer require barryvdh/laravel-dompdf
        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }

    /**
     * Prepare receipt data.
     */
    private function prepareReceiptData($payment, $type)
    {
        $appName = getOption('app_name', 'Alumni Association');
        $appEmail = getOption('app_email', '');
        $appPhone = getOption('app_contact_number', '');
        $appAddress = getOption('app_location', '');
        $logo = getOption('app_logo');

        return [
            'receipt_number' => $this->generateReceiptNumber($payment),
            'date' => $payment->created_at ?? now(),
            'amount' => $payment->amount,
            'currency' => 'NGN',
            'payment_method' => $type === 'bank_transfer' ? 'Bank Transfer' : 'Online Payment',
            'status' => $payment->status ?? 'completed',
            'reference' => $payment->reference ?? $payment->transaction_id ?? $payment->id,

            // Payer info
            'payer_name' => $payment->user->name ?? 'N/A',
            'payer_email' => $payment->user->email ?? 'N/A',

            // Payment purpose
            'purpose' => $this->getPaymentPurpose($payment, $type),

            // Organization info
            'org_name' => $appName,
            'org_email' => $appEmail,
            'org_phone' => $appPhone,
            'org_address' => $appAddress,
            'org_logo' => $logo,
        ];
    }

    /**
     * Generate unique receipt number.
     */
    private function generateReceiptNumber($payment)
    {
        $prefix = 'RCP';
        $year = date('Y');
        $id = str_pad($payment->id ?? rand(1000, 9999), 6, '0', STR_PAD_LEFT);
        return "{$prefix}-{$year}-{$id}";
    }

    /**
     * Get payment purpose description.
     */
    private function getPaymentPurpose($payment, $type)
    {
        if ($type === 'bank_transfer') {
            return ucfirst($payment->payment_for ?? 'Payment');
        }

        if ($payment->paymentable) {
            $class = class_basename($payment->paymentable_type);
            switch ($class) {
                case 'DonationCampaign':
                    return 'Donation: ' . ($payment->paymentable->title ?? 'Campaign');
                case 'Event':
                    return 'Event Registration: ' . ($payment->paymentable->title ?? 'Event');
                case 'Package':
                    return 'Membership: ' . ($payment->paymentable->name ?? 'Package');
                default:
                    return $class;
            }
        }

        return 'Payment';
    }
}
