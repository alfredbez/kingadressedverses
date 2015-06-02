<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('author');
			$table->string('email');
			$table->text('comment');
			$table->integer('song_id')->unsigned()->nullable();
			$table->foreign('song_id')->references('id')->on('songs');
			$table->integer('poem_id')->unsigned()->nullable();
			$table->foreign('poem_id')->references('id')->on('poems');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
