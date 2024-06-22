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
             
            if (Schema::hasColumn('app_users', 'office_id')) {
                $table->dropForeign(['office_id']);
            }
            $table->unsignedInteger('office_id')->nullable()->change();
                
            $table->foreign('office_id')
                ->references('id')
                ->on('offices')
                ->onDelete('set null');

            if (Schema::hasColumn('app_users', 'departament_id')) {
                $table->dropForeign(['departament_id']);
            }

            $table->unsignedInteger('departament_id')->nullable()->change();
            
            
            $table->foreign('departament_id')
                    ->references('id')
                    ->on('departaments')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_users', function (Blueprint $table) {
           
            if (Schema::hasColumn('app_users', 'office_id')) {
                $table->dropForeign(['office_id']);
            }
        
            $table->unsignedInteger('office_id')->nullable(false)->change();
            
            $table->foreign('office_id')
                  ->references('id')
                  ->on('offices');

            if (Schema::hasColumn('app_users', 'departament_id')) {
                $table->dropForeign(['departament_id']);
            }

            $table->unsignedInteger('departament_id')->nullable(false)->change();
            
            $table->foreign('departament_id')
                ->references('id')
                ->on('departaments');
        });
    }
};
