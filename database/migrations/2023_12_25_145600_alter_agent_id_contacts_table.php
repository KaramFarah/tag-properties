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
            if(Schema::hasColumn('contacts', 'agent_id')){
                $table->dropForeign('contacts_agent_id_foreign');
                $table->dropColumn('agent_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if(Schema::hasColumn('contacts', 'agent_id')){
                $table->integer('agent_id')->change();
                $table->foreignId('agent_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }
};
