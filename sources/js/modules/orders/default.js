$(function(){
	
	$('#CUSTOMERS').select2({
		placeholder: "Pilih Pelanggan"
	});
	
	$('#CUSTOMER_TYPES').select2({
		placeholder: "Pilih Jenis Pelanggan"
	});
	
	$('#USERS').select2({
		placeholder: "Pilih Pengguna"
	});
	
	$('#SERVICES').select2({
		placeholder: "Pilih Item Layanan"
	});
	
	$(document).on('change', '#CUSTOMERS', function(){
		var id = $(this).val();
		if(id == -1){
			$('#CREATE_CUSTOMERS').slideDown();
		}else{
			$('#CREATE_CUSTOMERS').slideUp();
		}
	});
	
	$(document).on('change', '#SERVICES', function(){
		var price = $(this).find('option:selected').attr('price');
		$('#PRICE').val(price);
		$('#AMOUNT').val("");
		$('#AMOUNT').focus();
	});
	
	function get_total_payment(){
		var total_payment = 0;
		for(var x = 0; x < $('#ORDER_DETAILS tr').length; x++){
			total_payment += Number($('#ORDER_DETAILS tr:eq('+ x +') td:eq(4)').text());
		}
		$('#TOTAL_PAYMENT').val(total_payment);
	}
	
	$(document).on('click', '#ADD', function(){
		var id_ser = $('#SERVICES').val();
		var name = $('#SERVICES option:selected').text();
		var price = $('#PRICE').val();
		var amount = $('#AMOUNT').val();
		var total = Number(price) * Number(amount);
		var no = $('#ORDER_DETAILS tr').length + 1;
		var order_details = "";
		if(id_ser != "" && isNaN(amount)==false && amount != ""){
			order_details += '<tr>';
			order_details += '<td><input type="hidden" name="order_details[ID_SERVICES][]" value="'+ id_ser +'">'+ no +'</td>';
			order_details += '<td>'+ name +'</td>';
			order_details += '<td><input type="hidden" name="order_details[PRICE][]" value="'+ price +'">'+ price +'</td>';
			order_details += '<td><input type="hidden" name="order_details[AMOUNT][]" value="'+ amount +'">'+ amount +'</td>';
			order_details += '<td>'+ total +'</td>';
			order_details += '<td><a href="javascript:void(0)" class="tooltips remove" title="Hapus"><i class="fa fa-times fa-lg"></i></a></td>';
			order_details += '</tr>';
			$('#ORDER_DETAILS').append(order_details);
			get_total_payment();
		}else{
			set_message("error", "Item Layanan atau Jumlah tidak valid.");
		}
		$('.tooltips, #tooltips').tooltip();
	});
	
	$(document).on('click', '.remove', function(){
		$(this).parents('tr').remove();
		get_total_payment();
	});
	
});