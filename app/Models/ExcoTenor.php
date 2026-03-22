<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcoTenor extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'title',
        'start_date',
        'end_date',
        'is_current',
        'created_by'
    ];

    /**
     * Scope to current tenant.
     */
    public function scopeTenant($query)
    {
        if (function_exists('getTenantId')) {
            return $query->where('tenant_id', getTenantId());
        }
        return $query;
    }

    public function excos()
    {
        return $this->hasMany(Exco::class, 'exco_tenor_id')->orderBy('order', 'asc');
    }
}
