<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('city_unit', function (Blueprint $table) {
            $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreignId('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('city_unit', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['city_id']);
        });
    
        Schema::dropIfExists('city_unit');
    }
};
