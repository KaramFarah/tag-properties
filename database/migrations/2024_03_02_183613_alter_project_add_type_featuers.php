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
        Schema::table('projects' , function($table){
            $table->text('project_features')->nullable();
            $table->text('project_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects' , function($table){
            $table->dropColumn('project_features');
            $table->dropColumn('project_type');
        });
    }
};
