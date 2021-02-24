<?php

namespace App\Http\Controllers;

use App\PendaftranOld;
use App\Datapengujianlama;
use Illuminate\Http\Request;

class PendaftranOldController extends Controller
{
    public function index()
    {
        $kendaraans = PendaftranOld::join('Datapengujianlama','Datapengujianlama.id','pendaftaraan.id')->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function edit($id)
    {
        $kendaraan = Datapengujianlama::where('Datapengujianlama.id',$id)->first();;
        return response()->json(['kendaraan' => $kendaraan]);
    }

    public function update(Request $request, $id)
    {
       
        if (is_array($request->jeniskendaraan) == 1 ) {
            $jeniskendaraan= $request->jeniskendaraan['jenis'];
        }else{
            $jeniskendaraan= $request->jeniskendaraan;
        }

        if (is_array($request->jenispendaftaran) == 1 ) {
            $jenispendaftaran= $request->jenispendaftaran['id'];
        }else{
            $jenispendaftaran= $request->jenispendaftaran;
        }

        if (is_array($request->merek) == 1) {
            $merek= $request->merek['merek'];
        }else{
            $merek= $request->merek;
        }
        if (is_array($request->tipe) == 1) {
            $tipe= $request->tipe['tipe'];
        }else{
            $tipe= $request->tipe;
        }

        $kendaraan = Datapengujianlama::find($id);
        $kendaraan->nouji                   = $request->nouji;
        $kendaraan->nama                    = $request->nama;
        $kendaraan->alamat                  = $request->alamat;
        $kendaraan->noidentitaspemilik      = $request->noidentitaspemilik;
        $kendaraan->noregistrasikendaraan   = $request->noregistrasikendaraan;
        $kendaraan->norangka                = $request->norangka;
        $kendaraan->merek                   = $merek;
        $kendaraan->tipe                    = $tipe;
        $kendaraan->nomesin                 = $request->nomesin;
        $kendaraan->thpembuatan             = $request->thpembuatan;
        $kendaraan->bahanbakar              = $request->bahanbakar;
        $kendaraan->statuspenggunaan              = $request->peruntukan;
        $kendaraan->jenis                   = $jeniskendaraan;
        $kendaraan->isisilinder             = $request->isisilinder;
        $kendaraan->jbb                     = $request->jbb;
        $kendaraan->nosertifikatreg         = $request->nosertifikatreg;
        $kendaraan->tglsertifikatreg        = $request->tglsertifikatreg;
    	$kendaraan->jbi                 	= $request->jbi;
        $kendaraan->jbkb                 	= $request->jbkb;
        $kendaraan->jbki                 	= $request->jbki;
        $kendaraan->mst                 	= $request->mst;
        $kendaraan->beratkosong           	= $request->beratsumbu1+$request->beratsumbu2+$request->beratsumbu3+$request->beratsumbu4;
        $kendaraan->konfigurasisumburoda	= $request->konfigurasisumburoda;
        $kendaraan->ukuranban             	= $request->ukuranban;
        $kendaraan->panjangkendaraan      	= $request->panjangkendaraan;
        $kendaraan->lebarkendaraan        	= $request->lebarkendaraan;
        $kendaraan->tinggikendaraan       	= $request->tinggikendaraan;
        $kendaraan->panjangbakatautangki        = $request->panjangbakatautangki;
        $kendaraan->lebarbakatautangki          = $request->lebarbakatautangki;
        $kendaraan->tinggibakatautangki     = $request->tinggibakatautangki;
        $kendaraan->julurdepan            	= $request->julurdepan;
        $kendaraan->julurbelakang         	= $request->julurbelakang;
        $kendaraan->gc 				      	= $request->groundclearance;
        $kendaraan->jaraksumbu1_2    		= $request->jaraksumbu1_2;
        $kendaraan->jaraksumbu2_3 			= $request->jaraksumbu2_3;
        $kendaraan->jaraksumbu3_4         	= $request->jaraksumbu3_4;
        $kendaraan->q               		= $request->q;
        $kendaraan->p                   	= $request->p;
        $kendaraan->bs1        	   			= $request->beratsumbu1;
        $kendaraan->bs2         			= $request->beratsumbu2;
        $kendaraan->bs3           			= $request->beratsumbu3;
        $kendaraan->bs4         			= $request->beratsumbu4;
        $kendaraan->dayaangkutorang       	= $request->dayaangkutorang;
        $kendaraan->dayaangkutbarang      	= $request->dayaangkutbarang;
        $kendaraan->kelasjalanterendah 		= $request->kelasjalanterendah;
        $kendaraan->save();        
    }
}
