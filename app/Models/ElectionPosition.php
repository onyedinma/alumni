<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionPosition extends Model
{
    protected $fillable = [
        'election_id',
        'title',
        'description',
        'order',
    ];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function candidates()
    {
        return $this->hasMany(ElectionCandidate::class, 'position_id')->where('status', 'approved');
    }

    public function allCandidates()
    {
        return $this->hasMany(ElectionCandidate::class, 'position_id');
    }

    public function votes()
    {
        return $this->hasMany(ElectionVote::class, 'position_id');
    }

    public function getWinnerAttribute()
    {
        return $this->candidates()
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->first();
    }
}
