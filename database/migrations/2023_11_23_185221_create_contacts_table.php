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
        if (!Schema::hasTable('contacts')) {
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                $table->string('name', 150); //lead
                $table->date('birthday')->nullable();
                $table->string('email', 150)->unique()->nullable();//lead
                $table->string('title', 10)->nullable();
                $table->integer('landline')->nullable();
                $table->integer('mobile')->nullable();//lead
                $table->string('address', 255)->nullable();
                $table->string('country', 150)->nullable();//lead
                $table->string('city', 150)->nullable();//lead
                $table->string('occupation', 255)->nullable();
                $table->string('company', 255)->nullable();
                $table->string('passport')->nullable();
                $table->date('passport_expiry')->nullable();
                $table->string('passport_photocopy')->nullable();
                $table->enum('financing', ['cash', 'mortgage', 'low'])->nullable();
                $table->string('source', 255)->nullable();//lead delete
                $table->string('interests', 255)->nullable();//lead
                $table->enum('is_lead', ['yes', 'no'])->nullable();//lead
                $table->enum('preferred_languages', ['Arabic', 'English' , 'Chinese' ,'Turkish' , 'Urdo' , 'Farsi' , 'Russian' , 'Frensh'])->nullable();//lead
                $table->string('rooms')->nullable();
                $table->string('budget')->nullable();
                $table->string('expected_purchase_time')->nullable();
                $table->enum('lead_quality', ['good', 'follow', 'unqualified'])->nullable();//lead
                $table->enum('priority', ['high', 'medium', 'low'])->nullable();//lead
                $table->foreignId('agent_id')->references('id')->on('agents')->onDelete('cascade');
                $table->foreignId('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');//lead
                $table->timestamps();
                $table->softDeletes();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
