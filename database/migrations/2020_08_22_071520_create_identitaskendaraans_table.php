<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitaskendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('identitaskendaraans', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('nouji', 150)->unique();
        //     $table->string('nama');
        //     $table->string('alamat');
        //     $table->string('kecamatan')->nullable();
        //     $table->string('nohp')->nullable();
        //     $table->string('noseri')->nullable();
        //     $table->string('noidentitaspemilik')->nullable();
        //     $table->string('noregistrasikendaraan');
        //     $table->string('norangka');
        //     $table->string('nomesin');
        //     $table->string('thpembuatan');
        //     $table->string('bahanbakar');
        //     $table->string('isisilinder')->default('0');
        //     $table->string('jbb')->default('0');
        //     $table->string('jenis');
        //     $table->string('peruntukan');
        //     $table->string('idkepaladinas');
        //     $table->string('iddirektur');
        //     $table->string('kodewilayah');
        //     $table->string('kodewilayahasal');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identitaskendaraans');
    }
}
