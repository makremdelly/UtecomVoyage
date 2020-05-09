<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersHasHotelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_has_hotels', function(Blueprint $table)
		{
			$table->foreign('hotel_id', 'fk_owners_has_hotels_hotels2')->references('id')->on('hotels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_users_has_hotels_owners2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_has_hotels', function(Blueprint $table)
		{
			$table->dropForeign('fk_owners_has_hotels_hotels2');
			$table->dropForeign('fk_users_has_hotels_owners2');
		});
	}

}
