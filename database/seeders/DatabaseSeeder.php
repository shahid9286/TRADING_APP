<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminBankSeeder;
use Database\Seeders\InvestmentSeeder;
use Database\Seeders\BusinessRulesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(BusinessRulesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminBankSeeder::class);
        $this->call(InvestmentSeeder::class);
    }
}
