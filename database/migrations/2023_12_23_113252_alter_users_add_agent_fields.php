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
        Schema::table('users', function (Blueprint $table) {
            //$table->string('name');
            //$table->string('email')->nullable();
            //$table->string('password')->nullable();
            //$table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('emitaes_id')->nullable();
            $table->string('brn')->nullable();
            $table->string('languages')->nullable();           
            $table->string('employee_id_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users' , function (Blueprint $table){
            $table->dropColumn('employee_id_number');
            $table->dropColumn('languages');
            $table->dropColumn('brn');
            $table->dropColumn('emitaes_id');
            $table->dropColumn('phone');
        });
    }
};
