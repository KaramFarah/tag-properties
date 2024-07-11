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
        Schema::table('contacts', function (Blueprint $table) {
            if(Schema::hasColumn('contacts', 'birthdate')){
                Schema::dropColumns('contacts' , 'birthdate'); 
                $table->date('birthday')->nullable();
            }
            if(Schema::hasColumn('contacts', 'phone2')){
                Schema::dropColumns('contacts' , 'phone2');
                $table->integer('landline')->nullable();
            }
            if(Schema::hasColumn('contacts', 'whatsapp')){
                $table->string('whatsapp')->nullable()->change();
            }
            if(Schema::hasColumn('contacts', 'area')){
               Schema::dropColumns('contacts' , 'area');
            }
            if(Schema::hasColumn('contacts', 'street')){
                Schema::dropColumns('contacts' , 'street');
            }
            if(Schema::hasColumn('contacts', 'designation')){
                Schema::dropColumns('contacts' , 'designation');
                $table->string('occupation', 255)->nullable();
            }
            if(Schema::hasColumn('contacts', 'gender')){
                Schema::dropColumns('contacts' , 'gender');
            }
            if(!Schema::hasColumn('contacts', 'agent_id')){
                $table->foreignId('agent_id')->references('id')->on('agents')->onDelete('cascade')->nullable();
            }
            if(!Schema::hasColumn('contacts', 'campaign_id')){
                $table->foreignId('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');//lead
            }
            if(!Schema::hasColumn('contacts', 'preferred_languages')){
                $table->string('preferred_languages')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'deleted_at')){
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if(Schema::hasColumn('contacts', 'birthday')){
                Schema::dropColumns('contacts' , 'birthday'); 
                $table->date('birthdate')->nullable();
            }
            if(Schema::hasColumn('contacts', 'landline')){
                Schema::dropColumns('contacts' , 'landline');
                $table->integer('phone2')->nullable();
            }
            if(Schema::hasColumn('contacts', 'whatsapp')){
                $table->integer('whatsapp')->nullable()->change();
            }
            if(!Schema::hasColumn('contacts', 'area')){
               $table->string('area' ,255)->nullable();
            }
            if(!Schema::hasColumn('contacts', 'street')){
                $table->string('street' ,255)->nullable();
            }
            if(Schema::hasColumn('contacts', 'occupation')){
                Schema::dropColumns('contacts' , 'occupation');
                $table->string('designation', 255)->nullable();
            }
            if(!Schema::hasColumn('contacts', 'gender')){
                $table->string('gender' , 255)->nullable();
            }
            if(Schema::hasColumn('contacts', 'agent_id')){
                Schema::dropCloumns('contacts' , 'agent_id');                
            }
            if(Schema::hasColumn('contacts', 'campaign_id')){
                Schema::dropCloumns('contacts' , 'campaign_id');                
            }
            if(Schema::hasColumn('contacts', 'preferred_languages')){
                Schema::dropCloumns('contacts' , 'preferred_languages');
            }
            if(Schema::hasColumn('contacts', 'deleted_at')){
                Schema::dropCloumns('contacts' , 'deleted_at');
            }
        });
    }
};
