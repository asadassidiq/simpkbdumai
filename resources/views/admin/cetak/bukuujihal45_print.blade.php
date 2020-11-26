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
            font-size:12px;
            margin:0;
			bold;
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
            font-size:14px;
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
      <div class="row" >
        <div class="col-sm-6">
          <div class="row" style="margin-top: 10px;padding-right: 30px; line-height:15px">
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
          <div class="row" style="padding-left: 15px;line-height:15px">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
              <b>
              <p>{{ $data->panjangbakatautangki }}</p>
              <p>{{ $data->lebarbakatautangki }}</p>
              <p>{{ $data->tinggibakatautangki }}</p>
              <p></p> <!-- BAHAN -->
			  <p></p>
              <p></p>
              <p></p>
              <p></p>
              <br>
              <p></p>
              <p></p>
              <p></p>
              <br><br><br><br>
			  <br><br><br><br><br><br><br>
              <p><b>{{ $data->ukuranban }}</b></p>
              <p><b>{{ $data->ukuranban }}</b></p>
              

              <p style="margin-top: 30px;line-height:20px">{{ $data->konfigurasisumburoda }}</p>
              <p style="margin-top: 9px;line-height:20px">{{ $data->jbb }}</p>
              <p style="line-height:20px">{{ $data->jbkb }}</p></b>
			</div>
			</div>
        </div>
		<div class="col-sm-6" style="margin-top: 10px;line-height:24px;font-size:14px">  
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
              <p style="margin-top:10px"><b>{{ $data->beratkosong }}</b></p>
              <?php if (!empty($data->dayaangkutorang)): ?>
                <p style="margin-top:20px">{{ $data->dayaangkutorang }}</p>
              <?php else: ?>
                <p style="margin-top:20px"><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->dayaangkutbarang)): ?>
                <p style="margin-top:20px">{{ $data->dayaangkutbarang }}</p>
              <?php else: ?>
                <p><?php echo '0' ?></p>
              <?php endif ?>
              <?php if (!empty($data->jbi)): ?>
                <p style="margin-top:20px">{{ $data->jbi }}</p>
              <?php else: ?>
                <p style="margin-top:20px"><?php echo '0' ?></p>
              <?php endif ?>
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
</body>
</html>