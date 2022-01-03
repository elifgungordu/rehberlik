<?php include("php/action-register.php"); ?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>e-KOÇUM | Kayıt Ekranı</title>
  <!-- Favicons -->
  <link href="img/icon.png" rel="icon">
  <link href="img/icon.png" rel="apple-touch-icon">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <!-- sayfa CSS dosyaları -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/menu.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>


</head>

<body >




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





<div class="container" id="kayit-icerik">

      <h1 class="display-4 fw-normal pt-5">Kayıt Ekranı</h1>
      <hr class="style1 border border-info ">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>

      <!-- <div class="alert alert-warning " role="alert">
      <i class="far fa-engine-warning" style="font-size:25px; "></i>  &nbsp; Veli numarası doğru girilmelidir
      </div> -->

      <?php 
    @$islem =strip_tags(htmlspecialchars($_GET["islem"]));
    
    if (@$islem=="ekle") {
      kayit($db);
      header("refresh:0.1; url=register.php");
      die();

    }
    
    ?>

      <form class="d-flex justify-content-center mt-5"  name="register-form" action="register.php?islem=ekle" onsubmit="return kontrol(this)" method="POST">
        <div class="form-row align-items-center bg-light col-lg-8 p-3 rounded border border-info">
          <div class="container text-center pb-3">
                <h1 class="display-5 fw-normal ">Öğrenci Kayıt Formu</h1>
          </div>
          
          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Ad
                </div>
              </div>
            <input type="text" class="form-control text-capitalize"  placeholder="Mehmet" name="student_adi" autocomplete="off" required>
          </div>
          </div>

          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Soyad
                </div>
              </div>
            <input type="text" class="form-control text-capitalize"  placeholder="Yılmaz" name="student_soyadi" autocomplete="off" required>
          </div>
          </div>




          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;" >Tc Kimlik No
                </div>
              </div>
            <input type="text" class="form-control" id="tc" name="student_tc" autocomplete="off" required>   <span class="col-auto badge text-center mt-2" id='tcmessage'></span>
          </div>
          </div>


          

          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Doğum Tarihi
                </div>
              </div>
             <input class="form-control" type="date"  name="student_dogum" required>
          </div>
          </div>



          
          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">e-posta
                </div>
              </div>
            <input type="text" class="form-control"  placeholder="öğrenci@example.com" name="student_mail" autocomplete="off" required>
          </div>
          </div>



          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Sınıf
                </div>
              </div>
              <select class="form-control" name="student_sinif" required>
                <option value="">Seçiniz...</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>Mezun</option>
              </select>
          </div>
          </div>

          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Öğrenci Cep No
                </div>
              </div>
            <input type="text" class="form-control"  placeholder="0555 555 55 55" name="student_cep" autocomplete="off" required>
          </div>
          </div>



          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Veli Ad
                </div>
              </div>
            <input type="text" class="form-control text-capitalize"  placeholder="Samet" name="parent_adi" autocomplete="off" required>
          </div>
          </div>

          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Veli Soyad
                </div>
              </div>
            <input type="text" class="form-control text-capitalize"  placeholder="Yılmaz" name="parent_soyadi" autocomplete="off" required>
          </div>
          </div>



          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Veli Cep No
                </div>
              </div>
            <input type="text" class="form-control"  placeholder="0555 555 55 55" name="parent_cep" autocomplete="off" required>
          </div>
          </div>


          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted"style="font-size: small;">e-posta
                </div>
              </div>
            <input type="email" class="form-control"  placeholder="veli@example.com" name="parent_mail" autocomplete="off"  required>
          </div>
          </div>
    

          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Şifre
                </div>
              </div>
            <input type="password" class="form-control" id="password" name="password"   required>
          </div>
          </div>


          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;" >Şifre Tekrar
                </div>
              </div>
            <input type="password" class="form-control" id="confirm_password"  name="confirm_password" required>  
          </div>
          
          </div>

         <div class="col-auto"><span class=" text-center mt-2" id='message'></span></div>


                   

          <div class="col-lg-9">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;" >Danışman Kodu
                </div>
              </div>
            <input type="password" class="form-control" name="pdr_kod" required >
            <i class="far fa-info-circle text-muted text-center col-auto mt-2" data-toggle="popover" data-placement="right" data-content="Danışmanınızdan onay kodu alın" style="font-size:20px;"> </i>
          </div>
          </div>
           



          <div class="container">
            <button  class="btn btn-success mb-2" type="submit" value="ekle" name="kaydol" >Kaydol</button>
          </div>

        </div>
      </form>
      
</div>





<!-- Footer Bölümü-->
<footer class=" text-center text-white  mt-5" style="background-color: #90A4AE;">
  <!-- Grid container -->


  <hr class="style1 border border-dark ">
    <!-- Section: Social media -->
    <section class="mb-2">
      <!-- Facebook -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-twitter"></i
      ></a>

     

      <!-- Instagram -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-instagram"></i
      ></a>

    
     
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center text-white bg-dark p-3" >
    © 2021 Copyright: Elif GÜNGÖRDÜ
    <!--<a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>-->
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer Bitiş-->







</body>
</html>



