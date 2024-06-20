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
        if (!Schema::hasColumn('agents', 'deleted_at')){
            Schema::table('agents', function (Blueprint $table) {
                $table->softDeletes();
            }); 
        }
        if (!Schema::hasColumn('calls', 'deleted_at')){
            Schema::table('calls', function (Blueprint $table) {
                $table->softDeletes();
            }); 
        }
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
