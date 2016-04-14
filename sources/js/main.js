var BASE_URL = "http://localhost/laundry/";

String.prototype.toFirstCase = function(){
	return this.charAt(0).toUpperCase() + this.slice(1);
}

function alert_session(){
	$('.alert-session').hide();
	$('.alert-session').slideDown();
	setTimeout(function(){
		$('.alert-session').slideUp();
	}, 3000);
}

function alert_js(){
	$('.alert-js').slideDown();
	setTimeout(function(){
		$('.alert-js').slideUp();
	}, 3000);
}

function set_message(type, message){
	if(type != "" && message != ""){
		var type = type.toLowerCase();
		var message = message.toLowerCase();
		var title = type.toUpperCase();
		switch(type){
			case 'success':
				var type = 'alert-success';
				var icon = '<i class="fa fa-check-circle"></i>';
				break;
			case 'info':
				var type = 'alert-info';
				var icon = '<i class="fa fa-info-circle"></i>';
				break;
			case 'warning':
				var type = 'alert-warning';
				var icon = '<i class="fa fa-exclamation-circle"></i>';
				break;
			case 'error':
				var type = 'alert-danger';
				var icon = '<i class="fa fa-times-circle"></i>';
				break;
			default:
				var type = 'alert-info';
				var icon = '<i class="fa fa-info-circle"></i>';
				var title = 'INFO';
				break;
		}
		$('.alert-js').addClass(type);
		$('.alert-js').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>' + icon + ' ' + title + ' :</strong> ' + message.toFirstCase());
		alert_js();
	}
}

$(document).on('click', '.check-all', function(){
	if($(this).find('input[type=checkbox]').is(':checked')==true){
		$(this).parents('table').find('tbody input[type=checkbox]').prop('checked', true);
	}else{
		$(this).parents('table').find('tbody input[type=checkbox]').prop('checked', false);
	}
});

$(document).on('keydown', '.check-all', function(e){
	if(e.keyCode==13 || e.keyCode==32){
		if($(this).find('input[type=checkbox]').is(':checked')==false){
			$(this).parents('table').find('tbody input[type=checkbox]').prop('checked', true);
		}else{
			$(this).parents('table').find('tbody input[type=checkbox]').prop('checked', false);
		}
	}
});

$(document).on('keydown', '.chkbox', function(e){
	if(e.keyCode==13 || e.keyCode==32){
		if($(this).find('input[type=checkbox]').is(':checked')==false){
			$(this).find('input[type=checkbox]').prop('checked', true);
		}else{
			$(this).find('input[type=checkbox]').prop('checked', false);
		}
	}
});

function search_typing(){
	$('.search_typing').typing({
		start: function (event, $elem) { },
		stop: function (event, $elem) { $('.search_typing').parents('form').submit(); },
		delay: 1000
	});
}

$(function(){
	alert_session();
	$('.alert-js').hide();
	search_typing();
});