$(document).ready(function() {


$('#kaynak_ekle').click(function(){
	var yayinci=$('#yayinevi_adi').val();
	var kaynakcinsi=$('#kaynak_turu').val();
	var kitapadi=$('#kitap_adi').val();
	var sayfasayi=$('#sayfa_sayisi').val();

	if ( yayinci =="" || kaynakcinsi =="" || kitapadi =="" || sayfasayi =="") {
			alert("Lütfen boş alanları doldurun !");
		}

		else{



				$.post("php/kaynak-islem.php?islem=kaynakekle",{yayinevi_adi:yayinci,kaynak_turu:kaynakcinsi,kitap_adi:kitapadi,sayfa_sayisi:sayfasayi}).done(function(data){
						$('#yayinevi_adi').val('');
						$('#kaynak_turu').val('');
						$('#kitap_adi').val('');
						$('#sayfa_sayisi').val('');
							

				});

				$.post("php/kaynak-islem.php?islem=yenile",function(deger){
				
					$('#tablom').html(deger);
				});

			}
});







});