<?php

namespace App\Http\Controllers\Admin;

use App\Models\SystemLog;
use App\Models\BusinessRule;
use App\Models\User;
use App\Models\AdminBank;
use App\Models\UserTotal;
use App\Models\Investment;
use App\Services\EmailService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with('user')->orderBy('id', 'desc')->get();
        return view('admin.investment.index', compact('investments'));
    }

    public function search(Request $request)
    {
        $query = Investment::query();

        // Filter by Transaction ID
        if ($request->filled('transaction_id')) {
            $query->where('transaction_id', $request->transaction_id);
        }

        if ($request->filled('date_range')) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) === 2) {
                $startDate = \Carbon\Carbon::parse($dates[0])->startOfDay();
                $endDate = \Carbon\Carbon::parse($dates[1])->endOfDay();

                $query->whereBetween('start_date', [$startDate, $endDate]);
            }
        }

        // Filter by Amount
        if ($request->filled('amount')) {
            $query->where('amount', $request->amount);
        }

        // Filter by Status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $investments = $query->orderBy('id', 'desc')->get();

        $html = view('admin.investment.table', compact('investments'))->render();
        return response()->json(['html' => $html]);
    }


    // public function investmentApproved($id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $businessRule = BusinessRule::first();
    //         if (!$businessRule) {
    //             throw new \Exception('Business rules not found');
    //         }

    //         $investment = Investment::findOrFail($id);

    //         // Update investment status
    //         $investment->status = 'approved';
    //         $investment->approved_at = now();
    //         $investment->expiry_date = now()->addYear();
    //         $investment->save();

    //         $user = User::findOrFail($investment->user_id);

    //         // Log investment approval
    //         SystemLog::createLog([
    //             'module' => 'investment',
    //             'action' => 'investment_approved',
    //             'loggable_id' => $investment->id,
    //             'loggable_type' => Investment::class,
    //             'affected_user_id' => $user->id,
    //             'description' => "Investment #{$investment->id} approved for {$user->username}",
    //             'details' => "Amount: $" . number_format($investment->amount, 2),
    //             'metadata' => [
    //                 'investment_amount' => $investment->amount,
    //                 'approved_by' => auth()->user()->username,
    //                 'expiry_date' => $investment->expiry_date
    //             ]
    //         ]);

    //         // Distribute commissions through all 7 levels
    //         $currentUser = $user;

    //         for ($level = 1; $level <= 7; $level++) {
    //             $levelField = "level_{$level}_user_id";

    //             if ($currentUser->$levelField) {
    //                 $referralUser = User::findOrFail($currentUser->$levelField);
    //                 $commissionRate = "level_{$level}_comm_rate";

    //                 // Validate commission rate exists
    //                 if (!isset($businessRule->$commissionRate)) {
    //                     throw new \Exception("Commission rate for level {$level} not found");
    //                 }
    //                 $commissionAmount = $investment->amount * $businessRule->$commissionRate / 100;
    //                 $referralUser->net_balance += $commissionAmount;
    //                 $referralUser->save();

    //                 // Log commission distribution
    //                 SystemLog::createLog([
    //                     'module' => 'commission',
    //                     'action' => 'commission_distributed',
    //                     'loggable_id' => $investment->id,
    //                     'loggable_type' => Investment::class,
    //                     'user_id' => $currentUser->id,
    //                     'affected_user_id' => $referralUser->id,
    //                     'amount' => $commissionAmount,
    //                     'commission_rate' => $businessRule->$commissionRate,
    //                     'level' => $level,
    //                     'description' => "Level {$level} commission distributed",
    //                     'details' => "From: {$currentUser->username}, To: {$referralUser->username}, Amount: $" . number_format($commissionAmount, 2),
    //                     'metadata' => [
    //                         'from_user' => $currentUser->username,
    //                         'to_user' => $referralUser->username,
    //                         'level' => $level,
    //                         'commission_rate' => $businessRule->$commissionRate,
    //                         'investment_id' => $investment->id
    //                     ]
    //                 ]);

    //                 $currentUser = $referralUser;
    //             } else {
    //                 break;
    //             }
    //         }

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Investment approved and commissions distributed successfully!');
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         DB::rollBack();

    //         SystemLog::createLog([
    //             'module' => 'investment',
    //             'action' => 'investment_approval_failed',
    //             'log_level' => 'error',
    //             'description' => 'Model not found during investment approval',
    //             'details' => $e->getMessage(),
    //             'metadata' => ['investment_id' => $id]
    //         ]);

    //         return redirect()->back()->with('error', 'Investment or user not found.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         SystemLog::createLog([
    //             'module' => 'investment',
    //             'action' => 'investment_approval_failed',
    //             'log_level' => 'error',
    //             'description' => 'Error during investment approval',
    //             'details' => $e->getMessage(),
    //             'metadata' => [
    //                 'investment_id' => $id,
    //                 'file' => $e->getFile(),
    //                 'line' => $e->getLine()
    //             ]
    //         ]);

    //         return redirect()->back()->with('error', 'Failed to approve investment: ' . $e->getMessage());
    //     }
    // }



    // public function investmentApproved($id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $businessRule = BusinessRule::first();
    //         if (!$businessRule) {
    //             throw new \Exception('Business rules not found');
    //         }

    //         $investment = Investment::findOrFail($id);

    //         // Update investment status
    //         $investment->status = 'approved';
    //         $investment->approved_at = now();
    //         $investment->expiry_date = now()->addYear();
    //         $investment->save();

    //         $user = User::findOrFail($investment->user_id);

    //         // Initialize email service
    //         $emailService = new EmailService();

    //         // Send email to user
    //         $userVariables = [
    //             'user_name' => $user->username,
    //             'investment_amount' => number_format($investment->amount, 2),
    //             'investment_id' => $investment->id,
    //             'approved_date' => now()->format('Y-m-d H:i:s'),
    //             'expiry_date' => $investment->expiry_date->format('Y-m-d'),
    //             "admin_name" => auth()->user()->name,
    //             'investment_date' => $investment->start_date->format('Y-m-d'),
    //         ];

    //         $emailService->sendEmailToSingleUser('investment_approved_user', $userVariables, $user->email);

    //         // Send notification to all admins (using role name instead of user_type)
    //         $adminVariables = [
    //             'user_name' => $user->username,
    //             'investment_amount' => number_format($investment->amount, 2),
    //             'user_email' => $user->emial,
    //             'investment_date' => $investment->start_date->format('Y-m-d'),
    //             'admin_name' => auth()->user()->name,


    //         ];

    //         // Use role name (e.g., 'admin') instead of user_type
    //         $emailService->sendEmailsToAllAdmins('investment_approved_admin', $adminVariables, 'admin');

    //         // Log investment approval - FIXED: Use proper array syntax
    //         SystemLog::createLog([
    //             'module' => 'investment',
    //             'action' => 'investment_approved',
    //             'loggable_id' => $investment->id,
    //             'loggable_type' => Investment::class,
    //             'affected_user_id' => $user->id,
    //             'description' => "Investment #{$investment->id} approved for {$user->username}",
    //             'details' => "Amount: $" . number_format($investment->amount, 2),
    //             'metadata' => [
    //                 'investment_amount' => $investment->amount,
    //                 'approved_by' => auth()->user()->username,
    //                 'expiry_date' => $investment->expiry_date
    //             ]
    //         ]);

    //         // Distribute commissions through all 7 levels
    //         $currentUser = $user;

    //         for ($level = 1; $level <= 7; $level++) {
    //             $levelField = "level_{$level}_user_id";

    //             if ($currentUser->$levelField) {
    //                 $referralUser = User::findOrFail($currentUser->$levelField);
    //                 $commissionRate = "level_{$level}_comm_rate";

    //                 // Validate commission rate exists
    //                 if (!isset($businessRule->$commissionRate)) {
    //                     throw new \Exception("Commission rate for level {$level} not found");
    //                 }
    //                 $commissionAmount = $investment->amount * $businessRule->$commissionRate / 100;
    //                 $referralUser->net_balance += $commissionAmount;
    //                 $referralUser->save();

    //                 // Log commission distribution - FIXED: Use proper array syntax
    //                 SystemLog::createLog([
    //                     'module' => 'commission',
    //                     'action' => 'commission_distributed',
    //                     'loggable_id' => $investment->id,
    //                     'loggable_type' => Investment::class,
    //                     'user_id' => $currentUser->id,
    //                     'affected_user_id' => $referralUser->id,
    //                     'amount' => $commissionAmount,
    //                     'commission_rate' => $businessRule->$commissionRate,
    //                     'level' => $level,
    //                     'description' => "Level {$level} commission distributed",
    //                     'details' => "From: {$currentUser->username}, To: {$referralUser->username}, Amount: $" . number_format($commissionAmount, 2),
    //                     'metadata' => [
    //                         'from_user' => $currentUser->username,
    //                         'to_user' => $referralUser->username,
    //                         'level' => $level,
    //                         'commission_rate' => $businessRule->$commissionRate,
    //                         'investment_id' => $investment->id
    //                     ]
    //                 ]);

    //                 $currentUser = $referralUser;
    //             } else {
    //                 break;
    //             }
    //         }

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Investment approved, commissions distributed, and notifications sent successfully!');
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         DB::rollBack();

    //         // FIXED: Use proper array syntax
    //         SystemLog::createLog([
    //             'module' => 'investment',
    //             'action' => 'investment_approval_failed',
    //             'log_level' => 'error',
    //             'description' => 'Model not found during investment approval',
    //             'details' => $e->getMessage(),
    //             'metadata' => ['investment_id' => $id]
    //         ]);

    //         return redirect()->back()->with('error', 'Investment or user not found.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // FIXED: Use proper array syntax
    //         SystemLog::createLog([
    //             'module' => 'investment',
    //             'action' => 'investment_approval_failed',
    //             'log_level' => 'error',
    //             'description' => 'Error during investment approval',
    //             'details' => $e->getMessage(),
    //             'metadata' => [
    //                 'investment_id' => $id,
    //                 'file' => $e->getFile(),
    //                 'line' => $e->getLine()
    //             ]
    //         ]);

    //         return redirect()->back()->with('error', 'Failed to approve investment: ' . $e->getMessage());
    //     }
    // }


    public function investmentApproved($id)
    {
        try {
            DB::beginTransaction();

            $businessRule = BusinessRule::first();
            if (!$businessRule) {
                throw new \Exception('Business rules not found');
            }

            $investment = Investment::findOrFail($id);

            // Update investment status
            $investment->status = 'approved';
            $investment->approved_at = now();
            $investment->expiry_date = now()->addYear();
            $investment->save();

            $user = User::findOrFail($investment->user_id);

            // Update user's total invested amount
            $userTotal = UserTotal::firstOrCreate(['user_id' => $user->id]);
            $userTotal->total_invested += $investment->amount;
            $userTotal->save();

            // Initialize email service
            $emailService = new EmailService();

            // Send email to user
            $userVariables = [
                'user_name' => $user->username,
                'investment_amount' => number_format($investment->amount, 2),
                'investment_id' => $investment->id,
                'approved_date' => now()->format('Y-m-d H:i:s'),
                'expiry_date' => $investment->expiry_date->format('Y-m-d'),
                "admin_name" => auth()->user()->name,
                'investment_date' => $investment->start_date->format('Y-m-d'),
            ];

            $emailService->sendEmailToSingleUser('investment_approved_user', $userVariables, $user->email);

            // Send notification to all admins (using role name instead of user_type)
            $adminVariables = [
                'user_name' => $user->username,
                'investment_amount' => number_format($investment->amount, 2),
                'user_email' => $user->email,
                'investment_date' => $investment->start_date->format('Y-m-d'),
                'admin_name' => auth()->user()->name,
            ];

            // Use role name (e.g., 'admin') instead of user_type
            $emailService->sendEmailsToAllAdmins('investment_approved_admin', $adminVariables, 'admin');

            // Log investment approval
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

            // Distribute commissions through all 7 levels
            $currentUser = $user;

            for ($level = 1; $level <= 7; $level++) {
                $levelField = "level_{$level}_user_id";

                if ($currentUser->$levelField) {
                    $referralUser = User::findOrFail($currentUser->$levelField);
                    $commissionRate = "level_{$level}_comm_rate";

                    // Validate commission rate exists
                    if (!isset($businessRule->$commissionRate)) {
                        throw new \Exception("Commission rate for level {$level} not found");
                    }

                    $commissionAmount = $investment->amount * $businessRule->$commissionRate / 100;
                    $referralUser->net_balance += $commissionAmount;
                    $referralUser->save();

                    // Update referral user's total commission
                    $referralUserTotal = UserTotal::firstOrCreate(['user_id' => $referralUser->id]);
                    $referralUserTotal->total_referral_commission += $commissionAmount;

                    // Update level investment tracking
                    $levelInvestmentField = "level_{$level}_investment";
                    $referralUserTotal->$levelInvestmentField += $investment->amount;

                    $referralUserTotal->save();

                    // For level 1, update direct referral count
                    if ($level === 1) {
                        $referrerTotal = UserTotal::firstOrCreate(['user_id' => $currentUser->$levelField]);
                        $referrerTotal->direct_count += 1;
                        $referrerTotal->save();
                    }

                    // Log commission distribution
                    SystemLog::createLog([
                        'module' => 'commission',
                        'action' => 'commission_distributed',
                        'loggable_id' => $investment->id,
                        'loggable_type' => Investment::class,
                        'user_id' => $currentUser->id,
                        'affected_user_id' => $referralUser->id,
                        'amount' => $commissionAmount,
                        'commission_rate' => $businessRule->$commissionRate,
                        'level' => $level,
                        'description' => "Level {$level} commission distributed",
                        'details' => "From: {$currentUser->username}, To: {$referralUser->username}, Amount: $" . number_format($commissionAmount, 2),
                        'metadata' => [
                            'from_user' => $currentUser->username,
                            'to_user' => $referralUser->username,
                            'level' => $level,
                            'commission_rate' => $businessRule->$commissionRate,
                            'investment_id' => $investment->id
                        ]
                    ]);

                    $currentUser = $referralUser;
                } else {
                    break;
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Investment approved, commissions distributed, and notifications sent successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();

            SystemLog::createLog([
                'module' => 'investment',
                'action' => 'investment_approval_failed',
                'log_level' => 'error',
                'description' => 'Model not found during investment approval',
                'details' => $e->getMessage(),
                'metadata' => ['investment_id' => $id]
            ]);

            return redirect()->back()->with('error', 'Investment or user not found.');
        } catch (\Exception $e) {
            DB::rollBack();

            SystemLog::createLog([
                'module' => 'investment',
                'action' => 'investment_approval_failed',
                'log_level' => 'error',
                'description' => 'Error during investment approval',
                'details' => $e->getMessage(),
                'metadata' => [
                    'investment_id' => $id,
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ]);

            return redirect()->back()->with('error', 'Failed to approve investment: ' . $e->getMessage());
        }
    }



}
