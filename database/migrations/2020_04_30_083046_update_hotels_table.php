<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('country')->nullable();
            // $table->string('administrative')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('type')->nullable();
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
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('administrative');
            $table->dropColumn('city');
            $table->dropColumn('postcode');
            $table->dropColumn('type');
        });
    }
}
