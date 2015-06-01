<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectFilesTableToPoemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('files', function(Blueprint $table)
		{
			$table->integer('poem_id')->nullable()->unsigned();
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
		Schema::table('files', function(Blueprint $table)
		{
			//
		});
	}

}
