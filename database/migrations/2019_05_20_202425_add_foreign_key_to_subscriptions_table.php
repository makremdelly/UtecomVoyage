<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
			$table->foreign('hotel_id', 'fk_subscriptions_hotels')->references('id')->on('hotels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'fk_subscriptions_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            // $table->foreign('history_id', 'fk_subscriptions_histories')->references('id')->on('histories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign('fk_subscriptions_hotels');
            $table->dropForeign('fk_subscriptions_users');
            // $table->dropForeign('fk_subscriptions_histories');
        });
    }
}
