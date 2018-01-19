<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fielders', function (Blueprint $table) {
            $table->increments('fielder_id');
            $table->string("name");
            $table->string("phoneNumber");
            $table->text("loading");
            $table->text("saving");
            $table->bigInteger("balance")->default(0);
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
        Schema::dropIfExists('fielders');
    }
}
