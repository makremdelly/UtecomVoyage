<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsHasRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations_has_rooms', function (Blueprint $table) {
            $table->integer('reservation_id')->index('fk_reservations_has_rooms_reservations2_idx');
			$table->integer('room_id')->index('fk_reservations_has_rooms_rooms2_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations_has_rooms');
    }
}
