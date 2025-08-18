<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalaryRule;

class SalaryRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalaryRule::updateOrCreate(
            ['id' => 1], // ek hi record maintain karna
            [
                'direct_investment' => 5000.00,
                'salary' => 2000.00,
            ]
        );

        SalaryRule::updateOrCreate(
            ['id' => 2],
            [
                'direct_investment' => 10000.00,
                'salary' => 5000.00,
            ]
        );

        SalaryRule::updateOrCreate(
            ['id' => 3],
            [
                'direct_investment' => 20000.00,
                'salary' => 12000.00,
            ]
        );
    }
}
