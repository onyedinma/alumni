<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallOfFameNomination extends Model
{
    use HasFactory;

    protected $table = 'hall_of_fame_nominations';

    protected $fillable = [
        'tenant_id',
        'hall_of_fame_id',
        'nominee_name',
        'nominee_email',
        'nominee_graduation_year',
        'category',
        'nomination_reason',
        'nominator_id',
        'status',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'nominee_graduation_year' => 'integer',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Scope to current tenant.
     */
    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }

    /**
     * Scope to pending nominations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to approved nominations.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Get the Hall of Fame entry (if approved).
     */
    public function hallOfFame()
    {
        return $this->belongsTo(HallOfFame::class);
    }

    /**
     * Get the user who submitted the nomination.
     */
    public function nominator()
    {
        return $this->belongsTo(User::class, 'nominator_id');
    }

    /**
     * Get the user who reviewed the nomination.
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
