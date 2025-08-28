<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardDetail extends Model
{
     protected $fillable = [
        'reward_id',
        'reward_title',
        'reward_amount',
        'target_amount',
    ];

    // A reward detail belongs to a reward
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
