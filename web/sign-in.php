<?php 
include("php/action-sign-in.php"); 
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

  <title>e-KOÇUM | Oturum Aç</title>
<!-- Favicons -->
  <link href="img/icon.png" rel="icon">
  <link href="img/icon.png" rel="apple-touch-icon">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- sayfa CSS dosyaları -->
  <link href="css/bootstrap.min.css" rel="stylesheet">


</head>

<body style="background-image: url('img/library-photo-3.jpg'); object-fit:cover; background-repeat: no-repeat;background-size: cover; background-position: center center; background-attachment: fixed; min-height: 100%; width: 100%; " >





 <!-- Navbar Bölümü-->
    <header class="p-2 bg-dark text-white fixed-top">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <div class="col-lg-2">
        <a href="index.html" class="logo mr-auto"><img id="logo" src="img/logo.png" alt=""class="img-fluid" style="object-fit:contain;height: 75px;width: 150px;"></a>
        </div>

        <div class="col-lg-2"></div>  
        
          <div class="row">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a class="nav-link text-white" href="index.html">Anasayfa</a></li>
              <li><a class="nav-link text-white" href="pricing.html">Fiyatlandırma</a></li>
              <li> <a class="nav-link text-white" href="about.html">Hakkında</a></li>
              <li> <a class="nav-link text-white" href="#">İletişim</a></li>
            </ul>
          </div>


        <div class="col-lg-auto text-center">
          <a class="ml-2 btn-sm btn-success" href="sign-in.php">Giriş</a>
          <a class="ml-2 btn-sm btn-info" href="register.php">Kayıt</a>
        </div>

      </div>
    </div>
  </header>

  <!-- Navbar Bitiş-->





  <?php 
    @$islem =strip_tags(htmlspecialchars($_GET["islem"]));
    
    if (@$islem=="giris") {
      oturum($db);
    }
    
    ?>



<main class="form-signin d-flex justify-content-center  text-center" style="margin-top: 200px;" >

  <?php 
  if (!isset($_SESSION["mail"]) && !isset($_SESSION["tip"]) && !isset($_SESSION["oturum"])) {
    
  

  ?>

  <form class="bg-light p-5 shadow mb-5" action="sign-in.php?islem=giris" method="POST" style=" margin-top:50px; border-radius: 20px;">
    <img class="mb-4" src="img/user.png" alt="" width="80" height="80">

         
   

    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="login_mail"  placeholder="e-posta" autocomplete="off">
    </div>


    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="login_password" placeholder="Şifre" autocomplete="off">
    </div>

    <div class="checkbox mb-3 text-dark">
     
    </div>
    <div class="row">
        <a href="register.php" class="btn btn-md ml-3 btn-info">Kaydol</a>
        <button class=" btn btn-md ml-5 btn-success" type="submit"value="giris" name="giris">Giriş</button>
    </div>
    <div class="mt-3">
      <a  href="#">Şifremi Unuttum</a>

    </div>
    <p class="mt-3  text-dark">&copy;2021</p>
  </form>


<?php
}

else{
  echo '
      <div class="container justify-content-center bg-light shadow mt-5 p-5" style="border-radius:20px;">
        <p class"text-dark">Zaten Giriş Yapmışsın <a class="btn btn-primary btn-sm" href="dashboard.php">Panele Gir</a></p>
      </div>

      ';
}

  ?>


</main>











</body>
</html>