<?php

use App\Stock;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denominations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("network_id")->unsigned()->index();
            $table->smallInteger("weight")->unsigned();
            $table->integer("before_quantity");
            $table->integer("new_quantity")->unsigned();
            $table->integer("after_quantity");   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('denominations');
    }
}
