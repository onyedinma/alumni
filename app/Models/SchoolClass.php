<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'tenant_id',
        'name',
        'level',
        'year_number',
        'arm',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Alumni who started in this class
     */
    public function firstYearAlumni()
    {
        return $this->hasMany(Alumni::class, 'first_class_id');
    }

    /**
     * Alumni who graduated from this class
     */
    public function finalYearAlumni()
    {
        return $this->hasMany(Alumni::class, 'final_class_id');
    }

    /**
     * Scope to get only active classes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
