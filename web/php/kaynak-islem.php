<?php

 require (__DIR__."\dbconnect.php");

if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 



//Öğrenci Kaynakları ekleme
  function kaynakEkle($db,$mail,$yayinci,$kaynakturu,$kaynakadi,$sayfasayisi){

		  $ekle=$db->prepare("INSERT INTO kaynaklar (mail,yayinevi,kaynak_turu,kaynak_adi,sayfa_sayisi) VALUES(:V_mail,:V_yayinevi,:V_kaynak_turu,:V_kaynak_adi,:V_sayfa_sayisi)");
		  $ekle->bindparam(':V_mail',$mail,PDO::PARAM_STR);
		  $ekle->bindparam(':V_yayinevi',$yayinci,PDO::PARAM_STR);
		  $ekle->bindparam(':V_kaynak_turu',$kaynakturu,PDO::PARAM_STR);
		  $ekle->bindparam(':V_kaynak_adi',$kaynakadi,PDO::PARAM_STR);
		  $ekle->bindparam(':V_sayfa_sayisi',$sayfasayisi,PDO::PARAM_INT);
		  $ekle->execute();


		  $db=null;

}

//Öğrenci Kaynakları Listeleme
function kaynakListele($db){
			$usermail=$_SESSION["mail"];
            $messageCount=0;
            
            $sor=$db->prepare("SELECT * FROM kaynaklar where mail='$usermail' ") or die("HATA");
            $sor->execute();
            // VERİ VAR İSE
            if ($sor->rowCount()!=0) {
              while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
              	echo'
              		<tr>
				      <th scope="row" id="satir">'.$data["id"].'</th>
				      <td>'.$data["yayinevi"].'</td>
				      <td>'.$data["kaynak_turu"].'</td>
				      <td>'.$data["kaynak_adi"].'</td>
				      <td>'.$data["sayfa_sayisi"].'</td>
				      <td> <a class="btn btn-sm btn-outline-danger ml-2" href="php/kaynak-islem.php?secilen='.$data["id"].'" value="ok" id="butt" role="button">Sil</a></td>
				    </tr>';

              }

          	}


}
//Öğrenci Kaynak sil
function kaynakSil($db,$idno){
	
	$sil=$db->prepare("DELETE FROM kaynaklar where id='$idno' ");
	$sil->execute();
	header("refresh:0.1, url=/web/dashboard.php");


}

@$idno=$_GET["secilen"];
@$buton=$_GET["butt"];
if (@$idno!="") {
	
	kaynakSil($db,$idno);
	}



@$islem=$_GET["islem"];


switch ($islem) {



 case 'kaynakekle':
          $mail= htmlspecialchars($_SESSION["mail"]); // gönderen kişi bilgisi mailden çekildi
          $yayinci= htmlspecialchars($_POST["yayinevi_adi"]);
          $kaynakturu= htmlspecialchars($_POST["kaynak_turu"]);
          $kaynakadi= htmlspecialchars($_POST["kitap_adi"]);
          $sayfasayisi= htmlspecialchars($_POST["sayfa_sayisi"]);

          
         kaynakEkle($db,$mail,$yayinci,$kaynakturu,$kaynakadi,$sayfasayisi);
      break;
 case 'yenile':
 		kaynakListele($db);
 	break;
 
 		
 	
 
}
?>