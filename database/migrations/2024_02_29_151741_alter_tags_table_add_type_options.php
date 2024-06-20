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
        Schema::table('tags' , function($table){
            $table->string('value_type')->nullable();
            $table->string('value_options')->nullable();
        });
        Schema::table('unit_tag' , function($table){
            $table->renameColumn('value', 'tag_value');
        });
    }

    public function down(): void
    {
        Schema::table('tags' , function($table){
            $table->dropColumn('value_type');
            $table->dropColumn('value_options');
        });
        Schema::table('unit_tag' , function($table){
            $table->renameColumn('tag_value', 'value');
        });
    }
};
