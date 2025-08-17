<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminBank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'account_no',
        'status',
        'order_no',
        'notes',
    ];

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
