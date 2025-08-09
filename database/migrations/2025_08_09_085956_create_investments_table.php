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
            $table->enum('is_active', ['active', 'expired'])->default('active');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('referral_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('admin_bank_account_id')->constrained('admin_bank_accounts')->onDelete('cascade');

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
