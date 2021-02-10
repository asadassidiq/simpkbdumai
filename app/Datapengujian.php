<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datapengujian extends Model
{
    protected $table= 'datapengujian';
    protected $primaryKey = 'idx';
    protected $fillable = ['idx','statuspenerbitan','nouji','nama','alamat','noidentitaspemilik','noregistrasikendaraan','norangka','merek','tipe','nomesin','jbb','dayamotorpenggerak','thpembuatan','bahanbakar','jenis','isisilinder','idkepaladinas','iddirektur','kodewilayah','kodewilayahasal','jbi','nosertifikatreg','tglsertifikatreg','jbkb','jbki','mst','beratkosong','konfigurasisumburoda','ukuranban','panjangkendaraan','lebarkendaraan','tinggikendaraan','panjangbakatautangki','lebarbakatautangki','tinggibakatautangki','julurdepan','julurbelakang','jaraksumbu1_2','jaraksumbu2_3','jaraksumbu3_4','dayaangkutorang','dayaangkutbarang','kelasjalanterendah','idpetugasuji','huv_nomordankondisirangka','huv_nomordantipemotorpenggerak','huv_kondisitangkicorongdanpipabahanbakar','huv_kondisiconverterkit','huv_kondisidanposisipipapembuangan','huv_ukurandankondisiban','huv_kondisisistemsuspensi','huv_kondisisistemremutama','huv_kondisipenutuplampudanalatpantulcahaya','huv_kondisipanelinstrumentdashboard','huv_kondisikacaspion','huv_kondisispakbor','huv_bentukbumper','huv_keberadaandankondisiperlengkapan','huv_rancanganteknis','huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus','huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup','hum_kondisipenerusdaya','hum_sudutbebaskemudi','hum_kondisiremparkir','hum_fungsilampudanalatpantulcahaya','hum_fungsipenghapuskaca','hum_tingkatkegelapankaca','hum_fungsiklakson','hum_kondisidanfungsisabukkeselamatan','hum_ukurankendaraan','hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus','alatuji_emisiasapbahanbakarsolar','alatuji_emisicobahanbakarbensin','alatuji_emisihcbahanbakarbensin','alatuji_remutamatotalgayapengereman','alatuji_remutamaselisihgayapengeremanrodakirikanan1','alatuji_remutamaselisihgayapengeremanrodakirikanan2','alatuji_remutamaselisihgayapengeremanrodakirikanan3','alatuji_remutamaselisihgayapengeremanrodakirikanan4','alatuji_remparkirtangan','alatuji_remparkirkaki','alatuji_kincuprodadepan','alatuji_tingkatkebisingan','alatuji_lampuutamakekuatanpancarlampukanan','alatuji_lampuutamakekuatanpancarlampukiri','alatuji_lampuutamapenyimpanganlampukanan','alatuji_lampuutamapenyimpanganlampukiri','alatuji_penunjukkecepatan','alatuji_kedalamanalurban','tgluji','masaberlakuuji', 'statuslulusuji'];
    protected $pKeyType = 'bigint';
    public $timestamps = false;
}
