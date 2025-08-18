<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('business_rules', function (Blueprint $table) {
            $table->id();

            $table->decimal('min_deposit', 12, 2)->default(0);
            $table->decimal('min_withdraw_limit', 12, 2)->default(0);

            $table->decimal('daily_return_rate', 5, 2)->default(0);     // % me store karna ho to
            $table->decimal('monthly_return_rate', 5, 2)->default(0);

            $table->decimal('level_1_comm_rate', 5, 2)->default(0);
            $table->decimal('level_2_comm_rate', 5, 2)->default(0);
            $table->decimal('level_3_comm_rate', 5, 2)->default(0);
            $table->decimal('level_4_comm_rate', 5, 2)->default(0);
            $table->decimal('level_5_comm_rate', 5, 2)->default(0);
            $table->decimal('level_6_comm_rate', 5, 2)->default(0);
            $table->decimal('level_7_comm_rate', 5, 2)->default(0);

            $table->date('salary_date')->nullable();
            $table->date('salary_payout_date')->nullable();
            $table->date('entry_approval_date')->nullable();
            $table->date('withdraw_last_date')->nullable();
            $table->date('withdraw_payout_date')->nullable();
            $table->date('withdraw_payout_date_2')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_rules');
    }
};
