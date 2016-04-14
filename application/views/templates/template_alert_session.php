<?php
if($this->session->userdata('alert-session')==true){
	$alert_session = $this->session->userdata('alert-session');
	$type = strtolower($alert_session['type']);
	$message = strtolower($alert_session['message']);
	$title = strtoupper($alert_session['type']);
	switch($type){
		case 'success':
			$type = 'alert-success';
			$icon = '<i class="fa fa-check-circle"></i>';
			break;
		case 'info':
			$type = 'alert-info';
			$icon = '<i class="fa fa-info-circle"></i>';
			break;
		case 'warning':
			$type = 'alert-warning';
			$icon = '<i class="fa fa-exclamation-circle"></i>';
			break;
		case 'error':
			$type = 'alert-danger';
			$icon = '<i class="fa fa-times-circle"></i>';
			break;
		default:
			$type = 'alert-info';
			$icon = '<i class="fa fa-info-circle"></i>';
			$title = 'info';
			break;
	}
	?>
		<div class="alert <?= $type ?> alert-dismissable alert-session">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong><?= $icon ?> <?= strtoupper($title) ?> :</strong> <?= ucfirst($message) ?>
		</div>
	<?php
	$this->session->unset_userdata('alert-session');
}
?>