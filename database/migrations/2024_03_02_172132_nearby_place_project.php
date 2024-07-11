<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('nearby_place_project')) {
            Schema::create('nearby_place_project', function (Blueprint $table) {
                $table->foreignId('nearby_place_id')->references('id')->on('nearby_places')->onDelete('cascade');
                $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nearby_place_project', function (Blueprint $table) {

            if(Schema::hasColumn('nearby_place_project', 'nearby_place_id')){
                $table->dropForeign('nearby_place_project_floor_id_foreign');
                $table->dropColumn('nearby_place_id');
            }
            if(Schema::hasColumn('nearby_place_project', 'project_id')){
                $table->dropForeign('nearby_place_project_project_id_foreign');
                $table->dropColumn('project_id');
            }
            Schema::dropIfExists('nearby_place_project');
        });
    }
};
