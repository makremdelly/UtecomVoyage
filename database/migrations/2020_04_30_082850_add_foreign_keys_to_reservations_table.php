<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reservations', function(Blueprint $table)
		{
			// $table->foreign('hotel_id', 'fk_reservations_hotels1')->references('id')->on('hotels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('payment_id', 'fk_reservations_payments1')->references('id')->on('payments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_reservations_user')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reservations', function(Blueprint $table)
		{
			// $table->dropForeign('fk_reservations_hotels1');
			$table->dropForeign('fk_reservations_payments1');
			$table->dropForeign('fk_reservations_user');
		});
	}

}
