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
        if (Schema::hasTable('nearby_place_unit')) {
            Schema::create('nearby_place_unit', function (Blueprint $table) {
                $table->foreignId('nearby_place_id')->references('id')->on('nearby_places')->onDelete('cascade');
                $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nearby_place_unit');
    }
};
