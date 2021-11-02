<?php

namespace App\Http\Controllers;
use App\Pendaftaran;
use App\Datakendaraan;
use App\SettingAmprah;
use App\Identitaskendaraan;
use App\Datapengujian;
use App\Datapengujianlama;
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
        $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('tglbayar',date("Y-m-d"))->get();
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
        $kendaraans = Identitaskendaraan::leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->where('statuslulusuji','0')->where('pos1','>=','1')->where('pos2','>=','1')->where('verif','n')->where('tglpendaftaran',date('Y-m-d'))->get();
        return response()->json(['kendaraans'=> $kendaraans]);
    }

    public function verifall()
    {
        // $kendaraans = Pendaftaran::with('kodepenerbitans','identitaskendaraan')->where('pos1','>=','1')->where('pos2','>=','1')->get();
        $kendaraans = Identitaskendaraan::select('pendaftarans.id','identitaskendaraans.noregistrasikendaraan','identitaskendaraans.nouji','identitaskendaraans.nama','identitaskendaraans.noregistrasikendaraan','kodepenerbitans.keterangan','pendaftarans.pos1','pendaftarans.pos2','pengujians.statuslulusuji','pengujians.pendaftaran_id')->leftJoin('datakendaraans','identitaskendaraans.id','=','datakendaraans.identitaskendaraan_id')->leftJoin('pendaftarans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pendaftarans.id','=','pengujians.pendaftaran_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->where('pos1','>=','1')->where('pos2','>=','1')->groupBy('pendaftarans.id')->orderBy('tglpendaftaran','desc')->get();
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
            $kode='DUMAI'; 
        }

        if ($request->kodewilayahasal == '') {
            $kodeasal='DUMAI'; 
        }
        
       

        // print_r($kode);

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
            'dayamotorpenggerak'    => $request->dayamotorpenggerak,
            'idkepaladinas'         => '390',
            'iddirektur'            => '18',
            'kodewilayah'           => $kode,
            'kodewilayahasal'       => $kodeasal,
            ]);

            Pendaftaran::create([
            'identitaskendaraan_id' => $data->id,
            'tglpendaftaran'        => $request->tglpendaftaran,
            'tglbayar'              => $request->tglbayar,
            'noamprah'              => $request->noamprah,
            'tglamprah'             => $request->tglamprah,
            'masaberlakuuji'        => $request->masaberlakuuji,
            'kodepenerbitans_id'    => $jenispendaftaran,
            'jenispendaftaran'                 => 'ots',
            'verif'                 => 'n',
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
            'panjangkendaraan'      => $request->panjangkendaraan,
            'lebarkendaraan'        => $request->lebarkendaraan,
            'tinggikendaraan'       => $request->tinggikendaraan,
            'panjangbakatautangki'  => $request->panjangbakatautangki,
            'lebarbakatautangki'    => $request->lebarbakatautangki,
            'tinggibakatautangki'   => $request->tinggibakatautangki,
            'dayaangkutorang'       => $request->dayaangkutorang,
            'dayaangkutbarang'      => $request->dayaangkutbarang,
            'mst'                   => $request->mst,
            'julurdepan'            => $request->julurdepan,
            'julurbelakang'         => $request->julurbelakang,
            'groundclearance'       => $request->groundclearance,
            ]);
        }
        else{
            
            $cekkendaraan = Identitaskendaraan::where('identitaskendaraans.nouji',$request->nouji)->first();
            $identitaskendaraan_id= $cekkendaraan->id;
            $pendaftaran = Pendaftaran::where('identitaskendaraan_id', $identitaskendaraan_id)->where('tglpendaftaran',$request->tglpendaftaran)->first();
            if ($pendaftaran) {
                $pendaftaran = Pendaftaran::find($pendaftaran->id);
                $pendaftaran->tglpendaftaran          = $request->tglpendaftaran;
                $pendaftaran->tglbayar                = $request->tglbayar;
                $pendaftaran->noamprah                = $request->noamprah;
                $pendaftaran->tglamprah               = $request->tglamprah;
                $pendaftaran->masaberlakuuji          = $request->masaberlakuuji;
                $pendaftaran->kodepenerbitans_id      = $jenispendaftaran;
                $pendaftaran->nosertifikat            = $request->nosertifikat;
                $pendaftaran->save();
            }else{
                Pendaftaran::create([
                'identitaskendaraan_id' => $cekkendaraan->id,
                'tglpendaftaran'        => $request->tglpendaftaran,
                'tglbayar'              => $request->tglbayar,
                'noamprah'              => $request->noamprah,
                'tglamprah'             => $request->tglamprah,
                'masaberlakuuji'        => $request->masaberlakuuji,
                'kodepenerbitans_id'    => $jenispendaftaran,
                'jenispendaftaran'                 => 'ots',
                'verif'                 => 'n',
                ]); 
            }

            $kendaraan = Identitaskendaraan::where('id',$identitaskendaraan_id)->first();
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
            $kendaraan->dayamotorpenggerak      = $request->dayamotorpenggerak;
            $kendaraan->jbb                     = $request->jbb;
            $kendaraan->kodewilayah             = $kode;
            $kendaraan->kodewilayahasal         = $kodeasal;
            $kendaraan->idkepaladinas           = '390';
            $kendaraan->iddirektur              = '18';
            if ($jenispendaftaran == '8') {
            $kendaraan->jenislama               = $cekkendaraan->jenis;
            }elseif ($jenispendaftaran == '11') {
            $kendaraan->sifatlama               = $cekkendaraan->peruntukan;
            }
            $kendaraan->save();

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
            $datakendaraan->panjangkendaraan        = $request->panjangkendaraan;
            $datakendaraan->lebarkendaraan          = $request->lebarkendaraan;
            $datakendaraan->tinggikendaraan         = $request->tinggikendaraan;
            $datakendaraan->panjangbakatautangki    = $request->panjangbakatautangki;
            $datakendaraan->lebarbakatautangki      = $request->lebarbakatautangki;
            $datakendaraan->tinggibakatautangki     = $request->tinggibakatautangki;
            $datakendaraan->dayaangkutorang       = $request->dayaangkutorang;
            $datakendaraan->dayaangkutbarang      = $request->dayaangkutbarang;
            $datakendaraan->mst                   = $request->mst;
            $datakendaraan->julurdepan            = $request->julurdepan;
            $datakendaraan->julurbelakang         = $request->julurbelakang;
            $datakendaraan->groundclearance       = $request->groundclearance;
            $datakendaraan->save();  
        // print_r($cekkendaraan->id);
            
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
        if (empty($kendaraan)) {
            $kendaraan = Datapengujianlama::where('nouji',$request->nouji)->first();
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
            $kode='DUMAI'; 
        }

        if ($request->kodewilayahasal == '') {
            $kodeasal='DUMAI'; 
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
        $kendaraan->dayamotorpenggerak      = $request->dayamotorpenggerak;
        $kendaraan->jbb                     = $request->jbb;
        $kendaraan->kodewilayah             = $kode;
        $kendaraan->kodewilayahasal         = $kodeasal;
        $kendaraan->save();

        // $pendaftaran = Pendaftaran::where('id',$id);
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->tglpendaftaran          = $request->tglpendaftaran;
        $pendaftaran->tglbayar                = $request->tglbayar;
        $pendaftaran->noamprah                = $request->noamprah;
        $pendaftaran->tglamprah               = $request->tglamprah;
        $pendaftaran->masaberlakuuji          = $request->masaberlakuuji;
        $pendaftaran->kodepenerbitans_id      = $jenispendaftaran;
        $pendaftaran->nosertifikat            = $request->nosertifikat;
        $pendaftaran->save();

        $datakendaraan = Datakendaraan::where('identitaskendaraan_id',$identitaskendaraan_id)->first();

        if (empty($datakendaraan) || is_null($datakendaraan)) {
            $dataid = Pendaftaran::find($id);
            
            Datakendaraan::create([
            'jbi'                   => $request->jbi,
            'identitaskendaraan_id' => $dataid->identitaskendaraan_id,
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
            'panjangkendaraan'      => $request->panjangkendaraan,
            'lebarkendaraan'        => $request->lebarkendaraan,
            'tinggikendaraan'       => $request->tinggikendaraan,
            'panjangbakatautangki'  => $request->panjangbakatautangki,
            'lebarbakatautangki'    => $request->lebarbakatautangki,
            'tinggibakatautangki'   => $request->tinggibakatautangki,
            'dayaangkutorang'       => $request->dayaangkutorang,
            'dayaangkutbarang'      => $request->dayaangkutbarang,
            'mst'                   => $request->mst,
            'julurdepan'            => $request->julurdepan,
            'julurbelakang'         => $request->julurbelakang,
            'groundclearance'       => $request->groundclearance,
            ]);
        }else{
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
            $datakendaraan->panjangkendaraan        = $request->panjangkendaraan;
            $datakendaraan->lebarkendaraan          = $request->lebarkendaraan;
            $datakendaraan->tinggikendaraan         = $request->tinggikendaraan;
            $datakendaraan->panjangbakatautangki    = $request->panjangbakatautangki;
            $datakendaraan->lebarbakatautangki      = $request->lebarbakatautangki;
            $datakendaraan->tinggibakatautangki     = $request->tinggibakatautangki;
            $datakendaraan->dayaangkutorang       = $request->dayaangkutorang;
            $datakendaraan->dayaangkutbarang      = $request->dayaangkutbarang;
            $datakendaraan->mst                   = $request->mst;
            $datakendaraan->julurdepan            = $request->julurdepan;
            $datakendaraan->julurbelakang         = $request->julurbelakang;
            $datakendaraan->groundclearance       = $request->groundclearance;
            $datakendaraan->save();
        }
        
        

        $id = Pendaftaran::find($id);
        if (!is_null($id->idx)) {
        $date=date_create($request->tglsertifikatreg);
        $tglsertifikatreg = date_format($date,'dmY');
        $date1=date_create($request->masaberlakuuji);
        $masaberlakuuji= date_format($date1,'dmY');

        $datapengujian = Datapengujian::find($id->idx);
        $datapengujian->nouji                   = $request->nouji;
        $datapengujian->nama                    = $request->nama;
        $datapengujian->alamat                  = $request->alamat;
        $datapengujian->noidentitaspemilik      = $request->noidentitaspemilik;
        $datapengujian->noregistrasikendaraan   = $request->noregistrasikendaraan;
        $datapengujian->norangka                = $request->norangka;
        $datapengujian->merek                   = $merek;
        $datapengujian->tipe                    = $tipe;
        $datapengujian->nomesin                 = $request->nomesin;
        $datapengujian->thpembuatan             = $request->thpembuatan;
        $datapengujian->bahanbakar              = $request->bahanbakar;
        $datapengujian->jenis                   = $jeniskendaraan;
        $datapengujian->isisilinder             = $request->isisilinder;
        $datapengujian->dayamotorpenggerak      = $request->dayamotorpenggerak;
        $datapengujian->jbb                     = $request->jbb;
        $datapengujian->kodewilayah             = $kode;
        $datapengujian->kodewilayahasal         = $kodeasal;
        $datapengujian->nosertifikatreg         = $request->nosertifikatreg;
        $datapengujian->tglsertifikatreg        = $tglsertifikatreg;
        $datapengujian->masaberlakuuji          = $masaberlakuuji;
        $datapengujian->statuspenerbitan        = $jenispendaftaran;
        $datapengujian->jbkb                    = $request->jbkb;
        $datapengujian->konfigurasisumburoda    = $request->konfigurasisumburoda;
        $datapengujian->ukuranban               = $request->ukuranban;
        $datapengujian->jaraksumbu1_2           = $request->jaraksumbu1_2;
        $datapengujian->jaraksumbu2_3           = $request->jaraksumbu2_3;
        $datapengujian->jaraksumbu3_4           = $request->jaraksumbu3_4;
        $datapengujian->kelasjalanterendah      = $request->kelasjalanterendah;
        $datapengujian->panjangkendaraan        = $request->panjangkendaraan;
        $datapengujian->lebarkendaraan          = $request->lebarkendaraan;
        $datapengujian->tinggikendaraan         = $request->tinggikendaraan;
        $datapengujian->panjangbakatautangki    = $request->panjangbakatautangki;
        $datapengujian->lebarbakatautangki      = $request->lebarbakatautangki;
        $datapengujian->tinggibakatautangki     = $request->tinggibakatautangki;
        $datapengujian->save();
        }

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
        $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->find($id);
        // print_r($kendaraan);

        $itempos = array();
        $items = SettingAmprah::get();
        foreach ($items as $item) {
            array_push($itempos,$item->value);
        }

        return view('admin.cetak.lmbrpemeriksaan_print',  ['data' => $kendaraan,'item' => $itempos]);
    }

    public function printlembarsktl($id)
    {
        $kendaraan = Pendaftaran::with(['identitaskendaraan'])->find($id);
        return view('admin.cetak.lmbrsktl_print', compact('kendaraan'));
    }

    public function printlembarhasiluji($id)
    {
        $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
        return view('admin.cetak.lmbrhasiluji', compact('kendaraan'));
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

    // public function printbukuujihal1($id)
    // {
    //     $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
    //     return view('admin.cetak.bukuujihal1_print', compact('data'));
    // }

    // public function printbukuujihal23($id)
    // {
    //     $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
    //     return view('admin.cetak.bukuujihal23_print', compact('data'));
    // }

    // public function printbukuujihal45($id)
    // {
    //     $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
    //     return view('admin.cetak.bukuujihal45_print', compact('data'));
    // }

    // public function printbukuujihal6($id)
    // {
    //     $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
    //     return view('admin.cetak.bukuujihal6_print', compact('data'));
    // }

    // public function printbukuujihal7($id)
    // {
    //     $data = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->find($id);
    //     return view('admin.cetak.bukuujihal7_print', compact('data'));
    // }

    


}
