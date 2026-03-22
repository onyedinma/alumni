<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualDues extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'year',
        'amount',
        'status',
        'payment_id',
        'bank_transfer_id',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'year' => 'integer',
    ];

    /**
     * Scope to current tenant.
     */
    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Get the bank transfer.
     */
    public function bankTransfer()
    {
        return $this->belongsTo(BankTransfer::class);
    }

    /**
     * Check if dues are paid.
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Mark as paid.
     */
    public function markAsPaid($paymentId = null, $bankTransferId = null): void
    {
        $this->update([
            'status' => 'paid',
            'payment_id' => $paymentId,
            'bank_transfer_id' => $bankTransferId,
            'paid_at' => now(),
        ]);
    }
}
