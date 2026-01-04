<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DonationCampaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'tenant_id',
        'title',
        'slug',
        'description',
        'image_id',
        'goal_amount',
        'raised_amount',
        'start_date',
        'end_date',
        'beneficiary_name',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->slug = Str::slug($model->title) . '-' . Str::random(6);
            if (empty($model->tenant_id)) {
                $model->tenant_id = getTenantId();
            }
        });
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'campaign_id');
    }

    public function image()
    {
        return $this->belongsTo(FileManager::class, 'image_id');
    }

    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }

    public function scopeActive($query)
    {
        return $query->where('status', STATUS_ACTIVE);
    }

    public function getProgressPercentageAttribute()
    {
        if (!$this->goal_amount || $this->goal_amount == 0) {
            return 0;
        }
        return min(100, round(($this->raised_amount / $this->goal_amount) * 100));
    }

    public function getIsActiveAttribute()
    {
        if ($this->status != STATUS_ACTIVE) {
            return false;
        }
        if ($this->end_date && $this->end_date->isPast()) {
            return false;
        }
        return true;
    }
}
