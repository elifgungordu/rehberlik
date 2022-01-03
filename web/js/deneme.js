$(document).ready(function() {

var dersSayisi;
var denemeAdi;
// Girilen ders sayısı kadar input oluştur
$('#olustur').click(function() {

      $('#deneme_icerik').html('');

      dersSayisi=$('#ders_sayisi').val();
      denemeAdi=$('#deneme_adi').val();

      $('#ders_sayisi').val("");
      if (denemeAdi=="") {

          $('#deneme_icerik').html('<div class="container alert alert-danger" role="alert">Deneme Adı Boş Olamaz !</div>');
     
      }
      else{

          if (denemeAdi!="" && dersSayisi!=0 && dersSayisi <= 10) {

                  for (var i =1; i <= dersSayisi; i++) {
                  
                    $('#deneme_icerik').append('<div class="mt-2 border border-warning shadow"><h4 class="text-muted text-center">Ders '+i+'</h4><div class="col-auto">'+
                            '<div class="input-group mb-2" style="width: 300px;">'+
                              '<div class="input-group-prepend">'+
                                '<div class="input-group-text text-muted" style="font-size: small;">Ders Adı'+
                                '</div>'+
                              '</div>'+
                            '<input type="text"  class="form-control text-uppercase"  id="ders'+i+'" autocomplete="off" required>'+
                          '</div>'+
                        '</div>'+

                        '<div class="col-auto">'+
                            '<div class="input-group mb-2" style="width: 300px;">'+
                              '<div class="input-group-prepend">'+
                                '<div class="input-group-text text-success" style="font-size: small;">Doğru Sayısı'+
                                '</div>'+
                              '</div>'+
                            '<input type="number" min="0" class="form-control"  id="dogru'+i+'" autocomplete="off" required>'+
                          '</div>'+
                        '</div>'+

                        '<div class="col-auto">'+
                            '<div class="input-group mb-2" style="width: 300px;">'+
                              '<div class="input-group-prepend">'+
                                '<div class="input-group-text text-danger" style="font-size: small;">Yanlış Sayısı'+
                                '</div>'+
                              '</div>'+
                            '<input type="number" min="0" class="form-control"  id="yanlis'+i+'" autocomplete="off" required>'+
                          '</div>'+
                        '</div>'+

                        '<div class="col-auto">'+
                            '<div class="input-group mb-2" style="width: 300px;">'+
                              '<div class="input-group-prepend">'+
                                '<div class="input-group-text text-muted" style="font-size: small;">Boş Sayısı'+
                                '</div>'+
                              '</div>'+
                            '<input type="number" min="0" class="form-control"  id="bos'+i+'" autocomplete="off" required>'+
                          '</div>'+
                        '</div></div>');

                  }
      }

      else{
             $('#deneme_icerik').html('<div class="container alert alert-danger" role="alert">En az 1, en fazla 10 ders seçebilirsiniz!</div>');
      }




      }
      

    })





// Net hesapla
$('#hesapla').click(function() {
    var toplam_net=0;
    $.post("php/action-deneme.php?islem=sinifsor",function(sinif){
      var katsayi;
      
      // 8. sınıfa kadar 3 yanlış 1 doğruyu götürüyor sonrası 4 yanlış 1 doğruyu götürüyor
      if (sinif<=8) {katsayi=3;} else{katsayi=4;}
      



      // Tüm detayları ile deneme_analiz tablosuna kayıt işlemi için for döngüsü
      for (var i=1; i<=dersSayisi ; i++) {
          var ders=$('#ders'+i).val();
          var dogru=$('#dogru'+i).val();
          var yanlis=$('#yanlis'+i).val();
          var bos=$('#bos'+i).val();
          var net=dogru -(yanlis/katsayi);
          $.post("php/action-deneme.php?islem=analizKayit",{denemeadi:denemeAdi,ders:ders,dogru:dogru,yanlis:yanlis,bos:bos,net:net}).done(function(data){
      
           
          
          
          })


      }


      // toplam neti hesaplayan for döngüsü
      for (var i=1; i<=dersSayisi ; i++) {
        toplam_net+=$('#dogru'+i).val() - ($('#yanlis'+i).val()/katsayi);
      }


      $.post("php/action-deneme.php?islem=totalKayit",{denemeadi:denemeAdi,toplamNet:toplam_net}).done(function(data){
      
        
       alert (denemeAdi+" Kaydedildi");
      
      })

      location.reload('true');
    })



   
      


  })




	});