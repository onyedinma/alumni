<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Election extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title) . '-' . Str::random(6);
            if (empty($model->tenant_id)) {
                $model->tenant_id = getTenantId();
            }
        });
    }

    public function positions()
    {
        return $this->hasMany(ElectionPosition::class)->orderBy('order');
    }

    public function votes()
    {
        return $this->hasMany(ElectionVote::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active'
            && $this->start_date <= now()
            && $this->end_date >= now();
    }

    public function getIsEndedAttribute()
    {
        return $this->end_date < now() || $this->status === 'ended' || $this->status === 'published';
    }

    public function getTotalVotesAttribute()
    {
        return $this->votes()->count();
    }
}
