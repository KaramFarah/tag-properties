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
        if (!Schema::hasTable('floor_unit')) {
            Schema::create('floor_unit', function (Blueprint $table) {
                $table->foreignId('floor_id')->references('id')->on('floors')->onDelete('cascade');
                $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('floor_unit', function (Blueprint $table) {
            Schema::dropIfExists('floor_unit');
        });

        /* if(Schema::hasColumn('floor_unit', 'floor_id')){
            $table->dropForeign('floor_unit_floor_id_foreign');
        }
        if(Schema::hasColumn('floor_unit', 'unit_id')){
            $table->dropForeign('floor_unit_unit_id_foreign');
        }

        $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
        $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade'); */
    }
};
