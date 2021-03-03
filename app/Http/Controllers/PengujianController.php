<?php

namespace App\Http\Controllers;
use App\Identitaskendaraan;
use App\Pengujian;
use App\Pendaftaran;
use App\Datakendaraan;
use App\Datapengujian;
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

        $identitaskendaraan = Pendaftaran::leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->find($id);
        if ($request->idpenguji == '8') {
            // $kode = Pendaftaran::where('pendaftarans.id',$id)->orderBy('pendaftarans.id','desc')->first();

            $pengujian = Pengujian::where('pendaftaran_id',$id)->first();
            $pengujian->statuslulusuji = '1';
            // $pengujian->idpenguji = '779';
            $pengujian->save(); 
        }else{
            $pengujian = Pengujian::where('pendaftaran_id',$id)->first();
            $pengujian->statuslulusuji = '1';
            $pengujian->idpenguji = $request->idpenguji;
            $pengujian->save();
        }

        if ($identitaskendaraan->kodepenerbitans_id == '8') {
            $statuspenerbitan = '2';
        }elseif ($identitaskendaraan->kodepenerbitans_id == '7' || $identitaskendaraan->kodepenerbitans_id == '12') {
            $kode = Pendaftaran::where('pendaftarans.identitaskendaraan_id',$identitaskendaraan->identitaskendaraan_id)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->orderBy('pendaftarans.id','desc')->first();
            $statuspenerbitan = $kode->kodepenerbitans_id;
        }else{
            $statuspenerbitan = $identitaskendaraan->kodepenerbitans_id;
        }

        if ($identitaskendaraan->idpenguji == NULL || empty($identitaskendaraan->idpenguji)) {
            $idpenguji = '779';
        }else{
            $idpenguji = $identitaskendaraan->idpenguji;
        }

        $date=date_create($identitaskendaraan->tglsertifikatreg);
        $tglsertifikatreg = date_format($date,'dmY');
        $date1=date_create($identitaskendaraan->masaberlakuuji);
        $masaberlakuuji= date_format($date1,'dmY');

        $pendaftaran = Pendaftaran::find($id);
        if (!empty($pendaftaran->idx) || !is_null($pendaftaran->idx)) {
            $datapengujian = Datapengujian::find($pendaftaran->idx);
            $datapengujian->statuspenerbitan      = $statuspenerbitan;
            $datapengujian->nouji                 = $identitaskendaraan->nouji;
            $datapengujian->nama                  = $identitaskendaraan->nama;
            $datapengujian->alamat                = $identitaskendaraan->alamat;
            $datapengujian->noidentitaspemilik    = $identitaskendaraan->noidentitaspemilik;
            $datapengujian->noregistrasikendaraan = $identitaskendaraan->noregistrasikendaraan;
            $datapengujian->norangka              = $identitaskendaraan->norangka;
            $datapengujian->merek                 = $identitaskendaraan->merek;
            $datapengujian->tipe                  = $identitaskendaraan->tipe;
            $datapengujian->nomesin               = $identitaskendaraan->nomesin;
            $datapengujian->jbb                   = $identitaskendaraan->jbb;
            $datapengujian->thpembuatan           = $identitaskendaraan->thpembuatan;
            $datapengujian->bahanbakar            = $identitaskendaraan->bahanbakar;
            $datapengujian->jenis                 = $identitaskendaraan->jeniskendaraan;
            $datapengujian->isisilinder           = $identitaskendaraan->isisilinder;
            $datapengujian->dayamotorpenggerak    = $identitaskendaraan->dayamotorpenggerak;
            $datapengujian->idkepaladinas         = '278';
            $datapengujian->iddirektur            = '18';
            $datapengujian->kodewilayah           = $identitaskendaraan->kodewilayah;
            $datapengujian->kodewilayahasal       = $identitaskendaraan->kodewilayahasal;
            $datapengujian->jbi                   = $identitaskendaraan->jbi;
            $datapengujian->nosertifikatreg       = $identitaskendaraan->nosertifikatreg;
            $datapengujian->tglsertifikatreg      = $tglsertifikatreg;
            $datapengujian->jbkb                  = $identitaskendaraan->jbkb;
            $datapengujian->jbki                  = $identitaskendaraan->jbki;
            $datapengujian->mst                   = $identitaskendaraan->mst;
            $datapengujian->beratkosong           = $identitaskendaraan->beratkosong;
            $datapengujian->konfigurasisumburoda  = $identitaskendaraan->konfigurasisumburoda;
            $datapengujian->ukuranban             = $identitaskendaraan->ukuranban;
            $datapengujian->panjangkendaraan      = $identitaskendaraan->panjangkendaraan;
            $datapengujian->lebarkendaraan        = $identitaskendaraan->lebarkendaraan;
            $datapengujian->tinggikendaraan       = $identitaskendaraan->tinggikendaraan;
            $datapengujian->panjangbakatautangki  = $identitaskendaraan->panjangbakatautangki;
            $datapengujian->lebarbakatautangki    = $identitaskendaraan->lebarbakatautangki;
            $datapengujian->tinggibakatautangki   = $identitaskendaraan->tinggibakatautangki;
            $datapengujian->julurdepan            = $identitaskendaraan->julurdepan;
            $datapengujian->julurbelakang         = $identitaskendaraan->julurbelakang;
            $datapengujian->jaraksumbu1_2         = $identitaskendaraan->jaraksumbu1_2;
            $datapengujian->jaraksumbu2_3         = $identitaskendaraan->jaraksumbu2_3;
            $datapengujian->jaraksumbu3_4         = $identitaskendaraan->jaraksumbu3_4;
            $datapengujian->dayaangkutorang       = $identitaskendaraan->dayaangkutorang;
            $datapengujian->dayaangkutbarang      = $identitaskendaraan->dayaangkutbarang;
            $datapengujian->kelasjalanterendah    = $identitaskendaraan->kelasjalanterendah;
            $datapengujian->idpetugasuji          = $idpenguji;
            $datapengujian->huv_nomordankondisirangka                 = $identitaskendaraan->huv_nomordankondisirangka;
            $datapengujian->huv_nomordantipemotorpenggerak            = $identitaskendaraan->huv_nomordantipemotorpenggerak;
            $datapengujian->huv_kondisitangkicorongdanpipabahanbakar  = $identitaskendaraan->huv_kondisitangkicorongdanpipabahanbakar;
            $datapengujian->huv_kondisiconverterkit                   = $identitaskendaraan->huv_kondisiconverterkit;
            $datapengujian->huv_kondisidanposisipipapembuangan        = $identitaskendaraan->huv_kondisidanposisipipapembuangan;
            $datapengujian->huv_ukurandankondisiban                   = $identitaskendaraan->huv_ukurandankondisiban;
            $datapengujian->huv_kondisisistemsuspensi                 = $identitaskendaraan->huv_kondisisistemsuspensi;
            $datapengujian->huv_kondisisistemremutama                 = $identitaskendaraan->huv_kondisisistemremutama;
            $datapengujian->huv_kondisipenutuplampudanalatpantulcahaya= $identitaskendaraan->huv_kondisipenutuplampudanalatpantulcahaya;
            $datapengujian->huv_kondisipanelinstrumentdashboard       = $identitaskendaraan->huv_kondisipanelinstrumentdashboard;
            $datapengujian->huv_kondisikacaspion                      = $identitaskendaraan->huv_kondisikacaspion;
            $datapengujian->huv_kondisispakbor                        = $identitaskendaraan->huv_kondisispakbor;
            $datapengujian->huv_bentukbumper                          = $identitaskendaraan->huv_bentukbumper;
            $datapengujian->huv_keberadaandankondisiperlengkapan      = $identitaskendaraan->huv_keberadaandankondisiperlengkapan;
            $datapengujian->huv_rancanganteknis                       = $identitaskendaraan->huv_rancanganteknis;
            $datapengujian->huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus   = $identitaskendaraan->huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus;
            $datapengujian->huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup  = $identitaskendaraan->huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup;
            $datapengujian->hum_kondisipenerusdaya                    = $identitaskendaraan->hum_kondisipenerusdaya;
            $datapengujian->hum_sudutbebaskemudi                      = $identitaskendaraan->hum_sudutbebaskemudi;
            $datapengujian->hum_kondisiremparkir                      = $identitaskendaraan->hum_kondisiremparkir;
            $datapengujian->hum_fungsilampudanalatpantulcahaya        = $identitaskendaraan->hum_fungsilampudanalatpantulcahaya;
            $datapengujian->hum_fungsipenghapuskaca                   = $identitaskendaraan->hum_fungsipenghapuskaca;
            $datapengujian->hum_tingkatkegelapankaca                  = $identitaskendaraan->hum_tingkatkegelapankaca;
            $datapengujian->hum_fungsiklakson                         = $identitaskendaraan->hum_fungsiklakson;
            $datapengujian->hum_kondisidanfungsisabukkeselamatan      = $identitaskendaraan->hum_kondisidanfungsisabukkeselamatan;
            $datapengujian->hum_ukurankendaraan                       = $identitaskendaraan->hum_ukurankendaraan;
            $datapengujian->hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus       = $identitaskendaraan->hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus;
            $datapengujian->alatuji_emisiasapbahanbakarsolar          = $identitaskendaraan->alatuji_emisiasapbahanbakarsolar;
            $datapengujian->alatuji_emisicobahanbakarbensin           = $identitaskendaraan->alatuji_emisicobahanbakarbensin;
            $datapengujian->alatuji_emisihcbahanbakarbensin           = $identitaskendaraan->alatuji_emisihcbahanbakarbensin;
            $datapengujian->alatuji_remutamatotalgayapengereman       = $identitaskendaraan->alatuji_remutamatotalgayapengereman;
            $datapengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan1  = $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan1;
            $datapengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan2  = $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan2;
            $datapengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan3  = $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan3;
            $datapengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan4  = $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan4;
            $datapengujian->alatuji_remparkirtangan                   = $identitaskendaraan->alatuji_remparkirtangan;
            $datapengujian->alatuji_remparkirkaki                     = $identitaskendaraan->alatuji_remparkirkaki;
            $datapengujian->alatuji_kincuprodadepan                   = $identitaskendaraan->alatuji_kincuprodadepan;
            $datapengujian->alatuji_tingkatkebisingan                 = $identitaskendaraan->alatuji_tingkatkebisingan;
            $datapengujian->alatuji_lampuutamakekuatanpancarlampukanan= $identitaskendaraan->alatuji_lampuutamakekuatanpancarlampukanan;
            $datapengujian->alatuji_lampuutamakekuatanpancarlampukiri = $identitaskendaraan->alatuji_lampuutamakekuatanpancarlampukiri;
            $datapengujian->alatuji_lampuutamapenyimpanganlampukanan  = $identitaskendaraan->alatuji_lampuutamapenyimpanganlampukanan;
            $datapengujian->alatuji_lampuutamapenyimpanganlampukiri   = $identitaskendaraan->alatuji_lampuutamapenyimpanganlampukiri;
            $datapengujian->alatuji_penunjukkecepatan                 = $identitaskendaraan->alatuji_penunjukkecepatan;
            $datapengujian->alatuji_kedalamanalurban                  = $identitaskendaraan->alatuji_kedalamanalurban;
            $datapengujian->tgluji                                    = $identitaskendaraan->tgluji; 
            $datapengujian->masaberlakuuji                            = $masaberlakuuji;
            $datapengujian->statuslulusuji                            = $identitaskendaraan->statuslulusuji;
            $datapengujian->save();  
            // $dataidx = $data->idx;

        }else{
            $data = Datapengujian::create([
            'statuspenerbitan'      => $statuspenerbitan,
            'nouji'                 => $identitaskendaraan->nouji,
            'nama'                  => $identitaskendaraan->nama,
            'alamat'                => $identitaskendaraan->alamat,
            'noidentitaspemilik'    => $identitaskendaraan->noidentitaspemilik,
            'noregistrasikendaraan' => $identitaskendaraan->noregistrasikendaraan,
            'norangka'              => $identitaskendaraan->norangka,
            'merek'                 => $identitaskendaraan->merek,
            'tipe'                  => $identitaskendaraan->tipe,
            'nomesin'               => $identitaskendaraan->nomesin,
            'jbb'                   => $identitaskendaraan->jbb,
            'thpembuatan'           => $identitaskendaraan->thpembuatan,
            'bahanbakar'            => $identitaskendaraan->bahanbakar,
            'jenis'                 => $identitaskendaraan->jeniskendaraan,
            'isisilinder'           => $identitaskendaraan->isisilinder,
            'dayamotorpenggerak'    => $identitaskendaraan->dayamotorpenggerak,
            'idkepaladinas'         => '278',
            'iddirektur'            => '18',
            'kodewilayah'           => $identitaskendaraan->kodewilayah,
            'kodewilayahasal'       => $identitaskendaraan->kodewilayahasal,
            'jbi'                   => $identitaskendaraan->jbi,
            'nosertifikatreg'       => $identitaskendaraan->nosertifikatreg,
            'tglsertifikatreg'      => $tglsertifikatreg,
            'jbkb'                  => $identitaskendaraan->jbkb,
            'jbki'                  => $identitaskendaraan->jbki,
            'mst'                   => $identitaskendaraan->mst,
            'beratkosong'           => $identitaskendaraan->beratkosong,
            'konfigurasisumburoda'  => $identitaskendaraan->konfigurasisumburoda,
            'ukuranban'             => $identitaskendaraan->ukuranban,
            'panjangkendaraan'      => $identitaskendaraan->panjangkendaraan,
            'lebarkendaraan'        => $identitaskendaraan->lebarkendaraan,
            'tinggikendaraan'       => $identitaskendaraan->tinggikendaraan,
            'panjangbakatautangki'  => $identitaskendaraan->panjangbakatautangki,
            'lebarbakatautangki'    => $identitaskendaraan->lebarbakatautangki,
            'tinggibakatautangki'   => $identitaskendaraan->tinggibakatautangki,
            'julurdepan'            => $identitaskendaraan->julurdepan,
            'julurbelakang'         => $identitaskendaraan->julurbelakang,
            'jaraksumbu1_2'         => $identitaskendaraan->jaraksumbu1_2,
            'jaraksumbu2_3'         => $identitaskendaraan->jaraksumbu2_3,
            'jaraksumbu3_4'         => $identitaskendaraan->jaraksumbu3_4,
            'dayaangkutorang'       => $identitaskendaraan->dayaangkutorang,
            'dayaangkutbarang'      => $identitaskendaraan->dayaangkutbarang,
            'kelasjalanterendah'    => $identitaskendaraan->kelasjalanterendah,
            'idpetugasuji'          => $identitaskendaraan->idpenguji,
            'huv_nomordankondisirangka'                 => $identitaskendaraan->huv_nomordankondisirangka,
            'huv_nomordantipemotorpenggerak'            => $identitaskendaraan->huv_nomordantipemotorpenggerak,
            'huv_kondisitangkicorongdanpipabahanbakar'  => $identitaskendaraan->huv_kondisitangkicorongdanpipabahanbakar,
            'huv_kondisiconverterkit'                   => $identitaskendaraan->huv_kondisiconverterkit,
            'huv_kondisidanposisipipapembuangan'        => $identitaskendaraan->huv_kondisidanposisipipapembuangan,
            'huv_ukurandankondisiban'                   => $identitaskendaraan->huv_ukurandankondisiban,
            'huv_kondisisistemsuspensi'                 => $identitaskendaraan->huv_kondisisistemsuspensi,
            'huv_kondisisistemremutama'                 => $identitaskendaraan->huv_kondisisistemremutama,
            'huv_kondisipenutuplampudanalatpantulcahaya'=> $identitaskendaraan->huv_kondisipenutuplampudanalatpantulcahaya,
            'huv_kondisipanelinstrumentdashboard'       => $identitaskendaraan->huv_kondisipanelinstrumentdashboard,
            'huv_kondisikacaspion'                      => $identitaskendaraan->huv_kondisikacaspion,
            'huv_kondisispakbor'                        => $identitaskendaraan->huv_kondisispakbor,
            'huv_bentukbumper'                          => $identitaskendaraan->huv_bentukbumper,
            'huv_keberadaandankondisiperlengkapan'      => $identitaskendaraan->huv_keberadaandankondisiperlengkapan,
            'huv_rancanganteknis'                       => $identitaskendaraan->huv_rancanganteknis,
            'huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus'   => $identitaskendaraan->huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus,
            'huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup'  => $identitaskendaraan->huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup,
            'hum_kondisipenerusdaya'                    => $identitaskendaraan->hum_kondisipenerusdaya,
            'hum_sudutbebaskemudi'                      => $identitaskendaraan->hum_sudutbebaskemudi,
            'hum_kondisiremparkir'                      => $identitaskendaraan->hum_kondisiremparkir,
            'hum_fungsilampudanalatpantulcahaya'        => $identitaskendaraan->hum_fungsilampudanalatpantulcahaya,
            'hum_fungsipenghapuskaca'                   => $identitaskendaraan->hum_fungsipenghapuskaca,
            'hum_tingkatkegelapankaca'                  => $identitaskendaraan->hum_tingkatkegelapankaca,
            'hum_fungsiklakson'                         => $identitaskendaraan->hum_fungsiklakson,
            'hum_kondisidanfungsisabukkeselamatan'      => $identitaskendaraan->hum_kondisidanfungsisabukkeselamatan,
            'hum_ukurankendaraan'                       => $identitaskendaraan->hum_ukurankendaraan,
            'hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus'       => $identitaskendaraan->hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus,
            'alatuji_emisiasapbahanbakarsolar'          => $identitaskendaraan->alatuji_emisiasapbahanbakarsolar,
            'alatuji_emisicobahanbakarbensin'           => $identitaskendaraan->alatuji_emisicobahanbakarbensin,
            'alatuji_emisihcbahanbakarbensin'           => $identitaskendaraan->alatuji_emisihcbahanbakarbensin,
            'alatuji_remutamatotalgayapengereman'       => $identitaskendaraan->alatuji_remutamatotalgayapengereman,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan1'  => $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan1,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan2'  => $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan2,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan3'  => $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan3,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan4'  => $identitaskendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan4,
            'alatuji_remparkirtangan'                   => $identitaskendaraan->alatuji_remparkirtangan,
            'alatuji_remparkirkaki'                     => $identitaskendaraan->alatuji_remparkirkaki,
            'alatuji_kincuprodadepan'                   => $identitaskendaraan->alatuji_kincuprodadepan,
            'alatuji_tingkatkebisingan'                 => $identitaskendaraan->alatuji_tingkatkebisingan,
            'alatuji_lampuutamakekuatanpancarlampukanan'=> $identitaskendaraan->alatuji_lampuutamakekuatanpancarlampukanan,
            'alatuji_lampuutamakekuatanpancarlampukiri' => $identitaskendaraan->alatuji_lampuutamakekuatanpancarlampukiri,
            'alatuji_lampuutamapenyimpanganlampukanan'  => $identitaskendaraan->alatuji_lampuutamapenyimpanganlampukanan,
            'alatuji_lampuutamapenyimpanganlampukiri'   => $identitaskendaraan->alatuji_lampuutamapenyimpanganlampukiri,
            'alatuji_penunjukkecepatan'                 => $identitaskendaraan->alatuji_penunjukkecepatan,
            'alatuji_kedalamanalurban'                  => $identitaskendaraan->alatuji_kedalamanalurban,
            'tgluji'                                    => $identitaskendaraan->tgluji, 
            'masaberlakuuji'                            => $masaberlakuuji, 
            'statuslulusuji'                            => $identitaskendaraan->statuslulusuji, 
            ]);
            $dataidx = $data->idx;

            $pendaftaran = Pendaftaran::find($id);
            $pendaftaran->pos1  = '1';
            $pendaftaran->pos2  = '1';
            $pendaftaran->verif = 'y';
            if (!is_null($dataidx)) {
                $pendaftaran->idx = $dataidx;
            }
            $pendaftaran->save();
        }

    }

    public function rejected(Request $request,$id){
        $pengujian = Pengujian::where('pendaftaran_id',$id)->first();
        $pengujian->statuslulusuji = '0';
        $pengujian->idpenguji = $request->idpenguji;
        $pengujian->save();

        $iddata = Pendaftaran::find($id);
        if (!is_null($iddata->idx)) {
            $datapengujian = Datapengujian::find($iddata->idx);
            $datapengujian->delete();

            $pendaftaran = Pendaftaran::find($id);
            $pendaftaran->verif = 'y';
            $pendaftaran->idx = NULL;
            $pendaftaran->save();
        }else{
            $pendaftaran = Pendaftaran::find($id);
            $pendaftaran->verif = 'y';
            $pendaftaran->save();  
        }   
        
    }

    public function update(Request $request, $id)
    {
        if ($request->alatuji_remutamaselisihgayapengeremanrodakirikanan1 >= 0) {
            $selisih1 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan1;
        }else{
            $selisih1 = 0;
        }

        if ($request->alatuji_remutamaselisihgayapengeremanrodakirikanan2 >= 0) {
            $selisih2 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan2;
        }else{
            $selisih2 = 0;
        }

        if ($request->alatuji_remutamaselisihgayapengeremanrodakirikanan3 >= 0) {
            $selisih3 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan3;
        }else{
            $selisih3 = 0;
        }

        if ($request->alatuji_remutamaselisihgayapengeremanrodakirikanan4 >= 0) {
            $selisih4 = $request->alatuji_remutamaselisihgayapengeremanrodakirikanan4;
        }else{
            $selisih4 = 0;
        }
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
            'alatuji_remutamaselisihgayapengeremanrodakirikanan1'                 => $selisih1,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan2'                 => $selisih2,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan3'                 => $selisih3,
            'alatuji_remutamaselisihgayapengeremanrodakirikanan4'                 => $selisih4,
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

                if (($pendaftaran->pos1 == 1 || $pendaftaran->pos1 == 2) && is_null($pendaftaran->pos2)) {
                    $pendaftaran->pos2 = '0';
                }
            }
            $pendaftaran->save();
        }
        else{
            $pengujian = Pengujian::where('pendaftaran_id',$id)->first();

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
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan1 = $selisih1;
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan2 = $selisih2;
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan3 = $selisih3;
    	        $pengujian->alatuji_remutamaselisihgayapengeremanrodakirikanan4 = $selisih4;
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

                if (($pendaftaran->pos1 == 1 || $pendaftaran->pos1 == 2) && is_null($pendaftaran->pos2)) {
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
                $datakendaraan->beratkosong = $request->beratkosong;
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
        if ($kendaraan->kodepenerbitans_id == '7' || $kendaraan->kodepenerbitans_id == '3' || $kendaraan->kodepenerbitans_id == '4') {
            $idd = Pendaftaran::where('identitaskendaraan_id',$kendaraan->identitaskendaraan_id)->where('pos2','>','0')->orderBy('pendaftarans.id','desc')->first();
            $kendaraan = Identitaskendaraan::where('pendaftarans.id',$idd->id)->leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->first();
        }
        return response()->json(['kendaraan' => $kendaraan]);
    }
}
