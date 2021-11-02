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
            font-size:18px;
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
            font-size: 8px;
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
              <P>TANGGAL</P>
            </div>
            <div class="col-11">
              <p class="text-left">: LAPORAN DATA KENDARAAN UJI</p>
              <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
              <p class="text-left">: {{ $tglprint }}</p>
            </div>      
        </div>
        <div class="row">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2" class="text-center">NO</th>         
                        <th scope="col" colspan="2" class="text-center">Nomer</th>
                        <th scope="col" colspan="2" class="text-center">Pemilik</th>
                        <th scope="col" colspan="6" class="text-center">Data Kendaraan</th>        
                        <th scope="col" rowspan="2" class="text-center">Tanggal Nomer Kwitansi</th>
                        <th scope="col" colspan="5" class="text-center">Setoran Kas Negara Penerimaan Uang</th>
                        <th scope="col" rowspan="2" class="text-center">Ket.</th>       
                      </tr>
                      <tr>    
                        <th>Polisi</th> 
                        <th>Kontrol</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Merk</th>
                        <th>Type</th>
                        <th>Jenis</th>
                        <th>Tahun</th>
                        <th>Bahan Bakar</th>
                        <th>Status Penggunaan</th>
                        <th scope="col" class="text-center">JASA PENGUJIAN</th>
                        <th scope="col" class="text-center">PENGOLALAAN NOMER </th>
                        <th scope="col" class="text-center">PENGADAAN BLANGKO</th>
                        <!-- <th scope="col" class="text-center">KARTU UJI</th> -->
                        <!-- <th scope="col" class="text-center">PERUBAHAN STATUS</th> -->
                        <!-- <th scope="col" class="text-center">PERUBAHAN SIFAT</th> -->
                        <th scope="col" class="text-center">DENDA</th>
                        <!-- <th scope="col" class="text-center">PENGUJIAN KELILING</th> -->
                        <!-- <th scope="col" class="text-center">EMISI GAS BUANG</th> -->
                        <!-- <th scope="col" class="text-center">NUMPANG UJI & MUTASI</th> -->
                        <th scope="col" class="text-center">TOTAL</th>
                      </tr>
                </thead>
                <tbody>
                @php $i=1;$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;$tot5 = 0;$tot6 = 0;$tot7 = 0;$tot8 = 0;$tot9 = 0;$tot10 = 0;
                @endphp
                @foreach ($kendaraan as $data) 
                <tr>
                  <th scope="row">{{ $i }}</th>
                  <td>{{ $data->noregistrasikendaraan }}</td>
                  <td>{{ $data->nouji }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->alamat }}</td>
                  <td>{{ $data->merek }}</td>
                  <td>{{ $data->tipe }}</td>
                  <td>{{ $data->jenis }}</td>
                  <td>{{ $data->thpembuatan }}</td>
                  <td>{{ $data->bahanbakar }}</td>
                  <td>{{ $data->peruntukan }}</td>
                  <td>{{ $data->nokwitansi }}</td>
                  <td>{{ $data->jasapengujian }}</td>
                  <td>{{ $data->administrasi }}</td>
                  <td>{{ $data->blangko }}</td>
                  <!-- <td>{{ $data->perubahanstatus }}</td>
                  <td>{{ $data->perubahansifat }}</td> -->
                  <td>{{ $data->denda }}</td>
                  <!-- <td>{{ $data->pengujiankeliling }}</td>
                  <td>{{ $data->emisi }}</td>
                  <td>{{ $data->numpangujidanmutasi }}</td> -->
                  <td>{{ $data->total }}</td>
                  @if ($data->statuslulusuji == 1)
                  <td>LULUS</td>
                  @else
                  <td>TIDAK LULUS</td>
                  @endif
                </tr>
                @php $i++;$tot1=$tot1+$data->jasapengujian;$tot2=$tot2+$data->administrasi;$tot3=$tot3+$data->blangko;$tot6=$tot6+$data->denda;$tot10=$tot10+$data->total;
                @endphp
                @endforeach
                <tr>
                  <td colspan="12">JUMLAH KAS </td>
                  <td>{{ $tot1 }}</td>
                  <td>{{ $tot2 }}</td>
                  <td>{{ $tot3 }}</td>
                  <!-- <td>{{ $tot4 }}</td>
                  <td>{{ $tot5 }}</td> -->
                  <td>{{ $tot6 }}</td>
               <!--    <td>{{ $tot7 }}</td>
                  <td>{{ $tot8 }}</td>
                  <td>{{ $tot9 }}</td> -->
                  <td>{{ $tot10 }}</td>
                </tr>
                </tbody>
            </table>       
            </div>
            <br><br>
        </div>
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <b>
                    <p>Mengetahui,</p>
                    <P>Kepala UPU Berkala</P>
                    <P>Pengujian Kendaraan Bermotor</P>
                    <br><br>
                    <br>
                    <p>EFFENDI, Ama.PKB</p>
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
              <P>TANGGAL</P>
            </div>
            <div class="col-11">
              <p class="text-left">: LAPORAN JUMLAH DATA KENDARAAN TIDAK LULUS UJI</p>
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
                      <th scope="col" colspan="2" class="text-center">Nomer</th>
                      <th scope="col" colspan="3" class="text-center">Data Kendaraan</th>        
                      <th scope="col" rowspan="2" class="text-center">Alasan Penolakan</th>       
                    </tr>
                    <tr>    
                      <th>Polisi</th> 
                      <th>Kontrol</th>
                      <th>Merk</th>         
                      <th>Jenis</th>
                      <th>Tahun Buat</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1
                @endphp
                @foreach ($tidaklulus as $data) 
                  <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $data->noregistrasikendaraan }}</td>
                    <td>{{ $data->nouji }}</td>
                    <td>{{ $data->merek }}</td>
                    <td>{{ $data->jenis }}</td>
                    <td>{{ $data->thpembuatan }}</td>
                    <td>
                    @if ($data->kodepenerbitans_id == '9')
                    {{ 'Numpang Uji Keluar' }}
                    @elseif ($data->kodepenerbitans_id == '10')
                    {{ 'Mutasi Keluar' }}
                    @else
                    {{ $data->catatanpos1 }} , {{ $data->catatanpos2 }} , {{ $data->catatanpos3 }}
                    @endif
                    </td>
                  </tr>
                @php $i++
                @endphp
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <b>
                    <p>Mengetahui,</p>
                    <P>Kepala UPU Berkala</P>
                    <P>Pengujian Kendaraan Bermotor</P>
                    <br><br>
                    <br>
                    <p>EFFENDI, Ama.PKB</p>
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
              <P>TANGGAL</P>
            </div>
            <div class="col-11">
              <p class="text-left">: LAPORAN CETAK KARTU UJI</p>
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
                      <th scope="col" colspan="2" class="text-center">Nomer</th>
                      <th scope="col" colspan="2" class="text-center">Data Kendaraan</th>        
                      <th scope="col" rowspan="2" class="text-center">Nomer Kartu</th>       
                      <th scope="col" rowspan="2" class="text-center">Nomer Sertifikat</th>       
                      <th scope="col" rowspan="2" class="text-center">Nomer Kwitansi</th>       
                    </tr>
                    <tr>    
                      <th>Polisi</th> 
                      <th>Kontrol</th>
                      <th>Merk</th>         
                      <th>Jenis</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1
                @endphp
                @foreach ($kartu as $data) 
                  <tr>
                    <td scope="row">{{ $i }}</td>
                    <td>{{ $data->noregistrasikendaraan }}</td>
                    <td>{{ $data->nouji }}</td>
                    <td>{{ $data->merek }}</td>
                    <td>{{ $data->jenis }}</td>
                    <td>{{ $data->nokendalikartu }}</td>
                    <td>{{ $data->nosertifikat }}</td>
                    <td>{{ $data->nokwitansi }}</td>
                  </tr>
                @php $i++
                @endphp
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <b>
                    <p>Mengetahui,</p>
                    <P>Kepala UPU Berkala</P>
                    <P>Pengujian Kendaraan Bermotor</P>
                    <br><br>
                    <br>
                    <p>EFFENDI, Ama.PKB</p>
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
              <P>TANGGAL</P>
            </div>
            <div class="col-11">
              <p class="text-left">: LAPORAN JUMLAH DATA KENDARAAN NUMPANG UJI UJI</p>
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
                      <th scope="col" colspan="2" class="text-center">Nomer</th>
                      <th scope="col" colspan="4" class="text-center">Data Kendaraan</th>        
                    </tr>
                    <tr>    
                      <th>Polisi</th> 
                      <th>Kontrol</th>
                      <th>Merk</th>         
                      <th>Jenis</th>
                      <th>Tahun Buat</th>
                      <th>Jenis Pendafatran</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1
                @endphp
                @foreach ($numpanguji as $data) 
                  <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $data->noregistrasikendaraan }}</td>
                    <td>{{ $data->nouji }}</td>
                    <td>{{ $data->merek }}</td>
                    <td>{{ $data->jenis }}</td>
                    <td>{{ $data->thpembuatan }}</td>
                    <td>@if ($data->kodepenerbitans_id == '9')
                        {{ 'Numpang Uji Keluar' }}
                        @elseif ($data->kodepenerbitans_id == '5')
                        {{ 'Numpang Uji Masuk' }}
                        @endif
                    </td>
                  </tr>
                @php $i++
                @endphp
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        
        <br>
        <div class="row" style="font-size:14px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <b>
                    <p>Mengetahui,</p>
                    <P>Kepala UPU Berkala</P>
                    <P>Pengujian Kendaraan Bermotor</P>
                    <br><br>
                    <br>
                    <p>EFFENDI, Ama.PKB</p>
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
              <P>TANGGAL</P>
            </div>
            <div class="col-11">
              <p class="text-left">: LAPORAN JUMLAH DATA KENDARAAN UJI PERJENIS KENDARAAN</p>
              <p class="text-left">: DINAS PERHBUNGAN KOTA DUMAI</p>
              <p class="text-left">: {{ $tglprint }}</p>
            </div>      
        </div>
    
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered ">
                <thead>
                     <tr>
                      <th colspan="22" class="text-center">Jenis Kendaraan</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="col" colspan="1"></td>
                    <td colspan="3">Mobil Penumpang</td>
                    <td colspan="3">Mobil Bus</td>
                    <td colspan="3">Mobil Barang</td>
                    <td colspan="3">Mobil Tempelan</td>
                    <td colspan="3">KRT. Gandengan</td>
                    <td colspan="3">Kend. Roda 3</td>
                    <td colspan="3">Kend. Khusus</td>
                  </tr>
                  <tr>
                    <td>Sifat</td>
                    <td>UMUM</td>
                    <td>TDK. UMUM</td>
                    <td>PEMERINTAH</td>
                    <td>UMUM</td>
                    <td>TDK. UMUM</td>
                    <td>PEMERINTAH</td>
                    <td>UMUM</td>
                    <td>TDK. UMUM</td>
                    <td>PEMERINTAH</td>
                    <td>UMUM</td>
                    <td>TDK. UMUM</td>
                    <td>PEMERINTAH</td>
                    <td>UMUM</td>
                    <td>TDK. UMUM</td>
                    <td>PEMERINTAH</td>
                    <td>UMUM</td>
                    <td>TDK. UMUM</td>
                    <td>PEMERINTAH</td>
                    <td>UMUM</td>
                    <td>TDK. UMUM</td>
                    <td>PEMERINTAH</td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td><?php if (!empty($datajm['mobilpenumpang1'])) echo $datajm['mobilpenumpang1'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilpenumpang2'])) echo $datajm['mobilpenumpang2'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilpenumpang3'])) echo $datajm['mobilpenumpang3'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilbus1'])) echo $datajm['mobilbus1'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilbus2'])) echo $datajm['mobilbus2'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilbus3'])) echo $datajm['mobilbus3'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilbarang1'])) echo $datajm['mobilbarang1'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilbarang2'])) echo $datajm['mobilbarang2'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['mobilbarang3'])) echo $datajm['mobilbarang3'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['keretatempelan1'])) echo $datajm['keretatempelan1'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['keretatempelan2'])) echo $datajm['keretatempelan2'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['keretatempelan3'])) echo $datajm['keretatempelan3'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['keretagandeng1'])) echo $datajm['keretagandeng1'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['keretagandeng2'])) echo $datajm['keretagandeng2'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['keretagandeng3'])) echo $datajm['keretagandeng3'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['kendaraankhusus1'])) echo $datajm['kendaraankhusus1'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['kendaraankhusus2'])) echo $datajm['kendaraankhusus2'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['kendaraankhusus3'])) echo $datajm['kendaraankhusus3'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['kendaraanroda31'])) echo $datajm['kendaraanroda31'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['kendaraanroda32'])) echo $datajm['kendaraanroda32'] ; else echo '0' ?></td>
                    <td><?php if (!empty($datajm['kendaraanroda33'])) echo $datajm['kendaraanroda33'] ; else echo '0' ?></td>
                  </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <div class="container-fluid kertasbaru">
        <div class="row">
            <div class="col-1">
                <p>DAFTAR</p>
                <P>PADA</P>
                <P>TANGGAL</P>
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
                <b>
                    <p>Mengetahui,</p>
                    <P>Kepala UPU Berkala</P>
                    <P>Pengujian Kendaraan Bermotor</P>
                    <br><br>
                    <br>
                    <p>EFFENDI, Ama.PKB</p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>
</body>
</html>