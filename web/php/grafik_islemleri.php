<?php

require (__DIR__."\dbconnect.php");

date_default_timezone_set('Europe/Istanbul');

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
// ***********************************************Grfik için json veri gönderiyoruz******************************************

// Deneme Net Sayısı bilgisini grafik için gönderiyoruz
function deneme($db){
    $usermail=$_SESSION["mail"];
    
    $bul=$db->prepare("SELECT * FROM deneme_toplam where mail='$usermail' ORDER BY tarih DESC") or die("HATA");
    $bul->execute();
    //VERİ VAR İSE
    if ($bul->rowCount()!=0) {
      $j=1;
      while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {

        $dizi[$j]=array("Deneme"=> $data["deneme_adi"], "Net"=>$data["toplam_net"]);
        $j++;
      }
         $dizi=json_encode($dizi,JSON_UNESCAPED_UNICODE);
         echo $dizi;
    }

}

// Serbest Kitap okuma sayfa sayısı bilgisini grafik için gönderiyoruz
function kitapOkuma($db){
    $usermail=$_SESSION["mail"];
    
    $bul=$db->prepare("SELECT * FROM serbest_okuma where mail='$usermail' ORDER BY okunan_tarih DESC") or die("HATA");
    $bul->execute();
    //VERİ VAR İSE
    if ($bul->rowCount()!=0) {
      $j=1;
      while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {

        $dizi[$j]=array("Tarih"=>explode(" ", $data["okunan_tarih"]), "Sayi"=>$data["okunan_sayfa"]);
        $j++;
      }
         $dizi=json_encode($dizi,JSON_UNESCAPED_UNICODE);
         echo $dizi;
    }

}


//Ders Çalışma Saat bilgisini grafik için gönderiyoruz
function dersCalisma($db){
  $usermail=$_SESSION["mail"];

  $bul=$db->prepare("SELECT * FROM ders_calisma where mail='$usermail' ORDER BY tarih DESC") or die("HATA");
    $bul->execute();
    //VERİ VAR İSE
    if ($bul->rowCount()!=0) {
      $j=1;
      while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {

        $dizi[$j]=array("Tarih"=>explode(" ", $data["tarih"]), "Sure"=>$data["sure"]);
        $j++;
      }
         $dizi=json_encode($dizi,JSON_UNESCAPED_UNICODE);
         echo $dizi;
    }
}

// Paragraf veya Problem Çözme Sayi bilgisini grafik için gönderiyoruz
function paragrafproblemCozme($db,$cozulen){
  $usermail=$_SESSION["mail"];

  $bul=$db->prepare("SELECT * FROM paragraf_problem where mail='$usermail' AND cozulen='$cozulen' ORDER BY tarih DESC") or die("HATA");
    $bul->execute();
    //VERİ VAR İSE
    if ($bul->rowCount()!=0) {
      $j=1;
      while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {

        $dizi[$j]=array("Tarih"=>explode(" ", $data["tarih"]), "Sayi"=>$data["soru"]);
        $j++;
      }
         $dizi=json_encode($dizi,JSON_UNESCAPED_UNICODE);
         echo $dizi;
    }
}

//****************************************************************************************************************************
//Kategorik Soru Çözme Sayılarına grafik için gönderiyoruz
function sorucozmesayisi($db){
    $usermail=$_SESSION["mail"];
    $bul=$db->prepare("SELECT * FROM kategorik_sorucozme where mail='$usermail' ") or die("HATA");
    $bul->execute();
    //VERİ VAR İSE
    if ($bul->rowCount()!=0) {
      $i=1;
      while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
        $dizi[$i]=array("Ders"=>$data["ders"],"Sayi"=>$data["soru_sayisi"]);

        $i++;
      }
         $dizi=json_encode($dizi,JSON_UNESCAPED_UNICODE);
         echo $dizi;
    }

}
//Paragraf/Problem Çözme Sayılarına grafik için gönderiyoruz
function paragrafProblemSayisi($db){
    $usermail=$_SESSION["mail"];
    $bul=$db->prepare("SELECT * FROM paragraf_problem where mail='$usermail' ") or die("HATA");
    $bul->execute();
    //VERİ VAR İSE
    if ($bul->rowCount()!=0) {
      $toplamParagraf=0;
      $toplamProblem=0;
      while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
        if ($data["cozulen"]=="Paragraf") {
          $toplamParagraf+=$data["soru"];
        }
        else{
          $toplamProblem+=$data["soru"];
        }
      }

      $dizi=array("Paragraf"=>$toplamParagraf,"Problem"=>$toplamProblem);

      $dizi=json_encode($dizi,JSON_UNESCAPED_UNICODE);
      echo $dizi;
    }

}

@$istek=$_GET["data"];


switch (@$istek) {

case 'deneme':
  deneme($db);
  break;

case 'kitap_okuma':
  kitapOkuma($db);
  break;
case 'soru_cozme':
  sorucozmeSayisi($db);
  break;
case 'paragraf_problem':
  paragrafProblemSayisi($db);
  break;
case 'ders_calisma':
  dersCalisma($db);
  break;
case 'paragraf_cozme':
  paragrafproblemCozme($db,$cozulen="Paragraf");
  break;
case 'problem_cozme':
  paragrafproblemCozme($db,$cozulen="Problem");
  break;

}


?>

