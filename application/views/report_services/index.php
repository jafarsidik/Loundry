<?= $breadcrumb ?>
<h2 class="page-header">Laporan Daftar Layanan</h2>
<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-sm-2">Cari Berdasarkan</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="CARI" maxlength="50" placeholder="Kategori, Item Layanan">
		</div>
	</div>
	
	<div class="page-header"></div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-4">Kategori Layanan</label>
				<div class="col-sm-8">
					<select class="form-control" id="SERVICE_CATEGORY">
						<option value="">Pilih Semua</option>
						<?php
						foreach($service_category_lists as $l){
							echo '<option value="'.$l->SERVICE_CATEGORY_ID.'">'.$l->NAME.'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-2">Harga</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="PRICE_MIN" maxlength="12" placeholder="Min">
				</div>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="PRICE_MAX" maxlength="12" placeholder="Max">
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