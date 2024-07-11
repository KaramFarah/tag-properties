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
        if (!Schema::hasTable('nearby_place_unit')) {
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
        Schema::table('nearby_place_unit', function (Blueprint $table) {

            if(Schema::hasColumn('nearby_place_unit', 'nearby_place_id')){
                $table->dropForeign('nearby_place_unit_floor_id_foreign');
                $table->dropColumn('nearby_place_id');
            }
            if(Schema::hasColumn('nearby_place_unit', 'unit_id')){
                $table->dropForeign('nearby_place_unit_unit_id_foreign');
                $table->dropColumn('unit_id');
            }
            Schema::dropIfExists('nearby_place_unit');
        });
    }
};
