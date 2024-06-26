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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('type' , ['call' , 'meeting' , 'email'])->nullable();
            $table->string('topic')->nullable();
            $table->enum('status' , ['done' , 'pending' , 'todo'])->nullable();            
            $table->text('summary')->nullable();
            $table->foreignId('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreignId('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
