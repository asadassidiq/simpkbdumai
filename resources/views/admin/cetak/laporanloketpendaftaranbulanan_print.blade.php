 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soltindo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            color:#333;
            text-align:left;
            font-size:10px;
            margin:0;
        }
        .container{
            margin:0 auto;
            margin-top:35px;
            padding:40px;
            width:750px;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            font-size: 10px;
            width: auto;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
         @page { size: landscape; }

         @media print {
          .kertasbaru {page-break-before: always;}
        }
    </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: TAMAN KENDARAAN BERMOTOR</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>
                        <th scope="col" rowspan="2" colspan="2" class="text-center">JENIS KENDARAAN</th>                    
                        <th scope="col" colspan="3" class="text-center">SIFAT KENDARAAN</th>                    
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">UMUM</th>
                        <th scope="col" class="text-center">TIDAK UMUM</th>
                        <th scope="col" class="text-center">PEMERINTAH</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$umum=0;$tidakumum=0;$pemerintah=0;
                @endphp
                @foreach ($totaljenis as $data) 
                  <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td>{{ $data['klasifikasis']  }}</td>
                    <td>{{ $data['jenis']  }}</td>
                    <td class="text-center">{{ $data['umum']  }}</td>
                    <td class="text-center">{{ $data['tidakumum']  }}</td>
                    <td class="text-center">{{ $data['pemerintah']  }}</td>
                    <td class="text-center">{{ $data['umum']+$data['tidakumum']+$data['pemerintah']  }}</td>
                  </tr>
                @php $i++;$umum=$umum+$data['umum'];$tidakumum=$tidakumum+$data['tidakumum'];$pemerintah=$pemerintah+$data['pemerintah'];
                @endphp
                @endforeach
                <tr>
                      <td colspan="2" class="text-center"> JUMLAH</td>
                      <td></td>
                      <td class="text-center">{{ $umum }}</td>
                      <td class="text-center">{{ $tidakumum }}</td>
                      <td class="text-center">{{ $pemerintah }}</td>
                      <td class="text-center">{{ $umum+$tidakumum+$pemerintah }}</td>
                  </tr>
                </tbody>
            </table>
            </div>
        </div>
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: TAMAN KENDARAAN WAJIB UJI BERDASARKAN JENIS DAN SIFAT</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">JENIS KENDARAAN</th>                    
                        <th scope="col" rowspan="2" class="text-center">SIFAT</th>                    
                        <th scope="col" rowspan="2" class="text-center">TAHUN LALU</th>
                        <th scope="col" colspan="4" class="text-center">MASUK</th>
                        <th scope="col" colspan="5" class="text-center">KELUAR</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH AKHIR</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">UJI PERTAMA</th>
                        <th scope="col" class="text-center">BERUBAH JENIS</th>
                        <th scope="col" class="text-center">BERUBAH SIFAT</th>
                        <th scope="col" class="text-center">MUTASI</th>
                        <th scope="col" class="text-center">UJI PERTAMA</th>
                        <th scope="col" class="text-center">BERUBAH JENIS</th>
                        <th scope="col" class="text-center">BERUBAH SIFAT</th>
                        <th scope="col" class="text-center">MUTASI</th>
                        <th scope="col" class="text-center">AFKIR</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$totakhir = 0;
                @endphp
                @foreach ($totalklasifikasi as $data) 
                  <tr>
                    <th rowspan="4">{{ $data['klasifikasis']  }}</th>
                  </tr>
                        @foreach ($data['sifat'] as $data1)
                        <tr class="text-center">
                            <td>{{ $data1['sifat']  }}</td>
                            <td>{{ $data1['thlalu']  }}</td>
                            <td>{{ $data1['ujipertama']  }}</td>
                            <td>{{ $data1['berubahjenis']  }}</td>
                            <td>{{ $data1['berubahsifat']  }}</td>
                            <td>{{ $data1['mutasimasuk']  }}</td>
                            <td>{{ $data1['numpangujikeluar']  }}</td>
                            <td>{{ $data1['berubahjeniskeluar']  }}</td>
                            <td>{{ $data1['berubahsifatkeluar']  }}</td>
                            <td>{{ $data1['mutasikeluar']  }}</td>
                            <td>{{ $data1['afkirkeluar']  }}</td>
                            <td>{{ $data1['thlalu']+$data1['ujipertama']+$data1['berubahjenis']+$data1['berubahsifat']+$data1['mutasimasuk']-$data1['numpangujikeluar']-$data1['berubahjeniskeluar']-$data1['berubahsifatkeluar']-$data1['mutasikeluar']-$data1['afkirkeluar']}}</td>
                        </tr>
                        @endforeach
                @php $i++;$tot1=$tot1+$data1['thlalu'];$tot2=$tot2+$data1['ujipertama'];$tot3=$tot3+$data1['berubahjenis'];$tot4=$tot4+$data1['berubahsifat'];$tot5=$tot5+$data1['mutasimasuk'];$tot6=$tot6+$data1['numpangujikeluar'];$tot7=$tot7+$data1['berubahjeniskeluar'];$tot8=$tot8+$data1['berubahsifatkeluar'];$tot9=$tot9+$data1['mutasikeluar'];$tot10=$tot10+$data1['afkirkeluar'];
                @endphp
                @endforeach
                    <tr>
                        <th rowspan="4">JUMLAH</th>
                    </tr>
                        @php $$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$totakhir = 0;
                        @endphp
                        @foreach ($jumlah as $data) 
                        @foreach ($data['sifat'] as $data1)
                        <tr class="text-center">
                            <td>{{ $data1['sifat']  }}</td>
                            <td>{{ $data1['thlalu']  }}</td>
                            <td>{{ $data1['ujipertama']  }}</td>
                            <td>{{ $data1['berubahjenis']  }}</td>
                            <td>{{ $data1['berubahsifat']  }}</td>
                            <td>{{ $data1['mutasimasuk']  }}</td>
                            <td>{{ $data1['numpangujikeluar']  }}</td>
                            <td>{{ $data1['berubahjeniskeluar']  }}</td>
                            <td>{{ $data1['berubahsifatkeluar']  }}</td>
                            <td>{{ $data1['mutasikeluar']  }}</td>
                            <td>{{ $data1['afkirkeluar']  }}</td>
                        </tr>
                        @endforeach
                        @php $tot1=$tot1+$data1['thlalu'];$tot2=$tot2+$data1['ujipertama'];$tot3=$tot3+$data1['berubahjenis'];$tot4=$tot4+$data1['berubahsifat'];$tot5=$tot5+$data1['mutasimasuk'];$tot6=$tot6+$data1['numpangujikeluar'];$tot7=$tot7+$data1['berubahjeniskeluar'];$tot8=$tot8+$data1['berubahsifatkeluar'];$tot9=$tot9+$data1['mutasikeluar'];$tot10=$tot10+$data1['afkirkeluar'];
                        @endphp
                        @endforeach
                        <tr class="text-center">
                            <td colspan="2">JUMLAH KESELURUHAN</td>
                            <td>{{ $tot1 }}</td>
                            <td>{{ $tot2 }}</td>
                            <td>{{ $tot3 }}</td>
                            <td>{{ $tot4 }}</td>
                            <td>{{ $tot5 }}</td>
                            <td>{{ $tot6 }}</td>
                            <td>{{ $tot7 }}</td>
                            <td>{{ $tot8 }}</td>
                            <td>{{ $tot9 }}</td>
                            <td>{{ $tot10 }}</td>
                        </tr>
                </tbody>
            </table>
            </div>
        </div>
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: JUMLAH PENERIMAAN UANG UJI</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row" style="padding-bottom:0;margin-botom:0;">
            <div class="col-12">
            <table class="table table-bordered " style="line-height: 10px;">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>                    
                        <th scope="col" rowspan="2" class="text-center">JENIS PENGUJUAN</th>                    
                        <th scope="col" colspan="4" class="text-center">UANG</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">JASA PENGUJIAN</th>
                        <th scope="col" class="text-center">PENGADAAN BLANKO </th>
                        <!-- <th scope="col" class="text-center">KARTU UJI</th> -->
                        <th scope="col" class="text-center">DENDA</th>
                        <!-- <th scope="col" class="text-center">PERUBAHAN STATUS</th> -->
                        <!-- <th scope="col" class="text-center">PERUBAHAN SIFAT</th> -->
                        <!-- <th scope="col" class="text-center">PENGUJIAN KELILING</th> -->
                        <!-- <th scope="col" class="text-center">EMISI GAS BUANG</th> -->
                        <!-- <th scope="col" class="text-center">NUMPANG UJI & MUTASI</th> -->
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$totakhir = 0;
                @endphp
                @foreach ($totalkeuangan as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['jenispengujian'] }}</td>
                        <td>{{ $data['jasapengujian'] }}</td>
                        <td>{{ $data['administrasi'] }}</td>
                        <!-- <td>{{ $data['kartu'] }}</td> -->
                        <!-- <td>{{ $data['perubahanstatus'] }}</td> -->
                        <!-- <td>{{ $data['perubahansifat'] }}</td> -->
                        <td>{{ $data['denda'] }}</td>
                        <!-- <td>{{ $data['emisi'] }}</td> -->
                        <!-- <td>{{ $data['pengujiankeliling'] }}</td> -->
                        <!-- <td>{{ $data['numpangujidanmutasi'] }}</td> -->
                        <td>{{ $data['total'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['jasapengujian'];$tot2=$tot2+$data['administrasi'];$tot3=$tot3+$data['kartu'];$tot4=$tot4+$data['perubahanstatus'];$tot5=$tot5+$data['perubahansifat'];$tot6=$tot6+$data['denda'];$tot7=$tot7+$data['emisi'];$tot8=$tot8+$data['pengujiankeliling'];$tot9=$tot9+$data['numpangujidanmutasi'];$tot10=$tot10+$data['total'];
                @endphp
                @endforeach
                    <tr>
                        <td colspan="2">JUMLAH</td>
                        <td>{{ $tot1 }}</td>                        
                        <td>{{ $tot2 }}</td>                        
                        <!-- <td>{{ $tot3 }}</td>                         -->
                        <!-- <td>{{ $tot4 }}</td>                         -->
                        <!-- <td>{{ $tot5 }}</td>                         -->
                        <td>{{ $tot6 }}</td>                        
                        <!-- <td>{{ $tot7 }}</td>                         -->
                        <!-- <td>{{ $tot8 }}</td>                         -->
                        <td>{{ $tot9 }}</td>                        
                        <td>{{ $tot10 }}</td>                        
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row" style="font-size:14px;margin-top:0;padding-top:0;">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: DAYA ANGKUT DAN UMUR KENDARAAN PENUMPANG WAJIB UJI</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row" style="padding-bottom:0;margin-botom:0;">
            <div class="col-12">
            <table class="table table-bordered " style="line-height: 10px;">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>                    
                        <th scope="col" rowspan="2" class="text-center">DAYA ANGKUT ORANG</th>                    
                        <th scope="col" colspan="10" class="text-center">UMUR KENDARAAN</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">0-1</th>
                        <th scope="col" class="text-center">2</th>
                        <th scope="col" class="text-center">3</th>
                        <th scope="col" class="text-center">4</th>
                        <th scope="col" class="text-center">5</th>
                        <th scope="col" class="text-center">6</th>
                        <th scope="col" class="text-center">7</th>
                        <th scope="col" class="text-center">8</th>
                        <th scope="col" class="text-center">9</th>
                        <th scope="col" class="text-center">10 KE ATAS</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$totakhir = 0;
                @endphp
                @foreach ($totaldayaangkutorang as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['dayaangkutorang'] }}</td>
                        <td>{{ $data['0-1'] }}</td>
                        <td>{{ $data['2'] }}</td>
                        <td>{{ $data['3'] }}</td>
                        <td>{{ $data['4'] }}</td>
                        <td>{{ $data['5'] }}</td>
                        <td>{{ $data['6'] }}</td>
                        <td>{{ $data['7'] }}</td>
                        <td>{{ $data['8'] }}</td>
                        <td>{{ $data['9'] }}</td>
                        <td>{{ $data['10'] }}</td>
                        <td>{{ $data['0-1']+$data['2']+$data['3']+$data['4']+$data['5']+$data['6']+$data['7']+$data['8']+$data['9']+$data['10'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['0-1'];$tot2=$tot2+$data['2'];$tot3=$tot3+$data['3'];$tot4=$tot4+$data['4'];$tot5=$tot5+$data['5'];$tot6=$tot6+$data['6'];$tot7=$tot7+$data['7'];$tot8=$tot8+$data['8'];$tot9=$tot9+$data['9'];$tot10=$tot10+$data['10'];
                @endphp
                @endforeach
                    <tr>
                        <td colspan="2">JUMLAH</td>
                        <td>{{ $tot1 }}</td>                        
                        <td>{{ $tot2 }}</td>                        
                        <td>{{ $tot3 }}</td>                        
                        <td>{{ $tot4 }}</td>                        
                        <td>{{ $tot5 }}</td>                        
                        <td>{{ $tot6 }}</td>                        
                        <td>{{ $tot7 }}</td>                        
                        <td>{{ $tot8 }}</td>                        
                        <td>{{ $tot9 }}</td>                        
                        <td>{{ $tot10 }}</td>                        
                        <td>{{ $tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9+$tot10 }}</td>                        
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row" style="font-size:14px;margin-top:0;padding-top:0;">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                    
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: JUMLAH KENDARAAN WAJIB UJI BERDASARKAN MERK DAN JENIS KENDARAAN</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>                    
                        <th scope="col" rowspan="2" class="text-center">MEREK</th>                    
                        <th scope="col" colspan="6" class="text-center">JENIS KENDARAAN</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">MOBIL PENUMPANG</th>
                        <th scope="col" class="text-center">MOBIL BIS</th>
                        <th scope="col" class="text-center">MOBIL BARANG</th>
                        <th scope="col" class="text-center">KERETA TEMPELAN</th>
                        <th scope="col" class="text-center">KERETA GANDENG</th>
                        <th scope="col" class="text-center">KENDARAAN KHUSUS</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;
                @endphp
                @foreach ($totalmerek as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['merek'] }}</td>
                        <td>{{ $data['mobilpenumpang'] }}</td>
                        <td>{{ $data['mobilbis'] }}</td>
                        <td>{{ $data['mobilbarang'] }}</td>
                        <td>{{ $data['keretatempelan'] }}</td>
                        <td>{{ $data['keretagandeng'] }}</td>
                        <td>{{ $data['kendaraankhusus'] }}</td>
                        <td>{{ $data['mobilpenumpang']+$data['mobilbis']+$data['mobilbarang']+$data['keretagandeng']+$data['keretatempelan']+$data['kendaraankhusus'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['mobilpenumpang'];$tot2=$tot2+$data['mobilbis'];$tot3=$tot3+$data['mobilbarang'];$tot4=$tot4+$data['keretatempelan'];$tot5=$tot5+$data['keretagandeng'];$tot6=$tot6+$data['kendaraankhusus'];
                @endphp
                @endforeach
                    <tr>
                        <td colspan="2">JUMLAH</td>
                        <td>{{ $tot1 }}</td>
                        <td>{{ $tot2 }}</td>
                        <td>{{ $tot3 }}</td>
                        <td>{{ $tot4 }}</td>
                        <td>{{ $tot5 }}</td>
                        <td>{{ $tot6 }}</td>
                        <td>{{ $tot1+$tot2+$tot3+$tot4+$tot5+$tot6 }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: JUMLAH KENDARAAN WAJIB UJI BERDASARKAN GVW / JBB DAN DAYA ANGKUT</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered " style="line-height: 10px;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">NO</th>                    
                        <th scope="col" class="text-center">GVW / JBB</th>                    
                        <th scope="col" class="text-center">DAYA ANGKUT(Kg) ORANG + BARANG</th>
                        <th scope="col" class="text-center">MOBIL PENUMPANG</th>
                        <th scope="col" class="text-center">MOBIL BIS</th>
                        <th scope="col" class="text-center">MOBIL BARANG</th>
                        <th scope="col" class="text-center">KERETA TEMPELAN</th>
                        <th scope="col" class="text-center">KERETA GANDENG</th>
                        <th scope="col" class="text-center">KENDARAAN KHUSUS</th>
                        <th scope="col" class="text-center">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;
                @endphp
                @foreach ($totaljbb as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['jbb'] }}</td>
                        <td>{{ $data['daya'] }}</td>
                        <td>{{ $data['mobilpenumpang'] }}</td>
                        <td>{{ $data['mobilbis'] }}</td>
                        <td>{{ $data['mobilbarang'] }}</td>
                        <td>{{ $data['keretatempelan'] }}</td>
                        <td>{{ $data['keretagandeng'] }}</td>
                        <td>{{ $data['kendaraankhusus'] }}</td>
                        <td>{{ $data['mobilpenumpang']+$data['mobilbis']+$data['mobilbarang']+$data['keretagandeng']+$data['keretatempelan']+$data['kendaraankhusus'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['mobilpenumpang'];$tot2=$tot2+$data['mobilbis'];$tot3=$tot3+$data['mobilbarang'];$tot4=$tot4+$data['keretatempelan'];$tot5=$tot5+$data['keretagandeng'];$tot6=$tot6+$data['kendaraankhusus'];
                @endphp
                @endforeach
                    <tr>
                        <td colspan="3">JUMLAH</td>
                        <td>{{ $tot1 }}</td>
                        <td>{{ $tot2 }}</td>
                        <td>{{ $tot3 }}</td>
                        <td>{{ $tot4 }}</td>
                        <td>{{ $tot5 }}</td>
                        <td>{{ $tot6 }}</td>
                        <td>{{ $tot1+$tot2+$tot3+$tot4+$tot5+$tot6 }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: JUMLAH KENDARAAN NUMPANG UJI MASUK DALAM KOTA - KABUPATEN PROVINSI RIAU</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered " style="line-height: 10px;">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>                    
                        <th scope="col" rowspan="2" class="text-center">MASUK DARI DISHUB</th>                    
                        <th scope="col" colspan="2" class="text-center">MOBIL PENUMPANG</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BIS</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BARANG</th>
                        <th scope="col" colspan="2" class="text-center">KERETA TEMPELAN</th>
                        <th scope="col" colspan="2" class="text-center">KERETA GANDENG</th>
                        <th scope="col" colspan="2" class="text-center">KENDARAAN KHUSUS</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$tot11 = 0;$tot12 = 0;
                @endphp
                @foreach ($totalwilayahnu as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['wilayah'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbisumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelanumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhususumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbistidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelantidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengtidakumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhusustidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum']+$data['mobilbisumum']+$data['mobilbarangumum']+$data['keretagandengumum']+$data['keretatempelanumum']+$data['kendaraankhususumum']+$data['mobilpenumpangtidakumum']+$data['mobilbistidakumum']+$data['mobilbarangtidakumum']+$data['keretagandengtidakumum']+$data['keretatempelantidakumum']+$data['kendaraankhusustidakumum'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['mobilpenumpangumum'];$tot2=$tot2+$data['mobilbisumum'];$tot3=$tot3+$data['mobilbarangumum'];$tot4=$tot4+$data['keretatempelanumum'];$tot5=$tot5+$data['keretagandengumum'];$tot6=$tot6+$data['kendaraankhususumum'];$tot7=$tot7+$data['mobilpenumpangtidakumum'];$tot8=$tot8+$data['mobilbistidakumum'];$tot9=$tot9+$data['mobilbarangtidakumum'];$tot10=$tot10+$data['keretatempelantidakumum'];$tot11=$tot11+$data['keretagandengtidakumum'];$tot12=$tot12+$data['kendaraankhusustidakumum'];
                @endphp
                @endforeach
                    <tr>
                        <td class="text-center" colspan="2">JUMLAH</td>
                        <td class="text-center">{{ $tot1 }}</td>
                        <td class="text-center">{{ $tot2 }}</td>
                        <td class="text-center">{{ $tot3 }}</td>
                        <td class="text-center">{{ $tot4 }}</td>
                        <td class="text-center">{{ $tot5 }}</td>
                        <td class="text-center">{{ $tot6 }}</td>
                        <td class="text-center">{{ $tot7 }}</td>
                        <td class="text-center">{{ $tot8 }}</td>
                        <td class="text-center">{{ $tot9 }}</td>
                        <td class="text-center">{{ $tot10 }}</td>
                        <td class="text-center">{{ $tot11 }}</td>
                        <td class="text-center">{{ $tot12 }}</td>
                        <td class="text-center">{{ $tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9+$tot10+$tot11+$tot12 }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: JUMLAH KENDARAAN NUMPANG UJI MASUK DALAM KOTA - KABUPATEN INDONESIA</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>                    
                        <th scope="col" rowspan="2" class="text-center">MASUK DARI DISHUB</th>                    
                        <th scope="col" colspan="2" class="text-center">MOBIL PENUMPANG</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BIS</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BARANG</th>
                        <th scope="col" colspan="2" class="text-center">KERETA TEMPELAN</th>
                        <th scope="col" colspan="2" class="text-center">KERETA GANDENG</th>
                        <th scope="col" colspan="2" class="text-center">KENDARAAN KHUSUS</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$tot11 = 0;$tot12 = 0;
                @endphp
                @foreach ($totalwilayahnuall as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['wilayah'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbisumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelanumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhususumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbistidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelantidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengtidakumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhusustidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum']+$data['mobilbisumum']+$data['mobilbarangumum']+$data['keretagandengumum']+$data['keretatempelanumum']+$data['kendaraankhususumum']+$data['mobilpenumpangtidakumum']+$data['mobilbistidakumum']+$data['mobilbarangtidakumum']+$data['keretagandengtidakumum']+$data['keretatempelantidakumum']+$data['kendaraankhusustidakumum'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['mobilpenumpangumum'];$tot2=$tot2+$data['mobilbisumum'];$tot3=$tot3+$data['mobilbarangumum'];$tot4=$tot4+$data['keretatempelanumum'];$tot5=$tot5+$data['keretagandengumum'];$tot6=$tot6+$data['kendaraankhususumum'];$tot7=$tot7+$data['mobilpenumpangtidakumum'];$tot8=$tot8+$data['mobilbistidakumum'];$tot9=$tot9+$data['mobilbarangtidakumum'];$tot10=$tot10+$data['keretatempelantidakumum'];$tot11=$tot11+$data['keretagandengtidakumum'];$tot12=$tot12+$data['kendaraankhusustidakumum'];
                @endphp
                @endforeach
                    <tr>
                        <td class="text-center" colspan="2">JUMLAH</td>
                        <td class="text-center">{{ $tot1 }}</td>
                        <td class="text-center">{{ $tot2 }}</td>
                        <td class="text-center">{{ $tot3 }}</td>
                        <td class="text-center">{{ $tot4 }}</td>
                        <td class="text-center">{{ $tot5 }}</td>
                        <td class="text-center">{{ $tot6 }}</td>
                        <td class="text-center">{{ $tot7 }}</td>
                        <td class="text-center">{{ $tot8 }}</td>
                        <td class="text-center">{{ $tot9 }}</td>
                        <td class="text-center">{{ $tot10 }}</td>
                        <td class="text-center">{{ $tot11 }}</td>
                        <td class="text-center">{{ $tot12 }}</td>
                        <td class="text-center">{{ $tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9+$tot10+$tot11+$tot12 }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: JUMLAH KENDARAAN MUTASI MASUK DALAM KOTA - KABUPATEN PROVINSI RIAU</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered " style="line-height: 10px;">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>                    
                        <th scope="col" rowspan="2" class="text-center">MASUK DARI DISHUB</th>                    
                        <th scope="col" colspan="2" class="text-center">MOBIL PENUMPANG</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BIS</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BARANG</th>
                        <th scope="col" colspan="2" class="text-center">KERETA TEMPELAN</th>
                        <th scope="col" colspan="2" class="text-center">KERETA GANDENG</th>
                        <th scope="col" colspan="2" class="text-center">KENDARAAN KHUSUS</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$tot11 = 0;$tot12 = 0;
                @endphp
                @foreach ($totalwilayahmu as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['wilayah'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbisumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelanumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhususumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbistidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelantidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengtidakumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhusustidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum']+$data['mobilbisumum']+$data['mobilbarangumum']+$data['keretagandengumum']+$data['keretatempelanumum']+$data['kendaraankhususumum']+$data['mobilpenumpangtidakumum']+$data['mobilbistidakumum']+$data['mobilbarangtidakumum']+$data['keretagandengtidakumum']+$data['keretatempelantidakumum']+$data['kendaraankhusustidakumum'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['mobilpenumpangumum'];$tot2=$tot2+$data['mobilbisumum'];$tot3=$tot3+$data['mobilbarangumum'];$tot4=$tot4+$data['keretatempelanumum'];$tot5=$tot5+$data['keretagandengumum'];$tot6=$tot6+$data['kendaraankhususumum'];$tot7=$tot7+$data['mobilpenumpangtidakumum'];$tot8=$tot8+$data['mobilbistidakumum'];$tot9=$tot9+$data['mobilbarangtidakumum'];$tot10=$tot10+$data['keretatempelantidakumum'];$tot11=$tot11+$data['keretagandengtidakumum'];$tot12=$tot12+$data['kendaraankhusustidakumum'];
                @endphp
                @endforeach
                    <tr>
                        <td class="text-center" colspan="2">JUMLAH</td>
                        <td class="text-center">{{ $tot1 }}</td>
                        <td class="text-center">{{ $tot2 }}</td>
                        <td class="text-center">{{ $tot3 }}</td>
                        <td class="text-center">{{ $tot4 }}</td>
                        <td class="text-center">{{ $tot5 }}</td>
                        <td class="text-center">{{ $tot6 }}</td>
                        <td class="text-center">{{ $tot7 }}</td>
                        <td class="text-center">{{ $tot8 }}</td>
                        <td class="text-center">{{ $tot9 }}</td>
                        <td class="text-center">{{ $tot10 }}</td>
                        <td class="text-center">{{ $tot11 }}</td>
                        <td class="text-center">{{ $tot12 }}</td>
                        <td class="text-center">{{ $tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9+$tot10+$tot11+$tot12 }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TAHUN</P>
            </div>
            <div class="col-11">
                <p class="text-left">: JUMLAH KENDARAAN MUTASI MASUK DALAM KOTA - KABUPATEN INDONESIA</p>
                <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
                <p class="text-left">: {{ $tglprint }}</p>
            </div>  
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>                    
                        <th scope="col" rowspan="2" class="text-center">MASUK DARI DISHUB</th>                    
                        <th scope="col" colspan="2" class="text-center">MOBIL PENUMPANG</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BIS</th>
                        <th scope="col" colspan="2" class="text-center">MOBIL BARANG</th>
                        <th scope="col" colspan="2" class="text-center">KERETA TEMPELAN</th>
                        <th scope="col" colspan="2" class="text-center">KERETA GANDENG</th>
                        <th scope="col" colspan="2" class="text-center">KENDARAAN KHUSUS</th>
                        <th scope="col" rowspan="2" class="text-center">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                        <th scope="col">U</th>
                        <th scope="col">TU</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;$tot11 = 0;$tot12 = 0;
                @endphp
                @foreach ($totalwilayahmuall as $data)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['wilayah'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbisumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelanumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhususumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbistidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilbarangtidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretatempelantidakumum'] }}</td>
                        <td class="text-center">{{ $data['keretagandengtidakumum'] }}</td>
                        <td class="text-center">{{ $data['kendaraankhusustidakumum'] }}</td>
                        <td class="text-center">{{ $data['mobilpenumpangumum']+$data['mobilbisumum']+$data['mobilbarangumum']+$data['keretagandengumum']+$data['keretatempelanumum']+$data['kendaraankhususumum']+$data['mobilpenumpangtidakumum']+$data['mobilbistidakumum']+$data['mobilbarangtidakumum']+$data['keretagandengtidakumum']+$data['keretatempelantidakumum']+$data['kendaraankhusustidakumum'] }}</td>
                    </tr>
                @php $i++;$tot1=$tot1+$data['mobilpenumpangumum'];$tot2=$tot2+$data['mobilbisumum'];$tot3=$tot3+$data['mobilbarangumum'];$tot4=$tot4+$data['keretatempelanumum'];$tot5=$tot5+$data['keretagandengumum'];$tot6=$tot6+$data['kendaraankhususumum'];$tot7=$tot7+$data['mobilpenumpangtidakumum'];$tot8=$tot8+$data['mobilbistidakumum'];$tot9=$tot9+$data['mobilbarangtidakumum'];$tot10=$tot10+$data['keretatempelantidakumum'];$tot11=$tot11+$data['keretagandengtidakumum'];$tot12=$tot12+$data['kendaraankhusustidakumum'];
                @endphp
                @endforeach
                    <tr>
                        <td class="text-center" colspan="2">JUMLAH</td>
                        <td class="text-center">{{ $tot1 }}</td>
                        <td class="text-center">{{ $tot2 }}</td>
                        <td class="text-center">{{ $tot3 }}</td>
                        <td class="text-center">{{ $tot4 }}</td>
                        <td class="text-center">{{ $tot5 }}</td>
                        <td class="text-center">{{ $tot6 }}</td>
                        <td class="text-center">{{ $tot7 }}</td>
                        <td class="text-center">{{ $tot8 }}</td>
                        <td class="text-center">{{ $tot9 }}</td>
                        <td class="text-center">{{ $tot10 }}</td>
                        <td class="text-center">{{ $tot11 }}</td>
                        <td class="text-center">{{ $tot12 }}</td>
                        <td class="text-center">{{ $tot1+$tot2+$tot3+$tot4+$tot5+$tot6+$tot7+$tot8+$tot9+$tot10+$tot11+$tot12 }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Dumai, {{ $tglcetak }}</p>
                <b>
                    <P>Kepala UPU Berkala</P>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <br>
                    <p><u>EFFENDI, A.Ma.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>
</body>
</html>