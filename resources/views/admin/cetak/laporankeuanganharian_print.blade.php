<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            color:#333;
            text-align:left;
            font-size:14px;
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
            font-size: 11px;
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
        <div class="text-center">
            <h5><b>SETORAN PENGUJIAN KENDARAAN BERMOTOR </b></h5>
            <h5><b>PENGUJIAN KENDARAAN BERMOTOR PADA UPTD PKB KOTA BANJARMASIN</b></h5>
            <h5><b>{{ $tglprint }}</b></h5>
        </div>
        <div class="row">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th rowspan="2" scope="col">NO</th>
                      <th rowspan="2" scope="col" class="align-items-center">NO UJI KENDARAAN</th>
                      <th rowspan="2" scope="col">NO KENDARAAN</th>
                      <th rowspan="2" scope="col">NAMA PEMILIK</th>
                      <th rowspan="2" scope="col">JENIS KENDARAAN</th>
                      <th rowspan="2" scope="col">JBB</th>
                      <th rowspan="2" scope="col">KENDARAAN</th>
                      <th rowspan="2" scope="col">PERUNTUKAN</th>
                      <th rowspan="2" scope="col">DENDA BERAPA BULAN</th>
                      <th rowspan="2" scope="col">JUMLAH DENDA</th>
                      <th colspan="2" scope="col">RETRIBUSI</th>
                      <th rowspan="2" scope="col">PLAT UJI</th>
                      <th colspan="2" scope="col">BUKU UJI</th>
                      <th colspan="2" scope="col">REGISTRASI KEND.BERMOTOR</th>
                      <th colspan="2" scope="col">STIKER</th>
                      <th rowspan="2" scope="col">JUMLAH</th>
                    </tr>
                    <tr>
                        <th scope="col">KET</th>
                        <th scope="col">BIAYA</th>
                        <th scope="col">KET</th>
                        <th scope="col">BIAYA</th>
                        <th scope="col">KET</th>
                        <th scope="col">BIAYA</th>
                        <th scope="col">KET</th>
                        <th scope="col">BIAYA</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1; $denda=0; $retribusi=0; $platuji=0; $bukuuji=0; $regkend=0; $stiker=0;$total=0;
                @endphp
                @foreach ($kendaraan as $data) 
                <tr>
                  <th scope="row">{{ $i }}</th>
                  <td>{{ $data->nouji }}</td>
                  <td>{{ $data->noregistrasikendaraan }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->klasifikasis }}</td>
                  <td>{{ $data->jbb }}</td>
                  <td>{{ $data->jenis }}</td>
                  <td>{{ $data->peruntukan }}</td>
                  <td>{{ $data->blndenda }}</td>
                  <td>{{ $data->denda }}</td>
                  <td>{{ $data->keterangan }}</td>
                  <td>{{ $data->retribusi }}</td>
                  <td>{{ $data->platuji }}</td>
                  <td>{{ $data->ketbuku }}</td>
                  <td>{{ $data->bukuuji }}</td>
                  <td>{{ $data->keterangan }}</td>
                  <td>{{ $data->regkend }}</td>
                  <td></td>
                  <td>{{$data->stiker }}</td>
                  <td>{{$data->total }}</td>
                </tr>
                @php $i++; $denda=$denda+ $data->denda; $retribusi=$retribusi+$data->retribusi; $platuji=$platuji+$data->platuji; $bukuuji=$bukuuji+$data->bukuuji; $regkend=$regkend+$data->regkend; $stiker=$stiker+$data->stiker; $total= $total+$data->total;
                @endphp
                @endforeach
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $denda }}</td>
                    <td></td>
                    <td>{{ $retribusi }}</td>
                    <td>{{ $platuji }}</td>
                    <td></td>
                    <td>{{ $bukuuji }}</td>
                    <td></td>
                    <td>{{ $regkend }}</td>
                    <td></td>
                    <td>{{ $stiker }}</td>
                    <td>{{ $total }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-4 text-center">
                <b>
                    <P>Mengetahui</P>
                    <P>Kepala UPTD</P>
                    <br><br>
                    <br><br>
                    <p>A. JUNAIDI, SE</p>
                    <p>NIP. 19621221 198302 1 002</p>
                </b>
            </div>
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <b>
                    <P>Banjarmasin, {{ $tglprint }}</P>
                    <P>Pembantu Bendahara Penerimaan</P>
                    <br><br>
                    <br><br>
                    <p>MASPIANI</p>
                    <p>NIP. 19840109 201001 1 001</p>
                </b>
            </div>
        </div>

        <div class="container-fluid kertasbaru">
        <div class="text-left">
            <h5><b>LAMPIRAN 1</b></h5>
            <h5><b>DATA ADMINISTRASI</b></h5>
            <h5><b>{{ $tglprint }}</b></h5>
        </div>
    
        <div class="row">
            <div class="col-6">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th scope="col">JENIS KENDARAAN</th>
                      <th scope="col">JUMLAH</th>
                      <th scope="col">RETRIBUSI</th>
                      <th scope="col">UMUM</th>
                      <th scope="col">TIDAK UMUM</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($jenis as $data) 
                  <tr>
                    <td>{{ $data['jenis']  }}</td>
                    <td>{{ $data['jumlah'] }}</td>
                    <td>{{ $data['retribusi'] }}</td>
                    <td>{{ $data['umum'] }}</td>
                    <td>{{ $data['tidakumum'] }}</td>
                  </tr>
                @endforeach
                </tbody>
            </table>
            </div>

            <div class="col-6">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th scope="col">JENIS PELAYANAN</th>
                      <th scope="col">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($jenispelayanan as $data) 
                  <tr>
                    <td>{{ $data['jenispelayanan']  }}</td>
                    <td>{{ $data['jumlah'] }}</td>
                  </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th scope="col">PEMAKAIN BUKU UJI</th>
                      <th scope="col">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>BARU</td>
                    <td>{{ $pemakaianbuku['baru'] }}</td>
                  </tr>
                  <tr>
                    <td>RUSAK</td>
                    <td>{{ $pemakaianbuku['rusak'] }}</td>
                  </tr>
                  <tr>
                    <td>HILANG</td>
                    <td>{{ $pemakaianbuku['hilang'] }}</td>
                  </tr>
                </tbody>
            </table>

            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th scope="col">KETERANGAN</th>
                      <th scope="col">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>STIKER</td>
                        <td>{{ $jmlstiker }}</td>
                    </tr>
                    <tr>
                        <td>PLAT UJI</td>
                        <td>{{ $totplatuji }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    
</body>
</html>