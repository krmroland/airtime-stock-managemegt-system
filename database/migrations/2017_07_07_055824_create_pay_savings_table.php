<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaySavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_savings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("saving_id")->unsigned()->index();
            $table->integer("fielder_id")->unsigned()->index();
            $table->timestamp("date")->nullable();
            $table->text("paid_ids");
            $table->integer("ammount")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_savings');
    }
}
