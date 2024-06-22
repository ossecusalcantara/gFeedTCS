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
        Schema::table('skill_profiles', function (Blueprint $table) {
            
            $table->dropForeign(['skill_id']);
            
            $table->foreign('skill_id')
                  ->references('id')
                  ->on('skills')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_profiles', function (Blueprint $table) {
           
            $table->dropForeign(['skill_id']);
            
           
            $table->foreign('skill_id')
                  ->references('id')
                  ->on('skills');
        });
    }
};
