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
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('attachment')->nullable()->after('user_id');
            $table->string('attachment_name')->nullable();
            $table->string('attachment_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('attachment');
            $table->dropColumn('attachment_name');
            $table->dropColumn('attachment_type');
        });
    }
};
