<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('pengujians', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('identitaskendaraan_id');
        //     $table->string('huv_nomordankondisirangka', 1)->default('0');
        //     $table->string('huv_nomordantipemotorpenggerak', 1)->default('0');
        //     $table->string('huv_kondisitangkicorongdanpipabahanbakar', 1)->default('0');
        //     $table->string('huv_kondisiconverterkit', 1)->default('0');
        //     $table->string('huv_kondisidanposisipipapembuangan', 1)->default('0');
        //     $table->string('huv_ukurandankondisiban', 1)->default('0');
        //     $table->string('huv_kondisisistemsuspensi', 1)->default('0');
        //     $table->string('huv_kondisisistemremutama', 1)->default('0');
        //     $table->string('huv_kondisipenutuplampudanalatpantulcahaya', 1)->default('0');
        //     $table->string('huv_kondisipanelinstrumentdashboard', 1)->default('0');
        //     $table->string('huv_kondisikacaspion', 1)->default('0');
        //     $table->string('huv_kondisispakbor', 1)->default('0');
        //     $table->string('huv_bentukbumper', 1)->default('0');
        //     $table->string('huv_keberadaandankondisiperlengkapan', 1)->default('0');
        //     $table->string('huv_rancanganteknis', 1)->default('0');
        //     $table->string('huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus', 1)->default('0');
        //     $table->string('huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup', 1)->default('0');
        //     $table->string('hum_kondisipenerusdaya', 1)->default('0');
        //     $table->string('hum_sudutbebaskemudi', 1)->default('0');
        //     $table->string('hum_kondisiremparkir', 1)->default('0');
        //     $table->string('hum_fungsilampudanalatpantulcahaya', 1)->default('0');
        //     $table->string('hum_fungsipenghapuskaca', 1)->default('0');
        //     $table->string('hum_tingkatkegelapankaca', 1)->default('0');
        //     $table->string('hum_fungsiklakson', 1)->default('0');
        //     $table->string('hum_kondisidanfungsisabukkeselamatan', 1)->default('0');
        //     $table->string('hum_ukurankendaraan', 1)->default('0');
        //     $table->string('hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus', 1)->default('0');
        //     $table->string('alatuji_emisiasapbahanbakarsolar')->nullable();
        //     $table->string('alatuji_emisicobahanbakarbensin')->nullable();
        //     $table->string('alatuji_emisihcbahanbakarbensin')->nullable();
        //     $table->string('alatuji_remutamatotalgayapengereman')->nullable();
        //     $table->string('alatuji_remutamaselisihgayapengeremanrodakirikanan1')->nullable();
        //     $table->string('alatuji_remutamaselisihgayapengeremanrodakirikanan2')->nullable();
        //     $table->string('alatuji_remutamaselisihgayapengeremanrodakirikanan3')->nullable();
        //     $table->string('alatuji_remutamaselisihgayapengeremanrodakirikanan4')->nullable();
        //     $table->string('alatuji_remparkirtangan')->nullable();
        //     $table->string('alatuji_remparkirkaki')->nullable();
        //     $table->string('alatuji_kincuprodadepan')->nullable();
        //     $table->string('alatuji_tingkatkebisingan')->nullable();
        //     $table->string('alatuji_lampuutamakekuatanpancarlampukanan')->nullable();
        //     $table->string('alatuji_lampuutamakekuatanpancarlampukiri')->nullable();
        //     $table->string('alatuji_lampuutamapenyimpanganlampukanan')->nullable();
        //     $table->string('alatuji_lampuutamapenyimpanganlampukiri')->nullable();
        //     $table->string('alatuji_penunjukkecepatan')->nullable();
        //     $table->string('alatuji_kedalamanalurban')->nullable();
        //     $table->string('masaberlakuuji', 1)->nullable();
        //     $table->string('tgluji', 8);
        //     $table->tinyInteger('statuslulusuji')->default('0');
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
        Schema::dropIfExists('pengujians');
    }
}
