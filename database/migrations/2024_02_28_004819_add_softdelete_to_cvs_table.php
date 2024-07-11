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
        Schema::table('cvs', function($table)
        {
            if(!Schema::hasColumn('cvs', 'deleted_at')){
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('cvs', function($table)
        {
            if(Schema::hasColumn('cvs', 'deleted_at')){
                $table->dropColumn('deleted_at');
            }
        });
    }
};
