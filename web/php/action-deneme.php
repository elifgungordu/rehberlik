

<?php

 require (__DIR__."\dbconnect.php");

if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

// Toplam neti kaydetme işlemi
function toplamNet($db,$mail,$denemeadi,$netsayisi){
    $ekle=$db->prepare("INSERT INTO deneme_toplam (mail,deneme_adi,toplam_net) VALUES(:V_mail,:V_deneme,:V_net)");
    $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
    $ekle->bindparam(':V_deneme',$denemeadi,PDO::PARAM_STR);
    $ekle->bindparam(':V_net',$netsayisi,PDO::PARAM_STR);
    $ekle->execute();


    $db=null;
}

// Detaylı deneme kaydetme işlemi
function denemeKayit($db,$mail,$denemeadi,$dersadi,$soru,$dogru,$yanlis,$bos,$net){
    $ekle=$db->prepare("INSERT INTO deneme_analiz (mail,deneme_adi,ders_adi,toplam_soru,dogru,yanlis,bos,net) VALUES(:V_mail,:V_deneme,:V_dersadi,:V_soru,:V_dogru,:V_yanlis,:V_bos,:V_net)");
    $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
    $ekle->bindparam(':V_deneme',$denemeadi,PDO::PARAM_STR);
    $ekle->bindparam(':V_dersadi',$dersadi,PDO::PARAM_STR);


    $ekle->bindparam(':V_soru',$soru,PDO::PARAM_INT);
    $ekle->bindparam(':V_dogru',$dogru,PDO::PARAM_INT);
    $ekle->bindparam(':V_yanlis',$yanlis,PDO::PARAM_INT);
    $ekle->bindparam(':V_bos',$bos,PDO::PARAM_INT);
    $ekle->bindparam(':V_net',$net,PDO::PARAM_STR);
    $ekle->execute();


    $db=null;
}



@$islem=$_GET["islem"];


switch ($islem) {

  case 'sinifsor':
    echo $_SESSION["sinif"];
  break;  

  case 'totalKayit':
    $usermail=$_SESSION["mail"];
    $deneme=htmlspecialchars($_POST["denemeadi"]);
    $net=htmlspecialchars($_POST["toplamNet"]);
    toplamNet($db,$usermail,$deneme,$net);


  break;

  case 'analizKayit':
    $usermail=$_SESSION["mail"];
    $deneme=htmlspecialchars($_POST["denemeadi"]);
    $ders=htmlspecialchars($_POST["ders"]);
    $dogru=htmlspecialchars($_POST["dogru"]);
    $yanlis=htmlspecialchars($_POST["yanlis"]);
    $bos=htmlspecialchars($_POST["bos"]);
    $net=htmlspecialchars($_POST["net"]);

    $toplamSoru=$dogru+$yanlis+$bos;
    denemeKayit($db,$usermail,$deneme,$ders,$toplamSoru,$dogru,$yanlis,$bos,$net);


  break;






	
	
}



?>