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
                "id"=> 1,
                'name' => 'National Bank of Pakistan',
                'account_no' => '1234567890123456',
                'order_no' => 1,
                'status' => 'active',
            ],
            [
                'id'=> 2,
                'name' => 'Habib Bank Limited',
                'account_no' => '9876543210987654',
                'order_no' => 2,
                'status' => 'active',
            ],
            [
                'id'=> 3,
                'name' => 'United Bank Limited',
                'account_no' => '4567891234567891',
                'order_no' => 3,
                'status' => 'inactive',
            ],
        ];

        foreach ($banks as $bank) {
            AdminBank::updateOrCreate($bank);
        }
    }
}
