<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminBankSeeder;
use Database\Seeders\InvestmentSeeder;
use Database\Seeders\BusinessRulesSeeder;
use Database\Seeders\UserProfilesSeeder;
use Database\Seeders\SalaryRulesSeeder;
use Database\Seeders\UserBanksSeeder;
use Database\Seeders\WithdrawalRequestsSeeder;
use Database\Seeders\AnnouncementsSeeder;
use Database\Seeders\UserTotalsSeeder;
use Database\Seeders\UserReturnsSeeder;
use Database\Seeders\UserLedgerSeeder;










class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(BusinessRulesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserProfilesSeeder::class);
        $this->call(AdminBankSeeder::class);
        $this->call(InvestmentSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(SalaryRulesSeeder::class);
        $this->call(UserBanksSeeder::class);
        $this->call(WithdrawalRequestsSeeder::class);
        $this->call(AnnouncementsSeeder::class);
        $this->call(UserReturnsSeeder::class);
        $this->call(UserLedgerSeeder::class);
        $this->call(UserTotalsSeeder::class);
        

    }
}
