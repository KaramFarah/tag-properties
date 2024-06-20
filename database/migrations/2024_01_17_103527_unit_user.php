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
        if (!Schema::hasTable('unit_user')) {
            Schema::create('unit_user', function (Blueprint $table) {
                $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit_user', function (Blueprint $table) {
            // $table->dropForeign(['user_id']);
            // $table->dropForeign(['unit_id']);
            // if(Schema::hasColumn('unit_user', 'unit_id')){
            //     $table->dropForeign('unit_user_unit_id_foreign');
            // }
            Schema::dropIfExists('unit_user');
        });
    }
};
