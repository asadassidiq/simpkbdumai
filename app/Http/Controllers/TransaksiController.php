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
            'total'     => $request->total,
            'nokwitansi'		=> $request->nokwitansi,
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
                'administrasi'   => $request->registrasi,
	            'blangko'        => $request->blangko,
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
                'nokwitansi'        => $request->nokwitansi,
	        ]);
            $pendaftarans = Pendaftaran::where('id',$id)->first();
            $pendaftarans->status      = '1';
            $pendaftarans->save();

        }else{
        	$trans = Transaksi::where('pendaftaran_id',$id)->first();
        	$trans->jasapengujian      	= $request->retribusi;
            $trans->administrasi        = $request->registrasi;
	        $trans->blangko        	    = $request->blangko;
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
            $trans->nokwitansi          = $request->nokwitansi;
	        $trans->save();

            $pendaftarans = Pendaftaran::where('id',$id)->first();
            $pendaftarans->status      = '1';
            $pendaftarans->save();
            
        }        
    }

    public function cekhargabuku(Request $request)
    {
        $masters = Biaya::select('biaya')->where('nama',$request->jenis)->first();
        if ($request->jenis != 'Smart Card Baru' && $request->jenis != 'Smart Card Lama') {
            $buku = Biaya::select('biaya')->where('nama','Smart Card Baru')->first();
            $masters->biaya = $masters->biaya+$buku->biaya;
        }elseif ($request->jenis == 'Smart Card Lama') {
            $masters->biaya = $masters->biaya;
        }
        return response()->json(['masters'=> $masters]);
    }

    public function biayadenda($id)
    {
        $kendaraans = Pendaftaran::select('jenis')->where('pendaftarans.id',$id)->leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->first();
        $jeniskend = Jenis::where('jenis',$kendaraans->jenis)->first();
        if ($jeniskend->klasifikasis_id == 2) {
            $denda = array('biaya' => 650 );;
        }else{
            $denda = Biaya::select('biaya')->where('nama','denda')->first();
        }
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
        $registrasi = Biaya::select('biaya')->where('nama','Administrasi Pengujian')->first();
        return response()->json(['registrasi'=>$registrasi->biaya]);
    }

    public function retribusi($id)
    {
        $kendaraans = Pendaftaran::select('jbb','jenis')->where('pendaftarans.id',$id)->leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->first();
        $jeniskend = Jenis::where('jenis',$kendaraans->jenis)->first();
        if ($jeniskend->klasifikasis_id == 3) {
            $retribusi = ['biaya'=> 25000];
        	if (intval($kendaraans->jbb) > 6001 && $kendaraans->jbb <= 9000) {
                $name = 'Bus (JBB) 6001 s/d 9000';
            }elseif (intval($kendaraans->jbb) > 9000) {
                $name = 'Bus (JBB) > 9000';
            }
        }elseif ($jeniskend->klasifikasis_id == 4) {
            $retribusi = ['biaya'=> 25000];
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
                $retribusi = ['biaya'=> 17500];
        }elseif ($jeniskend->klasifikasis_id == 5 || $jeniskend->klasifikasis_id == 6) {
        		$name = 'Kereta Tempelan';
                $retribusi = ['biaya'=> 25000];
        }elseif ($jeniskend->klasifikasis_id == 7) {
            $retribusi = ['biaya'=> 25000];
        	if (intval($kendaraans->jbb) <= 4000) {
                $name = 'Kendaraan Khusus (JBB) s/d 4000';
            }elseif (intval($kendaraans->jbb) > 4001 && $kendaraans->jbb <= 7500) {
                $name = 'Kendaraan Khusus (JBB) 4001 s/d 7500';
            }elseif (intval($kendaraans->jbb) > 7501 && $kendaraans->jbb <= 9000) {
                $name = 'Kendaraan Khusus (JBB) 7501 s/d 9000';
            }elseif (intval($kendaraans->jbb) > 9001 && $kendaraans->jbb <= 12000) {
                $name = 'Kendaraan Khusus (JBB) 9001 s/d 12000';
            }elseif (intval($kendaraans->jbb) > 12001 && $kendaraans->jbb <= 15000) {
                $name = 'Kendaraan Khusus (JBB) 12001 s/d 15000';
            }elseif (intval($kendaraans->jbb) > 15001 && $kendaraans->jbb <= 18000) {
                $name = 'Kendaraan Khusus (JBB) 15001 s/d 18000';
            }elseif (intval($kendaraans->jbb) > 18001 && $kendaraans->jbb <= 21000) {
                $name = 'Kendaraan Khusus (JBB) 18001 s/d 21000';
            }elseif (intval($kendaraans->jbb) > 21000) {
                $name = 'Kendaraan Khusus (JBB) >= 21000';
            }
        }elseif ($jeniskend->klasifikasis_id == 8) {
                $retribusi = ['biaya'=> 25000];
                $name = 'Kendaraan Bermotor Roda 3';
        }else{
            $name = '';
            $retribusi = ['biaya'=> 0];
        }
        // $retribusi = Biaya::select('biaya')->where('nama',$name)->where('pelayanan','Jasa Pengujian')->first();
        return response()->json(['retribusi'=>$retribusi]);
    }

    public function Penilianteknis($id)
    {
        $registrasi = ['biaya'=> 7500];
        // $registrasi = Biaya::select('biaya')->where('nama','Administrasi Pengujian')->where('pelayanan','Registrasi')->first();
        return response()->json(['registrasi'=>$registrasi]);
    }

    public function printkwitansi($id)
    {
        $kendaraan = Pendaftaran::leftJoin('identitaskendaraans','pendaftarans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('pendaftarans.id',$id)->first();
        return view('admin.cetak.kwitansi',  ['data' => $kendaraan]);
    }

    public function destroy($id)
    {
        $kendaraan = Transaksi::where('pendaftaran_id',$id)->first();
        $kendaraan->delete();
    }

}
