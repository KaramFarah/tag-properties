<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function($table)
        {
            if(!Schema::hasColumn('projects', 'province')){
                $table->string('province')->nullable();
            }
            if(!Schema::hasColumn('projects', 'opening_date')){
                $table->string('opening_date')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function($table)
        {
            if(Schema::hasColumn('projects', 'province')){
                $table->dropColumn('province');
            }
            if(Schema::hasColumn('projects', 'opening_date')){
                $table->dropColumn('opening_date');
            }
        });
    }
};
