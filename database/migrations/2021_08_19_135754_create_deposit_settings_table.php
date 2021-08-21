<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('SWITCH_BTC');
            $table->integer('SWITCH_ETH');
            $table->string('COINPAYMENTS_DB_PREFIX');
            $table->string('COINPAYMENTS_MERCHANT_ID');
            $table->string('COINPAYMENTS_PUBLIC_KEY');
            $table->string('COINPAYMENTS_PRIVATE_KEY');
            $table->string('COINPAYMENTS_IPN_SECRET');
            $table->string('COINPAYMENTS_IPN_URL');
            $table->boolean('COINPAYMENTS_API_FORMAT');
            $table->boolean('COINPAYMENTS_IPN_ROUTE_ENABLED');
            $table->string('COINPAYMENTS_IPN_ROUTE_PATH');
            $table->integer('COINBASE_SWITCH');
            $table->string('COINBASE_API_KEY');
            $table->string('COINBASE_WEBHOOK_SECRETE');
            $table->integer('BCM_SWITCH');
            $table->string('Blockonomics_API');
            $table->string('BCM_SECRETE');
            $table->integer('BC_SWITCH');
            $table->string('BC_MY_XPUB');
            $table->string('BC_MY_API_KEY');
            $table->integer('BTC_SWITCH');
            $table->string('BTC_WALLET');
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
        Schema::dropIfExists('deposit_settings');
    }
}
