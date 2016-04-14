<?= $breadcrumb ?>
<h2 class="page-header">Laporan Pesanan</h2>
<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-sm-2">Cari Berdasarkan</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="CARI" maxlength="50" placeholder="No Pesanan, Tanggal Pesan, Kasir, Pelanggan">
		</div>
	</div>
	
	<div class="page-header"></div>
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
					<select class="form-control" id="CUSTOMERS">
						<option value="">Pilih Semua</option>
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
			<div class="form-group">
				<label class="control-label col-sm-4">Status Pesanan</label>
				<div class="col-sm-8">
					<select class="form-control" id="STATUS">
						<option value="">Pilih Semua</option>
						<option value="1">Pending</option>
						<option value="0">Expired / In Process</option>
						<option value="2">Ready / In Delivery</option>
						<option value="3">Complete</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Tanggal Pesanan</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="DATE_ORDER_MIN" placeholder="Dari">
				</div>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="DATE_ORDER_MAX" placeholder="Sampai">
				</div>
			</div>
		</div>
	</div>
	
	<div class="page-header"></div>
  <div class="form-group">
    <div class="col-sm-12 text-center">
      <button type="button" class="btn btn-primary btn-print"><i class="fa fa-print"></i> Print</button>
      <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Batal</button>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?= js_url('modules/'.$controller.'/default.js') ?>"></script>