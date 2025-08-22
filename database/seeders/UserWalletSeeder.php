<?php

namespace Database\Seeders;

use App\Models\UserWallet;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserWallet::create([
                'user_id' => $user->id,
                'total_invested' => rand(1000, 5000),
                'total_refferal_commision' => rand(100, 1000),
                'total_salaries' => rand(200, 1500),
                'total_rewards' => rand(50, 500),
                'total_fee' => rand(10, 100),
                'direct_count' => rand(1, 10),
                'level_1_investment' => rand(100, 500),
                'level_2_investment' => rand(100, 500),
                'level_3_investment' => rand(100, 500),
                'level_4_investment' => rand(100, 500),
                'level_5_investment' => rand(100, 500),
                'level_6_investment' => rand(100, 500),
                'level_7_investment' => rand(100, 500),
            ]);
        }
    }
}
