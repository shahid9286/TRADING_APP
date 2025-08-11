<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserReturn extends Model
{
        use HasFactory, SoftDeletes;

    protected $fillable = [
        'investment_id',
        'user_id',
        'amount',
        'entry_date',
        'type'
    ];

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
