<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersHasHotelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_has_hotels', function(Blueprint $table)
		{
			$table->integer('user_id')->index('fk_users_has_hotels_users2_idx');
			$table->integer('hotel_id')->index('fk_users_has_hotels_hotels2_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_has_hotels');
	}

}
