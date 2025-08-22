<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $fillable = [
        'user_id',
        'total_invested',
        'total_refferal_commision',
        'total_salaries',
        'total_rewards',
        'total_fee',
        'direct_count',
        'level_1_investment',
        'level_2_investment',
        'level_3_investment',
        'level_4_investment',
        'level_5_investment',
        'level_6_investment',
        'level_7_investment',
    ];
}
