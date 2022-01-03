

<?php

 require (__DIR__."\dbconnect.php");

if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 


// Ders için son giriş tarihi al
function sonGirisDers($db){
          $usermail=$_SESSION["mail"];

          $sor=$db->prepare("SELECT * FROM ders_calisma where mail='$usermail' AND id=(SELECT MAX(id) FROM ders_calisma) ") or die("HATA");
          $sor->execute();
                // VERİ VAR İSE
                if ($sor->rowCount()!=0) {
                  while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                      $veritabani=$data["tarih"];
                    
                  }
                  return $veritabani;
                }
}

//***************************************************** ÖĞRENCİ BİLGİ İŞLEMLERİ***********************************************

// Paragraf-Problem son giriş tarihi al
function sonGirisProblem($db){
      $usermail=$_SESSION["mail"];

      $sor=$db->prepare("SELECT * FROM paragraf_problem where mail='$usermail' AND id=(SELECT MAX(id) FROM paragraf_problem) ") or die("HATA");
      $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  $veritabani=$data["tarih"];
                
              }
              return $veritabani;
            }
}

// Serbest okuma son giriş tarihi al
function sonGirisKitapOkuma($db){
        $usermail=$_SESSION["mail"];

        $sor=$db->prepare("SELECT * FROM serbest_okuma where mail='$usermail' AND id=(SELECT MAX(id) FROM serbest_okuma) ") or die("HATA");
        $sor->execute();
              // VERİ VAR İSE
              if ($sor->rowCount()!=0) {
                while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                    $veritabani=$data["okunan_tarih"];
                  
                }
                return $veritabani;
              }
}
// Ders Çalışma Saatini Kaydetme fonksiyonu
function dersCalismaKayit($db,$mail,$sure){
      $ekle=$db->prepare("INSERT INTO ders_calisma (mail,sure) VALUES(:V_mail,:V_sure)");
      $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
      $ekle->bindparam(':V_sure',$sure,PDO::PARAM_INT);
      $ekle->execute();


      $db=null;
      header("refresh:0.1, url=/web/dashboard.php");
}

// problem-paragraf Kaydetme fonksiyonu
function problemKayit($db,$mail,$sec,$sayi,$sure){
      $ekle=$db->prepare("INSERT INTO paragraf_problem (mail,cozulen,soru,sure) VALUES(:V_mail,:V_sec,:V_sayi,:V_sure)");
      $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
      $ekle->bindparam(':V_sec',$sec,PDO::PARAM_STR);
      $ekle->bindparam(':V_sayi',$sayi,PDO::PARAM_INT);
      $ekle->bindparam(':V_sure',$sure,PDO::PARAM_INT);
      $ekle->execute();


      $db=null;
      header("refresh:0.1, url=/web/dashboard.php");
}

// Serbest Okuma Kaydetme fonksiyonu
function serbestOkumaKayit($db,$mail,$kitap,$sayfa,$sure){
      $ekle=$db->prepare("INSERT INTO serbest_okuma (mail,okunan_kitap,okunan_sayfa,okunan_sure) VALUES(:V_mail,:V_kitap,:V_sayfa,:V_sure)");
      $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
      $ekle->bindparam(':V_kitap',$kitap,PDO::PARAM_STR);
      $ekle->bindparam(':V_sayfa',$sayfa,PDO::PARAM_INT);
      $ekle->bindparam(':V_sure',$sure,PDO::PARAM_INT);
      $ekle->execute();


      $db=null;
      header("refresh:0.1, url=/web/dashboard.php");
}

//Kategorik Soru Çözme Kayıt İşlemi
function sorucozmeKayit($db,$mail,$ders,$konu,$sayi){
      $ekle=$db->prepare("INSERT INTO kategorik_sorucozme (mail,ders,konu,soru_sayisi) VALUES(:V_mail,:V_ders,:V_konu,:V_sayi)");
      $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
      $ekle->bindparam(':V_ders',$ders,PDO::PARAM_STR);
      $ekle->bindparam(':V_konu',$konu,PDO::PARAM_STR);
      $ekle->bindparam(':V_sayi',$sayi,PDO::PARAM_INT);
      $ekle->execute();


      $db=null;
      header("refresh:0.1, url=/web/dashboard.php");

}

