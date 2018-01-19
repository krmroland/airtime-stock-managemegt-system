<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->increments('saving_id');
            $table->integer("fielder_id")->unsigned()->index();
            $table->smallInteger("month")->unsigned();
            $table->smallInteger("year")->unsigned();
            $table->integer("ammount")->unsigned();
            $table->text("processed_ids");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('savings');
    }
}
