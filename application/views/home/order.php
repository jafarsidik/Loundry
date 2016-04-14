<?= $breadcrumb ?>
<div class="form-scroller">
	<h2 class="page-header">Pesanan</h2>
	<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-sm-4">Tanggal</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" value="<?= date('d F Y') ?>" disabled>
					</div>
				</div>
			</div>
		</div>
		
		<h4 class="page-header">Detail Pesanan</h4>
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<div class="col-sm-12">
						<?php
						$serv = array();
						foreach($service_lists as $l){
							$serv[$l->SERVICE_CATEGORY_ID] = $l->CATEGORY_NAME;
						}
						$service = array_unique($serv);
						?>
						<select class="form-control" id="SERVICES">
							<option></option>
							<?php
							foreach($service as $key => $row){
								echo '<optgroup label="'.$row.'">';
								foreach($service_lists as $l){
									if($key == $l->SERVICE_CATEGORY_ID){
										echo '<option value="'.$l->SERVICE_ID.'" price="'.$l->PRICE.'">'.$l->NAME.' | '.currency_idr($l->PRICE).'</option>';
									}
								}
								echo '</optgroup>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control" id="PRICE" placeholder="Harga" disabled>
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
			<table class="table">
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
				<tbody id="ORDER_DETAILS">
				</tbody>
			</table>
		</div>
		
		<div class="row">
			<div class="col-md-offset-7 col-md-5">
				<div class="form-group">
					<label class="control-label col-sm-5">Total Bayar</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="<?= $controller ?>[TOTAL_PAYMENT]" id="TOTAL_PAYMENT" maxlength="12" placeholder="Total Bayar" readonly="">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-5">Uang Muka</label>
					<div class="col-sm-7">
						<input type="text" class="form-control number" name="<?= $controller ?>[DOWN_PAYMENT]" id="DOWN_PAYMENT" maxlength="12" placeholder="Uang Muka">
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
	<script type="text/javascript" src="<?= js_url('modules/'.$controller.'/order.js') ?>"></script>
</div>