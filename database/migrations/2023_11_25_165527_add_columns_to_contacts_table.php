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
            if (!Schema::hasColumn('contacts', 'whatsapp')){
                Schema::table('contacts', function (Blueprint $table) {
                    $table->string('whatsapp')->nullable();
                }); 
            }
            if (Schema::hasColumn('contacts', 'source')){
                Schema::dropColumns('contacts' , 'source'); 
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('contacts')) {
            if (Schema::hasColumn('contacts', 'whatsapp')){
                Schema::dropColumns('contacts', 'whatsapp');
            }
        }
    }
};
