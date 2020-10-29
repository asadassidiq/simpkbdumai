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

         @media print {
            .kertasbaru {page-break-before: always;}
          }
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
</body>
</html>