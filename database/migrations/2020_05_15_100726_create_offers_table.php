<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->integer('hotel_id')->index('k_offers_hotel_idx')->nullable();
            $table->integer('room_id')->index('fk_offers_room_idx')->nullable();
            $table->integer('voyage_id')->index('fk_offers_voyage_idx')->nullable();
            $table->dateTime('date_debut')->nullable();
			$table->dateTime('date_fin')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
