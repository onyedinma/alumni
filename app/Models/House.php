<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'tenant_id',
        'name',
        'color_code',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Alumni who were initially in this house
     */
    public function firstHouseAlumni()
    {
        return $this->hasMany(Alumni::class, 'first_house_id');
    }

    /**
     * Alumni who ended up in this house
     */
    public function finalHouseAlumni()
    {
        return $this->hasMany(Alumni::class, 'final_house_id');
    }

    /**
     * Scope to get only active houses
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
