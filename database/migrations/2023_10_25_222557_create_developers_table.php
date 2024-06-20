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
        if (!Schema::hasTable('developers')) {
            Schema::create('developers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->string('logo_path')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // if (!Schema::hasTable('developers_media')) {
        //     Schema::create('developers_media', function (Blueprint $table) {
        //         $table->unsignedBigInteger('developer_id');
        //         $table->unsignedBigInteger('media_id');
        //         $table->foreign('developer_id')->on('developers')->onDelete('cascade');
        //         $table->foreign('media_id')->on('media')->onDelete('cascade');
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
