<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiniPoll extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function options()
    {
        return $this->hasMany(MiniPollOption::class);
    }

    public function votes()
    {
        return $this->hasMany(MiniPollVote::class);
    }
}
