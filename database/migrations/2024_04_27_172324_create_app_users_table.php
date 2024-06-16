<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_users', function(Blueprint $table) {
            $table->increments('id');

			//people data
			$table->char('cpf', 11)->unique()->nullalbe();
			$table->string('name', 50);
			$table->char('phone', 11);
			$table->date('birth')->nullalbe();
			$table->char('gender', 1)->nullalbe();
			$table->text('notes')->nullalbe();

			//auth data
			$table->string('email', 80)->unique();
			$table->string('password', 254)->default('gfeed2024');
			
			//Permission
			$table->string('status')->default('active');
			$table->string('permission')->default('app.user');

			$table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {

		});
		Schema::drop('users');
	}
};
