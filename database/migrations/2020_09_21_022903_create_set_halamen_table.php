<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetHalamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //     Schema::create('set_halamen', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->string('halaman');
    //         $table->integer('urutan');
    //         $table->timestamps();
    //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_halamen');
    }
}
