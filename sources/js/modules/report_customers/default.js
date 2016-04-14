$(function(){
	
	$('#CUSTOMER_TYPES').select2({
		placeholder: "Pilih Jenis Pelanggan"
	});
	
	$(document).on('click', '.btn-print', function(){
		var cari = $('#CARI').val();
		var type = $('#CUSTOMER_TYPES').val();
		window.open(BASE_URL + 'report_customers/reports?cari='+ cari +'&type='+ type, '_blank');
	});
	
});