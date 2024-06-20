<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('units', function (Blueprint $table) {
            if(!Schema::hasColumn('units', 'column')){
                $table->string('featuered')->default(0);
                $table->string('published')->default(1);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            if(Schema::hasColumn('units', 'published')){
                $table->dropColumn('published');
            }
            if(Schema::hasColumn('units', 'featuered')){
                $table->dropColumn('featuered');
            }
        });
    }
};
