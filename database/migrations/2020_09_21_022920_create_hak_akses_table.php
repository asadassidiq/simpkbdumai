<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHakAksesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('hak_akses', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('user_id');
        //     $table->unsignedInteger('setHalaman_id');
        //     $table->integer('view');
        //     $table->integer('add');
        //     $table->integer('edit');
        //     $table->integer('delete');
        //     $table->timestamps();

        //     $table->foreign('user_id')->references('id')->on('users');
        //     $table->foreign('setHalaman_id')->references('id')->on('set_Halamen');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hak_akses');
    }
}
