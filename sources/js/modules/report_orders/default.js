$(function(){

	$('#CUSTOMERS').select2({
		placeholder: "Pilih Pelanggan"
	});
	
	$('#STATUS').select2({
		placeholder: "Pilih Status"
	});
	
	$(document).on('click', '.btn-print', function(){
		var cari = $('#CARI').val();
		var cust = $('#CUSTOMERS').val();
		var min = $('#DATE_ORDER_MIN').val();
		var max = $('#DATE_ORDER_MAX').val();
		var status = $('#STATUS').val();
		if(min == "" && max != ""){
			set_message("error", "Dari Tanggal Pesanan harus diisi.");
		}else if(min != "" && max == ""){
			set_message("error", "Sampai Tanggal Pesanan harus diisi.");
		}else{
			window.open(BASE_URL + 'report_orders/reports?cari='+ cari +'&cust='+ cust +'&min='+ min +'&max='+ max +'&status='+ status, '_blank');
		}
	});

});