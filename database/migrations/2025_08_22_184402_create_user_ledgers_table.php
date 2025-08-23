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
        Schema::create('user_ledgers', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('user_return_id')
                  ->nullable()
                  ->constrained('user_returns')
                  ->nullOnDelete();

            // Enum with your exact values (hyphens kept as requested)
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

            // Amounts & balances
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_before', 15, 2)->nullable();
            $table->decimal('balance_after', 15, 2)->nullable();

            // Optional description
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Helpful indexes
            $table->index(['user_id', 'type']);
            $table->index('user_return_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ledgers');
    }
};
