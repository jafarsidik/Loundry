$(function(){
	
	$(document).on('click', '.btn-print', function(){
		var min = $('#DATE_MIN').val();
		var max = $('#DATE_MAX').val();
		window.open(BASE_URL + 'report_income/reports?min='+ min +'&max='+ max, '_blank');
	});
	
});