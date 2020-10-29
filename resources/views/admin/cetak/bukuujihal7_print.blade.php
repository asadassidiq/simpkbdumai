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
         @page { size: landscape; }
    </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
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