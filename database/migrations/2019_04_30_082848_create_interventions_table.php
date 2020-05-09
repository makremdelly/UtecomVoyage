<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterventionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interventions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 45);
			$table->string('priority', 45);
			$table->boolean('state');
			$table->date('start_time');
			$table->integer('hotel_id')->index('fk_interventions_hotel_idx');
			$table->integer('room_id')->index('fk_interventions_room_idx');
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
		Schema::drop('interventions');
	}

}
