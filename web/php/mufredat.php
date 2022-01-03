<?php

require (__DIR__."\action-panel.php");
require (__DIR__."\mufredat-islem.php");

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
  <script src="js/mufredat.js"></script>


     
</head>
<body>


<div class="container text-center my-3"><h5>Yıllık Müfredata Göre Ders-Konu İçeriklerini Oluşturabilirsiniz</h5></div>


<!-- DERS KAYIT İŞLEMLERİ -->
<div class="container mb-5">
      <form class="d-flex justify-content-center mt-5"  method="POST">
        <div class="container align-items-center bg-light col-lg-12 p-3 rounded border border-primary shadow">
          <div class="container text-center my-3"><h5>Yıllık Müfredata Göre Ders Ekleyin</h5></div>

           

            <div class="row justify-content-center">

                <div class="input-group m-2" style="width: 200px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Sınıf
                    </div>
                  </div>
                  <select class="form-control" id="ders_sinif" required>
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

                <div class="input-group m-2" style="width: 300px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Ders Adı
                    </div>
                  </div>
                <input type="text" class="form-control"  id="dersadi" autocomplete="off" required>
              </div>
                <a class="btn btn-success m-2" role="button" id="ders_kaydet">Ders Kaydet</a>
            </div>


            <a id="dersler" class="list-group-item list-group-item-action bg-info text-white text-center">DERS LİSTESİ</a>

             <div class="container border border-info" id="ders_tablo">

              <table class="table table-sm ">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">SINIF</th>
                  <th scope="col">DERS ADI</th>
                  <th scope="col">İŞLEM</th>
                </tr>
              </thead>

              <tbody id="derstablom">
            <?php
               dersListele($db);
            ?>            

              </tbody>
            </table>
            </div>
        </div>
      </form>


<hr class="style14 bg-warning mt-5">


<!-- KONU KAYIT İŞLEMLERİ -->
<form class="d-flex justify-content-center mt-5"  method="POST">
        <div class="container align-items-center bg-light col-lg-12 p-3 rounded border border-primary shadow">
          <div class="container text-center my-3"><h5>Yıllık Müfredata Göre Konu Ekleyin</h5></div>

           

           
           

             <div class="row justify-content-center">

                <div class="input-group m-2" style="width: 200px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Sınıf
                    </div>
                  </div>
                  <select class="form-control"  id="konu_sinif" required>
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

                <div class="input-group m-2" style="width: 300px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Ders Adı
                    </div>
                  </div>
                  <select class="form-control" id="konu_dersadi"  required>
                    <option value="">Seçiniz...</option>

                   
                                          
                  </select>
                   
                </div>


              <div class="input-group m-2" style="width: 300px;">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-muted" style="font-size: small;">Konu Adı
                    </div>
                  </div>
                <input type="text" class="form-control"  id="konuadi" autocomplete="off" required>
              </div>
               
                <a class="btn btn-success m-2" role="button" id="konu_kaydet">Konu Kaydet</a>
            </div>


            <a id="konular" class="list-group-item list-group-item-action bg-info text-white text-center">DERS-KONU LİSTESİ</a>

             <div class="container border border-info" id="konu_tablo">

              <table class="table table-sm ">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">SINIF</th>
                  <th scope="col">DERS ADI</th>
                  <th scope="col">KONU ADI</th>
                  <th scope="col">İŞLEM</th>
                </tr>
              </thead>

              <tbody id="konutablom">
            <?php
               konuListele($db);
            ?>            

              </tbody>
            </table>
            </div>
        </div>
      </form>





</div>




</body>
</html>