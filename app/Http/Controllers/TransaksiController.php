<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\Biaya;
use App\kodepenerbitan;
use App\Pendaftaran;
use App\Jenis;

class TransaksiController extends Controller
{

    public function store(Request $request)
    {
        Transaksi::create([
            'retribusi' => $request->retribusi,
            'registrasi'=> $request->registrasi,
            'buku'		=> $request->buku,
            'platuji'	=> $request->platuji,
            'stiker'	=> $request->stiker,
            'blndenda'	=> $request->blndenda,
            'denda' 	=> $request->denda,
            'total'		=> $request->total,
            'status'    => '1',
        ]);
    }

    public function update(Request $request, $id)
    {
        $trans = Transaksi::where('pendaftaran_id',$id)->first();
        if (is_null($trans)) {
        	Transaksi::create([
	            'pendaftaran_id' => $id,
	            'retribusi' 	 => $request->retribusi,
	            'regkend'		 => $request->registrasi,
	            'bukuuji'		 => $request->buku,
	            'ketbuku'		 => $request->ketbuku,
            	'platuji'		 => $request->platuji,
	            'stiker'		 => $request->stiker,
	            'blndenda'		 => $request->blndenda,
	            'denda' 		 => $request->denda,
	            'status'		 => '1',
	            'total'			 => $request->total,
	        ]);
        }else{
        	$trans = Transaksi::where('pendaftaran_id',$id)->first();
        	$trans->retribusi 	= $request->retribusi;
	        $trans->regkend 	= $request->registrasi;
	        $trans->ketbuku 	= $request->ketbuku;
	        $trans->bukuuji 	= $request->buku;
	        $trans->platuji   	= $request->platuji;
	        $trans->stiker   	= $request->stiker;
	        $trans->blndenda 	= $request->blndenda;
	        $trans->denda 	 	= $request->denda;
	        $trans->total 		= $request->total;
            $trans->status      = '1';
	        $trans->save();
        }        
    }

    public function cekhargabuku(Request $request)
    {
        $masters = Biaya::select('biaya')->where('nama',$request->jenis)->first();
        if ($request->jenis != 'Buku Uji Baru') {
            $buku = Biaya::select('biaya')->where('nama','Buku Uji Baru')->first();
            $masters->biaya = $masters->biaya+$buku->biaya;
        }
        return response()->json(['masters'=> $masters]);
    }

    public function biayadenda()
    {
        $denda = Biaya::select('biaya')->where('nama','denda')->first();
        return response()->json(['biayadenda'=>$denda]);
    }

    public function biayastiker()
    {
        $biaya = Biaya::select('biaya')->where('nama','stiker')->first();
        return response()->json(['biaya'=>$biaya->biaya]);
    }

    public function biayaplatuji()
    {
        $biaya = Biaya::select('biaya')->where('nama','plat uji')->first();
        return response()->json(['biaya'=>$biaya->biaya]);
    }

    public function registrasi($id)
    {
        $kendaraans = Pendaftaran::where('pendaftarans.id',$id)->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->first();

        $registrasi = Biaya::select('biaya')->where('nama',$kendaraans->keterangan)->first();
        return response()->json(['registrasi'=>$registrasi->biaya]);
    }

