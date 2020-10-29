<?php

namespace App\Http\Controllers;
use App\Pendaftaran;
use App\Datakendaraan;
use App\Identitaskendaraan;
use App\Kodewilayah;
use App\Kodepenerbitan;
use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;

class PendaftaranController extends Controller
{
    public function index()
    {
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
        $kendaraans = Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglbayar',date("Y-m-d"))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function indextransall()
    {
        $kendaraans = Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->get();
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
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos1','1')->where('pos2','1')->orWhere('pos1','2')->orWhere('pos2','2')->where('tglpendaftaran',date('Y-m-d'))->get();
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
            $kode='BJBR'; 
        }

        if ($request->kodewilayahasal == '') {
            $kodeasal='BJBR'; 
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

        $cekkendaraan = Pendaftaran::leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('pendaftarans.id',$id)->first();
        $identitaskendaraan_id= $cekkendaraan->identitaskendaraan_id;
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
        $kendaraan = Pendaftaran::with(['identitaskendaraan'])->find($id)->orderBy('id','asc')->first();
        $wilayah = Kodewilayah::select('namawilayah')->where('kodewilayah',$kendaraan->identitaskendaraan->kodewilayah)->first();
        // return response()->json(['kendaraan' => $wilayah]);
        return view('admin.cetak.nk_print', compact('kendaraan'), compact('wilayah'));
    }

    public function printMT($id)
    {
        $kendaraan = Pendaftaran::with(['identitaskendaraan'])->find($id)->orderBy('id','asc')->first();
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
        $kendaraan = Pendaftaran::with(['identitaskendaraan'])->find($id);
        return view('admin.cetak.lmbrpemeriksaan_print', compact('kendaraan'));
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

        $umum       = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('peruntukan','Umum')->count();
        $tidakumum  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('peruntukan','Tidak Umum')->count();
        $kendaraan  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->where('tglpendaftaran',$tgl)->get();
        $lulus      = Pendaftaran::leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('statuslulusuji','1')->count();
        $tidaklulus = Pendaftaran::leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('statuslulusuji','0')->count();
        $jeniskendaraan = Jenis::all();
        $jenispelayanan = kodepenerbitan::all();

        $totaljenis = array();
        foreach ($jeniskendaraan as $jenis) {
            $arr = array(
                        'jenis'  => $jenis->jenis,
                        'jumlah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('jenis',$jenis->jenis)->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $pelayanan = array();
        foreach ($jenispelayanan as $data) {
            $arr = array(
                        'jenispelayanan'  => $data->keterangan,
                        'jumlah' => Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->where('tglpendaftaran',$tgl)->where('keterangan',$data->keterangan)->count(),
                        );
            array_push($pelayanan, $arr);
        }
        return view('admin.cetak.laporanloketpendaftaran_print', ['kendaraan' => $kendaraan,'tglprint' => $tglprint, 'umum' => $umum, 'tidakumum' => $tidakumum, 'lulus' => $lulus, 'tidaklulus' => $tidaklulus, 'jenis' => $totaljenis, 'jenispelayanan' => $pelayanan ]);
    }

    public function printlaporanloketpendaftaranbulanan($tgl)
    {
        $tglcetak = date('d-m-Y', strtotime($tgl));
        $tglcreate = date_create($tgl);
        $hari = date_format($tglcreate,"D");
        $bulan = date_format($tglcreate,"m");
        $bulanan = date_format($tglcreate,"F");
        $tahun = date_format($tglcreate,"Y");
 
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
        $tglprint = strtoupper($bulanan);

        $umum       = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Umum')->count();
        $tidakumum  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Tidak Umum')->count();
        $lulus      = Pendaftaran::leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('statuslulusuji','1')->count();
        $tidaklulus = Pendaftaran::leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('statuslulusuji','0')->count();
        $jeniskendaraan = Jenis::all();
        $jenispelayanan = kodepenerbitan::all();

        $totaljenis = array();
        foreach ($jeniskendaraan as $jenis) {
            $arr = array(
                        'jenis'  => $jenis->jenis,
                        'jumlah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('jenis',$jenis->jenis)->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $pelayanan = array();
        foreach ($jenispelayanan as $data) {
            $arr = array(
                        'jenispelayanan'  => $data->keterangan,
                        'jumlah' => Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('keterangan',$data->keterangan)->count(),
                        );
            array_push($pelayanan, $arr);
        }
        return view('admin.cetak.laporanloketpendaftaranbulanan_print', ['tglprint' => $tglprint, 'umum' => $umum, 'tidakumum' => $tidakumum, 'lulus' => $lulus, 'tidaklulus' => $tidaklulus, 'jenis' => $totaljenis, 'jenispelayanan' => $pelayanan ]);
    }

    public function printlaporanloketpendaftarantahunan($tgl)
    {
        $tglcetak = date('d-m-Y', strtotime($tgl));
        $tglcreate = date_create($tgl);
        $hari = date_format($tglcreate,"D");
        $bulan = date_format($tglcreate,"m");
        $tahun = date_format($tglcreate,"Y");
 
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
        $tglprint = $tahun;

        $umum       = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Umum')->count();
        $tidakumum  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Tidak Umum')->count();
        $lulus      = Pendaftaran::leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('statuslulusuji','1')->count();
        $tidaklulus = Pendaftaran::leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('statuslulusuji','0')->count();
        $jeniskendaraan = Jenis::all();
        $jenispelayanan = kodepenerbitan::all();

        $totaljenis = array();
        foreach ($jeniskendaraan as $jenis) {
            $arr = array(
                        'jenis'  => $jenis->jenis,
                        'jumlah' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$jenis->jenis)->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $pelayanan = array();
        foreach ($jenispelayanan as $data) {
            $arr = array(
                        'jenispelayanan'  => $data->keterangan,
                        'jumlah' => Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->whereYear('tglpendaftaran',$tahun)->where('keterangan',$data->keterangan)->count(),
                        );
            array_push($pelayanan, $arr);
        }
        return view('admin.cetak.laporanloketpendaftaranbulanan_print', ['tglprint' => $tglprint, 'umum' => $umum, 'tidakumum' => $tidakumum, 'lulus' => $lulus, 'tidaklulus' => $tidaklulus, 'jenis' => $totaljenis, 'jenispelayanan' => $pelayanan ]);
    }


}
