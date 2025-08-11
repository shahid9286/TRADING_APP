<?php

namespace Database\Seeders;

use App\Models\UserReturn;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                UserReturn::insert([
            [
                'investment_id' => 1,
                'user_id' => 1,
                'amount' => 500.00,
                'entry_date' => Carbon::now()->toDateString(),
                'type' => 'daily-return',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'investment_id' => 1,
                'user_id' => 1,
                'amount' => 1500.00,
                'entry_date' => Carbon::now()->subDays(3)->toDateString(),
                'type' => 'referral-commission',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
