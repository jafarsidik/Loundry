$(function(){
	
	$('#SERVICE_CATEGORY').select2({
		placeholder: "Pilih Kategori Layanan"
	});
	
	$(document).on('click', '.btn-print', function(){
		var cari = $('#CARI').val();
		var category = $('#SERVICE_CATEGORY').val();
		var min = $('#PRICE_MIN').val();
		var max = $('#PRICE_MAX').val();
		window.open(BASE_URL + 'report_services/reports?cari='+ cari +'&category='+ category +'&min='+ min +'&max='+ max, '_blank');
	});
	
});