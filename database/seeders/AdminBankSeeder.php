<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminBank;

class AdminBankSeeder extends Seeder
{
    public function run()
    {
        $banks = [
            [
                'bank_name' => 'National Bank of Pakistan',
                'bank_account' => '1234567890123456',
                'order_no' => 1,
                'status' => 'active',
            ],
            [
                'bank_name' => 'Habib Bank Limited',
                'bank_account' => '9876543210987654',
                'order_no' => 2,
                'status' => 'active',
            ],
            [
                'bank_name' => 'United Bank Limited',
                'bank_account' => '4567891234567891',
                'order_no' => 3,
                'status' => 'inactive',
            ],
        ];

        foreach ($banks as $bank) {
            AdminBank::create($bank);
        }
    }
}
