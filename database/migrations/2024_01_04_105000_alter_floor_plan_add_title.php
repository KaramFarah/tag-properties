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
        Schema::table('floors', function (Blueprint $table) {
            if(!Schema::hasColumn('floors', 'title')){
                $table->string('title' , 255)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('floors' , function(Blueprint $table){
            if (Schema::hasColumn('floors', 'title')) {
                $table->dropColumn('title');
            }
        });
    }
};
