<?php

namespace App\Console\Commands;
use App\Models\UserReturn;
use App\Models\Investment;
use App\Models\BusinessRule;
use App\Models\SystemLog;
use App\Models\UserLedger;
use App\Models\UserTotal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessDailyReturn extends Command
{
    protected $signature = 'investments:process-daily-return';
    protected $description = 'Process 0.5% daily return on active investments and update user net_balance';

    public function handle()
    {
        $this->info('Starting daily return processing...');

        // Log start
        SystemLog::create([
            'module' => 'Investments',
            'action' => 'Daily return Processing Started',
            'log_level' => 'info',
            'description' => 'Started processing daily return for all active investments',
            'metadata' => ['started_at' => now()->toDateTimeString()],
            'status' => 'processing'
        ]);



        $bussninessRule = BusinessRule::first();
        $investments = Investment::where('is_active', 'active')
            ->where('expiry_date', '>', now())
            ->where("status", 'approved')
            ->with('user')
            ->get();
        $processed = 0;
        $totalInterest = 0;
        $failed = 0;

        foreach ($investments as $investment) {
            try {

                DB::transaction(function () use ($investment, &$processed, &$totalInterest, &$bussninessRule) {

                    $interestAmount = $investment->amount * $bussninessRule->daily_return_rate / 100;
                    // update user balance
                    $beforeBalance = $investment->user->net_balance;


                    $investment->user->net_balance += $interestAmount;
                    $investment->user->save();
                    $userReturn = UserReturn::create([
                        'investment_id' => $investment->id,
                        'user_id' => $investment->user_id,
                        'amount' => $interestAmount,
                        'entry_date' => now()->toDateString(),
                        'type' => 'daily_profit',
                        'referral_id' => null,
                    ]);


                    UserLedger::create([
                        'user_id' => $investment->user_id,
                        'user_return_id' => $userReturn->id,
                        'type' => 'daily_profit',
                        'amount' => $interestAmount,
                        'balance_before' => $beforeBalance,
                        'balance_after' => $investment->user->net_balance,
                        'description' => "Daily profit credited for investment #{$investment->id}",
                    ]);
                    $referralUserTotal = UserTotal::firstOrCreate(['user_id' => $investment->user_id]);
                    $referralUserTotal->daily_return += $interestAmount;
                    $referralUserTotal->save();
                    $processed++;
                    $totalInterest += $interestAmount;

                    // log success
                    SystemLog::create([
                        'module' => 'Investments',
                        'action' => 'Daily Interest Paid',
                        'log_level' => 'info',
                        'user_id' => $investment->user_id,
                        'affected_user_id' => $investment->user_id,
                        'loggable_type' => Investment::class,
                        'loggable_id' => $investment->id,
                        'amount' => $interestAmount,
                        'description' => "Daily interest of 0.5% paid for investment #{$investment->id}",
                        'metadata' => [
                            'investment_id' => $investment->id,
                            'investment_amount' => $investment->amount,
                            'interest_rate' => 0.5,
                            'interest_amount' => $interestAmount,
                            'new_balance' => $investment->user->net_balance,
                            'processed_at' => now()->toDateTimeString()
                        ],
                        'status' => 'success',
                        'processed_at' => now()
                    ]);
                });
            } catch (\Exception $e) {
                $failed++;

                SystemLog::create([
                    'module' => 'Investments',
                    'action' => 'Daily Interest Failed',
                    'log_level' => 'error',
                    'user_id' => $investment->user_id,
                    'affected_user_id' => $investment->user_id,
                    'loggable_type' => Investment::class,
                    'loggable_id' => $investment->id,
                    'description' => "Failed to process daily interest for investment #{$investment->id}: {$e->getMessage()}",
                    'metadata' => [
                        'investment_id' => $investment->id,
                        'error' => $e->getMessage(),
                        'error_trace' => $e->getTraceAsString()
                    ],
                    'status' => 'failed'
                ]);
            }
        }

        $this->info("Processed $processed investments. Total interest paid: $totalInterest. Failed: $failed");

        // log completion
        SystemLog::create([
            'module' => 'Investments',
            'action' => 'Daily Interest Processing Completed',
            'log_level' => 'info',
            'description' => "Completed processing daily interest. Processed: $processed, Total interest: $totalInterest, Failed: $failed",
            'metadata' => [
                'processed_count' => $processed,
                'failed_count' => $failed,
                'total_interest' => $totalInterest,
                'completed_at' => now()->toDateTimeString()
            ],
            'status' => 'success',
            'processed_at' => now()
        ]);

        return 0;
    }
}
