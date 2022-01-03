$(document).ready(function() {

$('#ders_tablo').hide();
$('#konu_tablo').hide();



// Ders tablosunu göster fonksiyonu
var sayac=0;
	$('#dersler').click(function(){
		sayac++;
		if(sayac==1){
			$('#ders_tablo').fadeIn(200);	
		}
		else{

			$('#ders_tablo').hide();
			sayac=0;
		}
		
		

	})


// Konu tablosunu göster fonksiyonu
var sayac=0;
	$('#konular').click(function(){
		sayac++;
		if(sayac==1){
			$('#konu_tablo').fadeIn(200);	
		}
		else{

			$('#konu_tablo').hide();
			sayac=0;
		}
		
		

	})

// seçilen sınıfa göre dersleri listele
 $("#konu_sinif").on("change",function(){
	
	$('#konu_dersadi').empty(); // selectbox boşaltılıyor

      var sinifId = $(this).val();

      $.ajax({
        url :"php/mufredat-islem.php?adminislem=selectders",
        dataType: "json",
        type:"POST",
        cache:false,
        data:{sinifId:sinifId},
        success:function(data){

		        	for (var i = 0; i < Object.keys(data).length; i++) {
		        		$('#konu_dersadi').append('<option>'+data[i]+'</option>'); // selectbox a ekleme yap
		        	}
        }

      });
    });

 // Ders Ekleme Eventi
 $('#ders_kaydet').click(function(){
 		var sinif=$('#ders_sinif').val();
		var dersadi=$('#dersadi').val();
		if ( sinif =="" || dersadi =="" ) {
			alert("Lütfen boş alanları doldurun !");
		}
		else{
			$.post("php/mufredat-islem.php?adminislem=ders_kayit",{ders_sinif:sinif,dersadi:dersadi}).done(function(data){
						$('#dersadi').val('');
						$('#ders_sinif').prop('selectedIndex',0);
							

				});
			$.post("php/mufredat-islem.php?adminislem=ders_yenile",function(deger){
				
					$('#derstablom').html(deger);
				});
		}


	});

 // Konu Ekleme Eventi
  $('#konu_kaydet').click(function(){
 		var sinif=$('#konu_sinif').val();
		var dersadi=$('#konu_dersadi').val();
		var konuadi=$('#konuadi').val();
		if ( sinif =="" || dersadi =="" ) {
			alert("Lütfen boş alanları doldurun !");
		}
		else{
			$.post("php/mufredat-islem.php?adminislem=konu_kayit",{konu_sinif:sinif,konu_dersadi:dersadi,konuadi:konuadi}).done(function(data){
						$('#konuadi').val('');
						$('#konu_sinif').prop('selectedIndex',0);
						$('#konu_dersadi').prop('selectedIndex',0);
							

				});
			$.post("php/mufredat-islem.php?adminislem=konu_yenile",function(deger){
				
					$('#konutablom').html(deger);
				});
		}


	});

	});