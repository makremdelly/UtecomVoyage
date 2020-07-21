<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagesHasReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages_has_reservations', function (Blueprint $table) {
            $table->integer('voyage_id')->index('fk_voyages_has_reservations2_idx');
			$table->integer('reservation_id')->index('fk_voyages_has_reservations_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voyages_has_reservations');
    }
}
