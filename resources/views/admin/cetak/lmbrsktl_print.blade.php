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
                <img height="75%" width="75%" class="img-fluid" src="{{url('/img/kota.jpg')}}" alt="Image"/>
            </div>
            <div class="col-8">
            <div class="d-flex justify-content-center"><h3><b>PEMERINTAH KOTA DUMAI</b></h3></div>  
            <div class="d-flex justify-content-center"><h2><b>DINAS PERHUBUNGAN</b></p></h2></div>
            <div class="d-flex justify-content-center"><h3><b>UPT PENGUJIAN KENDARAAN BERMOTOR</b></p></h3></div>
            <div class="d-flex justify-content-center"><h5><b>UPUBKBkotadumai@gmail.com</b></h5></div>
            <div class="d-flex justify-content-center"><h5><b>JL. SOEKARNO HATTA TELP. (0765) 7007772 DUMAI</b></h5></div>
            </div>          
            <div class="col-2">
                <img height="75%" width="75%" class="img-fluid" src="{{url('/img/dishub.png')}}" alt="Image"/>
            </div>
        </div>
        <hr style="border: 1px double black;">
        <br>
        <div class="text-center">
            <h3><b>SURAT KETERANGAN TIDAK LULUS UJI KENDARAAN BERMOTOR</b></h3>
        </div>
        <div class="row">
            <div class="row" style="padding-left:50px">
                <div class="col-4">
                    <b>
                        <p>Nomor Pemeriksaan</p>
                        <p>Nomor Kendaraan </p>
                        <p>Pemilik</p>
                        <p>Merk / tipe</p>
                        <p>Jenis</p>
                        <p>Tahun Pembuatan</p>
                        <p>Bahan Bakar</p>
                        <p>Isi Silinder</p>
                        <p>Nomor Chassis</p>
                        <p>Nomor Mesin</p>
                    </b>
                </div>
                <div class="col-8">
                    <b>
                        <p>: {{ $kendaraan->identitaskendaraan->nouji }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->noregistrasikendaraan }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->nama }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->merek }} / {{ $kendaraan->identitaskendaraan->tipe }} </p>
                        <p>: {{ $kendaraan->identitaskendaraan->jenis }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->thpembuatan }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->bahanbakar }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->isisilinder }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->norangka }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->nomesin }}</p>
                    </b>
                </div>          
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p><b>Catatan POS 1</b></p>
            </div>
            <div class="col-8">
                <p>: {{ $kendaraan->catatanpos1 }}</p>
            </div>   
            
            <br><br>
        </div>
		<div class="row">
            <div class="col-2">
                <p><b>Catatan POS 2</b></p>
            </div>
            <div class="col-8">
                <p>: {{ $kendaraan->catatanpos2 }}</p>
            </div>   
            
            <br><br>
        </div>
        <br>
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <b>
                    <p>An. Kepala Dinas Perhubungan Dumai</p>
                    <p>Kepala UPU Berkala</p>
                    <P>Pengujian Kendaraan Bermotor</P>
                    <p>Kota Dumai</p>
                    <br><br>
                    <br><br>
                    <p><u>EFFENDI, Ama.PKB</u></p>
                    <p>NIP. 19760606 200212 1 011</p>
                </b>
            </div>
        </div>
    </div>
</body>
</html>