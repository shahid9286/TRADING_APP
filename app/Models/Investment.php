<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investment extends Model
{
    use HasFactory;

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
        public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdby');
    }
    // Status based scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Active vs Expired
    public function scopeActive($query)
    {
        return $query->where('is_active', 'active');
    }

    public function scopeExpired($query)
    {
        return $query->where('is_active', 'expired');
    }

    // Filter by user
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Expiring soon (e.g. in next 7 days)
    public function scopeExpiringSoon($query)
    {
        return $query->whereBetween('expiry_date', [now(), now()->addDays(7)]);
    }

    // Date range
    public function scopeBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('start_date', [$start, $end]);
    }

    // By referral
    public function scopeWithReferral($query)
    {
        return $query->whereNotNull('referral_id');
    }

}
