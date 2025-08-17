<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'start_date',
        'expiry_date',
        'status',
        'transaction_id',
        'screenshot',
        'is_active',
        'user_id',
        'referral_id',
        'admin_bank_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'expiry_date' => 'datetime',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referral()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }
    public function adminbank()
    {
        return $this->belongsTo(AdminBank::class, 'admin_bank_id');
    }
}
