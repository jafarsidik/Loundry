<?= $breadcrumb ?>
<h2 class="page-header">Ubah Pesanan</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
	
	<input type="hidden" name="<?= $controller ?>[ORDER_ID]" value="<?= $edit->ORDER_ID ?>">
	<input type="hidden" name="<?= $controller ?>[CUSTOMER_ID]" value="<?= $edit->CUSTOMER_ID ?>">
	<input type="hidden" name="<?= $controller ?>[PAY_STATUS]" value="<?= $edit->PAY_STATUS ?>">
	<input type="hidden" name="<?= $controller ?>[ORDER_STATUS]" value="<?= $edit->ORDER_STATUS ?>">
	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">No Pesanan</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?= $edit->ORDER_NUMBER ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Kasir</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?= $current_user->USER_NAME ?>" disabled>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Tanggal Pesan</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php $d = strtotime($edit->DATE_ORDER); echo date('d F Y H:i:s', $d); ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Tenggat Waktu</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?php $d = strtotime($edit->DEADLINE); echo date('d F Y H:i:s', $d); ?>" disabled>
				</div>
			</div>
		</div>
	</div>
	
	<h4 class="page-header">Pelanggan</h4>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Nama</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?= $edit->CUSTOMER_NAME ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Alamat</label>
				<div class="col-sm-8">
					<textarea class="form-control" disabled rows="3"><?= $edit->ADDRESS ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Telepon</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?= $edit->PHONE ?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" value="<?= $edit->EMAIL ?>" disabled>
				</div>
			</div>
		</div>
	</div>
	
	<h4 class="page-header">Detail Pesanan</h4>
	<div class="row">
		<div class="col-md-4">
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
		<div class="col-md-3">
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
			<tbody id="ORDER_DETAILS">
				<?php
				$no = 1;
				foreach($details as $l){
					echo '<tr>';
					echo '<td>'.$no.'</td>';
					echo '<td><input type="hidden" name="order_details[ID_SERVICES][]" value="'.$l->SERVICE_ID.'">'.$l->SERVICE_NAME.'</td>';
					echo '<td><input type="hidden" name="order_details[PRICE][]" value="'.$l->PRICE.'">'.$l->PRICE.'</td>';
					echo '<td><input type="hidden" name="order_details[AMOUNT][]" value="'.$l->AMOUNT.'">'.$l->AMOUNT.'</td>';
					echo '<td>'.$l->TOTAL.'</td>';
					echo '<td><a href="javascript:void(0)" class="tooltips remove" title="Hapus"><i class="fa fa-times fa-lg"></i></a></td>';
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
				<label class="control-label col-sm-4">Total Bayar</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="<?= $controller ?>[TOTAL_PAYMENT]" id="TOTAL_PAYMENT" value="<?= $edit->TOTAL_PAYMENT ?>" maxlength="12" placeholder="Total Bayar" readonly="">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Uang Muka</label>
				<div class="col-sm-8">
					<input type="text" class="form-control number" name="<?= $controller ?>[DOWN_PAYMENT]" id="DOWN_PAYMENT" value="<?= $edit->DOWN_PAYMENT ?>" maxlength="12" placeholder="Uang Muka">
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