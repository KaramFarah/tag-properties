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
        if (Schema::hasTable('contacts')) {
            if (!Schema::hasColumn('contacts', 'agent_id')){
                Schema::table('contacts', function (Blueprint $table) {
                    $table->foreignId('agent_id')->nullable()->change();
                });
                
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            Schema::dropColumns('contacts', 'agent_id');
        });
    }
};
