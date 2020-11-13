<?php

namespace App\Http\Controllers;
use App\Identitaskendaraan;
use App\Pengujian;
use App\Pendaftaran;
use App\Datakendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PengujianController extends Controller
{
    
    public function store(Request $request)
    {
        $data = Pengujian::create([
            'pendaftaran_id'                 => $request->pendaftaran_id,
            'huv_nomordankondisirangka'                 => $request->huv_nomordankondisirangka,
            'huv_nomordantipemotorpenggerak'                 => $request->huv_nomordantipemotorpenggerak,
            'huv_kondisitangkicorongdanpipabahanbakar'                 => $request->huv_kondisitangkicorongdanpipabahanbakar,
            'huv_kondisiconverterkit'                 => $request->huv_kondisiconverterkit,
            'huv_kondisidanposisipipapembuangan'                 => $request->huv_kondisidanposisipipapembuangan,
            'huv_ukurandankondisiban'                 => $request->huv_ukurandankondisiban,
            'huv_kondisisistemsuspensi'                 => $request->huv_kondisisistemsuspensi,
            'huv_kondisisistemremutama'                 => $request->huv_kondisisistemremutama,
            'huv_kondisipenutuplampudanalatpantulcahaya'                 => $request->huv_kondisipenutuplampudanalatpantulcahaya,
            'huv_kondisipanelinstrumentdashboard'                 => $request->huv_kondisipanelinstrumentdashboard,
            'huv_kondisikacaspion'                 => $request->huv_kondisikacaspion,
            'huv_kondisispakbor'                 => $request->huv_kondisispakbor,
            'huv_bentukbumper'                 => $request->huv_bentukbumper,
            'huv_keberadaandankondisiperlengkapan'                 => $request->huv_keberadaandankondisiperlengkapan,
            'huv_rancanganteknis'                 => $request->huv_rancanganteknis,
            'huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus'                 => $request->huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus,
            'huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup'                 => $request->huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup,
            'hum_kondisipenerusdaya'                 => $request->hum_kondisipenerusdaya,
            'hum_sudutbebaskemudi'                 => $request->hum_sudutbebaskemudi,
            'hum_kondisiremparkir'                 => $request->hum_kondisiremparkir,
            'hum_fungsilampudanalatpantulcahaya'                 => $request->hum_fungsilampudanalatpantulcahaya,
            'hum_fungsipenghapuskaca'                 => $request->hum_fungsipenghapuskaca,
            'hum_tingkatkegelapankaca'                 => $request->hum_tingkatkegelapankaca,
            'hum_fungsiklakson'                 => $request->hum_fungsiklakson,
            'hum_kondisidanfungsisabukkeselamatan'                 => $request->hum_kondisidanfungsisabukkeselamatan,
            'hum_ukurankendaraan'                 => $request->hum_ukurankendaraan,
            'hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus'                 => $request->hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus,
            'alatuji_emisiasapbahanbakarsolar'                 => $request->alatuji_emisiasapbahanbakarsolar,
            'alatuji_emisicobahanbakarbensin'                 => $request->alatuji_emisicobahanbakarbensin,
            'alatuji_emisihcbahanbakarbensin'                 => $request->alatuji_emisihcbahanbakarbensin,
            'alatuji_remutamatotalgayapengereman'                 => $request->alatuji_remutamatotalgayapengereman,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan1'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan1,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan2'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan2,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan3'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan3,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan4'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan4,
            'alatuji_remparkirtangan'                 => $request->alatuji_remparkirtangan,
            'alatuji_remparkirkaki'                 => $request->alatuji_remparkirkaki,
            'alatuji_kincuprodadepan'                 => $request->alatuji_kincuprodadepan,
            'alatuji_tingkatkebisingan'                 => $request->alatuji_tingkatkebisingan,
            'alatuji_lampuutamakekuatanpancarlampukanan'                 => $request->alatuji_lampuutamakekuatanpancarlampukanan,
            'alatuji_lampuutamakekuatanpancarlampukiri'                 => $request->alatuji_lampuutamakekuatanpancarlampukiri,
            'alatuji_lampuutamapenyimpanganlampukanan'                 => $request->alatuji_lampuutamapenyimpanganlampukanan,
            'alatuji_lampuutamapenyimpanganlampukiri'                 => $request->alatuji_lampuutamapenyimpanganlampukiri,
            'alatuji_penunjukkecepatan'                 => $request->alatuji_penunjukkecepatan,
            'alatuji_kedalamanalurban'                 => $request->alatuji_kedalamanalurban,
            'gayaremkiris1'                 => $request->gayaremkiris1,
            'gayaremkiris2'                 => $request->gayaremkiris2,
            'gayaremkiris3'                 => $request->gayaremkiris3,
            'gayaremkiris4'                 => $request->gayaremkiris4,
            'gayaremkanans1'                 => $request->gayaremkanans1,
            'gayaremkanans2'                 => $request->gayaremkanans2,
            'gayaremkanans3'                 => $request->gayaremkanans3,
            'gayaremkanans4'                 => $request->gayaremkanans4,
            ]);
    }

    public function getdd($id)
    {
        $uji = Pengujian::findOrFail('1');
        return response()->json(['kendaraan' => 'getdd']);
    }

    public function getkami($id){
        $pengujian = Pendaftaran::find($id);
        $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$pengujian->identitaskendaraan_id)->first();
        return response()->json(['kendaraan' => $datakendaraan]);
    }

    public function acc(Request $request,$id){
        $pengujian = Pengujian::where('pendaftaran_id',$id)->first();
        $pengujian->statuslulusuji = '1';
        $pengujian->idpenguji = $request->idpenguji;
        $pengujian->save();

        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->pos1 = '1';
        $pendaftaran->pos2 = '1';
        $pendaftaran->save();
    }

    public function rejected(Request $request,$id){
        $pengujian = Pengujian::where('pendaftaran_id',$id)->first();
        $pengujian->statuslulusuji = '0';
        $pengujian->idpenguji = $request->idpenguji;
        $pengujian->save();
    }

    public function update(Request $request, $id)
    {
        $pengujian = Pengujian::where('pendaftaran_id',$id)->first();
        if (empty($pengujian)) {
            $data = Pengujian::create([
            'pendaftaran_id'                 => $id,
            'huv_nomordankondisirangka'                 => $request->huv_nomordankondisirangka,
            'huv_nomordantipemotorpenggerak'                 => $request->huv_nomordantipemotorpenggerak,
            'huv_kondisitangkicorongdanpipabahanbakar'                 => $request->huv_kondisitangkicorongdanpipabahanbakar,
            'huv_kondisiconverterkit'                 => $request->huv_kondisiconverterkit,
            'huv_kondisidanposisipipapembuangan'                 => $request->huv_kondisidanposisipipapembuangan,
            'huv_ukurandankondisiban'                 => $request->huv_ukurandankondisiban,
            'huv_kondisisistemsuspensi'                 => $request->huv_kondisisistemsuspensi,
            'huv_kondisisistemremutama'                 => $request->huv_kondisisistemremutama,
            'huv_kondisipenutuplampudanalatpantulcahaya'                 => $request->huv_kondisipenutuplampudanalatpantulcahaya,
            'huv_kondisipanelinstrumentdashboard'                 => $request->huv_kondisipanelinstrumentdashboard,
            'huv_kondisikacaspion'                 => $request->huv_kondisikacaspion,
            'huv_kondisispakbor'                 => $request->huv_kondisispakbor,
            'huv_bentukbumper'                 => $request->huv_bentukbumper,
            'huv_keberadaandankondisiperlengkapan'                 => $request->huv_keberadaandankondisiperlengkapan,
            'huv_rancanganteknis'                 => $request->huv_rancanganteknis,
            'huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus'                 => $request->huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus,
            'huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup'                 => $request->huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup,
            'hum_kondisipenerusdaya'                 => $request->hum_kondisipenerusdaya,
            'hum_sudutbebaskemudi'                 => $request->hum_sudutbebaskemudi,
            'hum_kondisiremparkir'                 => $request->hum_kondisiremparkir,
            'hum_fungsilampudanalatpantulcahaya'                 => $request->hum_fungsilampudanalatpantulcahaya,
            'hum_fungsipenghapuskaca'                 => $request->hum_fungsipenghapuskaca,
            'hum_tingkatkegelapankaca'                 => $request->hum_tingkatkegelapankaca,
            'hum_fungsiklakson'                 => $request->hum_fungsiklakson,
            'hum_kondisidanfungsisabukkeselamatan'                 => $request->hum_kondisidanfungsisabukkeselamatan,
            'hum_ukurankendaraan'                 => $request->hum_ukurankendaraan,
            'hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus'                 => $request->hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus,
            'alatuji_emisiasapbahanbakarsolar'                 => $request->alatuji_emisiasapbahanbakarsolar,
            'alatuji_emisicobahanbakarbensin'                 => $request->alatuji_emisicobahanbakarbensin,
            'alatuji_emisihcbahanbakarbensin'                 => $request->alatuji_emisihcbahanbakarbensin,
            'alatuji_remutamatotalgayapengereman'                 => $request->alatuji_remutamatotalgayapengereman,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan1'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan1,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan2'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan2,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan3'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan3,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan4'                 => $request->alatuji_remutamaselisihgayapengeremanrodakirikanan4,
            'alatuji_remparkirtangan'                 => $request->alatuji_remparkirtangan,
            'alatuji_remparkirkaki'                 => $request->alatuji_remparkirkaki,
            'alatuji_kincuprodadepan'                 => $request->alatuji_kincuprodadepan,
            'alatuji_tingkatkebisingan'                 => $request->alatuji_tingkatkebisingan,
            'alatuji_lampuutamakekuatanpancarlampukanan'                 => $request->alatuji_lampuutamakekuatanpancarlampukanan,
            'alatuji_lampuutamakekuatanpancarlampukiri'                 => $request->alatuji_lampuutamakekuatanpancarlampukiri,
            'alatuji_lampuutamapenyimpanganlampukanan'                 => $request->alatuji_lampuutamapenyimpanganlampukanan,
            'alatuji_lampuutamapenyimpanganlampukiri'                 => $request->alatuji_lampuutamapenyimpanganlampukiri,
            'alatuji_penunjukkecepatan'                 => $request->alatuji_penunjukkecepatan,
            'alatuji_kedalamanalurban'                 => $request->alatuji_kedalamanalurban,
            'gayaremkiris1'                 => $request->gayaremkiris1,
            'gayaremkiris2'                 => $request->gayaremkiris2,
            'gayaremkiris3'                 => $request->gayaremkiris3,
            'gayaremkiris4'                 => $request->gayaremkiris4,
            'gayaremkanans1'                 => $request->gayaremkanans1,
            'gayaremkanans2'                 => $request->gayaremkanans2,
            'gayaremkanans3'                 => $request->gayaremkanans3,
            'gayaremkanans4'                 => $request->gayaremkanans4,
            'tgluji'                         => date("dmY"), 
            ]);

            $pendaftaran = Pendaftaran::find($id);
            if (!is_null($request->posisipos)) {
                if ($request->posisipos == '1') {   
                    $pendaftaran->pos1 = $request->pos1;
                    $pendaftaran->catatanpos1 = $request->catatanpos1;
                    $pendaftaran->petugaspos1 = $request->petugaspos1;
                }elseif ($request->posisipos == '2') {
                    $pendaftaran->pos2 = $request->pos2;
                    $pendaftaran->catatanpos2 = $request->catatanpos2;
                    $pendaftaran->petugaspos2 = $request->petugaspos2;
                }

                if ($pendaftaran->pos1 == 1 || $pendaftaran->pos1 == 2 && is_null($pendaftaran->pos2)) {
                    $pendaftaran->pos2 = '0';
                }
            }
            $pendaftaran->save();
        }
        else{
            $pengujian = Pengujian::where('pendaftaran_id',$id)->first();

        // return response()->json(['kendaraan1' => $pengujian]);
            if (!is_null($request->huv_nomordankondisirangka)) {
            	$pengujian->huv_nomordankondisirangka = $request->huv_nomordankondisirangka;
    	        $pengujian->huv_nomordantipemotorpenggerak = $request->huv_nomordantipemotorpenggerak;
    	        $pengujian->huv_kondisitangkicorongdanpipabahanbakar = $request->huv_kondisitangkicorongdanpipabahanbakar;
    	        $pengujian->huv_kondisiconverterkit = $request->huv_kondisiconverterkit;
    	        $pengujian->huv_kondisidanposisipipapembuangan = $request->huv_kondisidanposisipipapembuangan;
    	        $pengujian->huv_ukurandankondisiban = $request->huv_ukurandankondisiban;
    	        $pengujian->huv_kondisisistemsuspensi = $request->huv_kondisisistemsuspensi;
    	        $pengujian->huv_kondisisistemremutama = $request->huv_kondisisistemremutama;
    	        $pengujian->huv_kondisipenutuplampudanalatpantulcahaya = $request->huv_kondisipenutuplampudanalatpantulcahaya;
    	        $pengujian->huv_kondisipanelinstrumentdashboard = $request->huv_kondisipanelinstrumentdashboard;
    	        $pengujian->huv_kondisikacaspion = $request->huv_kondisikacaspion;
    	        $pengujian->huv_kondisispakbor = $request->huv_kondisispakbor;
    	        $pengujian->huv_bentukbumper = $request->huv_bentukbumper;
    	        $pengujian->huv_rancanganteknis = $request->huv_rancanganteknis;
    	        $pengujian->huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus = $request->huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus;
    	        $pengujian->huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup = $request->huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup;
            }
            if (!is_null($request->hum_kondisipenerusdaya)) {
            	$pengujian->hum_kondisipenerusdaya = $request->hum_kondisipenerusdaya;
    	        $pengujian->hum_sudutbebaskemudi = $request->hum_sudutbebaskemudi;
    	        $pengujian->hum_kondisiremparkir = $request->hum_kondisiremparkir;
    	        $pengujian->hum_fungsilampudanalatpantulcahaya = $request->hum_fungsilampudanalatpantulcahaya;
    	        $pengujian->hum_fungsipenghapuskaca = $request->hum_fungsipenghapuskaca;
    	        $pengujian->hum_tingkatkegelapankaca = $request->hum_tingkatkegelapankaca;
    	        $pengujian->hum_fungsiklakson = $request->hum_fungsiklakson;
    	        $pengujian->hum_kondisidanfungsisabukkeselamatan = $request->hum_kondisidanfungsisabukkeselamatan;
    	        $pengujian->hum_ukurankendaraan = $request->hum_ukurankendaraan;
    	        $pengujian->hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus = $request->hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus;
            }
            if (!is_null($request->alatuji_emisiasapbahanbakarsolar)) {
            	$pengujian->alatuji_emisiasapbahanbakarsolar = $request->alatuji_emisiasapbahanbakarsolar;
    	        $pengujian->alatuji_emisicobahanbakarbensin = $request->alatuji_emisicobahanbakarbensin;
    	        $pengujian->alatuji_emisihcbahanbakarbensin = $request->alatuji_emisihcbahanbakarbensin;
            }

            
            if (!is_null($request->gayaremkiris1)) {
                $pengujian->gayaremkiris1 = $request->gayaremkiris1;
                $pengujian->gayaremkiris2 = $request->gayaremkiris2;
                $pengujian->gayaremkiris3 = $request->gayaremkiris3;
                $pengujian->gayaremkiris4 = $request->gayaremkiris4;
            }

            if (!is_null($request->gayaremkanans1)) {
                $pengujian->gayaremkanans1 = $request->gayaremkanans1;
                $pengujian->gayaremkanans2 = $request->gayaremkanans2;
                $pengujian->gayaremkanans3 = $request->gayaremkanans3;
                $pengujian->gayaremkanans4 = $request->gayaremkanans4;
            }

            if (!is_null($request->alatuji_remutamatotalgayapengereman)) {
            	$pengujian->alatuji_remutamatotalgayapengereman = $request->alatuji_remutamatotalgayapengereman;
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan1 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan1;
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan2 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan2;
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan3 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan3;
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan4 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan4;
    	        $pengujian->alatuji_remparkirtangan = $request->alatuji_remparkirtangan;
    	        $pengujian->alatuji_remparkirkaki = $request->alatuji_remparkirkaki;
            }
            if (!is_null($request->alatuji_kincuprodadepan)) {
            	$pengujian->alatuji_kincuprodadepan = $request->alatuji_kincuprodadepan;
            }
            if (!is_null($request->alatuji_tingkatkebisingan)) {
            	$pengujian->alatuji_tingkatkebisingan = $request->alatuji_tingkatkebisingan;
            }
            if (!is_null($request->alatuji_lampuutamakekuatanpancarlampukanan)) {
            	$pengujian->alatuji_lampuutamakekuatanpancarlampukanan = $request->alatuji_lampuutamakekuatanpancarlampukanan;
    	        $pengujian->alatuji_lampuutamakekuatanpancarlampukiri = $request->alatuji_lampuutamakekuatanpancarlampukiri;
    	        $pengujian->alatuji_lampuutamapenyimpanganlampukanan = $request->alatuji_lampuutamapenyimpanganlampukanan;
    	        $pengujian->alatuji_lampuutamapenyimpanganlampukiri = $request->alatuji_lampuutamapenyimpanganlampukiri;
            }
            if (!is_null($request->alatuji_penunjukkecepatan)) {
            	$pengujian->alatuji_penunjukkecepatan = $request->alatuji_penunjukkecepatan;
            }
            if (!is_null($request->alatuji_kedalamanalurban)) {
            	$pengujian->alatuji_kedalamanalurban = $request->alatuji_kedalamanalurban;
            }
            
            $pengujian->save();

            $pendaftaran = Pendaftaran::find($id);
            if (!is_null($request->posisipos)) {
                if ($request->posisipos == '1') {   
                    $pendaftaran->pos1 = $request->pos1;
                    $pendaftaran->catatanpos1 = $request->catatanpos1;
                    $pendaftaran->petugaspos1 = $request->petugaspos1;
                }elseif ($request->posisipos == '2') {
                    $pendaftaran->pos2 = $request->pos2;
                    $pendaftaran->catatanpos2 = $request->catatanpos2;
                    $pendaftaran->petugaspos2 = $request->petugaspos2;
                }

                if ($pendaftaran->pos1 == 1 || $pendaftaran->pos1 == 2 && is_null($pendaftaran->pos2)) {
                    $pendaftaran->pos2 = '0';
                }
            }
            $pendaftaran->save();

            if (!is_null($request->bsumbu1)) {
                $pendaftaran = Pendaftaran::find($id);
                $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$pendaftaran->identitaskendaraan_id)->first();
                $datakendaraan->beratsumbu1 = $request->bsumbu1;
                $datakendaraan->beratsumbu2 = $request->bsumbu2;
                $datakendaraan->beratsumbu3 = $request->bsumbu3;
                $datakendaraan->beratsumbu4 = $request->bsumbu4;
                $datakendaraan->beratkosong = $request->bsumbu1+$request->bsumbu2+$request->bsumbu3+$request->bsumbu4;
                $datakendaraan->save();
            }

            if (!is_null($request->panjangkendaraan)) {
                $pendaftaran = Pendaftaran::find($id);
                $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$pendaftaran->identitaskendaraan_id)->first();
                $datakendaraan->panjangkendaraan = $request->panjangkendaraan;
                $datakendaraan->lebarkendaraan   = $request->lebarkendaraan;
                $datakendaraan->tinggikendaraan  = $request->tinggikendaraan;
                $datakendaraan->julurdepan       = $request->julurdepan;
                $datakendaraan->julurbelakang    = $request->julurbelakang;
                $datakendaraan->groundclearance  = $request->groundclearance;
                $datakendaraan->save();
            }

            if (!is_null($request->jaraksumbu1_2)) {
                $pendaftaran = Pendaftaran::find($id);
                $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$pendaftaran->identitaskendaraan_id)->first();
                $datakendaraan->jaraksumbu1_2           = $request->jaraksumbu1_2;
                $datakendaraan->jaraksumbu2_3           = $request->jaraksumbu2_3;
                $datakendaraan->jaraksumbu3_4           = $request->jaraksumbu3_4;
                $datakendaraan->q                       = $request->q;
                $datakendaraan->p                       = $request->p;
                $datakendaraan->save();
            }

             if (!is_null($request->panjangbakatautangki)) {
                $pendaftaran = Pendaftaran::find($id);
                $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$pendaftaran->identitaskendaraan_id)->first();
                $datakendaraan->panjangbakatautangki = $request->panjangbakatautangki;
                $datakendaraan->lebarbakatautangki   = $request->lebarbakatautangki;
                $datakendaraan->tinggibakatautangki  = $request->tinggibakatautangki;
                $datakendaraan->save();
            }

            if (!is_null($request->dayaangkutbarang)) {
                $pendaftaran = Pendaftaran::find($id);
                $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$pendaftaran->identitaskendaraan_id)->first();
                $datakendaraan->dayaangkutbarang = $request->dayaangkutbarang;
                $datakendaraan->dayaangkutorang  = $request->dayaangkutorang;
                $datakendaraan->mst              = $request->mst;
                $datakendaraan->jbi              = $request->jbi;
                $datakendaraan->jbki             = $request->jbki;
                $datakendaraan->save();
                
            }
        }
    }

    public function edit($id)
    {
        $kendaraan = Identitaskendaraan::where('pendaftarans.id',$id)->leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->first();
        return response()->json(['kendaraan' => $kendaraan]);
    }
}
