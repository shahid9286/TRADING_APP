<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Investment;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Investment::insert([
            [          
                'amount' => 5000.00,
                'start_date' => $now,
                'expiry_date' => $now->copy()->addYear(),
                'status' => 'approved',
                'transaction_id' => Str::uuid(),
                'screenshot' => 'uploads/screenshots/sample.png',
                'is_active' => 'active',
                'admin_bank_address' => '1234567890123456',
                'user_id' => 1,
                'referral_id' => null,
                'admin_bank_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [          
                'amount' => 4500.00,
                'start_date' => $now,
                'expiry_date' => $now->copy()->addYear(),
                'status' => 'pending',
                'transaction_id' => Str::uuid(),
                'screenshot' => 'uploads/screenshots/sample.png',
                'is_active' => 'active',
                'admin_bank_address' => '1234567890123456',
                'user_id' => 1,
                'referral_id' => null,
                'admin_bank_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [          
                'amount' => 6000.00,
                'start_date' => $now,
                'expiry_date' => $now->copy()->addYear(),
                'status' => 'approved',
                'transaction_id' => Str::uuid(),
                'screenshot' => 'uploads/screenshots/sample.png',
                'is_active' => 'active',
                'admin_bank_address' => '1234567890123456',
                'user_id' => 1,
                'referral_id' => null,
                'admin_bank_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
