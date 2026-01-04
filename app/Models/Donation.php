<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'tenant_id',
        'campaign_id',
        'user_id',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'message',
        'payment_id',
        'transaction_id',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            if (empty($model->tenant_id)) {
                $model->tenant_id = getTenantId();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(DonationCampaign::class, 'campaign_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function scopeTenant($query)
    {
        return $query->where('tenant_id', getTenantId());
    }
}
