<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservations', function(Blueprint $table)
		{
			$table->integer('id', true);
			// $table->string('user_name');
			// $table->string('user_email', 45);
			// $table->string('phone');
			$table->integer('user_id')->index('fk_reservations_user_idx');
			$table->integer('hotel_id')->index('fk_reservations_hotel_idx');
			$table->integer('payment_id')->index('fk_reservations_payment_idx');
			$table->float('amount_a_payer');
			$table->dateTime('arrival_date');
			$table->dateTime('departure_date');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reservations');
	}

}
