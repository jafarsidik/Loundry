$(document).on('click', '.chk-module', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('tbody').find('tr[group-module=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('tbody').find('tr[group-module=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('keydown', '.chk-module', function(e){
	if(e.keyCode==13 || e.keyCode==32){
		if($(this).find('input[type=checkbox]').is(':checked')==true){
			$(this).parents('tbody').find('tr[group-module=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', true);
		}else{
			$(this).parents('tbody').find('tr[group-module=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', false);
		}
	}
});

$(document).on('click', '.chk-function', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('tbody').find('tr[group-function=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('tbody').find('tr[group-function=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('keydown', '.chk-function', function(e){
	if(e.keyCode==13 || e.keyCode==32){
		if($(this).find('input[type=checkbox]').is(':checked')==true){
			$(this).parents('tbody').find('tr[group-function=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', true);
		}else{
			$(this).parents('tbody').find('tr[group-function=' + $(this).attr('val') + '] input[type=checkbox]').prop('checked', false);
		}
	}
});

$(document).on('click', '.check-all-module', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('table').find('tbody .col-module input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('table').find('tbody .col-module input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('click', '.check-all-function', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('table').find('tbody .col-function input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('table').find('tbody .col-function input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('click', '.check-all-read', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('table').find('tbody .col-read input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('table').find('tbody .col-read input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('click', '.check-all-create', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('table').find('tbody .col-create input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('table').find('tbody .col-create input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('click', '.check-all-edit', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('table').find('tbody .col-edit input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('table').find('tbody .col-edit input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('click', '.check-all-delete', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('table').find('tbody .col-delete input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('table').find('tbody .col-delete input[type=checkbox]').prop('checked', false);
	}
});