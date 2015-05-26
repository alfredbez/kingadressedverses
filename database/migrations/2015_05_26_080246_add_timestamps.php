<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('songs', function(Blueprint $table)
		{
			$table->timestamps();
		});
		Schema::table('categories', function(Blueprint $table)
		{
			$table->timestamps();
		});
		Schema::table('composers', function(Blueprint $table)
		{
			$table->timestamps();
		});
		Schema::table('files', function(Blueprint $table)
		{
			$table->timestamps();
		});
		Schema::table('orchestrations', function(Blueprint $table)
		{
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
		//
	}

}
