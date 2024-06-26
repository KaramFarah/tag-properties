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
        Schema::table('installments', function (Blueprint $table) {
            $table->string('type')->change();
            $table->string('milestone')->nullable()->change();
            $table->string('payment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('installments', function (Blueprint $table) {
            $table->tinyInteger('type')->nullable()->change();
            $table->tinyInteger('milestone')->nullable()->change();
            $table->tinyInteger('payment')->nullable()->change();
        });
    }
};
