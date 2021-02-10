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
    <div class="container-fluid" style="margin-left: 0px;">
            <div class="row" style="margin-top: 225px; margin-bottom: 22px;">
                <div class="col-sm-8">
                    <p> <span style="letter-spacing: 20px;"> <b><?php echo $data->nouji; ?></b></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <p> <span style="letter-spacing: 20px;"> <b><?php echo $data->noregistrasikendaraan; ?></b></span></p> 
                </div>
                <div class="col-sm-4">
                    <p><b><span style="letter-spacing: 10px;" id="tgl_pend"> <?php $date = date_create($data->tglpendaftaraan);$date = date_format($date,'d m Y'); echo $date ; ?></span></b> </p> 
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row" style="line-height: 12px;font-size: 14px;margin-top: 2px;margin-left: 5px;">
                <div class="col-sm-8">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
              <?php if (!empty($data->nama)) :?>
                <p><b><?php echo $data->nama; ?></b></p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                            
              <?php if (!empty($data->alamat)) :?>
                <p><b><?php echo $data->alamat; ?></b></p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                            
              <?php if (!empty($data->jenis)) :?>
                <p><b><?php echo $data->jenis; ?></b></p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                                    
              <?php if (!empty($data->merek) && !empty($data->tipe)) :?>
                <p><b><?php echo $data->merek; ?> / <?php echo $data->tipe ?></b></p>
              <?php elseif (empty($data->merek)) :?>
                <p>- / <?php echo $data->tipe ?></p>
              <?php elseif (empty($data->tipe)) :?>
              <p><?php echo $data->merek ?> / - </p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                                        
              <?php if (!empty($data->thpembuatan)) :?>
                <p><b><?php echo $data->thpembuatan; ?></b></p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                 
              <?php if (!empty($data->norangka)) :?>
                <p><b><?php echo $data->norangka; ?></b></p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                                        
              <?php if (!empty($data->nomesin)) :?>
                <p><b><?php echo $data->nomesin; ?></b></p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                                          
                    </div>
                </div>
                <div class="col-sm-4">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
              <?php if (!empty($data->isisilinder)) :?>
                <p><b><?php echo $data->isisilinder ?></b></p>
              <?php else: ?>
                <p><b>-</b></p>
              <?php endif ?>                                                        
              <?php if (!empty($data->bahanbakar)) :?>
                <p><b><?php echo $data->bahanbakar ?></b></p>
              <?php else: ?>
                <p>-</p>
              <?php endif ?>                                          
            </div>
          </div>
            </div>
        
        <div class="row text-center" style="line-height: 12px;font-size: 14px;margin-top: 13.95cm;">
          <div class="col-sm-4">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
              <?php if (!empty($data->jbb)) :?>
                <p><?php echo $data->jbb ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                            
              <br><br>
              <?php if (!empty($data->beratsumbu1)) :?>
                <p><?php echo $data->beratsumbu1 ?></p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->beratsumbu2)) :?>
                <p><?php echo $data->beratsumbu2 ?></p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->beratsumbu2)) :?>
                <p><?php echo $data->beratsumbu2 ?></p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->beratsumbu3)) :?>
                <p><?php echo $data->beratsumbu3 ?></p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->beratsumbu4)) :?>
                <p><?php echo $data->beratsumbu4 ?></p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <p><?php echo '0' ?></p>
              <?php if (!empty($data->beratkosong)) :?>
                <p><?php echo $data->beratkosong ?></p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>

              <?php if (!empty($data->dayaangkutorang)) :?>
                <p><?php echo $data->dayaangkutorang ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                     
              <?php if (!empty($data->dayaangkutbarang)) :?>
                <p><?php echo $data->dayaangkutbarang ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                                         
              <?php if (!empty($data->jbi)) :?>
                <p><?php echo $data->jbi ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                           
              <?php if (!empty($data->mst)) :?>
                <p><?php echo $data->mst ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                              
              <?php if (!empty($data->kelasjalanterendah)) :?>
                <p><?php echo $data->kelasjalanterendah ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                
              <br>

              <p><?php echo '0' ?></p>
              <p><?php echo '0' ?></p>
              <p><?php echo '0' ?></p>
              <p><?php echo '0' ?></p>
              <p><?php echo '0' ?></p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 text-center">
              <br>
              <br>
              <?php if (!empty($data->panjangkendaraan)) :?>
                <p><?php echo $data->panjangkendaraan ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                    
              <?php if (!empty($data->lebarkendaraan)) :?>
                <p><?php echo $data->lebarkendaraan ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>                            
              <?php if (!empty($data->tinggikendaraan)) :?>
                <p><?php echo $data->tinggikendaraan ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>              
              <p><?php echo '0' ?></p>
              <p><?php echo '0' ?></p>
              <p><?php echo '0' ?></p>
              <?php if (!empty($data->julurdepan)) :?>
                <p><?php echo $data->julurdepan  ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>
              <?php if (!empty($data->julurbelakang)) : ?>
                <p><?php echo $data->julurbelakang  ?></p>
              <?php else: ?>
                <p>0</p>
              <?php endif ?>           
              <p><?php echo '0' ?></p>
              <?php if (!empty($data->konfigurasisumburoda)) : ?>
                <p><?php echo $data->konfigurasisumburoda ?></p>
              <?php else: ?>
              <p>0</p>
            <?php endif ?>                         
            </div>
          </div>
          <div class="col-sm-4"></div>
        </div>
        <div class="row" style="line-height: 9px;font-size: 14px;">
          <!-- <div class="col-sm-4"> -->
            <p><span id="hr" style="display: none;"><?php $date= date_create($data->tgltransaksi);$date= date_format($date,"D");echo $date; ?></p>
            <p style="margin-left: 255px;"><b><span id="date"></span></span></b><span class="t"></span><b><?php echo $data->tgltransaksi ?></b></p>      
          <!-- </div> -->
        </div>
        <div class="row" style="line-height: 9px;font-size: 14px;"> 
            <p style="display: none"><b><span id="tot"></span></b></p>                     
            <p style="margin-left: 160px;"><b><span id="txt"></span></b></p>          
        </div>
        </div>
</body>
</html>