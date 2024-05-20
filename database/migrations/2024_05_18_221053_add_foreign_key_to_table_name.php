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
        Schema::table('app_users', function (Blueprint $table) {
          
            $table->unsignedInteger('departament_id')->default(1);
            $table->foreign('departament_id')
                  ->references('id')
                  ->on('departaments'); 

            $table->unsignedInteger('office_id')->default(1);
            $table->foreign('office_id')
                ->references('id')
                ->on('offices'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_name', function (Blueprint $table) {
            //
        });
    }
};
