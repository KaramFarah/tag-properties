<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('city_contact', function (Blueprint $table) {
            $table->foreignId('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreignId('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('city_contact', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropForeign(['city_id']);
        });
    
        Schema::dropIfExists('city_contact');
    }
};
