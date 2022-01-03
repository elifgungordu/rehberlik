<?php

 require (__DIR__."\dbconnect.php");

if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 


// Admin DERS Kaydet
function dersKaydet($db,$sinif,$ders){
        $ekle=$db->prepare("INSERT INTO dersler (sinif,ders) VALUES(:V_sinif,:V_ders)");
        $ekle->bindparam(':V_sinif',$sinif,PDO::PARAM_STR);
        $ekle->bindparam(':V_ders',$ders,PDO::PARAM_STR);
        $ekle->execute();


        $db=null;

}
//Admin KONU Kaydet
function konuKaydet($db,$sinif,$dersadi,$konuadi){
        $ekle=$db->prepare("INSERT INTO konular (sinif,ders,konu) VALUES(:V_sinif,:V_ders,:V_konu)");
        $ekle->bindparam(':V_sinif',$sinif,PDO::PARAM_STR);
        $ekle->bindparam(':V_ders',$dersadi,PDO::PARAM_STR);
        $ekle->bindparam(':V_konu',$konuadi,PDO::PARAM_STR);
        $ekle->execute();


        $db=null;

}
//Admin Tablo Konu Listele
function konuListele($db){
            $sor=$db->prepare("SELECT * FROM konular ORDER BY sinif DESC") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo'
                  <tr>
                    <th scope="row" id="satir">'.$data["id"].'</th>
                    <td>'.$data["sinif"].'</td>
                    <td>'.$data["ders"].'</td>
                    <td>'.$data["konu"].'</td>
                    <td> <a class="btn btn-sm btn-outline-danger ml-2" href="php/mufredat-islem.php?konu_sil='.$data["id"].'" value="ok" id="butt" role="button">Sil</a></td>
                  </tr>';
                    }

             
            }

}


//Admin Tablo Ders Listele
function dersListele($db){

            $sor=$db->prepare("SELECT * FROM dersler ORDER BY sinif DESC") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo'
                  <tr>
                    <th scope="row" id="satir">'.$data["id"].'</th>
                    <td>'.$data["sinif"].'</td>
                    <td>'.$data["ders"].'</td>
                    <td> <a class="btn btn-sm btn-outline-danger ml-2" href="php/mufredat-islem.php?ders_sil='.$data["id"].'" value="ok" id="butt" role="button">Sil</a></td>
                  </tr>';
                    }

             
            }

}

//admin Selectbox için Dersleri ver
function dersSelect($db,$sinif){
          $dizi=array();
          $bul=$db->prepare("SELECT * FROM dersler where sinif='$sinif' ") or die("HATA");
          $bul->execute();
          //VERİ VAR İSE
          if ($bul->rowCount()!=0) {
            while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
              $dizi[]=$data["ders"];
            }
               $dizi=json_encode($dizi,JSON_FORCE_OBJECT, JSON_UNESCAPED_UNICODE);
               echo $dizi;
          }

}

//Admin Tablo Ders Sil
function dersSil($db,$idno){

  $bul=$db->prepare("SELECT * FROM dersler where id='$idno' ") or die("HATA");
  $bul->execute();
  //VERİ VAR İSE
  if ($bul->rowCount()!=0) {
    while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
      $ders=$data["ders"];
      $sinif=$data["sinif"];

       }
      // derse ait konuları sil
      $konusil=$db->prepare("DELETE FROM konular where sinif='$sinif' AND ders='$ders' ");
      $konusil->execute();


      // dersi sil
      $derssil=$db->prepare("DELETE FROM dersler where id='$idno' ");
      $derssil->execute();
      header("refresh:0.1, url=/web/dashboard.php");
    }

}

// Admin Tablo Konu Sil
function konuSil($db,$idno){

      $sil=$db->prepare("DELETE FROM konular where id='$idno' ");
      $sil->execute();
      header("refresh:0.1, url=/web/dashboard.php");

}





// ders silme işlemleri
@$idno=$_GET["ders_sil"];
if (@$idno!="") {
    dersSil($db,$idno);
}
//konu silme işlemleri
@$konuid=$_GET["konu_sil"];
if ($konuid!="") {
    konuSil($db,$konuid);
}


@$islem=$_GET["adminislem"];


switch (@$islem) {

case 'ders_kayit':

            $sinif= htmlspecialchars($_POST["ders_sinif"]);
            $dersadi= htmlspecialchars($_POST["dersadi"]);

            if ( $sinif!="" && $sinif!="Seçiniz..." && $dersadi!="") {
                dersKaydet($db,$sinif,$dersadi);
            }  
        


      break;

 case 'selectders':
            $sinif=htmlspecialchars($_POST["sinifId"]);
            if ($sinif!="") {
             dersSelect($db,$sinif);
            }
      break;

 case 'konu_kayit':
          
                  $sinif= htmlspecialchars($_POST["konu_sinif"]);
                  $dersadi= htmlspecialchars($_POST["konu_dersadi"]);
                  $konuadi= htmlspecialchars($_POST["konuadi"]);

                  if ( $sinif!="" && $sinif!="Seçiniz..." && $dersadi!="" && $konuadi!="") {
                      konuKaydet($db,$sinif,$dersadi,$konuadi);
                  } 
  break;

  case 'ders_yenile':
    dersListele($db);
    break;

   case 'konu_yenile':
    konuListele($db);
    break;

}
  ?>