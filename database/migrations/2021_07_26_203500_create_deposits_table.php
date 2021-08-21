<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('coin');
            $table->string('usn');
            $table->string('investment_type');
            $table->float('gain');
            $table->integer('invoice');
            $table->float('amount');
            $table->string('currency');
            $table->string('account_name');
            $table->text('account_number');
            $table->string('receipt');
            $table->string('bank');
            $table->boolean('paid')->default(0);
            $table->datetime('date_for_payment');
            $table->boolean('on_apr')->default(0);
            $table->string('url');
            $table->string('ipn');
            $table->boolean('status')->default(0);

            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('deposits');
        
    }
}
