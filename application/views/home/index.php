<?= $breadcrumb ?>
<div class="row">
	<div class="col-md-4">
		<?php if($this->session->userdata('current_user')==false){ ?>
			<form class="form-signin" action="<?= base_url('home/signin') ?>" method="post" role="form">
				<h2 class="form-signin-heading">Masuk</h2>
				<input type="text" class="form-control" name="<?= $controller ?>[USERNAME]" maxlength="100" placeholder="Nama Pengguna" required autofocus>
				<input type="password" class="form-control" name="<?= $controller ?>[PASSWORD]" maxlength="100" placeholder="Kata Sandi" required>
				<button class="btn btn-primary validation" type="submit"><i class="fa fa-sign-in"></i> Masuk</button>
				<a href="<?= base_url('home/signup') ?>" class="btn btn-primary"><i class="fa fa-user"></i> Daftar</a>
			</form>
		<?php }else{ ?>
			<div class="form-signin">
				<h2 class="form-signin-heading"><small>Anda Login Sebagai</small><br> <?= $current_user->USER_NAME ?></h2>
				<a href="<?= base_url('home/signout') ?>" class="btn btn-lg btn-primary">Keluar</a>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-8">
		<div class="form-scroller">
			<div class="page-header"><h2>Sejarah Institusi / Perusahaan</h2></div>
			<p class="text-justify">Pelangi Laundry & Dry Clean adalah Perusahaan yang didirikan oleh Bapak.   Dedi Suyadi sejak tahun 2008. Dengan mempunyai Visi yaitu memberikan  keseharian yang bersih & nyaman melalui jasa laundy, dan mempunyai Misi yaitu memberikan pelayanan laundry terbaik bagi pelanggan untuk mencapai kepuasan pelanggan tersebut, serta mengembangkan potensi sumber daya manusia dan meningkatkan kesejahteraan bersama.</p>
			<div class="page-header"><h2>Struktur Organisasi</h2></div>
			<img src="<?= images_url('organisasi.png') ?>" alt="" class="img-rounded" width="100%">
		</div>
	</div>
</div>