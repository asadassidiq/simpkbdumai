<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('tipes', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('merek_id');
        //     $table->string('tipe');
        //     $table->foreign('merek_id')->references('id')->on('mereks');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipes');
    }
}