    public function retribusi($id)
    {
        $kendaraans = Pendaftaran::select('jbb','jenis')->where('pendaftarans.id',$id)->leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->first();
        $jeniskend = Jenis::where('jenis',$kendaraans->jenis)->first();
        if ($jeniskend->klasifikasis_id == 3) {
        	if ($jeniskend->jeniskendaraan == 'Mobil Bus Kecil') {
                $name = 'BUS <13';
            }elseif ($jeniskend->jeniskendaraan == 'Mobil Bus Sedang') {
                $name = 'BUS <=30';
            }else{
                $name = 'BUS >=30';
            }
        }elseif ($jeniskend->klasifikasis_id == 4) {
        	if (intval($kendaraans->jbb) <= 3000) {
        		$name = 'Mobil Barang (JBB) s/d 3000';
        	}elseif (intval($kendaraans->jbb) > 3000 && $kendaraans->jbb <= 9000) {
        		$name = 'Mobil Barang (JBB) 3001 s/d 9000';
        	}elseif (intval($kendaraans->jbb) > 9000 && $kendaraans->jbb <= 15000) {
        		$name = 'Mobil Barang (JBB) 9001 s/d 15000';
        	}elseif (intval($kendaraans->jbb) > 15000 && $kendaraans->jbb <= 21000) {
        		$name = 'Mobil Barang (JBB) 15001 s/d 21000';
        	}elseif (intval($kendaraans->jbb) > 21000) {
        		$name = 'Mobil Barang (JBB) >= 21000';
        	}
        }elseif ($jeniskend->klasifikasis_id == 2) {
        	if ($jeniskend->jeniskendaraan == 'Kendaraan Bermotor Roda Tiga Angkutan Penumpang') {
        		$name = 'Roda 3';
        	}else{
        		$name = 'Mobil Penumpang Umum';
        	}
        }elseif ($jeniskend->klasifikasis_id == 5 || $jeniskend->klasifikasis_id == 6) {
        		$name = 'Kereta Gandeng / Tempelan';
        }elseif ($jeniskend->klasifikasis_id == 7) {
        		$name = 'Kendaraan Khusus';
        }else{
            $name = '';
        }
        $retribusi = Biaya::select('biaya')->where('nama',$name)->first();
        return response()->json(['retribusi'=>$retribusi]);
    }

    public function printkwitansi($id)
    {
        $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('pendaftarans.id',$id)->first();
        return view('admin.cetak.kwitansi', compact('kendaraan'));
    }

    public function destroy($id)
    {
        $kendaraan = Transaksi::where('pendaftaran_id',$id)->first();
        $kendaraan->delete();
    }

    public function printlaporankeuanganharian($tgl)
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
        $tglprint = $hari_ini.', '.$tglcetak;

        $kendaraan  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->where('tglpendaftaran',$tgl)->get();

        $umum       = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('peruntukan','Umum')->count();
        $tidakumum  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('peruntukan','Tidak Umum')->count();
        $jeniskendaraan = Jenis::all();
        $jenispelayanan = kodepenerbitan::all();

        $totaljenis = array();
        foreach ($jeniskendaraan as $jenis) {
            $arr = array(
                        'jenis'     => $jenis->jenis,
                        'jumlah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('jenis',$jenis->jenis)->count(),
                        'umum'      => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('peruntukan','Umum')->where('jenis',$jenis->jenis)->count(),
                        'tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('peruntukan','Tidak Umum')->where('jenis',$jenis->jenis)->count(),
                        'retribusi' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('jenis',$jenis->jenis)->sum('retribusi'),
                        );
            array_push($totaljenis, $arr);
        }

        $pelayanan = array();
        foreach ($jenispelayanan as $data) {
            $arr = array(
                        'jenispelayanan'  => $data->keterangan,
                        'jumlah' => Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('keterangan',$data->keterangan)->count(),
                        );
            array_push($pelayanan, $arr);
        }

        $pemakaianbuku = array(
                        'baru'   => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('ketbuku','Buku Uji Baru')->count(),
                        'rusak'  => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('ketbuku','Buku Uji Rusak')->count(),
                        'hilang' => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('ketbuku','Buku Uji Hilang')->count(),
                        );
        $stiker = Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('stiker','>','0')->where('tglpendaftaran',$tgl)->count();
        $platuji = Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('platuji','>','0')->where('tglpendaftaran',$tgl)->count();

