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
        Schema::table('performance_evaluations', function (Blueprint $table) {
            $table->text('notes')->nullable();
            $table->date('deadline')->nullable();
            $table->float('media')->nullable();
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('manager_id');
            $table->unsignedInteger('user_id');

            $table->foreign('admin_id')
                ->references('id')
                ->on('app_users');
            $table->foreign('manager_id')
                ->references('id')
                ->on('app_users');
            $table->foreign('user_id')
                ->references('id')
                ->on('app_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('performance_evaluations', function (Blueprint $table) {
            //
        });
    }
};
