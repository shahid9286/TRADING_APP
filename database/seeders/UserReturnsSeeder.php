<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserReturnsSeeder extends Seeder
{
    public function run()
    {
        $types = [
                'investment',
                'daily_profit',
                'referral_commission',
                'monthly_commission',
                'salary',
                'reward',
                'withdrawal',
                'admin_fee',
                'direct-plus',
                'direct-minus',
        ];

        $data = [];
        foreach ([1, 2, 3] as $userId) {
            for ($i = 1; $i <= 12; $i++) {
                $data[] = [
                    'investment_id' => rand(1, max: 3), // nullable; you can set null randomly
                    'user_id' => $userId,
                    'amount' => rand(100, 1000),
                    'referral_id' => rand(0, 1) ? rand(1, 3) : null,
                    'entry_date' => Carbon::now()->subDays(rand(1, 60)),
                    'type' => $types[array_rand($types)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('user_returns')->insert($data);
    }
}
