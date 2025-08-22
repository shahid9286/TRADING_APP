<?php

namespace App\Models;

/**
 * @method bool hasRole(string|array|\Spatie\Permission\Contracts\Role $roles)
 * @method \Spatie\Permission\Contracts\Role[] getRoleNames()
 * @method $this assignRole(...$roles)
 */

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'status',
        'referral_username',
        'referral_user_id',
        'level_1_user_id',
        'level_2_user_id',
        'level_3_user_id',
        'level_4_user_id',
        'level_5_user_id',
        'level_6_user_id',
        'level_7_user_id',
        'password',
        'net_balance',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function banks()
    {
        return $this->hasMany(UserBank::class);
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function referralInvestments()
    {
        return $this->hasMany(Investment::class, 'referral_id');
    }


    public function referral()
    {
        return $this->belongsTo(User::class, 'referral_user_id');
    }

    public function level1()
    {
        return $this->belongsTo(User::class, 'level_1_user_id');
    }

    public function level2()
    {
        return $this->belongsTo(User::class, 'level_2_user_id');
    }

    public function level3()
    {
        return $this->belongsTo(User::class, 'level_3_user_id');
    }

    public function level4()
    {
        return $this->belongsTo(User::class, 'level_4_user_id');
    }

    public function level5()
    {
        return $this->belongsTo(User::class, 'level_5_user_id');
    }

    public function level6()
    {
        return $this->belongsTo(User::class, 'level_6_user_id');
    }

    public function level7()
    {
        return $this->belongsTo(User::class, 'level_7_user_id');
    }

    public function userTotal()
    {
        return $this->hasOne(UserTotal::class);
    }

    public function userReturns()
    {
        return $this->hasMany(UserReturn::class);
    }

    public function referralReturns()
    {
        return $this->hasMany(UserReturn::class, 'referral_id');
    }

    public function ledgers()
    {
        return $this->hasMany(UserLedger::class);
    }
}
