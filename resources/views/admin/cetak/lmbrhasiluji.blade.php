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
<body>
    <div class="container-fluid">
        <!-- <div class="row">
            <div class="col-2">
                <img class="img-fluid" height="75%" width="75%" src="{{url('/img/kota.jpg')}}" alt="Image"/>
            </div>
            <div class="col-8">
            <div class="d-flex justify-content-center"><h3><b>PEMERINTAH KOTA DUMAI</b></h3></div>  
            <div class="d-flex justify-content-center"><h2><b>DINAS PERHUBUNGAN</b></p></h2></div>
            <div class="d-flex justify-content-center"><h3><b>UPT PENGUJIAN KENDARAAN BERMOTOR</b></p></h3></div>
            <div class="d-flex justify-content-center"><h5><b>JL. SOEKARNO HATTA TELP. (0765) 7007772 DUMAI</b></h5></div>
            </div>          
            <div class="col-2">
                <img height="75%" width="75%" class="img-fluid" src="{{url('/img/dishub.png')}}" alt="Image"/>
            </div>
        </div>
        <hr style="border: 1px double black;"> -->
        <br>
        <div class="text-center">
            <h3><b>HASIL UJI PEMERIKSAAN KENDARAAN BERMOTOR</b></h3>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <strong>IDENTITAS PEMILIK KENDARAAN BERMOTOR</strong>
                    <div class="row">
                        <div class="col-4">
                            <p>Nama</p>
                            <p>Alamat</p>
                        </div>
                        <div class="col-4">
                            <p>: {{ $kendaraan->nama }}</p>
                            <p>: {{ $kendaraan->alamat }}</p>
                        </div>
                        <br><br><br><br><br><br>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <strong>IDENTITAS KENDARAAN BERMOTOR</strong>
                    <div class="row">
                        <div class="col-4">
                            <p>Nomer dan Tanggal SRUT</p>
                            <p>Nomer Registrasi Kendaraan</p>
                            <p>Nomer Rangka Kendaraan</p>
                            <p>Nomer Mesin Kendaraan</p>
                            <p>Nomer Uji Kendaraan</p>
                        </div>
                        <div class="col-4">
                            <p>: {{ $kendaraan->nosertifikatreg }} & {{ $kendaraan->tglsertifikatreg }}</p>
                            <p>: {{ $kendaraan->noregistrasikendaraan }}</p>
                            <p>: {{ $kendaraan->norangka }}</p>
                            <p>: {{ $kendaraan->nomesin }}</p>
                            <p>: {{ $kendaraan->nouji }}</p>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-center">
                        Foto Tampak Depan
                        <div>
                        @if(file_exists(public_path() . '/thumbnail_images/' . $kendaraan->nouji.'-tampakdepan.jpg'))
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/thumbnail_images/'.$kendaraan->nouji.'-tampakdepan.jpg')}}" alt="Image"/>
                        @else
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/img/no image.jpg')}}" alt="Image"/>
                        @endif
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        Foto Tampak Belakang
                        <div>
                        @if(file_exists(public_path() . '/thumbnail_images/' . $kendaraan->nouji.'-tampakbelakang.jpg'))
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/thumbnail_images/'.$kendaraan->nouji.'-tampakbelakang.jpg')}}" alt="Image"/>
                        @else
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/img/no image.jpg')}}" alt="Image"/>
                        @endif
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        Foto Tampak Kanan
                        <div>
                        @if(file_exists(public_path() . '/thumbnail_images/' . $kendaraan->nouji.'-tampakkanan.jpg'))
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/thumbnail_images/'.$kendaraan->nouji.'-tampakkanan.jpg')}}" alt="Image"/>
                        @else
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/img/no image.jpg')}}" alt="Image"/>
                        @endif
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        Foto Tampak Kiri
                        <div>
                        @if(file_exists(public_path() . '/thumbnail_images/' . $kendaraan->nouji.'-tampakkiri.jpg'))
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/thumbnail_images/'.$kendaraan->nouji.'-tampakkiri.jpg')}}" alt="Image"/>
                        @else
                            <img height="50%" width="50%" class="img-fluid" src="{{url('/img/no image.jpg')}}" alt="Image"/>
                        @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <strong>SEPESIFIKASI TEKNIS KENDARAAN BERMOTOR</strong>
                    <div class="row">
                        <div class="col-6">
                            <p>Jenis</p>
                            <p>Merek / Tipe</p>
                            <p>Tahun Pembuatan</p>
                            <p>Bahan Bakar</p>
                            <p>Isi Silinder</p>
                            <p>Daya Motor</p>
                            <p>Ukuran Ban</p>
                            <p>Konfiguras Sumbu</p>
                            <p>Berat Kosong Kendaraan</p>
                            <p>Panjang Kendaraan</p>
                            <p>Lebar Kendaraan</p>
                            <p>Tinggi Kendaraan</p>
                            <p>Jarak Sumbu I-II</p>
                            <p>Jarak Sumbu II-III</p>
                            <p>Jarak Sumbu III-IV</p>
                            <p>p,l,t Bak Muatan / Tangki</p>
                            <p>JBB/JBKB</p>
                            <p>Daya Angkut (orang/kg)</p>
                            <p>Daya Angkut Barang</p>
                            <p>Kelas Jalan Terendah</p>
                        </div>
                        <div class="col-6">
                            <p>: {{ $kendaraan->jenis }}</p>
                            <p>: {{ $kendaraan->merek }} / {{ $kendaraan->tipe }}</p>
                            <p>: {{ $kendaraan->thpembuatan }}</p>
                            <p>: {{ $kendaraan->bahanbakar }}</p>
                            <p>: {{ $kendaraan->isisilinder }}</p>
                            <p>: {{ $kendaraan->dayamotorpenggerak }}</p>
                            <p>: {{ $kendaraan->ukuranban }}</p>
                            <p>: {{ $kendaraan->konfigurasisumburoda }}</p>
                            <p>: {{ $kendaraan->beratkosong }}</p>
                            <p>: {{ $kendaraan->panjangkendaraan }}</p>
                            <p>: {{ $kendaraan->lebarkendaraan }}</p>
                            <p>: {{ $kendaraan->tinggikendaraan }}</p>
                            <p>: {{ $kendaraan->jaraksumbu1_2 }}</p>
                            <p>: {{ $kendaraan->jaraksumbu2_3 }}</p>
                            <p>: {{ $kendaraan->jaraksumbu3_4 }}</p>
                            <p>: {{ $kendaraan->panjangbakatautangki }} x {{ $kendaraan->lebarbakatautangki }} x {{ $kendaraan->tinggibakatautangki }}</p>
                            <p>: {{ $kendaraan->jbb }} / {{ $kendaraan->jbkb }}</p>
                            <p>: {{ $kendaraan->dayaangkutorang }} / {{ $kendaraan->dayaangkutorang*60 }}</p>
                            <p>: {{ $kendaraan->dayaangkutbarang }}</p>
                            <p>: {{ $kendaraan->kelasjalanterendah }}</p>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <strong>Item Uji</strong>
                            <p>Kedalaman Alur Ban</p>
                            <p>Akurasi Kecepatan</p>
                            <p>Tinggat Suara Klakson</p>
                            <p>Kincup Roda Depan</p>
                            <p>Rem Utama</p>
                            <br><br><br><br><br><br><br><br><br>
                            <p>Lampu Utama</p>
                            <br><br><br>
                            <p>Emisi</p>
                        </div>
                        <div class="col-3">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p>Sumbu I kanan / kiri</p>
                            <p>Sumbu II kanan / kiri</p>
                            <p>Sumbu III kanan / kiri</p>
                            <p>Sumbu IV kanan / kiri</p>
                            <p>Total Gaya Rem</p>
                            <p>Penyimpangan Rem</p>
                            <p class="text-right">I</p>
                            <p class="text-right">II</p>
                            <p class="text-right">III</p>
                            <p class="text-right">IV</p>
                            <p>Intensitas Lampu Kanan</p>
                            <p>Intensitas Lampu Kiri</p>
                            <p>Penyimpang arah Kanan</p>
                            <p>Penyimpang arah Kiri</p>
                            @if($kendaraan->bahanbakar == 'Bensin')
                            <p>CO</p>
                            <p>HC</p>
                            @endif
                            @if($kendaraan->bahanbakar == 'Solar')
                            <p>Asap</p>
                            @endif
                        </div>
                        <div class="col-3">
                            <strong>Hasil Uji</strong>
                            <p>: {{ $kendaraan->alatuji_kedalamanalurban}} mm</p>
                            <p>: {{ $kendaraan->alatuji_penunjukkecepatan}} km/jam</p>
                            <p>: {{ $kendaraan->alatuji_tingkatkebisingan}} db</p>
                            <p>: {{ $kendaraan->alatuji_kincuprodadepan}} mm</p>
                            <p>: {{ $kendaraan->gayaremkanans1 }} / {{ $kendaraan->gayaremkiris1 }}</p>
                            <p>: {{ $kendaraan->gayaremkanans2 }} / {{ $kendaraan->gayaremkiris2 }}</p>
                            <p>: {{ $kendaraan->gayaremkanans3 }} / {{ $kendaraan->gayaremkiris3 }}</p>
                            <p>: {{ $kendaraan->gayaremkanans4 }} / {{ $kendaraan->gayaremkiris4 }}</p>
                            <p>: {{ $kendaraan->alatuji_remutamatotalgayapengereman }} Kg</p>
                            <br>
                            <p>: {{ $kendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan1 }} %</p>
                            <p>: {{ $kendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan2 }} %</p>
                            <p>: {{ $kendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan3 }} %</p>
                            <p>: {{ $kendaraan->alatuji_remutamaselisihgayapengeremanrodakirikanan4 }} %</p>
                            <p>: {{ $kendaraan->alatuji_lampuutamakekuatanpancarlampukanan }} cd</p>
                            <p>: {{ $kendaraan->alatuji_lampuutamakekuatanpancarlampukiri }} cd</p>
                            <p>: {{ $kendaraan->alatuji_lampuutamapenyimpanganlampukanan }} degree</p>
                            <p>: {{ $kendaraan->alatuji_lampuutamapenyimpanganlampukiri }} degree</p>
                            @if($kendaraan->bahanbakar == 'Bensin')
                            <p>: {{ $kendaraan->alatuji_emisicobahanbakarbensin }} %</p>
                            <p>: {{ $kendaraan->alatuji_emisihcbahanbakarbensin }} ppm</p>
                            @endif
                            @if($kendaraan->bahanbakar == 'Solar')
                            <p>: {{ $kendaraan->alatuji_emisiasapbahanbakarbensin }} %</p>
                            @endif
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <strong>HASIL PENGUJIAN KENDARAAN BERMOTOR</strong>
                    <div class="row">
                        <div class="col-6">
                            <p>Keterangan</p>
                            <p>Masa Berlaku Uji</p>
                            <p>Nama Petugas Uji</p>
                        </div>
                        <div class="col-6">
                            @if($kendaraan->statuslulusuji == '1')
                            <p>: LULUS UJI</p>
                            @else
                            <p>: TIDAK LULUS UJI</p>
                            @endif
                            <p>: <?php $date=date_create($kendaraan->masaberlakuuji); echo date_format($date,"d F Y") ?></p>
                            @if($kendaraan->idpenguji == '779')
                            <p>: FAJAR SETIOKO, S.Sos</p>
                            @endif
                            @if($kendaraan->idpenguji == '780')
                            <p>: RIZKI FERDIAN</p>
                            @endif
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <strong>CATATAN</strong>
                    <div class="row">
                        <div class="col-6">
                            <p>POS 1</p>
                            <p>POS 2</p>
                        </div>
                        <div class="col-6">
                            <p>: {{ $kendaraan->catatanpos1 }}</p>
                            <p>: {{ $kendaraan->catatanpos2 }}</p>
                        </div>
                        <br><br><br><br>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- <br>
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
        </div> -->
    </div>
</body>
</html>