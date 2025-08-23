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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->enum('status', ['approved', 'pending', 'blocked'])->default('pending');
            $table->string('referral_username')->nullable();
            $table->foreignId('referral_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('level_1_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('level_2_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('level_3_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('level_4_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('level_5_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('level_6_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('level_7_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('password');
            $table->decimal('net_balance', 12, 2)->default(0);
            $table->decimal('locked_amount', 12, 2)->default(0);
            $table->decimal('current_month_salary', 12, 2)->default(0);
            $table->decimal('next_month_salary', 12, 2)->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
