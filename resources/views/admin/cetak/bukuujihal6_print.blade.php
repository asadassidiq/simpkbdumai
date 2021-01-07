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
			display: block; 
			font-family: "Consolas";
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
      <div class="row" style="margin-top: 65px">
        <div class="col-sm-6">
          <div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-3"></div>
				<div class="col-sm-2 text-center" style="padding:0">
				<b>
				<p style="line-height: 37px;">{{ $data->alatuji_remutamatotalgayapengereman }}</p>
				<p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan1 }}</p>
				<p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan2 }}</p>
				<p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan3 }}</p>
				<p style="line-height: 27px">{{ $data->alatuji_remutamaselisihgayapengeremanrodakirikanan4 }}</p>
				<p style="line-height: 27px;">{{ $data->alatuji_lampuutamakekuatanpancarlampukanan }}</p>
				<p>{{ $data->alatuji_lampuutamakekuatanpancarlampukiri }}</p>
				<p>{{ $data->alatuji_lampuutamapenyimpanganlampukanan }}</p> 
				<p>{{ $data->alatuji_lampuutamapenyimpanganlampukiri }}</p> 
				<p>{{ $data->alatuji_emisiasapbahanbakarsolar }}</p></b> <!-- lampu -->
				<br>
				<br>
				<?php if ((int)$data->thpembuatan<2007) { ?>
					<b>
				  <p>{{ $data->alatuji_emisicobahanbakarbensin }}</p>
				  <p>{{ $data->alatuji_emisihcbahanbakarbensin }}</p>
				  <p></p>
				  <p></p>
				<?php } else { ?>
				  <br>
				  <br>
				  <p style="margin-top:50px">{{ $data->alatuji_emisicobahanbakarbensin }}</p>
				  <p>{{ $data->alatuji_emisihcbahanbakarbensin }}</p></b>
				<?php } ?>
				</div>
				<div class="col-sm-5 text-left" style="padding:0">
					<br>
					@php $date=date_create($data->tglpendaftaran)
					@endphp
					<b><p style="line-height: 10px;margin-top:30px">LULUS</p></b>
					<br>
					<p>BANJARMASIN</p>
					<p class="text-left" style="font-size:12px">{{ date_format($date,"dMy") }}</span></p>
					<br>
					@php $date1=date_create($data->masaberlakuuji)
					@endphp
					<p style="margin-top:30px;font-size:12px">{{ date_format($date1,"dMy") }}</span></p>
					
			  </div>
        </div>   
      </div>   
    </div>
</body>
</html>