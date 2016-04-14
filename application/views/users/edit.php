<?= $breadcrumb ?>
<h2 class="page-header">Ubah Pengguna</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
	<input type="hidden" name="<?= $controller ?>[ID]" value="<?= $edit->USER_ID ?>">
	<div class="form-group">
		<label class="control-label col-sm-2">Group Pengguna</label>
		<div class="col-sm-4">
			<select class="form-control required" id="USER_PERMISSIONS" name="<?= $controller ?>[USER_PERMISSIONS]">
				<option></option>
				<?php
				foreach($user_permission_lists as $l){
					echo '<option value="'.$l->PERMISSION_ID.'" '.($l->PERMISSION_ID==$edit->PERMISSION_ID ? 'selected' : '').'>'.$l->PERMISSION_NAME.'</option>';
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Nama</label>
		<div class="col-sm-6">
			<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" value="<?= $edit->USER_NAME ?>" maxlength="100" placeholder="Nama">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Email</label>
		<div class="col-sm-6">
			<input type="email" class="form-control required" name="<?= $controller ?>[EMAIL]" value="<?= $edit->EMAIL ?>" maxlength="100" placeholder="Email">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Nama Pengguna</label>
		<div class="col-sm-6">
			<input type="text" class="form-control required" name="<?= $controller ?>[USERNAME]" value="<?= $edit->USERNAME ?>" maxlength="100" placeholder="Nama Pengguna">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Kata Sandi Lama</label>
		<div class="col-sm-6">
			<input type="password" class="form-control" name="<?= $controller ?>[OLD_PASSWORD]" maxlength="100" placeholder="Kata Sandi Lama">
			<span class="help-block">Biarkan kosong jika anda tidak ingin ganti kata sandi.</span>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Kata Sandi</label>
		<div class="col-sm-6">
			<input type="password" class="form-control" name="<?= $controller ?>[PASSWORD]" maxlength="100" placeholder="Kata Sandi">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Konfirmasi</label>
		<div class="col-sm-6">
			<input type="password" class="form-control" name="<?= $controller ?>[CONFIRM_PASSWORD]" maxlength="100" placeholder="Konfirmasi Kata Sandi">
		</div>
	</div>
  <div class="form-group">
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn btn-primary validation"><i class="fa fa-save"></i> Ubah</button>
      <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</button>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?= js_url('modules/'.$controller.'/default.js') ?>"></script>