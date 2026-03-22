<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTimeline extends Model
{
    use HasFactory;

    protected $table = 'history_timelines';

    protected $fillable = [
        'tenant_id',
        'year',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to current tenant.
     */
    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }

    /**
     * Scope to active entries only.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
