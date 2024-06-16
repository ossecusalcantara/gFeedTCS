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
            $table->unsignedInteger('feedback_id')->nullable();

			$table->foreign('feedback_id')
                ->references('id')
                ->on('feedbacks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_profiles', function (Blueprint $table) {
            //
        });
    }
};
