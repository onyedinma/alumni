<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BusinessDirectory extends Model
{
    use HasFactory;

    protected $table = 'business_directory';

    protected $fillable = [
        'tenant_id',
        'user_id',
        'business_name',
        'slug',
        'logo',
        'category',
        'description',
        'website',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'is_verified',
        'is_featured',
        'is_approved',
        'approved_by',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
    ];

    /**
     * Boot method for auto-generating slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->business_name) . '-' . Str::random(6);
            }
        });
    }

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
     * Scope to featured only.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get the business owner.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get who approved this listing.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get full location string.
     */
    public function getLocationAttribute(): string
    {
        $parts = array_filter([$this->city, $this->state, $this->country]);
        return implode(', ', $parts);
    }

    /**
     * Available categories.
     */
    public static function categories(): array
    {
        return [
            'Technology' => 'Technology & IT',
            'Healthcare' => 'Healthcare & Medicine',
            'Finance' => 'Finance & Banking',
            'Education' => 'Education & Training',
            'Legal' => 'Legal Services',
            'Consulting' => 'Consulting',
            'Manufacturing' => 'Manufacturing',
            'Real Estate' => 'Real Estate',
            'Hospitality' => 'Hospitality & Tourism',
            'Retail' => 'Retail & Commerce',
            'Agriculture' => 'Agriculture',
            'Media' => 'Media & Entertainment',
            'Transport' => 'Transport & Logistics',
            'Construction' => 'Construction',
            'Other' => 'Other',
        ];
    }
}
