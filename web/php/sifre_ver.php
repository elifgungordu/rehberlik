<?php


require (__DIR__."\dash.php");

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
  <script src="js/sifre_ver.js"></script>

     
</head>
<body>
 

 

<div class="alert alert-danger shadow" role="alert"> Şifresini unutan kullanıcılara buradan yeni şifre verebilirsiniz !</div>

<div class="container mb-5">
      <form class="d-flex justify-content-center mt-5" action="php/dash.php?islem=kullanicisifredegistir" method="POST">
        <div class="form-row align-items-center bg-light col-lg-4 p-3 rounded border border-primary shadow">
          <div class="container text-center my-3"><h5>Yeni Şifre Ver</h5></div>
          

            <div class="col-auto">
                <div class="input-group mb-2" style="width: 300px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Kullanıcı
                    </div>
                  </div>
                  <select class="form-control" name="kullanici" id="kullanici" required>
                    <option value="">Seçiniz...</option>
                    <option>Öğrenci</option>
                  </select>
              </div>
            </div>



            <div class="col-auto">
                <div class="input-group mb-2" style="width: 300px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Kişi
                    </div>
                  </div>
                  <select class="form-control" name="kullanicilist" id="kullanicilist" required>
                    <option value="">Seçiniz...</option>

                  </select>
              </div>
            </div>

            <div class="col-auto">
                <div class="input-group mb-2" style="width: 300px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Yeni Şifre
                    </div>
                  </div>
                <input type="text" class="form-control"  name="yeni_sifre" autocomplete="off" required>
              </div>
            </div>

             

            <button  class="btn btn-outline-success mb-2 ml-2" type="submit" value="okey" name="kayit" >Kaydet</button>

        </div>
      </form>
</div>




</body>
</html>