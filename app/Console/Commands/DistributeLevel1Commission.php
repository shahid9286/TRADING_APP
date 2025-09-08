<?php

namespace App\Console\Commands;

use App\Models\BusinessRule;
use Illuminate\Console\Command;
use App\Models\Investment;
use App\Models\User;
use App\Models\UserReturn;
use App\Models\UserLedger;
use App\Models\UserTotal;
use App\Models\SystemLog;
use Illuminate\Support\Facades\DB;

class DistributeLevel1Commission extends Command
{
    protected $signature = 'commission:distribute-level1';
    protected $description = 'Distribute monthly commission for level_1 investments';

    public function handle()
    {
        $businessRule = BusinessRule::first();
        if (!$businessRule) {
            $this->error("No business rule found.");
            return;
        }

        $this->info("Starting Level 1 monthly_commission...");

        DB::transaction(function () use ($businessRule) {
            $users = User::whereHas("referralInvestments")
                ->where("status", "approved")
                ->get();

            foreach ($users as $user) {

                $referralAmount = Investment::where('status', 'approved')
                    ->where("is_active", 'active')
                    ->where("expiry_date", ">=", today())
                    ->where("referral_id", $user->id)
                    ->sum("amount");

                if ($referralAmount <= 0) {
                    continue;
                }

                // Monthly commission
                $commissionAmount = $referralAmount * $businessRule->monthly_return_rate / 100;

                if ($commissionAmount <= 0) {
                    continue;
                }

                $beforeBalance = $user->net_balance;
                $afterBalance = $beforeBalance + $commissionAmount;

                // Update user balance
                $user->increment("net_balance", $commissionAmount);

                // Save UserReturn
                $userReturn = UserReturn::create([
                    'investment_id' => null,
                    'withdrawal_request_id' => null,
                    'user_id' => $user->id,
                    'amount' => $commissionAmount,
                    'referral_id' => null,
                    'entry_date' => now(),
                    'type' => 'monthly_commission',
                ]);

                // Save Ledger
                UserLedger::create([
                    'user_id' => $user->id,
                    'user_return_id' => $userReturn->id,
                    'type' => 'monthly_commission', // 🔑 not reward
                    'amount' => $commissionAmount,
                    'balance_before' => $beforeBalance,
                    'balance_after' => $afterBalance,
                    'description' => "Level 1 monthly_commission ({$businessRule->monthly_return_rate}% of referral investment)",
                ]);

                // Update totals
                UserTotal::updateOrCreate(
                    ['user_id' => $user->id],
                    ['total_commissions' => DB::raw("COALESCE(total_commissions,0) + {$commissionAmount}")] // 🔑 keep separate field
                );

                // System log
                SystemLog::create([
                    'module' => 'monthly_commission',
                    'action' => 'commission_distributed',
                    'log_level' => 'info',
                    'user_id' => null, // system
                    'affected_user_id' => $user->id,
                    'loggable_type' => Investment::class,
                    'loggable_id' => null,
                    'amount' => $commissionAmount,
                    'level' => 1,
                    'description' => "Distributed {$commissionAmount} as Level 1 monthly commission to user {$user->id} ({$user->username})",
                    'metadata' => [
                        'referral_amount' => $referralAmount,
                        'monthly_return_rate' => $businessRule->monthly_return_rate,
                    ],
                    'status' => 'success',
                    'processed_at' => now(),
                ]);
            }
        });

        $this->info("Level 1 monthly_commission completed.");
    }
}
