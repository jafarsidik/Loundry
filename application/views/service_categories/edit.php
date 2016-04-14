<?= $breadcrumb ?>
<h2 class="page-header">Ubah Kategori Layanan</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
	<input type="hidden" name="<?= $controller ?>[ID]" value="<?= $edit->SERVICE_CATEGORY_ID ?>">
	<div class="form-group">
		<label class="control-label col-sm-2">Nama</label>
		<div class="col-sm-10">
			<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" value="<?= $edit->NAME ?>" maxlength="100" placeholder="Nama" autofocus>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Keterangan</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="<?= $controller ?>[DESC]" maxlength="255" placeholder="Keterangan" rows="4"><?= $edit->DESCRIPTION ?></textarea>
		</div>
	</div>	
  <div class="form-group">
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn btn-primary validation"><i class="fa fa-save"></i> Ubah</button>
      <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</button>
    </div>
  </div>
</form>