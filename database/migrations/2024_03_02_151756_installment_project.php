<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('installment_project', function (Blueprint $table) {
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreignId('installment_id')->references('id')->on('installments')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::table('installment_project', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['installment_id']);
        });
    
        Schema::dropIfExists('installment_project');
    }
};
