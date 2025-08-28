<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
        use SoftDeletes;

     protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'status',
        'image',
        'description',
        'added_by',
        'updated_by',
    ];

     public function rewardDetails()
    {
        return $this->hasMany(RewardDetail::class);
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
