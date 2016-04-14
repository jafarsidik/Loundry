<?= $breadcrumb ?>
<h2 class="page-header">Tambah Biaya Pengeluaran</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-3">Tanggal</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="<?= date('d F Y') ?>" disabled>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-3">Pengguna</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="<?= $current_user->USER_NAME ?>" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-3">Nama</label>
				<div class="col-sm-9">
					<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" maxlength="100" placeholder="Nama" autofocus>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-3">Keterangan</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="<?= $controller ?>[DESC]" maxlength="255" placeholder="Keterangan" rows="4"></textarea>
				</div>
			</div>
		</div>
	</div>
	
	<h4 class="page-header">Detail</h4>
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<div class="col-sm-12">
					<input type="text" class="form-control" id="NAME" maxlength="100" placeholder="Nama">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<div class="col-sm-12">
					<input type="text" class="form-control" id="PRICE" maxlength="12" placeholder="Harga">
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<div class="col-sm-12">
					<input type="text" class="form-control" id="AMOUNT" maxlength="5" placeholder="Jumlah">
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<div class="col-sm-12">
					<button type="button" class="btn btn-primary" id="ADD"><i class="fa fa-plus"></i> Tambah</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="50">No</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Total</th>
					<th width="100">Hapus</th>
				</tr>
			</thead>
			<tbody id="DETAILS">
			</tbody>
		</table>
	</div>
	
	<div class="row">
		<div class="col-md-offset-7 col-md-5">
			<div class="form-group">
				<label class="control-label col-sm-4">Total Biaya</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="<?= $controller ?>[TOTAL_COST]" id="TOTAL_COST" maxlength="12" placeholder="Total Biaya" readonly="">
				</div>
			</div>
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