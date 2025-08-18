<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WithdrawalRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'withdrawal_requests';

    protected $fillable = [
        'user_id',
        'admin_bank_id',
        'user_bank_id',
        'request_date',
        'requested_amount',
        'status',
        'approval_date',
        'payout_date',
        'payout_amount',
        'fee',
        'total_payout',
        'transaction_id',
        'screenshot',
        'client_status',
    ];

    protected $dates = [
        'request_date',
        'approval_date',
        'payout_date',
        'deleted_at'
    ];

    protected $casts = [
        'request_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adminBank()
    {
        return $this->belongsTo(AdminBank::class);
    }

    public function userBank()
    {
        return $this->belongsTo(UserBank::class);
    }
}
