<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFielderTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fielder_transactions', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer("transaction_id")->unsigned()->index();
            $table->integer("fielder_id")->index()->unsigned();
            $table->bigInteger("before");
            $table->bigInteger("after");
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fielder_transactions');
    }
}
