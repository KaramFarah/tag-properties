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
        Schema::table('units', function (Blueprint $table) {
            if(!Schema::hasColumn('units', 'property_purpose')){
                $table->tinyInteger('property_purpose')->nullable();
            }
            if(!Schema::hasColumn('units', 'city')){
                $table->string('city')->nullable();
            }
            if(!Schema::hasColumn('units', 'country')){
                $table->string('country');
            }
            if(!Schema::hasColumn('units', 'address')){
                $table->string('address', 255)->nullable();
            }
            if(!Schema::hasColumn('units', 'location')){
                $table->string('location')->nullable();
            }
            if(!Schema::hasColumn('units', 'permit_no')){
                $table->string('permit_no')->nullable();
            }
            if(!Schema::hasColumn('units', 'property_ownership')){
                $table->tinyInteger('property_ownership')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            if(Schema::hasColumn('units', 'property_purpose')){
                Schema::dropColumns('units', ['property_purpose']);
            }
            if(Schema::hasColumn('units', 'city')){
                Schema::dropColumns('units', ['city']);
            }
            if(Schema::hasColumn('units', 'country')){
                Schema::dropColumns('units', ['country']);
            }
            if(Schema::hasColumn('units', 'address')){
                Schema::dropColumns('units', ['address']);
            }
            if(Schema::hasColumn('units', 'location')){
                Schema::dropColumns('units', ['location']);
            }
            if(Schema::hasColumn('units', 'permit_no')){
                Schema::dropColumns('units', ['permit_no']);
            }
            if(Schema::hasColumn('units', 'property_ownership')){
                Schema::dropColumns('units', ['property_ownership']);
            }
        });
    }
};
