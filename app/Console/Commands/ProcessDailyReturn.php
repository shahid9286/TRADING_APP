<?php

namespace App\Console\Commands;

use App\Models\UserReturn;
use App\Models\Investment;
use App\Models\BusinessRule;
use App\Models\SystemLog;
use App\Models\UserLedger;
use App\Models\UserTotal;
use App\Models\User;
use App\Services\InvestmentApprovalService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessDailyReturn extends Command
{
    protected $signature = 'investments:process-daily-return';
    protected $description = 'Process 0.5% daily return on active investments and update user net_balance';

    public function handle()
    {
        $this->info('Starting daily return processing...');

        // Log start - EXISTING CODE
        SystemLog::create([
            'module' => 'Investments',
            'action' => 'Daily return Processing Started',
            'log_level' => 'info',
            'description' => 'Started processing daily return for all active investments',
            'metadata' => ['started_at' => now()->toDateTimeString()],
            'status' => 'processing'
        ]);

        $businessRule = BusinessRule::first();
        $investments = Investment::where('is_active', 'active')
            ->where('expiry_date', '>', now())
            ->where("status", 'approved')
            ->with('user')
            ->get();
        
        $processed = 0;
        $totalInterest = 0;
        $failed = 0;

        // EXISTING DAILY RETURN PROCESSING CODE - NO CHANGES
        foreach ($investments as $investment) {
            try {
                DB::transaction(function () use ($investment, &$processed, &$totalInterest, &$businessRule) {
                    $interestAmount = $investment->amount * $businessRule->daily_return_rate / 100;
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
                    
                    SystemLog::create([
                        'module' => 'Investments',
                        'action' => 'Daily Interest Paid',
                        'log_level' => 'info',
                        'user_id' => $investment->user_id,
                        'affected_user_id' => $investment->user_id,
                        'loggable_type' => Investment::class,
                        'loggable_id' => $investment->id,
                        'amount' => $interestAmount,
                        'description' => "Daily interest of .$businessRule->daily_return_rate.% paid for investment #{$investment->id}",
                        'metadata' => [
                            'investment_id' => $investment->id,
                            'investment_amount' => $investment->amount,
                            'interest_rate' => $businessRule->daily_return_rate,
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

        // NEW: ADD SALARY CALCULATION AFTER DAILY RETURNS
        $salaryResults = $this->calculateReferralSalaries($businessRule);

        // EXISTING COMPLETION LOG - UPDATED WITH SALARY INFO
        SystemLog::create([
            'module' => 'Investments',
            'action' => 'Daily Interest Processing Completed',
            'log_level' => 'info',
            'description' => "Completed processing daily interest. Processed: $processed, Total interest: $totalInterest, Failed: $failed. Salary calculation: {$salaryResults['processed']} users, {$salaryResults['failed']} failed",
            'metadata' => [
                'processed_count' => $processed,
                'failed_count' => $failed,
                'total_interest' => $totalInterest,
                'salary_processed' => $salaryResults['processed'],
                'salary_failed' => $salaryResults['failed'],
                'completed_at' => now()->toDateTimeString()
            ],
            'status' => 'success',
            'processed_at' => now()
        ]);

        $this->info("Daily processing completed. Salary calculation: {$salaryResults['processed']} users processed, {$salaryResults['failed']} failed");

        return 0;
    }

    /**
     * NEW METHOD: Calculate referral salaries for all users with referrals
     * Added without disturbing existing functionality
     */
    private function calculateReferralSalaries($businessRule)
    {
        $this->info('Starting referral salary calculation...');
        
        $salaryService = new InvestmentApprovalService();
        $processed = 0;
        $failed = 0;

        try {
            // Get users who have referrals (are mentioned as referral_id in investments)
            $referralUsers = User::whereHas('referralInvestments')->get();

            $this->info("Found {$referralUsers->count()} users with referrals to process");

            foreach ($referralUsers as $user) {
                try {
                    $result = $salaryService->calculateAndSaveReferralSalary($user, $businessRule);
                    
                    if ($result['success']) {
                        $processed++;
                        $this->info("Salary calculated for user {$user->username}: {$result['salary_type']} = $" . number_format($result['salary_amount'], 2));
                    } else {
                        $failed++;
                        $this->error("Failed to calculate salary for user {$user->username}: {$result['error']}");
                        
                        SystemLog::create([
                            'module' => 'Salary',
                            'action' => 'Salary Calculation Failed',
                            'log_level' => 'error',
                            'user_id' => $user->id,
                            'description' => "Failed to calculate referral salary for {$user->username}",
                            'details' => $result['error'],
                            'metadata' => [
                                'user_id' => $user->id,
                                'username' => $user->username
                            ],
                            'status' => 'failed'
                        ]);
                    }
                } catch (\Exception $e) {
                    $failed++;
                    $this->error("Exception calculating salary for user {$user->username}: {$e->getMessage()}");
                    
                    SystemLog::create([
                        'module' => 'Salary',
                        'action' => 'Salary Calculation Exception',
                        'log_level' => 'error',
                        'user_id' => $user->id,
                        'description' => "Exception calculating referral salary for {$user->username}",
                        'details' => $e->getMessage(),
                        'metadata' => [
                            'user_id' => $user->id,
                            'username' => $user->username,
                            'error_trace' => $e->getTraceAsString()
                        ],
                        'status' => 'failed'
                    ]);
                }
            }

            $this->info("Salary calculation completed. Processed: $processed, Failed: $failed");

        } catch (\Exception $e) {
            $this->error("Failed to process salary calculation: {$e->getMessage()}");
            
            SystemLog::create([
                'module' => 'Salary',
                'action' => 'Salary Processing Failed',
                'log_level' => 'error',
                'description' => "Failed to process salary calculation",
                'details' => $e->getMessage(),
                'metadata' => [
                    'error_trace' => $e->getTraceAsString()
                ],
                'status' => 'failed'
            ]);
        }

        return [
            'processed' => $processed,
            'failed' => $failed
        ];
    }
}