//Serbest okuma ekranı okuma kitap listesi çıkar
function okumaKitapListesi($db){
            $usermail=$_SESSION["mail"];
            

            $sor=$db->prepare("SELECT * FROM kaynaklar where mail='$usermail' AND kaynak_turu='Okuma Kitabı' ") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option>'.$data["kaynak_adi"].'</option>' ;
              }

             
            }

}


// Kategorik Soru Çözme Selectbox için Ders Listeleme
function dersListele($db,$sinif){
          $sor=$db->prepare("SELECT * FROM dersler where sinif='$sinif' ORDER BY id") or die("HATA");
          $sor->execute();
          // VERİ VAR İSE
          if ($sor->rowCount()!=0) {
            while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                echo '<option>'.$data["ders"].'</option>';
                  }
                }

           
}
// Kategorik Soru Çözme seçilen DERSE göre KONU Listeleme
function konuSelect($db,$sinif,$ders){
          $dizi=array();
          $bul=$db->prepare("SELECT * FROM konular where sinif='$sinif' AND ders='$ders' ") or die("HATA");
          $bul->execute();
          //VERİ VAR İSE
          if ($bul->rowCount()!=0) {
            while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
              $dizi[]=$data["konu"];
            }
               $dizi=json_encode($dizi,JSON_FORCE_OBJECT, JSON_UNESCAPED_UNICODE);
               echo $dizi;
          }

}


// Ayarlar öğrenci İsim-Soyisim Güncelle
function studentNameUpdate($db,$isim,$soyisim){


            $kimlik=$_SESSION["mail"]; 
        
            $sorgu=$db->prepare("UPDATE student set isim=?,soyisim=? where ogrenci_mail='$kimlik' ");
            $sorgu->bindParam(1,$isim,PDO::PARAM_STR);
            $sorgu->bindParam(2,$soyisim,PDO::PARAM_STR);

            $sorgu->execute();
            
            // Kullanıcı Bilgisi değiştiğinden SESSION larda değişti
            $_SESSION["isim"]=$isim;
            $_SESSION["soyisim"]=$soyisim;

            header("refresh:0.1; url=/web/dashboard.php");
            die();


}

// Ayarlar öğrenci Telefon Güncelle
function studentPhoneUpdate($db,$telefon){


            $kimlik=$_SESSION["mail"]; 
        
            $sorgu=$db->prepare("UPDATE student set ogrenci_cepno=? where ogrenci_mail='$kimlik' ");
            $sorgu->bindParam(1,$telefon,PDO::PARAM_STR);

            $sorgu->execute();
            
            // Kullanıcı Bilgisi değiştiğinden SESSION değişti
            $_SESSION["cepno"]=$telefon;

            header("refresh:0.1; url=/web/dashboard.php");
            die();

        

}


// Ayarlar öğrenci E-posta Güncelle
function studentMailUpdate($db,$eposta){


            $kimlik=$_SESSION["mail"]; 
        
            $sorgu=$db->prepare("UPDATE student set ogrenci_mail=? where ogrenci_mail='$kimlik' ");
            $sorgu->bindParam(1,$eposta,PDO::PARAM_STR);

            $sorgu->execute();
            
            // Kullanıcı e-postası değiştiğinden SESSION lar temizlendi ve logine gönderildi
            session_destroy();

            header("refresh:0.1; url=/web/sign-in.php");
            die();

        

}

// Ayarlar öğrenci Sınıf Güncelle
function studentClassUpdate($db,$sinif){


            $kimlik=$_SESSION["mail"]; 
        
            $sorgu=$db->prepare("UPDATE student set sinif=? where ogrenci_mail='$kimlik' ");
            $sorgu->bindParam(1,$sinif,PDO::PARAM_STR);

            $sorgu->execute();
            
            // Kullanıcı Sınıfı değiştiğinden SESSION değişti
            $_SESSION["sinif"]=$sinif;

            header("refresh:0.1; url=/web/dashboard.php");
            die();

        

}

