<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusinessRule;

class BusinessRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusinessRule::updateOrCreate(
            ['id' => 1], // condition → only one record with id=1
            [
                'min_deposit' => 100,
                'min_withdraw_limit' => 50,
                'daily_return_rate' => 0.5,
                'payout_fee_rate' => 10,
                'monthly_return_rate' => 2,
                'level_1_comm_rate' => 8,
                'level_2_comm_rate' => 2,
                'level_3_comm_rate' => 1,
                'level_4_comm_rate' => 0.5,
                'level_5_comm_rate' => 0.5,
                'level_6_comm_rate' => 0.5,
                'level_7_comm_rate' => 0.5,
                'salary_day' => now()->day,  
                'salary_payout_date' => now()->addDays(5)->toDateString(),
                'entry_approval_date' => now()->toDateString(),
                'withdraw_last_date' => now()->addDays(10)->toDateString(),
                'withdraw_payout_date' => now()->addDays(15)->toDateString(),
                'withdraw_payout_date_2' => now()->addDays(20)->toDateString(),
            ]
        );
    
    }
}
