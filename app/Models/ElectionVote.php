<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionVote extends Model
{
    protected $fillable = [
        'election_id',
        'position_id',
        'candidate_id',
        'voter_id',
        'voted_at',
    ];

    protected $casts = [
        'voted_at' => 'datetime',
    ];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function position()
    {
        return $this->belongsTo(ElectionPosition::class, 'position_id');
    }

    public function candidate()
    {
        return $this->belongsTo(ElectionCandidate::class, 'candidate_id');
    }

    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }
}
