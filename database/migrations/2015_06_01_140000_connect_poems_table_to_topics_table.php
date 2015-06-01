<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectPoemsTableToTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('poems', function(Blueprint $table)
		{
			$table->integer('topic_id')->unsigned();
			$table->foreign('topic_id')->references('id')->on('topics');
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
