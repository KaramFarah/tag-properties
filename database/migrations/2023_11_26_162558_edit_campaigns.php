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
        if (Schema::hasTable('campaigns')) {
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->string('description')->nullable()->change();
                });
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->date('start_date')->nullable()->change();
                });
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->date('end_date')->nullable()->change();
                });
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->text('network')->nullable()->change();
                });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
