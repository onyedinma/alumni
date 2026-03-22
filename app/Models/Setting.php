<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'option_key',
        'option_value'
    ];

    protected static function booted()
    {
        static::saved(function ($setting) {
            \Illuminate\Support\Facades\Cache::forget('app_settings_' . $setting->tenant_id);
        });

        static::deleted(function ($setting) {
            \Illuminate\Support\Facades\Cache::forget('app_settings_' . $setting->tenant_id);
        });
    }
}
