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
        <div class="d-flex align-items-center p-3 my-3 bg-info text-white rounded box-shadow">
        <!-- <img class="mr-3" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-outline.svg" alt="" width="48" height="48"> -->
        <div class="lh-100">
          <h3 class="mb-0 text-white lh-100">SOLTINDO UPLOAD IMAGE</h3>
          <!-- <small>Since 2011</small> -->
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <form action="{{ url('/intervention_postimage') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <!-- <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6> -->
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <label for="exampleFormControlFile1">Foto Tampak Depan</label>
            <input type="file" name="image1" class="form-control-file" id="exampleFormControlFile1">
          </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <label for="exampleFormControlFile1">Foto Tampak Kanan</label>
            <input type="file" name="image2" class="form-control-file" id="exampleFormControlFile1">
          </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <label for="exampleFormControlFile1">Foto Tampak Belakang</label>
            <input type="file" name="image3" class="form-control-file" id="exampleFormControlFile1">
          </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <label for="exampleFormControlFile1">Foto Tampak Kiri</label>
            <input type="file" name="image4" class="form-control-file" id="exampleFormControlFile1">
            <input type="text" name="nouji" value="{{ $kendaraan }}" class="form-control-file" id="exampleFormControlFile1">
          </p>
        </div>
        <div class="form-group">
            <button class="btn btn-danger btn-sm">Upload</button>
        </div>
        </form>
      </div>
    </div>
</body>
</html>