<?php

require (__DIR__."\dash.php");
date_default_timezone_set('Europe/Istanbul');

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

?>


<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
  <!-- Favicons -->
  <link href="favicon.jpg" rel="icon">
  <link href="assets/img/kapsislogo.png" rel="apple-touch-icon">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <!-- sayfa CSS dosyaları -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>



     
</head>
<body>


<?php

      $nowDate=date('Y-m-d H:i:s');
      $veritabani=sonGirisProblem($db);
      $dateDifference = date_diff(date_create($veritabani), date_create($nowDate));

      if ($dateDifference->days > 0 || $veritabani=="") {
            
?>


<div class="alert alert-warning text-sm shadow" role="alert">Günde sadece 1 kez paragraf-problem çözme bilgilerini girebilirsin ! </div>

<div class="container mb-5">
                <form class="d-flex justify-content-center mt-5" action="php/dash.php?islem=problem_kayit" method="POST">
                  <div class="form-row align-items-center bg-light col-lg-4 p-3 rounded border border-primary shadow">
                    <div class="container text-center my-3"><h5>Paragraf-Problem Çözme Ekranı</h5></div>

                     

                      <div class="col-auto">
                          <div class="input-group mb-2" style="width: 300px;">
                            <div class="input-group-prepend">
                              <div class="input-group-text text-muted" style="font-size: small;">Çözülen
                              </div>
                            </div>
                            <select class="form-control" name="cozulen" required>
                              <option value="">Seçiniz...</option>
                              <option >Paragraf</option>
                              <option >Problem</option>

                            </select>
                        </div>
                      </div>

                      <div class="col-auto">
                          <div class="input-group mb-2" style="width: 300px;">
                            <div class="input-group-prepend">
                              <div class="input-group-text text-muted" style="font-size: small;">Çözülen Soru Sayısı
                              </div>
                            </div>
                          <input type="number" min="0" class="form-control"  name="soru_sayisi" autocomplete="off" required>
                        </div>
                      </div>

                       <div class="col-auto">
                          <div class="input-group mb-2" style="width: 300px;">
                            <div class="input-group-prepend">
                              <div class="input-group-text text-muted" style="font-size: small;">Çözme Süresi
                              </div>
                            </div>
                          <input type="number" min="0" class="form-control"  name="cozme_suresi" autocomplete="off" required>
                          <i class="fas fa-info-circle text-muted text-center col-auto mt-2"style="font-size:20px;" data-toggle="popover" data-placement="right" data-content="Dakika cinsinden giriş yapın!" > </i>
                        </div>
                      </div>

                      <button  class="btn btn-outline-success mb-2 ml-2" type="submit" value="oki" name="kayit" >Kaydet</button>

                  </div>
                </form>


              </div>
              <script type="text/javascript">
                
                $(function () {
                  $('[data-toggle="popover"]').popover();
                });
              </script>
<?php

                 }
                 else{
?>
<div class="alert alert-danger text-sm" role="alert">Günde sadece 1 kez paragraf-problem çözme bilgilerini girebilirsin ! </div>
<?php

                 }


  ?>

</body>
</html>