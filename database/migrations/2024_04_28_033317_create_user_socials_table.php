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
        /*
        Schema::create('user_socials', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsined();
            $table->string('social_network');
            $table->string('social_id');
            $table->string('social_email');
            $table->string('social_avatar');

            $table->timestamps();

            $table->foreign('user_id')->reference('id')->on('app_users');
            $table->foreign('social_email')->reference('email')->on('app_users');
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        Schema::table('user_socials', function (Blueprint $table){
            $table->dropForeign('user_socials_user_id_foreign');
            $table->dropForeign('user_socials_social_email_foreign');
        });

        Schema::dropIfExists('user_socials');
        */
    }
};
