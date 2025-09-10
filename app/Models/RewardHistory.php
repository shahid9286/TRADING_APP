<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardHistory extends Model
{
    protected $fillable = [
        'user_id',
        'reward_id',
        'reward_title',
        'reward_name',
        'reward_amount',
        'pay_date',
    ];

    // ✅ Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ✅ Relationship with Reward (optional)
    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }
}
