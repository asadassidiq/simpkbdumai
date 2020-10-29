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
            width:740px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:185px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
         @page { size: potrait; }
    </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <img class="img-fluid" src="{{url('/img/kota.jpg')}}" alt="Image"/>
            </div>
            <div class="col-8">
            <div class="d-flex justify-content-center"><h3><b>PEMERINTAH KABUTAPATEN BANJARMASIN</b></h3></div>  
            <div class="d-flex justify-content-center"><h2><b>DINAS PERHUBUNGAN</b></p></h2></div>
            <div class="d-flex justify-content-center"><h3><b>UPT PENGUJIAN KENDARAAN BERMOTOR</b></p></h3></div>
            <div class="d-flex justify-content-center"><h5><b>JL. SOEKARNO HATTA TELP. 907650 7007772 BANJARMASIN</b></h5></div>
            </div>          
            <div class="col-2">
                <img class="img-fluid" src="{{url('/img/dishub.jpg')}}" alt="Image"/>
            </div>
        </div>
        <hr style="border: 1px double black;">
        <br>
        <div class="text-center">
            <h3><b>PERMOHONAN UJI KENDARAAN BERMOTOR</b></h3>
        </div>
        <div class="row">
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row">Tanda Nomer Kendaraan</th>
                  <td>{{ $kendaraan->identitaskendaraan->noregistrasikendaraan }}</td>
                </tr>
                <tr>
                  <th scope="row">Nama dan nama kecil pemilik atau pemegang dan jika dia badan hukum juga nama dana nama kecik mewakili badan hukum perkara ini</th>
                  <td>{{ $kendaraan->identitaskendaraan->nama }}</td>
                </tr>
                <tr>
                  <th scope="row">Alamat pemilik atau pemegang atau wakil</th>
                  <td>{{ $kendaraan->identitaskendaraan->alamat }}</td>
                </tr>
                <tr>
                  <th scope="row">Tempat biasa kendaraan itu</th>
                  <td>Banjarmasin</td>
                </tr>
                <tr>
                  <th scope="row">Nama dan jenis Kendaraan itu</th>
                  <td>{{ $kendaraan->identitaskendaraan->jenis }}</td>
                </tr>
                <tr>
                  <th scope="row">Merk , tahun pembuatan</th>
                  <td>{{ $kendaraan->merek }} / {{ $kendaraan->identitaskendaraan->thpembuatan }}</td>
                </tr>
                <tr>
                  <th scope="row">Nomor : Mesin / Chassis</th>
                  <td>{{ $kendaraan->identitaskendaraan->nomesin }} / {{ $kendaraan->identitaskendaraan->norangka }} </td>
                </tr>
                <tr>
                  <th scope="row">Sifat</th>
                  <td>{{ $kendaraan->identitaskendaraan->peruntukan }}</td>
                </tr>
                <tr>
                  <th scope="row">Nomor uji kendaraan / pemeriksaan</th>
                  <td>{{ $kendaraan->identitaskendaraan->nouji }}</td>
                </tr>

                <tr>
                  <th scope="row">Tempat dan tanggal masa berlaku UJi</th>
                  <td>Banjarmasin, 20-08-20</td>
                </tr>

                <tr>
                  <th scope="row">Pengujian berikutnya diajukan 1 (satu) bulan sebelumnya</th>
                  <td>
                    <div class="row">
                        <div class="col-12 text-center">Banjarmasin, </div>
                        <div class="col-12 text-center">
                            <b>
                                <P>Pemohon</P>
                                <br><br>
                                <br><br>
                                <p>{{ $kendaraan->identitaskendaraan->nama }}</p>
                            </b>
                        </div>
                    </div>
                  </td>
                </tr>

              </tbody>
            </table>       
            </div>
            <br><br>
        </div>
        <br>
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <b>
                    <P>An. KEPALA DINAS PERHUBUNGAN</P>
                    <P>KOTA BANJARMASIN</P>
                    <br><br>
                    <br><br>
                    <p>Kepala UPTD / Pengujian Kendaraan Bermotor Banjarmasin</p>
                </b>
            </div>
        </div>
    </div>
</body>
</html>