
$(document).ready(function() {

var dropCount=0;
	
	$('#icerik').load("php/panel.php");

	$("#menu").hide();

	$('#secenek').click(function() {
		dropCount=1;
    	
    })

    
    $(window).click(function(e) {
    	if (dropCount==1) {dropCount=0; $('#menu').fadeToggle(500); }
    	else{$("#menu").hide();}
	})


	



//Anasayfaya gitme fonksiyonu
	$('#sayfam').click(function(){
		
		location.reload('true');



	})





//Kaynak yayınları ekrana getirme fonksiyonu
	$('#deneme').click(function(){
		
		 $('#icerik').load("php/deneme.php");

	})

//Kaynak yayınları ekrana getirme fonksiyonu
	$('#source_bt').click(function(){
		
		 $('#icerik').load("php/student-source.php");

	})

//Soru Çözme ekranı getirme fonksiyonu
	$('#soru_cozme').click(function(){
		
		$('#icerik').load("php/soru_cozme.php");

	})

//Serbest Kitap okuma ekranı getirme fonksiyonu
	$('#kitap_okuma').click(function(){
		
		$('#icerik').load("php/serbest_okuma.php");

	})

//Paragraf-Problem ekranı getirme fonksiyonu
	$('#problem').click(function(){
		$('#icerik').load("php/paragraf_problem.php");

	})

//Ders Çalışma ekranı getirme fonksiyonu
	$('#ders_calisma').click(function(){
		$('#icerik').load("php/ders_calisma.php");

	})

//Haftalık danışman Programı ekranı getirme fonksiyonu
	$('#program').click(function(){
		
		$('#icerik').load("haftalik.html");

	})

	
	$('#setting').click(function() {

				

				$.post("php/dash.php?islem=login_type",function(tip){
			
				

				if (tip.trim()=="Öğrenci") {
							$.getJSON("php/dash.php?islem=user_value",function(veri){
							var adi=veri.name;
							var soyadi=veri.surname;	
							var kullanici=veri.name+" "+veri.surname;
							var eposta =veri.mail;
							var no=veri.phone;
							var sinif=veri.class;


							$('#icerik').html(

									' <script type="text/javascript" src="js/setting-form.js"></script>'+
									'<div class="row my-5">'+
									     '<div class="container d-flex justify-content-center"><img class="mb-4" src="img/user.png" alt="" width="80" height="80"></div>'+
									     '<div class="container text-center "><h5 class="text-muted">'+kullanici+'</h5></div>'+
									     '<div class="container text-center "><h6 class="font-weight-light text-muted">'+eposta+'</h6></div>'+
									     '<div class="container text-center "><h6 class="font-weight-light text-muted">'+sinif+'. Sınıf</h6></div>'
									     
							);
						})
					}
				else if(tip.trim()=="Admin"){
					$.getJSON("php/dash.php?islem=user_value",function(veri){
							var adi=veri.name;
							var soyadi=veri.surname;	
							var kullanici=veri.name+" "+veri.surname;
							var eposta =veri.mail;
							var no=veri.phone;


							$('#icerik').html(

									' <script type="text/javascript" src="js/setting-form.js"></script>'+
									'<div class="row my-5">'+
									     '<div class="container d-flex justify-content-center"><img class="mb-4" src="img/admin_user.png" alt="" width="80" height="80"></div>'+
									     '<div class="container text-center "><h5 class="text-muted">'+kullanici+'</h5></div>'+
									     '<div class="container text-center "><h6 class="font-weight-light text-muted">'+eposta+'</h6></div>'+
									     '<div class="container text-center "><h6 class="font-weight-light text-muted">Yönetici</h6></div>'

							);
						})

				}

					else {
							$.getJSON("php/dash.php?islem=user_value",function(veri){
							var adi=veri.name;
							var soyadi=veri.surname;	
							var kullanici=veri.name+" "+veri.surname;
							var eposta =veri.mail;
							var no=veri.phone;



							$('#icerik').html(

									' <script type="text/javascript" src="js/setting-form.js"></script>'+
									'<div class="row my-5">'+
									     '<div class="container d-flex justify-content-center"><img class="mb-4" src="img/user.png" alt="" width="80" height="80"></div>'+
									     '<div class="container text-center "><h5 class="text-muted">'+kullanici+'</h5></div>'+
									     '<div class="container text-center "><p class="font-weight-light text-muted">'+eposta+'</p></div>'
							);
						})
					}

					
			
		})
			
		

		});
	
	$('#exit').click(function() {
		$.post("php/dash.php?islem=oturum_kapat",function(res){
			
				window.location.href = "index.html"; 
		})			
									
		
		});

	$('#abonelik').click(function() {
		$.post("php/dash.php?islem=abonelik",function(deger){
			
				$('#icerik').html(deger);
		})			
									
		
		});

// **********************************************ADMİN İŞLEMLERİ********************************************************************************************

// Danışmanın paneli ekranı
	$('#adminsayfam').click(function(){
		
		location.reload('true');

	})

// Danışmanın müfredat Oluştur
	$('#adminmufredat').click(function(){
		
		$('#icerik').load("php/mufredat.php");

	})

// Danışmanın Kayıt Kodu Oluştur
	$('#adminkod').click(function(){
		
		$('#icerik').load("php/danisman_kod.php");

	})

// Danışmanın Yeni Şifre Ver
	$('#adminsifre').click(function(){
		
		$('#icerik').load("php/sifre_ver.php");

	})

// Danışmanın Kayıt Durum Değiştir
	$('#adminabone').click(function(){
		
		$('#icerik').load("php/kayit_durum.php");

	})


});
