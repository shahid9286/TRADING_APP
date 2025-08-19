<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WithdrawalRequest;
use App\Models\User;
use App\Models\AdminBank;
use App\Models\UserBank;
use Carbon\Carbon;

class WithdrawalRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $adminBank = AdminBank::first();
        $userBank = UserBank::first();

        if ($user && $adminBank && $userBank) {
            WithdrawalRequest::updateOrCreate(
                ['transaction_id' => 'TXN123456'],
                [
                    'user_id' => $user->id,
                    'admin_bank_id' => $adminBank->id,
                    'user_bank_id' => $userBank->id,
                    'bank_name' => $userBank->bank_name,
                    'account_no' => $userBank->account_no,
                    'request_date' => Carbon::now()->subDays(2),
                    'requested_amount' => 1000.00,
                    'status' => 'pending',
                    'client_status' => 'pending'
                ]
            );

            WithdrawalRequest::updateOrCreate(
                ['transaction_id' => 'TXN654321'],
                [
                    'user_id' => $user->id,
                    'admin_bank_id' => $adminBank->id,
                    'user_bank_id' => $userBank->id,
                    'bank_name' => $userBank->bank_name,
                    'account_no' => $userBank->account_no,
                    'request_date' => Carbon::now()->subDays(5),
                    'requested_amount' => 5000.00,
                    'status' => 'approved',
                    'approval_date' => Carbon::now()->subDays(4),
                    'payout_date' => Carbon::now()->subDay(),
                    'payout_amount' => 4800.00,
                    'fee' => 200.00,
                    'total_payout' => 4800.00,
                    'transaction_id' => 'TXN654321',
                    'client_status' => 'verified'
                ]
            );
        }
    }
}
