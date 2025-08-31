<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SystemLog;
use App\Models\UserReturn;
use App\Models\UserLedger;
use App\Models\UserTotal;

class ProcessMonthlySalary extends Command
{
    protected $signature = 'salary:process-monthly';
    protected $description = 'Process monthly salary: add current month salary to net balance, add next month salary to current month, and reset next month salary';

    public function handle()
    {
        $this->info('Starting comprehensive monthly salary processing...');
        $processingDate = now();
        
        try {
            DB::beginTransaction();

            // Step 1: Get all users with current or next month salary
            $users = User::where(function($query) {
                $query->where('current_month_salary', '>', 0)
                      ->orWhere('next_month_salary', '>', 0);
            })->get();

            $totalNetBalanceAdded = 0;
            $totalAddedToCurrent = 0;
            $processedUsers = 0;

            foreach ($users as $user) {
                $userProcessed = $this->processUserSalary($user);
                
                if ($userProcessed) {
                    $totalNetBalanceAdded += $user->current_month_salary;
                    $totalAddedToCurrent += $user->next_month_salary;
                    $processedUsers++;
                }
            }

            DB::commit();

            // Log the system event
            $this->logSystemEvent($processedUsers, $totalNetBalanceAdded, $totalAddedToCurrent);

            $this->info("Monthly salary processing completed successfully!");
            $this->info("Processed {$processedUsers} users");
            $this->info("Total added to net balance: " . number_format($totalNetBalanceAdded, 2));
            $this->info("Total added to current month: " . number_format($totalAddedToCurrent, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            
            $this->error('Error processing monthly salary: ' . $e->getMessage());
            $this->logError($e);
            
            return 1;
        }

        return 0;
    }

    private function processUserSalary(User $user)
    {
        $currentSalary = $user->current_month_salary;
        $nextSalary = $user->next_month_salary;

        if ($currentSalary == 0 && $nextSalary == 0) {
            return false;
        }

        // Store balances before processing
        $balanceBefore = $user->net_balance;

        // Add current month salary to net balance
        if ($currentSalary > 0) {
            $user->net_balance += $currentSalary;
            
            // Create UserReturn entry for salary
            $userReturn = UserReturn::create([
                'user_id' => $user->id,
                'amount' => $currentSalary,
                'entry_date' => now(),
                'type' => 'salary',
                'description' => 'Monthly salary processed and added to net balance'
            ]);

            // Create UserLedger entry
            UserLedger::create([
                'user_id' => $user->id,
                'user_return_id' => $userReturn->id,
                'type' => 'salary',
                'amount' => $currentSalary,
                'balance_before' => $balanceBefore,
                'balance_after' => $user->net_balance,
                'description' => 'Monthly salary credit to net balance'
            ]);

            // Update UserTotals
            $this->updateUserTotals($user->id, $currentSalary);
        }

        // ADD next month salary to current month salary (not replace)
        $user->current_month_salary += $nextSalary;
        $user->next_month_salary = 0;

        $user->save();

        return true;
    }

    private function updateUserTotals($userId, $salaryAmount)
    {
        $userTotal = UserTotal::firstOrNew(['user_id' => $userId]);
        
        if (!$userTotal->exists) {
            $userTotal->fill([
                'total_invested' => 0,
                'total_referral_commission' => 0,
                'total_rewards' => 0,
                'total_withdraws' => 0,
                'total_fee' => 0,
                'direct_count' => 0,
                'level_1_investment' => 0,
                'level_2_investment' => 0,
                'level_3_investment' => 0,
                'level_4_investment' => 0,
                'level_5_investment' => 0,
                'level_6_investment' => 0,
                'level_7_investment' => 0,
            ]);
        }

        $userTotal->total_salaries += $salaryAmount;
        $userTotal->save();
    }

    private function logSystemEvent($processedUsers, $netBalanceAdded, $addedToCurrent)
    {
        SystemLog::create([
            'module' => 'salary_processing',
            'action' => 'monthly_salary_run',
            'log_level' => 'info',
            'user_id' => null, // System process
            'amount' => $netBalanceAdded,
            'description' => 'Monthly salary processing completed',
            'details' => "Processed {$processedUsers} users. Net balance increased by: {$netBalanceAdded}. Added to current month: {$addedToCurrent}",
            'metadata' => json_encode([
                'processed_users' => $processedUsers,
                'net_balance_added' => $netBalanceAdded,
                'added_to_current_month' => $addedToCurrent,
                'processing_date' => now()->toISOString()
            ]),
            'status' => 'success',
            'processed_at' => now(),
            'ip_address' => request()->ip() ?? '127.0.0.1',
            'user_agent' => 'Laravel Console Scheduler'
        ]);
    }

    private function logError(\Exception $e)
    {
        SystemLog::create([
            'module' => 'salary_processing',
            'action' => 'monthly_salary_run',
            'log_level' => 'error',
            'user_id' => null,
            'description' => 'Monthly salary processing failed',
            'details' => $e->getMessage(),
            'metadata' => json_encode([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'processing_date' => now()->toISOString()
            ]),
            'status' => 'failed',
            'ip_address' => request()->ip() ?? '127.0.0.1',
            'user_agent' => 'Laravel Console Scheduler'
        ]);
    }
}