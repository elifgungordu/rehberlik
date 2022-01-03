<?php

 require (__DIR__."\dbconnect.php");

if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

//total paragraf-problem sonucu
  function paragrafTotal($db){
      $usermail=$_SESSION["mail"];
      $toplam=0;

      $sor=$db->prepare("SELECT * FROM paragraf_problem where mail='$usermail' ") or die("HATA");
      $sor->execute();
              // VERİ VAR İSE
              if ($sor->rowCount()!=0) {
                while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                    $toplam+=$data["soru"];
                  
                }
                return $toplam;
              }

  }

  //total Ders Çalışma sonucu
  function derscalismaTotal($db){
      $usermail=$_SESSION["mail"];
      $saat=0;
      $sor=$db->prepare("SELECT * FROM ders_calisma where mail='$usermail' ") or die("HATA");
      $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  $saat+=$data["sure"];
                
              }
              $saat=$saat/60;
              $saat=number_format($saat, 2);
              return $saat;
            }

  }

 //total Serbest Kitap Okuma sonucu
  function okumaTotal($db){
      $usermail=$_SESSION["mail"];
      $saat=0;

      $sor=$db->prepare("SELECT * FROM serbest_okuma where mail='$usermail' ") or die("HATA");
      $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  $saat+=$data["okunan_sure"];
                
              }
              $saat=$saat/60;
              $saat=number_format($saat, 2);
              return $saat;
            }

  }

  //total Kategorik soru çözme toplam sonucu
  function kategorikSorucozmeTotal($db){
      $usermail=$_SESSION["mail"];
      $toplam=0;

      $sor=$db->prepare("SELECT * FROM kategorik_sorucozme where mail='$usermail' ") or die("HATA");
      $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  $toplam+=$data["soru_sayisi"];
                
              }
             
              return $toplam;
            }

  }

//Danışman tavsiyesi göster
  function tavsiyeGoster($db){
      $usermail=$_SESSION["mail"];
      $sor=$db->prepare("SELECT * FROM tavsiye where mail='$usermail' ") or die("HATA");
      $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  $dizi=array(
                                'id'=>$data["id"],
                                'tarih'=>$data["tarih"],
                                'icerik'=>$data["icerik"]

                  ); 
                  $dizi=json_encode($dizi,JSON_UNESCAPED_UNICODE);
                    echo $dizi;
                  }


            }

}
// Öğrenci ve Admin tarafından Tavsiye Sil
function tavsiyeSil($db,$id){

      $sil=$db->prepare("DELETE FROM tavsiye where id='$id' ");
      $sil->execute();
      header("refresh:0.1, url=/web/dashboard.php");
}

// Öğrenci ve admin tarafından Rapor Sil
function raporSil($db,$id){

      $sil=$db->prepare("DELETE FROM rapor where id='$id' ");
      $sil->execute();
      header("refresh:0.1, url=/web/dashboard.php");
}


// **********************************************ADMİN İŞLEMLERİ********************************************************************************************

// Random 6 haneli dizi oluştur
function random_pasword($length = 6){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

}

// Random DANIŞMAN KODU oluşturur
function kodOlustur($db){
       
        $kod=random_pasword();
        $sor=$db->prepare("SELECT * FROM kod_havuzu where kod='$kod' ") or die("HATA");
        $sor->execute();
                // VERİ VAR İSE tekrar kod oluştur
                if ($sor->rowCount()!=0) {
                    $kod=random_pasword();
                    $sor=$db->prepare("SELECT * FROM kod_havuzu where kod='$kod' ") or die("HATA");
                    $sor->execute();
                     if ($sor->rowCount()!=0) {} else{return $kod;}
                                
                  }
                  else{
                    return $kod;
                  }
                 
                

}
// Danışman Kodu kaydetme işlemi
function kodKaydet($db,$kodum){
      $use=0;
      $ekle=$db->prepare("INSERT INTO kod_havuzu (kod,kullanim) VALUES(:V_kod,:V_kullanim)");
      $ekle->bindparam(':V_kod',$kodum,PDO::PARAM_STR);
      $ekle->bindparam(':V_kullanim',$use,PDO::PARAM_INT);
      $ekle->execute();

      $db=null;
      header("refresh:0.1, url=/web/dashboard.php");
}

// Varolan DANIŞMAN KODLARINI LİSTELE
function kodListele($db){
            
            $sor=$db->prepare("SELECT * FROM kod_havuzu") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                echo'
                  <tr>
              <th scope="row" id="satir">'.$data["id"].'</th>
              <td>'.$data["kod"].'</td>
              <td>'.$data["kullanim"].'</td>
              <td>'.$data["tarih"].'</td>
            </tr>';

              }

            }


}

//Toplam Öğrenci Sayısı
function ogrenciTotal($db){

    $sor=$db->prepare("SELECT * FROM student ") or die("HATA");
    $sor->execute();
            // VERİ VAR İSE
             $toplam=$sor->rowCount();
            
             
              return $toplam;
}

// Admin Tavsiye için öğrencileri sırala 
function ogrenciListele($db){
            $sor=$db->prepare("SELECT * FROM student ") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option>'.$data["isim"]." ".$data["soyisim"]." / ".$data["ogrenci_mail"].'</option>' ;
              }         

              }
}

