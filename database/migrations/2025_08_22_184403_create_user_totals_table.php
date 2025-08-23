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
         Schema::create('user_totals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');

            $table->decimal('total_invested', 15, 2)->default(0);
            $table->decimal('total_referral_commission', 15, 2)->default(0);
            $table->decimal('total_salaries', 15, 2)->default(0);
            $table->decimal('total_rewards', 15, 2)->default(0);
            $table->decimal('total_withdraws', 15, 2)->default(0);
            $table->decimal('total_fee', 15, 2)->default(0);

            $table->integer('direct_count')->default(0);
            $table->decimal('level_1_investment', 15, 2)->default(0);
            $table->decimal('level_2_investment', 15, 2)->default(0);
            $table->decimal('level_3_investment', 15, 2)->default(0);
            $table->decimal('level_4_investment', 15, 2)->default(0);
            $table->decimal('level_5_investment', 15, 2)->default(0);
            $table->decimal('level_6_investment', 15, 2)->default(0);
            $table->decimal('level_7_investment', 15, 2)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_totals');
    }
};
