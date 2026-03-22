<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiniPollVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'mini_poll_id',
        'user_id',
        'ip_address',
    ];

    public function poll()
    {
        return $this->belongsTo(MiniPoll::class, 'mini_poll_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
