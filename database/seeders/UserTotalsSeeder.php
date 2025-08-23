<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTotalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_totals')->insert([
            [
                'user_id' => 1,
                'total_invested' => 10000,
                'total_referral_commission' => 2000,
                'total_salaries' => 500,
                'total_rewards' => 300,
                'total_withdraws' => 1000,
                'total_fee' => 150,
                'direct_count' => 5,
                'level_1_investment' => 5000,
                'level_2_investment' => 3000,
                'level_3_investment' => 2000,
                'level_4_investment' => 1500,
                'level_5_investment' => 1000,
                'level_6_investment' => 500,
                'level_7_investment' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'total_invested' => 8000,
                'total_referral_commission' => 1500,
                'total_salaries' => 400,
                'total_rewards' => 200,
                'total_withdraws' => 900,
                'total_fee' => 120,
                'direct_count' => 4,
                'level_1_investment' => 4000,
                'level_2_investment' => 2500,
                'level_3_investment' => 1500,
                'level_4_investment' => 1000,
                'level_5_investment' => 700,
                'level_6_investment' => 300,
                'level_7_investment' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'total_invested' => 6000,
                'total_referral_commission' => 1200,
                'total_salaries' => 300,
                'total_rewards' => 150,
                'total_withdraws' => 700,
                'total_fee' => 100,
                'direct_count' => 3,
                'level_1_investment' => 3000,
                'level_2_investment' => 2000,
                'level_3_investment' => 1000,
                'level_4_investment' => 700,
                'level_5_investment' => 500,
                'level_6_investment' => 200,
                'level_7_investment' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
