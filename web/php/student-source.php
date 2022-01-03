<?php
require (__DIR__."\kaynak-islem.php");

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

  <!-- Favicons -->
  <link href="assets/img/kapsislogo.png" rel="apple-touch-icon">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <!-- sayfa CSS dosyaları -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/kaynak-islemleri.js"></script>


     
</head>
<body>

<div class="container">



  <form class="d-flex justify-content-center mt-5"  name="register-form" method="POST">
    <div class="form-row align-items-center bg-light col-lg-8 p-3 rounded border border-info shadow">
      <div class="container text-center my-3"><h5>Kaynak Ekleme Ekranı</h5></div>
        <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Yayınevi Adı
                </div>
              </div>
              <input type="text" class="form-control text-capitalize"  id="yayinevi_adi" autocomplete="off" required>
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Kaynak Türü
                </div>
              </div>
              <select class="form-control" id="kaynak_turu" required>
                <option value="">Seçiniz...</option>
                <option>Konu Anlatımı</option>
                <option>Soru Bankası</option>
                <option>Fasikül</option>
                <option>Branş Denemesi</option>
                <option>Okuma Kitabı</option>
              </select>
          </div>
        </div>

         <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Kitap Adı
                </div>
              </div>
              <input type="text" class="form-control text-capitalize" id="kitap_adi" autocomplete="off" required>
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text text-muted" style="font-size: small;">Sayfa Sayısı
                </div>
              </div>
            <input type="number" min="0" class="form-control"  id="sayfa_sayisi" autocomplete="off" required>
          </div>
        </div>

        <a class="btn btn-outline-success ml-2 mb-2" role="button" id="kaynak_ekle">Ekle</a>

    </div>
  </form>


</div>




<div class="container mt-5">
  
  <table class="table table-sm shadow">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Yayınevi Adı</th>
      <th scope="col">Kaynak Türü</th>
      <th scope="col">Kitap Adı</th>
      <th scope="col">Sayfa Sayısı</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>

  <tbody id="tablom">
<?php
    kaynakListele($db);
?>
    

  </tbody>
</table>


</div>


</body>
</html>