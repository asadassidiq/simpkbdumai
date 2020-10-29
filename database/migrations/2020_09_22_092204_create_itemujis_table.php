<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemujisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemujis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->unsignedInteger('groupuji_id');
            $table->timestamps();

            $table->foreign('groupuji_id')->references('id')->on('groupujis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemujis');
    }
}
