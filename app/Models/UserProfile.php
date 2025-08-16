<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',       // relation with users table
        'first_name',
        'last_name',
        'phone',
        'address',
        'city',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
