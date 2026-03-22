<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exco extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'exco_tenor_id',
        'name',
        'position',
        'bio',
        'photo',
        'order',
        'status',
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

    public function tenor()
    {
        return $this->belongsTo(ExcoTenor::class, 'exco_tenor_id');
    }
}
