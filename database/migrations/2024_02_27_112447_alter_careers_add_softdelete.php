<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('careers', function($table)
        {
            if(!Schema::hasColumn('careers', 'deleted_at')){
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('careers', function($table)
        {
            if(Schema::hasColumn('careers', 'deleted_at')){
                $table->dropColumn('deleted_at');
            }
        });
    }
};
