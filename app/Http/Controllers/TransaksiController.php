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
	            'jasapengujian'	 => $request->retribusi,
	            'penilaianteknis'=> $request->registrasi,
	            'kartu'    		 => $request->buku,
	            'ketkartu'		 => $request->ketbuku,
            	'perubahanstatus'=> $request->statuskepemilikan,
	            'perubahansifat' => $request->perubahansifat,
                'emisi'          => $request->emisi,
                'pengujiankeliling'     => $request->pengujiankeliling,
                'numpangujidanmutasi'   => $request->numpangujidanmutasi,
	            'blndenda'		 => $request->blndenda,
	            'denda' 		 => $request->denda,
	            'total'			 => $request->total,
	        ]);
            $pendaftarans = Pendaftaran::where('id',$id)->first();
            $pendaftarans->status      = '1';
            $pendaftarans->save();

        }else{
        	$trans = Transaksi::where('pendaftaran_id',$id)->first();
        	$trans->jasapengujian      	= $request->retribusi;
	        $trans->penilaianteknis 	= $request->registrasi;
	        $trans->ketkartu           	= $request->ketbuku;
	        $trans->kartu              	= $request->buku;
	        $trans->perubahanstatus   	= $request->statuskepemilikan;
	        $trans->perubahansifat   	= $request->perubahansifat;
            $trans->emisi               = $request->pengujiankeliling;
            $trans->pengujiankeliling   = $request->blndenda;
            $trans->numpangujidanmutasi = $request->numpangujidanmutasi;
	        $trans->blndenda 	        = $request->blndenda;
	        $trans->denda 	 	        = $request->denda;
	        $trans->total 		        = $request->total;
	        $trans->save();

            $pendaftarans = Pendaftaran::where('id',$id)->first();
            $pendaftarans->status      = '1';
            $pendaftarans->save();
            
        }        
    }

    public function cekhargabuku(Request $request)
    {
        $masters = Biaya::select('biaya')->where('nama',$request->jenis)->first();
        if ($request->jenis != 'Smart Card Baru') {
            $buku = Biaya::select('biaya')->where('nama','Smart Card Baru')->first();
            $masters->biaya = $masters->biaya+$buku->biaya;
        }
        return response()->json(['masters'=> $masters]);
    }

    public function biayadenda()
    {
        $denda = Biaya::select('biaya')->where('nama','denda')->first();
        return response()->json(['biayadenda'=>$denda]);
    }

    public function biayaemisi()
    {
        $biaya = Biaya::select('biaya')->where('nama','Biaya Pengujian Emisi Gas Buang')->first();
        return response()->json(['biaya'=>$biaya->biaya]);
    }

    public function biayastatuskepemilikan()
    {
        $biaya = Biaya::select('biaya')->where('nama','Perubahan Status Kepemilikan Kendaraan')->first();
        return response()->json(['biaya'=>$biaya->biaya]);
    }

    public function biayaperubahansifat()
    {
        $biaya = Biaya::select('biaya')->where('nama','Perubahan Sifat Kendaraan')->first();
        return response()->json(['biaya'=>$biaya->biaya]);
    }

    public function biayapengujiankelilingumum()
    {
        $biaya = Biaya::select('biaya')->where('nama','Pengujian Keliling Umum')->first();
        return response()->json(['biaya'=>$biaya->biaya]);
    }

    public function biayanumpangujidanmutasi()
    {
        $biaya = Biaya::select('biaya')->where('nama','Numpang Uji dan Mutasi')->first();
        return response()->json(['biaya'=>$biaya->biaya]);
    }

    public function biayapengujiankelilingtidakumum()
    {
        $biaya = Biaya::select('biaya')->where('nama','Pengujian Keliling Tidak Umum')->first();
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
        	if (intval($kendaraans->jbb) <= 6000) {
                $name = 'Bus (JBB) s/d 6000';
            }elseif (intval($kendaraans->jbb) > 6001 && $kendaraans->jbb <= 9000) {
                $name = 'Bus (JBB) 6001 s/d 9000';
            }elseif (intval($kendaraans->jbb) > 9000) {
                $name = 'Bus (JBB) > 9000';
            }
        }elseif ($jeniskend->klasifikasis_id == 4) {
        	if (intval($kendaraans->jbb) <= 4000) {
        		$name = 'Mobil Barang (JBB) s/d 4000';
        	}elseif (intval($kendaraans->jbb) > 4001 && $kendaraans->jbb <= 7500) {
        		$name = 'Mobil Barang (JBB) 4001 s/d 7500';
        	}elseif (intval($kendaraans->jbb) > 7501 && $kendaraans->jbb <= 9000) {
                $name = 'Mobil Barang (JBB) 7501 s/d 9000';
            }elseif (intval($kendaraans->jbb) > 9001 && $kendaraans->jbb <= 12000) {
                $name = 'Mobil Barang (JBB) 9001 s/d 12000';
            }elseif (intval($kendaraans->jbb) > 12001 && $kendaraans->jbb <= 15000) {
                $name = 'Mobil Barang (JBB) 12001 s/d 15000';
            }elseif (intval($kendaraans->jbb) > 15001 && $kendaraans->jbb <= 18000) {
                $name = 'Mobil Barang (JBB) 15001 s/d 18000';
            }elseif (intval($kendaraans->jbb) > 18001 && $kendaraans->jbb <= 21000) {
                $name = 'Mobil Barang (JBB) 18001 s/d 21000';
            }elseif (intval($kendaraans->jbb) > 21000) {
        		$name = 'Mobil Barang (JBB) >= 21000';
        	}
        }elseif ($jeniskend->klasifikasis_id == 2) {
        		$name = 'Mobil Penumpang Umum';
        }elseif ($jeniskend->klasifikasis_id == 5 || $jeniskend->klasifikasis_id == 6) {
        		$name = 'Kereta Tempelan';
        }elseif ($jeniskend->klasifikasis_id == 7) {
        		$name = 'Kendaraan Khusus';
        }else{
            $name = '';
        }
        $retribusi = Biaya::select('biaya')->where('nama',$name)->where('pelayanan','Jasa Pengujian')->first();
        return response()->json(['retribusi'=>$retribusi]);
    }

    public function Penilianteknis($id)
    {
        $kendaraans = Pendaftaran::select('jbb','jenis')->where('pendaftarans.id',$id)->leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->first();
        $jeniskend = Jenis::where('jenis',$kendaraans->jenis)->first();
        if ($jeniskend->klasifikasis_id == 3) {
            if (intval($kendaraans->jbb) <= 3500) {
                $name = 'Bus (JBB) s/d 3500';
            }elseif (intval($kendaraans->jbb) > 3501 && $kendaraans->jbb <= 8500) {
                $name = 'BUS (JBB) 3501 s/d 8500';
            }elseif (intval($kendaraans->jbb) > 8500) {
                $name = 'Bus (JBB) > 8500';
            }
        }elseif ($jeniskend->klasifikasis_id == 4) {
            if (intval($kendaraans->jbb) <= 3500) {
                $name = 'Mobil Barang (JBB) s/d 3500';
            }elseif (intval($kendaraans->jbb) > 3501 && $kendaraans->jbb <= 8500) {
                $name = 'Mobil Barang (JBB) 3501 s/d 8500';
            }elseif (intval($kendaraans->jbb) > 8500) {
                $name = 'Mobil Barang (JBB) >= 8500';
            }
        }elseif ($jeniskend->klasifikasis_id == 2) {
                $name = 'Mobil Penumpang Umum';
        }elseif ($jeniskend->klasifikasis_id == 5 || $jeniskend->klasifikasis_id == 6) {
                $name = 'Kereta Gandeng / Tempelan';
        }elseif ($jeniskend->klasifikasis_id == 7) {
                $name = 'Kendaraan Khusus';
        }else{
            $name = '';
        }
        $registrasi = Biaya::select('biaya')->where('nama',$name)->where('pelayanan','Penilaian teknis Kondisi Kendaraan')->first();
        return response()->json(['registrasi'=>$registrasi]);
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
