<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'amount',
        'currency',
        'reference',
        'proof_image',
        'bank_name',
        'account_number',
        'account_name',
        'payment_for',
        'paymentable_type',
        'paymentable_id',
        'status',
        'admin_notes',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    /**
     * Scope to current tenant.
     */
    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }

    /**
     * Get the user who made the transfer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who approved/rejected.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the paymentable model (donation, event, package).
     */
    public function paymentable()
    {
        return $this->morphTo();
    }

    /**
     * Check if transfer is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if transfer is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Generate unique reference number.
     */
    public static function generateReference(): string
    {
        return 'BT' . strtoupper(uniqid()) . rand(100, 999);
    }
}
