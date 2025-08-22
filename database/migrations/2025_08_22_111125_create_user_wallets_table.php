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
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Financial fields
            $table->decimal('total_invested', 15, 2)->default(0);
            $table->decimal('total_refferal_commision', 15, 2)->default(0);
            $table->decimal('total_salaries', 15, 2)->default(0);
            $table->decimal('total_rewards', 15, 2)->default(0);
            $table->decimal('total_fee', 15, 2)->default(0);

            // Direct referrals
            $table->integer('direct_count')->default(0);

            // Level investments
            $table->decimal('level_1_investment', 15, 2)->default(0);
            $table->decimal('level_2_investment', 15, 2)->default(0);
            $table->decimal('level_3_investment', 15, 2)->default(0);
            $table->decimal('level_4_investment', 15, 2)->default(0);
            $table->decimal('level_5_investment', 15, 2)->default(0);
            $table->decimal('level_6_investment', 15, 2)->default(0);
            $table->decimal('level_7_investment', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallets');
    }
};
