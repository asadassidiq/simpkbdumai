<?php

namespace App\Http\Controllers;

use App\Pendaftaran;
use App\PendaftranOld;
use App\Transaksi;
use App\Datakendaraan;
use App\Datapengujian;
use App\Identitaskendaraan;
use App\Kodewilayah;
use App\Kodepenerbitan;
use App\klasifikasi;
use App\Merek;
use App\Tipe;
use App\Jenis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
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

        $kartu = Datapengujian::leftJoin('pendaftarans','pendaftarans.idx','=','datapengujian.idx')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->WhereNotNull('nokendalikartu')->get();

        $kendaraan  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','pendaftarans.kodepenerbitans_id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->where('tglpendaftaran',$tgl)->groupBy('identitaskendaraan_id')->get();
        $tidaklulus = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->where(function ($tidaklulus){ $tidaklulus->where('statuslulusuji','0')->orWhereNull('statuslulusuji');})->get();
        $numpanguji = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('pengujians','pengujians.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where(function ($numpanguji){ $numpanguji->where('kodepenerbitans_id','5')->orWhere('kodepenerbitans_id','9');})->get();
        
        $datajm['mobilpenumpang1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['mobilpenumpang2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['mobilpenumpang3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','2')->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();

        $datajm['kendaraankhusus1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['kendaraankhusus2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['kendaraankhusus3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','7')->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();

        $datajm['mobilbus1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['mobilbus2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $data['mobilbus3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','3')->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();

        $datajm['mobilbarang1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['mobilbarang2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['mobilbarang3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','4')->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();

        $datajm['keretatempelan1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['keretatempelan2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['keretatempelan3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','6')->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();

        $datajm['keretagandeng1'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['keretagandeng2'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['keretagandeng3'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','5')->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();

        $datajm['kendaraanroda31'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','8')->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['kendaraanroda32'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','8')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $datajm['kendaraanroda33'] = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->where('tglpendaftaran',$tgl)->where('klasifikasis_id','8')->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();

        $jeniskendaraan = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->groupBy('jenis.jenis')->orderBy('jenis.jenis','ASC')->get();

        $totaljenis = array();
        foreach ($jeniskendaraan as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'jenis'         => $list->jenis,
                        'umum'          => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('jenis',$list->jenis)->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'tidakumum'     => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('jenis',$list->jenis)->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'pemerintah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('jenis',$list->jenis)->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        );
            array_push($totaljenis, $arr);
        }

        return view('admin.cetak.laporanloketpendaftaran_print', ['kendaraan' => $kendaraan,'kartu' => $kartu,'tglprint' => $tglprint, 'tidaklulus' => $tidaklulus, 'datajm' => $datajm, 'numpanguji' => $numpanguji, 'totaljenis' => $totaljenis]);
    }


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
        
        switch($bulan){
            case 1:
                $bulan_ini1 = "Januari";
            break;
     
            case 2:         
                $bulan_ini1 = "Febuari";
            break;
     
            case 3:
                $bulan_ini1 = "Maret";
            break;
     
            case 4:
                $bulan_ini1 = "April";
            break;
     
            case 5:
                $bulan_ini1 = "Mei";
            break;
     
            case 6:
                $bulan_ini1 = "Juni";
            break;
     
            case 7:
                $bulan_ini1 = "Juli";
            break;

            case 8:
                $bulan_ini1 = "Agustus";
            break;

            case 9:
                $bulan_ini1 = "September";
            break;

            case 10:
                $bulan_ini1 = "Oktober";
            break;

            case 11:
                $bulan_ini = "November";
            break;

            case 12:
                $bulan_ini1 = "Desember";
            break;
            
            default:
                $bulan_ini1 = "Tidak di ketahui";     
            break;
        }
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
                $bulan_ini = "Agustus";
            break;

            case 9:
                $bulan_ini = "September";
            break;

            case 10:
                $bulan_ini = "Oktober";
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
        $tglprint = $bulan_ini1;
        $tglcetak = $hari1.' '.$bulan_ini.' '.$tahun1;

        $jeniskendaraan = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->groupBy('jenis.jenis')->orderBy('jenis.jenis','ASC')->get();

        $totaljenis = array();
        foreach ($jeniskendaraan as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'jenis'         => $list->jenis,
                        'umum'          => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'tidakumum'     => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'pemerintah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereMonth('tglpendaftaran',$bulan)->where('jenis',$list->jenis)->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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

        $jenispengujian = array("UJI PERTAMA","UJI ULANG","NUMPANG UJI MASUK", "PINDAH MASUK","PINDAH KELUAR","NUMPANG UJI KELUAR","RUSAK","HILANG");
        $totalkeuangan = array();
        foreach ($jenispengujian as $list) {
            if ($list == 'UJI PERTAMA') {
                $jenis = '1';
            }elseif($list == 'UJI ULANG'){
                $jenis = '2';
            }elseif($list == 'RUSAK'){
                $jenis = '3';
            }elseif($list == 'HILANG'){
                $jenis = '4';
            }elseif($list == 'NUMPANG UJI MASUK'){
                $jenis = '5';
            }elseif($list == 'PINDAH MASUK'){
                $jenis = '6';
            }elseif($list == 'NUMPANG UJI KELUAR'){
                $jenis = '9';
            }elseif($list == 'PINDAH KELUAR'){
                $jenis = '10';
            }
            $arr = array(
                    'jenispengujian' => $list,
                    'jasapengujian'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('jasapengujian'),
                    'administrasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('administrasi'),
                    'denda'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('denda'),
                    'blangko'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('blangko'),
                    'perubahanstatus'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('perubahanstatus'),
                    'perubahansifat'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('perubahansifat'),
                    'emisi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('emisi'),
                    'pengujiankeliling'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('pengujiankeliling'),
                    'numpangujidanmutasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('numpangujidanmutasi'),
                    'total'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('total'),
                );
            array_push($totalkeuangan, $arr);

        }

        $totalkartu = array();
        
            $arr = array(
                    'ujipertama'  => Datapengujian::leftJoin('pendaftarans','pendaftarans.idx','=','datapengujian.idx')->where('statuspenerbitan','1')->whereMonth('tglpendaftaran',$bulan)->WhereNotNull('nokendalikartu')->count('datapengujian.idx'),
                    'ujiberkala'  => Datapengujian::leftJoin('pendaftarans','pendaftarans.idx','=','datapengujian.idx')->where('statuspenerbitan','2')->whereMonth('tglpendaftaran',$bulan)->WhereNotNull('nokendalikartu')->count('datapengujian.idx'),
                    'rusak'  => Datapengujian::leftJoin('pendaftarans','pendaftarans.idx','=','datapengujian.idx')->where('statuspenerbitan','3')->whereMonth('tglpendaftaran',$bulan)->WhereNotNull('nokendalikartu')->count('datapengujian.idx'),
                    'hilang'  => Datapengujian::leftJoin('pendaftarans','pendaftarans.idx','=','datapengujian.idx')->where('statuspenerbitan','4')->whereMonth('tglpendaftaran',$bulan)->WhereNotNull('nokendalikartu')->count('datapengujian.idx'),
                    'numasuk'  => Datapengujian::leftJoin('pendaftarans','pendaftarans.idx','=','datapengujian.idx')->where('statuspenerbitan','5')->whereMonth('tglpendaftaran',$bulan)->WhereNotNull('nokendalikartu')->count('datapengujian.idx'),
                    'mutasimasuk'  => Datapengujian::leftJoin('pendaftarans','pendaftarans.idx','=','datapengujian.idx')->where('statuspenerbitan','6')->whereMonth('tglpendaftaran',$bulan)->WhereNotNull('nokendalikartu')->count('datapengujian.idx'),
                    'ujipertamaamp' => Pendaftaran::where('kodepenerbitans_id','1')->whereMonth('tglamprah',$bulan)->WhereNotNull('noamprah')->count('noamprah'),
                    'ujiberkalaamp' => Pendaftaran::where('kodepenerbitans_id','2')->whereMonth('tglamprah',$bulan)->WhereNotNull('noamprah')->count('noamprah'),
                    'numasukamp' => Pendaftaran::where('kodepenerbitans_id','5')->whereMonth('tglamprah',$bulan)->WhereNotNull('noamprah')->count('noamprah'),
                    'nukeluaramp' => Pendaftaran::where('kodepenerbitans_id','9')->whereMonth('tglamprah',$bulan)->WhereNotNull('noamprah')->count('noamprah'),
                    'mutasimasukamp' => Pendaftaran::where('kodepenerbitans_id','6')->whereMonth('tglamprah',$bulan)->WhereNotNull('noamprah')->count('noamprah'),
                    'mutasikeluaramp' => Pendaftaran::where('kodepenerbitans_id','10')->whereMonth('tglamprah',$bulan)->WhereNotNull('noamprah')->count('noamprah'),
                    );
            array_push($totalkartu, $arr);


        $dayaangkutorang = array("RENTAL = 5/9 ORANG","TAKSI = 4/5 ORANG","TAKSI = 6/7 ORANG","AJDP = 6/7 ORANG","OPLET = 8/9 ORANG", "BIS = 10/12 ORANG","BIS = 13/30 ORANG", "BIS = 21/30 ORANG","BIS = 31/40 ORANG","BIS = 40 KEATAS");
        $totaldayaangkutorang = array();
        foreach ($dayaangkutorang as $list) {
            if ($list == 'RENTAL = 5/9 ORANG') {
                $jenis = '2';
                $jmlorang1 = 5;
                $jmlorang2 = 9;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 4;
                $jmlorang2 = 5;
            }elseif ($list == 'TAKSI = 6/7 ORANG') {
                $jenis = '2';
                $jmlorang1 = 6;
                $jmlorang2 = 7;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = '2';
                $jmlorang1 = 4;
                $jmlorang2 = 5;
            }elseif ($list == 'AJDP = 6/7 ORANG') {
                $jenis = '2';
                $jmlorang1 = 6;
                $jmlorang2 = 7;
            }elseif ($list == 'BIS = 10/12 ORANG') {
                $jenis = '3';
                $jmlorang1 = 10;
                $jmlorang2 = 12;
            }elseif ($list == 'BIS = 13/20 ORANG') {
                $jenis = '3';
                $jmlorang1 = 13;
                $jmlorang2 = 20;
            }elseif ($list == 'BIS = 21/30 ORANG') {
                $jenis = '3';
                $jmlorang1 = 21;
                $jmlorang2 = 30;
            }elseif ($list == 'BIS = 31/40 ORANG') {
                $jenis = '3';
                $jmlorang1 = 31;
                $jmlorang2 = 40;
            }elseif ($list == 'BIS = 40 KEATAS') {
                $jenis = '3';
                $jmlorang1 = 40;
                $jmlorang2 = 60;
            }
            $arr = array(
                    'dayaangkutorang' => $list,
                    '0-1'             => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','>=',$tahun-1)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '2'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-2)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '3'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-3)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '4'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-4)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '5'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-5)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '6'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-6)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '7'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-7)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '8'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-8)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '9'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-9)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '10'              => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id',$jenis)->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','<=',$tahun-10)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                );
            array_push($totaldayaangkutorang, $arr);
        }

        $merek = Merek::all();
        $totalmerek = array();
        foreach ($merek as $list) {
            $arr = array(
                    'merek'          => $list->merek,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('merek',$list->merek)->where('klasifikasis_id','2')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('merek',$list->merek)->where('klasifikasis_id','3')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('merek',$list->merek)->where('klasifikasis_id','4')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('merek',$list->merek)->where('klasifikasis_id','6')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('merek',$list->merek)->where('klasifikasis_id','5')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('merek',$list->merek)->where('klasifikasis_id','7')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','2')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','3')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','4')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','6')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','5')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereMonth('tglpendaftaran',$bulan)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','7')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                );
            array_push($totaljbb, $arr);
        }

        $wilayah =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahnu = array();
        foreach ($wilayah as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnu, $arr);
        }

        $wilayahnuall = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','5')->groupBy('kodewilayahasal')->get();
        $totalwilayahnuall = array();
        foreach ($wilayahnuall as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','5')->count(),
                );
            array_push($totalwilayahnuall, $arr);
        }

        $wilayahmu =array("KABUPATEN INDRAGIRI HULU","KABUPATEN INDRAGIRI HILIR","KABUPATEN PELALAWAN","KABUPATEN SIAK","KABUPATEN KAMPAR","KABUPATEN ROKAN HULU","KABUPATEN ROKAN HILIR","KABUPATEN BENGKALIS","KOTA PEKANBARU","KABUPATEN KEPULAUAN MERANTI");
        $totalwilayahmu = array();
        foreach ($wilayahmu as $list) {
            $arr = array(
                    'wilayah'        => $list,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmu, $arr);
        }

        $wilayahmuall = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('kodepenerbitans_id','6')->groupBy('kodewilayahasal')->get();
        $totalwilayahmuall = array();
        foreach ($wilayahmuall as $list) {
            $arr = array(
                    'wilayah'        => $list->namawilayah,
                    'mobilpenumpangumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbisumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelanumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhususumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilpenumpangtidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','2')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbistidakumum'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','3')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'mobilbarangtidakumum'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','4')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretatempelantidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','6')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'keretagandengtidakumum'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','5')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                    'kendaraankhusustidakumum'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->leftJoin('kodewilayah','kodewilayah.kodewilayah','=','identitaskendaraans.kodewilayahasal')->whereMonth('tglpendaftaran',$bulan)->where('klasifikasis_id','7')->where('namawilayah','like','%'.$list->namawilayah.'%')->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','6')->count(),
                );
            array_push($totalwilayahmuall, $arr);
        }

        return view('admin.cetak.laporanloketpendaftaranbulanan_print', ['tglprint' => $tglprint,'tglcetak' => $tglcetak, 'totaljenis' => $totaljenis,'totalkartu' => $totalkartu, 'totalklasifikasi' => $totalklasifikasi, 'jumlah' => $jumlah, 'totaldayaangkutorang' => $totaldayaangkutorang, 'totalmerek' => $totalmerek, 'totaljbb' => $totaljbb, 'totalwilayahnu' => $totalwilayahnu, 'totalwilayahnuall' => $totalwilayahnuall, 'totalwilayahmu' => $totalwilayahmu, 'totalwilayahmuall' => $totalwilayahmuall, 'totalkeuangan' => $totalkeuangan ]);
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

        $tglcreate1 = "".$tahun1."-".$bulan."-".$hari1."";
        $tglcreate2 = "".$tahun2."-".$bulan2."-31";
 
        switch($bulan){
            case 1:
                $bulan_ini1 = "Januari";
            break;
     
            case 2:         
                $bulan_ini1 = "Febuari";
            break;
     
            case 3:
                $bulan_ini1 = "Maret";
            break;
     
            case 4:
                $bulan_ini1 = "April";
            break;
     
            case 5:
                $bulan_ini1 = "Mei";
            break;
     
            case 6:
                $bulan_ini1 = "Juni";
            break;
     
            case 7:
                $bulan_ini1 = "Juli";
            break;

            case 8:
                $bulan_ini1 = "Agustus";
            break;

            case 9:
                $bulan_ini1 = "September";
            break;

            case 10:
                $bulan_ini1 = "Oktober";
            break;

            case 11:
                $bulan_ini = "November";
            break;

            case 12:
                $bulan_ini1 = "Desember";
            break;
            
            default:
                $bulan_ini1 = "Tidak di ketahui";     
            break;
        }
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
                $bulan_ini = "Agustus";
            break;

            case 9:
                $bulan_ini = "September";
            break;

            case 10:
                $bulan_ini = "Oktober";
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
        $tglprint = $bulan_ini.'-'.$bulan_ini2;
        $tglcetak = $hari3.' '.$bulan_ini3.' '.$tahun3;

        $jeniskendaraan = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->get();

        $totaljenis = array();
        foreach ($jeniskendaraan as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'jenis'         => $list->jenis,
                        'umum'          => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis',$list->jenis)->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'tidakumum'     => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis',$list->jenis)->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'pemerintah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis',$list->jenis)->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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

        $jenispengujian = array("UJI PERTAMA","UJI ULANG","NUMPANG UJI MASUK", "PINDAH MASUK","PINDAH KELUAR","NUMPANG UJI KELUAR");
        $totalkeuangan = array();
        
        foreach ($jenispengujian as $list) {
            if ($list == 'UJI PERTAMA') {
                $jenis = '1';
            }elseif($list == 'UJI ULANG'){
                $jenis = '2';
            }elseif($list == 'PEMERINTAH'){
                $jenis = '12';
            }elseif($list == 'NUMPANG UJI MASUK'){
                $jenis = '5';
            }elseif($list == 'PINDAH MASUK'){
                $jenis = '6';
            }elseif($list == 'NUMPANG UJI KELUAR'){
                $jenis = '9';
            }elseif($list == 'PINDAH KELUAR'){
                $jenis = '10';
            }
            $arr = array(
                    'jenispengujian' => $list,
                    'jasapengujian'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('jasapengujian'),
                    'administrasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('administrasi'),
                    'denda'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('denda'),
                    'kartu'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('kartu'),
                    'perubahanstatus'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('perubahanstatus'),
                    'perubahansifat'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('perubahansifat'),
                    'emisi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('emisi'),
                    'pengujiankeliling'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('pengujiankeliling'),
                    'numpangujidanmutasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('numpangujidanmutasi'),
                    'total'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('total'),
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
                    '0-1'             => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','>=',$tahun3-1)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '2'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-2)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '3'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-3)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '4'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-4)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '5'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-5)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '6'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-6)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '7'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-7)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '8'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-8)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '9'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun3-9)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '10'              => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','<=',$tahun3-10)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                );
            array_push($totaldayaangkutorang, $arr);
        }

        $merek = Merek::all();
        $totalmerek = array();
        foreach ($merek as $list) {
            $arr = array(
                    'merek'          => $list->merek,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','2')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','3')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','4')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','6')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','5')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('merek',$list->merek)->where('klasifikasis_id','7')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','2')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','3')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','4')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','6')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','5')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereBetween('tglpendaftaran',[$tglcreate1,$tglcreate2])->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','7')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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
                $bulan_ini = "Agustus";
            break;

            case 9:
                $bulan_ini = "September";
            break;

            case 10:
                $bulan_ini = "Oktober";
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
                        'umum'          => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$list->jenis)->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'tidakumum'     => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$list->jenis)->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'pemerintah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->whereYear('tglpendaftaran',$tahun)->where('jenis',$list->jenis)->where('peruntukan','Pemerintah')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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

        $jenispengujian = array("UJI PERTAMA","UJI ULANG","NUMPANG UJI MASUK", "PINDAH MASUK","PINDAH KELUAR","NUMPANG UJI KELUAR");
        $totalkeuangan = array();
        foreach ($jenispengujian as $list) {
            if ($list == 'UJI PERTAMA') {
                $jenis = '1';
            }elseif($list == 'UJI ULANG'){
                $jenis = '2';
            }elseif($list == 'PEMERINTAH'){
                $jenis = '12';
            }elseif($list == 'NUMPANG UJI MASUK'){
                $jenis = '5';
            }elseif($list == 'PINDAH MASUK'){
                $jenis = '6';
            }elseif($list == 'NUMPANG UJI KELUAR'){
                $jenis = '9';
            }elseif($list == 'PINDAH KELUAR'){
                $jenis = '10';
            }
            $arr = array(
                    'jenispengujian' => $list,
                    'jasapengujian'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('jasapengujian'),
                    'administrasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('administrasi'),
                    'denda'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('denda'),
                    'kartu'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('kartu'),
                    'perubahanstatus'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('perubahanstatus'),
                    'perubahansifat'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('perubahansifat'),
                    'emisi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('emisi'),
                    'pengujiankeliling'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('pengujiankeliling'),
                    'numpangujidanmutasi'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('numpangujidanmutasi'),
                    'total'  => Pendaftaran::leftJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('kodepenerbitans_id',$jenis)->whereYear('tglpendaftaran',$tahun)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('total'),
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
                    '0-1'             => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','>=',$tahun-1)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '2'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-2)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '3'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-3)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '4'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-4)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '5'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-5)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '6'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-6)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '7'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-7)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '8'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-8)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '9'               => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-9)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                    '10'              => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')->whereYear('tglpendaftaran',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','<=',$tahun-10)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(), 
                );
            array_push($totaldayaangkutorang, $arr);
        }

        $merek = Merek::all();
        $totalmerek = array();
        foreach ($merek as $list) {
            $arr = array(
                    'merek'          => $list->merek,
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','2')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','3')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','4')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','6')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','5')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('merek',$list->merek)->where('klasifikasis_id','7')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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
                    'mobilpenumpang' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','2')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbis'       => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','3')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'mobilbarang'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','4')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretatempelan' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','6')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'keretagandeng'  => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','5')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                    'kendaraankhusus'=> Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->leftJoin('jenis','jenis.jenis','=','identitaskendaraans.jenis')->whereYear('tglpendaftaran',$tgl)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','7')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
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

        $umum       = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('peruntukan','Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $tidakumum  = Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->where('tglpendaftaran',$tgl)->where('peruntukan','Tidak Umum')->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count();
        $jeniskendaraan = Jenis::all();
        $jenispelayanan = kodepenerbitan::all();

        $totaljenis = array();
        foreach ($jeniskendaraan as $jenis) {
            $arr = array(
                        'jenis'     => $jenis->jenis,
                        'jumlah'    => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('jenis',$jenis->jenis)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'umum'      => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('peruntukan','Umum')->where('jenis',$jenis->jenis)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'tidakumum' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('peruntukan','Tidak Umum')->where('jenis',$jenis->jenis)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->count(),
                        'retribusi' => Pendaftaran::leftJoin('identitaskendaraans','identitaskendaraans.id','=','pendaftarans.identitaskendaraan_id')->rightJoin('transaksis','transaksis.pendaftaran_id','=','pendaftarans.id')->where('tglpendaftaran',$tgl)->where('jenis',$jenis->jenis)->where('kodepenerbitans_id','!=','7')->where('kodepenerbitans_id','!=','12')->where('kodepenerbitans_id','!=','3')->sum('retribusi'),
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

    public function getDatakendaraanall(){
        $datakendaraans = Identitaskendaraan::
                          leftJoin('datakendaraans','datakendaraans.identitaskendaraan_id','=','identitaskendaraans.id')
                        ->select(
                            'identitaskendaraans.nama', 
                            'identitaskendaraans.noregistrasikendaraan',
                            'identitaskendaraans.nouji', 
                            'identitaskendaraans.merek', 
                            'identitaskendaraans.tipe',
                            'identitaskendaraans.jenis',
                            'datakendaraans.panjangkendaraan',
                            'datakendaraans.lebarkendaraan',
                            'datakendaraans.tinggikendaraan',
                            'jbb',
                            'nosertifikatreg'
                            )
                        ->groupBy('identitaskendaraans.nouji')->get();
        return response()->json($datakendaraans);

    }

    public function printlaporanloketpendaftaranlama($tgl)
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

        $kendaraan  = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('kodepenerbitans','kodepenerbitans.id','=','datapengujianlama.statuspenerbitan')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.noseri')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->where('tglpendaftaraan',$tgl)->groupBy('pendaftaraan.idx')->get();
        $tidaklulus = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('tglpendaftaraan',$tgl)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->where(function ($tidaklulus){ $tidaklulus->where('statuslulusuji','0')->orWhereNull('statuslulusuji');})->get();
        $numpanguji = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('tglpendaftaraan',$tgl)->where(function ($numpanguji){ $numpanguji->where('statuspenerbitan','5')->orWhere('statuspenerbitan','9');})->get();
        
        $datajm['mobilpenumpang1'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','2')->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['mobilpenumpang2'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','2')->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['mobilpenumpang3'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','2')->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();

        $datajm['kendaraankhusus1'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','7')->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['kendaraankhusus2'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','7')->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['kendaraankhusus3'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','7')->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();

        $datajm['mobilbus1'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','3')->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['mobilbus2'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','3')->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $data['mobilbus3'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','3')->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();

        $datajm['mobilbarang1'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','4')->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['mobilbarang2'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','4')->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['mobilbarang3'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','4')->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();

        $datajm['keretatempelan1'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','6')->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['keretatempelan2'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','6')->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['keretatempelan3'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','6')->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();

        $datajm['keretagandeng1'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','5')->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['keretagandeng2'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','5')->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['keretagandeng3'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','5')->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();

        $datajm['kendaraanroda31'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','8')->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['kendaraanroda32'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','8')->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        $datajm['kendaraanroda33'] = PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','Pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->where('tglpendaftaraan',$tgl)->where('klasifikasis_id','8')->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count();
        return view('admin.cetak.laporanpendaftaranlama_print', ['kendaraan' => $kendaraan,'tglprint' => $tglprint, 'tidaklulus' => $tidaklulus, 'datajm' => $datajm, 'numpanguji' => $numpanguji]);
    }

    public function printlaporanpendaftaranbulananlama($tgl)
    {
        $tglcetak = date_create(date("d-m-Y"));
        $tglcreate = date_create($tgl);
        $hari = date_format($tglcreate,"d");
        $bulan = date_format($tglcreate,"m");
        $tahun = date_format($tglcreate,"Y");
        $hari1 = date_format($tglcetak,"d");
        $bulan1 = date_format($tglcetak,"m");
        $tahun1 = date_format($tglcetak,"Y");
        
        switch($bulan){
            case 1:
                $bulan_ini1 = "Januari";
            break;
     
            case 2:         
                $bulan_ini1 = "Febuari";
            break;
     
            case 3:
                $bulan_ini1 = "Maret";
            break;
     
            case 4:
                $bulan_ini1 = "April";
            break;
     
            case 5:
                $bulan_ini1 = "Mei";
            break;
     
            case 6:
                $bulan_ini1 = "Juni";
            break;
     
            case 7:
                $bulan_ini1 = "Juli";
            break;

            case 8:
                $bulan_ini1 = "Juli";
            break;

            case 9:
                $bulan_ini1 = "Juli";
            break;

            case 10:
                $bulan_ini = "Agustus";
            break;

            case 11:
                $bulan_ini = "November";
            break;

            case 12:
                $bulan_ini1 = "Desember";
            break;
            
            default:
                $bulan_ini1 = "Tidak di ketahui";     
            break;
        }
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
        $tglprint = $bulan_ini1;
        $tglcetak = $hari1.' '.$bulan_ini.' '.$tahun1;

        $jeniskendaraan = Jenis::leftJoin('klasifikasis','klasifikasis.id','=','jenis.klasifikasis_id')->get();

        $totaljenis = array();
        foreach ($jeniskendaraan as $list) {
            $arr = array(
                        'klasifikasis'  => $list->klasifikasis,
                        'jenis'         => $list->jenis,
                        'umum'          => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis',$list->jenis)->where('statuspenggunaan','Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                        'tidakumum'     => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis',$list->jenis)->where('statuspenggunaan','Tidak Umum')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                        'pemerintah'    => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis',$list->jenis)->where('statuspenggunaan','Pemerintah')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
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

        $jenispengujian = array("UJI PERTAMA","UJI ULANG","NUMPANG UJI MASUK", "PINDAH MASUK","PINDAH KELUAR","NUMPANG UJI KELUAR");
        $totalkeuangan = array();
        foreach ($jenispengujian as $list) {
            if ($list == 'UJI PERTAMA') {
                $jenis = '1';
            }elseif($list == 'UJI ULANG'){
                $jenis = '2';
            }elseif($list == 'PEMERINTAH'){
                $jenis = '12';
            }elseif($list == 'NUMPANG UJI MASUK'){
                $jenis = '5';
            }elseif($list == 'PINDAH MASUK'){
                $jenis = '6';
            }elseif($list == 'NUMPANG UJI KELUAR'){
                $jenis = '9';
            }elseif($list == 'PINDAH KELUAR'){
                $jenis = '10';
            }
            $arr = array(
                    'jenispengujian' => $list,
                    'jasapengujian'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('jasapengujian'),
                    'administrasi'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('administrasi'),
                    'denda'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('denda'),
                    'pengolahannomer'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('pengolahannomer'),
                    'pmbtandasamping'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('pmbtandasamping'),
                    'tandaujibaut'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('tandaujibaut'),
                    'bukuuji'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('bukuuji'),
                    'total'  => PendaftranOld::leftJoin('transaksi','transaksi.noseri','=','pendaftaraan.id')->leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->where('statuspenerbitan',$jenis)->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->sum('total'),
                );
            array_push($totalkeuangan, $arr);

        }
        $dayaangkutorang = array("RENTAL = 5/9 ORANG","TAKSI = 4/5 ORANG","TAKSI = 6/7 ORANG","AJDP = 6/7 ORANG","OPLET = 8/9 ORANG", "BIS = 10/12 ORANG","BIS = 13/30 ORANG", "BIS = 21/30 ORANG","BIS = 31/40 ORANG","BIS = 40 KEATAS");
        $totaldayaangkutorang = array();
        foreach ($dayaangkutorang as $list) {
            if ($list == 'RENTAL = 5/9 ORANG') {
                $jenis = 'RENTAL';
                $jmlorang1 = 5;
                $jmlorang2 = 9;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 4;
                $jmlorang2 = 5;
            }elseif ($list == 'TAKSI = 6/7 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 6;
                $jmlorang2 = 7;
            }elseif ($list == 'TAKSI = 4/5 ORANG') {
                $jenis = 'TAKSI';
                $jmlorang1 = 4;
                $jmlorang2 = 5;
            }elseif ($list == 'AJDP = 6/7 ORANG') {
                $jenis = 'AJDP';
                $jmlorang1 = 6;
                $jmlorang2 = 7;
            }elseif ($list == 'BIS = 10/12 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 10;
                $jmlorang2 = 12;
            }elseif ($list == 'BIS = 13/20 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 13;
                $jmlorang2 = 20;
            }elseif ($list == 'BIS = 21/30 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 21;
                $jmlorang2 = 30;
            }elseif ($list == 'BIS = 31/40 ORANG') {
                $jenis = 'BIS';
                $jmlorang1 = 31;
                $jmlorang2 = 40;
            }elseif ($list == 'BIS = 40 KEATAS') {
                $jenis = 'BIS';
                $jmlorang1 = 40;
                $jmlorang2 = 60;
            }
            $arr = array(
                    'dayaangkutorang' => $list,
                    '0-1'             => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','>=',$tahun-1)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '2'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-2)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '3'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-3)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '4'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-4)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '5'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-5)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '6'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-6)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '7'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-7)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '8'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-8)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '9'               => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','=',$tahun-9)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                    '10'              => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jenis','like','%'.$jenis.'%')->where('dayaangkutorang','>=',$jmlorang1)->where('dayaangkutorang','<=',$jmlorang2)->where('thpembuatan','<=',$tahun-10)->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(), 
                );
            array_push($totaldayaangkutorang, $arr);
        }

        $merek = Merek::all();
        $totalmerek = array();
        foreach ($merek as $list) {
            $arr = array(
                    'merek'          => $list->merek,
                    'mobilpenumpang' => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('merek',$list->merek)->where('klasifikasis_id','2')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'mobilbis'       => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('merek',$list->merek)->where('klasifikasis_id','3')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'mobilbarang'    => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('merek',$list->merek)->where('klasifikasis_id','4')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'keretatempelan' => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('merek',$list->merek)->where('klasifikasis_id','6')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'keretagandeng'  => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('merek',$list->merek)->where('klasifikasis_id','5')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'kendaraankhusus'=> PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('merek',$list->merek)->where('klasifikasis_id','7')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
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
                    'mobilpenumpang' => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','2')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'mobilbis'       => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','3')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'mobilbarang'    => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','4')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'keretatempelan' => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','6')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'keretagandeng'  => PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','5')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                    'kendaraankhusus'=> PendaftranOld::leftJoin('datapengujianlama','datapengujianlama.id','=','pendaftaraan.id')->leftJoin('jenis','jenis.jenis','=','datapengujianlama.jenis')->whereMonth('tglpendaftaraan',$bulan)->whereYear('tglpendaftaraan',$tahun)->where('jbb','>=',$jbb1)->where('jbb','<=',$jbb2)->where('klasifikasis_id','7')->where('statuspenerbitan','!=','7')->where('statuspenerbitan','!=','12')->count(),
                );
            array_push($totaljbb, $arr);
        }


        return view('admin.cetak.laporanpendaftaranbulananlama_print', ['tglprint' => $tglprint,'tglcetak' => $tglcetak, 'totaljenis' => $totaljenis, 'totalklasifikasi' => $totalklasifikasi, 'jumlah' => $jumlah, 'totaldayaangkutorang' => $totaldayaangkutorang, 'totalmerek' => $totalmerek, 'totaljbb' => $totaljbb, 'totalkeuangan' => $totalkeuangan ]);
    }}
