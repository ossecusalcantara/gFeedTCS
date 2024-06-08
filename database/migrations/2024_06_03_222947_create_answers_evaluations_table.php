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
		Schema::create('answers_evaluations', function(Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('question_id');
			$table->unsignedInteger('performance_evaluation_id');
			$table->text('notes');
			$table->integer('punctuation');

			$table->foreign('question_id')
                ->references('id')
                ->on('questions');
			
			$table->foreign('performance_evaluation_id')
                ->references('id')
                ->on('performance_evaluations');

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answers_evaluations');
	}
};
