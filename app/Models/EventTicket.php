<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'event_id',
        'user_id',
        'ticket_number',
        'qr_code',
        'checked_in_at',
        'checked_in_by',
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkedInByUser()
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    /**
     * Check if ticket has been checked in
     */
    public function isCheckedIn(): bool
    {
        return !is_null($this->checked_in_at);
    }

    /**
     * Mark ticket as checked in
     */
    public function checkIn(?int $byUserId = null): bool
    {
        if ($this->isCheckedIn()) {
            return false;
        }

        $this->update([
            'checked_in_at' => now(),
            'checked_in_by' => $byUserId,
        ]);

        return true;
    }

    /**
     * Get verification URL for QR code
     */
    public function getVerificationUrl(): string
    {
        return route('ticket.verify', $this->ticket_number);
    }

    /**
     * Scope: Checked in tickets
     */
    public function scopeCheckedIn($query)
    {
        return $query->whereNotNull('checked_in_at');
    }

    /**
     * Scope: Not checked in tickets
     */
    public function scopeNotCheckedIn($query)
    {
        return $query->whereNull('checked_in_at');
    }
}
