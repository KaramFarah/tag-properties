<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * default(DB::raw('CURRENT_TIMESTAMP'));
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'date')) {
                Schema::dropColumns('blogs' , 'date');
                }
            if (!Schema::hasColumn('blogs', 'publish_date')) {
                $table->date('publish_date')->nullable();
                }            
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'publish_date')) {
                Schema::dropColumns('blogs' , 'publish_date');
                }
            if (!Schema::hasColumn('blogs', 'date')) {
                $table->date('date')->nullable();
                }
            });
    }
};
