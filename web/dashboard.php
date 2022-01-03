<?php

require (__DIR__."\php\dash.php");

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

  <title>e-KOÇUM | Panel</title>
   <!-- Favicons -->
  <link href="img/icon.png" rel="icon">
  <link href="img/icon.png" rel="apple-touch-icon">


  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <!-- sayfa CSS dosyaları -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/dash-action.js"></script>



     
</head>

<body>
<?php

if (isset($_SESSION["mail"]) && isset($_SESSION["tip"]) && isset($_SESSION["oturum"])) {

?>

<!-- Navbar Bölümü-->

<div class="navbar bg-dark">
   
  <div class="col-auto">
    <a href="index.html" class="logo mr-auto"><img id="logo" src="img/logo.png" alt=""class="img-fluid" style="object-fit:contain;height: 75px;width: 150px;"></a>
  </div>

    <div class="col-auto">

    <div class="dropdown btn-group dropleft">
        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="secenek" style="border-radius: 20px;">
          <?php
            
           $ad =$_SESSION["isim"]." ".$_SESSION["soyisim"];
           echo $ad;
            
          ?>
        </button>

        <div class="dropdown-menu" id="menu">
            <!-- Dropdown menu links -->
            <a class="dropdown-item" id="setting">Profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" id="exit">Çıkış</a>
        </div>
    </div>    
    <img id="logo" src="img/user.png" alt="" class="img-fluid m-2" style="border-radius: 50%; width: 35px; height: 35px;">
    
    </div> 
   
</div>

<!-- Navbar Bitiş-->


<div class="container-fluid " >
  <div class="row ">
      <!-- Sidebar Bölümü-->
      <?php 
      if ($_SESSION["tip"]!="Admin") {    //************************************ Giriş yapan ADMİN değil ise *****************************************

      ?>
      <div class="col-2 justify-content-start bg-dark  h-100 shadow" >
              
                 
                  <div class="d-flex justify-content-center">
                   <h6 class="text-white text-center mt-4">Öğrenci Paneli</h6>
                  </div>
               
               <hr class="style14 bg-white">


              <ul class="nav flex-column text-white align-items-start">

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="sayfam"> <i class="fas fa-home " >&nbsp; </i>Sayfam </a>
                   
                </li> 

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="deneme"> <i class="fas fa-feather-alt ">&nbsp; </i> Denemeler</a>
                </li> 

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="program"> <i class="fas fa-tasks ">&nbsp;</i> Programım </a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="kitap_okuma"> <i class="fas fa-book-reader ">&nbsp; </i> Kitap Okuma</a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="problem"> <i class="fas fa-pencil-ruler">&nbsp; </i> Paragraf-Problem</a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="soru_cozme"> <i class="fas fa-user-edit">&nbsp; </i> Soru Çözme</a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="ders_calisma"> <i class="fas fa-user-clock">&nbsp; </i> Ders Çalışma</a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link text-white" role="button" id="source_bt"> <i class="fas fa-book ">&nbsp; </i> Kaynaklarım</a>
                </li>





                <li class="nav-item">
                  <div class="container" style="height: 250px;"></div>

                </li>
               

              </ul>
      </div> 
    
      <!-- Sidebar Bitiş-->
    
      <div  class="col-10  justify-content-end  mt-2 text-white ">
          <!-- Main Bölümü-->
          <div class="container bg-light text-dark mt-2 shadow" style="border-radius: 5px;">

                
                      
               
                <!-- İÇERİK BÖLÜMÜ-->
                <div class="row d-flex justify-content-center" id="icerik">



                


                   


                </div>
                <!-- İÇERİK BÖLÜMÜ BİTİŞ-->

            





            
          </div>
          <!-- Main Bitiş-->
      </div>

 </div>
</div>

<?php
}
else{
  header("refresh:0.1;url=/web/sign-in.php");


}
?>



</body>
</html>