        return view('admin.cetak.laporankeuanganharian_print', ['kendaraan' => $kendaraan,'tglprint' => $tglprint, 'jenis' => $totaljenis, 'jmlstiker' => $stiker, 'jenispelayanan' => $pelayanan, 'pemakaianbuku' => $pemakaianbuku, 'totplatuji' => $platuji ]);
    }

    public function printlaporankeuanganbulanan($tgl)
    {
        $tglcetak = date('d-F-Y', strtotime($tgl));
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
        $tglprint2 = $tglcetak;

        $kendaraan  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->get();

        $umum       = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Umum')->count();
        $tidakumum  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Tidak Umum')->count();
        $jeniskendaraan = Jenis::all();
        $jenispelayanan = kodepenerbitan::all();

        $totaljenis = array();
        foreach ($jeniskendaraan as $jenis) {
            $arr = array(
                        'jenis'     => $jenis->jenis,
                        'jumlah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('jenis',$jenis->jenis)->count(),
                        'umum'      => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Umum')->where('jenis',$jenis->jenis)->count(),
                        'tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Tidak Umum')->where('jenis',$jenis->jenis)->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $pelayanan = array();
        foreach ($jenispelayanan as $data) {
            $arr = array(
                        'jenispelayanan'  => $data->keterangan,
                        'jumlah' => Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('keterangan',$data->keterangan)->count(),
                        );
            array_push($pelayanan, $arr);
        }

        $pemakaianbuku = array(
                        'baru'   => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('ketbuku','Buku Uji Baru')->count(),
                        'rusak'  => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('ketbuku','Buku Uji Rusak')->count(),
                        'hilang' => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->where('ketbuku','Buku Uji Hilang')->count(),
                        );
        $stiker = Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('stiker','>','0')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->count();
        $platuji = Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('platuji','>','0')->whereMonth('tglpendaftaran',$bulan)->whereYear('tglpendaftaran',$tahun)->count();

        return view('admin.cetak.laporankeuanganbulanan_print', ['kendaraan' => $kendaraan,'tglprint' => $tglprint,'tglprint2' => $tglprint2, 'jenis' => $totaljenis, 'jmlstiker' => $stiker, 'jenispelayanan' => $pelayanan, 'pemakaianbuku' => $pemakaianbuku, 'totplatuji' => $platuji ]);
    }

    public function printlaporankeuangantahunan($tgl)
    {
        $tglcetak = date('d-m-Y', strtotime($tgl));
        $tglcreate = date_create($tgl);
        $hari = date_format($tglcreate,"D");
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

        $kendaraan  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->whereYear('tglpendaftaran',$tahun)->get();

        $umum       = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Umum')->count();
        $tidakumum  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Tidak Umum')->count();
        $jeniskendaraan = Jenis::all();
        $jenispelayanan = kodepenerbitan::all();

        $totaljenis = array();
        foreach ($jeniskendaraan as $jenis) {
            $arr = array(
                        'jenis'     => $jenis->jenis,
                        'jumlah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$jenis->jenis)->count(),
                        'umum'      => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Umum')->where('jenis',$jenis->jenis)->count(),
                        'tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('peruntukan','Tidak Umum')->where('jenis',$jenis->jenis)->count(),
                        );
            array_push($totaljenis, $arr);
        }

        $pelayanan = array();
        foreach ($jenispelayanan as $data) {
            $arr = array(
                        'jenispelayanan'  => $data->keterangan,
                        'jumlah' => Pendaftaran::leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('keterangan',$data->keterangan)->count(),
                        );
            array_push($pelayanan, $arr);
        }

        $pemakaianbuku = array(
                        'baru'   => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('ketbuku','Buku Uji Baru')->count(),
                        'rusak'  => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('ketbuku','Buku Uji Rusak')->count(),
                        'hilang' => Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->whereYear('tglpendaftaran',$tahun)->where('ketbuku','Buku Uji Hilang')->count(),
                        );
        $stiker = Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('stiker','>','0')->whereYear('tglpendaftaran',$tahun)->count();
        $platuji = Pendaftaran::rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('platuji','>','0')->whereYear('tglpendaftaran',$tahun)->count();

        return view('admin.cetak.laporankeuangantahunan_print', ['kendaraan' => $kendaraan,'tglprint' => $tglprint, 'jenis' => $totaljenis, 'jmlstiker' => $stiker, 'jenispelayanan' => $pelayanan, 'pemakaianbuku' => $pemakaianbuku, 'totplatuji' => $platuji ]);
    }

}
