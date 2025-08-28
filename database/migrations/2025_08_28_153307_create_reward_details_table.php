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
        Schema::create('reward_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reward_id'); // relation to rewards table
            $table->string('reward_title');
            $table->decimal('reward_amount', 10, 2);
            $table->decimal('target_amount', 10, 2);
            $table->timestamps();

            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_details');
    }
};
