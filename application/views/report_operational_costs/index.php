<?= $breadcrumb ?>
<h2 class="page-header">Laporan Biaya Pengeluaran</h2>
<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-sm-2">Cari Berdasarkan</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="CARI" maxlength="50" placeholder="Pengguna, Tanggal, Nama">
		</div>
	</div>
	
	<div class="page-header"></div>
	<div class="row">
		<div class="col-md-6">
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
					<select class="form-control" id="USERS">
						<option value="">Pilih Semua</option>
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
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-sm-2">Tanggal</label>
				<div class="col-sm-5">
					<input type="date" class="form-control" id="DATE_MIN" placeholder="Dari">
				</div>
				<div class="col-sm-5">
					<input type="date" class="form-control" id="DATE_MAX" placeholder="Sampai">
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