$(document).ready(function() {  
     


       $('#pass, #again_pass').on('keyup', function () {
        var a=$('#pass').val();
        var b=$('#again_pass').val();

        if (a.length <8) {
            $('#mesaj').html('Şifre en az 8 haneli olmalıdır !').css('color', 'red');

        }
        else{


                if ( a == b ) {
                 $('#mesaj').html('Şifreler aynı').css('color', 'green');
             
              }

            

               else 
               {

                $('#mesaj').html('Şifreler aynı değil').css('color', 'red');
                }


        }
        
      
      });


       


      $("#bilgi-1").hide();
      $("#bilgi-2").hide();
      $("#bilgi-3").hide();
      $("#bilgi-4").hide();
      $("#bilgi-5").hide();
      var sayac0=0;
      var sayac1=0;
      var sayac2=0;
      var sayac3=0;
      var sayac4=0;

      function donder(nesne,d ) {

        $(nesne).css({ '-moz-transform':'rotate('+d+'deg)', '-webkit-transform':'rotate('+d+'deg)','-o-transform':'rotate('+d+'deg)','-ms-transform':'rotate('+d+'deg)','transform': 'rotate('+d+'deg)' });  
        }
  
  $('#bilgiler').click(function() {
    $("#bilgi-1").slideToggle(500);
    sayac0++;
    if (sayac0==1) {
      donder("#donet1",180);
    }
    else{
      donder("#donet1",0);
      sayac0=0;
    }
    

     

})

  $('#telefon').click(function() {
    $("#bilgi-2").slideToggle(500);
    sayac1++;
    if (sayac1==1) {
      donder("#donet2",180);
    }
    else{
      donder("#donet2",0);
      sayac1=0;
    }
    

     

})

  $('#e-posta').click(function() {
    $("#bilgi-3").slideToggle(500);
    sayac2++;
    if (sayac2==1) {
      donder("#donet3",180);
    }
    else{
      donder("#donet3",0);
      sayac2=0;
    }
    

     

})
    $('#sinif').click(function() {
      $("#bilgi-4").slideToggle(500);
      sayac3++;
      if (sayac3==1) {
        donder("#donet4",180);
      }
      else{
        donder("#donet4",0);
        sayac3=0;
      }
      

       

  })

    $('#sifre').click(function() {
      $("#bilgi-5").slideToggle(500);
      sayac4++;
      if (sayac4==1) {
        donder("#donet5",180);
      }
      else{
        donder("#donet5",0);
        sayac4=0;
      }
      

       

  })
     
      
    

    });