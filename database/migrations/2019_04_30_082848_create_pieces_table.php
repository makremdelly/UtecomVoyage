<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePiecesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pieces', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->decimal('surface', 10, 0);
			$table->integer('room_id')->index('fk_pieces_room_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pieces');
	}

}
