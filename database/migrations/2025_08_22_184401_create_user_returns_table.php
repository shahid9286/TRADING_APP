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
        Schema::create('user_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investment_id')->nullable()->constrained('investments')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->foreignId('referral_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('entry_date');
            $table->enum('type', [
                'investment',
                'daily_profit',
                'referral_commission',
                'monthly_commission',
                'salary',
                'reward',
                'withdrawal',
                'admin_fee',
                'direct-plus',
                'direct-minus',
            ]);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_returns');
    }
};
