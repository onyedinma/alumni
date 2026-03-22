<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InMemoriam extends Model
{
    use HasFactory;

    protected $table = 'in_memoriam';

    protected $fillable = [
        'tenant_id',
        'user_id',
        'name',
        'photo',
        'graduation_year',
        'date_of_birth',
        'date_of_passing',
        'obituary',
        'tribute',
        'house',
        'class_arm',
        'created_by',
        'is_approved',
        'approved_by',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'date_of_passing' => 'datetime',
        'is_approved' => 'boolean',
        'graduation_year' => 'integer',
    ];

    /**
     * Scope to current tenant.
     */
    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }

    /**
     * Scope to approved entries only.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Get the linked user (if was a registered alumni).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get who created this entry.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get who approved this entry.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get age at passing.
     */
    public function getAgeAttribute(): ?int
    {
        if ($this->date_of_birth && $this->date_of_passing) {
            return $this->date_of_birth->diffInYears($this->date_of_passing);
        }
        return null;
    }
}
