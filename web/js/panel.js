$(document).ready(function() {

// Panel Açılır Açılmaz Tavsiye Yükle
$.getJSON("php/action-panel.php?olay=tavsiye_icerik",function(veri){
		$('#tavsiyeDate').html(veri.tarih);
		$('#tavsiyeMain').html(veri.icerik);
		$('#tavsiyebody').append('<a class="btn btn-sm btn-info ml-2" href="php/action-panel.php?tavsiye_sil='+veri.id+'" value="ok" id="butt" role="button">Anlaşıldı</a>');

})	







	});