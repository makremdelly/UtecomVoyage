<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginKeysToReservationsHasRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations_has_rooms', function (Blueprint $table) {

            $table->foreign('reservation_id', 'fk_owners_has_reservations_reservations2')->references('id')->on('reservations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('room_id', 'fk_rooms_has_reservations_room2')->references('id')->on('rooms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations_has_rooms', function (Blueprint $table) {
            $table->dropForeign('fk_owners_has_reservations_reservations2');
			$table->dropForeign('fk_rooms_has_reservations_room2');
        });
    }
}
