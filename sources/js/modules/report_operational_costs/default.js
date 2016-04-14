$(function(){

	$('#USERS').select2({
		placeholder: "Pilih Pengguna"
	});
	
	$(document).on('click', '.btn-print', function(){
		var cari = $('#CARI').val();
		var user = $('#USERS').val();
		var min = $('#DATE_MIN').val();
		var max = $('#DATE_MAX').val();
		if(min == "" && max != ""){
			set_message("error", "Dari Tanggal harus diisi.");
		}else if(min != "" && max == ""){
			set_message("error", "Sampai Tanggal harus diisi.");
		}else{
			window.open(BASE_URL + 'report_operational_costs/reports?cari='+ cari +'&user='+ user +'&min='+ min +'&max='+ max, '_blank');
		}
	});
	
});