// Admin tavsiye kaydet
function tavsiyeKaydet($db,$mail,$icerik){


        $sil=$db->prepare("DELETE FROM tavsiye where mail='$mail' ");
        $sil->execute();


        $ekle=$db->prepare("INSERT INTO tavsiye (mail,icerik) VALUES(:V_mail,:V_icerik)");
        $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
        $ekle->bindparam(':V_icerik',$icerik,PDO::PARAM_STR);
        $ekle->execute();


        $db=null;
        header("refresh:0.1, url=/web/dashboard.php");

}

//Admin Tablo Tavsiye Listele
function tavsiyeListele($db){

            $sor=$db->prepare("SELECT * FROM tavsiye ORDER BY tarih") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo'
                  <tr>
                    <th scope="row" id="satir">'.$data["id"].'</th>
                    <td>'.$data["mail"].'</td>
                    <td>'.$data["icerik"].'</td>
                    <td>'.$data["tarih"].'</td>
                    <td> <a class="btn btn-sm btn-outline-danger ml-2" href="php/action-panel.php?tavsiye_sil='.$data["id"].'" value="ok" id="butt" role="button">Sil</a></td>
                  </tr>';
                    }

             
            }

}

// Admin Tavsiye için öğrencileri sırala 
function veliListele($db){
  $sor=$db->prepare("SELECT * FROM student ") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option>'.$data["veli_isim"]." ".$data["veli_soyisim"]." ( Öğrenci: ".$data["isim"]." ".$data["soyisim"].")"." / ".$data["veli_mail"].'</option>' ;
              }         

              }
}


// Admin tavsiye kaydet
function raporKaydet($db,$mail,$icerik){
        // Önce varsa eski rapor silinir
        $sil=$db->prepare("DELETE FROM rapor where mail='$mail' ");
        $sil->execute();


        $ekle=$db->prepare("INSERT INTO rapor (mail,icerik) VALUES(:V_mail,:V_icerik)");
        $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
        $ekle->bindparam(':V_icerik',$icerik,PDO::PARAM_STR);
        $ekle->execute();


        $db=null;
        header("refresh:0.1, url=/web/dashboard.php");

}

//Admin Tablo Rapor Listele
function raporListele($db){

            $sor=$db->prepare("SELECT * FROM rapor ORDER BY tarih") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo'
                  <tr>
                    <th scope="row" id="satir">'.$data["id"].'</th>
                    <td>'.$data["mail"].'</td>
                    <td>'.$data["icerik"].'</td>
                    <td>'.$data["tarih"].'</td>
                    <td> <a class="btn btn-sm btn-outline-danger ml-2" href="php/action-panel.php?rapor_sil='.$data["id"].'" value="ok" id="butt" role="button">Sil</a></td>
                  </tr>';
                    }

             
            }

}
//Admin Tablo Envanter Sonuç Listele
function envantersonucListele($db){

            $sor=$db->prepare("SELECT * FROM envanter_sonuc ORDER BY tarih") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo'
                  <tr>
                    <th scope="row" id="satir">'.$data["id"].'</th>
                    <td>'.$data["mail"].'</td>
                    <td>'.$data["envanter_adi"].'</td>
                    <td>'.$data["sonuc"].'</td>
                    <td>'.$data["tarih"].'</td>
                    <td> <a class="btn btn-sm btn-outline-danger ml-2" href="php/dash.php?envanter_sonuc_sil='.$data["id"].'" value="ok" id="butt" role="button">Sil</a></td>
                  </tr>';
                    }

             
            }

}





@$islem=$_GET["adminislem"];


switch (@$islem) {
  
    case 'tavsiye':
    @$but=$_POST["Dtavsiye"];

    if (@$but) {
            $mail= htmlspecialchars($_POST["ogrencimail"]);
            $mail=explode ("/",$mail);
            $mail=trim($mail[1]);

            $icerik= htmlspecialchars($_POST["Dtavsiye"]);

            if ( $mail!="" && $icerik!="") {
                tavsiyeKaydet($db,$mail,$icerik);
            }  
        }   
      break;

    case 'rapor':
    @$but=$_POST["Draporla"];

    if (@$but) {
            $mail= htmlspecialchars($_POST["velimail"]);
            $mail=explode ("/",$mail);
            $mail=trim($mail[1]);

            $icerik= htmlspecialchars($_POST["Drapor"]);

            if ( $mail!="" && $icerik!="") {
                raporKaydet($db,$mail,$icerik);
            }  
        }   
      break;

    case 'kodkaydet':
      @$but=$_POST["kodkayit"];

    if (@$but) {
            $kodum= htmlspecialchars($_POST["Dkod"]);

            if ( $kodum!="") {
                kodKaydet($db,$kodum);
           
            }  
        } 
      break;

    



    }





// **********************************************ÖĞRENCİ OLAY ve İSTEKLERİ********************************************************************************************

// Tavsiye silme işlemi
@$idno=$_GET["tavsiye_sil"];
if (@$idno!="") {
    tavsiyeSil($db,$idno);
}
// Rapor silme işlemi
@$idno=$_GET["rapor_sil"];
if (@$idno!="") {
    raporSil($db,$idno);
}

@$olay=$_GET["olay"];


switch (@$olay) {

case 'tavsiye_icerik':
  tavsiyeGoster($db);
  break;


}

  ?>