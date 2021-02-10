<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('transaksis', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('pendaftaran_id');
        //     $table->integer('blndenda');
        //     $table->integer('retribusi');
        //     $table->integer('platuji');
        //     $table->integer('bukuuji');
        //     $table->integer('regkend');
        //     $table->integer('stiker');
        //     $table->integer('status');
        //     $table->timestamps();

        //     $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
