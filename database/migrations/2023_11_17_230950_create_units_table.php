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
        if (!Schema::hasTable('units')) {
            Schema::create('units', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('location')->nullable();
                $table->string('description')->nullable();
                $table->integer('price')->nullable();
                $table->tinyInteger('property_type')->nullable(); //enum
                $table->tinyInteger('property_status')->nullable(); //enum
                $table->integer('area_sqft')->nullable();
                $table->string('bedrooms')->nullable();
                $table->string('bathrooms')->nullable();
                $table->string('property_id')->nullable();
                $table->integer('land_size')->nullable();
                $table->boolean('garage')->nullable();
                $table->integer('garage_size')->nullable();
                $table->integer('age_year')->nullable();
                $table->string('yt_video_url')->nullable();
                $table->boolean('availability')->nullable(); //enum
                $table->foreignId('installment_id')->nullable()->constrained()->onDelete('cascade');
                $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
