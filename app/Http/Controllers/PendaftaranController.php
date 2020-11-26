<?php

namespace App\Http\Controllers;
use App\Pendaftaran;
use App\Datakendaraan;
use App\Datapengujianlama;
use App\Identitaskendaraan;
use App\Kodewilayah;
use App\Kodepenerbitan;
use App\Jenis;
use App\Merek;
use App\klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;

class PendaftaranController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d');
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indexall()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indexnu()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('kodepenerbitans_id','5')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indexallnu()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('kodepenerbitans_id','5')->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indexallmu()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('kodepenerbitans_id','6')->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indexmu()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('kodepenerbitans_id','6')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indextrans()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan','transaksi')->where('tglbayar',date("Y-m-d"))->get();
        // $kendaraans = Identitaskendaraan::leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglbayar',date("Y-m-d"))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indextransall()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->get();
        // $kendaraans = Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indexpos1()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos1','0')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indexpos2()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos2','0')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function lulusuji1()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos1','1')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function lulusuji2()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos2','1')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function verif()
    {
        // $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos1','>=','1')->where('pos2','>=','1')->where('tglpendaftaran',date('Y-m-d'))->get();
        $kendaraans = Identitaskendaraan::leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->where('statuslulusuji','0')->where('pos1','>=','1')->where('pos2','>=','1')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function verifall()
    {
        // $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos1','>=','1')->where('pos2','>=','1')->get();
        $kendaraans = Identitaskendaraan::leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->where('statuslulusuji','0')->where('pos1','>=','1')->where('pos2','>=','1')->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function veriflulus()
    {
        $kendaraans = Identitaskendaraan::leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->where('statuslulusuji','1')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function verifgagal()
    {
        $kendaraans = Identitaskendaraan::leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->where('statuslulusuji','0')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function tidaklulusuji1()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos1','2')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function tidaklulusuji2()
    {
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos2','2')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function kodewilayah(){
        $kodewilayahs = Kodewilayah::all();
        return response()->json(['kodewilayahs'=> $kodewilayahs]);
    }

    public function kodepenerbitan(){
        $kodepenerbitans = Kodepenerbitan::all();
        return response()->json(['kodepenerbitans'=> $kodepenerbitans]);
    }

    public function store(Request $request)
    {
        if (is_array($request->kodewilayah) == 1) {
            $kode= $request->kodewilayah['kodewilayah'];
        }else{
            $kode= $request->kodewilayah;
        }

        if (is_array($request->kodewilayahasal) == 1) {
            $kodeasal= $request->kodewilayahasal['kodewilayah'];
        }else{
            $kodeasal= $request->kodewilayahasal;
        }

        if ($request->kodewilayah == '') {
            $kode='BNJRM'; 
        }

        if ($request->kodewilayahasal == '') {
            $kodeasal='BNJRM'; 
        }

        if (empty($request->jeniskendaraan['jenis'])) {
            $jeniskendaraan= $request->jeniskendaraan;
        }else{
            $jeniskendaraan= $request->jeniskendaraan['jenis'];
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

        $cekkendaraan = Identitaskendaraan::where('identitaskendaraans.nouji',$request->nouji)->first();;
        if (!$cekkendaraan) {
            $data = Identitaskendaraan::create([
            'nouji'                 => $request->nouji,
            'nama'                  => $request->nama,
            'alamat'                => $request->alamat,
            'kecamatan'             => $request->kecamatan,
            'nohp'                  => $request->nohp,
            'noidentitaspemilik'    => $request->noidentitaspemilik,
            'noregistrasikendaraan' => $request->noregistrasikendaraan,
            'norangka'              => $request->norangka,
            'merek'                 => $request->merek,
            'tipe'                  => $request->tipe,
            'nomesin'               => $request->nomesin,
            'jbb'                   => $request->jbb,
            'thpembuatan'           => $request->thpembuatan,
            'bahanbakar'            => $request->bahanbakar,
            'peruntukan'            => $request->peruntukan,
            'jenis'                 => $jeniskendaraan,
            'isisilinder'           => $request->isisilinder,
            'idkepaladinas'         => '1',
            'iddirektur'            => '1',
            'kodewilayah'           => $kode,
            'kodewilayahasal'       => $kodeasal,
            ]);

            Pendaftaran::create([
            'identitaskendaraan_id' => $data->id,
            'tglpendaftaran'        => $request->tglpendaftaran,
            'tglbayar'              => $request->tglbayar,
			'masaberlakuuji'        => $request->masaberlakuuji,
            'kodepenerbitans_id'    => $jenispendaftaran,
            'jenispendaftaran'                 => 'ots',
            'verif'                 => 'y',
            ]);

            Datakendaraan::create([
            'jbi'                   => $request->jbi,
            'identitaskendaraan_id' => $data->id,
            'nosertifikatreg'       => $request->nosertifikatreg,
            'tglsertifikatreg'      => $request->tglsertifikatreg,
            'jbkb'                  => $request->jbkb,
            'jbki'                  => $request->jbki,
            'konfigurasisumburoda'  => $request->konfigurasisumburoda,
            'ukuranban'             => $request->ukuranban,
            'jaraksumbu1_2'         => $request->jaraksumbu1_2,
            'jaraksumbu2_3'         => $request->jaraksumbu2_3,
            'jaraksumbu3_4'         => $request->jaraksumbu3_4,
            'q'                     => $request->q,
            'p'                     => $request->p,
            'kelasjalanterendah'    => $request->kelasjalanterendah,
            ]);
        }
        else{
            Pendaftaran::create([
            'identitaskendaraan_id' => $cekkendaraan->id,
            'tglpendaftaran'        => $request->tglpendaftaran,
            'tglbayar'              => $request->tglbayar,
            'masaberlakuuji'        => $request->masaberlakuuji,
            'kodepenerbitans_id'    => $jenispendaftaran,
            'jenispendaftaran'                 => 'ots',
            'verif'                 => 'y',
            ]);   
        }        
    }


    public function show($id)
    {
        $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('pendaftarans.id',$id)->first();
        return response()->json(['kendaraan' => $kendaraan]);
    }

    public function edit($id)
    {
        $kendaraan = Identitaskendaraan::where('identitaskendaraans.id',$id)->leftJoin('pendaftarans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->first();;
        return response()->json(['kendaraan' => $kendaraan]);
    }

    public function cari(Request $request)
    {
        $kendaraan = Identitaskendaraan::where('identitaskendaraans.nouji',$request->nouji)->leftJoin('pendaftarans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->first();;
        if (is_null($kendaraan)) {
            $kendaraan = Datapengujianlama::where('datapengujianlama.nouji', $request->nouji)->orderBy('id','desc')->first();
        }
        return response()->json(['kendaraan' => $kendaraan]);
    }

    public function update(Request $request, $id)
    {
        if (is_array($request->kodewilayah) == 1) {
            $kode= $request->kodewilayah['kodewilayah'];
        }else{
            $kode= $request->kodewilayah;
        }

        if (is_array($request->kodewilayahasal) == 1) {
            $kodeasal= $request->kodewilayahasal['kodewilayah'];
        }else{
            $kodeasal= $request->kodewilayahasal;
        }
		
		if ($request->kodewilayah == '') {
            $kode='BNJRM'; 
        }

        if ($request->kodewilayahasal == '') {
            $kodeasal='BNJRM'; 
        }

        if (is_array($request->jenispendaftaran) == 1 ) {
            $jenispendaftaran= $request->jenispendaftaran['id'];
        }else{
            $jenispendaftaran= $request->jenispendaftaran;
        }

        if (is_array($request->jeniskendaraan) == 1 ) {
            $jeniskendaraan= $request->jeniskendaraan['jenis'];
        }else{
            $jeniskendaraan= $request->jeniskendaraan;
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

        $cekkendaraan = Pendaftaran::leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('pendaftarans.id',$id)->first();
        $identitaskendaraan_id= $cekkendaraan->identitaskendaraan_id;
        if ($jenispendaftaran == '8') {
            $jeniskendaraanlama = $cekkendaraan->jenis;
        }else{
            $jeniskendaraanlama = '';
        }
        if ($jenispendaftaran == '11') {
            $sifatlama = $cekkendaraan->peruntukan;
        }else{
            $sifatlama = '';
        }
        $kendaraan = Identitaskendaraan::find($identitaskendaraan_id);
        $kendaraan->nouji                   = $request->nouji;
        $kendaraan->nama                    = $request->nama;
        $kendaraan->alamat                  = $request->alamat;
        $kendaraan->kecamatan               = $request->kecamatan;
        $kendaraan->nohp                    = $request->nohp;
        $kendaraan->noidentitaspemilik      = $request->noidentitaspemilik;
        $kendaraan->noregistrasikendaraan   = $request->noregistrasikendaraan;
        $kendaraan->norangka                = $request->norangka;
        $kendaraan->merek                   = $merek;
        $kendaraan->tipe                    = $tipe;
        $kendaraan->nomesin                 = $request->nomesin;
        $kendaraan->thpembuatan             = $request->thpembuatan;
        $kendaraan->bahanbakar              = $request->bahanbakar;
        $kendaraan->peruntukan              = $request->peruntukan;
        $kendaraan->jenis                   = $jeniskendaraan;
        $kendaraan->isisilinder             = $request->isisilinder;
        $kendaraan->jbb                     = $request->jbb;
        $kendaraan->kodewilayah             = $kode;
        $kendaraan->kodewilayahasal         = $kodeasal;
        $kendaraan->jenislama               = $jeniskendaraanlama;
        $kendaraan->sifatlama               = $sifatlama;
        $kendaraan->save();

        // $pendaftaran = Pendaftaran::where('id',$id);
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->tglpendaftaran          = $request->tglpendaftaran;
        $pendaftaran->tglbayar                = $request->tglbayar;
        $pendaftaran->masaberlakuuji          = $request->masaberlakuuji;
        $pendaftaran->kodepenerbitans_id      = $jenispendaftaran;
        $pendaftaran->save();

        $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$identitaskendaraan_id)->first();
        $datakendaraan->nosertifikatreg         = $request->nosertifikatreg;
        $datakendaraan->tglsertifikatreg        = $request->tglsertifikatreg;
        $datakendaraan->jbkb                    = $request->jbkb;
        $datakendaraan->konfigurasisumburoda    = $request->konfigurasisumburoda;
        $datakendaraan->ukuranban               = $request->ukuranban;
        $datakendaraan->jaraksumbu1_2           = $request->jaraksumbu1_2;
        $datakendaraan->jaraksumbu2_3           = $request->jaraksumbu2_3;
        $datakendaraan->jaraksumbu3_4           = $request->jaraksumbu3_4;
        $datakendaraan->q                       = $request->q;
        $datakendaraan->p                       = $request->p;
        $datakendaraan->kelasjalanterendah      = $request->kelasjalanterendah;
        $datakendaraan->save();

        return response()->json(['kendaraan' => $request->pendaftaran]);
        
    }

    public function lanjutuji($id){
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->pos1          = '0';
        $pendaftaran->save();
    }

    public function destroy($id)
    {
        $kendaraan = Pendaftaran::findOrFail($id);
        $kendaraan->delete();
    }

    public function generateNK($id)
    {
        //GET DATA BERDASARKAN ID
        $kendaraan = Pendaftaran::with(['identitaskendaraan'])->find($id);
        //LOAD PDF YANG MERUJUK KE VIEW PRINT.BLADE.PHP DENGAN MENGIRIMKAN DATA DARI INVOICE
        //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        $pdf = PDF::loadView('admin.cetak.nk_print',  compact('kendaraan'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function printNK($id)
    {
        
		$kendaraan = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('pendaftarans.id',$id)->first();
        $wilayah = Kodewilayah::select('namawilayah')->where('kodewilayah',$kendaraan->identitaskendaraan->kodewilayah)->first();
        // return response()->json(['kendaraan' => $wilayah]);
        return view('admin.cetak.nk_print', compact('kendaraan'), compact('wilayah'));
    }

    public function printMT($id)
    {
        $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('pendaftarans.id',$id)->first();
        $wilayah = Kodewilayah::select('namawilayah')->where('kodewilayah',$kendaraan->identitaskendaraan->kodewilayah)->first();
        return view('admin.cetak.mt_print', compact('kendaraan'), compact('wilayah'));
    }

    public function printlembarpermohonan($id)
    {
        $kendaraan = Pendaftaran::with(['identitaskendaraan'])->find($id);
        // return response()->json(['kendaraan' => $kendaraan]);
        return view('admin.cetak.lmbrpermohonan_print', compact('kendaraan'));
    }

    public function printlembarpemeriksaan($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->first();
        return view('admin.cetak.lmbrpemeriksaan_print', compact('data'));
    }

    public function printlembarsktl($id)
    {
        $kendaraan = Pendaftaran::with(['identitaskendaraan'])->find($id);
        return view('admin.cetak.lmbrsktl_print', compact('kendaraan'));
    }

    public function printstiker($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->find($id);
        return view('admin.cetak.stiker_print', compact('data'));
    }

    public function printbukuuji($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
        return view('admin.cetak.bukuuji_print', compact('data'));
    }

    public function printbukuujihal1($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
        return view('admin.cetak.bukuujihal1_print', compact('data'));
    }

    public function printbukuujihal23($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
        return view('admin.cetak.bukuujihal23_print', compact('data'));
    }

    public function printbukuujihal45($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
        return view('admin.cetak.bukuujihal45_print', compact('data'));
    }

    public function printbukuujihal6($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
        return view('admin.cetak.bukuujihal6_print', compact('data'));
    }

    public function printbukuujihal7($id)
    {
        $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
        return view('admin.cetak.bukuujihal7_print', compact('data'));
    }

    public function printlaporanloketpendaftaran($tgl)
    {
        $tglcetak = date('d-m-Y', strtotime($tgl));
        $tglcreate = date_create($tgl);
        $hari = date_format($tglcreate,"D");
 
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
     
            case 'Mon':         
                $hari_ini = "Senin";
            break;
     
            case 'Tue':
                $hari_ini = "Selasa";
            break;
     
            case 'Wed':
                $hari_ini = "Rabu";
            break;
     
            case 'Thu':
                $hari_ini = "Kamis";
            break;
     
            case 'Fri':
                $hari_ini = "Jumat";
            break;
     
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";     
            break;
        }
        $tglprint = $hari_ini.', '.$tglcetak;

        $kendaraan  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->get();
        $tidaklulus = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('statuslulusuji','0')->get();
        
        $datajm['mobilpenumpang1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('peruntukan','Umum')->count();
        $datajm['mobilpenumpang2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('peruntukan','Tidak Umum')->count();
        $datajm['mobilpenumpang3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('peruntukan','Pemerintah')->count();

        $datajm['kendaraankhusus1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('peruntukan','Umum')->count();
        $datajm['kendaraankhusus2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('peruntukan','Tidak Umum')->count();
        $datajm['kendaraankhusus3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('peruntukan','Pemerintah')->count();

        $datajm['mobilbus1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('peruntukan','Umum')->count();
        $datajm['mobilbus2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('peruntukan','Tidak Umum')->count();
        $data['mobilbus3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('peruntukan','Pemerintah')->count();

        $datajm['mobilbarang1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('peruntukan','Umum')->count();
        $datajm['mobilbarang2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('peruntukan','Tidak Umum')->count();
        $datajm['mobilbarang3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('peruntukan','Pemerintah')->count();

        $datajm['keretatempelan1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('peruntukan','Umum')->count();
        $datajm['keretatempelan2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('peruntukan','Tidak Umum')->count();
        $datajm['keretatempelan3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('peruntukan','Pemerintah')->count();

        $datajm['keretagandeng1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('peruntukan','Umum')->count();
        $datajm['keretagandeng2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('peruntukan','Tidak Umum')->count();
        $datajm['keretagandeng3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('peruntukan','Pemerintah')->count();

        $datajm['kendaraanroda31'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','8')->where('peruntukan','Umum')->count();
        $datajm['kendaraanroda32'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','8')->where('peruntukan','Tidak Umum')->count();
        $datajm['kendaraanroda33'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','8')->where('peruntukan','Pemerintah')->count();
        return view('admin.cetak.laporanloketpendaftaran_print', ['kendaraan' => $kendaraan,'tglprint' => $tglprint, 'tidaklulus' => $tidaklulus, 'datajm' => $datajm]);
    }

    // public function printlaporanloketpendaftaranbulanan($tgl)
    // {
    //     $tglcetak = date('d-m-Y', strtotime($tgl));
    //     $tglcreate = date_create($tgl);
    //     $hari = date_format($tglcreate,"D");
    //     $bulan = date_format($tglcreate,"m");
    //     $bulanan = date_format($tglcreate,"F");
    //     $bulan = date_format($tglcreate,"Y");
 
    //     switch($hari){
    //         case 'Sun':
    //             $hari_ini = "Minggu";
    //         break;
     
    //         case 'Mon':         
    //             $hari_ini = "Senin";
    //         break;
     
    //         case 'Tue':
    //             $hari_ini = "Selasa";
    //         break;
     
    //         case 'Wed':
    //             $hari_ini = "Rabu";
    //         break;
     
    //         case 'Thu':
    //             $hari_ini = "Kamis";
    //         break;
     
    //         case 'Fri':
    //             $hari_ini = "Jumat";
    //         break;
     
    //         case 'Sat':
    //             $hari_ini = "Sabtu";
    //         break;
            
    //         default:
    //             $hari_ini = "Tidak di ketahui";     
    //         break;
    //     }
    //     $tglprint = strtoupper($bulanan).' '.$bulan;

    //     $jeniskendaraan = Jenis::all();

    //     $totaljenis = array();
    //     foreach ($jeniskendaraan as $list) {
    //         $arr = array(
    //                     'jenis'  => $list->jenis,
    //                     'ujipertama_umum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','1')->where('peruntukan','Umum')->count(),
    //                     'ujipertama_tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','1')->where('peruntukan','Tidak Umum')->count(),
    //                     'ujipertama_pemerintah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','1')->where('peruntukan','Pemerintah')->count(),
    //                     'ujiberkala_umum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','2')->where('peruntukan','Umum')->count(),
    //                     'ujiberkala_tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','2')->where('peruntukan','Tidak Umum')->count(),
    //                     'ujiberkala_pemerintah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','2')->where('peruntukan','Pemerintah')->count(),
    //                     'numpanguji_umum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','5')->where('peruntukan','Umum')->count(),
    //                     'numpanguji_tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','5')->where('peruntukan','Tidak Umum')->count(),
    //                     'numpanguji_pemerintah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','5')->where('peruntukan','Pemerintah')->count(),
    //                     'mutasi_umum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','6')->where('peruntukan','Umum')->count(),
    //                     'mutasi_tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','6')->where('peruntukan','Tidak Umum')->count(),
    //                     'mutasi_pemerintah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','6')->where('peruntukan','Pemerintah')->count(),
                        
    //                     'numpangujikeluar_umum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','9')->where('peruntukan','Umum')->count(),
    //                     'numpangujikeluar_tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','9')->where('peruntukan','Tidak Umum')->count(),
    //                     'numpangujikeluar_pemerintah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','9')->where('peruntukan','Pemerintah')->count(),
    //                     'mutasikeluar_umum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','10')->where('peruntukan','Umum')->count(),
    //                     'mutasikeluar_tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('kodepenerbitans_id','10')->where('peruntukan','Tidak Umum')->count(),
                        
    //                     );
    //         array_push($totaljenis, $arr);
    //     }

    //     return view('admin.cetak.laporanloketpendaftaranbulanan_print', ['tglprint' => $tglprint, 'totaljenis' => $totaljenis ]);
    // }

    public function printlaporanloketpendaftaranbulanan($tgl)
    {
        $tglcetak = date_create(date("d-m-Y"));
        $tglcreate = date_create($tgl);
        $hari = date_format($tglcreate,"d");
        $bulan = date_format($tglcreate,"m");
        $tahun = date_format($tglcreate,"Y");
        $hari1 = date_format($tglcetak,"d");
        $bulan1 = date_format($tglcetak,"m");
        $tahun1 = date_format($tglcetak,"Y");
 
        switch($bulan1){
            case 1:
                $bulan_ini = "Januari";
            break;
     
            case 2:         
                $bulan_ini = "Febuari";
            break;
     
            case 3:
                $bulan_ini = "Maret";
            break;
     
            case 4:
                $bulan_ini = "April";
            break;
     
            case 5:
                $bulan_ini = "Mei";
            break;
     
            case 6:
                $bulan_ini = "Juni";
            break;
     
            case 7:
                $bulan_ini = "Juli";
            break;

            case 8:
                $bulan_ini = "Juli";
            break;

            case 9:
                $bulan_ini = "Juli";
            break;

            case 10:
                $bulan_ini = "Agustus";
            break;

            case 11:
                $bulan_ini = "November";
            break;

            case 12:
                $bulan_ini = "Desember";
            break;
            
            default:
                $bulan_ini = "Tidak di ketahui";     
            break;
        }
        $tglprint = $bulan_ini;
        $tglcetak = $hari1.' '.$bulan_ini.' '.$tahun1;

        $jeniskendaraan = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->get();

        $totaljenis = array();
        foreach ($jeniskendaraan as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'jenis'         => $list->jenis,
                        'umum'          => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('peruntukan','Umum')->count(),
                        'tidakumum'     => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('peruntukan','Tidak Umum')->count(),
                        'pemerintah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('peruntukan','Pemerintah')->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $klasifikasi = klasifikasi::all();
        $totalklasifikasi = array();
        foreach ($klasifikasi as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'sifat'         => $this->getsifatbulan($bulan,$list->klasifikasis),
                        );
            array_push($totalklasifikasi, $arr);
        }

        $jumlah = array();
            $arr = array(
                        'sifat'         => $this->getsifat1bulan($bulan),
                        );
            array_push($jumlah, $arr);

        $jenispengujian = array("UJI PERTAMA","UJI ULANG","PEMERINTAH","NUMPAMG UJI", "PINDAH MASUK");
        $totalkeuangan = array();
        foreach ($jenispengujian as $list) {
            if ($list == 'UJI PERTAMA') {
                $jenis = '1';
            }elseif($list == 'UJI ULANG'){
                $jenis = '7';
            }elseif($list == 'PEMERINTAH'){
                $jenis = '12';
            }elseif($list == 'NUMPANG UJI'){
                $jenis = '5';
            }elseif($list == 'PINDAH MASUK'){
                $jenis = '6';
            }
            $arr = array(
                    'jenispengujian' => $list,
                    'jasapengujian'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('jasapengujian'),
                    'penilaianteknis'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('penilaianteknis'),
                    'denda'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('denda'),
                    'kartu'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('kartu'),
                    'perubahanstatus'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('perubahanstatus'),
                    'perubahansifat'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('perubahansifat'),
                    'emisi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('emisi'),
                    'pengujiankeliling'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('pengujiankeliling'),
                    'numpangujidanmutasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('numpangujidanmutasi'),
                    'total'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->sum('total'),
                );
            array_push($totalkeuangan, $arr);

        }
        $dayaangkutorang = array("RENTAL = 5/9 ORANG","TAKSI = 4/5 ORANG","TAKSI = 6/7 ORANG","AJDP = 6/7 ORANG","OPLET = 8/9 ORANG", "BIS = 10/12 ORANG","BIS = 13/30 ORANG", "BIS = 21/30 ORANG","BIS = 31/40 ORANG","BIS = 40 KEATAS");
        $totaldayaangkutorang = array();
        foreach ($dayaangkutorang as $list) {
            if ($list == 'RENTAL = 5/9 ORANG') {
                $jenis = 'RENTAL';
                $jmlorang1 = 300;
                $jmlorang2 = 540;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 240;
                $jmlorang2 = 300;
            }elseif ($list == 'TAKSI = 6/7 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 360;
                $jmlorang2 = 420;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 240;
                $jmlorang2 = 300;
            }elseif ($list == 'AJDP = 6/7 ORANG') {
                $jenis = 'AJDP';
                $jmlorang1 = 360;
                $jmlorang2 = 420;
            }elseif ($list == 'BIS = 10/12 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 600;
                $jmlorang2 = 720;
            }elseif ($list == 'BIS = 13/20 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 780;
                $jmlorang2 = 1200;
            }elseif ($list == 'BIS = 21/30 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 1260;
                $jmlorang2 = 1800;
            }elseif ($list == 'BIS = 31/40 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 1860;
                $jmlorang2 = 2400;
            }elseif ($list == 'BIS = 40 KEATAS') {
                $jenis = 'BIS';
                $jmlorang1 = 2400;
                $jmlorang2 = 6000;
            }
            $arr = array(
                    'dayaangkutorang' => $list,
                    '0-1'             => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','>=',$bulan-1)->count(), 
                    '2'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-2)->count(), 
                    '3'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-3)->count(), 
                    '4'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-4)->count(), 
                    '5'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-5)->count(), 
                    '6'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-6)->count(), 
                    '7'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-7)->count(), 
                    '8'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-8)->count(), 
                    '9'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-9)->count(), 
                    '10'              => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereMonth('tglpendaftaran',$bulan)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','<=',$bulan-10)->count(), 
                );
            array_push($totaldayaangkutorang, $arr);
        }

        $merek = Merek::all();
        $totalmerek = array();
        foreach ($merek as $list) {
            $arr = array(
                    'merek'          => $list->merek,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','2')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','4')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','6')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','5')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','7')->count(),
                );
            array_push($totalmerek, $arr);
        }

        $jbb = array("1","2","3","4","5","6","7","8","9","10");
        $totaljbb = array();
        foreach ($jbb as $list) {
            if ($list == '1') {
                $jbb  = "1.000 s/d 2.000";
                $daya  = "10 s/d 1.000";
                $jbb1 = 1000;
                $jbb2 = 2000;
                $daya1 = 10;
                $daya2 = 1000;
            }elseif ($list == '2') {
                $jbb  = "2.010 s/d 4.000";
                $daya = "1.010 s/d 2.000";
                $jbb1 = 2010;
                $jbb2 = 4000;
                $daya1 = 1010;
                $daya2 = 2000;
            }elseif ($list == '3') {
                $jbb  = "4.010 s/d 6.000";
                $daya = "2.010 s/d 3.000";
                $jbb1 = 4010;
                $jbb2 = 6000;
                $daya1 = 2010;
                $daya2 = 3000;
            }elseif ($list == '4') {
                $jbb  = "6.010 s/d 8.000";
                $daya = "3.010 s/d 4.000";
                $jbb1 = 6010;
                $jbb2 = 8000;
                $daya1 = 3010;
                $daya2 = 4000;
            }elseif ($list == '5') {
                $jbb  = "8.010 s/d 10.000";
                $daya = "4.010 s/d 5.000";
                $jbb1 = 8010;
                $jbb2 = 10000;
                $daya1 = 4010;
                $daya2 = 5000;
            }elseif ($list == '6') {
                $jbb  = "10.010 s/d 14.000";
                $daya = "5.010 s/d 6.000";
                $jbb1 = 10010;
                $jbb2 = 14000;
                $daya1 = 5010;
                $daya2 = 6000;
            }elseif ($list == '7') {
                $jbb  = "14.010 s/d 18.000";
                $daya = "6.010 s/d 8.000";
                $jbb1 = 14010;
                $jbb2 = 18000;
                $daya1 = 6010;
                $daya2 = 8000;
            }elseif ($list == '8') {
                $jbb  = "18.010 s/d 22.000";
                $daya = "8.010 s/d 12.000";
                $jbb1 = 18010;
                $jbb2 = 22000;
                $daya1 = 8010;
                $daya2 = 12000;
            }elseif ($list == '9') {
                $jbb  = "22.010 s/d 26.000";
                $daya = "12.010 s/d 16.000";
                $jbb1 = 22010;
                $jbb2 = 26000;
                $daya1 = 12010;
                $daya2 = 16000;
            }elseif ($list == '10') {
                $jbb  = "26.010 s/d KE ATAS";
                $daya = "16.010 s/d KE ATAS";
                $jbb1 = 26010;
                $jbb2 = 86000;
                $daya1 = 16010;
                $daya2 = 83000;
            }
            $arr = array(
                'no'            => $list,
                'jbb'           => $jbb,
                'daya'          => $daya,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','2')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','4')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','6')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','5')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','7')->count(),
                );
            array_push($totaljbb, $arr);
        }

        $wilayah =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahnu = array();
        foreach ($wilayah as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnu, $arr);
        }

        $wilayahnu = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('peruntukan','Umum')->where('namawilayah','like','%'.'DUMAI'.'%')->where('kodepenerbitans_id','5')->get();
        $totalwilayahnuall = array();
        foreach ($wilayahnu as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnuall, $arr);
        }

        $wilayahmu =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahmu = array();
        foreach ($wilayahmu as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmu, $arr);
        }

        $wilayahmu = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('peruntukan','Umum')->where('namawilayah','like','%'.'DUMAI'.'%')->where('kodepenerbitans_id','5')->get();
        $totalwilayahmuall = array();
        foreach ($wilayahmu as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereMonth('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmuall, $arr);
        }

        return view('admin.cetak.laporanloketpendaftaranbulanan_print', ['tglprint' => $tglprint,'tglcetak' => $tglcetak, 'totaljenis' => $totaljenis, 'totalklasifikasi' => $totalklasifikasi, 'jumlah' => $jumlah, 'totaldayaangkutorang' => $totaldayaangkutorang, 'totalmerek' => $totalmerek, 'totaljbb' => $totaljbb, 'totalwilayahnu' => $totalwilayahnu, 'totalwilayahnuall' => $totalwilayahnuall, 'totalwilayahmu' => $totalwilayahmu, 'totalwilayahmuall' => $totalwilayahmuall, 'totalkeuangan' => $totalkeuangan ]);
    }

    public function printlaporanloketpendaftarantriwulan($tgl1,$tgl2)
    {
        $tglcetak = date_create(date("d-m-Y"));
        $tglcreate1 = date_create($tgl1);
        $tglcreate2 = date_create($tgl2);
        $hari1 = date_format($tglcreate1,"d");
        $bulan = date_format($tglcreate1,"m");
        $tahun1 = date_format($tglcreate1,"Y");

        $hari2 = date_format($tglcreate1,"d");
        $bulan2 = date_format($tglcreate2,"m");
        $tahun2 = date_format($tglcreate2,"Y");
        $hari3 = date_format($tglcetak,"d");
        $bulan3 = date_format($tglcetak,"m");
        $tahun3 = date_format($tglcetak,"Y");

        $tglcreate1 = "'".$tahun1."-".$bulan."-".$hari1."'";
        $tglcreate2 = "'".$tahun2."-".$bulan2."-31'";
 
        switch($bulan){
            case 1:
                $bulan_ini = "Januari";
            break;
     
            case 2:         
                $bulan_ini = "Febuari";
            break;
     
            case 3:
                $bulan_ini = "Maret";
            break;
     
            case 4:
                $bulan_ini = "April";
            break;
     
            case 5:
                $bulan_ini = "Mei";
            break;
     
            case 6:
                $bulan_ini = "Juni";
            break;
     
            case 7:
                $bulan_ini = "Juli";
            break;

            case 8:
                $bulan_ini = "Juli";
            break;

            case 9:
                $bulan_ini = "Juli";
            break;

            case 10:
                $bulan_ini = "Agustus";
            break;

            case 11:
                $bulan_ini = "November";
            break;

            case 12:
                $bulan_ini = "Desember";
            break;
            
            default:
                $bulan_ini = "Tidak di ketahui";     
            break;
        }

        switch($bulan2){
            case 1:
                $bulan_ini2 = "Januari";
            break;
     
            case 2:         
                $bulan_ini2 = "Febuari";
            break;
     
            case 3:
                $bulan_ini2 = "Maret";
            break;
     
            case 4:
                $bulan_ini2 = "April";
            break;
     
            case 5:
                $bulan_ini2 = "Mei";
            break;
     
            case 6:
                $bulan_ini2 = "Juni";
            break;
     
            case 7:
                $bulan_ini2 = "Juli";
            break;

            case 8:
                $bulan_ini2 = "Juli";
            break;

            case 9:
                $bulan_ini2 = "Juli";
            break;

            case 10:
                $bulan_ini2 = "Agustus";
            break;

            case 11:
                $bulan_ini2 = "November";
            break;

            case 12:
                $bulan_ini2 = "Desember";
            break;
            
            default:
                $bulan_ini2 = "Tidak di ketahui";     
            break;
        }
        switch($bulan3){
            case 1:
                $bulan_ini3 = "Januari";
            break;
     
            case 2:         
                $bulan_ini3 = "Febuari";
            break;
     
            case 3:
                $bulan_ini3 = "Maret";
            break;
     
            case 4:
                $bulan_ini3 = "April";
            break;
     
            case 5:
                $bulan_ini3 = "Mei";
            break;
     
            case 6:
                $bulan_ini3 = "Juni";
            break;
     
            case 7:
                $bulan_ini3 = "Juli";
            break;

            case 8:
                $bulan_ini3 = "Juli";
            break;

            case 9:
                $bulan_ini3 = "Juli";
            break;

            case 10:
                $bulan_ini3 = "Agustus";
            break;

            case 11:
                $bulan_ini3 = "November";
            break;

            case 12:
                $bulan_ini3 = "Desember";
            break;
            
            default:
                $bulan_ini3 = "Tidak di ketahui";     
            break;
        }
        $tglprint = $bulan_ini.'-'.$bulan_ini2;
        $tglcetak = $hari3.' '.$bulan_ini3.' '.$tahun3;

        $jeniskendaraan = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->get();

        $totaljenis = array();
        foreach ($jeniskendaraan as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'jenis'         => $list->jenis,
                        'umum'          => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis',$list->jenis)->where('peruntukan','Umum')->count(),
                        'tidakumum'     => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis',$list->jenis)->where('peruntukan','Tidak Umum')->count(),
                        'pemerintah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis',$list->jenis)->where('peruntukan','Pemerintah')->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $klasifikasi = klasifikasi::all();
        $totalklasifikasi = array();
        foreach ($klasifikasi as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'sifat'         => $this->getsifatbulan($bulan,$list->klasifikasis),
                        );
            array_push($totalklasifikasi, $arr);
        }

        $jumlah = array();
            $arr = array(
                        'sifat'         => $this->getsifat1bulan($bulan),
                        );
            array_push($jumlah, $arr);

        $jenispengujian = array("UJI PERTAMA","UJI ULANG","PEMERINTAH","NUMPAMG UJI", "PINDAH MASUK");
        $totalkeuangan = array();
        foreach ($jenispengujian as $list) {
            if ($list == 'UJI PERTAMA') {
                $jenis = '1';
            }elseif($list == 'UJI ULANG'){
                $jenis = '7';
            }elseif($list == 'PEMERINTAH'){
                $jenis = '12';
            }elseif($list == 'NUMPANG UJI'){
                $jenis = '5';
            }elseif($list == 'PINDAH MASUK'){
                $jenis = '6';
            }
            $arr = array(
                    'jenispengujian' => $list,
                    'jasapengujian'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('jasapengujian'),
                    'penilaianteknis'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('penilaianteknis'),
                    'denda'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('denda'),
                    'kartu'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('kartu'),
                    'perubahanstatus'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('perubahanstatus'),
                    'perubahansifat'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('perubahansifat'),
                    'emisi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('emisi'),
                    'pengujiankeliling'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('pengujiankeliling'),
                    'numpangujidanmutasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('numpangujidanmutasi'),
                    'total'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->sum('total'),
                );
            array_push($totalkeuangan, $arr);

        }
        $dayaangkutorang = array("RENTAL = 5/9 ORANG","TAKSI = 4/5 ORANG","TAKSI = 6/7 ORANG","AJDP = 6/7 ORANG","OPLET = 8/9 ORANG", "BIS = 10/12 ORANG","BIS = 13/30 ORANG", "BIS = 21/30 ORANG","BIS = 31/40 ORANG","BIS = 40 KEATAS");
        $totaldayaangkutorang = array();
        foreach ($dayaangkutorang as $list) {
            if ($list == 'RENTAL = 5/9 ORANG') {
                $jenis = 'RENTAL';
                $jmlorang1 = 300;
                $jmlorang2 = 540;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 240;
                $jmlorang2 = 300;
            }elseif ($list == 'TAKSI = 6/7 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 360;
                $jmlorang2 = 420;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 240;
                $jmlorang2 = 300;
            }elseif ($list == 'AJDP = 6/7 ORANG') {
                $jenis = 'AJDP';
                $jmlorang1 = 360;
                $jmlorang2 = 420;
            }elseif ($list == 'BIS = 10/12 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 600;
                $jmlorang2 = 720;
            }elseif ($list == 'BIS = 13/20 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 780;
                $jmlorang2 = 1200;
            }elseif ($list == 'BIS = 21/30 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 1260;
                $jmlorang2 = 1800;
            }elseif ($list == 'BIS = 31/40 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 1860;
                $jmlorang2 = 2400;
            }elseif ($list == 'BIS = 40 KEATAS') {
                $jenis = 'BIS';
                $jmlorang1 = 2400;
                $jmlorang2 = 6000;
            }
            $arr = array(
                    'dayaangkutorang' => $list,
                    '0-1'             => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','>=',$bulan-1)->count(), 
                    '2'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-2)->count(), 
                    '3'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-3)->count(), 
                    '4'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-4)->count(), 
                    '5'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-5)->count(), 
                    '6'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-6)->count(), 
                    '7'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-7)->count(), 
                    '8'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-8)->count(), 
                    '9'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$bulan-9)->count(), 
                    '10'              => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','<=',$bulan-10)->count(), 
                );
            array_push($totaldayaangkutorang, $arr);
        }

        $merek = Merek::all();
        $totalmerek = array();
        foreach ($merek as $list) {
            $arr = array(
                    'merek'          => $list->merek,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','2')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','4')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','6')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','5')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','7')->count(),
                );
            array_push($totalmerek, $arr);
        }

        $jbb = array("1","2","3","4","5","6","7","8","9","10");
        $totaljbb = array();
        foreach ($jbb as $list) {
            if ($list == '1') {
                $jbb  = "1.000 s/d 2.000";
                $daya  = "10 s/d 1.000";
                $jbb1 = 1000;
                $jbb2 = 2000;
                $daya1 = 10;
                $daya2 = 1000;
            }elseif ($list == '2') {
                $jbb  = "2.010 s/d 4.000";
                $daya = "1.010 s/d 2.000";
                $jbb1 = 2010;
                $jbb2 = 4000;
                $daya1 = 1010;
                $daya2 = 2000;
            }elseif ($list == '3') {
                $jbb  = "4.010 s/d 6.000";
                $daya = "2.010 s/d 3.000";
                $jbb1 = 4010;
                $jbb2 = 6000;
                $daya1 = 2010;
                $daya2 = 3000;
            }elseif ($list == '4') {
                $jbb  = "6.010 s/d 8.000";
                $daya = "3.010 s/d 4.000";
                $jbb1 = 6010;
                $jbb2 = 8000;
                $daya1 = 3010;
                $daya2 = 4000;
            }elseif ($list == '5') {
                $jbb  = "8.010 s/d 10.000";
                $daya = "4.010 s/d 5.000";
                $jbb1 = 8010;
                $jbb2 = 10000;
                $daya1 = 4010;
                $daya2 = 5000;
            }elseif ($list == '6') {
                $jbb  = "10.010 s/d 14.000";
                $daya = "5.010 s/d 6.000";
                $jbb1 = 10010;
                $jbb2 = 14000;
                $daya1 = 5010;
                $daya2 = 6000;
            }elseif ($list == '7') {
                $jbb  = "14.010 s/d 18.000";
                $daya = "6.010 s/d 8.000";
                $jbb1 = 14010;
                $jbb2 = 18000;
                $daya1 = 6010;
                $daya2 = 8000;
            }elseif ($list == '8') {
                $jbb  = "18.010 s/d 22.000";
                $daya = "8.010 s/d 12.000";
                $jbb1 = 18010;
                $jbb2 = 22000;
                $daya1 = 8010;
                $daya2 = 12000;
            }elseif ($list == '9') {
                $jbb  = "22.010 s/d 26.000";
                $daya = "12.010 s/d 16.000";
                $jbb1 = 22010;
                $jbb2 = 26000;
                $daya1 = 12010;
                $daya2 = 16000;
            }elseif ($list == '10') {
                $jbb  = "26.010 s/d KE ATAS";
                $daya = "16.010 s/d KE ATAS";
                $jbb1 = 26010;
                $jbb2 = 86000;
                $daya1 = 16010;
                $daya2 = 83000;
            }
            $arr = array(
                'no'            => $list,
                'jbb'           => $jbb,
                'daya'          => $daya,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','2')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','4')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','6')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','5')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','7')->count(),
                );
            array_push($totaljbb, $arr);
        }

        $wilayah =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahnu = array();
        foreach ($wilayah as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnu, $arr);
        }

        $wilayahnu = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('peruntukan','Umum')->where('namawilayah','like','%'.'DUMAI'.'%')->where('kodepenerbitans_id','5')->get();
        $totalwilayahnuall = array();
        foreach ($wilayahnu as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnuall, $arr);
        }

        $wilayahmu =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahmu = array();
        foreach ($wilayahmu as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmu, $arr);
        }

        $wilayahmu = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('peruntukan','Umum')->where('namawilayah','like','%'.'DUMAI'.'%')->where('kodepenerbitans_id','5')->get();
        $totalwilayahmuall = array();
        foreach ($wilayahmu as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmuall, $arr);
        }

        return view('admin.cetak.laporanloketpendaftarantriwulan_print', ['tglprint' => $tglprint,'tglcetak' => $tglcetak, 'totaljenis' => $totaljenis, 'totalklasifikasi' => $totalklasifikasi, 'jumlah' => $jumlah, 'totaldayaangkutorang' => $totaldayaangkutorang, 'totalmerek' => $totalmerek, 'totaljbb' => $totaljbb, 'totalwilayahnu' => $totalwilayahnu, 'totalwilayahnuall' => $totalwilayahnuall, 'totalwilayahmu' => $totalwilayahmu, 'totalwilayahmuall' => $totalwilayahmuall, 'totalkeuangan' => $totalkeuangan ]);
    }

    public function printlaporanloketpendaftarantahunan($tgl)
    {
        $tglcetak = date('d-m-Y', strtotime($tgl));
        $tglcreate = date_create($tgl);
        $hari = date_format($tglcreate,"d");
        $bulan = date_format($tglcreate,"m");
        $tahun = date_format($tglcreate,"Y");
 
        switch($bulan){
            case 1:
                $bulan_ini = "Januari";
            break;
     
            case 2:         
                $bulan_ini = "Febuari";
            break;
     
            case 3:
                $bulan_ini = "Maret";
            break;
     
            case 4:
                $bulan_ini = "April";
            break;
     
            case 5:
                $bulan_ini = "Mei";
            break;
     
            case 6:
                $bulan_ini = "Juni";
            break;
     
            case 7:
                $bulan_ini = "Juli";
            break;

            case 8:
                $bulan_ini = "Juli";
            break;

            case 9:
                $bulan_ini = "Juli";
            break;

            case 10:
                $bulan_ini = "Agustus";
            break;

            case 11:
                $bulan_ini = "November";
            break;

            case 12:
                $bulan_ini = "Desember";
            break;
            
            default:
                $bulan_ini = "Tidak di ketahui";     
            break;
        }
        $tglprint = $tahun;
        $tglcetak = $hari.' '.$bulan_ini.' '.$tahun;

        $jeniskendaraan = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->get();

        $totaljenis = array();
        foreach ($jeniskendaraan as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'jenis'         => $list->jenis,
                        'umum'          => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$list->jenis)->where('peruntukan','Umum')->count(),
                        'tidakumum'     => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$list->jenis)->where('peruntukan','Tidak Umum')->count(),
                        'pemerintah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$list->jenis)->where('peruntukan','Pemerintah')->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $klasifikasi = klasifikasi::all();
        $totalklasifikasi = array();
        foreach ($klasifikasi as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'sifat'         => $this->getsifat($tahun,$list->klasifikasis),
                        );
            array_push($totalklasifikasi, $arr);
        }

        $jumlah = array();
            $arr = array(
                        'sifat'         => $this->getsifat1($tahun),
                        );
            array_push($jumlah, $arr);

        $jenispengujian = array("UJI PERTAMA","UJI ULANG","PEMERINTAH","NUMPAMG UJI", "PINDAH MASUK");
        $totalkeuangan = array();
        foreach ($jenispengujian as $list) {
            if ($list == 'UJI PERTAMA') {
                $jenis = '1';
            }elseif($list == 'UJI ULANG'){
                $jenis = '7';
            }elseif($list == 'PEMERINTAH'){
                $jenis = '12';
            }elseif($list == 'NUMPANG UJI'){
                $jenis = '5';
            }elseif($list == 'PINDAH MASUK'){
                $jenis = '6';
            }
            $arr = array(
                    'jenispengujian' => $list,
                    'jasapengujian'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('jasapengujian'),
                    'penilaianteknis'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->sum('penilaianteknis'),
                    'denda'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('denda'),
                    'kartu'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('kartu'),
                    'perubahanstatus'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('perubahanstatus'),
                    'perubahansifat'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('perubahansifat'),
                    'emisi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('emisi'),
                    'pengujiankeliling'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('pengujiankeliling'),
                    'numpangujidanmutasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('numpangujidanmutasi'),
                    'total'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->sum('total'),
                );
            array_push($totalkeuangan, $arr);

        }
        $dayaangkutorang = array("RENTAL = 5/9 ORANG","TAKSI = 4/5 ORANG","TAKSI = 6/7 ORANG","AJDP = 6/7 ORANG","OPLET = 8/9 ORANG", "BIS = 10/12 ORANG","BIS = 13/30 ORANG", "BIS = 21/30 ORANG","BIS = 31/40 ORANG","BIS = 40 KEATAS");
        $totaldayaangkutorang = array();
        foreach ($dayaangkutorang as $list) {
            if ($list == 'RENTAL = 5/9 ORANG') {
                $jenis = 'RENTAL';
                $jmlorang1 = 300;
                $jmlorang2 = 540;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 240;
                $jmlorang2 = 300;
            }elseif ($list == 'TAKSI = 6/7 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 360;
                $jmlorang2 = 420;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 240;
                $jmlorang2 = 300;
            }elseif ($list == 'AJDP = 6/7 ORANG') {
                $jenis = 'AJDP';
                $jmlorang1 = 360;
                $jmlorang2 = 420;
            }elseif ($list == 'BIS = 10/12 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 600;
                $jmlorang2 = 720;
            }elseif ($list == 'BIS = 13/20 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 780;
                $jmlorang2 = 1200;
            }elseif ($list == 'BIS = 21/30 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 1260;
                $jmlorang2 = 1800;
            }elseif ($list == 'BIS = 31/40 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 1860;
                $jmlorang2 = 2400;
            }elseif ($list == 'BIS = 40 KEATAS') {
                $jenis = 'BIS';
                $jmlorang1 = 2400;
                $jmlorang2 = 6000;
            }
            $arr = array(
                    'dayaangkutorang' => $list,
                    '0-1'             => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','>=',$tahun-1)->count(), 
                    '2'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-2)->count(), 
                    '3'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-3)->count(), 
                    '4'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-4)->count(), 
                    '5'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-5)->count(), 
                    '6'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-6)->count(), 
                    '7'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-7)->count(), 
                    '8'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-8)->count(), 
                    '9'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-9)->count(), 
                    '10'              => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','<=',$tahun-10)->count(), 
                );
            array_push($totaldayaangkutorang, $arr);
        }

        $merek = Merek::all();
        $totalmerek = array();
        foreach ($merek as $list) {
            $arr = array(
                    'merek'          => $list->merek,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','2')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','4')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','6')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','5')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','7')->count(),
                );
            array_push($totalmerek, $arr);
        }

        $jbb = array("1","2","3","4","5","6","7","8","9","10");
        $totaljbb = array();
        foreach ($jbb as $list) {
            if ($list == '1') {
                $jbb  = "1.000 s/d 2.000";
                $daya  = "10 s/d 1.000";
                $jbb1 = 1000;
                $jbb2 = 2000;
                $daya1 = 10;
                $daya2 = 1000;
            }elseif ($list == '2') {
                $jbb  = "2.010 s/d 4.000";
                $daya = "1.010 s/d 2.000";
                $jbb1 = 2010;
                $jbb2 = 4000;
                $daya1 = 1010;
                $daya2 = 2000;
            }elseif ($list == '3') {
                $jbb  = "4.010 s/d 6.000";
                $daya = "2.010 s/d 3.000";
                $jbb1 = 4010;
                $jbb2 = 6000;
                $daya1 = 2010;
                $daya2 = 3000;
            }elseif ($list == '4') {
                $jbb  = "6.010 s/d 8.000";
                $daya = "3.010 s/d 4.000";
                $jbb1 = 6010;
                $jbb2 = 8000;
                $daya1 = 3010;
                $daya2 = 4000;
            }elseif ($list == '5') {
                $jbb  = "8.010 s/d 10.000";
                $daya = "4.010 s/d 5.000";
                $jbb1 = 8010;
                $jbb2 = 10000;
                $daya1 = 4010;
                $daya2 = 5000;
            }elseif ($list == '6') {
                $jbb  = "10.010 s/d 14.000";
                $daya = "5.010 s/d 6.000";
                $jbb1 = 10010;
                $jbb2 = 14000;
                $daya1 = 5010;
                $daya2 = 6000;
            }elseif ($list == '7') {
                $jbb  = "14.010 s/d 18.000";
                $daya = "6.010 s/d 8.000";
                $jbb1 = 14010;
                $jbb2 = 18000;
                $daya1 = 6010;
                $daya2 = 8000;
            }elseif ($list == '8') {
                $jbb  = "18.010 s/d 22.000";
                $daya = "8.010 s/d 12.000";
                $jbb1 = 18010;
                $jbb2 = 22000;
                $daya1 = 8010;
                $daya2 = 12000;
            }elseif ($list == '9') {
                $jbb  = "22.010 s/d 26.000";
                $daya = "12.010 s/d 16.000";
                $jbb1 = 22010;
                $jbb2 = 26000;
                $daya1 = 12010;
                $daya2 = 16000;
            }elseif ($list == '10') {
                $jbb  = "26.010 s/d KE ATAS";
                $daya = "16.010 s/d KE ATAS";
                $jbb1 = 26010;
                $jbb2 = 86000;
                $daya1 = 16010;
                $daya2 = 83000;
            }
            $arr = array(
                'no'            => $list,
                'jbb'           => $jbb,
                'daya'          => $daya,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','2')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','4')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','6')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','5')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','7')->count(),
                );
            array_push($totaljbb, $arr);
        }

        $wilayah =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahnu = array();
        foreach ($wilayah as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnu, $arr);
        }

        $wilayahnu = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('peruntukan','Umum')->where('namawilayah','like','%'.'DUMAI'.'%')->where('kodepenerbitans_id','5')->get();
        $totalwilayahnuall = array();
        foreach ($wilayahnu as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnuall, $arr);
        }

        $wilayahmu =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahmu = array();
        foreach ($wilayahmu as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmu, $arr);
        }

        $wilayahmu = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('peruntukan','Umum')->where('namawilayah','like','%'.'DUMAI'.'%')->where('kodepenerbitans_id','5')->get();
        $totalwilayahmuall = array();
        foreach ($wilayahmu as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayah')->whereYear('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmuall, $arr);
        }

        return view('admin.cetak.laporanloketpendaftarantahunan_print', ['tglprint' => $tglprint,'tglcetak' => $tglcetak, 'totaljenis' => $totaljenis, 'totalklasifikasi' => $totalklasifikasi, 'jumlah' => $jumlah, 'totaldayaangkutorang' => $totaldayaangkutorang, 'totalmerek' => $totalmerek, 'totaljbb' => $totaljbb, 'totalwilayahnu' => $totalwilayahnu, 'totalwilayahnuall' => $totalwilayahnuall, 'totalwilayahmu' => $totalwilayahmu, 'totalwilayahmuall' => $totalwilayahmuall, 'totalkeuangan' => $totalkeuangan ]);
    }

    protected function getsifat($tahun, $jenis){
        $sifat = array("UMUM","TIDAK UMUM","PEMERINTAH");
        $totalsifat = array();
        foreach ($sifat as $list) {
            $arr = array(
                        'sifat'        => $list,
                        'thlalu'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun-1)->where('klasifikasis.klasifikasis',$jenis)->where('peruntukan',$list)->count(),
                        'ujipertama'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','1')->where('peruntukan',$list)->count(),
                        'berubahjenis' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','8')->where('peruntukan',$list)->count(),
                        'berubahsifat' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','11')->where('peruntukan',$list)->count(),
                        'mutasimasuk'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','6')->where('peruntukan',$list)->count(),
                        'numpangujikeluar'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','9')->where('peruntukan',$list)->count(),
                        'berubahjeniskeluar' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenislama')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','8')->where('peruntukan',$list)->count(),
                        'berubahsifatkeluar' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','11')->where('sifatlama',$list)->count(),
                        'mutasikeluar'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','10')->where('peruntukan',$list)->count(),
                        'afkirkeluar'        => '0',
                        );
            array_push($totalsifat, $arr);
        }

        return $totalsifat;
    }

    protected function getsifat1($tahun){
        $sifat = array("UMUM","TIDAK UMUM","PEMERINTAH");
        $totalsifat1 = array();
        foreach ($sifat as $list) {
            $arr = array(
                        'sifat'        => $list,
                        'thlalu'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun-1)->where('peruntukan',$list)->count(),
                        'ujipertama'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','1')->where('peruntukan',$list)->count(),
                        'berubahjenis' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','8')->where('peruntukan',$list)->count(),
                        'berubahsifat' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','11')->where('peruntukan',$list)->count(),
                        'mutasimasuk'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','6')->where('peruntukan',$list)->count(),
                        'numpangujikeluar'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','9')->where('peruntukan',$list)->count(),
                        'berubahjeniskeluar' => '0',
                        'berubahsifatkeluar' => '0',
                        'mutasikeluar'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','10')->where('peruntukan',$list)->count(),
                        'afkirkeluar'        => '0',
                        );
            array_push($totalsifat1, $arr);
        }

        return $totalsifat1;
    }

    protected function getsifatbulan($bulan, $jenis){
        $sifat = array("UMUM","TIDAK UMUM","PEMERINTAH");
        $totalsifat = array();
        foreach ($sifat as $list) {
            $arr = array(
                        'sifat'        => $list,
                        'thlalu'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan-1)->where('klasifikasis.klasifikasis',$jenis)->where('peruntukan',$list)->count(),
                        'ujipertama'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','1')->where('peruntukan',$list)->count(),
                        'berubahjenis' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','8')->where('peruntukan',$list)->count(),
                        'berubahsifat' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','11')->where('peruntukan',$list)->count(),
                        'mutasimasuk'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','6')->where('peruntukan',$list)->count(),
                        'numpangujikeluar'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','9')->where('peruntukan',$list)->count(),
                        'berubahjeniskeluar' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenislama')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','8')->where('peruntukan',$list)->count(),
                        'berubahsifatkeluar' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','11')->where('sifatlama',$list)->count(),
                        'mutasikeluar'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis.klasifikasis',$jenis)->where('kodepenerbitans_id','10')->where('peruntukan',$list)->count(),
                        'afkirkeluar'        => '0',
                        );
            array_push($totalsifat, $arr);
        }

        return $totalsifat;
    }

    protected function getsifat1bulan($bulan){
        $sifat = array("UMUM","TIDAK UMUM","PEMERINTAH");
        $totalsifat1 = array();
        foreach ($sifat as $list) {
            $arr = array(
                        'sifat'        => $list,
                        'thlalu'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan-1)->where('peruntukan',$list)->count(),
                        'ujipertama'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','1')->where('peruntukan',$list)->count(),
                        'berubahjenis' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','8')->where('peruntukan',$list)->count(),
                        'berubahsifat' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','11')->where('peruntukan',$list)->count(),
                        'mutasimasuk'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','6')->where('peruntukan',$list)->count(),
                        'numpangujikeluar'   => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','9')->where('peruntukan',$list)->count(),
                        'berubahjeniskeluar' => '0',
                        'berubahsifatkeluar' => '0',
                        'mutasikeluar'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','10')->where('peruntukan',$list)->count(),
                        'afkirkeluar'        => '0',
                        );
            array_push($totalsifat1, $arr);
        }

        return $totalsifat1;
    }


}
