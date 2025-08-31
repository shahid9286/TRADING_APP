<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\User;
use Carbon\Carbon;
use App\Models\UserTotal;
use App\Models\UserReturn;
use App\Models\UserLedger;
use App\Models\BusinessRule;
use App\Models\SystemLog;
use Illuminate\Support\Facades\DB;

class InvestmentApprovalService
{
    protected $emailService;

    public function __construct(EmailService $emailService = null)
    {
        // Use provided email service or create a new instance
        $this->emailService = $emailService ?? new EmailService();
    }

    public function approveInvestment($id)
    {
        try {
            DB::beginTransaction();

            $businessRule = BusinessRule::first();
            if (!$businessRule) {
                throw new \Exception('Business rules not found');
            }

            $investment = Investment::findOrFail($id);
            if ($investment->status !== 'pending' || $investment->is_active === 'active') {
                return [
                    'success' => false,
                    'message' => 'Investment already approved or active, no action taken.'
                ];
            }
            $investment->status = 'approved';
            $investment->is_active = 'active';
            $investment->approved_at = now();
            $investment->expiry_date = now()->addYear()->subDay();
            $investment->save();

            $user = User::findOrFail($investment->user_id);
           


            // Update user's total invested amount
            $userTotal = UserTotal::firstOrCreate(['user_id' => $user->id]);
            $userTotal->total_invested += $investment->amount;
            $userTotal->save();

            // Create user_return and user_ledger entries
            $this->createInvestmentRecords($investment, $user);

            // Send notifications
            $this->sendNotifications($investment, $user);

            // Log investment approval
            $this->logInvestmentApproval($investment, $user);

            // Distribute commissions


            if ($investment->referral_id) {

                 $referralUser = User::findOrFail($investment->referral_id);
                if (!$investment->is_refferal_paid) {
                    $this->distributeCommissions($investment, $user, $businessRule);
                    $investment->is_refferal_paid = true;
                    $investment->save();
                }

                $this->calculateAndSaveReferralSalary($referralUser, $businessRule);
            }




            DB::commit();

            return [
                'success' => true,
                'message' => 'Investment approved, commissions distributed, and notifications sent successfully!'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function createInvestmentRecords($investment, $user)
    {
        // Create user_return entry for the investment
        $userReturn = UserReturn::create([
            'investment_id' => $investment->id,
            'user_id' => $user->id,
            'amount' => $investment->amount,
            'entry_date' => now(),
            'type' => 'investment',
        ]);

        // Get current balance before creating ledger entry
        $balanceBefore = $user->net_balance;
        $balanceAfter = $user->net_balance + $investment->amount;

        // Create user_ledger entry for the investment
        UserLedger::create([
            'user_id' => $user->id,
            'user_return_id' => $userReturn->id,
            'type' => 'investment',
            'balance_before' => $balanceBefore,
            'balance_after' => $balanceAfter,
            'amount' => $investment->amount,
        ]);
    }

    private function sendNotifications($investment, $user)
    {
        try {
            // Send email to user
            $userVariables = [
                'user_name' => $user->username,
                'investment_amount' => number_format($investment->amount, 2),
                'investment_id' => $investment->id,
                'approved_date' => now()->format('Y-m-d H:i:s'),
                'expiry_date' => $investment->expiry_date->format('Y-m-d'),
                "admin_name" => auth()->user()->username,
                'investment_date' => $investment->start_date->format('Y-m-d'),
            ];

            $this->emailService->sendEmailToSingleUser('investment_approved_user', $userVariables, $user->email);

            // Notify admins
            $adminVariables = [
                'user_name' => $user->username,
                'investment_amount' => number_format($investment->amount, 2),
                'user_email' => $user->email,
                'investment_date' => $investment->start_date->format('Y-m-d'),
                'admin_name' => auth()->user()->name,
            ];

            $this->emailService->sendEmailsToAllAdmins('investment_approved_admin', $adminVariables, 'admin');
        } catch (\Exception $e) {
            // Log email sending error but don't stop the whole process
            SystemLog::createLog([
                'module' => 'email',
                'action' => 'email_send_failed',
                'log_level' => 'warning',
                'description' => 'Failed to send investment approval emails',
                'details' => $e->getMessage(),
                'metadata' => [
                        'investment_id' => $investment->id,
                        'user_id' => $user->id
                    ]
            ]);
        }
    }

    private function logInvestmentApproval($investment, $user)
    {
        SystemLog::createLog([
            'module' => 'investment',
            'action' => 'investment_approved',
            'loggable_id' => $investment->id,
            'loggable_type' => Investment::class,
            'affected_user_id' => $user->id,
            'description' => "Investment #{$investment->id} approved for {$user->username}",
            'details' => "Amount: $" . number_format($investment->amount, 2),
            'metadata' => [
                    'investment_amount' => $investment->amount,
                    'approved_by' => auth()->user()->username,
                    'expiry_date' => $investment->expiry_date
                ]
        ]);
    }

    private function distributeCommissions($investment, $user, $businessRule)
    {
        for ($level = 1; $level <= 7; $level++) {
            $levelField = "level_{$level}_user_id";

            if ($user->$levelField) {
                $referralUser = User::findOrFail($user->$levelField);

                $commissionRate = "level_{$level}_comm_rate";
                if (!isset($businessRule->$commissionRate)) {
                    throw new \Exception("Commission rate for level {$level} not found");
                }
                $commissionAmount = $investment->amount * $businessRule->$commissionRate / 100;

                // Get balance before commission is added
                $commissionBalanceBefore = $referralUser->net_balance;
                $referralUser->net_balance += $commissionAmount;
                $referralUser->save();

                // Get balance after commission is added
                $commissionBalanceAfter = $referralUser->net_balance;

                // Create user_return entry for referral commission
                $commissionReturn = UserReturn::create([
                    'investment_id' => $investment->id,
                    'user_id' => $referralUser->id,
                    'amount' => $commissionAmount,
                    'referral_id' => $user->id,
                    'entry_date' => now(),
                    'type' => 'referral_commission',
                ]);

                // Create user_ledger entry for referral commission
                UserLedger::create([
                    'user_id' => $referralUser->id,
                    'user_return_id' => $commissionReturn->id,
                    'type' => 'referral_commission',
                    'balance_before' => $commissionBalanceBefore,
                    'balance_after' => $commissionBalanceAfter,
                    'amount' => $commissionAmount,
                ]);

                $referralUserTotal = UserTotal::firstOrCreate(['user_id' => $referralUser->id]);
                $referralUserTotal->total_referral_commission += $commissionAmount;
                $levelInvestmentField = "level_{$level}_investment";
                $referralUserTotal->$levelInvestmentField += $investment->amount;
                $referralUserTotal->save();

                if ($level === 1) {
                    $referralUserTotal->direct_count += 1;
                    $referralUserTotal->save();
                }

                // Log commission distribution
                SystemLog::createLog([
                    'module' => 'commission',
                    'action' => 'commission_distributed',
                    'loggable_id' => $investment->id,
                    'loggable_type' => Investment::class,
                    'user_id' => $user->id,
                    'affected_user_id' => $referralUser->id,
                    'amount' => $commissionAmount,
                    'commission_rate' => $businessRule->$commissionRate,
                    'level' => $level,
                    'description' => "Level {$level} commission distributed",
                    'details' => "From: {$user->username}, To: {$referralUser->username}, Amount: $" . number_format($commissionAmount, 2),
                    'metadata' => [
                            'from_user' => $user->username,
                            'to_user' => $referralUser->username,
                            'level' => $level,
                            'commission_rate' => $businessRule->$commissionRate,
                            'investment_id' => $investment->id
                        ]
                ]);
            }
        }
    }

    public function calculateAndSaveReferralSalary($user, $businessRule)
    {
        try {
            $currentMonth = now()->month;
            $currentYear = now()->year;
            $currentDay = now()->day;

            // Log start of salary calculation
            SystemLog::createLog([
                'module' => 'salary',
                'action' => 'salary_calculation_started',
                'user_id' => $user->id,
                'description' => "Starting referral salary calculation for {$user->username}",
                'metadata' => [
                        'calculation_month' => $currentMonth,
                        'calculation_year' => $currentYear,
                        'current_day' => $currentDay
                    ]
            ]);

            $investmentAmount = 0;
            $salaryType = '';

            if ($currentDay <= $businessRule->salary_decided_day) {

                $investmentAmount = Investment::where("referral_id", $user->id)
                    ->where('status', 'approved')
                    ->where('is_active', 'active')
                    ->where('expiry_date', '>=', today())
                    ->where(function ($query) use ($currentMonth, $currentYear, $businessRule) {
                        // Investments from previous years
                        $query->whereYear('approved_at', '<', $currentYear)
                            // OR investments from previous months of current year
                            ->orWhere(function ($query) use ($currentMonth, $currentYear) {
                            $query->whereYear('approved_at', $currentYear)
                                ->whereMonth('approved_at', '<', $currentMonth);
                        })

                            ->orWhere(function ($query) use ($currentMonth, $currentYear, $businessRule) {
                            $query->whereYear('approved_at', $currentYear)
                                ->whereMonth('approved_at', $currentMonth)
                                ->whereDay('approved_at', '<=', $businessRule->salary_decided_day);
                        });
                    })
                    ->sum("amount");
                $salaryType = 'current_month_salary';
            } else {
                // Calculate NEW investment (current month 21 to end of month)
                $lastDayOfMonth = Carbon::create($currentYear, $currentMonth)->endOfMonth()->day;

                $investmentAmount = Investment::where("referral_id", $user->id)
                    ->where('status', 'approved')
                    ->where('is_active', 'active')
                    ->where('expiry_date', '>=', today())
                    ->whereYear('approved_at', $currentYear)
                    ->whereMonth('approved_at', $currentMonth)
                    ->whereDay('approved_at', '>=', $businessRule->salary_decided_day + 1)
                    ->whereDay('approved_at', '<=', $lastDayOfMonth)
                    ->sum("amount");
                $salaryType = 'next_month_salary';
            }

            $salaryAmount = $investmentAmount * $businessRule->monthly_return_rate / 100;
            if ($salaryType === 'current_month_salary') {

                $user->current_month_salary = 0;

                $user->current_month_salary += $salaryAmount;
            } else {

                $user->next_month_salary = 0;

                $user->next_month_salary += $salaryAmount;
            }
            $user->save();


            // Log successful salary calculation
            SystemLog::createLog([
                'module' => 'salary',
                'action' => 'salary_calculated',
                'user_id' => $user->id,
                'description' => "Referral salary calculated for {$user->username}",
                'details' => "Salary type: {$salaryType}, Amount: $" . number_format($salaryAmount, 2),
                'metadata' => [
                        'investment_amount' => $investmentAmount,
                        'monthly_return_rate' => $businessRule->monthly_return_rate,
                        'salary_amount' => $salaryAmount,
                        'salary_type' => $salaryType,
                        'calculation_date' => now()->format('Y-m-d H:i:s'),
                        'current_day' => $currentDay
                    ]
            ]);

            return [
                'success' => true,
                'salary_type' => $salaryType,
                'salary_amount' => $salaryAmount,
                'investment_amount' => $investmentAmount,
                'monthly_return_rate' => $businessRule->monthly_return_rate
            ];
        } catch (\Exception $e) {
            // Log salary calculation error
            SystemLog::createLog([
                'module' => 'salary',
                'action' => 'salary_calculation_failed',
                'log_level' => 'error',
                'user_id' => $user->id,
                'description' => "Failed to calculate referral salary for {$user->username}",
                'details' => $e->getMessage(),
                'metadata' => [
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'error_time' => now()->format('Y-m-d H:i:s')
                    ]
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'salary_amount' => 0
            ];
        }
    }
}
