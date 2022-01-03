<?php 

include("php/dbconnect.php"); 

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 






function oturum($db){

				@$login_buton=$_POST["giris"];

				if (@$login_buton) {
						$user_type= "Öğrenci";
						$user_mail= htmlspecialchars($_POST["login_mail"]);
						$user_password= htmlspecialchars($_POST["login_password"]);

						if ($user_type !="" && $user_mail !="" && $user_password !="" ) {

							// ÖĞRENCİ GİRİŞ KONTROLÜ--------------------------------------------------------------------
							if ($user_type=="Öğrenci") {
								$sor=$db->prepare("SELECT * FROM student where ogrenci_mail='$user_mail' ") or die("Sorun");
								$sor->execute();

								//VERİTABANINDA KAYITLI VERİ GERİ DÖNERSE
								if ($sor->rowCount()!=0) {
									while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
										$db_ogrenci_mail=$data["ogrenci_mail"];
										$db_ogrenci_sifre=$data["ogrenci_sifre"];
										$db_ogrenci_isim=$data["isim"];
										$db_ogrenci_soyisim=$data["soyisim"];
										$db_ogrenci_sinif=$data["sinif"];
										$db_ogrenci_cepno=$data["ogrenci_cepno"];
										$db_ogrenci_tcno=$data["tcno"];
										$db_uyelik=$data["uyelik_durum"];
									}

									$user_password=sha1(md5(md5($user_password)));

									if ($db_uyelik==0) {
													echo '
													     <div class="toast bg-danger d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">

													        <div class="row bg-danger p-2" >
													            <div class="text-white" ><i class="fas fa-exclamation-triangle text-white" style="font-size:25px;"></i> &nbsp;</div>
													            <div class="text-white font-weight-normal" > HESABINIZ ASKIYA ALINMIŞTIR ! </div>
													        </div>
													    </div>
														<script>
														$(document).ready(function(){
														        $("#myToast").toast({ delay: 4000 });
														        $("#myToast").toast("show");
														    }); 
														</script>
													';
													header("refresh:1; url=/web/sign-in.php");
													die();
										
									}
									
									else{

											// ÖĞRENCİ GİRİŞ BAŞARILI
											if ($user_password==$db_ogrenci_sifre && $user_mail==$db_ogrenci_mail && $db_uyelik==1) {
												echo '
													     <div class="toast bg-success d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0; ">
													        <div class="row bg-success p-2" >
													            <div class="text-white" ><i class="fas fa-check text-white" style="font-size:25px;"></i> &nbsp;</div>
													            <div class="text-white font-weight-normal" >   GİRİŞ BAŞARILI ! </div>
													        </div>
													    </div>
														<script>
														$(document).ready(function(){
													        $("#myToast").toast({ delay: 3000 });
													        $("#myToast").toast("show");
													    }); 
														</script>
													';

												$_SESSION["mail"]=$db_ogrenci_mail;
												$_SESSION["oturum"]=true;
												$_SESSION["tip"]=$user_type;
												$_SESSION["isim"]=$db_ogrenci_isim;
												$_SESSION["soyisim"]=$db_ogrenci_soyisim;
												$_SESSION["sinif"]=$db_ogrenci_sinif;
												$_SESSION["cepno"]=$db_ogrenci_cepno;
												$_SESSION["tcno"]=$db_ogrenci_tcno;

												header("refresh:1; url=/web/dashboard.php");
												die();
											}
											// ÖĞRENCİ GİRİŞ BAŞARISIZ
											else{
												echo '
													     <div class="toast bg-danger d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">
													        <div class="row bg-danger p-2" >
													            <div class="text-white" ><i class="fas fa-exclamation-triangle text-white" style="font-size:25px;"></i> &nbsp;</div>
													            <div class="text-white font-weight-normal" > GİRİŞ BAŞARISIZ! </div>
													        </div>
													    </div>
														<script>
														$(document).ready(function(){
														        $("#myToast").toast({ delay: 3000 });
														        $("#myToast").toast("show");
														    });
														</script>
													';
												header("refresh:1; url=/web/sign-in.php");
												die();
								
											}

									}
								

									
								}
								// KAYITLI OLMAYAN BİR E-POSTA İLE GİRİŞ YAPILMAK İSTENİRSE HATA VERECEKTİR
								else{
										echo '
										     <div class="toast bg-danger d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">

										        <div class="row bg-danger p-2" >
										            <div class="text-white" ><i class="fas fa-exclamation-triangle text-white" style="font-size:25px;"></i> &nbsp;</div>
										            <div class="text-white font-weight-normal" > GİRİŞ BAŞARISIZ! </div>
										        </div>
										    </div>
											<script>
											$(document).ready(function(){
											        $("#myToast").toast({ delay: 3000 });
											        $("#myToast").toast("show");
											    }); 
											</script>
										';
										header("refresh:1; url=/web/sign-in.php");
										die();
									}
								
							}

							// VELİ GİRİŞ KONTROLÜ--------------------------------------------------------------------
							 if ($user_type=="Veli") {
								$sor=$db->prepare("SELECT * FROM student where veli_mail='$user_mail' ") or die("Sorun");
								$sor->execute();

								//VERİTABANINDA KAYITLI VERİ GERİ DÖNERSE
								if ($sor->rowCount()!=0) {
									while ($data=$sor->fetch(PDO::FETCH_ASSOC)) {
										$db_veli_mail=$data["veli_mail"];
										$db_veli_sifre=$data["veli_sifre"];
										$db_veli_isim=$data["veli_isim"];
										$db_veli_soyisim=$data["veli_soyisim"];
										$db_veli_ogrenci_mail=$data["ogrenci_mail"];
										$db_veli_cepno=$data["veli_cepno"];
										
									}
									if (strlen($db_veli_sifre)>8) {
										$user_password=sha1(md5(md5($user_password)));
									}
									else{
									}
									

									// VELİ GİRİŞ BAŞARILI 
									if ($user_password==$db_veli_sifre && $user_mail==$db_veli_mail) {
											echo '
												     <div class="toast bg-success d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0; ">
												        <div class="row bg-success p-2" >
												            <div class="text-white" ><i class="fas fa-check text-white" style="font-size:25px;"></i> &nbsp;</div>
												            <div class="text-white font-weight-normal" >   GİRİŞ BAŞARILI ! </div>
												        </div>
												    </div>
													<script>
													$(document).ready(function(){
												        $("#myToast").toast({ delay: 3000 });
												        $("#myToast").toast("show");
												    }); 
													</script>
												';

										$_SESSION["mail"]=$db_veli_mail;
										$_SESSION["oturum"]=true;
										$_SESSION["tip"]=$user_type;
										$_SESSION["isim"]=$db_veli_isim;
										$_SESSION["soyisim"]=$db_veli_soyisim;
										$_SESSION["veli_ogrenci_mail"]=$db_veli_ogrenci_mail;
										$_SESSION["cepno"]=$db_veli_cepno;


										header("refresh:1; url=/web/dashboard.php");
										die();

									}

									// VELİ GİRİŞ BAŞARISIZ
									else{
										echo '
											     <div class="toast bg-danger d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">

											        <div class="row bg-danger p-2" >
											            <div class="text-white" ><i class="fas fa-exclamation-triangle text-white" style="font-size:25px;"></i> &nbsp;</div>
											            <div class="text-white font-weight-normal" > GİRİŞ BAŞARISIZ! </div>
											        </div>
											    </div>
												<script>
												$(document).ready(function(){
												        $("#myToast").toast({ delay: 3000 });
												        $("#myToast").toast("show");
												    }); 
												</script>
											';
										header("refresh:1; url=/web/sign-in.php");
										die();

									}
								
								}
								// KAYITLI OLMAYAN BİR E-POSTA İLE GİRİŞ YAPILMAK İSTENİRSE HATA VERECEKTİR
								else{
										echo '
											     <div class="toast bg-danger d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">

											        <div class="row bg-danger p-2" >
											            <div class="text-white" ><i class="fas fa-exclamation-triangle text-white" style="font-size:25px;"></i> &nbsp;</div>
											            <div class="text-white font-weight-normal" > GİRİŞ BAŞARISIZ! </div>
											        </div>
											    </div>
												<script>
												$(document).ready(function(){
												        $("#myToast").toast({ delay: 3000 });
												        $("#myToast").toast("show");
												    }); 
												</script>
											';
										header("refresh:1; url=/web/sign-in.php");
										die();
									}
								
							}
							

							




						}

						else{
								echo '


										<div class="toast bg-warning d-flex justify-content-center p-3 mr-3" id="myToast" style="position: absolute; margin-top: 150px; top: 0; right: 0;">
									        <div class="row bg-warning p-2" >
									            <div class="text-white" ><i class="fas fa-exclamation text-white" style="font-size:25px;"></i> &nbsp;</div>
									            <div class="text-white font-weight-normal" > LÜTFEN BİLGİLERİ DOĞRU GİRİNİZ  </div>
									        </div>
									    </div>

									    <script>
										$(document).ready(function(){
									        $("#myToast").toast({ delay: 3000 });
									        $("#myToast").toast("show");
									    }); 
									
										</script>


								';
								header("refresh:1; url=/web/sign-in.php");
								die();
							}

				}






}



?>