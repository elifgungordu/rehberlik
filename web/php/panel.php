
<?php
require (__DIR__."\action-panel.php");

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
  <script type="text/javascript" src="js/setting-form.js"></script>
  <script src="grafik/js/chart.min.js"></script>
  <script src="js/panel.js"></script>
  <script src="js/grafik_secim.js"></script>
     
</head>
<body>

<?php 

if ($_SESSION["tip"]!="Admin") {  // Giriş Yapan Eğer ADMİN DEĞİLSE  aşağıdaki sidebar*****************************************************
?>

 <div class="row w-100 bg-light">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-right-0 border-bottom-0 border-danger shadow h-80 py-2 m-3" style="border-radius: 15px;border-width: 7px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" style="font-size: 12px;">
                                Paragraf/Problem
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-muted" style="font-size: 12px;"><?php $gelen=paragrafTotal($db);if($gelen<=0){ $gelen=0;}echo $gelen; ?> Soru</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pencil-ruler" style="font-size: 25px; color:#BDBDBD;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    



        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-right-0 border-bottom-0 border-success shadow h-80 py-2 m-3" style="border-radius: 15px;border-width: 7px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"style="font-size: 12px;">
                                Soru Çözme
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-muted"style="font-size: 12px;"><?php $gelen=kategorikSorucozmeTotal($db);if($gelen<=0){ $gelen=0;}echo $gelen; ?> Soru</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-edit" style="font-size: 25px; color:#BDBDBD;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-right-0 border-bottom-0 border-info shadow h-80 py-2 m-3" style="border-radius: 15px;border-width: 7px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 12px;">
                                Ders Çalışma
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-muted" style="font-size: 12px;"><?php $gelen=derscalismaTotal($db);if($gelen<=0){ $gelen=0;}echo $gelen; ?> Saat</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock" style="font-size: 25px; color:#BDBDBD;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    



       <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-right-0 border-bottom-0 border-warning shadow h-80 py-2 m-3" style="border-radius: 15px;border-width: 7px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 12px;">
                                Kitap Okuma
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-muted" style="font-size: 12px;"><?php $gelen=okumaTotal($db);if($gelen<=0){ $gelen=0;}echo $gelen; ?> Saat</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader" style="font-size: 25px; color:#BDBDBD;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

</div>





  <div class="col-auto">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text text-muted" style="font-size: small;">Göster
          </div>
        </div>
        <select class="form-control text-xs" id="grafik_sec" required>
          <option value="">Seçiniz...</option>
          <option>Deneme Sonucu</option>
          <option>Kitap Okuma</option>
          <option>Ders Çalışma</option>
          <option>Paragraf Çözme</option>
          <option>Problem Çözme</option>
        </select>
    </div>
  </div>










    <div class="row w-100 ">

      <div class="col-lg-12 " id="grafik_cizgi" >
      </div>

   

    </div>



<div class="row w-100 bg-light my-3">
  
  <div class="col-lg-6" id="grafik_problem" >
      
            
  </div>


  <div class="col-lg-6" id="grafik_sorucozum">

   </div>
  

</div>
<?php
}
else{ // Eğer giriş Yapan ADMİN İSE Aşağıdaki Sidebar *******************************************************************************************

?>
<div class="row w-100 bg-light justify-content-center">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-right-0 border-bottom-0 border-danger shadow h-80 py-2 m-3" style="border-radius: 15px;border-width: 7px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" style="font-size: 12px;">
                                Kayıtlı Öğrenci
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-muted" style="font-size: 12px;"><?php $gelen=ogrenciTotal($db);if($gelen<=0){ $gelen=0;}echo $gelen; ?> Öğrenci</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users" style="font-size: 25px; color:#BDBDBD;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    



        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-right-0 border-bottom-0 border-success shadow h-80 py-2 m-3" style="border-radius: 15px;border-width: 7px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"style="font-size: 12px;">
                                Program Kontrol
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-muted"style="font-size: 12px;"><?php $gelen=kategorikSorucozmeTotal($db);if($gelen<=0){ $gelen=0;}echo $gelen; ?> Öğrenci</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks" style="font-size: 25px; color:#BDBDBD;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-top-0 border-right-0 border-bottom-0 border-info shadow h-80 py-2 m-3" style="border-radius: 15px;border-width: 7px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 12px;">
                                Deneme Kontrol
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-muted" style="font-size: 12px;"><?php $gelen=derscalismaTotal($db);if($gelen<=0){ $gelen=0;}echo $gelen; ?> Deneme</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-scroll" style="font-size: 25px; color:#BDBDBD;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    



      
    

</div>


<?php
}

?>
</body>
</html>