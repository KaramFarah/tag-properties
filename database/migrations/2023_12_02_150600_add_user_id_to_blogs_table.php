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
        if (Schema::hasTable('blogs')){
            Schema::table('blogs', function (Blueprint $table) {
                $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->date('date')->nullable();
    
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('blogs')){
            Schema::dropColumns('blogs' , 'user_id');
            Schema::dropColumns('blogs' , 'date');
        }
    }
};
