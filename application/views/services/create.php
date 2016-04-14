<?= $breadcrumb ?>
<h2 class="page-header">Tambah Daftar Layanan</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
	<div class="form-group">
		<label class="control-label col-sm-2">Kategori Layanan</label>
		<div class="col-sm-4">
			<select class="form-control required" id="SERVICE_CATEGORY" name="<?= $controller ?>[SERVICE_CATEGORY]">
				<option></option>
				<?php
				foreach($service_category_lists as $l){
					echo '<option value="'.$l->SERVICE_CATEGORY_ID.'">'.$l->NAME.'</option>';
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Nama</label>
		<div class="col-sm-6">
			<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" maxlength="100" placeholder="Nama">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ukuran</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="<?= $controller ?>[SIZE]" maxlength="50" placeholder="Ukuran">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Satuan</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="<?= $controller ?>[UNIT]" maxlength="50" placeholder="Satuan">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Harga</label>
		<div class="col-sm-6">
			<input type="text" class="form-control required number" name="<?= $controller ?>[PRICE]" maxlength="12" placeholder="Harga">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Keterangan</label>
		<div class="col-sm-6">
			<textarea class="form-control" name="<?= $controller ?>[DESC]" maxlength="255" placeholder="Keterangan" rows="4"></textarea>
		</div>
	</div>
  <div class="form-group">
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn btn-primary validation"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</button>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?= js_url('modules/'.$controller.'/default.js') ?>"></script>