// Ayarlar öğrenci Şifre Güncelle
function studentPasswordUpdate($db,$eskisifre,$sifre){


            $kimlik=$_SESSION["mail"]; 

            $sor=$db->prepare("SELECT * FROM student where ogrenci_mail='$kimlik' ") or die("HATA");
            $sor->execute();
            if ($sor->rowCount()!=0) {
                  while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
                    $db_ogrenci_sifre=$data["ogrenci_sifre"];
                    
                  }
                  $eskisifre=sha1(md5(md5($eskisifre)));
                  if ($db_ogrenci_sifre == $eskisifre) {
                        $sorgu=$db->prepare("UPDATE student set ogrenci_sifre=? where ogrenci_mail='$kimlik' ");

                        $sifre=sha1(md5(md5($sifre)));
                        $sorgu->bindParam(1,$sifre,PDO::PARAM_STR);

                        $sorgu->execute();
                        
                        // Kullanıcı Şifresi değiştiğinden SESSION lar temizlendi ve logine gönderildi
                        session_destroy();

                        header("refresh:0.1; url=/web/sign-in.php");
                        die();
                  }
                 else{
                    echo "<div class='alert alert-danger' role='alert'>Şifrenizi hatalı girdiniz. Oturum Otomatik olarak kapatıldı! Tekrar Giriş Ypaınız.</div>";
                    session_destroy();
                    header("refresh:3; url=/web/sign-in.php");

                  }

                }

            else{

              echo "<div class='alert alert-danger' role='alert'>Şifrenizi hatalı girdiniz. Oturum Otomatik olarak kapatıldı! Tekrar Giriş Ypaınız.</div>";
              session_destroy();
              header("refresh:3; url=/web/sign-in.php");
            }

       

        

}


//***************************************************** ADMİN BİLGİ İŞLEMLERİ***********************************************




// ADMİN Kullanıcı Listesi
function selectKullanici($db,$tip){

  $dizi=[];

  if ($tip=="Veli") {

   
      $bul=$db->prepare("SELECT * FROM student ORDER BY veli_mail DESC") or die("HATA");
      $bul->execute();
          //VERİ VAR İSE
          if ($bul->rowCount()!=0) {
            while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
              if (in_array($data["veli_mail"],$dizi)) {
                
              }
              else{
                $dizi[]=$data["veli_mail"];
              }
              
            }
               $dizi=json_encode($dizi,JSON_FORCE_OBJECT, JSON_UNESCAPED_UNICODE);
               echo $dizi;
          }
    
  }
  else{

      
      $bul=$db->prepare("SELECT * FROM student ORDER BY ogrenci_mail DESC") or die("HATA");
      $bul->execute();
          //VERİ VAR İSE
          if ($bul->rowCount()!=0) {
            while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
              $dizi[]=$data["ogrenci_mail"];
            }
               $dizi=json_encode($dizi,JSON_FORCE_OBJECT, JSON_UNESCAPED_UNICODE);
               echo $dizi;
          }

  }

}





// ADMİN Kullanıcı Şifre değiştir
function kullaniciSifredegistir($db,$tip,$kisi,$sifre){

    if ($tip=="Veli") {
          if ($kisi!="" && $sifre!="") {
               $sifre=sha1(md5(md5($sifre)));
            
                $sorgu=$db->prepare("UPDATE student set veli_sifre=? where veli_mail='$kisi' ");
                $sorgu->bindParam(1,$sifre,PDO::PARAM_STR);

                $sorgu->execute();
                header("refresh:0.1; url=/web/dashboard.php");
                die();
        }
    }
    else{
      if ($kisi!="" && $sifre!="") {
               $sifre=sha1(md5(md5($sifre)));
            
                $sorgu=$db->prepare("UPDATE student set ogrenci_sifre=? where ogrenci_mail='$kisi' ");
                $sorgu->bindParam(1,$sifre,PDO::PARAM_STR);

                $sorgu->execute();
                header("refresh:0.1; url=/web/dashboard.php");
                die();
        }

    }
    

}

// ADMİN Öğrenci kayıt durumu öğren
function kayitDurum($db,$kim){

        $ogren=$db->prepare("SELECT * FROM student where ogrenci_mail='$kim' ") or die("HATA");
        $ogren->execute();
            //VERİ VAR İSE
            if ($ogren->rowCount()!=0) {
              while ($data=$ogren->fetch(PDO::FETCH_ASSOC)) {
                echo $data["uyelik_durum"];
              }
                 
            }

}

