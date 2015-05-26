<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectSongsTableToOrchestrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('songs', function(Blueprint $table)
		{
			$table->integer('orchestration_id')->unsigned();
			$table->foreign('orchestration_id')->references('id')->on('orchestrations');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('songs', function(Blueprint $table)
		{
			//
		});
	}

}
