<?php

namespace App\Http\Controllers;

use App\Pendaftaran;
use App\Identitaskendaraan;
use App\Datakendaraan;
use App\Merek;
use App\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DatakendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Datakendaraan::with('identitaskendaraan')->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function merek()
    {
        $kendaraans = Merek::all();
        return response()->json(['mereks'=> $kendaraans]);
    }

    public function tipe()
    {
        $kendaraans = Tipe::all();
        return response()->json(['tipe'=> $kendaraans]);
    }


    public function store(Request $request)
    {
        $data = Datakendaraan::create([
            'jbi'                 	=> $request->jbi,
            'identitaskendaraan_id'	=> $request->identitaskendaraan_id,
            'nosertifikatreg'       => $request->nosertifikatreg,
            'tglsertifikatreg'      => $request->tglsertifikatreg,
            'jbkb'                 	=> $request->jbkb,
            'jbki'                 	=> $request->jbki,
            'mst'                 	=> $request->mst,
            'beratkosong'           => $request->beratsumbu1+$request->beratsumbu2+$request->beratsumbu3+$request->beratsumbu4,
            'konfigurasisumburoda'	=> $request->konfigurasisumburoda,
            'ukuranban'             => $request->ukuranban,
            'panjangkendaraan'      => $request->panjangkendaraan,
            'lebarkendaraan'        => $request->lebarkendaraan,
            'tinggikendaraan'       => $request->tinggikendaraan,
            'julurdepan'            => $request->julurdepan,
            'julurbelakang'         => $request->julurbelakang,
            'groundclearance'       => $request->groundclearance,
            'jaraksumbu1_2'    		=> $request->jaraksumbu1_2,
            'jaraksumbu2_3' 		=> $request->jaraksumbu2_3,
            'jaraksumbu3_4'         => $request->jaraksumbu3_4,
            'q'               		=> $request->q,
            'p'                   	=> $request->p,
            'beratsumbu1'           => $request->beratsumbu1,
            'beratsumbu2'           => $request->beratsumbu2,
            'beratsumbu3'           => $request->beratsumbu3,
            'beratsumbu4'         	=> $request->beratsumbu4,
            'dayaangkutorang'       => $request->dayaangkutorang,
            'dayaangkutbarang'      => $request->dayaangkutbarang,
            'kelasjalanterendah' 	=> $request->kelasjalanterendah,
            ]);
    }


    public function show($id)
    {
        $kendaraan = Datakendaraan::findOrFail($id);
        return response()->json(['kendaraan' => $kendaraan]);
    }

    public function edit($id)
    {
        $kendaraan = Identitaskendaraan::where('identitaskendaraans.id',$id)->leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->first();;
        return response()->json(['kendaraan' => $kendaraan]);
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Datakendaraan::find($id);
        if (!empty($kendaraan)) {
            $kendaraan->identitaskendaraan_id   = $id;
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
	        $kendaraan->groundclearance       	= $request->groundclearance;
	        $kendaraan->jaraksumbu1_2    		= $request->jaraksumbu1_2;
	        $kendaraan->jaraksumbu2_3 			= $request->jaraksumbu2_3;
	        $kendaraan->jaraksumbu3_4         	= $request->jaraksumbu3_4;
	        $kendaraan->q               		= $request->q;
	        $kendaraan->p                   	= $request->p;
	        $kendaraan->beratsumbu1        	   	= $request->beratsumbu1;
	        $kendaraan->beratsumbu2         	= $request->beratsumbu2;
	        $kendaraan->beratsumbu3           	= $request->beratsumbu3;
	        $kendaraan->beratsumbu4         	= $request->beratsumbu4;
	        $kendaraan->dayaangkutorang       	= $request->dayaangkutorang;
	        $kendaraan->dayaangkutbarang      	= $request->dayaangkutbarang;
	        $kendaraan->kelasjalanterendah 		= $request->kelasjalanterendah;
	        $kendaraan->save();
        }else{
        	$data = Datakendaraan::create([
            'jbi'                 	=> $request->jbi,
            'identitaskendaraan_id' => $id,
            'nosertifikatreg'       => $request->nosertifikatreg,
            'tglsertifikatreg'	    => $request->tglsertifikatreg,
            'jbkb'                 	=> $request->jbkb,
            'jbki'                 	=> $request->jbki,
            'mst'                 	=> $request->mst,
            'beratkosong'           => $request->beratsumbu1+$request->beratsumbu2+$request->beratsumbu3+$request->beratsumbu4,
            'konfigurasisumburoda'	=> $request->konfigurasisumburoda,
            'ukuranban'             => $request->ukuranban,
            'panjangkendaraan'      => $request->panjangkendaraan,
            'lebarkendaraan'        => $request->lebarkendaraan,
            'tinggikendaraan'       => $request->tinggikendaraan,
            'panjangbakatautangki'  => $request->panjangbakatautangki,
            'lebarbakatautangki'    => $request->lebarbakatautangki,
            'tinggibakatautangki'   => $request->tinggibakatautangki,
            'julurdepan'            => $request->julurdepan,
            'julurbelakang'         => $request->julurbelakang,
            'groundclearance'       => $request->groundclearance,
            'jaraksumbu1_2'    		=> $request->jaraksumbu1_2,
            'jaraksumbu2_3' 		=> $request->jaraksumbu2_3,
            'jaraksumbu3_4'         => $request->jaraksumbu3_4,
            'q'               		=> $request->q,
            'p'                   	=> $request->p,
            'beratsumbu1'           => $request->beratsumbu1,
            'beratsumbu2'           => $request->beratsumbu2,
            'beratsumbu3'           => $request->beratsumbu3,
            'beratsumbu4'         	=> $request->beratsumbu4,
            'dayaangkutorang'       => $request->dayaangkutorang,
            'dayaangkutbarang'      => $request->dayaangkutbarang,
            'kelasjalanterendah' 	=> $request->kelasjalanterendah,
            ]);
        }
        
    }

    public function destroy($id)
    {
        $kendaraan = Datakendaraan::findOrFail($id);
        $kendaraan->delete();
    }
}
