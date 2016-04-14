<?= $breadcrumb ?>
<div class="form-scroller">
	<form class="form-horizontal" action="<?= base_url('home/signup') ?>" method="post" role="form">
		
		<div class="page-header"><h2>Buat Akun Anda</h2></div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-sm-4">Nama Lengkap</label>
					<div class="col-sm-8">
						<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" maxlength="100" placeholder="Name Lengkap" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Telepon</label>
					<div class="col-sm-8">
						<input type="text" class="form-control required digits" name="<?= $controller ?>[PHONE]" maxlength="20" placeholder="Telepon">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Email</label>
					<div class="col-sm-8">
						<input type="text" class="form-control required email" name="<?= $controller ?>[EMAIL]" maxlength="100" placeholder="Email">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Alamat</label>
					<div class="col-sm-9">
						<textarea class="form-control required" name="<?= $controller ?>[ADDRESS]" maxlength="255" placeholder="Alamat" rows="6"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="page-header"><h4>Akses Pengguna</h4></div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-sm-4">Nama Pengguna</label>
					<div class="col-sm-8">
						<input type="text" class="form-control required" name="<?= $controller ?>[USERNAME]" maxlength="100" placeholder="Nama Pengguna">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-sm-3">Kata Sandi</label>
					<div class="col-sm-9">
						<input type="password" class="form-control required" name="<?= $controller ?>[PASSWORD]" maxlength="100" placeholder="Kata Sandi">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Konfirmasi</label>
					<div class="col-sm-9">
						<input type="password" class="form-control required" name="<?= $controller ?>[CONFIRM_PASSWORD]" maxlength="100" placeholder="Konfirmasi Kata Sandi">
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-12 text-center">
				<button type="submit" class="btn btn-primary validation"><i class="fa fa-user"></i> Daftar</button>
				<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</button>
			</div>
		</div>
		
	</form>
</div>