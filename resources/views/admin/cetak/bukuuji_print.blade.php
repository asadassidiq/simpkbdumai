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
         @page { size: landscape; }
    </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
        <div class="row" style="margin-top: 75px">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <div class="row">
            <div class="col-sm-4">
              
            </div>
            <div class="col-sm-8 text-center">
              <p></p>
              <p style="font-size: 18px"><b><strong> <?php $date=date_create(date('d-M-y')); echo date_format($date,"d F Y"); ?></span> </strong></b></p>
              <br>
              <br>
            </div>
           </div>
           <div class="row">
             <div class="col-sm-6 text-center" style="font-size: 18px">
               <p style="margin-top: 230px;"><b>{{ $data->nouji }}</b></p>
             </div>
           </div>
          </div>
       </div>     
    </div>

    <div class="container-fluid kertasbaru">
      <div class="row" style="margin-top: 5px">
        <div class="col-sm-6">
          <div class="row" style="margin-top: 100px; ">
            <div class="col-sm-4">
              </div>
              <div class="col-sm-8">
                <p><b>{{ $data->peruntukan }}</b></p> 
              </div>
          </div>
          <div class="row">
              <div class="col-sm-4">
              </div>
              <div class="col-sm-7">                 
                <p><b>{{ $data->nouji }}</b></p><br>
                <p><b>{{ $data->noregistrasikendaraan }}</b></p><br>
                <p><b>{{ $data->nama }}</b></p><br> 
                <p><b>{{ $data->alamat }}</b></p>      
              </div>
          </div>
          <div class="row" style="margin-top: 100px; ">
            <div class="col-sm-4">
              </div>
              <div class="col-sm-8" style="font-size:16px;">
                <p><b>{{ $data->nouji }}</b></p> 
              </div>
          </div>
        </div>
        <div class="col-sm-6">  
          <div class="row" style="margin-top: 30px;font-size: 14px;">
            <div class="col-sm-4 text-center">
                <p style="margin-top:120px"><b>{{ $data->jenis }}</b></p>
            </div>
            <div class="col-sm-4 text-center" style="margin-top:10px">
              <br><br>
              <b><p>{{ $data->merek }}</p>
              <p>{{ $data->tipe }}</p>
              <?php if (empty($data->dayamotorpenggerak)): ?>
              <p class="line" style="margin-top:50px">{{ $data->dayamotorpenggerak }}</p>
              <?php else: ?>
              <p class="line">0</p>
              <?php endif ?>
              <?php if (empty($data->isisilinder)): ?>
              <p class="line">0</p>
              <?php else: ?>
              <p class="line">{{ $data->isisilinder }}</p>
              <?php endif ?>
              <p class="line">{{ strtoupper( $data->bahanbakar) }}</p>
              <p style="margin-top:10px">{{ $data->thpembuatan }}</p>
                            
              <p></p>
              <p style="margin-top:90px;">{{ $data->norangka }}</p>
              <p style="margin-top:10px;">{{ $data->nomesin }}</p>
              </b>
            </div>
          </div>   

          <div class="row" style="margin-top: 90px; ">
            <div class="col-sm-4">
              </div>
              <div class="col-sm-8" style="font-size:16px;">
                <p><b>{{ $data->nouji }}</b></p> 
              </div>
          </div>   
       </div> 
      </div>
    </div>
    <div class="container-fluid kertasbaru">
      <div class="row" >
        <div class="col-sm-6">
          <div class="row" style="margin-top: 30px;padding-right: 30px; ">
              <div class="col-sm-8">
                
              </div>
              <div class="col-sm-4" >
              <b>
                <p>{{ $data->panjangkendaraan }}</p> <!-- panjang -->
                <p>{{ $data->lebarkendaraan }}</p> <!-- lebar -->
                <p>{{ $data->tinggikendaraan }}</p> <!-- tinggi -->
                <p>{{ $data->julurbelakang }}</p> <!-- belkng -->
                <p>{{ $data->julurdepan }}</p> <!-- depan -->
                <p>{{ $data->jaraksumbu1_2 }}</p> <!-- smb 1 -->
                <p>{{ $data->jaraksumbu2_3 }}</p> <!-- smb 2 -->              
                <p>{{ $data->jaraksumbu3_4 }}</p>
                <p>{{ $data->q }}</p></b>
              </div>
          </div>
          <div class="row" style="padding-left: 15px;">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
              <br><br><br><br><br><b>
              <p>{{ $data->panjangbakatautangki }}</p>
              <p>{{ $data->lebarbakatautangki }}</p>
              <p>{{ $data->tinggibakatautangki }}</p>
              <p></p> <!-- BAHAN -->
              <br><br>
              <p></p>
              <p></p>
              <p></p>
              <p></p>
              <br>
              <p></p>
              <p></p>
              <p></p>
              <br><br><br><br>
              <p><b>{{ $data->ukuranban }}</b></p>
              <p><b>{{ $data->ukuranban }}</b></p>
              <p></p>
              <p></p>

              <p style="margin-top: 30px;">{{ $data->konfigurasisumburoda }}</p>
              <p>{{ $data->jbb }}</p>
              <p>{{ $data->jbkb }}</p></b>
            </div>
          </div>
        </div>
        <div class="col-sm-6" style="margin-top: 10px;">  
          <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-6 text-center">
              <br><b>
              <?php if (!empty($data->beratsumbu1)): ?>
                <p>{{ $data->beratsumbu1 }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              
              <?php if (!empty($data->beratsumbu2)): ?>
                <p>{{ $data->beratsumbu2 }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->beratsumbu3)): ?>
                <p>{{ $data->beratsumbu3 }}?></p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->beratsumbu4)): ?>
                <p>{{ $data->beratsumbu4 }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <p><b>{{ $data->beratkosong }}</b></p>
              <?php if (!empty($data->dayaangkutorang)): ?>
                <p style="margin-top:20px">{{ $data->dayaangkutorang }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->dayaangkutbarang)): ?>
                <p style="margin-top:20px">{{ $data->dayaangkutbarang }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->jbi)): ?>
                <p style="margin-top:20px">{{ $data->jbi }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <br>
              <br>
              <br>
              <br>
              <?php if (!empty($data->jbki)): ?>
                <p>{{ $data->jbki }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <br>
              <br>
              <br>
              <br>   
              <br>         
              <?php if (!empty($data->mst)): ?>
                <p>{{ $data->mst }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <br>
              <p>{{ $data->kelasjalanterendah }}</p></b>
            </div>
          </div>      
       </div> 
      </div>
    </div>

    <div class="container-fluid kertasbaru">
      <div class="row" style="margin-top: 65px">
        <div class="col-sm-6">
          <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-2"></div>
          <div class="col-sm-3 text-center">
            <p style="line-height: 37px;margin-top:18px;">{{ $data->alatuji_remutamatotalgayapengereman }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan1 }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan2 }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan3 }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan4 }}</p>
            <p style="line-height: 27px;margin-top:47px">{{ $data->alatuji_lampuutamakekuatanpancarlampukanan }}</p>
            <p>{{ $data->alatuji_lampuutamakekuatanpancarlampukiri }}</p>
            <p>{{ $data->alatuji_lampuutamapenyimpanganlampukanan }}</p> 
            <p>{{ $data->alatuji_lampuutamapenyimpanganlampukiri }}</p> 
            <p>{{ $data->alatuji_emisiasapbahanbakarsolar }}</p> <!-- lampu -->
            <br>
            <br>
            <?php if ((int)$data->thpembuatan<2007) { ?>
              <p>{{ $data->alatuji_emisicobahanbakarbensin }}</p>
              <p>{{ $data->alatuji_emisihcbahanbakarbensin }}</p>
              <p></p>
              <p></p>
            <?php } else { ?>
              <p></p>
              <p></p>
              <p style="margin-top:50px">{{ $data->alatuji_emisicobahanbakarbensin }}</p>
              <p>{{ $data->alatuji_emisihcbahanbakarbensin }}</p>
            <?php } ?>
            
          </div>
          <div class="col-sm-3 text-center">
            <br>
            <b>
            <p style="line-height: 10px;margin-top:50px">LULUS</p>
            <p>BANJARMASIN</p>
            @php $date=date_create($data->tglpendaftaran)
            @endphp
            <p>{{ date_format($date,"d-M-y") }}</span></p>
            <br>
            @php $date1=date_create($data->masaberlakuuji)
            @endphp
            <p style="margin-top:30px">{{ date_format($date1,"d-M-y") }}</span></p>
            </b>
          </div>
          </div>
        </div>   
      </div>   
    </div>
    <div class="container-fluid kertasbaru">
      <div class="row" style="margin-top: 15px">
        <div class="col-sm-6">            
        </div>      
        <div class="col-sm-6">
          <div class="col-sm-2"></div>
          <div class="col-sm-3"></div>
          <div class="col-sm-3">
          <b>
            <p style="line-height: 27px;margin-top:18px;">{{ $data->alatuji_remutamatotalgayapengereman }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan1 }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan2 }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan3 }}</p>
            <p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan4 }}</p>
            <p style="line-height: 27px;margin-top:47px">{{ $data->alatuji_lampuutamakekuatanpancarlampukanan }}</p>
            <p>{{ $data->alatuji_lampuutamakekuatanpancarlampukiri }}</p>
            <p>{{ $data->alatuji_lampuutamapenyimpanganlampukanan }}</p> 
            <p>{{ $data->alatuji_lampuutamapenyimpanganlampukiri }}</p> 
            <p>{{ $data->alatuji_emisiasapbahanbakarsolar }}</p> <!-- lampu -->
            <br>
            <br>
            <?php if ((int)$data->thpembuatan<2007) { ?>
              <p>{{ $data->alatuji_emisicobahanbakarbensin }}</p>
              <p>{{ $data->alatuji_emisihcbahanbakarbensin }}</p>
              <p></p>
              <p></p>
            <?php } else { ?>
              <p></p>
              <p></p>
              <p style="margin-top:50px">{{ $data->alatuji_emisicobahanbakarbensin }}</p>
              <p>{{ $data->alatuji_emisihcbahanbakarbensin }}</p>
            <?php } ?>
            </b>
          </div>
          <div class="col-sm-4 text-center">
            <br>
            <b>
            <p style="line-height: 10px;margin-top:50px">LULUS</p>
            <p>BANJARMASIN</p>
            @php $date=date_create($data->tglpendaftaran)
            @endphp
            <p>{{ date_format($date,"d-M-y") }}</span></p>
            <br>
            @php $date1=date_create($data->masaberlakuuji)
            @endphp
            <p>{{ date_format($date1,"d-M-y") }}</span></p>
            </b>
          </div>
        </div>
        <div class="col-sm-6">            
        </div>      
      </div>
    </div>  
</body>
</html>