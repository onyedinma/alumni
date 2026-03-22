<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiniPollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'mini_poll_id',
        'option_text',
        'vote_count',
    ];

    public function poll()
    {
        return $this->belongsTo(MiniPoll::class, 'mini_poll_id');
    }
}
