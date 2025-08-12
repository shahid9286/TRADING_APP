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
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_bank_id')->nullable()->constrained('admin_banks')->onDelete('set null');
            $table->foreignId('user_bank_id')->nullable()->constrained('user_banks')->onDelete('set null');
            $table->date('request_date');
            $table->decimal('requested_amount', 15, 2);
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->date('approval_date')->nullable();
            $table->date('payout_date')->nullable();
            $table->decimal('payout_amount', 15, 2)->nullable();
            $table->decimal('fee', 15, 2)->nullable();
            $table->decimal('total_payout', 15, 2)->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('screenshot')->nullable();
            $table->enum('client_status', ['pending', 'verified'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_requests');
    }
};
