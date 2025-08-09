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
'admin_bank_account_id' ,  ];

    protected $casts = [
        'start_date' => 'datetime',
        'expiry_date' => 'datetime',
    ];

    

    // Relationship to the user who made the investment
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to the user who referred
    public function referral()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }
    public function bankaccount()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }

    // Relationship to added by user (admin/staff)
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Relationship to updated by user
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
