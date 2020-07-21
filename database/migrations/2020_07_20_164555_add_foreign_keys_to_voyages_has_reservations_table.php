<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToVoyagesHasReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voyages_has_reservations', function (Blueprint $table) {
            $table->foreign('voyage_id', 'fk_voyages_has_reservations_voyage2')->references('id')->on('voyages');
            $table->foreign('reservation_id', 'fk_owners_has_reservations_reservations3')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voyages_has_reservations', function (Blueprint $table) {
            $table->dropForeign('fk_voyages_has_reservations_voyage2');
			$table->dropForeign('fk_owners_has_reservations_reservations3');        });
    }
}
