<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutocarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autocars', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->integer('id',true);
            $table->string('type')->nullable();
            $table->string('NbPlace')->nullable();
            $table->string('Matricule')->nullable();
            $table->string('status')->nullable();
            // $table->integer('voyage_id')->index('fk_autocars_voyages_idx')->nullable();
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
        Schema::dropIfExists('autocars');
    }
}
