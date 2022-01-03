$(document).ready(function() {






// seçilen derse göre konuları listele
 $("#derslist").on("change",function(){
	
	$('#konulist').empty(); // selectbox boşaltılıyor

      var dersvalue = $(this).val();

      $.ajax({
        url :"php/dash.php?islem=selectkonu",
        dataType: "json",
        type:"POST",
        cache:false,
        data:{ders:dersvalue},
        success:function(data){

		        	for (var i = 0; i < Object.keys(data).length; i++) {
		        		$('#konulist').append('<option>'+data[i]+'</option>'); // selectbox a ekleme yap
		        	}
        }

      });
    });





	});