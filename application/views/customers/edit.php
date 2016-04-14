<?= $breadcrumb ?>
<h2 class="page-header">Ubah Pelanggan</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
	<input type="hidden" name="<?= $controller ?>[ID]" value="<?= $edit->CUSTOMER_ID ?>">
	<div class="form-group">
		<label class="control-label col-sm-2">Jenis Pelanggan</label>
		<div class="col-sm-4">
			<select class="form-control required" id="CUSTOMER_TYPES" name="<?= $controller ?>[CUSTOMER_TYPES]">
				<option></option>
				<?php
				foreach($customer_type_lists as $l){
					echo '<option value="'.$l->CUSTOMER_TYPE_ID.'" '.($l->CUSTOMER_TYPE_ID==$edit->CUSTOMER_TYPE_ID ? 'selected' : '').'>'.$l->NAME.'</option>';
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Pengguna</label>
		<div class="col-sm-4">
			<?php
			$usr = array();
			foreach($user_lists as $l){
				$usr[$l->PERMISSION_ID] = $l->PERMISSION_NAME;
			}
			$user = array_unique($usr);
			?>
			<select class="form-control required" id="USERS" name="<?= $controller ?>[USERS]">
				<option></option>
				<?php
				foreach($user as $key => $row){
					echo '<optgroup label="'.$row.'">';
					foreach($user_lists as $l){
						if($key == $l->PERMISSION_ID){
							echo '<option value="'.$l->USER_ID.'" '.($l->USER_ID==$edit->USER_ID ? 'selected' : '').'>'.$l->USER_NAME.'</option>';
						}
					}
					echo '</optgroup>';
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Pemilik</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="<?= $controller ?>[OWNER]" value="<?= $edit->OWNER ?>" maxlength="100" placeholder="Pemilik">
			<small>Digunakan untuk Jenis Pelanggan Cabang</small>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Nama</label>
		<div class="col-sm-6">
			<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" value="<?= $edit->NAME ?>" maxlength="100" placeholder="Nama">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Alamat</label>
		<div class="col-sm-6">
			<textarea class="form-control required" name="<?= $controller ?>[ADDRESS]" maxlength="255" placeholder="Alamat" rows="4"><?= $edit->ADDRESS ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Telepon</label>
		<div class="col-sm-6">
			<input type="text" class="form-control required digits" name="<?= $controller ?>[PHONE]" value="<?= $edit->PHONE ?>" maxlength="20" placeholder="Telepon">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Email</label>
		<div class="col-sm-6">
			<input type="email" class="form-control" name="<?= $controller ?>[EMAIL]" value="<?= $edit->EMAIL ?>" maxlength="100" placeholder="Email">
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