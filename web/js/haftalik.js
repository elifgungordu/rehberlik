$(document).ready(function() {

	$('#Modal').hide();



$('#odev').click(function(){
		
		$('#Modal').modal();



	})

$('#odev').hover(function(){ 
				
				// arka plan rengini sarı yap
				$(this).addClass("shadow"); 
				
				// div nesnesinin üzerinden gettiğimde
			}, function(){ 
				
				// arka plan rengini kaldır
				$(this).removeClass("shadow"); 
				
			});


});