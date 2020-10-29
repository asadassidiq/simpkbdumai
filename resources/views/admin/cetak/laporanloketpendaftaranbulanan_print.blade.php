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
            <h5><b>DATA ADMINISTRASI</b></h5>
            <h5><b>PENGUJIAN KENDARAAN BERMOTOR PADA UPTD PKB KOTA BANJARMASIN</b></h5>
            <h5><b>{{ $tglprint }}</b></h5>
        </div>
    
        <div class="row">
            <div class="col-6">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th scope="col">JENIS KENDARAAN</th>
                      <th scope="col">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($jenis as $data) 
                  <tr>
                    <td>{{ $data['jenis']  }}</td>
                    <td>{{ $data['jumlah'] }}</td>
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
            <br>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th scope="col">KETERANGAN</th>
                      <th scope="col">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>LULUS</td>
                    <td>{{ $lulus }}</td>
                  </tr>
                  <tr>
                    <td>TIDAK LULUS</td>
                    <td>{{ $tidaklulus }}</td>
                  </tr>
                </tbody>
            </table>

            <br>
            <br>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                      <th scope="col">UMUM / TIDAK UMUM</th>
                      <th scope="col">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>UMUM</td>
                    <td>{{ $umum }}</td>
                  </tr>
                  <tr>
                    <td>TIDAK UMUM</td>
                    <td>{{ $tidakumum }}</td>
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
                    <P>Kepala UPTD</P>
                    <P>Pengujian Kendaraan Bermotor</P>
                    <br><br>
                    <br>
                    <p>CHALIKIN NOOR, SE</p>
                    <p>NIP. 19750305 199803 1 006</p>
                </b>
            </div>
        </div>
    </div>
</body>
</html>