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
             <div class="col-12 text-center">
                <h3><b>Lembar Pemeriksaan Kendaraan</b></h3>
             </div>
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
            <div class="col-8"></div>
            <div class="col-4 text-center">
                    <p>Banjarmasin, {{ $kendaraan->tglpendaftaran }}</p>
                    <P>Pemohon</P>
                    <br><br>
                    <p>(  {{ $kendaraan->identitaskendaraan->nama }}  )</p>
            </div>
        </div>
        <hr style="border: 1px double black;">

        <div class="row">
            <div class="col-5">
                <div class="row">
                    <div class="col-8">
                        <p>a.Jumlah berat yang di perbolehkan</p>
                        <p>JBB</p>
                        <p>JBKB</p>
                    </div>
                    <div class="col-4">
                        <p>: </p>
                        <p>: {{ $kendaraan->identitaskendaraan->jbb }}Kg</p>
                        <p>: {{ $kendaraan->jbkb }}Kg</p>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-8">
                        <p>b. Berat kosong kendaraan</p>
                        <p>Berat Sumbu I</p>
                        <p>Berat Sumbu II</p>
                        <p>Berat Sumbu III</p>
                        <p>Berat Sumbu IV</p>
                    </div>
                    <div class="col-4">
                        <p>: </p>
                        <p>: {{ $kendaraan->beratsumbu1 }} Kg</p>
                        <p>: {{ $kendaraan->beratsumbu2 }} Kg</p>
                        <p>: {{ $kendaraan->beratsumbu3 }} Kg</p>
                        <p>: {{ $kendaraan->beratsumbu4 }} Kg</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <div class="row">
                    <div class="col-8">
                        <p>c. Daya angkut yang diizinkan</p>
                        <p>Daya angkut orang</p>
                        <p>Daya angkut barang</p>
                    </div>
                    <div class="col-4">
                        <p>: </p>
                        <p>: {{ $kendaraan->dayaangkutorang }} Kg</p>
                        <p>: {{ $kendaraan->dayaangkutbarang }} Kg</p>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-8">
                        <p>d. Kemampuan Kendaraan yang diizinkan</p>
                        <p>JBI</p>
                        <p>JBKI</p>
                        <p>MST</p>
                        <p>Ukuran ban yang diizinkan</p>
                        <p>Kelas jalan</p>
                    </div>
                    <div class="col-4">
                        <p>: </p>
                        <p>: {{ $kendaraan->jbi }} Kg</p>
                        <p>: {{ $kendaraan->jbki }} Kg</p>
                        <p>: {{ $kendaraan->mst }} Kg</p>
                        <p>: {{ $kendaraan->ukuranban }} </p>
                        <p>: {{ $kendaraan->kelasjalanterendah }} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <div class="row">
                    <div class="col-8">
                        <p>e. Dimensi Kendaraan</p>
                        <p>Panjang</p>
                        <p>Lebar</p>
                        <p>Tinggi</p>
                        <p>Rear Over Hang (ROH)</p>
                        <p>Front Over Hang (FOH)</p>
                        <p>Ground Clearance</p>
                    </div>
                    <div class="col-4">
                        <p>: </p>
                        <p>: {{ $kendaraan->panjangkendaraan }} mm</p>
                        <p>: {{ $kendaraan->lebarkendaraan }} mm</p>
                        <p>: {{ $kendaraan->tinggikendaraan }} mm</p>
                        <p>: {{ $kendaraan->julurbelakang }} mm</p>
                        <p>: {{ $kendaraan->julurdepan }} mm</p>
                        <p>: {{ $kendaraan->groundclearance }} mm</p>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-8">
                        <p>f. Jarak Sumbu</p>
                        <p>I - II</p>
                        <p>II - III</p>
                        <p>III - IV</p>
                        <p>Jarak Titik Berat (q)</p>
                        <p>Jarak titik berat tempat duduk pengemudi (p)</p>
                    </div>
                    <div class="col-4">
                        <p>: </p>
                        <p>: {{ $kendaraan->jaraksumbu1_2 }} mm</p>
                        <p>: {{ $kendaraan->jaraksumbu2_3 }} mm</p>
                        <p>: {{ $kendaraan->jaraksumbu3_4 }} mm</p>
                        <p>: {{ $kendaraan->q }} mm</p>
                        <p>: {{ $kendaraan->p }} mm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>