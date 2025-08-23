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
        'withdrawal_request_id',
        'user_id',
        'amount',
        'referral_id',
        'entry_date',
        'type',
<<<<<<< HEAD
       
=======
        'withdrawal_request_id',
>>>>>>> 5c970b9e53bc75887a56531396f0aa7f36addf95
    ];

    public function userLedger()
    {
        return $this->belongsTo(UserLedger::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referral()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
