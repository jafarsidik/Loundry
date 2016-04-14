<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?= images_url('Washing-machine-black.png') ?>">
		<title>Pelangi Laundry & Dry Clean</title>
		<link type="text/css" rel="stylesheet" href="<?= css_url('bootstrap.min.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?= css_url('font-awesome.min.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?= css_url('select2.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?= css_url('select2-bootstrap.css') ?>" />
		<?php if ($content_type == 'default') { ?>
		<link type="text/css" rel="stylesheet" href="<?= css_url('dashboard.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?= css_url('admin-page.css') ?>" />
		<?php } elseif ($content_type == 'frontpage') { ?>
		<link type="text/css" rel="stylesheet" href="<?= css_url('cover.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?= css_url('signin.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?= css_url('jquery.mCustomScrollbar.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?= css_url('front-page.css') ?>" />
		<?php } ?>
		<link type="text/css" rel="stylesheet" href="<?= css_url('styles.css') ?>" />
		<script type="text/javascript" src="<?= js_url('jquery-2.1.1.min.js') ?>"></script>
		<script type="text/javascript" src="<?= js_url('bootstrap.min.js') ?>"></script>
		<script type="text/javascript" src="<?= js_url('jquery.validate.min.js') ?>"></script>
		<script type="text/javascript" src="<?= js_url('jquery.typing-0.2.0.min.js') ?>"></script>
		<script type="text/javascript" src="<?= js_url('select2.min.js') ?>"></script>
		<script type="text/javascript" src="<?= js_url('jquery.mCustomScrollbar.min.js') ?>"></script>
		<script type="text/javascript" src="<?= js_url('docs.min.js') ?>"></script>
		<script type="text/javascript" src="<?= js_url('main.js') ?>"></script>
		<script>
			$(function(){
				$('.tooltips, #tooltips').tooltip();
				$('.validation, #validation').parents('form').validate();
				$('select.form-control').select2();
				$('.form-scroller, #form-scroller').mCustomScrollbar({
					autoHideScrollbar: true
				});
			});
		</script>
	</head>
	<body>
	<?php
		if ($content_type == 'default') {
			echo $navbar;
			echo '<div class="container-fluid">';
				echo '<div class="row">';
					echo '<div class="col-sm-3 col-md-2 sidebar">';
						echo $sidebar;
					echo '</div>';
					echo '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">';
						echo $content;
					echo '</div>';
				echo '</div>';
			echo '</div>';
		} elseif ($content_type == 'frontpage') {
			echo '<div class="site-wrapper">';
				echo '<div class="site-wrapper-inner">';
					echo '<div class="cover-container">';
						echo '<div class="masthead clearfix">';
							echo '<div class="inner">';
								echo $menubar;
							echo '</div>';
						echo '</div>';
						echo '<div class="inner cover">';
							echo $content;
						echo '</div>';
						echo '<div class="mastfoot">';
							echo '<div class="inner">';
								echo '<p>Pelangi Laundry & Dry Clean</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		echo '<div class="alert-area">';
			echo $alert_session;
			echo $alert_js;
		echo '</div>';
	?>
	</body>
</html>