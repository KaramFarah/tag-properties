<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if(!Schema::hasColumn('contacts', 'occupation')){
                $table->string('occupation' , 255)->nullable();
            }
            if(!Schema::hasColumn('contacts', 'birthday')){
                $table->date('birthday')->nullable();
            }
            if(!Schema::hasColumn('contacts', 'landline')){
                $table->string('landline' , 255)->nullable();
            }
            if(!Schema::hasColumn('contacts', 'client_type')){
                $table->string('client_type')->nullable();
            }
            if(!Schema::hasColumn('contacts', 'looking_for')){
                $table->string('looking_for')->nullable();
            }
            if(!Schema::hasColumn('contacts', 'resident')){
                $table->string('resident')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('contacts' , function(Blueprint $table){
            if (Schema::hasColumn('contacts', 'occupation')) {
                $table->dropColumn('occupation');
            }
            if (Schema::hasColumn('contacts', 'birthday')) {
                $table->dropColumn('birthday');
            }
            if (Schema::hasColumn('contacts', 'landline')) {
                $table->dropColumn('landline');
            }
            if (Schema::hasColumn('contacts', 'client_type')) {
                $table->dropColumn('client_type');
            }
            if (Schema::hasColumn('contacts', 'looking_for')) {
                $table->dropColumn('looking_for');
            }
            if (Schema::hasColumn('contacts', 'resident')) {
                $table->dropColumn('resident');
            }
        });
    }
};
