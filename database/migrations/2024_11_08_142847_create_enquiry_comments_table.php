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
        Schema::create('enquiry_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->constrained('id')->on('enquiries');
            $table->foreignId('user_id')->constrained('id')->on('users');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_comments');
    }
};
