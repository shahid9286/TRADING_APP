<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Investment;
use App\Models\Reward;
use App\Models\RewardDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DistributeLevel1Rewards extends Command
{
    protected $signature = 'rewards:distribute-level1';
    protected $description = 'Distribute rewards for level_1 investments';

    public function handle()
    {

        $this->info("Starting Level 1 reward distribution...");
        DB::transaction(function () {
            // Get active reward campaign
            $reward = Reward::where('status', 'active')
                ->whereDate('start_date', '<=', Carbon::today())
                ->whereDate('end_date', '>=', Carbon::today())
                ->with('rewardDetails')
                ->first();

            if (!$reward) {
                $this->warn("No active reward campaign found.");
                return;
            }

            $users = User::whereHas("referralInvestments")->where("status", "active")->get();
            foreach ($users as $user) {
                $refrealAmount = Investment::where('status', 'approved')
                    ->whereBetween("approved_at", [$reward->start_date, $reward->start_date])
                    ->where("is_active", 'active')
                    ->where("expiry_date" >= today())
                    ->with('user')
                    ->where("referral_id", $user->id)
                    ->sum("amount");

                    $rewardAmpunt=RewardDetail::where("reward_id",$reward->id)->where('target_amount', '<=', $refrealAmount)
                ->orderBy('target_amount', 'desc')
                ->first();
                $user->increment($rewardAmpunt->reward_amount);

            }
        });

        $this->info("Level 1 reward distribution completed.");
    }
}
