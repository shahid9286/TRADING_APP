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
        Schema::table('email_templates', function (Blueprint $table) {
            Schema::table('email_templates', function (Blueprint $table) {
            $table->string('slug')->after('subject')->unique();
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_templates', function (Blueprint $table) {
            Schema::table('email_templates', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        });
    }
};
