<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLedger extends Model
{
    use SoftDeletes;
    protected $fillable = [
<<<<<<< HEAD
        'user_id',
        'transaction_type',
        'amount',
        'description',
        'transaction_date',
        'balance_before',
        'balance_after',
        'type',
        'user_return_id'
=======
        'user_id', 'type', 'amount', 'description', 'transaction_date', 'balance_after', 'balance_before'
>>>>>>> 5c970b9e53bc75887a56531396f0aa7f36addf95
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
