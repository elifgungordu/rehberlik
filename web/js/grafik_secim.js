$(document).ready(function() {


//pie grafik Problem/Paragraf
$('#grafik_problem').html('<div class="col bg-light shadow"><canvas id="myPieChart2"  ></canvas></div>');
$.ajax({
		        url :"php/grafik_islemleri.php?data=paragraf_problem",
		        dataType: "json",
		        type:"POST",
		        cache:false,
		        data:{},
		        success:function(soru){

		        var jsonData=JSON.stringify(soru);
    			var data=JSON.parse(jsonData);

    			var ders=["Paragraf","Problem"];
    			var sayi=[];
    			sayi[0]=data.Paragraf;
    			sayi[1]=data.Problem;

		   		  new Chart(document.getElementById("myPieChart2"), {
				                type: 'doughnut',
				                data: {
				                  labels: ders,
				                  datasets: [{
				                    backgroundColor: ["#e91e63", "#1565c0"],
				                    data: sayi
				                  }]
				                },
				                  options: {
				                    legend: {
				                      labels: {
				                          padding:20,
				                          fontColor: 'black',
				                          fontSize: 14,
				                          fontFamily:"Segoe UI",
				                          usePointStyle: true,
				                        },
				                      display: true,
				                      position: 'bottom',
				                    },
				                    title: {
				                      display: true,
				                      text: 'Paragraf / Problem'
				                    }
				                  }
				              });
		   		}
});


//pie grafik Kategorik Soru Çözme
$('#grafik_sorucozum').html('<div class="col bg-light shadow"><canvas id="myPieChart"  ></canvas></div>');
$.ajax({
		        url :"php/grafik_islemleri.php?data=soru_cozme",
		        dataType: "json",
		        type:"POST",
		        cache:false,
		        data:{},
		        success:function(soru){

      			var jsonData=JSON.stringify(soru);
    			var data=JSON.parse(jsonData);

    			var color=["#e91e63", "#1565c0","#ff8f00","#2e7d32","#6a1b9a","#2e7d32","#6a1b9a"];
    			var ders=[];
    			var sayi=[];
    			
    			for (var i = 1; i <= Object.keys(data).length; i++) { 
		        		ders[i-1]=data[i].Ders;
		        		sayi[i-1]=data[i].Sayi;
		        	}

				 new Chart(document.getElementById("myPieChart"), {
				                type: 'doughnut',
				                data: {
				                  labels: ders,
				                  datasets: [{
				                    backgroundColor:color,
				                    data: sayi
				                  }]
				                },
				                  options: {
				                    legend: {
				                      labels: {
				                          padding:20,
				                          fontColor: 'black',
				                          fontSize: 14,
				                          fontFamily:"Segoe UI",
				                          usePointStyle: true,
				                        },
				                      display: true,
				                      position: 'bottom',
				                    },
				                    title: {
				                      display: true,
				                      text: 'Soru Çözme Dağılımı'
				                    }
				                  }
				              });
  				}
});


// Line grafik
$('#grafik_cizgi').html('<div class="col-10 bg-light shadow my-3" style="margin-left: 50px;"><canvas  id="myChart"></canvas></div>');
var ctx = document.getElementById("myChart").getContext("2d");
							            var myChart = new Chart(ctx, {
							            type: "line",
							            data: {
							              labels: [],
							              datasets: [{ 
							                  data: [],
							                  label: " ",
							                  borderColor: "#455a64",
							                  backgroundColor: "#455a64",
							                  fill: false,
							                },
							              ]
							            },
							            });	

// seçilen konuya göre Line grafik göster
 $("#grafik_sec").on("change",function(){
	

      var grafikId = $(this).val();

      if (grafikId=="Deneme Sonucu") {
      			$.ajax({
		        url :"php/grafik_islemleri.php?data=deneme",
		        dataType: "json",
		        type:"POST",
		        cache:false,
		        data:{},
		        success:function(gelen){

          			var jsonVeri=JSON.stringify(gelen);
        			var veri=JSON.parse(jsonVeri);

	    			var net=[];
	    			var labeldeneme=[];
	    			
	    			if(Object.keys(veri).length > 7 ){
	    				dongu=7;
	    			}
	    			else{
	    				dongu=Object.keys(veri).length;
	    			}

	    			for (var i = 1; i <= dongu; i++) { 
	    					
			        		labeldeneme[i-1]=veri[i].Deneme;
			        		net[i-1]=veri[i].Net;
			        	}


      					var ctx = document.getElementById("myChart").getContext("2d");
							            var myChart = new Chart(ctx, {
							            type: "line",
							            data: {
							              labels: labeldeneme.reverse(),
							              datasets: [{ 
							                  data: net.reverse(),
							                  label: "Toplam Net",
							                  borderColor: "#e91e63",
							                  backgroundColor: "#e91e63",
							                  fill: false,
							                },
							              ]
							            },
							            });	
								 }

				      });
      }

      else if (grafikId=="Kitap Okuma") {
      		
	      	  $.ajax({
		        url :"php/grafik_islemleri.php?data=kitap_okuma",
		        dataType: "json",
		        type:"POST",
		        cache:false,
		        data:{},
		        success:function(gelen){

          			var jsonVeri=JSON.stringify(gelen);
        			var veri=JSON.parse(jsonVeri);

	    			var sayi=[];
	    			var labeltarih=[];
	    			
	    			if(Object.keys(veri).length > 7 ){
	    				dongu=7;
	    			}
	    			else{
	    				dongu=Object.keys(veri).length;
	    			}

	    			for (var i = 1; i <= dongu; i++) { 
	    					
			        		labeltarih[i-1]=veri[i].Tarih;
			        		sayi[i-1]=veri[i].Sayi;
			        	}
			        	

		        	var ctx = document.getElementById("myChart").getContext("2d");
					            var myChart = new Chart(ctx, {
					            type: "line",
					            data: {
					              labels: labeltarih.reverse(),
					              datasets: [{ 
					                  data: sayi.reverse(),
					                  label: "Sayfa Sayısı",
					                  borderColor: "#fbc02d",
					                  backgroundColor: "#fbc02d",
					                  fill: false,
					                },
					              ]
					            },
					            });	
		        }

		      });
      		
      }

      else if (grafikId=="Ders Çalışma") {
      	 $.ajax({
		        url :"php/grafik_islemleri.php?data=ders_calisma",
		        dataType: "json",
		        type:"POST",
		        cache:false,
		        data:{},
		        success:function(Sure){

		        	var jsonVeri=JSON.stringify(Sure);
        			var veri=JSON.parse(jsonVeri);

	    			var sure=[];
	    			var labeltarih=[];
	    			
	    			var dongu=0;

	    			if(Object.keys(veri).length > 7 ){
	    				dongu=7;
	    			}
	    			else{
	    				dongu=Object.keys(veri).length;
	    			}

	    			for (var i = 1; i <= dongu; i++) { 
	    					
			        		labeltarih[i-1]=veri[i].Tarih;
			        		sure[i-1]=veri[i].Sure;
			        	}

      				var ctx = document.getElementById("myChart").getContext("2d");
							            var myChart = new Chart(ctx, {
							            type: "line",
							            data: {
							              labels: labeltarih.reverse(),
							              datasets: [{ 
							                  data: sure.reverse(),
							                  label: "Çalışılan Saat",
							                  borderColor: "#0288d1",
							                  backgroundColor: "#0288d1",
							                  fill: false,
							                },
							              ]
							            },
							            });	
				}

		    });
      }

	 else if (grafikId=="Paragraf Çözme") {

	 			$.ajax({
			        url :"php/grafik_islemleri.php?data=paragraf_cozme",
			        dataType: "json",
			        type:"POST",
			        cache:false,
			        data:{},
			        success:function(gelen){

	          			var jsonVeri=JSON.stringify(gelen);
	        			var veri=JSON.parse(jsonVeri);

		    			var sayi=[];
		    			var labeltarih=[];
		    			
		    			if(Object.keys(veri).length > 7 ){
		    				dongu=7;
		    			}
		    			else{
		    				dongu=Object.keys(veri).length;
		    			}

		    			for (var i = 1; i <= dongu; i++) { 
		    					
				        		labeltarih[i-1]=veri[i].Tarih;
				        		sayi[i-1]=veri[i].Sayi;
				        	}

	      				var ctx = document.getElementById("myChart").getContext("2d");
								            var myChart = new Chart(ctx, {
								            type: "line",
								            data: {
								              labels: labeltarih.reverse(),
								              datasets: [{ 
								                  data: sayi.reverse(),
								                  label: "Çözülen Paragraf Sorusu",
								                  borderColor: "#512da8",
								                  backgroundColor: "#512da8",
								                  fill: false,
								                },
								              ]
								            },
								            });	
						  }

		      });		            

	      }

  	 else if (grafikId=="Problem Çözme") {

  	 			$.ajax({
				        url :"php/grafik_islemleri.php?data=problem_cozme",
				        dataType: "json",
				        type:"POST",
				        cache:false,
				        data:{},
				        success:function(gelen){

		          			var jsonVeri=JSON.stringify(gelen);
		        			var veri=JSON.parse(jsonVeri);

			    			var sayi=[];
			    			var labeltarih=[];
			    			
			    			if(Object.keys(veri).length > 7 ){
			    				dongu=7;
			    			}
			    			else{
			    				dongu=Object.keys(veri).length;
			    			}

			    			for (var i = 1; i <= dongu; i++) { 
			    					
					        		labeltarih[i-1]=veri[i].Tarih;
					        		sayi[i-1]=veri[i].Sayi;
					        	}

	      				var ctx = document.getElementById("myChart").getContext("2d");
								            var myChart = new Chart(ctx, {
								            type: "line",
								            data: {
								              labels: labeltarih.reverse(),
								              datasets: [{ 
								                  data: sayi.reverse(),
								                  label: "Çözülen Problem Sorusu",
								                  borderColor: "#d32f2f",
								                  backgroundColor: "#d32f2f",
								                  fill: false,
								                },
								              ]
								            },
								            });
						  }

		      });			            	
      }

      else{

      		var ctx = document.getElementById("myChart").getContext("2d");
							            var myChart = new Chart(ctx, {
							            type: "line",
							            data: {
							              labels: [],
							              datasets: [{ 
							                  data: [],
							                  label: " ",
							                  borderColor: "#455a64",
							                  backgroundColor: "#455a64",
							                  fill: false,
							                },
							              ]
							            },
							            });	
      }



	    






    });




 });