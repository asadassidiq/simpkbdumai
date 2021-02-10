<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatakendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('datakendaraans', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('identitaskendaraan_id');
        //     $table->string('nosertifikatreg');
        //     $table->string('tglsertifikatreg');
        //     $table->string('merek');
        //     $table->string('tipe');
        //     $table->string('dayamotorpenggerak')->default('0');
        //     $table->string('jbkb')->default('0');
        //     $table->string('jbi')->default('0');
        //     $table->string('jbki')->default('0');
        //     $table->string('mst')->default('0');
        //     $table->string('beratkosong')->default('0');
        //     $table->string('konfigurasisumburoda');
        //     $table->string('ukuranban');
        //     $table->string('panjangkendaraan')->default('0');
        //     $table->string('lebarkendaraan')->default('0');
        //     $table->string('tinggikendaraan')->default('0');
        //     $table->string('panjangbakatautangki')->default('0');
        //     $table->string('lebarbakatautangki')->default('0');
        //     $table->string('tinggibakatautangki')->default('0');
        //     $table->string('julurdepan')->default('0');
        //     $table->string('julurbelakang')->default('0');
        //     $table->string('groundclearance')->default('0');
        //     $table->string('jaraksumbu1_2')->default('0');
        //     $table->string('jaraksumbu2_3')->default('0');
        //     $table->string('jaraksumbu3_4')->default('0');
        //     $table->string('q')->default('0');
        //     $table->string('p')->default('0');
        //     $table->string('beratsumbu1')->default('0');
        //     $table->string('beratsumbu2')->default('0');
        //     $table->string('beratsumbu3')->default('0');
        //     $table->string('beratsumbu4')->default('0');
        //     $table->string('dayaangkutorang')->default('0');
        //     $table->string('dayaangkutbarang')->default('0');
        //     $table->string('kelasjalanterendah');
        //     $table->timestamps();

        //     $table->foreign('identitaskendaraan_id')->references('id')->on('identitaskendaraans');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datakendaraans');
    }
}
