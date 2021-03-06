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
            <div class="col-8 align-self-center">
                    <h3><p class="text-center"><b>PEMERINTAH KOTA Dumai</b></p></h3>                   
                    <h2><p class="text-center"><b>DINAS PERHUBUNGAN</b></p></h2>    
                    <h3><p class="text-center"><b>UPU Berkala PENGUJIAN KENDARAAN BERMOTOR</b></p></h3> 
                    <h4><p class="text-center"><b>Jl. Gubernur Soebarjo / Lingkar Selatan Km. 11 Dumai</b></p></h4>  
            </div>           
            <div class="col-2">
                <img height="75%" width="75%" class="img-fluid" src="{{url('/img/dishub.png')}}" alt="Image"/>
            </div>
        </div>
        <hr style="border: 1px double black;">
        <div class="row">
             <div class="col-6">
				<div class="row">
                    <div class="col-4">
                        <p>Nomor</p>
                        <p>Lampiran</p>
                        <p>Perihal</p>
                    </div>
                    <div class="col-8">
                        <p>:</p>
                        <p>: 1 (satu) Berkas</p>
                        <p>: <b> Mutasi Keluar</b></p>
                    </div>
                </div>
			 </div>
             <div class="col-6">
                <p>Dumai, <span id="date"><?php echo date("d F Y") ?></span></p>
				<br>
				<p><b>Kepada ,</b></p>
                <p>Yth. <b>Kepala Dinas Perhubungan</b> </p>
                <p><b><span> {{ $wilayah->namawilayah }} </span></b></p>
                <p><b>Up. Kepala Unit Pengujian Kendaraan Bermotor</b></p>
                <p><b>DI <span><u>{{ $wilayah->namawilayah }}</u></span></b></p>
             </div>
        </div>
        <br>
        <p>Dengan ini disampaikan bahwa kendaraan tersebut dibawah ini : </p>
        <div class="row">
            <div class="row" style="padding-left:50px">
                <div class="col-4">
                    <b>
                        <p>Nomor Pemeriksaan</p>
						<p>Nomor Kendaraan </p>
                        <p>Pemilik</p>
                        <p>Alamat</p>
                        <p>Jenis</p>
                        <p>Merk</p>
						<p>Type</p>
						<p>Tahun</p>
                        <p>Nomor Rangka</p>
                        <p>Nomor Mesin</p>
                    </b>
                </div>
                <div class="col-8">
                    <b>
                        <p>: {{ $kendaraan->nouji }}</p>
						<p>: {{ $kendaraan->noregistrasikendaraan }}</p>
                        <p>: {{ $kendaraan->nama }}</p>
                        <p>: {{ $kendaraan->alamat }}</p>
                        <p>: {{ $kendaraan->jenis }}</p>
                        <p>: {{ $kendaraan->merek }}</p>
						<p>: {{ $kendaraan->tipe }} </p>
						<p>: {{ $kendaraan->thpembuatan }} </p>
                        <p>: {{ $kendaraan->norangka }}</p>
                        <p>: {{ $kendaraan->nomesin }}</p>
                    </b>
                </div>          
            </div>
            <br><br>    
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                    <p>Sesuai dengan permohonan pemilik, kendaraan tersebut dimutasikan ke </p>
					</div>
					<div class="col-12 text-center">
							<span style="font-size:24px"><b> ----- {{ $wilayah->namawilayah }} ----- </b></span>
					</div>
					<div class="col-12">
                    <p>Demiikian disampaikan, untuk mendapatkan penyelesaian sebagaimana mestinya.</p>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-7"></div>
            <div class="col-5 text-center">
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