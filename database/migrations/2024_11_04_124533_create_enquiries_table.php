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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_no');
            $table->string('subject')->nullable();
            $table->text('enquiry_message');
            $table->enum('status', ['pending', 'follow-up', 'completed'])->default('pending');
            $table->string('followup_date')->nullable();
            $table->enum('followup_type', ['call', 'whatsapp', 'message', 'email', 'info-required', 'docs-required'])->nullable();
            $table->text('remarks')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