// ADMİN Kayit durum değiştir
function kayitdurumGuncelle($db,$kim,$durum){

            $yap=$db->prepare("UPDATE student set uyelik_durum=? where ogrenci_mail='$kim' ");
            $yap->bindParam(1,$durum,PDO::PARAM_INT);

            $yap->execute();
            header("refresh:0.1; url=/web/dashboard.php");
            die();

}







@$islem=$_GET["islem"];


switch ($islem) {
  

    case 'selectKisiler':
      envanterKisi($db);
        
    break;

    case 'selectkullanici':
      $tip=htmlspecialchars($_POST["kul"]);
      selectKullanici($db,$tip);
      break;

    case 'ogrencilist':
      $tip="Öğrenci";
      selectKullanici($db,$tip);
      break;

    case 'ogrencidurum':
      $kim=htmlspecialchars($_POST["ogrenci"]);
      kayitDurum($db,$kim);
      break;

    case 'ogrenci_kayitdurum':
      $kim=htmlspecialchars($_POST["ogrenci"]);
      $durum=htmlspecialchars($_POST["kayitdurum"]);
      kayitdurumGuncelle($db,$kim,$durum);
      
      break;

    case 'selectkonu':
        $ders=htmlspecialchars($_POST["ders"]);
        $sinif=$_SESSION["sinif"];
        konuSelect($db,$sinif,$ders);
      break;

  	case 'oturum_kapat':
  		          session_destroy();			
  		break;

    case 'login_type':
                echo $_SESSION["tip"];
      break;


    case 'user_value':
            if ($_SESSION["tip"]=="Veli") {
              $veli_veri = array(
                                'name' => $_SESSION["isim"],
                                'surname' => $_SESSION["soyisim"],
                                'mail' => $_SESSION["mail"],
                                'phone' => $_SESSION["cepno"],
                                'student_mail' => $_SESSION["veli_ogrenci_mail"],
                                 );

              $json_veli=json_encode($veli_veri);
              echo $json_veli;
                        
            }
            else if ($_SESSION["tip"]=="Admin") {
              $admin_veri = array(
                                'name' => $_SESSION["isim"],
                                'surname' => $_SESSION["soyisim"],
                                'mail' => $_SESSION["mail"],
                                'phone' => $_SESSION["cepno"],
                                 );

              $json_admin=json_encode($admin_veri);
              echo $json_admin;
                        
            }

            else{
              $ogrenci_veri= array(
                                'name' =>$_SESSION["isim"], 
                                'surname' =>$_SESSION["soyisim"],
                                'mail' =>$_SESSION["mail"],
                                'class' =>$_SESSION["sinif"],
                                'uid' =>$_SESSION["tcno"],
                                'phone' =>$_SESSION["cepno"],
                              );

              $json_ogrenci=json_encode($ogrenci_veri);           
              echo $json_ogrenci;
                    

            }
      break;




   

    case 'okuma_kayit':
      @$buton=$_POST["kayit"];

      if (@$buton) {

        $G_mail=$_SESSION["mail"];
        $G_kitap=$_POST["okunan_kitap"];
        $G_sayfa=$_POST["sayfa_sayisi"];
        $G_sure=$_POST["okuma_sure"];
        serbestOkumaKayit($db,$G_mail,$G_kitap,$G_sayfa,$G_sure);
      }

      break;

    case 'problem_kayit':
      @$buton=$_POST["kayit"];

      if (@$buton) {

        $G_mail=$_SESSION["mail"];
        $G_sec=$_POST["cozulen"];
        $G_sayi=$_POST["soru_sayisi"];
        $G_sure=$_POST["cozme_suresi"];
        problemKayit($db,$G_mail,$G_sec,$G_sayi,$G_sure);
      }

      break;

    case 'derscalisma_kayit':
      @$buton=$_POST["kayit"];

        if (@$buton) {

          $G_mail=$_SESSION["mail"];
          $G_sure=$_POST["calisma_sure"];
          dersCalismaKayit($db,$G_mail,$G_sure);
        }
      
      break;

    case 'sorucozme_kayit':
        @$buton=$_POST["kayit"];

        if (@$buton) {

          $mail=$_SESSION["mail"];
          $ders=$_POST["ders"];
          $konu=$_POST["konu"];
          $sayi=$_POST["soru_sayisi"];
          sorucozmeKayit($db,$mail,$ders,$konu,$sayi);
        }
      

      break;








	
	
}



?>