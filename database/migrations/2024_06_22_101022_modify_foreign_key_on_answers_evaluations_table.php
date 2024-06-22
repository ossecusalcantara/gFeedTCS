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
        Schema::table('answers_evaluations', function (Blueprint $table) {
            
            $table->dropForeign(['question_id']);
            
            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers_evaluations', function (Blueprint $table) {
           
            $table->dropForeign(['question_id']);
            
           
            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions');
        });
    }
};
