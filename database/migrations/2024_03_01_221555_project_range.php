<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('project_range', function (Blueprint $table) {
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreignId('range_id')->references('id')->on('ranges')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('project_range', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['range_id']);
        });
    
        Schema::dropIfExists('project_range');
    }
};
