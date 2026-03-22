<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallOfFame extends Model
{
    use HasFactory;

    protected $table = 'hall_of_fame';

    protected $fillable = [
        'tenant_id',
        'user_id',
        'name',
        'photo',
        'graduation_year',
        'category',
        'achievement_title',
        'achievement_description',
        'year_inducted',
        'is_featured',
        'status',
        'created_by',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'year_inducted' => 'integer',
        'is_featured' => 'boolean',
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
        return $query->where('status', 'active');
    }

    /**
     * Scope to featured entries only.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
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
     * Get nominations for this inductee.
     */
    public function nominations()
    {
        return $this->hasMany(HallOfFameNomination::class);
    }

    /**
     * Available categories.
     */
    public static function categories(): array
    {
        return [
            'Academic Excellence' => 'Academic Excellence',
            'Leadership' => 'Leadership',
            'Community Service' => 'Community Service',
            'Sports' => 'Sports',
            'Business' => 'Business & Entrepreneurship',
            'Arts & Culture' => 'Arts & Culture',
            'Science & Innovation' => 'Science & Innovation',
            'Public Service' => 'Public Service',
        ];
    }
}
