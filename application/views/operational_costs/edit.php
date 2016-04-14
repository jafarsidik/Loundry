<?= $breadcrumb ?>
<h2 class="page-header">Ubah Biaya Pengeluaran</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">

	<input type="hidden" name="<?= $controller ?>[OP_COST_ID]" value="<?= $edit->OP_COST_ID ?>">

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-3">Tanggal</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="<?php $d = strtotime($edit->DATE); echo date('d F Y H:i:s', $d); ?>" disabled>
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
					<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" value="<?= $edit->NAME ?>" maxlength="100" placeholder="Nama" autofocus>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-3">Keterangan</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="<?= $controller ?>[DESC]" maxlength="255" placeholder="Keterangan" rows="4"><?= $edit->DESCRIPTION ?></textarea>
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
					<th width="100">Aksi</th>
				</tr>
			</thead>
			<tbody id="DETAILS">
				<?php
				$no = 1;
				foreach($details as $l){
					echo '<tr>';
					echo '<td>'.$no.'</td>';
					echo '<td><input type="hidden" name="details[NAME][]" value="'.$l->NAME.'">'.$l->NAME.'</td>';
					echo '<td><input type="hidden" name="details[PRICE][]" value="'.$l->PRICE.'">'.$l->PRICE.'</td>';
					echo '<td><input type="hidden" name="details[AMOUNT][]" value="'.$l->AMOUNT.'">'.$l->AMOUNT.'</td>';
					echo '<td>'.$l->TOTAL.'</td>';
					echo '<td><a href="javascript:void(0)" class="tooltips remove" title="Remove"><i class="fa fa-times fa-lg"></i></a></td>';
					echo '</tr>';
					$no += 1;
				}
				?>
			</tbody>
		</table>
	</div>
	
	<div class="row">
		<div class="col-md-offset-7 col-md-5">
			<div class="form-group">
				<label class="control-label col-sm-4">Total Biaya</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="<?= $controller ?>[TOTAL_COST]" value="<?= $edit->TOTAL_COST ?>" id="TOTAL_COST" maxlength="12" placeholder="Total Biaya" readonly="">
				</div>
			</div>
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