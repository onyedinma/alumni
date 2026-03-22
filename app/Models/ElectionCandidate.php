<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionCandidate extends Model
{
    protected $fillable = [
        'position_id',
        'user_id',
        'manifesto',
        'status',
    ];

    public function position()
    {
        return $this->belongsTo(ElectionPosition::class, 'position_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(ElectionVote::class, 'candidate_id');
    }

    public function getVoteCountAttribute()
    {
        return $this->votes()->count();
    }

    public function getVotePercentageAttribute()
    {
        $totalVotes = $this->position->votes()->count();
        if ($totalVotes === 0) {
            return 0;
        }
        return round(($this->vote_count / $totalVotes) * 100, 1);
    }
}
