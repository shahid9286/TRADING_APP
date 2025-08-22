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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->dateTime('start_date');
            $table->dateTime('expiry_date');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('transaction_id')->unique();
            $table->string('screenshot');
            $table->boolean('is_refferal_paid')->default(false);
            $table->string('admin_bank_address')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->date('monthly_commission_start_date')->nullable();
            $table->enum('is_active', ['active', 'expired'])->default('active');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('referral_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('admin_bank_id')->constrained('admin_banks')->onDelete('cascade');
            $table->index('expiry_date');
            $table->index('transaction_id');
            $table->index('user_id');
            $table->index('referral_id');
            $table->index('admin_bank_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
