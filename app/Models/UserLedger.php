<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLedger extends Model
{
    use  SoftDeletes;
    protected $fillable = [
        'user_id', 'transaction_type', 'amount', 'description', 'transaction_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
