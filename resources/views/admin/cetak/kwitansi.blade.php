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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
                <img class="img-fluid" width="30%" height="30%" src="{{url('/img/kota.jpg')}}" alt="Image"/>
            </div>
            <div class="col-8">
            <div class="d-flex justify-content-center"><h2><b>DINAS PERHUBUNGAN</b></p></h2></div>
            <div class="d-flex justify-content-center"><h3><b>TANDA BUKTI PENERIMAAN</b></h3></div>
            </div>          
            <div class="col-2">
                <img class="img-fluid" width="30%" height="30%" src="{{url('/img/dishub.jpg')}}" alt="Image"/>
            </div>
        </div>
        <hr style="border: 1px double black;">
        <br>
        <div class="text-justify">
            <p>Bendahara Penerimaan Pembantu Pengujian Kendaraan Bermotor telah menerima uang sebesar Rp. (dengan huruf <span id="uang"></span>) </p>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-2">
                <p>Nama</p>
            </div>
            <div class="col-8">
                <p>: {{ $kendaraan->nama }}</p>
            </div>
            <div class="col-2"></div>
            <div class="col-2">
                <p>Alamat</p>
            </div>
            <div class="col-8">
                <p>: {{ $kendaraan->alamat }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <p>Sebagai pembayaran : Retribusi Pengujian Kendaraan Bermotor terdiri dari :</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <p>Plat Uji</p>
            </div>
            <div class="col-1">:</div>
            <div class="col-2 text-right">
                <p> {{ $kendaraan->platuji }}</p>
            </div>
            <div class="col-1"></div>

            <div class="col-4"></div>
            <div class="col-4">
                <p>Buku Uji</p>
            </div>
            <div class="col-1">:</div>
            <div class="col-2 text-right">
                <p> {{ $kendaraan->bukuuji }}</p>
            </div>
            <div class="col-1"></div>

            <div class="col-4"></div>
            <div class="col-4">
                <p>Retribusi</p>
            </div>
            <div class="col-1">:</div>
            <div class="col-2 text-right">
                <p> {{ $kendaraan->retribusi }}</p>
            </div>
            <div class="col-1"></div>

            <div class="col-4"></div>
            <div class="col-4">
                <p>Registrasi</p>
            </div>
            <div class="col-1">:</div>
            <div class="col-2 text-right">
                <p> {{ $kendaraan->regkend }}</p>
            </div>
            <div class="col-1"></div>

            <div class="col-4"></div>
            <div class="col-4">
                <p>Denda {{ $kendaraan->blndenda }} bulan</p>
            </div>
            <div class="col-1">:</div>
            <div class="col-2 text-right">
                <p>{{ $kendaraan->denda }}</p>
            </div>
            <div class="col-1"></div>

            <div class="col-4"></div>
            <div class="col-4">
                <p>Stiker Tanda Samping</p>
            </div>
            <div class="col-1">:</div>
            <div class="col-2 text-right">
                <p> {{ $kendaraan->stiker }}</p>
            </div>
            <div class="col-1"></div>

            <div class="col-4"></div>
            <div class="col-4 text-right">
                <p><b>Jumlah</b></p>
            </div>
            <div class="col-1">:</div>
            <div class="col-2 text-right">
                <p><b><span id="tot">{{ $kendaraan->total }}</span></b> </p>
            </div>
            <div class="col-1"></div>

            <div class="col-4 border border-dark text-center">
                <p>Perda Kota Banjarmasin</p>
                <p>No. 12 Tahun 2012</p>
            </div>
            <div class="col-4 border border-dark text-center">
                <p>Uang tersebut diatas diterima</p>
                <p>Banjarmasin, {{ $kendaraan->tglbayar }}</p>
                <p>Bendahara Penerimaan Pembantu</p>
            </div>
            <div class="col-4 border border-dark text-center"></div>
        </div>
        <br>
    </div>

<script type="text/javascript">
  $(document).ready(function(){
    terbilang();
    console.log("ok");
      function terbilang(){
                var bilangan    =$("#tot").text();
                var kalimat="";
                var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
                var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
                var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
                var panjang_bilangan = bilangan.length;

                /* pengujian panjang bilangan */
                if(panjang_bilangan > 15){
                    kalimat = "Diluar Batas";
                }else{
                    /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
                    for(i = 1; i <= panjang_bilangan; i++) {
                        angka[i] = bilangan.substr(-(i),1);
                    }
                     
                    var i = 1;
                    var j = 0;
                     
                    /* mulai proses iterasi terhadap array angka */
                    while(i <= panjang_bilangan){
                        subkalimat = "";
                        kata1 = "";
                        kata2 = "";
                        kata3 = "";
                         
                        /* untuk Ratusan */
                        if(angka[i+2] != "0"){
                            if(angka[i+2] == "1"){
                                kata1 = "Seratus";
                            }else{
                                kata1 = kata[angka[i+2]] + " Ratus";
                            }
                        }
                         
                        /* untuk Puluhan atau Belasan */
                        if(angka[i+1] != "0"){
                            if(angka[i+1] == "1"){
                                if(angka[i] == "0"){
                                    kata2 = "Sepuluh";
                                }else if(angka[i] == "1"){
                                    kata2 = "Sebelas";
                                }else{
                                    kata2 = kata[angka[i]] + " Belas";
                                }
                            }else{
                                kata2 = kata[angka[i+1]] + " Puluh";
                            }
                        }
                         
                        /* untuk Satuan */
                        if (angka[i] != "0"){
                            if (angka[i+1] != "1"){
                                kata3 = kata[angka[i]];
                            }
                        }
                         
                        /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
                        if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                            subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
                        }
                         
                        /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
                        kalimat = subkalimat + kalimat;
                        i = i + 3;
                        j = j + 1;
                    }

                if ((angka[5] == "0") && (angka[6] == "0")){
                        kalimat = kalimat.replace("Satu Ribu","Seribu");
                    }
                }
                $("#uang").html(kalimat);
            }
    });
  </script>
</body>
</html>