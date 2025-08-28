<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reward;
use App\Models\RewardDetail;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Expired Reward
        $expiredReward = Reward::create([
            'title' => 'Winter Campaign',
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-31',
            'status' => 'expired',
            'description' => 'Expired winter reward campaign',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            RewardDetail::create([
                'reward_id'     => $expiredReward->id,
                'reward_title'  => "Expired Reward Level $i",
                'reward_amount' => 100 * $i,
                'target_amount' => 500 * $i,
            ]);
        }

        // Active Reward
        $activeReward = Reward::create([
            'title' => 'Summer Campaign',
            'start_date' => now()->subDays(10),
            'end_date'   => now()->addDays(20),
            'status' => 'active',
            'description' => 'Ongoing summer reward campaign',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            RewardDetail::create([
                'reward_id'     => $activeReward->id,
                'reward_title'  => "Active Reward Level $i",
                'reward_amount' => 200 * $i,
                'target_amount' => 800 * $i,
            ]);
        }
    }
    
}
