<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserBank;
use App\Models\User;

class UserBanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sabse pehle ek user le lete hain jisko bank assign karna hai
        $user = User::first(); // Pehla user database me

        if ($user) {
            UserBank::updateOrCreate(
                ['user_id' => $user->id, 'account_no' => '1234567890'],
                [
                    'bank_name' => 'HBL Bank',
                ]
            );

            UserBank::updateOrCreate(
                ['user_id' => $user->id, 'account_no' => '9876543210'],
                [
                    'bank_name' => 'MCB Bank',
                ]
            );
        }
    }
}
