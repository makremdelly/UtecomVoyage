<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('room_id', 'fk_offers_rooms')->references('id')->on('rooms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('voyage_id', 'fk_offers_voyages')->references('id')->on('voyages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('hotel_id', 'fk_offers_hotels')->references('id')->on('hotels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('fk_offers_rooms');
            $table->dropForeign('fk_offers_voyages'); 
            $table->dropForeign('fk_offers_hotels');
        });
    }
}
