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
        Schema::create('admin_banks', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('account_no');
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->integer('order_no');
        $table->text('notes')->nullable();
        $table->softDeletes();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_banks');
    }
};
