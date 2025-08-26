<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLedger extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'type', 'amount', 'description', 'transaction_date', 'balance_after', 'balance_before'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userReturn()
    {
        return $this->hasOne(UserReturn::class);
    }
}
