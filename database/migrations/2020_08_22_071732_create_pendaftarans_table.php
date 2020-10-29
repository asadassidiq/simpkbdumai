<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('pendaftarans', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('identitaskendaraan_id');
        //     $table->date('tglpendaftaran');
        //     $table->unsignedInteger('kodepenerbitans_id');
        //     $table->integer('noantrian')->nullable();
        //     $table->enum('jenis', ['ots','booking'])->default('ots');
        //     $table->enum('verif', ['y','n']);
        //     $table->integer('pos1')->nullable();
        //     $table->integer('pos2')->nullable();
        //     $table->integer('pos3')->nullable();
        //     $table->integer('petugaspos1')->nullable();
        //     $table->integer('petugaspos2')->nullable();
        //     $table->integer('petugaspos3')->nullable();
        //     $table->string('catatanpos1')->nullable();
        //     $table->string('catatanpos2')->nullable();
        //     $table->string('catatanpos3')->nullable();
        //     $table->timestamps();
            
        //     $table->foreign('identitaskendaraan_id')->references('id')->on('identitaskendaraans');
        //     $table->foreign('kodepenerbitans_id')->references('id')->on('kodepenerbitans');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
}
