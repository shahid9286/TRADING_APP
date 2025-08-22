<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserLedgerSeeder extends Seeder
{
    public function run()
    {
        $records = [];
        $types = [
            'investment',
            'daily_profit',
            'referral_commission',
            'monthly_commission',
            'salary',
            'reward',
            'withdrawal',
            'admin_fee',
            'direct-plus',
            'direct-minus',
        ];

        foreach ([1, 2, 3] as $userId) {
            $balance = 0;

            for ($i = 0; $i < 10; $i++) {
                $type = $types[array_rand($types)];
                $amount = rand(100, 1000); // Random amount
                $balanceBefore = $balance;

                // Adjust balance according to type
                if (in_array($type, ['withdrawal', 'admin_fee', 'direct-minus'])) {
                    $balance -= $amount;
                } else {
                    $balance += $amount;
                }

                $records[] = [
                    'user_id' => $userId,
                    'user_return_id' => null, // or link to a return if available
                    'type' => $type,
                    'amount' => $amount,
                    'balance_before' => $balanceBefore,
                    'balance_after' => $balance,
                    'description' => 'Ledger entry for ' . $type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('user_ledgers')->insert($records);
    }
}
