$(function(){

	function get_total_cost(){
		var total_cost = 0;
		for(var x = 0; x < $('#DETAILS tr').length; x++){
			total_cost += Number($('#DETAILS tr:eq('+ x +') td:eq(4)').text());
		}
		$('#TOTAL_COST').val(total_cost);
	}

	$(document).on('click', '#ADD', function(){
		var name = $('#NAME').val();
		var price = $('#PRICE').val();
		var amount = $('#AMOUNT').val();
		var total = Number(price) * Number(amount);
		var no = $('#DETAILS tr').length + 1;
		var details = "";
		if(name != "" && isNaN(price)==false && price != "" && isNaN(amount)==false && amount != ""){
			details += '<tr>';
			details += '<td>'+ no +'</td>';
			details += '<td><input type="hidden" name="details[NAME][]" value="'+ name +'">'+ name +'</td>';
			details += '<td><input type="hidden" name="details[PRICE][]" value="'+ price +'">'+ price +'</td>';
			details += '<td><input type="hidden" name="details[AMOUNT][]" value="'+ amount +'">'+ amount +'</td>';
			details += '<td>'+ total +'</td>';
			details += '<td><a href="javascript:void(0)" class="tooltips remove" title="Hapus"><i class="fa fa-times fa-lg"></i></a></td>';
			details += '</tr>';
			$('#DETAILS').append(details);
			get_total_cost();
			$('#NAME').val('');
			$('#PRICE').val('');
			$('#AMOUNT').val('');
			$('#NAME').focus();
		}else{
			set_message("error", "Nama, Harga atau Jumlah tidak valid.");
		}
		$('.tooltips, #tooltips').tooltip();
	});
	
	$(document).on('click', '.remove', function(){
		$(this).parents('tr').remove();
		get_total_cost();
	});

});