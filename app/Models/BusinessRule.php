<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessRule extends Model
{
     protected $fillable = [
        'min_deposit',
        'min_withdraw_limit',
        'daily_return_rate',
        'monthly_return_rate',
        'level_1_comm_rate',
        'level_2_comm_rate',
        'level_3_comm_rate',
        'level_4_comm_rate',
        'level_5_comm_rate',
        'level_6_comm_rate',
        'level_7_comm_rate',
        'salary_date',
        'salary_payout_date',
        'entry_approval_date',
        'withdraw_last_date',
        'withdraw_payout_date',
        'withdraw_payout_date_2',
    ];
}
