
<?php

include("php/dbconnect.php"); 




function random_pasword($length = 8){
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;

}



function kayit($db){

			@$buton=$_POST["kaydol"];


			if (@$buton) {
				$og_adi= htmlspecialchars($_POST["student_adi"]);
				$og_soyadi= htmlspecialchars($_POST["student_soyadi"]);
				$og_tc= htmlspecialchars($_POST["student_tc"]);
				$og_dogum= htmlspecialchars($_POST["student_dogum"]);
				$og_mail= htmlspecialchars($_POST["student_mail"]);
				$og_sinif= htmlspecialchars($_POST["student_sinif"]);
				$og_cep= htmlspecialchars($_POST["student_cep"]);
				$v_adi= htmlspecialchars($_POST["parent_adi"]);
				$v_soyadi= htmlspecialchars($_POST["parent_soyadi"]);
				$v_cep= htmlspecialchars($_POST["parent_cep"]);
				$v_mail= htmlspecialchars($_POST["parent_mail"]);

				$sifre= trim(htmlspecialchars($_POST["password"]));
				$sifre_tekrar= trim(htmlspecialchars($_POST["confirm_password"]));
				$danisman_kod= htmlspecialchars($_POST["pdr_kod"]);

				if (empty($og_adi) || empty($og_soyadi) ||  empty($og_tc) || empty($og_tc) || empty($og_dogum) || empty($og_mail) || empty($og_sinif) || 
					empty($og_cep) || empty($v_adi) || empty($v_soyadi) || empty($v_cep) || empty($v_mail) ) {
							
								echo '
										     <div class="toast bg-danger d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">

										        <div class="row bg-danger p-2" >
										            <div class="text-white" ><i class="fas fa-exclamation-triangle text-white" style="font-size:25px;"></i> &nbsp;</div>
										            <div class="text-white font-weight-normal" >   KAYIT BAŞARISIZ! </div>
										        </div>
										    </div>
											
											<script>
											$(document).ready(function(){
											        $("#myToast").toast({ delay: 3000 });
											        $("#myToast").toast("show");
											    }); 
											
											</script>
										';
						
							header("refresh:3; url=/web/register.php");
							die();
							
							
				}

				else{
					$bul=$db->prepare("SELECT * FROM kod_havuzu where kod='$danisman_kod'") or die("HATA");
					$bul->execute();
					//VERİ VAR İSE
					if ($bul->rowCount()!=0) {
						$kullanim;
					while ($data=$bul->fetch(PDO::FETCH_ASSOC)) {
							
						$kullanim=$data["kullanim"];
					}
					 
					}
					//VERİ YOK İSE
					else{
						$kullanim="";
					}
					

					if ($kullanim == "0" && $kullanim!="") {
						
							if ($og_mail!="" && $og_tc!="") {
									
									$kontrol=$db->prepare("SELECT * FROM student where ogrenci_mail='$og_mail' ") or die("HATA");
									$kontrol->execute();

									if ($kontrol->rowCount()==0) {

										try {

												$ekle=$db->prepare("INSERT INTO student (isim,soyisim,tcno,d_tarihi,ogrenci_mail,sinif,ogrenci_cepno,veli_isim,veli_soyisim,veli_cepno,veli_mail,veli_sifre,ogrenci_sifre,danisman_kod,uyelik_durum) VALUES(:V_student_name,:V_student_surname,:V_student_ID,:V_student_born,:V_student_mail,:V_student_class,:V_student_phone,:V_parent_name,:V_parent_surname,:V_parent_phone,:V_parent_mail,:V_parent_password,:V_student_password,:V_code,:V_abone)");

									// Veli mail kontrol işlemi yapılıyor.NOT: Birden fazla öğrencisi durumunda şifresi her öğrenci için farklı olmasın
												$Veliparola=$db->prepare("SELECT * FROM student where veli_mail='$v_mail'  ") or die("HATA");
												$Veliparola->execute();
												if ($Veliparola->rowCount()!=0) {
													while ($data=$Veliparola->fetch(PDO::FETCH_ASSOC)) {
																	
																$mevcut_veli_parola=$data["veli_sifre"];
															}
													$veli_password=$mevcut_veli_parola;
												}
									// Veli kayıtlı değilse parolasını rastgele oluşturduk

												else{
													$veli_password=random_pasword(); 
												}
												
												$durum=1;

												$ekle->bindparam(':V_student_name',$og_adi,PDO::PARAM_STR);
												$ekle->bindparam(':V_student_surname',$og_soyadi,PDO::PARAM_STR);
												$ekle->bindparam(':V_student_ID',$og_tc,PDO::PARAM_STR);
												$ekle->bindparam(':V_student_born',$og_dogum,PDO::PARAM_STR);
												$ekle->bindparam(':V_student_mail',$og_mail,PDO::PARAM_STR);
												$ekle->bindparam(':V_student_class',$og_sinif,PDO::PARAM_STR);
												$ekle->bindparam(':V_student_phone',$og_cep,PDO::PARAM_STR);
												$ekle->bindparam(':V_parent_name',$v_adi,PDO::PARAM_STR);
												$ekle->bindparam(':V_parent_surname',$v_soyadi,PDO::PARAM_STR);
												$ekle->bindparam(':V_parent_phone',$v_cep,PDO::PARAM_STR);
												$ekle->bindparam(':V_parent_mail',$v_mail,PDO::PARAM_STR);
												$ekle->bindparam(':V_parent_password',$veli_password,PDO::PARAM_STR); // veli paswordu şifrelenmedi
												$sifre=sha1(md5(md5($sifre)));
												$ekle->bindparam(':V_student_password',$sifre,PDO::PARAM_STR);
												$ekle->bindparam(':V_code',$danisman_kod,PDO::PARAM_STR);
												$ekle->bindparam(':V_abone',$durum,PDO::PARAM_INT);

												$ekle->execute();

												// Danışman Kodu Kullanıldığı için 1 yap
												$deger=1;
												$guncelle=$db->prepare("UPDATE kod_havuzu set kullanim=? where kod='$danisman_kod' ");
												$guncelle->bindParam(1,$deger,PDO::PARAM_INT);
												$guncelle->execute();
												
												echo '
													     <div class="toast bg-success d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0; ">
													        <div class="row bg-success p-2" >
													            <div class="text-white" ><i class="fas fa-check text-white" style="font-size:25px;"></i> &nbsp;</div>
													            <div class="text-white font-weight-normal" >   KAYIT BAŞARILI ! </div>
													        </div>
													    </div>
													
														<script>
														$(document).ready(function(){
													        $("#myToast").toast({ delay: 3000 });
													        $("#myToast").toast("show");
													    }); 
													
														</script>
												';
											
										} catch (Exception $s) {
											

											die($s->getMessage());
										}


										

									}
									else{


										echo '


												<div class="toast bg-warning d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">
											        <div class="row bg-warning p-2" >
											            <div class="text-white" ><i class="fas fa-exclamation text-white" style="font-size:25px;"></i> &nbsp;</div>
											            <div class="text-white font-weight-normal" > İŞLEM BAŞARISIZ. KAYITLI MAİL ADRESİ! </div>
											        </div>
											    </div>

											    <script>
												$(document).ready(function(){
											        $("#myToast").toast({ delay: 3000 });
											        $("#myToast").toast("show");
											    }); 
											
												</script>


										';
									}

							}

							else{
								echo '


												<div class="toast bg-warning d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">
											        <div class="row bg-warning p-2" >
											            <div class="text-white" ><i class="fas fa-exclamation text-white" style="font-size:25px;"></i> &nbsp;</div>
											            <div class="text-white font-weight-normal" > SİSTEM HATASI.DAHA SONRA TEKRAR DENEYİN! </div>
											        </div>
											    </div>

											    <script>
												$(document).ready(function(){
											        $("#myToast").toast({ delay: 3000 });
											        $("#myToast").toast("show");
											    }); 
											
												</script>


										';
							}
						
					}
					else{

						echo '


												<div class="toast bg-warning d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">
											        <div class="row bg-warning p-2" >
											            <div class="text-white" ><i class="fas fa-exclamation text-white" style="font-size:25px;"></i> &nbsp;</div>
											            <div class="text-white font-weight-normal" > İŞLEM BAŞARISIZ. HATALI DANIŞMAN KODU! </div>
											        </div>
											    </div>

											    <script>
												$(document).ready(function(){
											        $("#myToast").toast({ delay: 4000 });
											        $("#myToast").toast("show");
											    }); 
											
												</script>


										';

					}



					



				}

				
				
			}
			else{
				echo "butona basılmadı";
			}









}









?>


