<?php

namespace App\Http\Controllers;

use App\Kodepenerbitan;
use App\Merek;
use App\Jenis;
use App\Tipe;
use App\Klasifikasi;
use App\Jeniskendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function merek()
    {
        $masters = Merek::all();
        return response()->json(['masters'=> $masters]);
    }

    public function jeniskendaraan()
    {
        $masters = Jeniskendaraan::all();
        return response()->json(['masters'=> $masters]);
    }

    public function storemerek(Request $request)
    {
        $data = Merek::create([
            'merek'                 => strtoupper($request->merek),
            ]);
    }

    public function storetipe(Request $request)
    {
        $data = Tipe::create([
            'merek_id'                 => strtoupper($request->merek),
            'tipe'                     => strtoupper($request->tipe),
            ]);
    }

    public function storejeniskend(Request $request)
    {
        $data = Jenis::create([
            'jenis'                 => $request->jenis,
            'klasifikasis_id'       => $request->klasifikasi,
            'jeniskendaraan'        => $request->jeniskendaraan,
            ]);
    }

    public function tipe()
    {
        $masters = Tipe::with('merek')->get();
        return response()->json(['masters'=> $masters]);
    }

    public function klasifikasi()
    {
        $masters = Klasifikasi::all();
        return response()->json(['masters'=> $masters]);
    }

    public function storeklasifikasi(Request $request)
    {
        $data = Klasifikasi::create([
            'klasifikasis'                 => strtoupper($request->klasifikasi),
            ]);
    }

    public function jenis()
    {
        $masters = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->get();
        return response()->json(['masters'=> $masters]);
    }

    public function storejenis(Request $request)
    {
        $data = Klasifikasi::create([
            'klasifikasis'                 => strtoupper($request->klasifikasi),
            ]);
    }

}
