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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <style type="text/css">
    body {
          background: rgb(204,204,204); 
          font-size: 14px;
        }
        page {
          background: white;
          display: block;
          margin: 0 auto;
          margin-bottom: 0.5cm;
          box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        
        page[size="F4"] {  
          width: 21cm;
          height: 16.5cm; 
        }

        @media print {
          body, page {
            margin: 0;
            box-shadow: 0;
          }
        }
  </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
        <div class="row" style="margin-top: 15px">
             <div class="col-2"></div>
               <div class="col-8"></div> 
        </div>          
        <div class="row" style="margin-top: 140px">
            <div class="col-3"></div>
            <div class="col-7"></div>
            <div class="col-2" style="line-height: 9px;">
          <p><b><span><?php echo $data->nouji; ?></span></b></p></p>
          <p><b><span><?php echo $data->noregistrasikendaraan; ?></span></b></p></p>
          <!-- <p><b><span>ACT72-C18-00002</span></b></p></p> -->
            </div>
        </div>
        <div class="row" style="margin-top: 10px; line-height: 12px">
            <div class="col-4"></div>
            <div class="col-6">
                <P> <span id="terima"></span> Rupiah</P>
                <P> <span id="uang"></span> Rupiah</P>
            </div>  
        </div> 
        <div class="row">
        <div class="col-3"></div>  
        <div class="col-9">
          <div class="row" style="line-height: 10px;">
            <div class="col-5">
            </div>
            <div class="col-3 ">
              <p style="margin-top: 100px;">   <b><span id="tot"><?php echo $data->total; ?></span></b></p>
            </div>
          </div>
        </div>
      </div>
        <div class="row" style="margin-top: 0px">
            <div class="col-7">
                <p><u><b></b></u></p>
                <div class="col-2">
                </div>
                <div class="col-5">
                    <p></p>
                </div>
            </div>
            <div class="col-5" style="margin-top: 13px;">
                <p class="text-center" style="padding-left: 55px; "><?php echo $data->tglbayar; ?></p>
                <br><br><br>
            </div>
        </div>
    </div>
  <script type="text/javascript">
  $(document).ready(function(){
    terbilang();
    console.log("ok");
      function terbilang(){
                var bilangan    =$("#tot").text();
                var kalimat="";
                var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
                var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
                var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
                var panjang_bilangan = bilangan.length;

                /* pengujian panjang bilangan */
                if(panjang_bilangan > 15){
                    kalimat = "Diluar Batas";
                }else{
                    /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
                    for(i = 1; i <= panjang_bilangan; i++) {
                        angka[i] = bilangan.substr(-(i),1);
                    }
                     
                    var i = 1;
                    var j = 0;
                     
                    /* mulai proses iterasi terhadap array angka */
                    while(i <= panjang_bilangan){
                        subkalimat = "";
                        kata1 = "";
                        kata2 = "";
                        kata3 = "";
                         
                        /* untuk Ratusan */
                        if(angka[i+2] != "0"){
                            if(angka[i+2] == "1"){
                                kata1 = "Seratus";
                            }else{
                                kata1 = kata[angka[i+2]] + " Ratus";
                            }
                        }
                         
                        /* untuk Puluhan atau Belasan */
                        if(angka[i+1] != "0"){
                            if(angka[i+1] == "1"){
                                if(angka[i] == "0"){
                                    kata2 = "Sepuluh";
                                }else if(angka[i] == "1"){
                                    kata2 = "Sebelas";
                                }else{
                                    kata2 = kata[angka[i]] + " Belas";
                                }
                            }else{
                                kata2 = kata[angka[i+1]] + " Puluh";
                            }
                        }
                         
                        /* untuk Satuan */
                        if (angka[i] != "0"){
                            if (angka[i+1] != "1"){
                                kata3 = kata[angka[i]];
                            }
                        }
                         
                        /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
                        if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                            subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
                        }
                         
                        /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
                        kalimat = subkalimat + kalimat;
                        i = i + 3;
                        j = j + 1;
                    }

                if ((angka[5] == "0") && (angka[6] == "0")){
                        kalimat = kalimat.replace("Satu Ribu","Seribu");
                    }
                }
                $("#terima").html(kalimat);
                $("#uang").html(kalimat);
            }
    });
  </script>
  </body>
</html>