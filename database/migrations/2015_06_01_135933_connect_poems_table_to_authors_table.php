<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectPoemsTableToAuthorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('poems', function(Blueprint $table)
		{
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('authors');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('poems', function(Blueprint $table)
		{
			//
		});
	}

}
