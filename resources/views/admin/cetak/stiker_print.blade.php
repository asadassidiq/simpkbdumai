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

         @media print{
          html, body{
            width: 23cm;
            height: 20cm;
          }
         }
    </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-5 text-center" style="margin-left: 15cm;margin-top:2cm">
          <p style="font-size: 21px"><b><?php $date=date_create(date('d-M-y')); echo date_format($date,"d F Y"); ?></b></p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 text-center">
               <p style="font-size: 30px;margin-top: 14cm;padding-bottom: 0px;line-height: 10px"><b>{{ $data->nouji }}</b></p>
               <p style="font-size: 30px;padding-top: 0px; "><b>{{ $data->noregistrasikendaraan }}</b></p>
        </div>
        <div class="col-sm-6">
            <div class="row text-center" style="margin-top:10px;line-height: 30px">
                <div class="col-sm-12">
                  <p><b>{{ $data->beratkosong }}</b></p>
                  <p style="margin-top: 15px;"><b>{{ $data->panjangkendaraan }}</b></p>
                  <p ><b>{{ $data->lebarkendaraan }}</b></p>
                  <p ><b>{{ $data->tinggikendaraan }}</b></p>
                  <p ><b>{{ $data->jbb }}</b></p>
                  <p ><b>{{ $data->jbi }}</b></p>
                  <p ><b>{{ $data->mst }}</b></p> 
                </div>  
            </div>         
            <div class="row text-right" style="margin-top: 50px;">
                <div class="col-sm-3">
                  <p style="margin-right: -38px;"><b>{{ number_format((int)$data->dayaangkutorang/(int)60) }}</b></p>
                </div>
                <div class="col-sm-3">              
                </div>
                <div class="col-sm-6 text-center">
                  <b>{{ $data->dayaangkutorang }}</b>
                </div>                       
            </div>
            <div class="row text-center" style="margin-top:-20px;line-height: 30px">
                <div class="col-sm-12">  
                  <p><b>{{ $data->dayaangkutbarang }}</b></p>
                  <p><b>{{ $data->kelasjalanterendah }}</b></p>
                  <p></p>
                  <p class="text-center" style="font-size: 14"><b>UPTD PENGUJIAN KENDARAAN BERMOTOR</b></p>
                  <p class="text-center" style="font-size: 14px"><b>DINAS PERHUBUNGAN KOTA BANJARMASIN</b></p>
                </div>
            </div>
            <div class="row text-right" style="margin-top:3cm">
                <div class="col-sm-12">
                    <p  style="margin-right:60px"><b>A. JUNAIDI, SE</b></p>
                    <p style="font-size:15px;line-height:14px;"><b>063.071.PT4.01.001</b></p>
                    <p style="font-size:15px;line-height:14px;"><b>196212211983021003</b></p>
                </div> 
            </div>
      </div>
    </div>
    </div>
</body>
</html>