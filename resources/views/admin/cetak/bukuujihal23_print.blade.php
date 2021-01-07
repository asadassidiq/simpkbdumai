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
    </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
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
              <?php if (!empty($data->isisilinder)): ?>
              <p  style="margin-top:60px">{{ $data->isisilinder }}</p>
              <?php else: ?>
              <p style="margin-top:60px">0</p>
              <?php endif ?>
              <?php if (empty($data->dayamotorpenggerak)): ?>
              <p style="margin-top:15px">0</p>
              <?php else: ?>
              <p style="margin-top:15px">{{ $data->dayamotorpenggerak }}</p>
              <?php endif ?>
              <p >{{ strtoupper( $data->bahanbakar) }}</p>
              <p style="margin-top:10px">{{ $data->thpembuatan }}</p>
                            
              <p></p>
              <p style="margin-top:90px;">{{ $data->norangka }}</p>
              <p style="margin-top:10px;">{{ $data->nomesin }}</p>
              </b>
            </div>
          </div>   
  
       </div> 
      </div>
    </div>
  </body>
</html>