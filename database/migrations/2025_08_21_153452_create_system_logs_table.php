<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();

            // Log identification
            $table->string('module')->nullable()->comment('Module/feature where log occurred');
            $table->string('action')->comment('Specific action performed');
            $table->string('log_level')->default('info')->comment('info, warning, error, critical, debug');

            // User information
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('affected_user_id')->nullable()->constrained('users')->nullOnDelete();

            // Polymorphic relationship - manual implementation
            $table->string('loggable_type')->nullable();
            $table->unsignedBigInteger('loggable_id')->nullable();
            $table->index(['loggable_type', 'loggable_id'], 'system_logs_loggable_index');

            // Commission specific fields (if applicable)
            $table->decimal('amount', 12, 2)->nullable();
            $table->decimal('commission_rate', 5, 2)->nullable();
            $table->unsignedTinyInteger('level')->nullable();

            // Detailed description
            $table->text('description')->nullable();
            $table->text('details')->nullable()->comment('Additional details in text format');
            $table->json('metadata')->nullable()->comment('Structured data in JSON format');

            // IP and user agent for audit trails
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            // Status and timestamps
            $table->enum('status', ['success', 'failed', 'pending', 'processing'])->default('success');
            $table->timestamp('processed_at')->nullable();

            $table->timestamps();

            // Indexes for better performance
            $table->index('module');
            $table->index('action');
            $table->index('log_level');
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
};
