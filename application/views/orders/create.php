<?= $breadcrumb ?>
<h2 class="page-header">Tambah Pesanan</h2>
<form class="form-horizontal" action="<?= base_url($controller.'/'.$method) ?>" method="post">
	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Tanggal Pesan</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?= date('d F Y') ?>" disabled>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Kasir</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" value="<?= $current_user->USER_NAME ?>" disabled>
				</div>
			</div>
		</div>
	</div>
	
	<h4 class="page-header">Pelanggan</h4>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Pelanggan</label>
				<div class="col-sm-8">
					<?php
					$cust = array();
					foreach($customer_lists as $l){
						$cust[$l->CUSTOMER_TYPE_ID] = $l->TYPE_NAME;
					}
					$customer = array_unique($cust);
					?>
					<select class="form-control required" id="CUSTOMERS" name="<?= $controller ?>[CUSTOMERS]">
						<option></option>
						<option value="-1">Tambah Pelanggan</option>
						<?php
						foreach($customer as $key => $row){
							echo '<optgroup label="'.$row.'">';
							foreach($customer_lists as $l){
								if($key == $l->CUSTOMER_TYPE_ID){
									echo '<option value="'.$l->CUSTOMER_ID.'">'.$l->NAME.'</option>';
								}
							}
							echo '</optgroup>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	
	<div id="CREATE_CUSTOMERS" style="display:none">
	<h4 class="page-header">Tambah Pelanggan</h4>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Jenis Pelanggan</label>
				<div class="col-sm-8">
					<select class="form-control required" id="CUSTOMER_TYPES" name="<?= $controller ?>[CUSTOMER_TYPES]">
						<option></option>
						<?php
						foreach($customer_type_lists as $l){
							echo '<option value="'.$l->CUSTOMER_TYPE_ID.'">'.$l->NAME.'</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Pengguna</label>
				<div class="col-sm-8">
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
									echo '<option value="'.$l->USER_ID.'">'.$l->USER_NAME.'</option>';
								}
							}
							echo '</optgroup>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Pemilik</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="<?= $controller ?>[OWNER]" maxlength="100" placeholder="Pemilik">
					<small>Digunakan untuk Jenis Pelanggan Cabang</small>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Nama</label>
				<div class="col-sm-8">
					<input type="text" class="form-control required" name="<?= $controller ?>[NAME]" maxlength="100" placeholder="Nama">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Alamat</label>
				<div class="col-sm-8">
					<textarea class="form-control required" name="<?= $controller ?>[ADDRESS]" maxlength="255" placeholder="Alamat" rows="3"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Telepon</label>
				<div class="col-sm-8">
					<input type="text" class="form-control required" name="<?= $controller ?>[PHONE]" maxlength="20" placeholder="Telepon">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" name="<?= $controller ?>[EMAIL]" maxlength="100" placeholder="Email">
				</div>
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
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-offset-7 col-md-5">
			<div class="form-group">
				<label class="control-label col-sm-4">Total Bayar</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="<?= $controller ?>[TOTAL_PAYMENT]" id="TOTAL_PAYMENT" maxlength="12" placeholder="Total Bayar" readonly="">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Uang Muka</label>
				<div class="col-sm-8">
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
<script type="text/javascript" src="<?= js_url('modules/'.$controller.'/default.js') ?>"></script>