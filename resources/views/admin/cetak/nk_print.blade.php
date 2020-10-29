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
            <div class="col-8 align-self-center">
                    <h3><p class="text-center"><b>PEMERINTAH KABUTAPATEN BANJARMASIN</b></p></h3>                   
                    <h2><p class="text-center"><b>DINAS PERHUBUNGAN</b></p></h2>    
                    <h3><p class="text-center"><b>UPT PENGUJIAN KENDARAAN BERMOTOR</b></p></h3> 
                    <h4><p class="text-center"><b>JL. SOEKARNO HATTA TELP. 907650 7007772 BANJARMASIN</b></p></h4>  
            </div>          
            <div class="col-2">
                <img class="img-fluid" src="{{url('/img/dishub.jpg')}}" alt="Image"/>
            </div>
        </div>
        <hr style="border: 1px double black;">
        <div class="row">
             <div class="col-6"></div>
             <div class="col-6">
                <p>BANJARMASIN, <span id="date"></span></p>
             </div>
        </div>
        <div class="row">
             <div class="col-6">
                <div class="row">
                    <div class="col-4">
                        <p>Nomor</p>
                        <p>Lampiran</p>
                        <p>Perihal</p>
                    </div>
                    <div class="col-8">
                        <p><b>: 555.23/DISHUB-PKB/NU/</b></p>
                        <p>: 1 ( satu ) Berkas</p>
                        <p>: <u><b>Izin Numpang Uji</b></u></p>
                    </div>
                </div>
             </div>
             <div class="col-6">
                <p><b>Kepada :</b></p>
                <p>Yth. <b>Kepala Dinas Perhubungan</b> </p>
                <p><b>KOTA/KAB. <span> {{ $kendaraan->identitaskendaraan->kodewilayah }} </span></b></p>
                <p><b>C/q. Pengujian Kendaraan Bermotor</b></p>
                <p><b>DI <span><u>{{ $wilayah->namawilayah }}</u></span></b></p>
             </div>
        </div>
        <br>
        <p>Dengan ini disampaikan bahwa kendaraan tersebut di bawah ini : </p>
        <div class="row">
            <div class="row" style="padding-left:50px">
                <div class="col-4">
                    <b>
                        <p>Nomor Kendaraan </p>
                        <p>Nomor Pemeriksaan</p>
                        <p>Merk/Th Pembutan/tipe</p>
                        <p>Nomor Chassis</p>
                        <p>Nomor Mesin</p>
                        <p>Jenis</p>
                        <p>Pemilik</p>
                        <p>Alamat</p>
                    </b>
                </div>
                <div class="col-8">
                    <b>
                        <p>: {{ $kendaraan->identitaskendaraan->noregistrasikendaraan }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->nouji }}</p>
                        <p>: {{ $kendaraan->merek }} / {{ $kendaraan->identitaskendaraan->thpembuatan }} / {{ $kendaraan->tipe }} </p>
                        <p>: {{ $kendaraan->identitaskendaraan->norangka }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->nomesin }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->jenis }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->nama }}</p>
                        <p>: {{ $kendaraan->identitaskendaraan->alamat }}</p>
                    </b>
                </div>          
            </div>
            <br><br>    
            <div class="row">
                <div class="col-12">
                    <p>Kendaraan tersebut tidak keberatan di uji 1 <b><i>( satu ) kali </i></b> di Pengujian Kendaraan Bermotor <span> Kota/Kab {{ $wilayah->namawilayah }} </span> dan hasil uji kendaraan supaya di kirim ke Pengujian Kendaraan Bermotor Dinas Perhubungan Kota BANJARMASIN.</p>
                <br>
                <p>Demiikian disampaikan untuk diketahui, atas kerjasamanya yang baik di ucapkan terima kasih.</p>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <b>
                    <p><?php echo '$ttd->pangkat' ?></p>
                    <P>PENGUJIAN KENDARAAN BERMOTOR</P>
                    <br><br>
                    <br><br>
                    <p><u><?php echo '$ttd->nama' ?></u></p>
                    <p>NIP.<?php echo '$ttd->nip' ?></p>
                </b>
            </div>
        </div>
    </div>
</body>
</html>